<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<?php
$query="SELECT * FROM users;";
$result=query($query);
confirm($result);
$row=fetch_array($result);
echo $row['username'];
 ?>




<?php include("includes/footer.php");?>
