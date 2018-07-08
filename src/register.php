<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>
<body class="pixelbg">
<div class="signup-form container" >
<div class="signup d-flex flex-column my-3 justify-content-center align-items-center" style="background:black;position:relative;height:50%;width:75%;opacity:0.55;">
<img class="text-light mt-2" src="img/schoolLogo.jpg" alt="schoolLogo" style="width:20%;border:5px solid orange;">
<h4 class="w-100 text-center text-light">
  <strong>M.K. PUBLIC SCHOOL</strong><br><span class="text-muted">Registration</span>
</h4>
  <div class="w-100 bg-danger" style="height:0.08rem;"></div>
<div class="w-100" >
    <form class="form w-100 text-warning" action="" method="post">
      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="fname">Enter Your First Name</label>
          <input type="text" id="name" placeholder="Jacob" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="lname">Enter Your Last Name</label>
          <input type="text" id="lname" placeholder="Mahto" value="" class="form-control">
        </div>
      </div>

      <div class="w-100 bg-info" style="height:0.08rem;"></div>

      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="username">Enter Your Name</label>
          <input type="text" id="username" placeholder="jacobmahto" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Enter Your Email-id</label>
          <input type="email" id="email" placeholder="abc@xyz.com" value="" class="form-control">
        </div>
      </div>

      <div class="w-100 bg-info" style="height:0.08rem;"></div>

      <div class="d-flex w-100 p-2 flex-wrap justify-content-around" style="">
        <div class="form-group" >
          <label for="password">Enter Password</label>
          <input type="password" id="password" placeholder="" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="passwordconf">Confirm Password</label>
          <input type="password" id="passwordconf" placeholder="" value="" class="form-control">
        </div>
      </div>
      <div class="row justify-content-center mb-3" style="z-index:5;">
        <button type="button" class="btn btn-danger w-50" name="button" style="z-index:5;">Register</button>

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
