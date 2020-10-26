<?php
  session_start();
  include_once '../includes/dbh.inc.php';
  include_once '../includes/functions.php';
 ?>
 <?php  if(time() > $_SESSION['expire']){
   session_destroy();
    session_write_close();
    session_unset();
    $_SESSION = array();
 }
 else {
   $_SESSION['expire'] = time() + 30*60;
 }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type = "text/css" href = "../styles/portalstyles.css">
     <script src="../scripts/myscripts.js"></script>
    <title>Let's Track</title>
  </head>
  <body>
    <header>
      <div>
      <nav>
        <ul class="left-form">
          <li><a href="portal">Home</a></li>
          <li><a href="open">Open</a></li>
          <li><a href="progress">In progress</a></li>
          <li><a href="closed">Closed</a></li>

        </ul>
        <ul class="right-form">
          <?php
          if (isset($_SESSION['userID'])) {
            $usersignedin = $_SESSION['userUID'];
              echo '<p class="upper disp-user">Welcome '.$usersignedin.' </p>';

          }
          ?>
          <li><form action="../includes/logout.inc.php" method="post">
            <input class="logout-button" type="submit" name="logout-submit" value="Logout"></button>
          </form></li>
        </ul>
      </nav>
     </div>

     <?php
     if (!isset($_SESSION['userID'])) {
       header("Location: ../index");
     }
     ?>
    </header>
