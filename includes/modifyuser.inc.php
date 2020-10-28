<?php

if (!isset($_POST['savechanges'])) {
  header("Location: ../portal/portal");
  exit();
}
else {
  require 'dbh.inc.php';
  require 'functions.php';

  $email = $_POST['email'];
  $group= $_POST['group'];
  $userID = $_POST['id'];
  if (isset($_POST['changepwd'])) {
    $newpwd = $_POST['newpwd'];
    $confpwd = $_POST['confirmpwd'];
    $changepwd = True;
  }
  else {
    $changepwd = False;
  }
  if (empty($email) || empty($group)) {
    header("Location: ../portal/viewuser?userID=".$userID."&error=emptyfields");
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../portal/viewuser?userID=".$userID."&error=invalidmailuid");
    exit();
  }
  else if ($changepwd && (empty($newpwd) || empty($confpwd))){
    header("Location: ../portal/viewuser?userID=".$userID."&error=missingpwd");
    exit();
  }
  else if ($newpwd !== $confpwd){
      header("Location: ../portal/viewuser?userID=".$userID."&error=passwordcheck");
      exit();
    }
  else {
    $idGroup = getGroupId($group);
    
    if ($confpwd) {
      $sql = 'UPDATE users SET  emailUsers=?, pwdUsers=?, userGroup=? WHERE idUsers='.$userID.';';
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/viewuser?userID=".$userID."&error=sqlerror");
        exit();
      }
      else {
        $hasedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssi", $email, $hasedPwd,$idGroup);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/viewuser?userID=".$userID."&changes=success");
        exit();
      }
    }
    else {

      $sql = 'UPDATE users SET emailUsers=?, userGroup=? WHERE idUsers='.$userID.';';
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/viewuser?userID=".$userID."&error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "si", $email, $idGroup);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/viewuser?userID=".$userID."&changes=success");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
