<?php


function getUsers() {
  require 'dbh.inc.php';
  $sql = "SELECT uidUsers FROM users;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate users";
  }
  else {
    return $result;
  }
}

function getUsersIds() {
  require 'dbh.inc.php';
  $sql = "SELECT idUsers FROM users;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate users";
  }
  else {
    return $result;
  }
}


function getUserId($name) {
  require 'dbh.inc.php';
  $sql = "SELECT idUsers FROM users WHERE uidUsers='".$name."';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate user: ".$name;
  }
  else {
    $row = mysqli_fetch_assoc($result);
    return $row['idUsers'];
  }
}

function getUserName($id) {
  require 'dbh.inc.php';
  $sql = "SELECT uidUsers FROM users WHERE idUsers='".$id."';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate user: ".$name;
  }
  else {
    $row = mysqli_fetch_assoc($result);
    return $row['uidUsers'];
  }
}


function getStates() {
  require 'dbh.inc.php';
  $sql = "SELECT stateName FROM state;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate states";
  }
  else {
    return $result;
  }
}

function getStateId($state) {
  require 'dbh.inc.php';
  $sql = "SELECT stateID FROM state WHERE stateName='".$state."';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "Could not locate user: ".$state;
  }
  else {
    $row = mysqli_fetch_assoc($result);
    return $row['stateID'];
  }
}

function getComments($bugID) {
  require 'dbh.inc.php';
  $sql = "SELECT comments.commentId, users.uidUsers, comments.commentContext,
          DATE_FORMAT(comments.commentCreateDate, '%m/%d/%Y') AS commentCreateDate,
          DATE_FORMAT(comments.commentCreateDate, '%r') AS commentCreateTime, comments.commentBugId
          FROM comments
          INNER JOIN users ON comments.commentCreatedBy = users.idUsers
          WHERE commentBugId =' ".$bugID." '
          ORDER BY commentId DESC;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    return;
  }
  else {
    return $result;
  }
}
