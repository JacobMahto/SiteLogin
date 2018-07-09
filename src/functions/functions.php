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
  if(!$message){
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
  }
if(!empty($errorList)){
  foreach($errorList as $error){
//$alertMessage = "<div class='alert alert-danger alert-dismissible fade show'><button class='close'data-dismiss='alert' type='button'><span>&times;</span></button><strong>Error in Registration : </strong>$error</div>";
//echo "$alertMessage";

echo validation_errors($error);  }
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
 ?>
