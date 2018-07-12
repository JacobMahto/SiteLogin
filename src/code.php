<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<body class="pixelbg">
  <div class="container">
    <div class="row m-5">
      <div class="col">
        <?php
        display_message();
        validate_code(); ?>
      </div>
    </div>

    <div class="row mx-auto " >

      <form class="row form justify-content-center w-100" method="POST" >
        <div class="form-group col-sm-4 col-12 mr-sm-2 my-2">
          <label for="code" class="text-light font-weight-bold" justify-content-between>Enter your validation Code</label>
          <input type="password" class="form-control" placeholder="#########" name="code" id="code">
          <input type="submit" class="mt-2 form-control btn btn-success" value="Proceed">
        </div>
        </form>

    </div>
  </div>

</body>


<?php include("includes/footer.php");?>
