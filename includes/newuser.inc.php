<?php
if (!isset($_POST['register'])) {
  header("Location: ../portal/agent");
  exit();
}
else {
  require 'dbh.inc.php';
  require 'functions.php';
  $username = $_POST['uname'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['confirmpwd'];
  $userGroup = getGroupId($_POST['group']);


  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../portal/newuser?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
    header("Location: ../portal/newuser?error=invalidmailuid");
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../portal/newuser?error=invalidmail&uid=".$username);
    exit();
  }
  else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
    header("Location: ../portal/newuser?error=invaliduid&mail=".$email);
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../portal/newuser?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../portal/newuser?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../portal/newuser?error=usertaken&mail=".$email);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers,userGroup) VALUES (?, ?, ?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../portal/newuser?error=sqlerror");
          exit();
        }
        else {
          $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hasedPwd,$userGroup);
          mysqli_stmt_execute($stmt);
          header("Location: ../portal/newuser?signup=success");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}