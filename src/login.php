<?php include("includes/header.php");?>
<?php include("includes/nav.php");?>

<body class="galaxybg">
  <div class="container" >
  <div id="loginbox" class="mt-5 mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" >
      <div class="panel-heading">
        <div class="row justify-content-sm-start justify-content-center" style="">
          <img class="d-block align-self-center ml-3 text-light" src="img/schoolLogo.jpg" alt="schoolLogo" style="width:20%;border:3px solid blue;">
          <div class="align-self-center ml-3 text-light text-center"><blockquote class="blockquote d-inline font-weight-bold">M.K. Public Sr. Sec. School</blockquote> <br>Staff Access Terminal</div>

        </div>

        </div>

      <div style="padding-top:30px" class="panel-body" >

        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

        <form id="loginform" class="form-horizontal" role="form">

          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">
          </div>

          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
          </div>



          <div class="input-group text-light">
            <div class="checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1" class="" > Remember me
              </label>
            </div>
          </div>
          <button type="button" class="d-block mr-auto btn btn-primary " name="button" style="width:35%;">Access</button>

          <div style="margin-top:10px" class="form-group">
          <div class="form-group">
            <div class="col-md-12">
              <div class="text-light" style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                Tech-Res Engineered by
                <a class="text-primary" href="#" >
                  Jacob V. Mahto
                </a>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

</div>
</div>

<?php include("includes/footer.php");?>
