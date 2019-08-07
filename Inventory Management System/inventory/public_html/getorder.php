
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
    $orders = $mng->getAllOrders() ;
    ?>
    
 
    <table class="table table-hover table-bordered" id="example">
      <thead>
        <tr>
          <th>Invoice NO.</th>
          <th>Customer Name</th>
          <th>Order Date</th>
          <th>Sub Total</th>
          <th>Gst</th>
          <th>Discount</th>
          <th>Net Total</th>
          <th>Paid</th>
          <th>Due</th>
          <th>Payment Type</th>
        </tr>
      </thead>
      <tbody>
        <?php
             if($orders){
             $i = 0;
             while ($result = $orders->fetch_assoc()) {
             $i++;
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['customer_name'];?></td>
                <td><?php echo $result['order_date'];?></td>
                <td><?php echo $result['sub_total'];?></td>
                <td><?php echo $result['gst'];?></td>
                <td><?php echo $result['discount'];?></td>
                <td><?php echo $result['net_total'];?></td>
                <td><?php echo $result['paid'];?></td>
                <td><?php echo $result['due'];?></td>
                <td><?php echo $result['payment_type'];?></td>
            
                                                   
            </tr>
             <?php }} ?>
             </tbody>
             <tfoot>
                 <tr class="btn-primary text-center">
                     <td></td>
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
       

          <script>
         $(document).ready(function(){
                 $('#example').DataTable();
           });
     </script>
             
</body>

</html>
