<?php
  require "header.php"
  ?>

 <main>
   <div class="newbugcont">
     <div class="newbug-container">
       <h1 class="bugmaker">Bug Maker</h1>
       <form action="../includes/newbug.inc.php" method="post" id="newbug">
         <label>Name</label>
         <?php
          if (isset($_GET['name'])) {
            $name = $_GET['name'];
            echo '<input type="text" class="buginput" name="bugName" value="'.$name.'">';
          }
          else {
            echo '<input type="text" class="buginput" name="bugName" placeholder="Bug Name">';
          }
          ?>
        <label>Description</label>
        <?php
          if (isset($_GET['desc'])) {
            $desc = $_GET['desc'];
            echo '<textarea name="bugDescription" class="buginput description" value="'.$desc.'"> </textarea>';
          }
          else {
            echo '<textarea type="text" name="bugDescription" class="buginput description" placeholder="Bug description"> </textarea>';
          }
        ?>
        <label> Created By</label>
        <?php
        echo '<select name="createdby" form="newbug">
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
          echo '<select name="assignedTo" form="newbug">
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
          echo "</select> <br>";
        ?>

      <input type="submit"name="submit-newbug" value="Create new bug">
      </form>
      <div class="error">
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
          echo "<p>Fill in name, description, and created by!</p>";
        }
      }
      ?>
      </div>
    </div>
  </div>
</main>


<?php
  require "footer.php"
  ?>
