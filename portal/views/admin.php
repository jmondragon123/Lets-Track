<?php
echo '<div class="user-view">';
echo '<table class="users-Table">
<tr>
  <th>User ID</th>
  <th>Username</th>
  <th>E-mail</th>
  <th>User Group</th>
  <th>Edit</th>
</tr>';

$sql = "SELECT users.idUsers,users.uidUsers, users.emailUsers,groups.groupName FROM users INNER JOIN groups ON users.userGroup = groups.idGroup;";
$result = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($result);
if (!$resultsCheck > 0) {
echo "No data found";
}
else {
while ($row = mysqli_fetch_assoc($result)) {

  echo '<tr>
  <th>'.$row["idUsers"].
  '</th> <th>'.$row["uidUsers"].
  '</th> <th>'.$row['emailUsers'].
  '</th> <th>'.$row['groupName'].
  '</th> 
  </tr>';
}
}
echo "</table>";
echo '</div>';
