<?php
  require "header.php"
?>
<main>
  <div class="container">
    <div class="cont-info">
      <h1 class="title">New user</h1>
      <!--These are my error messages that will appear -->
      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo "<p class='error' >Fill in all the fields!</p>";
          }
          else if($_GET['error'] == "invalidmailuid") {
            echo "<p class='error' >Invalid username and email!</p>";
          }
          else if($_GET['error'] == "invaliduid") {
            echo "<p class='error' >Invalid username!</p>";
          }
          else if($_GET['error'] == "invalidmail") {
            echo "<p class='error' >Invalid email!</p>";
          }
          else if($_GET['error'] == "passwordcheck") {
            echo "<p class='error' >Your passwords do not match!</p>";
          }
          else if($_GET['error'] == "usetaken") {
            echo "<p class='error' >Username is already taken!</p>";
          }
        }
        else if (isset($_GET['signup'])) {
          if ($_GET['signup'] == "success") {
            echo "<p class='success' >Signup successful!</p>";
          }
      }
        ?>

      <form class="login" action="../includes/newuser.inc.php" method="post">
      <div class="fields jc-space-between"> 
        <label class="div-title">Username</label>
          <?php
            if (isset($_GET['uid'])) {
              $uid = $_GET['uid'];
              echo '<input class="div-small-input" type="text" name="uname" value="'.$uid.'">';
            }
            else {
              echo '<input class="div-small-input" type="text" name="uname">';
            }
          ?>
      </div> 
      <div class="fields jc-space-between">
        <label class="div-title">Email</label>
        <?php
          if (isset($_GET['mail'])) {
            $mail = $_GET['mail'];
            echo '<input class="div-small-input" type="text" name="email" value="'.$mail.'">';
          }
          else {
            echo '<input class="div-small-input" type="text" name="email">';
          }
          ?>
      </div>
      <div class="fields jc-space-between">
        <label class="div-title">Password</label>
        <input class="div-small-input" type="password" name="pwd">
      </div>
      <div class="fields jc-space-between">
        <label class="div-title">Confirm password</label>
        <input class="div-small-input" type="password" name="confirmpwd">
      </div>
      <div class="fields jc-end">
        <input class="form-buttons" type="submit" name="register" value="Sign-up">
      </form>
    </div>
  </div>
</main>


<?php
  require "footer.php"
  ?>
