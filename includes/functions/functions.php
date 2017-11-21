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
                                    comments.Item_ID = :zitemID
                                    ORDER BY `Comment_Data` DESC");
    
    $statement->bindParam(":zitemID", $Item_ID);
    $statement->execute();
    
    $rows = $statement->fetchAll();
    
    return $rows;

}
/*
// function to get special INFO depent on tow values 
// it will be helpfull to give user ability to do something like ability to login and edit on item his own item
*/

function getSpecialInfo($table, $what, $what2 = NULL, $var1, $var2 = NULL, $value = NULL){
    
    global $con;
        
    $query = empty($value) ? " " : $value ;
        
    if ($what2 != NULL){
        
       $stmt = $con->prepare("SELECT * FROM $table WHERE $what = ? AND $what2 = ? $query ");
        
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
** function to fetch items from category depent on Item_ID
*/

function getItems($Where, $ID) {
    
    global $con;

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

function redirectPage($msg, $url = null, $seconds = 3){
    
     echo "<div class= 'succmsg_php center-align' style ='display:block'> 
     
             <p class= 'msg'>" . " " . $msg . " " .lang("REDIRECTED") . " " .$seconds . " " . lang("SECONDS") . "</p>
           <div>";
 
    
    if ($url === null){
        
        $url = "index.php";
        
    }
    
    header("refresh:$seconds ; url=$url");
     
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


function home_items() {
    
    foreach (globalGet("*", "items", "WHERE approve != 0", "", "Item_ID", "DESC", "") as $item){  ?>

             <div class="col s12 m4">
               <div class="card"> 
                 <div class="card-image waves-effect waves-block waves-light">
                  <?php 
                    $img = empty($item["Main_Foto"]) ? "foto1.jpg" : $item["Main_Foto"];
                    ?>           
                  <img class="activator" src="uplaodedFiles/itemsFotos/<?php echo $img; ?>">
                 </div>
                 <div class="card-content">
                  <!-- check if user has ability to edit and delete this item -->     
                  <?php if (isset($_SESSION["ID"]) && $item["Member_ID"] == $_SESSION["ID"]) { ?>    
                   <div class="row profile-item-icons">   
                   <!--Delete Butten-->
                     <a class='modal-trigger' 
                        href="#modal<?php echo $item['Item_ID'];?>"
                        onclick= "$('.modal').modal();"
                        >
                       <i class='material-icons right'>delete_forever</i>
                     </a><!--Delete Butten-->   
                     <a href ="item.php?name=<?php echo $item['Name']; ?>&ID=<?php echo $item['Item_ID']; ?>&do=edit-item"> 
                       <i class="material-icons right">edit</i> 
                    </a>     
                   </div>
                   <?php } ?> 
                   <span class="card-title activator"><?php echo $item['Name'];?></span>
                   <span class="right"><?php echo $item['Price'];?></span>        
                   <p><a href="item.php?name=<?php echo str_replace(" ", "-",$item['Name']); ?>&ID=<?php echo $item['Item_ID'];?>">
                       <?php echo lang('VIST');?>
                       </a>
                     </p>                 
                 </div>
                 <div class="card-reveal">
                   <span class="card-title"><?php echo $item['Name'];?><i class="material-icons right">close</i></span>
                   <p><?php echo $item['Description'];?>.</p>
                   <?php $tags = explode("," , $item['tags']);     
                         foreach($tags as $tag){
                             echo "<a href='tags.php?tag=" . str_replace(" ", "-", $tag) . "'> ". $tag . "</a> |";
                         } ?> 
                 </div>
              </div><!-- start card item  -->                             
            </div>
             <!-- start modal delete butten-->
             <div id="modal<?php echo $item['Item_ID']; ?>" class='modal' >
               <div class='modal-content center-align'>
                 <h4><?php echo lang("SURE_MSG")?> </h4>
                 <p><?php echo lang("DELETE_ITEM_MSG")?> <?php echo $item['Name']?></p>
               </div>
               <div class='modal-footer'>
                 <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>   

                 <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                    data-do= "delete_item"
                    data-place = "#profile-items" 
                    data-id='<?php echo $item['Item_ID']; ?>' id="delete-item" >Delete</a>
              </div><!--end modal Delete Butten--> 
            </div>                        

              <?php } 
    }

/*
//function to profile page: it will make loop for user items and print them in profile page
*/
function profile_Items(){
    
     $items = getSpecialInfo("items", "Member_ID", "", $_SESSION["ID"]);
    
     if (!empty($items)){
         
        foreach ($items as $item) { ?> 
                 <!-- start card item  -->
                 <div class="col s12 m4">
                   <div class="card"> 
                     <div class="card-image waves-effect waves-block waves-light">
                      <?php 
                        $img = empty($item["Main_Foto"]) ? "foto1.jpg" : $item["Main_Foto"];
                        ?>           
                      <img class="activator" src="uplaodedFiles/itemsFotos/<?php echo $img; ?>">
                     </div>
                     <div class="card-content">
                       <div class="row profile-item-icons">   
                         <!--Delete Butten-->
                         <a class='modal-trigger' 
                            href="#modal<?php echo $item['Item_ID'];?>"
                            onclick= "$('.modal').modal();"
                            >
                           <i class='material-icons right'>delete_forever</i>
                         </a><!--Delete Butten-->   
                         <a href ="item.php?name=<?php echo $item['Name']; ?>&ID=<?php echo $item['Item_ID']; ?>&do=edit-item"> 
                           <i class="material-icons right">edit</i> 
                        </a> 
                        <?php
                         if($item["approve"] == 0){    ?>   
                            <a href ="item.php?name=<?php echo $item['Name']; ?>&ID=<?php echo $item['Item_ID']; ?>&do=edit-item" title = "<?php echo lang("APPROVE_WAIT"); ?>"> 
                                <i class='material-icons purple-text  text-accent-2'>hourglass_empty</i>
                            </a>     
                        <?php } ?>
                                   
                       </div>   
                       <span class="card-title activator"><?php echo $item['Name']; ?></span>
                       <span class="right"><?php echo $item['Price'];?></span>        
                       <p><a href="item.php?name=<?php echo str_replace(" ", "-",$item['Name']); ?>&ID=<?php echo $item['Item_ID'];?>">
                           <?php echo lang('VIST');?>
                           </a>
                         </p>                 
                     </div>
                     <div class="card-reveal">
                       <span class="card-title"><?php echo $item['Name'];?><i class="material-icons right">close</i></span>
                       <p><?php echo $item['Description'];?>.</p>
                        
                       <?php $tags = explode("," , $item['tags']);     
                             foreach($tags as $tag){
                                 echo "<a href='tags.php?tag=" . str_replace(" ", "-", $tag) . "'> ". $tag . "</a> |";
                             } ?> 
                     </div>
                  </div><!-- start card item  -->                             
                </div>
                 <!-- start modal delete butten-->
                <div id="modal<?php echo $item['Item_ID']; ?>" class='modal' >
                  <div class='modal-content center-align'>
                     <h4><?php echo lang("SURE_MSG")?> </h4>
                     <p><?php echo lang("DELETE_ITEM_MSG")?> <?php echo $item['Name']?></p> 
                   </div>
                   <div class='modal-footer'>
                     <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>   

                     <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                        data-do= "delete_item"
                        data-place = "#profile-items" 
                        data-id='<?php echo $item['Item_ID']; ?>' id="delete-item" >Delete</a>
                  </div><!--end modal Delete Butten--> 
                </div>                        

              <?php }
     } else {
         echo "<h3 class= 'center-align'>there is no items</h3>";
     }
}


/*                 
// faction to give alternative, if value is empty.
*/

function ifEmpty($value, $msg) {
    $feedback = empty($value) || !isset($value) ? $msg : $value;
    
    return $feedback;
}




/*
// function to print item info in item page before edit and after edit on item 
*/

 function showItemInfo($item_ID) {
     
      $item_info = getSpecialInfo("items", "Item_ID", "", $item_ID, ""); ?>
      <table class="responsive-table">
        <thead>
          <tr style="">
              <th><?php echo  lang("ITEM_NAME1"); ?></th>
              <th><?php echo  lang("PRICE"); ?></th>
              <th><?php echo  lang("STATUS"); ?></th>
              <th><?php echo  lang("MADE_IN"); ?> </th>
              <th><?php echo  lang("TAG_SHOW"); ?></th>
              <th><?php echo lang("ADD_DATA"); ?></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?php echo ifEmpty($item_info["Name"], lang("EMPTY")) ?></td>
            <td><?php echo ifEmpty($item_info["Price"], lang("EMPTY")) ?></td>
            <td><?php echo ifEmpty($item_info["Status"], lang("EMPTY")) ?></td>
            <td><?php echo ifEmpty($item_info["Made_In"], lang("EMPTY")) ?></td>  
            <td>
              <?php $tags = explode("," , $item_info['tags']);     
              foreach($tags as $tag){  ?>
              <a class="tags" href="tags.php?tag=<?php echo str_replace(" ", "-", $tag); ?> "><?php echo $tag ?></a> <?php } ?>    
             </td>
             <td><?php echo ifEmpty($item_info["Add_Data"], lang("EMPTY")) ?></td>
           </tr>
         </tbody>
      </table>



         <div  class="row details">
            <p class="col  s12 center-align">
              <span class=""><?php echo ifEmpty($item_info["Description"], " ") ?></span>
            </p>
         </div>
     
<?php

 }

function jkjk(){
                 $item_info = getSpecialInfo("items", "Item_ID", "", $item_ID, ""); ?> 

            <div class="row">
              <p class=" col s4"> <?php echo  lang("ITEM_NAME1") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Name"]; ?> </p>
              <p class=" col s4"> <?php echo  lang("PRICE") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Price"]; ?> </p>
 
              <p class=" col s4 "> <?php echo  lang("DESCRIPTION") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Description"]; ?> </p>
              <p class=" col s4"> <?php echo  lang("MADE_IN") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Made_In"]; ?> </p>
            </div>
            <div class="row">
              <p class=" col s4"> <?php echo  lang("STATUS") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Status"]; ?> </p>
              <p class=" col s4 "> <?php echo  lang("TAG_SHOW") . "  : </p>" ."<p class = 'col s7 info'>"; ?>
            </div>
            <?php
               $tags = explode("," , $item_info['tags']);     
               foreach($tags as $tag){
                 echo "<a class = 'tags' href='tags.php?tag=" . str_replace(" ", "-", $tag) . "'> ". $tag . "</a> |";
             } ?> </p>

            <p class=" col s4"> <?php echo  lang("ADD_DATA") . "  : </p>" ."<p class = 'col s7 info'>" . $item_info["Add_Data"]; ?> </p><?php
}
function showComment($item_ID) {
    
         foreach(getSpecialComments($item_ID) as $comment) {?>

           <div class="items-comment">
             <h5 class="written_by"><?php echo $comment["written_by"];?></h5>   
             <span class ="comment-data right"><?php echo $comment["Comment_Data"];?></span>   
             <p class ="comments"><?php echo $comment["Comment"];?></p>
           </div>
         <?php } 

}

// to refrsh foto agter change 

function refresh_foto($foto) { 
    
         $img = !empty($foto)? $foto :  "foto1.jpg" ; ?> 
         <img class= "responsive-img" src="uplaodedFiles/usersFoto/<?php echo $img ?>">
         <a href="#change-foto" class="modal-trigger"><?php echo lang("CHANGE"); ?> </a> 
<?php
}








