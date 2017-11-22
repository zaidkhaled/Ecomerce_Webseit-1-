<?php


/*
** the main function globalGet to fetch info from database
*/

         
function globalGet($column, $table, $where, $and = NULL, $orderfield = NULL, $ordering = "DESC", $limit = NULL) {
    
    global $con;
    
    $limitQuery = $limit != NULL ? " LIMIT " . $limit: ""; 
    
    $orderQuery = $orderfield != NULL ? "ORDER BY " . $orderfield . " " . $ordering : "";
    
    
    $getAll = $con->prepare("SELECT $column FROM $table $where $and $orderQuery $limitQuery");
    
        
      $getAll->execute();
    
    if ($limit == NULL or $limit > 1){
        
         $all = $getAll->fetchAll();   
        
        
    } elseif ($limit == 1){
        
       $all = $getAll->fetch();  
        
    } 
    
    return $all;
     
}
    
/*
// function to get special INFO depent on tow values 
// it will be helpfull to give user ability to do something like ability to login and edit on item his own item
*/

function getSpecialInfo($table, $what, $what2 = NULL, $var1, $var2 = NULL){
    
    global $con;
        
    if ($what2 != NULL){
        
       $stmt = $con->prepare("SELECT * FROM $table WHERE $what = ? AND $what2 = ?");
        
       $stmt->execute ([$var1, $var2]);
     
    }  else {
        
        $stmt = $con->prepare("SELECT * FROM $table WHERE $what = ? ");
        
        $stmt->execute ([$var1]);
    }
    
       
    if (checkItem($what, $table, $var1) > 1){
        
      $all = $stmt->fetchAll(); 
        
    } else {
        
      $all= $stmt->fetch();
        
    }
    
    return $all;
    
}


/*
** Title function, which Echo the page title in case the page 
** has the variable $pageTitle  and Echo Defult Title for other pages
*/

 function gettitle() {
        
        global $pageTitle ;
        
        if(isset($pageTitle)) {
            
            echo $pageTitle;
            
        } else {
            
            echo "defult";
            
        }
    }


/*
** Redirect Function v1.0 [This Function Accept Parameters]
** $errorMsg = Echo the Error Message
** $seconds = seconds before Redirecting to anther page
** $url = Page Address
*/

function redirectPage($errmsg = "", $url = null, $seconds = 3){
    
    // this function will Echo success and faild Massege, faild Massege when there's an error Messege, but when there's success Messege then Echo success Messege.
    
    if (empty($errmsg)){ 
        
          echo "<div class= 'errmsg_php' style ='display:block'><p class= 'msg'>". lang("FAILED") ." ".lang("REDIRECTED" ) ." ". 
               $seconds ." ". lang("SECONDS")."</p><div>";
        
    }else {
        
        echo "<div class= 'succmsg_php' style ='display:block' ><p class= 'msg'>"." ". lang("SUCCESS") ." ".lang("REDIRECTED") .
             " ".$seconds ." ". lang("SECONDS")."</p><div>";
        
    }
    
    if ($url === null){
        
        $url = "index.php";
        
    } else {
        
        $url =isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== "" ? $_SERVER['HTTP_REFERER'] : "index.php";
        
    }
    
    header("refresh:$seconds;url=$url");
     
    exit();
}



/*
** check items Function v1.0
** function to check items in Database[function Accept Paremeters]
** $select = the item to select [Example: user, item, categories]
** $form = the table to selct from 
** $value = The value of select [ Example: Paul, Pic, Electronics]
*/

function checkItem($select, $from, $value) {
    
    global $con ;
    
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    
    $statement->execute([$value]);
    
    $count = $statement->rowCount();
    
    return $count;
    
}

/*
** Count Number of items Function v1.0
** function to count Numbers of rows
** $item = the Item to Count 
** $table = the Table to choose from 
*/

function countItems($item, $table){
    
      global $con;
     
      $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
      
      $stmt2->execute();
    
      return  $stmt2->fetchColumn();

}

/*
** function getLatest to print the last registerd users /////////
** $select <=> depend of which table////////////////
** $from   <=> which Table
** $order  <=> Descending depend of which Column
** $limit  <=> how many rows do I want to show
*/


function getLatest($select, $from, $order, $limit) {
    
    global $con ;
    
    $getStmt = $con->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit");
    
    $getStmt->execute();
    
    return $getStmt->fetchAll();
}


/*
** function getAll to bring all data from a specific table in database
** $select <=> depend of which column
** $from   <=> which Table
** $id     <=> where id not equal $id
*/




/*                 
// faction to give alternative, if value is empty.
*/

function ifEmpty($value, $msg) {
    
    $feedback = empty($value) || !isset($value) ? $msg : $value;
    
    return $feedback;
}





function getAll($select, $from, $id = NULL) {
    
    global $con ;
    
    
    
    if(!empty($id)){
        
       $getAll = $con->prepare("SELECT $select FROM $from WHERE userID != $id "); 
        
    } else {
        
        $getAll = $con->prepare("SELECT $select FROM $from");
        
    }
    
    
    
    $getAll->execute();
    
    return $getAll->fetchAll();
}

/*
// html funtions 
// functions for special department in the website 
*/

