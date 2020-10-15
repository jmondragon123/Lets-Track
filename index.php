<?php
  require "header.php"
 ?>

    <main>

        <div class="container">
          <div class="login-form-content">
            <h1 >Let's Track login</h1>
            <?php
              if (isset($_GET['error'])) {
                if ($_GET['error'] == "sqlerror") {
                  echo "<p class='error' >There was an error with the database</p>";
                }
                else if($_GET['error'] == "wrongpwd") {
                  echo "<p class='error' >Wrong password!</p>";
                }
                else if($_GET['error'] == "invaliduid") {
                  echo "<p class='error' >Invalid username!</p>";
                }
                else if($_GET['error'] == "nouser") {
                  echo "<p class='error' >No user found!</p>";
                }
                else if($_GET['error'] == "emptyfields") {
                  echo "<p class='error' >Fill in all the fields!</p>";
                }
              }
             ?>

            <form action="includes/login.inc.php" method="post">
              <label>Username/E-mail</label>
              <input type="text" name="uname">
              <label>Password</label>
              <input type="password" name="pwd">
              <input type="submit" name="login-submit" value="Login">
              <div>
                <span>Don't have an account?</span>
                <a  href="signup.php">Sign-up</a>
              </div>

            </form>
          </div>
      </div>
    </main>

    <!-- This redirects to the portal page if a user is logged in -->
    <?php
    if (isset($_SESSION['userID'])) {
     header("Location: portal/portal.php");
    }
    ?>

 <?php
   require "footer.php"
  ?>
