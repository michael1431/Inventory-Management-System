
  <?php
  //include_once "./database/config.php";
  include_once"./includes/Manage.php";
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
   <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/manage.js"></script>
 
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    


</head>
<body>
  <?php include './templates/header.php';?>
  
  <br><br>
  
  <div class="container">

    <?php
   
    $mng = new Manage();
    $brand = $mng->manageBrand();
    ?>
    
   <?php
  
    // code for delete Brand
    
     if(isset($_GET['delbrand'])){
    // category delete from category tbl
    $mng = new Manage();
    $delcat = $_GET['delbrand'];
    $delCategory = $mng->deleteBrand($delcat);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
     }
   ?> 

 
    <table class="table table-hover table-bordered" id="example">
      <thead>
        <tr>
          <th>SL NO.</th>
          <th>Brand</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
             if($brand){
             $i = 0;
             while ($result = $brand->fetch_assoc()) {
             $i++;
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a onclick="return confirm('Are you sure to delete')" href="?delbrand=<?php echo $result['bid']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_brand" bid="<?php echo $result['bid']; ?>" class="btn btn-info btn-sm edit_brand"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>
             <?php }} ?>
             </tbody>
             <tfoot>
                 <tr class="btn-danger text-center">
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                                                     
                 </tr>
             </tfoot>
         </table>
   
                         </div>
                     </div>      
                 </div>
             </div>            
         </div>
         <?php include_once("./templates/update_brand.php")?>

          <script>
         $(document).ready(function(){
                 $('#example').DataTable();
           });
     </script>
             
</body>

</html>
