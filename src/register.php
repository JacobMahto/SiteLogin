<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>
<body class="pixelbg">
<?php validate_registration(); ?>
<div class="signup-form container" >
<div class="signup d-flex flex-column my-3 justify-content-center align-items-center" style="background:black;position:relative;height:50%;width:75%;opacity:0.55;">
<img class="text-light mt-2" src="img/schoolLogo.jpg" alt="schoolLogo" style="width:20%;border:5px solid orange;">
<h4 class="w-100 text-center text-light">
  <strong>M.K. PUBLIC SCHOOL</strong><br><span class="text-muted">Registration</span>
</h4>
  <div class="w-100 bg-danger" style="height:0.08rem;"></div>
<div class="w-100" >
    <form class="form w-100 text-warning" id="registration-form" method="post" role="form">
      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="fname">Enter Your First Name</label>
          <input type="text" name="first_name" id="first_name" placeholder="Jacob" value="" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="lname">Enter Your Last Name</label>
          <input type="text" name="last_name" id="last_name" placeholder="Mahto" value="" class="form-control" required>
        </div>
      </div>

      <div class="w-100 bg-info" style="height:0.08rem;"></div>

      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="username">Your Username</label>
          <input type="text" name="username" id="username" placeholder="jacobmahto" value="" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email">Enter Your Email-id</label>
          <input type="email" name="email" id="email" placeholder="abc@xyz.com" value="" class="form-control" required>
        </div>
      </div>

      <div class="w-100 bg-info" style="height:0.08rem;"></div>

      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="password">Enter Password</label>
          <input type="password" name="password" id="password" placeholder="" value="" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="passwordconf">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" placeholder="" value="" class="form-control" required>
        </div>
      </div>
      <div class="form-group row justify-content-center mb-3" style="">
        <!-- <button type="submit" class="form-control btn btn-register w-50" name="register_submit" style="z-index:5;">Register</button> -->
<input type="submit" name="register-submit" id="register-submit" class="form-control w-50 btn btn-primary" value="Register">
      </div>

    </form>
    <div class="text-light text-center" style="border-top: 1px solid#888; font-size:85%" >
      Tech-Res-2.0 Engineered by
      <a class="text-primary" href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
        Jacob V. Mahto
      </a>
    </div>
  </div>
</div>


  </div>

  <?php include("includes/footer.php");?>
