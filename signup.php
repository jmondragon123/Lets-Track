<?php
  require "header.php"
 ?>
 <main>
   <div class="container">
     <div class="login-form-content">
       <h1>Sign-up</h1>
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

       <form class="login" action="includes/signup.inc.php" method="post">
         <label>Username</label>
        <?php
          if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
            echo '<input type="text" name="uname" value="'.$uid.'">';
          }
          else {
            echo '<input type="text" name="uname">';
          }
         ?>

         <label>Email</label>
         <?php
           if (isset($_GET['mail'])) {
             $mail = $_GET['mail'];
             echo '<input type="text" name="email" value="'.$mail.'">';
           }
           else {
             echo '<input type="text" name="email">';
           }
          ?>
         <label>Password</label>
         <input type="password" name="pwd">
         <label>Confirm password</label>
         <input type="password" name="confirmpwd">
         <input type="submit" name="register" value="Sign-up">
         <div>
           <span>Already have an account?</span>
           <a  href="index.php">Login</a>
         </div>
       </form>
    </div>
   </div>
 </main>


 <?php
   require "footer.php"
  ?>
