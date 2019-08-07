<?php
include_once "./database/config.php";
session_start();
if(isset($_SESSION["userid"])){
	
    session_destroy();
	
}
header("Location:".DOMAIN."/");

?>