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
                                    users.username as written_by,
                                    users.Foto as actor_foto
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
    
        $all = $stmt->fetchAll(); 
        

        return $all;
    
}


/*
// function to get special INFO depent on tow values 
// it will be helpfull to give user ability to do something like ability to login and edit on item his own item
// once something like just one item info or one user info
*/

function getSpecialInfoOnce($table, $what, $what2 = NULL, $var1, $var2 = NULL, $value = NULL){
    
    global $con;
        
    $query = empty($value) ? " " : $value ;
        
    if ($what2 != NULL){
        
       $stmt = $con->prepare("SELECT * FROM $table WHERE $what = ? AND $what2 = ? $query ");
        
       $stmt->execute ([$var1, $var2]);
     
    }  else {
        
        $stmt = $con->prepare("SELECT * FROM $table WHERE $what = ? ");
        
        $stmt->execute ([$var1]);
    }
    
        $all = $stmt->fetch(); 
        

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
** function to Update spacial table
*/

function  LastActivity($table, $val){
    
    global $con;
    
    $stmt =$con->prepare("INSERT INTO `$table`
                                           (`user_ID`, `last_activity`) 
                                         VALUES 
                                           (:zuserID, now())");
    
    $stmt->execute(["zuserID" => $val]);
}

/*
** function to Update spacial table
*/

function  UpdateLastActivity($table, $val){
    
    global $con;

    $stmt =$con->prepare("UPDATE `$table` SET `last_activity` = now() WHERE user_ID = ?");
    
    $stmt->execute([$val]);
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

function redirectPage($msg, $url = null, $seconds = 3){
    
     echo "<div class= 'succmsg_php center-align' style ='display:block'> 
     
             <p class= 'msg'>" . " " . $msg . " " . lang("REDIRECTED") . " " .$seconds . " " . lang("SECONDS") . "</p>
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

function checkItem($select, $from, $value, $query = " ") {
    
    global $con;
        
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ? $query");
    
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
    
    foreach (globalGet("*", "items", "WHERE approve != 0", "", "Item_ID", "DESC", "") as $item){  
             
             // give owner ability to edit his own items 
        
             if (isset($_SESSION["ID"]) && $_SESSION["ID"] === $item["Member_ID"]) { 
                 
                 $controle_ability = "ON";
                 
                } else {
                 
                 $controle_ability = "Off";
                 
                }
         ?>

             <div class="col s6 m3">
               <div class="card"> 
                 <div class="card-image waves-effect waves-block waves-light">
                  <?php 
                    $img = empty($item["Main_Foto"]) ? "foto1.jpg" : $item["Main_Foto"];
                    ?>           
                  <img class="activator" style="height:198px" src="uplaodedFiles/itemsFotos/<?php echo $img; ?>">
                 </div>
                 <div class="card-content <?php if($controle_ability === "Off") {echo "card-padding";} ?>">
                     
                  <!-- check if user has ability to edit and delete this item -->     
                  <?php if ($controle_ability === "ON") { //echo $item["Member_ID"] . "<br>" . $_SESSION["ID"]; ?> 
                     
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
                   <span class="right">$<?php echo $item['Price'];?></span>        
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
                 <a class='modal-action modal-close waves-effect waves-green btn-flat'><?php echo lang("CLOSE"); ?></a>   

                 <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                    data-do= "delete_item"
                    data-place = "#index-items" 
                    data-id='<?php echo $item['Item_ID']; ?>' id="delete-item" ><?php echo lang("DELETE"); ?></a>
              </div><!--end modal Delete Butten--> 
            </div>                        

              <?php } 
    }

/*
//function to profile page: it will make loop for user items and print them in profile page
*/
function profile_Items($member_ID){
    
     $items = getSpecialInfo("items", "Member_ID", "", $member_ID);
    
     if (!empty($items)){
         
        $login_status =  isset($_SESSION['ID'] ,$_SESSION['user']) ? $_SESSION['ID'] : "0";
    
        foreach ($items as $item) {

        ?>    
                 <!-- start card item  -->
                 <div class="col s6 m3">
                   <div class="card"> 
                     <div class="card-image waves-effect waves-block waves-light">
                      <?php 
                        $img = empty($item["Main_Foto"]) ? "foto1.jpg" : $item["Main_Foto"];
                        ?>           
                      <img class="activator" style="height:198px" src="uplaodedFiles/itemsFotos/<?php echo $img; ?>">
                     </div>
                     <div class="card-content">
                       <div class="row profile-item-icons">   
                         <!--Delete Butten-->
                        <?php if($member_ID == $login_status){ ?>  
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
                        } 
                         if($item["approve"] == "0"){    ?>   
                            <a href ="item.php?name=<?php echo $item['Name']; ?>&ID=<?php echo $item['Item_ID']; ?>&do=edit-item" title = "<?php echo lang("APPROVE_WAIT"); ?>"> 
                                <i class='material-icons purple-text  text-accent-2'>hourglass_empty</i>
                            </a>     
                        <?php } ?>
                                   
                       </div>   
                       <span class="card-title activator"><?php echo $item['Name']; ?></span>
                       <span class="right">$<?php echo $item['Price'];?></span>        
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
                     <a class='modal-action modal-close waves-effect waves-green btn-flat'><?php echo lang("CLOSE"); ?></a>   

                     <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                        data-do= "delete_item"
                        data-place = "#profile-items" 
                        data-id='<?php echo $item['Item_ID']; ?>' id="delete-item" ><?php echo lang("DELETE"); ?> </a>
                  </div><!--end modal Delete Butten--> 
                </div>                        

              <?php }
     } else {
         echo "<h3 class= 'center-align'>" . lang("NO_ITEM") . "</h3>";
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
     
     global $con;
//     $item_info = getSpecialInfoOnce("items", "Item_ID", "", $item_ID, ""); 
     
     $stmt = $con->prepare(" SELECT 
                                     items.* ,
                                     users.username AS User_Name 
                                 FROM
                                     items 
                                 INNER JOIN 
                                     users
                                 ON 
                                     users.userID = items.Member_ID 
                                     
                                     WHERE Item_ID = $item_ID ORDER BY Item_ID DESC");
     
     $stmt->execute();
     
     $item_info =$stmt->fetch(); 

?>
      <table class="responsive-table">
        <thead>
          <tr style="">
              <th><?php echo  lang("ITEM_NAME1"); ?></th>
              <th><?php echo  lang("OWNER"); ?></th>
              <th><?php echo  lang("PRICE"); ?></th>
              <th><?php echo  lang("NUMS_ITEM"); ?></th>
              <th><?php echo  lang("STATUS"); ?></th>
              <th><?php echo  lang("MADE_IN"); ?> </th>
              <th><?php echo  lang("TAG_SHOW"); ?></th>
              <th><?php echo  lang("ADD_DATA"); ?></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?php echo ifEmpty($item_info["Name"], lang("EMPTY")) ?></td>
            <td><a class ="item_user_name" href= "profile.php?Member-name=<?php echo $item_info["User_Name"] . "&id=" . $item_info["Member_ID"]; ?>"><?php echo $item_info["User_Name"]; ?></a></td>
            <td>$<?php echo ifEmpty($item_info["Price"], lang("EMPTY")) ?></td>
            <td><?php echo ifEmpty($item_info["nums_item"], lang("EMPTY")) ?></td>
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

function showComment($item_ID) {
    
         foreach(getSpecialComments($item_ID) as $comment) {?>

           <div class="items-comment ">
             <div class=" circle img-container">   
               <img class=" img-responsive actor-img" style="width:60px;" src="uplaodedFiles/usersFoto/<?php echo $comment["actor_foto"]; ?>">   
             </div>     
             <h5 class="written_by left"><?php echo $comment["written_by"];?></h5> 
             <?php if ($comment['Member_ID'] === $_SESSION['ID']) { ?>   
             <div class="row comment-controller">    
               <i class="material-icons right modal-trigger comment-edit-btn"
                  onclick="$('.modal').modal();"
                  data-id ="<?php echo $comment['C_ID']; ?> "
                  href = "#update-comment-form" 
                  >mode_edit</i>    
             </div>  
             <?php } ?>   
             <p class ="comment" id="comment"><?php echo $comment["Comment"];?></p>
             <div class ="comment-data right"><?php echo $comment["Comment_Data"];?></div>   
           </div>
         <?php } 

}

// to refrsh foto agter change 

function refresh_foto($foto, $foto_change) { 
    
         $img = !empty($foto)? $foto :  "foto1.jpg" ; ?> 
         <img class= "responsive-img" src="uplaodedFiles/usersFoto/<?php echo $img ?>">

         <?php 
         if ($foto_change === "1"){
         ?>     
         <a href="#change-foto" class="modal-trigger"><?php echo lang("CHANGE"); ?> </a> 
<?php    } //end condition
} // end function

?>