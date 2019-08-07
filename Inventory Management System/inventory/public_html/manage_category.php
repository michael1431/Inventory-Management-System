
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
    $categories = $mng->manageCategories("tbl_category");
    ?>
    
   <?php
  
    // code for delete category
    
     if(isset($_GET['delcat'])){
    // category delete from category tbl
    $mng = new Manage();
    $delcat = $_GET['delcat'];
    $delCategory = $mng->deleteCategory($delcat);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
     }
   ?> 

 
    <table class="table table-hover table-bordered" id="example">
      <thead>
        <tr>
          <th>SL NO.</th>
          <th>Category</th>
          <th>Parent</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
             if($categories){
             $i = 0;
             while ($result = $categories->fetch_assoc()) {
             $i++;
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['category']; ?></td>
                <td><?php echo $result['parent']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $result['cid']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 
                    <a href="#" data-toggle="modal" data-target="#update_category" eid="<?php echo $result['cid']; ?>" class="btn btn-info btn-sm edit_cat"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
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
                 </tr>
             </tfoot>
         </table>
   
                         </div>
                     </div>      
                 </div>
             </div>            
         </div>
         <?php include_once("./templates/update_category.php")?>

          <script>
         $(document).ready(function(){
                 $('#example').DataTable();
           });
     </script>
             
</body>

</html>
