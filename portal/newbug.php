<?php
  require "header.php"
  ?>

<main>
  <div class="container">
    <div class="cont-info">
      <h1 class="title">Bug Maker</h1>
      <form action="../includes/newbug.inc.php" method="post" id="newbug">
        <div class="fields jc-space-between">
          <label class="div-title">Name</label>
          <?php
            if (isset($_GET['name'])) {
              $name = $_GET['name'];
              echo '<input class="div-small-input" type="text" class="buginput" name="bugName" value="'.$name.'">';
            }
            else {
              echo '<input class="div-small-input" type="text" class="buginput" name="bugName" placeholder="Bug Name">';
            }
          ?>
        </div>
        <div class="fields jc-space-between">
          <label class="div-title" >Description</label>
          <?php
            if (isset($_GET['desc'])) {
              $desc = $_GET['desc'];
              echo '<textarea class="div-big-input" name="bugDescription" class="buginput description" >'.$desc.'</textarea>';
            }
            else {
              echo '<textarea class="div-big-input" type="text" name="bugDescription" class="buginput description" placeholder="Bug description"> </textarea>';
            }
          ?>
        </div>
        <?php
        echo "<div class='fields jc-space-between'>
                <label class='div-title'>Created by</label>

              <select class='div-selected' name='createdby' form='newbug'>
                <option value='none' selected disabled hidden>Select a user</option>'
              ";
        $result = getUsers();
        $assignTo = getUserName($row['bugAssignedTo']);
        while ($rows = mysqli_fetch_assoc($result)) {
          if ($assignTo == $rows["uidUsers"] ){
            echo '<option selected value="'.$rows["uidUsers"].'">'.$rows["uidUsers"].'</option>';
          }
          else {
            echo '<option value="'. $rows["uidUsers"] .'">'.$rows["uidUsers"].'</option>';
          }
        }
        echo "</select>
        </div>";

        ?>
        <?php
        echo "<div class='fields jc-space-between'></div>
                <label class='div-title'>Assigned to</label>

              <select class='div-selected' name='assignedTo' form='newbug'>
                <option value='none' selected>None</option>
              ";
        $result = getUsers();
        $assignTo = getUserName($row['bugAssignedTo']);
        while ($rows = mysqli_fetch_assoc($result)) {
          if ($assignTo == $rows["uidUsers"] ){
            echo '<option selected value="'.$rows["uidUsers"].'">'.$rows["uidUsers"].'</option>';
          }
          else {
            echo '<option value="'. $rows["uidUsers"] .'">'.$rows["uidUsers"].'</option>';
          }
        }
        echo "</select>
        </div>";

          ?>
        <div class="fields jc-end">
            <input class="form-buttons" type="submit" name="submit-newbug" value="Create new bug">
        </div>
      </form>
      <div>
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
          echo "<p class = 'error'>Fill in name, description, and created by!</p>";
        }
      }
      else if (isset($_GET['creation']))
        if ($_GET['creation'] == "success") {
          echo "<p class='success'>Bug has been created successfuly!</p>";
        }
      ?>
      </div>
    </div>
  </div>
</main>


<?php
  require "footer.php"
  ?>
