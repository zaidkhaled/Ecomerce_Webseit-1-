<?php 

ob_start();

session_start();

include "init.php";
//var_dump($_POST);
if($_SERVER['REQUSET_METHOD'] = "POST"){
    
    $fromPage = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : "";
    
    $do = isset($_POST['ajxdo']) ? $_POST['ajxdo'] : "";

    // show this fields, when user want to update his info (profile page)
    
    if ($do == "check_notif"){
        
        $id = isset($_SESSION['ID'])? $_SESSION['ID'] : "0";
        
        $stmt1 = $con->prepare("SELECT 
                                     nontifications.*,
                                     users.username AS Actor_Name,
                                     users.Foto AS Actor_foto,
                                     items.Name AS Item_Name,
                                     items.Item_ID AS Item_ID
                                 FROM
                                     nontifications
                                 INNER JOIN
                                     users 
                                 ON 
                                     users.userID = nontifications.Actor_ID
                                 INNER JOIN 
                                     items
                                 ON 
                                     items.Item_ID = nontifications.source_id
                                    WHERE user_ID = $id AND ACTOR_ID != $id ORDER BY ID DESC;");
     
       
        $stmt1->execute();
        
        $rows = $stmt1->fetchAll();

        $output_all = "";
        
        if(!empty($rows)) {
 
                foreach($rows as $row){
                    
                    if ($row["activity_type"] === "comment"){
                       $activite_type = lang("COMMENT");
                       $varb = lang("COMMENT_ON");                       
                           
                    } elseif ($row["activity_type"] === "Sold") {      
                       $activite_type = lang("SOLD");
                       $varb = lang("BOUGHT_YOUR");
                    

                    }
                    $src = isset($row["Actor_foto"])? $row["Actor_foto"] : "foto1.jpg";
                    $output_all .= "
                                     <li class='collection-item avatar'>
                                       <a class = 'notif_link' href='item.php?name=". str_replace(' ', '-', $row['Item_Name']) . "&ID=" . $row['Item_ID'] . "'>
                                         <img src='uplaodedFiles/usersFoto/" . $src . "' alt='' class='circle'>
                                         <span class='title'>". $activite_type . "</span>
                                         <p>" . $row["Actor_Name"] ." ". $varb . "<br>"
                                            .$row["Item_Name"] ."
                                         </p>
                                       <a>
                                      </li>
                                      ";
                    }


        
          
          
          
      }else {
            
          $output_all = "<li class = 'collection-item '><span class='title'>". lang("NO_NOTIF") . "</span></li>"; 
            
      }
        
            
      $stmt2 = checkItem("user_ID", "nontifications", $id, "AND is_seen = 0");
        

      $count_unseen_notif = $stmt2;
        


        $data =[
            "notif"        => $output_all,
            "unseen_notif" => $count_unseen_notif
            ];
        
       echo  json_encode($data);
        
        
      // home page onload: set ip
          
    }elseif ($do == "home-page-load"){  
        
        // functions to get cleit IP
        
        function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        function get_client_ip2() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        
        
        if (get_client_ip() !== "UNKNOWN") {
            
            $cleitIP = get_client_ip(); 
            
        } else {
            
            $cleitIP = get_client_ip2(); 
        }
        
        $pageTitle = $_POST['ajxtitle'];
        
        $pagewidth = $_POST['ajxwidth'];
        
        
        $stmt = $con->prepare ("INSERT INTO `load-home-page` (`IP`, `page-title`, `win_width`, `Time`) VALUES ('$cleitIP', '$pageTitle', $pagewidth, now())");
        
        $stmt -> execute();
        
        
        echo "yes";
        
    //update Last activated data to know if user is online or not     
        
    }elseif ($do == "Last_activated"){         
        
        // make  update 

        UpdateLastActivity('login_details', $_SESSION['ID']);
        
    // nontification updating when it seen     
    
    }elseif ($do == "seen"){ 
        
        
        $stmt = $con->prepare("UPDATE nontifications SET is_seen = 1 WHERE user_ID= ?");
                
        $stmt-> execute([$_SESSION['ID']]);
        
        
    // return search result 
        
    }elseif ($do == "search"){ 
        
        $keywrod = $_POST["ajxSearchInput"];
        
        $stmt = $con->prepare("(SELECT Name, Item_ID,    'item'     as     type   FROM    items WHERE Name     LIKE '%" . $keywrod . "%')
                                 UNION 
                                (SELECT username, userID, 'user'    as    type   FROM    users WHERE username LIKE '%" . $keywrod . "%')");
        
        $stmt->execute();
        
        $rows = $stmt->fetchAll();
        
        if (!empty($rows)){
            
            foreach($rows as $row){  // if search resut type is  user then return profile link, else print return to item page 
                
                if($row["type"] == "user"){

                   $url = "profile.php?Member-name=" . $row['Name'] . "&id=" . $row['Item_ID'];
                    
                   $named_showd =  $row['Name'];       

                } elseif ($row["type"] == "item") {

                   $url = "item.php?name=" . $row['Name'] . "&ID=" . $row['Item_ID']; 
                    
                   $named_showd =  $row['Name'];   
                    
                }
                
               
                echo "<a href = '$url'>" . $named_showd  . "</a>";
            }
            
        } else {
            echo "<a>" . lang('NO_RESULT_FUOND') . "</a>";
        }
        
        
        
    }elseif ($do == "show_inputs_field"){ ?>
                          
          <?php $info =  GetSpecialInfoOnce("users","userID","",  $_SESSION['ID'], ""); ?>
           <form class="ajax-form" data-do = "update-user-info" data-place = "#user-info" >
              <div class="row"> 
                 <!--  End input "Add user Name" field-->
                 <p class="user-info col s6"><?php echo lang("FIRST_NAME");?>:</p>
                  <input id="update-name" 
                         pattern=".{3,}"
                         type="text" 
                         class="validate input col s6" 
                         limit ="3"
                         value ="<?php echo $info['username'];?>"
                         required>              
              </div>
              <div class="row">
                 <p class="user-info col s4"><?php echo lang("EMAIL");?>:</p>
                  <input id="update-email"
                         pattern=".{5,}"
                         type="text" 
                         class="validate input col s8" 
                         limit ="3"
                         value ="<?php echo $info['Email'];?>"
                         required>              
              </div>
              <div class="row">
                 <p class="user-info col s6"><?php echo lang("FULLNAME");?>: </p>
                  <input id="update-fName"
                         pattern=".{3,}"
                         type="text" 
                         class="validate input col s6" 
                         limit ="3"
                         value ="<?php echo $info['fullName'];?>"
                         required>
              </div> <!-- End input "Full Name" field-->


              <button type="submit" id="update-user-info-btn" class="ajax-click waves-effect waves-light btn right"><?php echo lang("EDIT")?></button>
           </form>   
<?php
    
    //Edit user info from profile page 
        
    } elseif ($do == "update-user-info"){  
        
          $userName  = filter_var($_POST['ajxName'], FILTER_SANITIZE_STRING);
          $email     = filter_var($_POST['ajxEmail'], FILTER_SANITIZE_EMAIL);
          $fullName  = filter_var($_POST['ajxFname'], FILTER_SANITIZE_STRING);

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
        
            $info =  getSpecialInfoOnce("users","userID","",  $_SESSION['ID'], "");?>

           <p class="user-info"><?php echo lang("FIRST_NAME");?>: <?php echo $info['username'];?></p>
           <p class="user-info"><?php echo lang("EMAIL");?>:      <?php echo $info['Email'];?></p>
           <p class="user-info"><?php echo lang("FULLNAME");?>:   <?php echo $info['fullName'];?></p>
        
        
        
<?php       
        
        
        
} elseif ($do == "change_pass"){
              
          $password1 = sha1($_POST['ajxPass1']);
          $password2 = sha1($_POST['ajxPass2']);
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
         
         $itemID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;

         //check if ID is allredy exist in item table

         $check = checkItem("Item_ID", "items", $itemID);

         // check if id info has been stored in database, if yes then delete item
        
         if ($check > 0) {

            $stmt = $con->prepare("DELETE FROM items  WHERE Item_ID = :zItemID");

            $stmt -> bindParam("zItemID", $itemID);

            $stmt->execute();

         }
        
        
        if (preg_match('/profile/', $_SERVER['HTTP_REFERER'])){
            
            profile_Items($_SESSION['ID']);
            
        } else {
            
            home_items();
            
        } 
         
        
        
        
        
        // End delete Item
        
    }elseif($do == "check_foto"){
        
          $fotoName = $_FILES['foto']['name'];
          $fotoSize = $_FILES['foto']['size'];
          $fotoTmp  = $_FILES['foto']['tmp_name'];
          $fotoType = $_FILES['foto']['type'];
         
          //Allowed extensions array
         
          $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
         
          $value = explode(".", $fotoName);

          $fotoextension = strtolower(end($value));
        
          if (!in_array($fotoextension, $fotoAllowedExtension)) {
              
              $ErrArray[] = lang("PHP_ERR_FOTO_EXTENTIONS");
          }
        
          if ($fotoSize > 4194304){
              
              $ErrArray[] = lang("PHP_ERR_FOTO_SIZE");
              
          }
        
          if (!empty($ErrArray)){
                
               foreach($ErrArray as $Err){ ?> 
                           
                <!--Err : Erorr msg -->
                 <p class='errmsg-php center-align' style='display:block'><?php echo $Err; ?></p> 

             <?php } 
            }
        
     }elseif($do == "change_user_foto"){
        
          $fotoName = $_FILES['foto']['name'];
          $fotoSize = $_FILES['foto']['size'];
          $fotoTmp  = $_FILES['foto']['tmp_name'];
          $fotoType = $_FILES['foto']['type'];
         
          //Allowed extensions array
         
          $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
         
          $value = explode(".", $fotoName);

          $fotoextension = strtolower(end($value));
        
          if (!in_array($fotoextension, $fotoAllowedExtension)) {
              
              $ErrArray[] = lang("PHP_ERR_FOTO_EXTENTIONS");
          }
        
          if ($fotoSize > 4194304){
              
              $ErrArray[] = lang("PHP_ERR_FOTO_SIZE");
              
          }
        
          if (!empty($ErrArray)){
                
               foreach($ErrArray as $Err){ ?> 
                           
                <!--Err : Erorr msg -->
                 <p class='errmsg-php center-align' style='display:block'><?php echo $Err; ?></p> 

             <?php } 
            } else {
              
                $user_info = getSpecialInfo("users", "userID", "",$_SESSION["ID"] , "");
              
                // delete old foto 
              
                if(!empty($user_info["Foto"])){
                    
                    unlink("uplaodedFiles/usersFoto/". $user_info["Foto"]);
                }
               
              
                $foto = rand(0, 100000). "_" . $fotoName;
                
                move_uploaded_file($fotoTmp, "uplaodedFiles/usersFoto/" . $foto);
              
                $stmt = $con-> prepare("UPDATE users SET Foto = ? WHERE  userID= ?");
                
                $stmt-> execute([$foto, $_SESSION['ID']]);
              
                $new_foto = getSpecialInfoOnce("users", "userID", "",$_SESSION["ID"] , "")["Foto"];
              
                refresh_foto($new_foto, "1");
          }
             
    // start add item
        
    }elseif($do == "insert_item"){
        
          //Insert new user info 
             
           $Name    = filter_var($_POST['ajxName'], FILTER_SANITIZE_STRING);
           $descrp  = filter_var($_POST['ajxDescription'], FILTER_SANITIZE_STRING);
           $price   = filter_var($_POST['ajxPrice'], FILTER_SANITIZE_NUMBER_INT);
           $item_num = filter_var($_POST['ajxItemNum'], FILTER_SANITIZE_NUMBER_INT);
           $made_in = filter_var($_POST['ajxMadeIn'], FILTER_SANITIZE_STRING);
           $status  = $_POST['ajxStatus'];
           $userId  = $_SESSION['ID'];
           $cateId  = $_POST['ajxCateId'];
           $tags    = filter_var($_POST['ajxTags'], FILTER_SANITIZE_STRING);
        
        
            // Make an error array for add item form 
         
           $addFormErr = [];
           $asutiv_arr = [];
        
           $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
        
           // receive main foto 
        
           $MainfotoName = $_FILES['main_foto']['name'];
           $MainfotoSize = $_FILES['main_foto']['size'];
           $MainfotoTmp  = $_FILES['main_foto']['tmp_name'];
           $MainfotoType = $_FILES['main_foto']['type'];
        
           $value = explode(".", $MainfotoName);

           $mainfotoextension = strtolower(end($value));
        
           if (!in_array($mainfotoextension, $fotoAllowedExtension)) {
              
               $addFormErr[] = $MainfotoName ." : " . lang("PHP_ERR_FOTO_EXTENTIONS");
           }
        
           if ($MainfotoSize > 4194304){
              
               $addFormErr[] = $MainfotoName ." : " .  lang("PHP_ERR_FOTO_SIZE");
              
           }
        
        
           // receive items foto
        
           // make loop to controll all fotos, which received
        
           foreach ($_FILES as $value => $name){
               
               $foto = str_replace(".", "_", reset($name));
               
               if ($value !== 'main_foto') {
                    
                   $fotoName = $_FILES[$foto]['name'];
                   $fotoSize = $_FILES[$foto]['size'];
                   $fotoTmp  = $_FILES[$foto]['tmp_name'];
                   $fotoType = $_FILES[$foto]['type'];    

                   $array = explode(".", $fotoName);

                   $fotoextension = strtolower(end($array));

                   if ($fotoSize > 4194304){

                       $addFormErr[] = $fotoName. " : " . lang("PHP_ERR_FOTO_SIZE");

                    }

                   if (!in_array($fotoextension, $fotoAllowedExtension)) {

                       $addFormErr[] = $fotoName . " : " . lang("PHP_ERR_FOTO_EXTENTIONS");
                    }


                    $randName = rand(0, 100000) . "_" . $fotoName;

                    $asutiv_arr[$fotoTmp]  = $randName ;
                }
            }
         

         
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
        
               
                
               
            // if yes then insert the new item to database
               
           }else {
               
               $fotosName_array = []; 
               
               foreach ($asutiv_arr as $tmp => $imgName){
                   
                   move_uploaded_file($tmp, "uplaodedFiles/itemsFotos/" . $imgName);
                   
                   $fotosName_array[] = $imgName;
               }
               
               
               $Mainfoto = rand(0, 100000). "_" . $MainfotoName;
                
                move_uploaded_file($MainfotoTmp, "uplaodedFiles/itemsFotos/" . $Mainfoto);
               
               
               $serialized_foto_array = serialize($fotosName_array);
               
               $stmt = $con->prepare("INSERT INTO
                                                items
                                                     (Name, Fotos, Main_Foto, Description, Price, nums_item, Made_in, Status, Add_Data, approve, Cate_ID, Member_ID, tags)
                                                VALUES 
                                                     (:zName, :zFotos, :zMain_Foto, :zdescrp, :zPrice, :znums_item, :zMade_in, :zStatus, now(), 0,:zcateID, :zmemberID, :ztags)");
               
                $stmt->execute(["zName"    => $Name,
                                "zFotos"  => $serialized_foto_array,
                                "zMain_Foto" => $Mainfoto,
                                "zdescrp"  => $descrp,
                                "zPrice"   => $price,
                                "znums_item" => $item_num,
                                "zMade_in" => $made_in,
                                "zStatus"  => $status,
                                "zcateID"  => $cateId,
                                "ztags"    => $tags,
                                "zmemberID"=> $userId]);
               
               
         
         }   
        
          profile_Items($_SESSION['ID']);
    
    // send edit item form 
        
    } elseif ($do == "edit_item_form"){
        
           $item_ID = $_POST['ajxID']; 
        
           $item_info =  getSpecialInfoOnce("items", "Item_ID", "Member_ID", $item_ID, $_SESSION["ID"]); 
?>
           <div class="details ">
              <form class=" edit-form ajax-form" data-do = "edit_item" data-place ="#item-details" data-id = <?php echo $item_info["Item_ID"]; ?> >
                <div class="row"> 
                  <div class="input-field col m5 s12 push-m1">
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
                  
                    <!-- stsrt "price" field -->
                   <div class="input-field col m5 s12 push-m1 ">
                     <i class="material-icons prefix">attach_money</i>
                     <input id ='item-price' 
                            minlenght = "2" 
                            type="text"
                            class="validate password1 input" 
                            value = "<?php echo $item_info["Price"]; ?>"
                            required>
                     <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
                   </div><!-- end "price" field -->
                  </div>
                  <div class="row">
                <!--start input "Add Description" field--> 
                    <div class="input-field area col s10  push-s1">
                       <textarea id="item-descrp"  class="materialize-textarea"><?php echo $item_info["Description"]; ?></textarea>
                       <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
                    </div>
                 </div>
                  <!-- stsrt "made in" field -->
                  <div class="row">
                    <div class="input-field col m3 s10 push-m1 push-s1 ">
                      <i class="material-icons prefix">texture</i>
                      <input id ='made-in'
                             type="text"
                             class="validate password1 input"
                             value = "<?php echo $item_info["Made_In"]; ?>">
                      <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
                    </div><!-- stsrt "made in" field -->

                    <div class="input-field col m3 s10 push-m1 push-s1">
                      <i class="material-icons prefix">texture</i>
                      <input id ='tags'
                             type="text"
                             value = "<?php echo $item_info["tags"]; ?>"
                             class="validate password1 input">
                      <label for="icon_telephone"><?php echo lang("TAGS")?></label>
                     </div><!-- stsrt "made in" field -->
                     <div class=" input-field col m3 s10 push-m2 push-s1">    
                       <input type="number"
                              value = "<?php echo $item_info["nums_item"]; ?>"
                              min= "1" 
                              max= "100000"
                              id = "num-item">
                        <label for="icon_prefix"><?php echo lang("HOW_MANY_ITEM")?></label>
                      </div> 
                    </div> 
                  
                  
              
                  <div class="row">
                    <!--start category selector-->
                    <div class="col col m5 s12 push-m1">  
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
                     </div>
                      
                     <!--start status selector "new, old"-->
                     <div class="col m5 s12 push-m1">
                       <label><?php echo lang("STATUS")?></label>     
                       <select id="select-status" class="browser-default "> 
                         <option value="new" selected><?php echo lang("NEW")?></option>
                         <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
                         <option value="used"><?php echo lang("USED")?></option>
                         <option value="old"><?php echo lang("OLD")?></option>
                     </select>
                     
                     </div>         
                   </div>
                   <div class="row submit-containter">
                   <input type="submit"  value="<?php echo lang("EDIT"); ?> " class="waves-effect waves-light btn right ">
                  </div>       
                </form>
             </div>



   <?php 
        
        
    // edit fetch item form 
        
    } elseif ($do == "edit_item") {
           //Update item info
    
           $itemID  = $_POST['ajxID'];
           $Name    = filter_var($_POST['ajxName'], FILTER_SANITIZE_STRING);
           $descrp  = filter_var($_POST['ajxDescription'], FILTER_SANITIZE_STRING);
           $price   = filter_var($_POST['ajxPrice'], FILTER_SANITIZE_NUMBER_INT);
           $item_num = filter_var($_POST['ajxItemNum'], FILTER_SANITIZE_NUMBER_INT);
           $made_in = filter_var($_POST['ajxMadeIn'], FILTER_SANITIZE_STRING);
           $status  = $_POST['ajxStatus'];
           $cateId  = $_POST['ajxCateId'];
           $tags    = filter_var($_POST['ajxTags'], FILTER_SANITIZE_STRING);
 




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
                         <td class='errmsg-php center-align' style='display:block'><?php echo $Err; ?></td> 
                       
                     <?php } 

           }else {
            
           $stmt=$con->prepare("UPDATE 
                                 items
                               SET
                                 Name =?, Description =?, Price =?, nums_item =?, Made_in =?, Status =?, Cate_ID =?, tags = ?
                               WHERE 
                                 Item_ID = ? ");  //Info Updating

            $stmt->execute([$Name, $descrp, $price, $item_num, $made_in, $status, $cateId, $tags, $itemID]); //insert new values
              
            showItemInfo($itemID);   
  
       } 
        // sent Modified data to item page back 
        
        
    } elseif ($do == "buy_item"){
        

        $item_id   = $_POST["ajxID"];
        
        $user_id   = $_SESSION["ID"];
        
        $owner_id  = $_POST["ajxOwnerId"];
        
        $price     =  filter_var($_POST["ajxItemPrice"], FILTER_SANITIZE_NUMBER_INT);
        
        $nums_item =  $_POST["ajxNumsItem"];
    
        if($nums_item > "0") {
            
            $total_price = $price   * $nums_item ;
            
            if (getSpecialInfoOnce("users", "userID", "", $user_id, "", "")['Amount'] >= $total_price){
                
                 // Reduce the current user's Amount
                
                 $stmt= $con->prepare("UPDATE users SET Amount = Amount - ? WHERE userID = ?");
        
                 $stmt-> execute([$price , $user_id]);
                
                
                 // Send money to the owner
                
                 $stmt2= $con->prepare("UPDATE items SET nums_item = nums_item - ? WHERE Item_ID = ?");
        
                 $stmt2-> execute([$total_price, $item_id]);
                
                 // Send money to the owner
                
                 $stmt3= $con->prepare("UPDATE users SET Amount = Amount + ? WHERE userID = ?");
        
                 $stmt3-> execute([$total_price, $owner_id]);
                
                

                
                
                 $stmt4= $con->prepare("INSERT INTO 
                                              buy_operations
                                                (`Seller_ID`, `Buyer_ID`, `nums_item`, `Item_ID`, Total_Amount, `Total_Price`, `Time_Of_Purchase`)
                                              VALUES 
                                                (:zSeller_ID, :zBuyer_ID, :znums_item, :zItem_ID, :zTotal_Amount, :zTotal_Price,  now())");
                
                 $stmt4->execute(["zSeller_ID"         => $owner_id,
                                   "zBuyer_ID"         => $user_id, 
                                   "znums_item"        => $nums_item,
                                   "zTotal_Price"      => $total_price,
                                   "zItem_ID"          => $item_id,
                                   "zTotal_Amount"     => $price 
                                 ]); 
           

                $stmt5= $con->prepare("INSERT INTO 
                                              nontifications
                                                (`user_ID`, `Actor_ID`, `source_id`, `activity_type`, `date`, `is_seen`)
                                              VALUES 
                                                (:zuser_ID, :zActor_ID, :zsource_id, :zactivity_type, now(), 0)");
                
                 $stmt5->execute(["zuser_ID"         => $owner_id,
                                   "zActor_ID"       => $user_id, 
                                   "zsource_id"      => $item_id,
                                   "zactivity_type"  => "Sold"
                                 ]);  
                echo 'yes';
            } else {
                echo getSpecialInfoOnce("users", "userID", "", $user_id, "", "")['Amount'] . "<br>";
                echo "You haven't enough money in your account";
                
            }
            
        } else {
            
            echo "this item is SOLD";
            
        }
        
        
    } elseif ($do == "add_money"){
        
       $user_id     = $_POST["ajxID"];
                             
       $added_money = $_POST["ajxAddedMoney"];
        
       $stmt= $con->prepare("UPDATE users SET Amount= Amount + ? WHERE userID = ?");
        
       $stmt-> execute([$added_money, $user_id]);
    
       $stmt2= $con->prepare("INSERT INTO 
                                      debit_deposit_operations
                                        (`userID`, `Amount_Deposited`, `Data`)
                                      VALUES 
                                        (:zuserID, :zAmount_Deposited,  now())");
        
        $stmt2->execute(["zuserID"            => $user_id,
                         "zAmount_Deposited"  => $added_money]);
                      


            
            
        echo "$". getSpecialInfoOnce("users", "userID", "", $user_id, "")['Amount'];    
            
            
            
            
    } elseif ($do == "add_comment") {
        
        $comment    = filter_var($_POST['ajxComment'], FILTER_SANITIZE_STRING);
        
        $item_ID    = $_POST["ajxID"];
        
        $owner_id    = $_POST["ajxOwnerID"];
        
        $check = checkItem("Item_ID", "items", $item_ID);
        
        if ($check > 0){
            $stmt = $con->prepare("INSERT INTO
                                                comments
                                                     (Comment, Status, Comment_Data, Item_ID, Member_ID)
                                                VALUES 
                                                     (:zComment, 1, now(), :zItem_ID, :zMember_ID)");

            $stmt->execute(["zComment"     => $comment,
                            "zItem_ID"     => $item_ID,
                            "zMember_ID"   => $_SESSION['ID']]);
           

            $stmt5= $con->prepare("INSERT INTO 
                                              nontifications
                                                (`user_ID`, `Actor_ID`, `source_id`, `activity_type`, `date`, `is_seen`)
                                              VALUES 
                                                (:zuser_ID, :zActor_ID, :zsource_id, :zactivity_type, now(), 0)");
                
            $stmt5->execute(["zuser_ID"              => $owner_id,
                                  "zActor_ID"        => $_SESSION['ID'], 
                                  "zsource_id"       => $item_ID,
                                  "zactivity_type"   => "comment"
                                 ]); 
        }else {
            
            echo "kusha";
        }
        
        // and sent item comments back
        
        showComment($item_ID);
        
        
        
    } elseif ($do == "update_comment") {
        

            $commentID = $_POST['ajxCommentID'];
          
            $comment = filter_var($_POST['ajxComment'], FILTER_SANITIZE_STRING);
        
            $item_ID = $_POST["ajxID"];
        
            //check if ID allredy exists in database
         
            $check = checkItem("C_ID", "comments", $commentID) ;
                  
            // check if this id has info in database, when yes then activate the user
         
            if ($check > 0){
                     
            $stmt=$con->prepare("UPDATE 
                                   comments
                                 SET
                                   comment =?
                                 WHERE 
                                   C_ID = ?");  //comment sUpdating

            $stmt->execute([$comment, $commentID]); //insert new value
         
             } else {
                echo "don't work ";
            }
        
        
        showComment($item_ID);

        }
    } //ende 
    
    
ob_end_flush();
?>