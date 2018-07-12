<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<body class="pixelbg">
<?php
display_message();
recover_password();?>
  <div class="row">
    <div class="col text-light font-weight-bold display-4 mt-0 text-center align-self-center" style="">
      Password Reset
    </div>

  </div>
  <div class="row m-5" >
    <form class="row form justify-content-center w-100" method="POST" >
      <input type="email" class="col-sm-4 col-12 mr-sm-2 my-2 form-control" placeholder="Enter your E-Mail ID" name="email" id="email">
      <input type="submit" class="col-sm-2 col-12 ml-sm-0 my-2 form-control btn btn-success" value="Send reset link">
      <input type="hidden" name="token" value="<?php echo token_generator();?>" class="hide">
    </form>

  </div>



</body>

<?php include("includes/footer.php");?>
