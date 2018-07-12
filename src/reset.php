<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<body class="pixelbg">
  <div class="container">
    <div class="row">
      <div class="col">
        <?php display_message();
              password_reset();
        ?>
      </div>
    </div>
    <div class="row m-5" style="border:green solid 2px;">
      <form class="col form" method="POST">
        <div class="row my-5 justify-content-center font-weight-bold">
          <div class="col setSize text-center text-light" >
            PASSWORD RESET
          </div>
        </div>
        <div class="row justify-content-center" >
          <div class="col-sm-4 col-12 text-sm-center">
            <label for="" class="change">Enter Password : </label>
          </div>
          <div class="col-sm-4 col-12">
            <input type="password" name="password" id="password" placeholder="###########" class="form-control">
          </div>
        </div>

        <div class="row mt-3 justify-content-center">
          <div class="col-sm-4 col-12 change text-sm-center ">
            <label for="" class="change" style="">Confirm Password : </label>
          </div>
          <div class="col-sm-4 col-12">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="###########" class="form-control">
          </div>
        </div>
        <div class="mt-3 mb-5 row justify-content-center" >
          <input type="submit" class="col-sm-3 col-5 btn btn-primary form-control" value="Proceed" >
          <input type="hidden" name="token" value="<?php echo token_generator();?>" class="hide">
        </div>

      </form>
    </div>
  </div>
</body>



<?php include("includes/footer.php");?>
