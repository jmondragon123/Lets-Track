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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../scripts/myscripts.js"></script>
    <title>Let's Track</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="topnav" id="myTopnav">
          <?php
          if (isset($_SESSION['userID'])) {
            $usersignedin = $_SESSION['userUID'];
              // echo '<p>Welcome '.$usersignedin.' </p>';
              echo '<a href="agent">Welcome '.$usersignedin.'</a>';
          }
          ?>
          <a href="assigned">Assigned</a>
          <a href="newbug">New Bug</a>
          <?php
            $group = $_SESSION['userGroups'];
            if ($group == "1") {
              echo '<a href="newuser">New User</a>';
          }
          ?>
          
          <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
          <form action="../includes/logout.inc.php" method="post">
            <input class="logout-button" type="submit" name="logout-submit" value="Logout"></button>
          </form>
          
        </div>
      </nav>

    <?php
    if (!isset($_SESSION['userID'])) {
      header("Location: ../index");
    }
    ?>
    </header>
