<?php

$dsn ="mysql:host=localhost;dbname=shop";

$userdb= "root";

$pass="";

$opt=[PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

try {//try to connecting
    
    
    $con = new PDO($dsn, $userdb, $pass, $opt);
//    global $con;
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) { //catch an Erorr if exist
    
    echo "failed to connect" ."<br>".$e->getMessage();
    
}
//$dsn ="mysql:host=fdb17.biz.nf;dbname=2411626_zaid";
//
//$userdb= "2411626_zaid";
//
//$pass="aliali123aliali";
//
//$opt=[PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
//
//try {//try to connecting
//    
//    
//    $con = new PDO($dsn, $userdb, $pass, $opt);
////    global $con;
//    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
//
//catch(PDOException $e) { //catch an Erorr if exist
//    
//    echo "failed to connect" ."<br>".$e->getMessage();
//    
//}
?>