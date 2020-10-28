<?php
  require "header.php"
  ?>

<main>
  <div class='t-margin'>
    <?php
      
      $result = getBugsTableAssigned($_SESSION['userID']);
      if($result != "-1"){
        echo '<div class="user-view">
      <table class="users-Table">
      <tr>
        <th>ID</th>
        <th>Bug Name</th>
        <th>Created by</th>
        <th>Created Date</th>
        <th>Bug State</th>
      </tr>';
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
      }
      else {
        echo "<p class='error'>No Bugs assigned to you. </p>";
      }
    ?>
    </div>
</main>


<?php
  require "footer.php"
?>
