<?php
echo '<div class="user-view">
  <table class="users-Table">
    <tr>
      <th>ID</th>
      <th>Bug Name</th>
      <th>Created by</th>
      <th>Created Date</th>
      <th>Bug State</th>
    </tr>';
$sql = "SELECT bugId, bugName, bugCreatedBy, DATE_FORMAT(bugCreatedDate, \"%m/%d/%Y\") AS \"bugCreatedDate\", state.stateName FROM bugs INNER JOIN state ON bugs.bugState = state.stateID";
$result = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($result);
if (!$resultsCheck > 0) {
echo "No data found";
}
else {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>
    <th>'.$row["bugId"].'</th>
    <th> <a href=viewbug?bugid='.$row["bugId"].'>'.$row['bugName'].'</a></th>
    <th>'.$row['bugCreatedBy'].'</th>
    <th>'.$row['bugCreatedDate'].'</th>
    <th>'.$row['stateName'].'</th>
    </tr>';
    }
}
echo "</table>";
echo '</div>';
 ?>
