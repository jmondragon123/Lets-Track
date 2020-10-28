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
      <?php
      if (isset($_GET['userID'])) {
        if ($_GET['userID'] !== strval($_SESSION['userID'])){
          $userName = getUserName($_GET['userID']);
          if ($userName == "-1"){
            header("Location: agent");
            exit();
          }
          else {
            $userId = $_GET['userID'];
            echo '<h1 class="title">'.$userName.'</h1>';
            echo '<form action="../includes/removeuser.inc.php" id="removeuser" method="post"">
                  <div class="fields jc-center">
                    <input type="hidden" name="username" value="'.$userId.'">';
          }
          
        }
        else {
          header("Location: agent");
          exit();
        }
      } 
    ?>
      
        
          <input class="form-buttons" type="submit" name="removeuser" value="Delete user">
        </div>
      </form>


    </div>
  </div>
</main>


<?php
  require "footer.php"
?>
