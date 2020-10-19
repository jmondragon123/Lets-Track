<?php
  require "header.php"
 ?>

 <main>

   <?php
   $group = $_SESSION['userGroups'];
   if ($group == "1") {
     if (isset($_GET['userID'])) {
       $useId = $_GET['userID'];
       $sql = "SELECT users.uidUsers, users.emailUsers,groups.groupName FROM users INNER JOIN groups ON users.userGroup = groups.idGroup WHERE users.idUsers=".$useId;
       $result = mysqli_query($conn, $sql);
       $resultsCheck = mysqli_num_rows($result);
       if (!$resultsCheck > 0) {
       echo "No user data found";
       }
       else {
         $row = mysqli_fetch_assoc($result);
         echo '<form class="" action="../includes/modifyuser.inc.php" id="modifyuser" method="post">
          <input type="hidden" name="id" value="'.$useId.'">
           <label> Username</label>
           <label> '.$row['uidUsers'].'</label> <br>
           <label> E-mail</label>
           <input type="text" name="email" value="'.$row['emailUsers'].'"><br>
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
           <div class="password change">
           <input type="checkbox" id="changepwd" name="changepwd" value="1" onclick="changepwd_changed(this)"/>
           <label for="changepwd">Change password?</label>
           <label> New password</label>
           <input type="password" name="newpwd" id="newpwd" disabled>
           <label> Confirm password</label>
           <input type="password" name="confirmpwd" id="confirmpwd"disabled><br>
           </div>
           <div class="submitchanges">
           <input type="submit" name="savechanges" value="Save changes">
           </div>
         </form>';


       }
     }

   }
   else {
     header("Location: portal");
     exit();
   }
    ?>
 </main>
 <br>

 <?php
   require "footer.php"
  ?>
