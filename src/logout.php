<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<?php session_destroy();
if(isset($_COOKIE['username'])){
  unset($_COOKIE['username']);
  setcookie('username','',time()-86400);
}

?>
<div class="jumbotron">
  <h1 class="text-center"><?php
redirect("login.php");
  ?></h1>

</div>

<?php include("includes/footer.php");?>
