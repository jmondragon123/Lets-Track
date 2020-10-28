<?php
  require "header.php";
  $group = $_SESSION['userGroups'];
    if ($group !== 1) {
      header("Location: agent");
      exit();
    }
  ?>

<main>
  <div class="container">
    <div class="cont-info">
      <h1 class="title">Remove user</h1>


    </div>
  </div>
</main>


<?php
  require "footer.php"
?>
