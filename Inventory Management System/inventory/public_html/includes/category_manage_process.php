
<?php

  include_once("Manage.php");

  //include_once("DBoperation.php");
    
/*
  if(isset($_POST["manageCategory"])){

  	$mng = new Manage();
  	$result = $mng->manageCategories("tbl_category");

  	$rows = $result["rows"];
  	if(count($rows) > 0){

  		$i = 0;

  		foreach ($rows as $row) {
  			?>

  		  <tr>
          <td><?php echo ++$i; ?></td>
          <td><?php echo $row["category"]?></td>
          <td><?php echo $row["parent"]?></td>
          <td><a href="" class="btn btn-success btn-sm">Active</a></td>
          <td>
             <a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $row["cid"]; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a> 

              <a href="#" data-toggle="modal" data-target="#update_category_form" eid="<?php echo $row['cid']; ?>" class="btn btn-info btn-sm edit_cat"><i class="fa fa-edit">&nbsp;</i>Edit</a>
          </td>
          </tr>


  			<?php

  		}
  	} 
 exit();

  
  }*/

  // code for delete category

  /*if(isset($_POST["delCategory"])){
  	$mng = new Manage();
  	$id = $_POST["id"];
  	$result = $mng->deleteCategory("tbl_category",$id);
  	echo $result;
  	exit();
  }*/

// code for order 


  if(isset($_POST["getNewOrderItem"])){

    $mng = new Manage();

    $result = $mng->manageProduct();

    ?>
        <tr>
                          
                          <td><b class="number">1</b></td>
                          <td>
                            <select name="pid[]" class="form-control form-control-sm pid" required="">
                              <option value="">Choose Product</option>
                              <?php

                                foreach($result as $row){

                                  ?>
                                  <option value="<?php echo $row['pid'];?>"><?php echo $row["product_name"];?></option>

                                <?php } ?>
                              
                            </select>

                          </td>


                          <td>
                            <input type="text" readonly="" name="tqty[]" class="form-control form-control-sm tqty">
                          </td>

                          <td>
                            <input type="text"  name="qty[]" class="form-control form-control-sm qty" required="">
                          </td>

                           

                          <td>
                            
                            <input type ="text" name="price[]" class="form-control form-control-sm price" readonly="">

                         <span><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"/></span>

                       </td>   
                          <td>Rs.<span class="amt">0</span></td>

                        </tr>



    <?php

    exit();
 
}

// get price and quantity of one item

if(isset($_POST["getPriceAndQty"])){

  $obj = new DBoperation();

  $id = $_POST["id"];

  $result = $obj->getProductById($id);

  echo json_encode($result);
  exit();

}


// code for accepting order

if(isset($_POST["order_date"]) AND isset($_POST["cust_name"])){

  $order_date = $_POST["order_date"];
  $cust_name = $_POST["cust_name"];

  // Now code for getting array 

  $ar_tqty = $_POST["tqty"];
  $ar_qty = $_POST["qty"];
  $ar_price = $_POST["price"];
  $ar_pro_name = $_POST["pro_name"];



  $sub_total = $_POST["sub_total"];
  $gst = $_POST["gst"];
  $discount = $_POST["discount"];
  $net_total =  $_POST["net_total"];
  $paid =  $_POST["paid"];
  $due =  $_POST["due"];
  $payment_type = $_POST["payment_type"];

  $mng = new Manage();

  $result = $mng->getCustomerOrder($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);

  echo $result;


}

?>