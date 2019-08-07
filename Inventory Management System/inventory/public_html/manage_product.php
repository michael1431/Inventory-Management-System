
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
    $product = $mng->manageProduct();
    ?>
    
   <?php
  
    // code for delete Product
    
     if(isset($_GET['delproduct'])){
    // delete product from product table
    $mng = new Manage();
    $delpro = $_GET['delproduct'];
    $delproduct = $mng->deleteProduct($delpro);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
     }
   ?> 

 
    <table class="table table-hover table-bordered" id="example">
      <thead>
        <tr>
          <th>SL NO.</th>
          <th>Product</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Added Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
             if($product){
             $i = 0;
             while ($result = $product->fetch_assoc()) {
             $i++;
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['product_name']; ?></td>
                 <td><?php echo $result['brand_name']; ?></td>
                 <td><?php echo $result['category_name']; ?></td>
                 <td><?php echo $result['product_price']; ?></td>
                 <td><?php echo $result['product_stock']; ?></td>
                 <td><?php echo $result['added_date']; ?></td>
                 <td>

                  <?php 
                  if($result['p_status']==1){
                    ?>
                    <a href="#" class="btn btn-success btn-sm">Active</a>
                    <?php }else{ ?>

                       <a href="#" class="btn btn-warning btn-sm">Inactive</a>
                 <?php   } ?>
                 
                    

                  </td>
                <td>
                    <a onclick="return confirm('Are you sure to delete')" href="?delproduct=<?php echo $result['pid']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_product" eid="<?php echo $result['pid']; ?>" class="btn btn-info btn-sm edit_product"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
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
                     <td></td>
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
         <?php include_once("./templates/update_product.php")?>

          <script>
         $(document).ready(function(){
                 $('#example').DataTable();
           });
     </script>
             
</body>

</html>
