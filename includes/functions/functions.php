<?php

/*
** function getCategory to fetch categories rows from database
*/


function getCate(){
    
    global $con;
    
    $stmt = $con->prepare('SELECT * FROM categories ORDER BY ID ASC');
    
    $stmt->execute();
    
    $cates = $stmt->fetchAll();
    
    return $cates;
    
}

function getSpecialInfo($where, $col, $id) {
    
    global $con;
    
    $stmt = $con->prepare("SELECT * FROM $where WHERE $col = ? LIMIT 1");
    
    $stmt->execute([$id]);
    
    $info = $stmt->fetch();
    
    return $info;
}

    
/*
** get comments of items Function v1.0
** function to get comment items in Database
** $select = the item to select [Example: user, item, categories]
** $form = the table to selct from 
** $value = The value of select [ Example: Paul, Pic, Electronics]
*/

function getSpecialComments($Item_ID) {
    
    global $con;
        
    $statement = $con->prepare("SELECT 
                                    comments.*,
                                    users.username as written_by
                                FROM 
                                    comments 
                                INNER JOIN
                                    users
                                ON
                                    users.userID = comments.Member_ID
                                WHERE 
                                    comments.Item_ID = :zitemID");
    
    $statement->bindParam(":zitemID", $Item_ID);
    $statement->execute();
    
    $rows = $statement->fetchAll();
    
    return $rows;
    
}
/*
** function to fetch items from category depent on Item_ID
*/

function getItems($Where, $ID) {
    
    global $con;
//    
//    if (!empty($userID)){
//        $query = "Member_ID";
//        $id = $userID;
//    } else {
//        $query = "Cate_ID";
//        $id = $Cate_ID;
//    }
    $items = $con->prepare("SELECT * FROM items WHERE $Where = ? ORDER BY Item_ID");
    
    $items-> execute([$ID]);
    
    return $items->fetchAll();
}

/*
** function to chek user status 
*/
function user_status($ID){
    
    global $con;
    
    $stmt = $con->prepare("SELECT userID, regStatus FROM users WHERE userID = ? AND regStatus = 0 ");
    
    $stmt ->excute ([$ID]);
    
    $count = $stmt->rowCount();
    
    return $count;
}


/*
** function getLatest to print the last registerd users /////////
** $select <=> depend of which table////////////////
** $from   <=> which Table
** $order  <=> Descending depend of which Column
** $limit  <=> how many rows do I want to show
*/

//
//function getLatest($select, $from, $order, $limit) {
//    
//    global $con ;
//    
//    $getStmt = $con->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit");
//    
//    $getStmt->execute();
//    
//    return $getStmt->fetchAll();
//}




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
    
    global $con;
        
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



