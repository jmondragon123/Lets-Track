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
  $sql = "SELECT idUsers FROM users WHERE uidUsers='$name';";
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
  $sql = "SELECT uidUsers FROM users WHERE idUsers='$id';";
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

function getGroups() {
  require 'dbh.inc.php';
  $sql = "SELECT groupName FROM groups;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
  echo "Could not locate users";
  }
  else {
    return $result;
  }
}

function getGroupId($group){
  require 'dbh.inc.php';
  $sqlid = "SELECT idGroup FROM groups WHERE groupName ='$group';";
    $resultID = mysqli_query($conn, $sqlid);
    $resultsCheckID = mysqli_num_rows($resultID);
    if (!$resultsCheckID > 0) {
      echo "Could not locate groups <br>";
    }
    else {
      $rows = mysqli_fetch_assoc($resultID);
      return ($rows['idGroup']);
    }
}


function getUserInfo($userId) {
  require 'dbh.inc.php';
  $sql = "SELECT users.uidUsers, users.emailUsers,groups.groupName
    FROM users 
    INNER JOIN groups ON users.userGroup = groups.idGroup 
    WHERE users.idUsers='$userId';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
  echo "No user data found";
  }
  else {
    return $result;
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
  $sql = "SELECT stateID FROM state WHERE stateName='$state';";
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
          WHERE commentBugId ='$bugID'
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


function getUsersTable($userID) {
  require 'dbh.inc.php';
  $sql = "SELECT users.idUsers, users.uidUsers, users.emailUsers,groups.groupName 
          FROM users 
          INNER JOIN groups ON users.userGroup = groups.idGroup 
          WHERE users.idUsers !='$userID' 
          ORDER BY users.idUsers DESC;";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
  echo "No data found";
  }
  else {
    return $result;
  }
}

function getBugsTable() {
  require 'dbh.inc.php';
  $sql = "SELECT bugId, bugName, users.uidUsers, DATE_FORMAT(bugCreatedDate, '%m/%d/%Y') AS 'bugCreatedDate', state.stateName
        FROM bugs
        INNER JOIN state ON bugs.bugState = state.stateID
        INNER JOIN users ON bugs.bugCreatedBy = users.idUsers";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    echo "No data found";
  }
  else {
    return $result;
  }
}

function getBugsTableAssigned($userID) {
  require 'dbh.inc.php';
  $sql = "SELECT bugId, bugName, users.uidUsers, DATE_FORMAT(bugCreatedDate, '%m/%d/%Y') AS 'bugCreatedDate', state.stateName
        FROM bugs
        INNER JOIN state ON bugs.bugState = state.stateID
        INNER JOIN users ON bugs.bugCreatedBy = users.idUsers
        WHERE bugAssignedTo = '$userID';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if (!$resultsCheck > 0) {
    return "-1";
  }
  else {
    return $result;
  }
}