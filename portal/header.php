<?php
  session_start();
  include_once '../includes/dbh.inc.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type = "text/css" href = "../styles/portalstyles.css">
    <title>Let's Track</title>
  </head>
  <body>
    <header>
      <div>
      <nav>
        <ul class="left-form">
          <li><a href="portal.php">Home</a></li>
          <li><a href="open.php">Open</a></li>
          <li><a href="onhold.php">On Hold</a></li>
          <li><a href="closed.php">Closed</a></li>

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
       header("Location: ../index.php");
     }
     ?>
    </header>