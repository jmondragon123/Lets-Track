<?php
  require "header.php"
?>

<main>
  <div class="container">
    <div class="cont-info">
        <form id="savechanges" action="../includes/modifybug.inc.php" method="post">
        <?php
        $bugID = $_GET['bugid'];
        $userName = $_SESSION['userUID'];
          echo '<input type="hidden" name="id" value="'.$bugID.'">';
          echo '<input type="hidden" name="name" value="'.$userName.'">';
          if (isset($_GET['bugid'])) {
            $bugID = $_GET['bugid'];
            $sql = 'SELECT bugs.bugId, bugs.bugName, bugs.bugDescription, bugs.bugCreatedBy, bugs.bugAssignedTo, DATE_FORMAT(bugCreatedDate, "%m/%d/%Y") AS "bugCreatedDate" , state.stateName
            FROM bugs INNER JOIN state ON bugs.bugState = state.stateID WHERE bugs.bugId ='.$bugID;
            $result = mysqli_query($conn, $sql);
            $resultsCheck = mysqli_num_rows($result);
            if (!$resultsCheck > 0) {
              echo "No bug found";
            }
            else {
              $row = mysqli_fetch_assoc($result);
              echo "<div class='title'>
                      <input class='title-input' name='title' type='text' value='".$row['bugName']."'>
                    </div>
                    <br>
                    <div class='fields jc-space-between'>
                            <label class='div-title'>Created</label>
                            <label class='div-label'>".$row['bugCreatedDate']."
                          </div>
                    <div class='fields jc-space-between'>
                      <label class='div-title'>Created By</label>
                      <label class='div-label'>".getUserName($row['bugCreatedBy'])."</label>
                    </div>
                    <div class='fields jc-space-between'>
                      <label class='div-title'>State</label>
                      <br>
                      <select class='div-selected' name='currentState' form='savechanges'>
                            <option value='none' selected disabled hidden>Current State</option>
                          ";
              $resultState = getStates();
              while ($rowState = mysqli_fetch_assoc($resultState)) {
                if ($row['stateName'] == $rowState["stateName"] ){
                  echo '<option selected value="'.$rowState["stateName"].'">'.$rowState["stateName"].'</option>';
                }
                else {
                  echo '<option value="'.$rowState["stateName"].'">'.$rowState["stateName"].'</option>';
                }
              }
              echo "  </select>
                    </div>";
              echo "<div class='fields jc-space-between'>
                      <label class='div-title'>Assigned to</label>

                    <select class='div-selected' name='assignedTo' form='savechanges'>
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
              echo "<div class='fields'>
                <label class='div-title'>Description</label>

                <textarea type='text' name='bugDescription' class='div-big-input'>".$row['bugDescription']."</textarea>
              </div>
              <div class='fields jc-end'>
                <input class='form-buttons' type='submit' name='savechanges' value='Update'>
              </div>
              </form>";
            }

          }
          ?>
          <form id="modifybug" action="../includes/modifybug.inc.php" method="post">
            <?php
              $bugID = $_GET['bugid'];
              $userName = $_SESSION['userUID'];
              echo '<input type="hidden" name="id" value="'.$bugID.'">';
              echo '<input type="hidden" name="name" value="'.$userName.'">';
            ?>
            <div class='fields'>
              <label class='div-title'>Comments/Notes</label>
              <br>
              <textarea name='bugComments' class='div-big-input'></textarea>
            </div>

            <div class='fields jc-end'>
              <input class="form-buttons" type="submit" name="submitnotes" value="Add Note">
            </div>
        </form>
        <?php
        $result = getComments($bugID);
        if ($result !== null) {
          echo "<div class='border'>";
          while ($rows = mysqli_fetch_assoc($result)) {
            echo "<div class='fields-comments'>
                    <div class='username'>
                      <p>".$rows['uidUsers']." </p>
                    </div>
                    <div class='notes'>
                      <p>".$rows['commentContext']." </p>
                    </div>
                    <div class='dates'>
                      <p>".$rows['commentCreateDate']." </p>
                      <p>".$rows['commentCreateTime']." </p>
                    </div>
                  </div>
            ";
          }
          echo "</div>";
        }
        ?>
    </div>
  </div>

</main>

<?php
  require "footer.php"
  ?>
