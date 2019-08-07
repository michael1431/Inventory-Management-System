
<?php
include_once "./database/config.php";
session_start();

if(!isset($_SESSION["userid"])){
  header("location:".DOMAIN."/");
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
	<?php include './templates/header.php';?>
 	
 	<br><br>
 <div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card mx-auto" >
       <img class="card-img-top mx-auto" style="width: 60%" src="./images/user.png" alt="Card image cap">
       <div class="card-body">
        <h5 class="card-title">Profile Info</h5>
         <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION["username"]; ?></p>
         <p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
         <p class="card-text">Last Login: <?php echo $_SESSION["last_login"]; ?></p>
         <a href="editprofile.php?edit=<?php echo $_SESSION["userid"] ?>" class="btn btn-info"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
        </div>
      </div>

    </div>

    <div class="col-md-8">
      <div class="jumbotron" style="height: 100%; width: 100%" >

        <h1>Welcome Admin</h1>
        <div class="row">

          <div class="col-sm-6">
            
            <iframe src="http://free.timeanddate.com/clock/i6uv5ue2/n469/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>


          </div>
          <div class="col-sm-6">
            
             <div class="card">
                <div class="card-body">
                 <h5 class="card-title">New orders</h5>
                <p class="card-text">Here You Can Make Invoices And Create New Orders.</p>
               <a href="new_order.php" class="btn btn-primary">Order Now</a>
             </div>
           </div>

          </div>
          


        </div>
      </div>


    </div>



  </div>

</div>

<p></p>
<p></p>


      <div class="container">

        <div class="row">
          
          <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                 <h5 class="card-title">Categories</h5>
                <p class="card-text">Here You Can Manage And Add Your New Categories.</p>
               <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add</a>
                <a href="manage_category.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>

             </div>

          </div>
          <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                 <h5 class="card-title">Brand</h5>
                <p class="card-text">Here You Can Manage And Add Your New Brands.</p>
               <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add</a>
                <a href="manage_brand.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>

             </div>

          </div>
          <div class="col-md-4">
            
            <div class="card">
                <div class="card-body">
                 <h5 class="card-title">Products</h5>
                <p class="card-text">Here You Can Manage And Add Your New Products.</p>
               <a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add</a>
                <a href="manage_product.php" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Manage</a>
                </div>

             </div>

          </div>




        </div>
        


      </div>

<?php 
// code for category 
include './templates/category.php';

?>

<?php 
// code for brand 
include './templates/brand.php';

?>

<?php 
// code for products 
include './templates/products.php';

?>


 

</body>

</html>
