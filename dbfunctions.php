<?php 

ob_start();

session_start();

include "init.php";

if($_SERVER['REQUSET_METHOD'] = "GET"){
    
    $fromPage = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : "";
    
    $do = $_GET['ajxdo'];

    // show this fields, when user want to update his info (profile page)
    
    if ($do == "show_inputs_field"){ ?>
                          
          <?php $info =  getSpecialInfo("users","userID","",  $_SESSION['ID'], ""); ?>

          <div class="row"> 
<!--              End input "Add user Name" field-->
             <p class="user-info col s6"><?php echo lang("FIRST_NAME");?>:</p>
              <input id="update-name"
                     type="text" 
                     class="validate input col s6" 
                     limit ="3"
                     value ="<?php echo $info['username'];?>"
                     data-required ="required">              
          </div>
          <div class="row">
             <p class="user-info col s4"><?php echo lang("EMAIL");?>:</p>
              <input id="update-email"
                     type="text" 
                     class="validate input col s8" 
                     limit ="3"
                     value ="<?php echo $info['Email'];?>"
                     data-required ="required">              
          </div>
          <div class="row">
             <p class="user-info col s6"><?php echo lang("FULLNAME");?>: </p>
              <input id="update-fName"
                     type="text" 
                     class="validate input col s6" 
                     limit ="3"
                     value ="<?php echo $info['fullName'];?>"
                     data-required ="required">
          </div> <!-- End input "Full Name" field-->


          <button type="button" id="update-user-info-btn" data-do = "update-user-info" data-place = "#user-info" class="ajax-click waves-effect waves-light btn right"><?php echo lang("EDIT")?></button>
<?php
    
    //Edit user info from profile page 
        
    } elseif ($do == "update-user-info"){  
        
          $userName  = filter_var($_GET['ajxName'], FILTER_SANITIZE_STRING);
          $email     = filter_var($_GET['ajxEmail'], FILTER_SANITIZE_EMAIL);
          $fullName  = filter_var($_GET['ajxFname'], FILTER_SANITIZE_STRING);

          // prepare erorr array 
        
          $ErrArray = [];
        
          if (empty($userName) or strlen($userName) > 20){
               
               $ErrArray[] = lang("PHP_ERRMSG_NAME");
           }
         
           if(empty($email)){
               
               $ErrArray[] = lang("PHP_ERRMSG_EMAIL");
           }
         
           if(empty($fullName) or ($fullName) > 25 ){
               
               $ErrArray[] = lang("PHP_ERRMSG_FULLNAME"); 
           }
        
             
             // function to check Email Adress if it's reapeted, if yes => 1; but if no => return 0
             
              $check = checkItem("Email", "users", $email); 
             
           if ($check > 1){
               
              $ErrArray[] = lang("PHP_REAPETED_EMPTY");
           }
             
           // print error if one of the values is not approved 
        
            if (!empty($ErrArray)){
                
                foreach($ErrArray as $Err){ ?> 
                           
                         <!--Err : Erorr msg -->
                         <p class='errmsg-php' style='display:block'><?php echo $Err; ?></p> 
                       
                     <?php } 
            } else {
                
                $stmt = $con-> prepare("UPDATE users SET username = ?, Email = ?, fullName = ? WHERE  userID= ?");
                
                $stmt-> execute([$userName, $email, $fullName, $_SESSION['ID']]);
                
            }
          
            //print new info in profile page 
        
            $info =  getSpecialInfo("users","userID","",  $_SESSION['ID'], "");?>

           <p class="user-info"><?php echo lang("FIRST_NAME");?>: <?php echo $info['username'];?></p>
           <p class="user-info"><?php echo lang("EMAIL");?>:      <?php echo $info['Email'];?></p>
           <p class="user-info"><?php echo lang("FULLNAME");?>:   <?php echo $info['fullName'];?></p>
        
        
        
<?php       
        
        
        
} elseif ($do == "change_pass"){
              
          $password1 = sha1($_GET['ajxPass1']);
          $password2 = sha1($_GET['ajxPass2']);
          $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  

        
          // prepare the erorr array
        
          $ErrArray = [];
        
          if ($password2 == $emptyPass && $password2 == $emptyPass){

             $ErrArray[] = lang("PHP_EMPTY_PASS");
              
              } 
        
          if ($password1 != $password2){

              $ErrArray[] = lang("PHP_ERR_DIFFERENT_PASS"); 
              
              }
        
          if (!empty($ErrArray)){
                
                foreach($ErrArray as $Err){ ?> 
                           
                         <!--Err : Erorr msg -->
                         <p class='errmsg-php' style='display:block'><?php echo $Err; ?></p> 
                       
                     <?php } 
            } else {
                
                $stmt = $con-> prepare("UPDATE users SET password = ? WHERE  userID= ?");
                
                $stmt-> execute([$password2, $_SESSION['ID']]);
              
                echo "alles gut";
            }  
        
        
          //END ADD NEW USER AND EDIT USER INFO
        
        // start delete item
        
        
} elseif ($do == "delete_item") {
         
         $itemID = isset($_GET['ajxID']) && is_numeric($_GET['ajxID'])? intval($_GET['ajxID']) :0;

         //check if ID is allredy exist in item table

         $check = checkItem("Item_ID", "items", $itemID);

         // check if id info has been stored in database, if yes then delete item
        
         if ($check > 0) {

            $stmt=$con->prepare("DELETE FROM items  WHERE Item_ID = :zItemID");

            $stmt->bindParam(":zItemID", $itemID);

            $stmt->execute();

         }
        
        
        
         profile_Items();
        
        // End delete Item
        
        // start add item 
        
    }elseif($do == "insert_item"){
        
          //Insert new user info 
             
           $Name    = filter_var($_GET['ajxName'], FILTER_SANITIZE_STRING);
           $descrp  = filter_var($_GET['ajxDescription'], FILTER_SANITIZE_STRING);
           $price   = filter_var($_GET['ajxPrice'], FILTER_SANITIZE_NUMBER_INT);
           $made_in = filter_var($_GET['ajxMadeIn'], FILTER_SANITIZE_STRING);
           $status  = $_GET['ajxStatus'];
           $userId  = $_SESSION['ID'];
           $cateId  = $_GET['ajxCateId'];
           $tags    = filter_var($_GET['ajxTags'], FILTER_SANITIZE_STRING);
         
        
            // Make an error array for add item form 
         
            $addFormErr = [];
         
           if (empty($Name)){
               
               $addFormErr[] = lang("PHP_ERRMSG_ITEM_NAME");
           }
         
           if(empty($price) ){
               
               $addFormErr[] = lang("PHP_ERRMSG_PRICE"); 
           }
          
           if(empty($cateId)){
               
               $addFormErr[] = lang("PHP_ERRMSG_CATE"); 
           }
          
           if (strpos($tags, " ")){
               
               $addFormErr[] = lang("PHP_ERRMSG_TAGS");
           }
         

              
          // End  error array for add item form 
             
            // check if the values are approved
          
           if (!empty($addFormErr)){
               
           ?>
                     <!-- print caught errorrs-->
                     
                     <?php foreach($addFormErr as $Err){ ?> 
                           
                           <!--Err : Erorr msg -->
                         <p class='errmsg-php' style='display:block'><?php echo $Err; ?></p> 
                       
                     <?php } 
        
               
                
               
            // if yes then insert the new user to database
               
           }else {
               
               $stmt = $con->prepare("INSERT INTO
                                                items
                                                     (Name, Description, Price, Made_in, Status, Add_Data, approve, Cate_ID, Member_ID, tags)
                                                VALUES 
                                                     (:zName, :zdescrp, :zPrice, :zMade_in, :zStatus, now(), 0,:zcateID, :zmemberID, :ztags)");
               
                $stmt->execute(["zName"    => $Name,
                                "zdescrp"  => $descrp,
                                "zPrice"   => $price,
                                "zMade_in" => $made_in,
                                "zStatus"  => $status,
                                "zcateID"  => $cateId,
                                "ztags"    => $tags,
                                "zmemberID"=> $userId]);
               
         
         }   
        
          profile_Items();
    
    // send edit item form 
        
    } elseif ($do == "edit_item_form"){
        
           $item_ID = $_GET['ajxID']; 
        
           $item_info =  getSpecialInfo("items", "Item_ID", "Member_ID", $item_ID, $_SESSION["ID"]); 
?>

           <div class="col s12 edit-form">
            <div class="input-field col s12">
              <i class="material-icons prefix">queue</i>
                <input type="hidden" id = "userID" value="<?php echo $_SESSION["ID"]; ?>" > 
                <input id="item-name" 
                       pattern= ".{2,}"
                       type="text" 
                       class="validate input" 
                       required
                       value = "<?php echo $item_info["Name"]; ?>">
                <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
                </div><!--End input "Add item Name" field-->  

            <!--start input "Add Description" field--> 
            <div class="input-field area col s11  push-s1">
                <textarea id="item-descrp"  class="materialize-textarea"><?php echo $item_info["Description"]; ?></textarea>
                  <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
               </div>

                <!-- stsrt "price" field -->
               <div class="input-field col s12 ">
                 <i class="material-icons prefix">attach_money</i>
                 <input id ='item-price' 
                        minlenght = "2" 
                        type="text"
                        class="validate password1 input" 
                        value = "<?php echo $item_info["Price"]; ?>"
                        required>
                 <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
               </div><!-- end "price" field -->
              <!-- stsrt "made in" field -->
               <div class="input-field col s12 ">
                 <i class="material-icons prefix">texture</i>
                 <input id ='made-in'
                        type="text"
                        class="validate password1 input"
                        value = "<?php echo $item_info["Made_In"]; ?>">
                 <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
               </div><!-- stsrt "made in" field -->
               
               <!-- start "tags" field -->
               <div class="input-field col s12">
                 <i class="material-icons prefix">texture</i>
                 <input id ='tags'
                        type="text"
                        value = "<?php echo $item_info["tags"]; ?>"
                        class="validate password1 input">
                 <label for="icon_telephone"><?php echo lang("TAGS")?></label>
               </div><!-- end "tags" field -->

              <!--start category selector-->
              <label><?php echo lang("CATEGORY_NAME")?></label>
               <select id="select-cate" class="browser-default ">
                 <option value="" >...</option> 
                 <?php  
                 $cates = getAll("*", "categories"); // fetch all categories from database and print them in this selector 
                 foreach($cates as $cate){
                   echo "<option value ='" . $cate['ID'] . "'>" . $cate['Name'] . "</option>" ;
                 }
                 ?>
               </select>

               <!--start status selector "new, old"-->
                <label><?php echo lang("STATUS")?></label>
                 <select id="select-status" class="browser-default"> 
                   <option value="new" selected><?php echo lang("NEW")?></option>
                   <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
                   <option value="used"><?php echo lang("USED")?></option>
                   <option value="old"><?php echo lang("OLD")?></option>
                 </select>

              </div><!--start status selector "new, old"-->


            <button id="edit-item-btn" 
                    data-id="<?php echo $item_info["Item_ID"]; ?>"
                    class="waves-effect waves-light btn right ajax-click"
                    data-do = "edit_item"
                    data-place ="#item-details"> <?php echo lang("EDIT"); ?> </button>


   <?php 
        
        
    // edit fetch item form 
        
    } elseif ($do == "edit_item") {
           //Update item info
    
           $itemID  = $_GET['ajxID'];
           $Name    = filter_var($_GET['ajxName'], FILTER_SANITIZE_STRING);
           $descrp  = filter_var($_GET['ajxDescription'], FILTER_SANITIZE_STRING);
           $price   = filter_var($_GET['ajxPrice'], FILTER_SANITIZE_NUMBER_INT);
           $made_in = filter_var($_GET['ajxMadeIn'], FILTER_SANITIZE_STRING);
           $status  = $_GET['ajxStatus'];
           $cateId  = $_GET['ajxCateId'];
           $tags    = filter_var($_GET['ajxTags'], FILTER_SANITIZE_STRING);
 




       // check if all values are approved 

        
          $addFormErr = [];
         
           if (empty($Name)){
               
               $addFormErr[] = lang("PHP_ERRMSG_ITEM_NAME");
           }
         

           if(empty($price) ){
               
               $addFormErr[] = lang("PHP_ERRMSG_PRICE"); 
           }

          
           if(empty($cateId)){
               
               $addFormErr[] = lang("PHP_ERRMSG_CATE"); 
           }
        
           if (strpos($tags, " ")){
               
               $addFormErr[] = lang("PHP_ERRMSG_TAGS");
           }
         
          if (!empty($addFormErr)){

             foreach($addFormErr as $Err){ ?> 
                           
                           <!--Err : Erorr msg -->
                         <td class='errmsg-php' style='display:block'><?php echo $Err; ?></td> 
                       
                     <?php } 

           }else {
                   
           $stmt=$con->prepare("UPDATE 
                                 items
                               SET
                                 Name =?, Description =?, Price =?, Made_in =?, Status =?, Cate_ID =?, tags = ?
                               WHERE 
                                 Item_ID = ? ");  //Info Updating

            $stmt->execute([$Name, $descrp, $price, $made_in, $status, $cateId, $itemID, $tags]); //insert new values
  
       } 
        // sent Modified data back to item page 
        
        showItemInfo($itemID); 
    
    
    } elseif ($do == "add_comment") {
        
        $comment    = filter_var($_GET['ajxComment'], FILTER_SANITIZE_STRING);
        
        $item_ID    = $_GET["ajxID"];
        
        $check = checkItem("Item_ID", "items", $item_ID);
        
        if ($check > 0){
            $stmt = $con->prepare("INSERT INTO
                                                comments
                                                     (Comment, Status, Comment_Data, Item_ID, Member_ID)
                                                VALUES 
                                                     (:zComment, 1, now(), :zItem_ID, :zMember_ID)");

            $stmt->execute(["zComment"         => $comment,
                                "zItem_ID"     => $item_ID,
                                "zMember_ID"   => $_SESSION['ID']]);
        }else {
            
            echo "kusha";
        }
        
        // and sent item comments back
        
        showComment($item_ID);
    }
    
    
    
    
    } //ende 
    
    
ob_end_flush();
?>