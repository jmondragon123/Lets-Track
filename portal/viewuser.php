<?php
  require "header.php"

?>

<main>
  <div class="container">
    <div class="cont-info">
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
        $userId = $_GET['userID'];
        $result = getUserInfo($userId);
        $row = mysqli_fetch_assoc($result);
        echo '<input type="hidden" name="id" value="'.$userId.'">
                <div class="title">
                  <label> '.$row['uidUsers'].'</label> <br>
                </div>
                <div class="fields jc-space-between">
                  <label class="div-title"> E-mail</label>
                  <input class="div-small-input" type="text" name="email" value="'.$row['emailUsers'].'">
                </div>
                <div class="fields jc-space-between">
                  <label class="div-title"> Group</label>
                  <select class="div-selected" name="group" form="modifyuser">';
                  $resultGroups = getGroups();
                  while ($rowGroup = mysqli_fetch_assoc($resultGroups)) {
                    if ($rowGroup["groupName"] == $row['groupName']) {
                      echo '<option value ='.$rowGroup["groupName"].' selected>'.$rowGroup["groupName"].'</option>';
                    }
                    else {
                      echo '<option value ='.$rowGroup["groupName"].'>'.$rowGroup["groupName"].'</option>';
                    }
                  }
            echo '</select>
                </div>
                <hr>';
      }
    }
      else {
        header("Location: agent");
        exit();
      }
    ?>
        <div class="fields">
          <input type="checkbox" id="changepwd" name="changepwd" value="1" onclick="changepwd_changed(this)"/>
          <label class="div-title" for="changepwd">Change password?</label>
      </div>
      <div class="fields jc-space-between">
            <label class="div-title"> New password</label>
            <input type="password" name="newpwd" id="newpwd" disabled>
          </div>
          <div class="fields jc-space-between">
          <label class="div-title"> Confirm password</label>
          <input type="password" name="confirmpwd" id="confirmpwd"disabled>
        </div>
        <div class="fields jc-end">
        <input class="form-buttons" type="submit" name="savechanges" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</main>
<br>

<?php
  require "footer.php"
  ?>
