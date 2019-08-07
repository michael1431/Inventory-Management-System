<?php
include_once("User.php");

//include_once 'User.php';
//include 'DBoperation.php';

// code for registration
if(isset($_POST['username']) AND isset($_POST['email'])){

	$user = new User();

	$username = $_POST['username'];
	$email  = $_POST['email'];
	$password = $_POST['password1'];
	$usertype = $_POST['usertype'];

	$result = $user->createUserAccount($username,$email,$password,$usertype);
	echo $result;
	exit();

}

// code for login

/*
if(isset($_POST['login_email']) AND isset($_POST['login_password'])){
$user = new User();

$email = $_POST['login_email'];
$password = $_POST['login_password'];

$result = $user->userLogin($email,$password);
echo $result;
exit();


  }
*/


?>