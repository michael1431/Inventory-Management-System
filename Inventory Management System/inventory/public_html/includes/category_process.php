<?php

  include_once("DBoperation.php");

  // code for category fetch

  if(isset($_POST["getCategory"])){

  	$obj = new DBoperation();
  	$rows = $obj->getAllCategory("tbl_category");

  	foreach ($rows as $row) {
  		
  		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
  	
  	}
  	exit();
  }


  // code for fetch brand

   if(isset($_POST["getBrand"])){

    $obj = new DBoperation();
    $rows = $obj->getAllBrand("tbl_brand");

    foreach ($rows as $row) {
      
      echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
    
    }
    exit();
  }


  // code for adding category 

  if(isset($_POST["category_name"]) AND isset($_POST["parent_cat"])){

    $obj = new DBoperation();
    $parent = $_POST["parent_cat"];
    $category = $_POST["category_name"];
    $result = $obj->addCategory($parent,$category);
    echo $result;
    exit();
  }

  // code for adding brand

  if(isset($_POST["brand_name"])){

    $obj = new DBoperation();
    $brand_name = $_POST["brand_name"];
    $result = $obj->addBrand($brand_name);
    echo $result;
    exit();
  }

  // code for adding product

  if(isset($_POST["added_date"]) AND isset($_POST["product_name"])){

    $obj = new DBoperation();
    $cid = $_POST["select_cat"];
    $bid = $_POST["select_brand"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_stock = $_POST["product_qty"];
    $added_date = $_POST["added_date"];
    $result = $obj->addProduct($cid,$bid,$product_name,$product_price,$product_stock,$added_date);
    echo $result;
    exit();
  }



  // code for edit category
 if(isset($_POST["updateCategory"])){

    $obj = new DBoperation();
    $result = $obj->getSingleProduct($_POST["id"]);
    echo json_encode($result);
    exit();
  }

  // update category after getting data

  if(isset($_POST["update_categoryname"])){

    $obj = new DBoperation();

    $id = $_POST["cid"];

    $name = $_POST["update_categoryname"];

    $parent = $_POST["parent_cat"];

    $status = 1;

    $result = $obj->updateRecords($id,$name,$parent,$status);

    echo $result; 
    

  }

  // code for edit brand

  if(isset($_POST["updateBrand"])){

    $obj = new DBoperation();
    $result = $obj->getSingleBrand($_POST["id"]);
    echo json_encode($result);
    exit();
  }

  // update brand after getting data

  if(isset($_POST["update_brandname"])){

    $obj = new DBoperation();

    $id = $_POST["bid"];

    $bname = $_POST["update_brandname"];

    $status = 1;

    $result = $obj->updateBrandRecords($id,$bname,$status);

    echo $result; 
    

  }


  // code for update Product
if(isset($_POST["updateProduct"])){

    $obj = new DBoperation();
    $id = $_POST["id"];
    $result = $obj->getProductById($id);
    echo json_encode($result);
    exit();
  }

  // code for update product after getting data

  if(isset($_POST["update_productname"])){

      $obj = new DBoperation();

      $id  = $_POST["pid"];
      $name = $_POST["update_productname"];
      $cat = $_POST["select_cat"];
      $brand = $_POST["select_brand"];
      $price  = $_POST["product_price"];
      $stock = $_POST["product_qty"];
      $date = $_POST["added_date"];
      $updatePro = $obj->getUpdateProduct($id,$name,$cat,$brand,$price,$stock,$date);
      echo $updatePro;

  }

  

    



  

?>