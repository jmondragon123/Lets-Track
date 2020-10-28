<?php
  require "header.php"
?>

<main>
  <section class="information-view">
        <?php
        $group = $_SESSION['userGroups'];
        if ($group == "1") {
          echo '<div class="user-view">';
            echo '<table class="users-Table">
            <tr>
              <th>Username</th>
              <th>E-mail</th>
              <th>User Group</th>
            </tr>';

            $result = getUsersTable($_SESSION['userID']);
            while ($row = mysqli_fetch_assoc($result)) {

              echo '<tr>
              <th> <a href=viewuser?userID='.$row["idUsers"].'>'.$row["uidUsers"].'</a></th>
              <th>'.$row['emailUsers'].'</th>
              <th>'.$row['groupName'].'</th>
              </tr>';
            }

            echo "</table>";
            echo '</div>';

        }
        echo '<div class="user-view">
        <table class="users-Table">
        <tr>
          <th>ID</th>
          <th>Bug Name</th>
          <th>Created by</th>
          <th>Created Date</th>
          <th>Bug State</th>
        </tr>';
        $result = getBugsTable();
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>
          <th>'.$row["bugId"].'</th>
          <th> <a href=viewbug?bugid='.$row["bugId"].'>'.$row['bugName'].'</a></th>
          <th>'.$row['uidUsers'].'</th>
          <th>'.$row['bugCreatedDate'].'</th>
          <th>'.$row['stateName'].'</th>
          </tr>';
        }
          echo "  </table>
                </div>";
        ?>

  <div class="sidebar">
    <div>
      <a class="sidebar-button" href="newbug">New Bug</a>
    </div>
    <?php
      $group = $_SESSION['userGroups'];
      if ($group == "1") {
        echo '<div>
          <a class="sidebar-button" href="newuser">New User</a>
        </div>';
      }
    ?>
  </div>

  </section>
</main>


<?php
  require "footer.php"
  ?>
