<?php

#**********************HELPER FUNCTIONS*****************
#function to clean a string of special characters like > , < , etc.
function clean($string){
  return htmlentities($string);
}

#Redirect to URL
function redirect($location){
  return header("Location: {$location}");
}

//Saving the message to Session
function set_message($message){
  if($message){
    $_SESSION['message']=$message;
  }
  else{
    $message="";
  }
}

//Getting the message from session_variable of message
function display_message(){
  if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}

#Producing random values
function token_generator(){
  $token = $_SESSION['token']= md5(uniqid(mt_rand(),true));
  return $token;
}

//to create an alert box of the success message
function success_message($successMessage){
  $alertMessage = <<<DELIMITER
  <div class='alert alert-primary alert-dismissible fade show'><button class='close'data-dismiss='alert' type='button'><span>&times;</span></button><strong>Notice : </strong>$successMessage</div>
DELIMITER;
    return $alertMessage;
}

//to create an alert box of the fail message
function fail_message($failMessage){
  $alertMessage = <<<DELIMITER
  <div class='alert alert-danger alert-dismissible fade show'><button class='close'data-dismiss='alert' type='button'><span>&times;</span></button><strong>Notice : </strong>$failMessage</div>
DELIMITER;
    return $alertMessage;
}

#send mail
function send_email($email,$subject,$msg,$header){
  mail($email,$subject,$msg,$header);
}

#**********************VALIDATION FUNCTIONS*****************
function validate_registration(){
  $min=3;
  $max=25;
  $errorlist[]="";

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $firstName=clean($_POST['first_name']);
    $lastName=clean($_POST['last_name']);
    $username=clean($_POST['username']);
    $email=clean($_POST['email']);
    $password=clean($_POST['password']);
    $confirmPassword=clean($_POST['confirm_password']);

    if(strlen($firstName)<$min || strlen($firstName)>$max ){
      $errorList[]="First Name should be between $min to $max length.";
    }
    if(strlen($lastName)<$min || strlen($lastName)>$max ){
      $errorList[]="First Name should be between $min to $max length.";
    }
    if(strlen($username)<$min || strlen($username)>$max ){
      $errorList[]="Username should be between $min to $max length.";
    }
    if(strlen($password)<$min || strlen($password)>$max ){
      $errorList[]="Password should be between $min to $max length.";
    }
    if(strlen($confirmPassword)<$min || strlen($confirmPassword)>$max ){
      $errorList[]="Password should be between $min to $max length.";
    }
    if(email_exists($email)){
      $errorList[]="This e-mail id has already been registered.";
    }
    if(username_exists($username)){
      $errorList[]="This username has already been taken.";
    }
    #This thing will be migrated to JavaScript in future
    if($password != $confirmPassword){
      $errorList[]="Passwords don't Match.";
    }
    if(!empty($errorList)){
      foreach($errorList as $error){
    //$alertMessage = "<div class='alert alert-danger alert-dismissible fade show'><button class='close'data-dismiss='alert' type='button'><span>&times;</span></button><strong>Error in Registration : </strong>$error</div>";
    //echo "$alertMessage";

    echo validation_errors($error);  }
    }
    else{
      if(register_user($firstName,$lastName,$username,$email,$password)){
        set_message("<p class='bg-success text-center'>Please check your email (inbox or spam folder).");
        redirect("index.php");
        echo "USER REGISTERED;";
      }
      else{
        set_message("<p class='bg-danger text-center'>Sorry , Account Registration Failed.");
        redirect("index.php");
      }
    }
  }
}

//to create an alert box of the given error
function validation_errors($error){
  $alertMessage = <<<DELIMITER
  <div class='alert alert-danger alert-dismissible fade show'><button class='close'data-dismiss='alert' type='button'><span>&times;</span></button><strong>Error in Registration : </strong>$error</div>
DELIMITER;
    return $alertMessage;
}



function email_exists($email){
  $sql="SELECT id FROM users WHERE email='$email';";
  $result=query($sql);
  if(row_count($result)==1){
    return true;
  }
  else {
    return false;
  }
}

function username_exists($username){
  $sql="SELECT id FROM users WHERE username='$username';";
  $result=query($sql);
  if(row_count($result)==1){
    return true;
  }
  else {
    return false;
  }
}

#function to input register data into database
function register_user($first_name,$last_name,$username,$email,$password){
  $first_name=escape($first_name);
  $last_name=escape($last_name);
  $username=escape($username);
  $email=escape($email);
  $password=escape($password);

  if(email_exists($email)){
    return false;
  }
  else if(username_exists($username)){
    return false;
  }
  else {
    $password=md5($password);
    $validation_code=md5($username.microtime());
    $sql="INSERT INTO users(first_name,last_name,username,email,password,validation_code,active) ";
    $sql.="VALUES('$first_name','$last_name','$username','$email','$password','$validation_code',0);";
    $result=query($sql);
    confirm($result);

    $subject = "Activate Account";
    $msg = "Please Click the link below to activate your account -
    http://localhost/siteLogin/src/activate.php?email=$email&code=$validation_code
    ";
    $header = "From : noreply@JacobResearchLab.com";
    send_email($email,$subject,$msg,$header);
  }
  return true;
}

#**********************ACTIVATION FUNCTIONS*****************
function activate_user(){
  if($_SERVER['REQUEST_METHOD']== "GET"){
    if(isset($_GET['email'])){
      $email = escape(clean($_GET['email']));
      $validation_code = escape(clean($_GET['code']));

      $sql = "SELECT id FROM users WHERE email='$email' AND validation_code='$validation_code'";
      $result=query($sql);
      confirm($result);
      if(row_count($result)==1){
        $sql2="UPDATE users SET active=1 , validation_code=0 where email='$email' AND validation_code='$validation_code';";
        $result2=query($sql2);
        confirm($result2);

        //set_message( "<p class='bg-success'> Your Account has been activated , you can now login.</p>" );
        set_message(success_message("Your Account has been activated , you can now login."));
        redirect("login.php");
      }
      else {
        set_message( fail_message("Sorry , Your Account has not been activated.") );
        redirect("login.php");
      }
    }
  }
}


#**********************VALIDATE USER LOGIN FUNCTIONS*****************

function validate_user_login(){
  $errors=[];
  $min=3;
  $max=20;
  if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=clean($_POST['username']);
    $password=clean($_POST['password']);

if(empty($username)){
  $errors[]="Enter your Username.";
}
if(!empty($errors)){
  foreach($errors as $error){
    echo validation_errors($error);
  }
}
else{
  if(login_user($username,$password)){
    redirect("admin.php");
  }
  else{
    echo validation_errors("Incorrect Credentials.");
  }
}


  }
}

#**********************USER LOGIN FUNCTIONS*****************
function login_user($username,$password){
  $password=md5($password);
$sql="SELECT * FROM users WHERE username='$username' AND password='$password';";
$result=query($sql);
if(row_count($result)==1){
  $row=fetch_array($result);
  $dbPassword=$row['password'];
if($password===$dbPassword){
  $_SESSION['username']=$username;
  return true;
}
else{
  return false;
}
}
else{
  return false;
}
}

#**********************LOGGED IN FUNCTIONS*****************

function logged_in(){
  if(isset($_SESSION['username'])){
    return true;
  }
  else{
    return false;
  }
}


 ?>
