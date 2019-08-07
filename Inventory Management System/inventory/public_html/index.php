<?php
 include './includes/User.php';
if(isset($_SESSION["userid"])){
  header("location:".DOMAIN."/dashboard.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Inventory Management System</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/main.js"></script>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


	<?php 
  include './templates/header.php';
 
  

   ?>
 	
 	<br><br>
 	<div class="container">

    <?php
    // code for get registration successful msg

    if(isset($_GET["msg"]) && !empty($_GET["msg"])){
      ?>
      <div class="alert alert-success alert-dismissible fade show" style="text-align: center;" role="alert">
        <?php echo $_GET["msg"] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>
     </div>

      <?php
    }

    ?>

<?php
   // code for login 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

$user = new User();

$email = $_POST['login_email'];
$password = $_POST['login_password'];

$result = $user->userLogin($email,$password);


}

?>



	<div class="card mx-auto" style="width: 18rem;">
  <img class="card-img-top mx-auto" src="./images/login.png" style="width: 60%"  alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title text-primary" style="text-align: center; font-weight: bold">Log In</h5>

  <?php 

  if(isset($result)){
    echo $result;
  }
  ?>

  <form method="post" action="">
  <div class="form-group">
    <label for="login_email">Email address</label>
    <input type="email" class="form-control" name="login_email" id="login_email" placeholder="Enter email">
    <small id="email_error" class="form-text text-muted">We'll Never Share Your Email</small>
   
  </div>
  <div class="form-group">
    <label for="login_password">Password</label>
    <input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password">
     <small id="pass_error" class="form-text text-muted"></small>

  </div>
 
  <button type="submit" name="login" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Submit</button>
  <span> <a href="register.php">Register Now</a></span>
</form>
   
  </div>
  <div class="card-footer">
  	<span><a href="#">Forget Password ?</a></span>
  </div>
 </div>

</div>

</body>

</html>