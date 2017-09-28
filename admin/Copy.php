<?php 

session_start();

$pageTitle  = "cate";

if(isset($_SESSION['username'])){
       
     $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
    
    include "init.php";

    $pageTitle = "Members";

    include $tpl. "header.php";

     include $tpl. "nav.php"; 
    
    
    
    
    
    include $tpl."footer.php"; 
        
        

 	
 } else {

 	header("Location:index.php");

 	exit();

 }
?>