<?php
// switch languages depent on $_POST["lang"] and $_COOKIE['lang'].

if (isset($_POST["lang"])) {
    
    setcookie("lang", $_POST["lang"], time() + (3600 * 24 * 30 * 12), "/");
    
    $_SESSION['lang'] = $_POST["lang"];
    
    $lang_selected = $_POST["lang"];
    
} elseif (isset($_COOKIE['lang'])) {
    
    $lang_selected = $_COOKIE['lang'];
    
}

$tpl ="includes/templates/";// include templates Directory
 
$lang ="includes/languages/"; // // languages Directory

$func ="includes/functions/"; // // languages Directory

$conn ="connect.php"; //connect file

$js ="layout/js/"; //js Directory

$css ="layout/css/"; // Css  Directory

$src_lang = !isset($lang_selected)?  "Eng" : $lang_selected ;

include $lang . $src_lang . ".php";

//Include the importent files

 include $conn; // then connect Database 

 include $func."functions.php";


// disable errors msgs

define('DEBUG', true);

error_reporting(E_ALL);
ini_set('display_errors', DEBUG ? 'On' : 'Off');
?>