
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
    <script type="text/javascript" src="./js/order.js"></script>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<?php include './templates/header.php';?>
 	
 	<br><br>
 <div class="container">
    <div class="row">

      <div class="col-md-10 mx-auto">
        
          <div class="card" style="box-shadow: 0 0 25px 0 lightgray;">
          <div class="card-header">
                   <h4>New Orders</h4>
          </div>
          <div class="card-body">

            <form id="get_order_data" onsubmit="return false">
              
              <div class="form-group row">

                <label class="col-sm-3 col-form-label" align ="right">Order Date</label>

                  <div class="col-sm-6">
                    
                    <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">

                  </div>
                

              </div>


              <div class="form-group row">

                <label class="col-sm-3 col-form-label" align ="right">Customer Name*</label>

                  <div class="col-sm-6">
                    
                    <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" placeholder="Enter Customer Name" required="">

                  </div>
                

              </div>

                <div class="card" style="box-shadow: 0 0 15px 0 lightgray;">
                  
                  <div class="card-body">
                    <h3>Make a order list</h3>

                    <table align="content" width="800px;">

                      <thead>
                        
                        <th>SL.NO</th>
                        <th style="text-align: center;">Item Name</th>
                        <th style="text-align: center;">Total Quantity</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Price</th>
                        <th>Total</th>

                      </thead>

                      <tbody id="invoice_item">



                        
                        
                      </tbody>

                    </table>

                    <center style="padding: 10px;">
                      
                      <button id="add" style="width: 150px;" class="btn btn-success">Add</button>

                       <button id="remove" style="width: 150px;" class="btn btn-danger">Remove</button>
                    </center>

                  </div><!-- card body ends -- >

                </div><!-- Order list card ends -->


                <p></p>

                <div class="form-group row">
                  <label for = "sub_total" class="col-sm-3 col-form-label" align ="right">Sub Total</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total" readonly="">

                  </div>

                </div>


                <div class="form-group row">
                  <label for = "gst" class="col-sm-3 col-form-label" align ="right">GST(18%)</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="gst" class="form-control form-control-sm" id="gst" readonly="">

                  </div>

                </div>


                <div class="form-group row">
                  <label for = "discount" class="col-sm-3 col-form-label" align ="right">Discount</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="discount" class="form-control form-control-sm" id="discount" required="">

                  </div>

                </div>

                <div class="form-group row">
                  <label for = "net_total" class="col-sm-3 col-form-label" align ="right">Net Total</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="net_total" class="form-control form-control-sm" id="net_total" readonly="">

                  </div>

                </div>

                <div class="form-group row">
                  <label for = "paid" class="col-sm-3 col-form-label" align ="right">Paid</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="paid" class="form-control form-control-sm" id="paid" required="">

                  </div>

                </div>

                <div class="form-group row">
                  <label for = "due" class="col-sm-3 col-form-label" align ="right">Due</label>

                  <div class="col-sm-6">
                    
                    <input type="text" name="due" class="form-control form-control-sm" id="due" readonly="">

                  </div>

                </div>


                <div class="form-group row">
                  <label for = "payment_type" class="col-sm-3 col-form-label" align ="right">Payment Method</label>

                  <div class="col-sm-6">
                    
                    <select name="payment_type" class="form-control form-control-sm" id="payment_type" required="">

                              <option>Cash</option>
                              <option>Card</option>
                              <option>Draft</option>
                              <option>Cheque</option>
                              
                   </select>

                  </div>

                </div>



               <center style ="padding-bottom: 10px;">
                     
                <input type="submit" id="order_form" style="width: 150px;" class="btn btn-info" value="Order">
                
                <input type="submit" id="print_invoice" style="width: 150px;" class="btn btn-success d-none" value="Print Invoice">


              </center>

            </form>

          </div>

        </div>


      </div>
      


    </div>


  </div>

</body>

</html>
