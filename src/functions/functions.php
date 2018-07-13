<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
//require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';;

//foreach (glob("classes/*.php") as $filename)
//{
//    include $filename;
//}
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
function send_email($email=null,$subject=null,$msg=null,$header=null){
    //Create a new PHPMailer instance
$mail = new PHPMailer(true);
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = Config::SMTP_HOST;
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = Config::SMTP_PORT;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = Config::SMTP_USER;
//Password to use for SMTP authentication
$mail->Password = Config::SMTP_PASSWORD;
//Set who the message is to be sent from
$mail->setFrom('mkpsjaipur@gmail.com', "M.K. Public Sr. Sec. School");
//Set an alternative reply-to address
//$mail->addReplyTo('jacobmahto148@gmail.com', 'Jacob V. Mahto');
//Set who the message is to be sent to
$mail->addAddress($email);
//Set the subject line-non-html
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);
//Replace the plain text body with one created manually
$mail->AltBody = $msg;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    return true;
    //set_message(validation_errors("Mailer Error: " . $mail->ErrorInfo()));
} else {
    return false;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//mail($email,$subject,$msg,$header);
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

    //for localhost computer
    $subject = "Activate Account";
//    $msg = "Welcome to MK Public School-Staff Regisstration Portal - Please Click the link below to activate your account -
//    http://localhost/siteLogin/src/activate.php?email=$email&code=$validation_code
//    ";

    //for actual website    
    $msg = "Welcome to <b>MK Public School-Staff Registration Portal</b> - Please Click the link below to activate your account -<br>
   <a href='http://mkpsindia.000webhostapp.com/activate.php?email=$email&code=$validation_code'>Activate Account</a>
    <br><b>Regards , <br><i>@Jacob V. Mahto</i></b>";
    
    $header = "From : jvm@JacobResearchLab.com";
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
    $remember=isset($_POST['remember']);

#Just for debugging to check the value returned by checkbox it is 1 (and "on")
    // if($remember=="on"){
    //   //die("yes".$remember);
    // }
    // else{
    //   //die("no".$remember);
    // }
if(empty($username)){
  $errors[]="Enter your Username.";
}
if(!empty($errors)){
  foreach($errors as $error){
    echo validation_errors($error);
  }
}
else{
  if(login_user($username,$password,$remember)){
    redirect("admin.php");
  }
  else{
    echo validation_errors("Incorrect Credentials.");
  }
}


  }
}

#**********************USER LOGIN FUNCTIONS*****************
function login_user($username,$password,$remember){
  $password=md5($password);
$sql="SELECT * FROM users WHERE username='$username' AND password='$password' AND active=1;";
$result=query($sql);
if(row_count($result)==1){
  $row=fetch_array($result);
  $dbPassword=$row['password'];
if($password===$dbPassword){
  if($remember == "on"){
    setcookie('username',$username,time()+86400);//cookie validity of 1 day
    //setcookie('password',$password,time()+60);
  }
  else{

  }
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
  if(isset($_SESSION['username']) || isset($_COOKIE["username"])){
    return true;
  }
  else{
    return false;
  }
}

#**********************RECOVER PASSWORD FUNCTIONS*****************

function recover_password(){
  if($_SERVER['REQUEST_METHOD']=="POST"){
 //echo "IT WORKS";
if(isset($_SESSION["token"]) && $_POST['token']===$_SESSION['token']){
  //die("tansen");
  $email=clean($_POST['email']);
if(email_exists($email)){
  $validation_code=md5($email.microtime());
  //cookie time of 5 minutes
  setcookie('temp_access_code',$validation_code,time()+300);
  $sql="UPDATE users SET validation_code='$validation_code' WHERE email='$email';";
  $result=query($sql);
  confirm($result);
  $subject="Tech-Res Password Reset";
  $message="Here is your password reset code :<b> $validation_code </b>
<br>Click here to reset your password <a href='http://mkpsindia.000webhostapp.com/code.php?email=$email&code=$validation_code'>Reset Account Password</a>
  <br><b>Regards , <br><i>@Jacob V. Mahto</i></b>";
  $header = "From : noreply@JacobResearchLab.com";
  if(send_email($email,$subject,$message,$header)){
die("good");
  }
  else{
    echo validation_errors("E-mail not sent.");
  }
  set_message("<p class='bg-success text-center'>Please check your inbox or spam folder for Password Reset link.</p>");
  //set_message(success_message("Please check your inbox or spam folder for Password Reset link."));
  redirect("index.php");
}
else{
  validation_errors("This E-Mail doesn't exist.");
}

}
redirect("index.php");
  }
}

#**********************RESET CODE VALIDATION FUNCTIONS*****************
function validate_code(){
  if(isset($_COOKIE['temp_access_code'])){
if($_SERVER['REQUEST_METHOD']=="GET" || $_SERVER['REQUEST_METHOD']=="POST"){
  if(isset($_GET['email']) && isset($_GET['code']) && isset($_POST['code']) ){
  $validation_code=clean($_GET['code']);
  $email=clean($_GET['email']);
  $sql="SELECT id FROM users WHERE validation_code='$validation_code' AND email='$email';";
  $result=query($sql);
  if(row_count($result)==1 && $validation_code==$_POST['code']){
    setcookie('reset_code',$validation_code,time()+300);
    redirect("reset.php?email=$email&code=$validation_code");
  }
  else{
    echo validation_errors("Wrong Validation Code.");
  }

  }
}
  }
  else{
    set_message("<p class='bg-success text-center'>Sorry, Validation time duration has been expired.</p>");
    redirect("recover.php");
  }
}

#**********************PASSWORD RESET CODE VALIDATION FUNCTIONS*****************
function password_reset(){
  if(isset($_COOKIE['reset_code'])){
    if(isset($_GET['email']) && isset($_GET['code']) && isset($_SESSION["token"]) && isset($_POST['token'])){
      if($_SESSION['token']===$_POST['token']){
        if($_POST['password']===$_POST['confirm_password']){
          $email=clean($_GET['email']);
          $password=md5($_POST['password']);
  $sql="UPDATE users SET password='$password' WHERE email='$email';";
  $result=query($sql);
  set_message(success_message("Password Reset Successful."));
  redirect("login.php");

        }
        else{
echo validation_errors("Passwords Mismatch.");
        }
      }
  }
  }
  else{
    set_message(validation_errors("Sorry , Authentication Failed due to Server timeout."));
    redirect("recover.php");
  }


}

 ?>
