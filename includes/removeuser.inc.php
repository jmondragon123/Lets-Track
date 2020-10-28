<?php

if (!isset($_POST['removeuser'])) {
  header("Location: ../portal/agent");
  exit();
}
else {
  require 'dbh.inc.php';
  require 'functions.php';
  $username = $_POST['username'];
  $sql = "DELETE FROM users WHERE users.idUsers = $username;";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "SQL Error";
    exit();
  }
  else {
    header("Location: ../portal/agent");
  }
}             