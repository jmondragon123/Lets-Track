<?php
  require "header.php"
 ?>

 <main>
   <section class="information-view">
         <?php
         $group = $_SESSION['userGroups'];
         if ($group == "1") {
           include "views/admin.php";
         }
         include "views/user.php";
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
