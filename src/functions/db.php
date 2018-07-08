<?php
$username='root';
$password='lion';
$host='localhost';
$db='loginsys';
$port=3306;
$socket='';
$con=mysqli_connect($host,$username,$password,$db);
if($con){
//echo "hello";
}

#Query Function
function query($query){
  global $con;
  return mysqli_query($con,$query);
}

#Escape function
function escape($string){
  global $con;
  return mysqli_real_escape_string($con,$string);
}

#Fetch Data
function fetch_array($result){
  global $con;
  return mysqli_fetch_array($result);
}

#
function confirm($result){
  global $con;
  if(!$result){
    die("Query Failed".mysqli_error($con));
  }
}

#Row Count function
function row_count($result){
  return mysqli_num_rows($result);
}
 ?>
