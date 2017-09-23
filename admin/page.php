<?php
/*
Categories = [Mange | Edit | Update | Add | Insert | Delete | stats]
*/

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

// If the page is main Page

if($do == 'Mange') {
    
    echo "welcome you are in Mange category Page";
    
    echo  " : ".'<a href="?do=insert">Add New Category +</a>';
    
}elseif ($do == 'add') {
    
    echo 'Welcome you are in add Page';
    
}elseif ($do = 'insert') {
    
    echo 'Welcome you are in Insert Category Page';
    
}else {
    
    echo "Erorr there\'s no Page with Name";
    
}