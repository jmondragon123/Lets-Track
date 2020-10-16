<?php
  require "header.php"
 ?>

 <main>
   <div class="newbugcont">
     <div class="newbug-container">

     <form action="../includes/newbug.inc.php" method="post" id="newbug">
       <label>Bug Name</label>
       <?php
          if (isset($_GET['name'])) {
            $name = $_GET['name'];
            echo '<input type="text" name="bugName" value="'.$name.'">';
          }
          else {
            echo '<input type="text" name="bugName">';
          }
        ?>
       <label>Bug description</label>
       <?php
          if (isset($_GET['desc'])) {
            $desc = $_GET['desc'];
            echo '<input type="text" name="bugDescription" value="'.$desc.'">';
          }
          else {
            echo '<input type="text" name="bugDescription" placeholder="Bug description">';
          }
        ?>


       <input type="submit" name="submit-newbug" value="Create new bug">
     </form>

     <label> Created By</label>

       <?php
       echo '<select class="" name="createdby" form="newbug">
         <option value="none" selected disabled hidden>Select a user</option>';
         $sql = "SELECT `uidUsers` FROM `users`;";
         $result = mysqli_query($conn, $sql);
         $resultsCheck = mysqli_num_rows($result);
         if (!$resultsCheck > 0) {
         echo "Could not locate users";
         }
         else {
           while ($row = mysqli_fetch_assoc($result)) {
             echo '<option value ='.$row["uidUsers"].'>'.$row["uidUsers"].'</option>';
           }
         }

       echo "</select>";
        ?>
        <label> Assigned to</label>
        <?php
        echo '<select class="" name="assignedTo" form="newbug">
          <option value="none" selected disabled hidden>Select a user</option>';
          $sql = "SELECT `uidUsers` FROM `users`;";
          $result = mysqli_query($conn, $sql);
          $resultsCheck = mysqli_num_rows($result);
          if (!$resultsCheck > 0) {
          echo "Could not locate users";
          }
          else {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value ='.$row["uidUsers"].'>'.$row["uidUsers"].'</option>';
            }
          }
        echo "</select>";
         ?>
       </div>
    </div>
</main>


 <?php
   require "footer.php"
  ?>
