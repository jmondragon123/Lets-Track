<?php
echo '<div class="user-view">';
echo '<table class="users-Table">
<tr>
  <th>Username</th>
  <th>E-mail</th>
  <th>User Group</th>
</tr>';

$sql = "SELECT users.idUsers, users.uidUsers, users.emailUsers,groups.groupName FROM users INNER JOIN groups ON users.userGroup = groups.idGroup WHERE users.idUsers !='".$_SESSION['userID']."' ORDER BY users.idUsers DESC;";
$result = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($result);
if (!$resultsCheck > 0) {
echo "No data found";
}
else {
while ($row = mysqli_fetch_assoc($result)) {

  echo '<tr>
  <th> <a href=user?userID='.$row["idUsers"].'>'.$row["uidUsers"].'</a></th>
  <th>'.$row['emailUsers'].'</th>
  <th>'.$row['groupName'].'</th>
  </tr>';
}
}
echo "</table>";
echo '</div>';
