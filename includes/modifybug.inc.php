<?php
if (isset($_POST['submitnotes']) xor !isset($_POST['savechanges'])) {
  header("Location: ../portal/portal");
  exit();
}
else {
  require 'dbh.inc.php';
  require 'functions.php';
  $bugID = $_POST['id'];
  // This is for when we are just adding the notes
  if (isset($_POST['submitnotes'])){
    $name = getUserId($_POST['name']);
    $comments = $_POST['bugComments'];
    if (empty($comments)) {
      header("Location: ../portal/viewbug?bugid=".$bugID."&error=emptycomment");
      exit();
    }
    else {
      $sql = "INSERT INTO comments(commentCreatedBy,commentContext,commentBugId) VALUES (?,?,?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "isi", $name,$comments,$bugID);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/viewbug?bugid=".$bugID."&addnote=success");
        exit();
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }


  // This is for when we are updating the actual ticket
  else if(isset($_POST['savechanges'])){
    $state = getStateId($_POST['currentState']);
    $description = $_POST['bugDescription'];
    if (isset($_POST['assignedTo'])){
      if ($_POST['assignedTo'] !== "none") {
        $assigned = getUserId($_POST['assignedTo']);
      }
      else {
        $assigned = null;
      }
    }

    if (empty($description)) {
      header("Location: ../portal/viewbug?bugid=".$bugID."&error=emptydescription");
      exit();
    }
    else {
      $sql = "UPDATE bugs SET bugState=?, bugAssignedTo=?, bugDescription=? WHERE bugId=".$bugID.";";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "iis", $state,$assigned,$description);
        mysqli_stmt_execute($stmt);
        header("Location: ../portal/viewbug?bugid=".$bugID."&update=success");
        exit();
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }

}
