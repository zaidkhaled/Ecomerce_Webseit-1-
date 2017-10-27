 <?php 
 ob_start();
 session_start();

 $pageTitle = "shop-online";

 include "init.php"; 

 include $tpl."header.php";
 include $tpl."nav.php";


include $tpl."footer.php";
 ob_end_flush();
?>