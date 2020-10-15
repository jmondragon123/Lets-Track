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
      <a class="new-bug-button" href="newbug">New Bug</a>
    </div>

  </div>

   </section>
</main>


 <?php
   require "footer.php"
  ?>
