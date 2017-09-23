<?php 

 session_start();

$pageTitle = "Dashbord";

 if(isset($_SESSION['username'])){
        
        
       include "init.php"; 
        
       include $tpl. "header.php";     

       include $tpl."nav.php"; 
        
       include $tpl."footer.php"; 

 	
 } else {

 	header("Location:index.php");

 	exit();

 }