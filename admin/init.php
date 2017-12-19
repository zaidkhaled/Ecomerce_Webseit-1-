<?php

$tpl ="includes/templates/";// include templates Directory
 
$lang ="includes/languages/"; // // languages Directory

$func ="includes/functions/"; // // languages Directory

$conn ="connect.php"; //connect file

$js ="layout/js/"; //js Directory

$css ="layout/css/"; // Css  Directory



//Include the importent files

 include $conn; // then connect Database 

 include $func."functions.php";

 include $lang."Eng.php";

// disable errors msgs

define('DEBUG', true);

error_reporting(E_ALL);
ini_set('display_errors', DEBUG ? 'On' : 'Off');
?>