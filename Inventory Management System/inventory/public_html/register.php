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
     <link rel="stylesheet" type="text/css" href="./includes/style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  
  <div class="overlay"><div class="loader"></div></div>

  <?php include './templates/header.php'; ?>
  
  <br><br>
  <div class="container">

    <div class="card mx-auto" style="width: 30rem;">
    <div class="card-header text-danger" style="text-align: center; font-weight: bold; font-size: 30px;">Registration Form</div>
  <div class="card-body">

    <form id="register_form" onsubmit="return false" autocomplete="off">
      
       <div class="form-group">
        <label for="username">Full Name</label>
         <input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username">
         <small id="u_error" class="form-text text-muted"></small>
       </div>


       <div class="form-group">
        <label for="email">Email Address</label>
         <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
          <small id="e_error" class="form-text text-muted"></small>
       </div>

       <div class="form-group">
        <label for="password1">Password</label>
         <input type="password" class="form-control" name="password1" id="password1" placeholder="Enter Your Password">
          <small id="p1_error" class="form-text text-muted"></small>
       </div>


       <div class="form-group">
        <label for="password2">Re-Enter Password</label>
         <input type="password" class="form-control" name="password2" id="password2" placeholder="Re-Enter Your Password">
          <small id="p2_error" class="form-text text-muted"></small>
       </div>


       <div class="form-group">
        <label for="usertype">Usertype</label>
         <select name="usertype" id="usertype" class="form-control">
            <option value="">Choose Usertype</option>
           <option value="1">Admin</option>
           <option value="0">Others</option>
         </select>
          <small id="t_error" class="form-text text-muted"></small>
       </div>

       <button type="submit" name="user_register" class="btn btn-primary">
         <span class="fa fa-user">&nbsp;</span>Register
       </button>
       <span><a href="index.php">Login</a></span>

    </form>
    
    
  </div>

    <div class="card-footer text-muted">
      
    </div>
   </div>

 </div>

</body>

</html>