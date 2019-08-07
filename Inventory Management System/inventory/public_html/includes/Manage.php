<?php

include 'DBoperation.php';
//$filepath = realpath(dirname(__FILE__));
    
//include_once ($filepath.'/../database/Database.php');


class Manage
{
	private $db;

    public function __construct(){

    $this->db = new Database(); ///obj create
   }



   public function manageCategories($table){

   	if($table == "tbl_category"){

   		$query = "SELECT p.cid,p.category_name as category, c.category_name as parent, p.status FROM tbl_category p LEFT JOIN tbl_category c ON p.parent_cat = c.cid";

   	}

   	$result = $this->db->select($query);
   	if($result){
   		//while ($row = $result->fetch_assoc()) {
   			//$rows[] = $row;
    
   		}
        return $result;
   		//return ["rows"=>$rows];
   	}
   

   /*public function deleteCategory($table,$id){

      if($table == "tbl_category"){

      $query = "SELECT cid FROM tbl_category WHERE parent_cat = '$id'";
      $result = $this->db->select($query);
      if($result){
        return "DEPENDENT_CATEGORY";
      }else{
        $query = "DELETE FROM ".$table." WHERE cid = '$id'";
        $result = $this->db->delete($query);
        if($result){
          return "CATEGORY_DELETED";
        }
      }
    }else{
        $query = "DELETE FROM ".$table." WHERE cid = '$id'";
        $result = $this->db->delete($query);
        if($result){
          return "DELETED";
        }
      }

}*/

public function deleteCategory($delcat){

  $query = "DELETE FROM tbl_category WHERE cid = '$delcat'";
  $del = $this->db->delete($query);
  return $del;

   }

   // fetch all brand

    public function manageBrand(){

      $query = "SELECT * FROM tbl_brand ";
    $result = $this->db->select($query);
    if($result){
      //while ($row = $result->fetch_assoc()) {
        //$rows[] = $row;
    
      }
        return $result;
      //return ["rows"=>$rows];
    }

    // delete brand


   public function deleteBrand($delbrand){

  $query = "DELETE FROM tbl_brand WHERE bid = '$delbrand'";
  $del = $this->db->delete($query);
  return $del;

   }


   public function manageProduct(){

       $query = "SELECT p.*,c.category_name,b.brand_name
                  FROM tbl_product as p,tbl_category as c,tbl_brand as b
                  WHERE p.cid = c.cid AND p.bid = b.bid
                  ORDER BY p.pid DESC";

    $result = $this->db->select($query);
    return $result;

   }

   public function deleteProduct($delpro){

  $query = "DELETE FROM tbl_product WHERE pid = '$delpro'";
  $delpro = $this->db->delete($query);
  return $delpro;

   }


   // code for getting customer order

   public function getCustomerOrder($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){

      // if(empty($cust_name)||empty($paid)||empty($payment_type)){
          // return "missing";
       //}else{

    $key    = substr(md5(uniqid(rand(0,9), true)),4,4);  


    $query  = "INSERT INTO `invoice`(`ck_key`,`customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES ('$key','$cust_name','$order_date','$sub_total','$gst','$discount','$net_total','$paid','$due','$payment_type')";
    $result = $this->db->insert($query);

    //$getInvoice = "SELECT * FROM invoice";

    $getInvoice = "SELECT * FROM invoice WHERE ck_key='$key'";

    $row = $this->db->select($getInvoice)->fetch_assoc();
      
    $invoice_no = $row['invoice_no'];

    if($invoice_no!=null){

      for($i=0;$i<count($ar_price);$i++){


        // calculate the remaining quantity

        $remain_qty = $ar_tqty[$i]-$ar_qty[$i];

         if($remain_qty<0){

                        return "Not_Available";
          }else{

            // update product table when qunatity will be decreased

            $query ="UPDATE `tbl_product` 
                                 SET 
                                `product_stock`='$remain_qty'
                                 WHERE product_name='$ar_pro_name[$i]'";
                        $quantityUpdt = $this->db->update($query);
                        
          }

          if($remain_qty==0){
            // code for status update from product table
                            $squery ="UPDATE `tbl_product` 
                                     SET 
                                    `p_status`= '0'
                                     WHERE product_name='$ar_pro_name[$i]'";
                            $statusUpdt = $this->db->update($squery);                        
                           } 


         $innerquery = "INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES ('$invoice_no','$ar_pro_name[$i]','$ar_price[$i]','$ar_qty[$i]')"; 
         $result = $this->db->insert($innerquery); 



       }

      

      return $invoice_no;

      }

      } 



      // code for get all orders


       public function getAllOrders() {
        $query = "SELECT * FROM invoice";
        $result = $this->db->select($query);
        return $result; 
      }



    // for low products used in dashboard
   public function getProductStocks(){
        $query = "SELECT * FROM tbl_product WHERE product_stock<=10 AND p_status=1";
        $result = $this->db->select($query);
        return $result; 
   }

   // get customer order details

   public function getCustomerOrderDetails(){
        $query = "SELECT i.*,d.qty,d.product_name,d.price
            FROM invoice as i,invoice_details as d
            WHERE i.invoice_no = d.invoice_no
            ORDER BY i.invoice_no DESC";
        $result = $this->db->select($query);
        return $result;  
   }

   // user profile show

    public function userData($id){
        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;        
    }




    // code for update username

     public function userUpdate($uName,$id){
      
      if(empty($uName)){
            $msg = "<span style='color:red;font-weight:bold'>Fields must not be empty</span>";
            return $msg;
      }else{
             $query = "UPDATE tbl_user
                       SET    
                       username   = '$uName'

                       WHERE id  = '$id'";

            $userupdate = $this->db->update($query);
            if ($userupdate) {
                header("Location: editprofile.php");
                //$msg = "<span style='color:green;font-weight:bold'>User Updated successfully</span>";
                //return $msg;
            } else {
                echo "<script>alert(Something Wrong)</script>";
                //$msg = "<span style='color:red;font-weight:bold'>Update has been failed</span>";
                //return $msg;
            }
        }

    }
    

  public function changePassword($id,$new_password){
  
        if(empty($new_password)){
            $msg = "<span style='color:red;font-weight:bold'>Password must not be empty</span>";
            return $msg;
        }else{
               $query = "UPDATE tbl_user
                         SET    
                         password  = '$new_password' 
                         WHERE id  = '$id'";

            $passwordupdate = $this->db->update($query);
                       
            if ($passwordupdate) {
               // header("Location: editprofile.php");
                $msg = "<span style='color:green;font-weight:bold'>Password Updated successfully</span>";
                return $msg;
            } else {
                $msg = "<span style='color:red;font-weight:bold'>Password update is failed</span>";
                return $msg;
            }            
        }
    }

    

  }


//$obj = new Manage();
//echo $obj->deleteCategory("tbl_category","cid",7);

//echo "<pre>";
//print_r($obj->getSingleProduct("tbl_category","cid",1));




?>