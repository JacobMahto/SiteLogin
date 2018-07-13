<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>
<body class="galaxybg">
    <div class="jumbotron">
        <h1 class="text-center"><?php display_message(); ?>
            ----Amicus Plato, sed magis amica veritas --- @Newton--<br></h1>

    </div>
    <h4 class="text-light">
        <?php
$sql = "SELECT first_name,username FROM users";
$result = query($sql);
$rows = [];
while ($a = mysqli_fetch_array($result)) {
    $rows[] = $a;
}
foreach ($rows as $row) {
    echo "$row[0]-@$row[1]<br>";
}

if (!empty($result)) {
    
}
?>
    </h4>


</body>
<?php include("includes/footer.php"); ?>
