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

 ?>
