<?php
  require "header.php"
 ?>

 <main>
   <div class="newUsers">
     <div class="userForm">
   <?php
     if (isset($_GET['error'])) {
       if ($_GET['error'] == "emptyfields") {
         echo "<p class='error' >Fill in all the fields!</p>";
       }
       else if($_GET['error'] == "invalidmailuid") {
         echo "<p class='error' >Invalid email!</p>";
       }
       else if($_GET['error'] == "missingpwd") {
         echo "<p class='error' >Fill in password and confirm password</p>";
       }
       else if($_GET['error'] == "passwordcheck") {
         echo "<p class='error' >Your passwords do not match!</p>";
       }
     }
     else if (isset($_GET['changes'])) {
       if ($_GET['changes'] == "success") {
         echo "<p class='success'>Changes have been saved!</p>";
       }
     }
    ?>

      <form action="../includes/modifyuser.inc.php" id="modifyuser" method="post">
     <?php
     $group = $_SESSION['userGroups'];
     if ($group == "1") {
       if (isset($_GET['userID'])) {
         $useId = $_GET['userID'];
         $sql = "SELECT users.uidUsers, users.emailUsers,groups.groupName
         FROM users INNER JOIN groups ON users.userGroup = groups.idGroup WHERE users.idUsers=".$useId;
         $result = mysqli_query($conn, $sql);
         $resultsCheck = mysqli_num_rows($result);
         if (!$resultsCheck > 0) {
         echo "No user data found";
         }
         else {
           $row = mysqli_fetch_assoc($result);
           echo '
            <input type="hidden" name="id" value="'.$useId.'">
            <div class="title">
             <label> '.$row['uidUsers'].'</label> <br>
             </div>
             <div class="showEmail">
             <label> E-mail</label>
             <input type="text" name="email" value="'.$row['emailUsers'].'"><br>
             </div>
             <div class="groupSlct">
             <label> Group</label>';

             echo '<select name="group" form="modifyuser">';
               $sql2 = "SELECT groupName FROM groups;";
               $result2 = mysqli_query($conn, $sql2);
               $resultsCheck2 = mysqli_num_rows($result2);
               if (!$resultsCheck2 > 0) {
               echo "Could not locate users";
               }
               else {
                 while ($rows = mysqli_fetch_assoc($result2)) {
                   if ($rows["groupName"] == $row['groupName']) {
                     echo '<option value ='.$rows["groupName"].' selected>'.$rows["groupName"].'</option>';
                   }
                   else {
                     echo '<option value ='.$rows["groupName"].'>'.$rows["groupName"].'</option>';
                   }
                 }
               }
             echo '</select>
                    </div>
                    <hr>';

         }
       }

     }
     else {
       header("Location: portal");
       exit();
     }
      ?>
        <div class="passwordChange">
        <input type="checkbox" id="changepwd" name="changepwd" value="1" onclick="changepwd_changed(this)"/>
        <label for="changepwd">Change password?</label>
        <br>
        <label> New password</label>
        <input type="password" name="newpwd" id="newpwd" disabled>
        <br>
        <label> Confirm password</label>
        <input type="password" name="confirmpwd" id="confirmpwd"disabled><br>
        </div>
        <div class="submitChanges">
        <input type="submit" name="savechanges" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
 </main>
 <br>

 <?php
   require "footer.php"
  ?>
