<?php

if (!isset($_POST['savechanges'])) {
  header("Location: ../portal/portal");
  exit();
}
else {
  require 'dbh.inc.php';

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
    header("Location: ../portal/user?userID=".$userID."&error=emptyfields");
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../portal/user?userID=".$userID."&error=invalidmailuid");
    exit();
  }
  else if ($changepwd && (empty($newpwd) || empty($confpwd))){
    header("Location: ../portal/user?userID=".$userID."&error=missingpwd");
    exit();
  }
  else if ($newpwd !== $confpwd){
      header("Location: ../portal/user?userID=".$userID."&error=passwordcheck");
      exit();
    }
  else {
    $sqlid = 'SELECT idGroup FROM `groups` WHERE groupName ="'.$group.'";';
    $resultID = mysqli_query($conn, $sqlid);
    $resultsCheckID = mysqli_num_rows($resultID);
    if (!$resultsCheckID > 0) {
      echo "Could not locate groups <br>";
    }
    else {
      $rows = mysqli_fetch_assoc($resultID);
      $idGroup = $rows['idGroup'];
    }

    if ($confpwd) {
      $sql = 'UPDATE users SET  emailUsers=?, pwdUsers=?, userGroup=? WHERE idUsers='.$userID.';';
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/user?userID=".$userID."&error=sqlerror");
        exit();
      }
      else {
        $hasedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $email, $hasedPwd,$idGroup);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/user?userID=".$userID."&changes=success");
        exit();
      }
    }
    else {

      $sql = 'UPDATE users SET emailUsers=?, userGroup=? WHERE idUsers='.$userID.';';
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/user?userID=".$userID."&error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $idGroup);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/user?userID=".$userID."&changes=success");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
