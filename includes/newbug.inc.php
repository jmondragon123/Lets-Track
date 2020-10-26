<?php

if (!isset($_POST['submit-newbug'])) {
  header("Location: ../portal/newbug");
  exit();
}
else {
  require 'dbh.inc.php';
  require 'functions.php';
  $bugName = $_POST['bugName'];
  $bugDescription = $_POST['bugDescription'];
  $bugCreatedBy = getUserId($_POST['createdby']);
  $bugAssignedTo = getUserId($_POST['assignedTo']);

  if (empty($bugName) || empty($bugDescription) || empty($bugCreatedBy)) {
    header("Location: ../portal/newbug?error=emptyfields&name=".$bugName."&desc=".$bugDescription);
    exit();
  }
  else {
    $sql = "INSERT INTO bugs (bugName, bugDescription, bugCreatedBy, bugAssignedTo) VALUES (?, ?, ?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../portal/newbug?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ssii", $bugName, $bugDescription, $bugCreatedBy, $bugAssignedTo);
      mysqli_stmt_execute($stmt);
      header("Location: ../portal/newbug?creation=success");
      exit();
    }

  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
