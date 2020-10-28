<?php
if (isset($_POST['submitnotes']) xor !isset($_POST['savechanges'])) {
  header("Location: ../portal/agent");
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
        header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrorcomments");
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
    $name = getUserId($_POST['name']);
    $state = getStateId($_POST['currentState']);
    $description = $_POST['bugDescription'];
    $title = $_POST['title'];
    if (isset($_POST['assignedTo'])){
      if ($_POST['assignedTo'] !== "none") {
        $assigned = getUserId($_POST['assignedTo']);
      }
      else {
        $assigned = null;
      }
    }

    if (empty($description) || empty($title) ) {
      header("Location: ../portal/viewbug?bugid=".$bugID."&error=emptydesctitle");
      exit();
    }
    else {
      $sqlCurrentData = "SELECT bugName, bugDescription, bugAssignedTo, bugState FROM bugs WHERE bugId = '$bugID';";
      $resultCurrentData = mysqli_query($conn, $sqlCurrentData);
      $resultsCheck = mysqli_num_rows($resultCurrentData);
      if (!$resultsCheck > 0) {
        header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrordata");
        exit();
      }
      else {
        $row = mysqli_fetch_assoc($resultCurrentData);
        $currentState = $row['bugState'];
        $currentDescription = $row['bugDescription'];
        $currentTitle = $row['bugName'];
        $currentAssignedTo = $row['bugAssignedTo'];

        if ($currentTitle !== $title) {
          $sql = "UPDATE bugs SET bugName=? WHERE bugId=".$bugID.";";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrortitle");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "s", $title);
            mysqli_stmt_execute($stmt);
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          $comment = "Title updated from: $currentTitle to $title";
          bugChangesAddComment($name,$comment,$bugID);
        }

        if ($currentDescription !== $description) {
          $sql = "UPDATE bugs SET bugDescription=? WHERE bugId=".$bugID.";";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrordesc");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "s", $description);
            mysqli_stmt_execute($stmt);
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          $comment = "Description updated from: $currentDescription to $description";
          bugChangesAddComment($name,$comment,$bugID);
        }

        if ($currentState !== $state) {
          $sql = "UPDATE bugs SET bugState=? WHERE bugId=".$bugID.";";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrorstate");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "i", $state);
            mysqli_stmt_execute($stmt);
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          $cState = getStateName($currentState);
          $sName = getStateName($state);
          $comment = "State updated from: $cState to $sName";
          bugChangesAddComment($name,$comment,$bugID);
        }

        if ($currentAssignedTo !== $assigned) {
          $sql = "UPDATE bugs SET bugAssignedTo=? WHERE bugId=".$bugID.";";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../portal/viewbug?bugid=".$bugID."&error=sqlerrorassigned");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "i", $assigned);
            mysqli_stmt_execute($stmt);
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          $cAssignedTo = getUserName($currentAssignedTo);
          $aTo = getUserName($assigned);
          $comment = "Assigned to updated from: $cAssignedTo to $aTo";
          bugChangesAddComment($name,$comment,$bugID);
        }

        header("Location: ../portal/viewbug?bugid=".$bugID."&update=success");
        exit();
      }
    }
  }
}
