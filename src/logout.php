<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<?php session_destroy();?>
<div class="jumbotron">
  <h1 class="text-center"><?php
redirect("login.php");
  ?></h1>

</div>

<?php include("includes/footer.php");?>
