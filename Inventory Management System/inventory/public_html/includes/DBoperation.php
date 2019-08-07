<?php 

 $filepath = realpath(dirname(__FILE__));
    
  include_once ($filepath.'/../database/Database.php');



class DBoperation
{
	
	private $db;

    public function __construct(){

    $this->db = new Database(); ///obj create
   }

// code  for add category

 public function addCategory($parent,$category){

   	$status = 1;

   	$query = "INSERT INTO tbl_category(parent_cat,category_name,status) VALUES('$parent','$category','$status')";

   	$result = $this->db->insert($query);

   	if($result){
   		return "CATEGORY_ADDED";
   	}else{
   		return 0;
   	}

   }


   // code for add brand

   public function addBrand($brand_name){

      $status = 1;

      $query = "INSERT INTO tbl_brand(brand_name,status) VALUES('$brand_name','$status')";

      $result = $this->db->insert($query);

      if($result){
         return "BRAND_ADDED";
      }else{
         return 0;
      }

   }


   // code for add new product

    public function addProduct($cid,$bid,$product_name,$product_price,$product_stock,$added_date){

      $status = 1;

      $query = "INSERT INTO tbl_product(cid,bid,product_name,product_price,product_stock,added_date,p_status) VALUES('$cid','$bid','$product_name','$product_price','$product_stock','$added_date','$status')";

      $result = $this->db->insert($query);

      if($result){
         return "NEW_PRODUCT_ADDED";
      }else{
         return 0;
      }

   }

   public function getAllCategory($table){
   	$query = "SELECT * FROM ".$table;
   	$result = $this->db->select($query);
   	$rows = array();
   	if($result->num_rows > 0){
   		while($row = $result->fetch_assoc()){
   			$rows[] = $row;
   		}
   		return $rows;

   	}else{
   		return "NO_DATA_FOUND";
   	}
   	}

      // code for get all brand

      public function getAllBrand($table){
      $query = "SELECT * FROM ".$table;
      $result = $this->db->select($query);
      $rows = array();
      if($result->num_rows > 0){
         while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
         return $rows;

      }else{
         return "NO_DATA_FOUND";
      }
      }


      // code for getsingle category for editing

   public function getSingleProduct($id){

    $query = "SELECT * FROM tbl_category WHERE cid = '$id' LIMIT 1";

    $result =$this->db->select($query);

    if($result->num_rows == 1){

        $row = $result->fetch_assoc();

    }
        return $row;

   }

   // update after getting data

   public function updateRecords($id,$name,$parent,$status){

   $query = "UPDATE tbl_category SET 

            category_name ='$name',
            parent_cat = '$parent',
            status ='$status'
            WHERE cid = '$id'";


     $getUpdate = $this->db->update($query);
     
     return $getUpdate;


   }

   // code for update Brand


   public function getSingleBrand($id){

    $query = "SELECT * FROM tbl_brand WHERE bid = '$id' LIMIT 1";

    $result =$this->db->select($query);

    if($result->num_rows == 1){

        $row = $result->fetch_assoc();

    }
        return $row;

   }


   public function updateBrandRecords($id,$bname,$status){

   $query = "UPDATE tbl_brand SET 

            brand_name ='$bname',
            status ='$status'
            WHERE bid = '$id'";


     $getBrandUpdate = $this->db->update($query);
     
     return $getBrandUpdate;


   }


      // code for getsingle Product for editing

   public function getProductById($id){

    $query = "SELECT * FROM tbl_product WHERE pid = '$id'";

    $result =$this->db->select($query);

    if($result->num_rows == 1){

        $row = $result->fetch_assoc();

    }
        return $row;

   }

   public function getUpdateProduct($id,$name,$cat,$brand,$price,$stock,$date){

      $query = "UPDATE tbl_product 
                SET 
                product_name = '$name',
                cid = '$cat',
                bid = '$brand',
                product_price ='$price',
                product_stock = '$stock',
                added_date = '$date'
                WHERE pid = '$id'";

        $result = $this->db->update($query);
        return $result;


   }



}


//$opr = new DBoperation();

//echo $opr->addCategory(1,"Television");
//echo "<pre>";
//print_r($opr->updateRecords());





?>