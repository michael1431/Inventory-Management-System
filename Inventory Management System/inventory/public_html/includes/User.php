<?php
    // file er path ta nite hobe age otherwise load hobe na
    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/../database/Database.php');

    session_start();
   

   //include '/../database/Database.php';


?>


<?php

class User{


 private $db;

 public function __construct(){
    $this->db = new Database(); ///obj create
   }

   // check email exist or not 

   private function emailExist($email){
   	$query = "SELECT * FROM tbl_user WHERE email ='$email' LIMIT 1";
   	$chkEmail = $this->db->select($query);
   	if($chkEmail){
   		return true;
   	}else{
   		return false;
   	}
   }

  public function createUserAccount($username,$email,$password,$usertype){

  	if($this->emailExist($email)){
  		return "Email Already Exists";
  	}else{
  		$password = md5($password);
  		$register_date = date("Y-m-d");
  		$last_login = date("Y-m-d");
  		$notes = "";
  		$query ="INSERT INTO tbl_user(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES('$username','$email','$password','$usertype','$register_date','$last_login','$notes')";
  		$insert_data = $this->db->insert($query);
  		if($insert_data){
  			//$msg = "<span class='success'>Registration Completed successfully</span>";
                  return $insert_data;
  		}else{
  			return "SOME_ERROR";
  		}
  	}

  }


  // User Login 

  public function userLogin($email,$password){

    if($email == "" || $password == ""){
    	$msg = "<span style='color:red;font-weight:bold; text-align:center;'>Field Must Not Be Empty!!!</span>";
                return $msg;
    }

  	$query = "SELECT id,username,password,last_login FROM tbl_user WHERE email = '$email'";

  	$result = $this->db->select($query);

  	if($result == false){
  		$msg = "<span style='color:red;font-weight:bold; text-align:center;'>You Are Not Registered Yet!!!</span>";
                return $msg;
  		// return "NOT_REGISTERED";
  	}else{

  		$password = md5($password);
  		$row = $result->fetch_assoc();

  		if($password == $row["password"]){
        
        $_SESSION["userid"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["last_login"] = $row["last_login"]; 

  			$last_login = date("Y-m-d h:m:s");
  			$up_query = "UPDATE tbl_user SET last_login = '$last_login' WHERE email = '$email'";

  			$value = $this->db->update($up_query);

  			if($value){

          //return 1;
          
            header("Location:dashboard.php");
  				
  			}else{
  				return 0;
  			}


  		}else{
  			$msg = "<span style='color:red;font-weight:bold;text-align:center'>Your Password Is Incorrect!!!</span>";
              return $msg;
  			// return "PASSWORD_NOT_MATCHED";

  		}
  	}




  }



 


}

?>



