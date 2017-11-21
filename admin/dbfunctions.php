<?php 

 include "init.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
     $do = isset($_POST['do']) ? $_POST['do'] : 'mange';
    
    // to know from which page this request is ====> get the link "HTTP_REFERER" then send data back just to this page
    
     $fromPage = isset( $_SERVER['HTTP_REFERER']) ?  $_SERVER['HTTP_REFERER'] : '';  
    
     $data_required = !empty($_POST['ajxdata_required']) ?  $_POST['ajxdata_required'] : 'no_required';  
 
//    <================== start mamber page ==================>

    if($do == "insert_user"){
         
          //Insert new user info 
        
           $userName = filter_var( $_POST["ajxName"], FILTER_SANITIZE_STRING);
           $password1= sha1($_POST["ajxPassword1"]);
           $password2= sha1($_POST["ajxPassword2"]);
           $group    = $_POST["ajxGroup"];
           $email    = filter_var(  $_POST["ajxEmail"],  FILTER_SANITIZE_EMAIL);
           $fullName = filter_var(  $_POST["ajxFullname"], FILTER_SANITIZE_STRING);
           $fotoName = $_FILES['foto']['name'];
           $fotoSize = $_FILES['foto']['size'];
           $fotoTmp  = $_FILES['foto']['tmp_name'];
           $fotoType = $_FILES['foto']['type'];
       
        
           //Allowed extensions array
         
           $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
         
           $value = explode(".", $fotoName);
           $fotoextension = strtolower(end($value));
        
            //SHA1 password <=> empty value
             
            $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  
        
            // Make an error array for add form 
         
            $addFormErr = [];
         
           if (empty($userName) or strlen($userName) > 20){
               
               $addFormErr[] = lang("PHP_ERRMSG_NAME");
           }
        
           if (!in_array($fotoextension, $fotoAllowedExtension)) {
              
                $addFormErr[] = lang("PHP_ERR_FOTO_EXTENTIONS");
           }
           if(empty($fotoName)) {
              
               $addFormErr[] = lang("PHP_ERR_FOTO_EMPTY");
           }
         
           if ($fotoSize > 4194304){
              
                $addFormErr[] = lang("PHP_ERR_FOTO_SIZE");
              
           }
         
           if(empty($email)){
               
               $addFormErr[] = "JIJIJIJIIJIJI" . lang("PHP_ERRMSG_EMAIL");
           }
         
           if(empty($fullName) or ($fullName) > 25 ){
               
               $addFormErr[] = lang("PHP_ERRMSG_FULLNAME"); 
           }
         
           if ($password1 == $emptyPass){
               
              $addFormErr[] = lang("PHP_EMPTY_PASS");
           }
        
           if ($password1 != $password2){
               
              $addFormErr[] = lang("PHP_DEFFRENT_PASS");
           } 
             
             // function to check Email Adress if it's reapeted, if yes => 1; but if no => return 0
             
              $check = checkItem("Email", "users", $email); 
             
           if ($check == 1){
               
              $addFormErr[] = lang("PHP_REAPETED_EMPTY");
           }
             
          
              
          // End  error array for add form 
             
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
               
               $foto = rand(0, 100000). "_" . $fotoName;
               
               move_uploaded_file($fotoTmp, "../uplaodedFiles/userFotos/" . $foto);
               
               $stmt = $con->prepare("INSERT INTO
                                                users
                                                     (userName, Foto, password, Email, fullName, GroupID, regStatus, data)
                                                VALUES 
                                        (:zusername, :zfoto, :zpassword, :zEmail, :zfullName, :zGroupID, 1, now())");
                   
                $stmt->execute(["zusername"  => $userName,
                                "zfoto"      => $foto,
                                "zpassword"  => $password1,
                                "zEmail"     => $email,
                                "zfullName"  => $fullName,
                                ":zGroupID"  => $group]);
               
         
         }
         
     // End inset new user 
        
    }elseif($do == "delete") {
         
      $userID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;

      //check if ID is allredy exist in Datebase

      $check = checkItem("userID", "users", $userID)  ;

      // check if id info has been stored in database, if yes then delete user

      if ($check > 0){

          $stmt=$con->prepare("DELETE FROM users  WHERE userID = :zuserID");

          $stmt->bindParam(":zuserID", $userID);

          $stmt->execute();

      }
    
    }elseif($do == "update_user_info"){
         
          //Insert new user info 
        
           $userID   = $_POST["ajxId"];     
           $userName = filter_var( $_POST["ajxUserName"], FILTER_SANITIZE_STRING);
           $email    = filter_var( $_POST["ajxEmail"], FILTER_SANITIZE_EMAIL);
           $fullName = filter_var( $_POST["ajxFullname"], FILTER_SANITIZE_STRING);
           $group    = $_POST["ajxGroup"];
        
           // Make an error array for add form 
        
           $addFormErr = [];  
        
           // IF there is foto recived then check it
        
           if(!empty($_FILES)){
               
               $fotoName = $_FILES['foto']['name'];
               $fotoSize = $_FILES['foto']['size'];
               $fotoTmp  = $_FILES['foto']['tmp_name'];
               $fotoType = $_FILES['foto']['type'];

               // foto allowed extensions

               $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];   


               $value = explode(".", $fotoName);

               $fotoextension = strtolower(end($value));

               if (!in_array($fotoextension, $fotoAllowedExtension)) {

                   $ErrArray[] = lang("PHP_ERR_FOTO_EXTENTIONS");
               }


               if ($fotoSize > 4194304){

                   $ErrArray[] = lang("PHP_ERR_FOTO_SIZE");

               }       
               
               $fotoExist = "";
               
           }
        
           // set new password just if user changes it
                                                                                    
           $password = empty($_POST["ajxPass1"]) || empty($_POST["ajxPass2"])? $_POST["ajxOldPass"]: sha1($_POST["ajxPass1"]);
         
           //SHA1 password <=> empty value
             
           $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  
        

         
           if (empty($userName) or strlen($userName) > 20){
               
               $addFormErr[] = lang("PHP_ERRMSG_NAME");
           }
        
           if (filter_var($email, FILTER_VALIDATE_EMAIL) != true){
             
              $ErrArray[] = lang("ERRMSG_VALIDATE_EMAIL");
           }
         
    
         
           if(empty($email)){
               
               $addFormErr[] = lang("PHP_ERRMSG_EMAIL");
           }
         
           if(empty($fullName) or ($fullName) > 25 ){
               
               $addFormErr[] = lang("PHP_ERRMSG_FULLNAME"); 
           }
         
           if ($password == $emptyPass){
               
              $addFormErr[] = lang("PHP_EMPTY_PASS");
           } 
             
             // function to check Email Adress if it's reapeted, if yes => 1; but if no => return 0
             
              $check = checkItem("Email", "users", $email); 
             
           if ($check > 1){
               
              $addFormErr[] = lang("PHP_REAPETED_EMPTY");
           }
             
          
              
          // End  error array for add form 
             
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
               
              if (isset($fotoExist)){ 
                
                 $foto = rand(0, 100000). "_" . $fotoName;

                 move_uploaded_file($fotoTmp, "../uplaodedFiles/usersFoto/" . $foto);  
               
                 $stmt=$con->prepare("UPDATE 
                                         users
                                     SET
                                         username = ?, Foto =?, Email = ?, fullName = ?, password = ? 
                                     WHERE 
                                         userID = ? ");  //Info Updating

                $stmt->execute([$userName, $foto, $email, $fullName, $password, $userID]); //insert new values 
                  
            } else {
                  
                 $stmt=$con->prepare("UPDATE 
                                         users
                                     SET
                                         username = ?, Email = ?, fullName = ?, password = ? 
                                     WHERE 
                                         userID = ? ");  //Info Updating

                 $stmt->execute([$userName, $email, $fullName, $password, $userID]); //insert new values 
              }


       }
        

        
   }elseif($do == "activate") {
         
           $userID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("userID", "users", $userID)  ;
                  
                  // check if this id has info in database, when yes then activate the user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE users SET regStatus = 1 WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                      
                      $stmt->execute();
         
                   }
         
        
        //      <============= end members page ==============>  
        
        
        
        
//      <============= start categories page ==============>  
        
        
    }elseif($do == "insert_cate"){
        
               //prepare new Categorie info

               $CateName     = $_POST['ajxName'];
               $parent       = $_POST['ajxParent'];
               $description  = $_POST['ajxDescription'];
               $order        = $_POST['ajxOrder'];
               $vis          = $_POST['ajxVisibilty'];
               $comment      = $_POST['ajxComment'];
               $ads          = $_POST['ajxAds'];


                // Make an Error Array for Add form 

                $addFormErr = [];

               if (empty($CateName) or strlen($CateName) > 25){

                   $addFormErr[] = lang("PHP_ERRMSG_NAME");
               }

                 // function to check the name if it reapeted, when yes => 1; but when no => return 0

                 $check = checkItem("Name", "categories", $CateName ); 

               if ($check > 0){

                  $addFormErr[] = lang("PHP_REAPETED_EMPTY");
               }



              // End  Error Array for Add form 

                // check if the values are approved values 

               if (!empty($addFormErr)){

                 //when yes then Echo this Error Messege
               ?>

                     <div class = "container">

                         <!-- print the caught Errorrs-->

                         <?php foreach($addFormErr as $Err){ ?> 
                         <div class="row">
                           <div class='errmsg_php' style='display:block'>

                             <!--  Err : Erorr msg -->
                             <p class='msg'><?php echo $Err; ?></p> 
                           </div>
                        </div>
                         <?php } ?>
                     </div>

             <?php

                // when yes then insert the new user to Datebase

               }else {

                   $stmt = $con->prepare("INSERT INTO
                                                    categories
                                                         (Name, Parent, Description, ordering, 	Visbility, Allow_Comment, Allow_Ads)
                                                    VALUES 
                                                         (:zName, :zParent, :zDescription, :zordering, :zVisbility, :zAllow_Comment, :zAllow_Ads)");

                    $stmt->execute([":zName"           => $CateName,
                                    "zParent"          => $parent,
                                    "zDescription"     => $description,
                                    "zordering"        => $order,
                                    "zVisbility"       => $vis,
                                    "zAllow_Comment"   => $comment,
                                    "zAllow_Ads"       => $ads ,
                                   ]);

               
           } 
        
        
        
    } elseif($do == "cate_update"){
         
        //Update Categories info            

        $NewCateName = $_POST['ajxName'];

        $NewDescrp = $_POST['ajxDescription'];

        $NewOrder = $_POST['ajxOrder'];
        
        $parent = $_POST['ajxParent'];

        $ID = $_POST['ajxID'];
       

       //  anther way to show errors <====> check if all values are approved 

       if(strlen($NewCateName) < 3) {?>

          <!--  PHP error msg  in case that Jave script disables-->

           <div class='errmsg' style='display:block'> 
              <p class='msg'> <?php echo lang('PHP_CATE_NAME')?> </p> <br>
           </div>

<?php } else {
                   
           $stmt=$con->prepare("UPDATE 
                                 categories
                               SET
                                 Name = ?, Parent =?, Description = ?, ordering= ? 
                               WHERE 
                                 ID = ? ");  //Info Updating

            $stmt->execute([$NewCateName, $parent, $NewDescrp, $NewOrder, $ID]); //insert new values

       }
        
        
        
   } elseif($do == "change_cate_status"){ 
        
        // get category id 
        
         $cate_ID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;
    

         // get category column name with new status (1 or 0).
        
         $cate_col_name = $_POST['ajxCateColName'];
        
         $stus = $_POST['ajxStatus'];
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("ID", "categories", $cate_ID)  ;
                  
                  // check if this id has info in database, when yes then change the status the category
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE 
                                               categories SET
                                                     $cate_col_name = '$stus' 
                                               WHERE
                                                      ID = :zid");
                      
                      $stmt->bindParam(":zid", $cate_ID);
                      
                      $stmt->execute();
         
                   }    
         
        
    }elseif($do == "cate_delete") {
         
      $cateID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;

      //check if ID is allredy exist in Datebase

      $check = checkItem("ID", "categories", $cateID)  ;

      // check if id info has been stored in database, if yes then delete user
   
      if ($check > 0){

          $stmt=$con->prepare("DELETE FROM categories WHERE ID = :zcateID");

          $stmt->bindParam(":zcateID", $cateID);

          $stmt->execute();

      }else {
          echo "no";
      }
  
     
    //      <============= end categories page ==============>  
    
    
        
        
    //      <============= start items page ================>  
    
    
    } elseif($do == "insert_item"){
         
          //Insert new user info 
             
           $Name    = $_POST['ajxName'];
           $descrp  = $_POST['ajxDescription'];
           $price   = $_POST['ajxPrice'];
           $made_in = $_POST['ajxMadeIn'];
           $status  = $_POST['ajxStatus'];
           $userId  = $_POST['ajxUserId'];
           $tags    = $_POST['ajxTags'];
           $cateId  = $_POST['ajxCateId'];

           $count = count($_FILES);
           // Make an error array for add item form 
         
           $addFormErr = [];
           $asutiv_arr = [];
        
           $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
           
           // make loop to controll all fotos, which received
        
           foreach ($_FILES as $value => $name){
               
               $foto = str_replace(".", "_", reset($name));
               
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
        
        
            
//           $serialized_fotos_array = serialize($fotosName); 
//           $unserialized_array = unserialize($serialized_array);
        
        
         
           if ($count > 8){
               
               $addFormErr[] = "foto shuld not be more than 8 fotos";
           }
        
           if (empty($Name)){
               
               $addFormErr[] = lang("PHP_ERRMSG_ITEM_NAME");
           }
         
           if(empty($descrp)){
               
               $addFormErr[] = lang("PHP_ERRMSG_DSCRP");
           }
         
           if(empty($price) ){
               
               $addFormErr[] = lang("PHP_ERRMSG_PRICE"); 
           }
       
           if (strpos($tags, " ")){
               
               $addFormErr[] = lang("PHP_ERRMSG_TAGS");
           }
        
           if(empty($made_in )){
               
               $addFormErr[] = lang("PHP_ERRMSG_MADE_IN"); 
           }
          
           if(empty($cateId)){
               
               $addFormErr[] = lang("PHP_ERRMSG_CATE"); 
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
               
               $fotosName_array = []; 
               
               foreach ($asutiv_arr as $tmp => $imgName){
                   
                   move_uploaded_file($tmp, "../uplaodedFiles/itemsFotos/" . $imgName);
                   
                   $fotosName_array[] = $imgName;
               }
               
               $serialized_foto_array = serialize($fotosName_array);
               
               
               
               $stmt = $con->prepare("INSERT INTO
                                                items
                                                     (Name, Fotos, Description, Price, Made_in, Status, Add_Data, approve, Cate_ID, Member_ID, tags)
                                                VALUES 
                                                     (:zName, :zfotos, :zdescrp, :zPrice, :zMade_in, :zStatus, now(), 1,:zcateID, :zmemberID, :ztags)");
               
                $stmt->execute(["zName"    => $Name,
                                "zfotos"   => $serialized_foto_array,
                                "zdescrp"  => $descrp,
                                "zPrice"   => $price,
                                "zMade_in" => $made_in,
                                "zStatus"  => $status,
                                "ztags"    => $tags,
                                "zcateID"  => $cateId,
                                "zmemberID"=> $userId]);
               
         
         }
         
     // End inset new item 
        
    // Start delete item    
        
    }elseif($do == "delete_item") {
         
      $itemID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;

      //check if ID is allredy exist in item table

      $check = checkItem("Item_ID", "items", $itemID)  ;

      // check if id info has been stored in database, if yes then delete item

      if ($check > 0){

          $stmt=$con->prepare("DELETE FROM items  WHERE Item_ID = :zItemID");

          $stmt->bindParam(":zItemID", $itemID);

          $stmt->execute();

      }
    
    }elseif($do == "update-item"){
         
           //Update item info
    
           $itemID  = $_POST['ajxId'];
           $Name    = $_POST['ajxName'];
           $descrp  = $_POST['ajxDescription'];
           $price   = $_POST['ajxPrice'];
           $made_in = $_POST['ajxMadeIn'];
           $status  = $_POST['ajxStatus'];
           $userId  = $_POST['ajxUserId'];
           $cateId  = $_POST['ajxCateId'];
           $tags    = $_POST['ajxTags'];

       // check if all values are approved 

        
          $addFormErr = [];
         
           if (empty($Name)){
               
               $addFormErr[] = lang("PHP_ERRMSG_ITEM_NAME");
           }
         
           if(empty($descrp)){
               
               $addFormErr[] = lang("PHP_ERRMSG_DSCRP");
           }
         
           if(empty($price) ){
               
               $addFormErr[] = lang("PHP_ERRMSG_PRICE"); 
           }
        
           if(empty($made_in )){
               
               $addFormErr[] = lang("PHP_ERRMSG_MADE_IN"); 
           }
        
           if (strpos($tags, " ")){
               
               $addFormErr[] = lang("PHP_ERRMSG_TAGS");
           }
        
           if(empty($cateId)){
               
               $addFormErr[] = lang("PHP_ERRMSG_CATE"); 
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
                                 Name = ?, Description = ?, Price = ?, Made_in = ?, Status = ?, Cate_ID = ?, Member_ID = ?, tags = ?
                               WHERE 
                                 Item_ID = ? ");  //Info Updating

            $stmt->execute([$Name, $descrp, $price, $made_in, $status, $cateId, $userId, $tags, $itemID]); //insert new values
  
       }
        

        
   }elseif($do == "approve_item"){
        
            $itemID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("item_ID", "items", $itemID)  ;
                  
                  // check if this id has info in database, when yes then activate the user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE items SET approve = 1 WHERE item_Id = :zitemID");
                      
                      $stmt->bindParam(":zitemID", $itemID);
                      
                      $stmt->execute();
         
                   }    
         
        // comment manger  will appeared when name of item in items.php page is  clicked 
        
        
        
        //      <============= End items page ================> 
        
        
        
        //      <============= start Commens page ================> 
         
    }elseif($do == "delete_comment") {
         
      $commentsID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;

      //check if ID is allredy exist in item table

      $check = checkItem("C_ID", "comments", $commentsID);

      // check if id info has been stored in database, if yes then delete item

      if ($check > 0){

          $stmt=$con->prepare("DELETE FROM comments  WHERE C_ID = :zCommentsID");

          $stmt->bindParam("zCommentsID", $commentsID);

          $stmt->execute();

      }
    // approve comment change status from 0 to 1
        
    } elseif($do == "approve_comment"){
        
            $commentsID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;
         
                   //check if ID allredy exists in database
         
            $check = checkItem("C_ID", "comments", $commentsID) ;
                  
                  // check if this id has info in database, when yes then activate the user
         
            if ($check > 0){
                     
                $stmt=$con->prepare("UPDATE comments SET status = 1 WHERE C_ID = :zCommentsID");
                      
                $stmt->bindParam(":zCommentsID", $commentsID);
                      
                $stmt->execute();
         
              } 
    // make an edit on comment 
          
    }elseif($do == "update_comment"){
        
//            echo ($_POST);
            $commentID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) :0;
          
            $comment = $_POST['ajxcomment'];
        
            //check if ID allredy exists in database
         
            $check = checkItem("C_ID", "comments", $commentID) ;
                  
            // check if this id has info in database, when yes then activate the user
         
            if ($check > 0){
                     
            $stmt=$con->prepare("UPDATE 
                                 comments
                               SET
                                 comment =?
                               WHERE 
                                 C_ID = ?");  //Info Updating

            $stmt->execute([$comment, $commentID]); //insert new value
         
             } 
    }
     //      <============= End Commens page ================> 
    
        
        
     // start controll this "php code" result. to which page this result should be sended back
    
    //http_referer have "members", then send this result just to "members page" 
    
    if(preg_match('/members/', $fromPage)) { 
        
         // select pending members "not activated members", just if user click on pending members in dashboard page
        
         $query = $_POST['ajxdata_required'] == 'pending'? "AND regStatus = 0" : " "; 
         
         // select all users except admin
        
         $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY userID DESC ");
         
         $stmt->execute();
         
         // fetch all users with theire info from Datebase
         
         $rows =$stmt->fetchAll(); 
    
         // start table body
                
         foreach ($rows as $row){ 
             
?>
             <tr class="table-row"> 
               <td class = 'userID'><?php echo $row['userID']?></td>
               <td class = 'username search-in'><?php echo $row['username']?></td>
               <?php  $img = empty($row['Foto']) ? "foto1.JPG" : $row['Foto']?>    
               <td class = 'foto'><img class="materialboxed" height="50px" width="50px" onclick="$('.materialboxed').materialbox();" src="../uplaodedFiles/usersFoto/<?php echo $img; ?>"></td>
               <td class = 'Email search-in'><?php echo $row['Email']?></td>
               <td class = 'fullName search-in'><?php echo $row['fullName']?></td>
               <td>
                  <a href="items.php?required=Member&ID=<?php echo $row['userID'];?>">
                    (<?php echo checkItem("Member_ID", "items", $row['userID']);?>)
                  </a>
               </td>     
               <td class = 'comments-times'>
                 <a  href="comments.php?required=Member&ID=<?php echo $row['userID'];?>"><?php echo checkItem("Member_ID", "comments", $row['userID']);?>
                </a>
               </td>
               <td class = 'date'><?php echo $row['data'] ?></td>

               <!-- start table body   -->

                 <!-- Note <=========> in "sure Msg" <to delete user> from jave script href will equal #modal + userID  
                  (#modal+$row['userID']) /without this, the fuction  will selet and delet just the first id       -->
              
              <td class="control-user-table">
                 <!--Activate Button--> 
              <?php 

                if ($row['regStatus'] == 0) { ?>
                      <!--if user is not activated then show unactivated button-->
                     <a data-id="<?php echo $row['userID'] ?>" data-do ='activate' data-place ="#last-users-list, #users-table-body"  class='ajax-click btn-floating pink darken-4'>
                       <i class="material-icons">thumb_down</i>
                     </a>

                <?php }else {?>
                  
                      <!--else if user is activated then show OK button-->
                      <a class='btn-floating light-green accent-3'>
                       <i class="material-icons">thumb_up</i>
                     </a>

                 <?php }?>

                 <!-- end Activate  Button--> 

                 <!--Edit Butten-->
                <!-- print user info as "custom attr" in this buttom, it will be useful  if admin want to change any user info -->
                 <a class='btn-floating teal update-btn'
                    data-id='<?php echo $row['userID']; ?>' 
                    data-userNname='<?php echo $row['username']; ?>'
                    <?php $img = empty($row['Foto']) ? "foto1.JPG" : $row['Foto'];  ?>
                    data-foto='<?php echo $img ?>'
                    data-email='<?php echo $row['Email']; ?>'
                    data-fullname='<?php echo $row['fullName']; ?>'
                    data-oldPass='<?php echo $row['password']; ?>'
                    >
                   <i class='large material-icons'>mode_edit</i>
                 </a>
                 <!--Edit Butten-->

                 <!--Delete Butten-->
                 <a class='btn-floating red modal-trigger' onclick="$('.modal').modal();"  href="#modal<?php echo $row['userID']; ?>">
                   <i class='large material-icons '>delete_forever</i>
                 </a>
                 <!--Delete Butten-->

                 <div id="modal<?php echo $row['userID']; ?>" class='modal' >
                   <div class='modal-content'>
                     <h4><?php echo lang("SURE_MSG")?> </h4>
                     <p><?php echo lang("SURE_FULLNAME_MSG")?> <?php echo $row['fullName']?></p>
                  </div>

                  <div class='modal-footer'>
                    <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                    <a  class='modal-action ajax-click modal-close waves-effect waves-green btn-flat' data-id='<?php echo $row['userID']; ?>' data-place = '#users-table-body' data-do ='delete'>Agree</a>
                 </div>
                  <!--Delete Butten-->   

             </div>
            </td>
            </tr>
            

          <?php  } 
        
       //chick if http_referer contains dashpoard, if yes then show this list just inside it
        
    }elseif (preg_match('/dashboard/', $fromPage)){ 
        ?>
          <li class="collection-header users"><h4><?php echo lang("LATEST_USER")?></h4></li>
            <?php
         
             //function to bring just the last 5 registerd users
         
              $users = getLatest("*", "users", "userID", 5);
     
                 foreach($users as $user){?>
              
                    <!-- List of the last 5 regestered users und theres activate status-->
               
                   <li class="collection-item">
                       <div><?php echo $user['username'] ?>
                           
                           <a class="secondary-content update-btn" 
                              data-id        ='<?php echo $user['userID']; ?>'
                              data-userNname ='<?php echo $user['username']; ?>'
                              <?php $img = empty($row['Foto']) ? "foto1.JPG" : $row['Foto'];  ?>
                              data-foto='<?php echo $img ?>'
                              data-email     ='<?php echo $user['Email']; ?>'
                              data-fullname  ='<?php echo $user['fullName']; ?>'
                              data-oldPass   ='<?php echo $user['password']; ?>'>
                               <i class="material-icons">mode_edit</i>
                           </a>

                           <!-- check the register Status-->

                         <?php if ($user['regStatus'] == 0){ ?>
                           
                                    <!--if user is not activated then show unactivated button-->
                                    <a data-id="<?php echo $user['userID'] ?>" data-do ='activate' data-place ="#last-users-list, #users-table-body"  class='ajax-click secondary-content'>
                                      <i class='material-icons'>thumb_down</i>
                                    </a>
                            <?php }?>
                      </div>
                   </li>
            
              <?php } ?>
        
<!--        //end dashboard result page -->
        
        
        <||>
        
<!--    //check current page, if this categories then send this result to it back.-->
         
       
          <li class="collection-header items"><h4><?php echo lang("LATEST_ITEMS")?></h4></li>
            <?php
         
             //function to bring just the last 5 registerd users
         
              $items = getLatest("*", "items", "Item_ID", 5);
     
                 foreach($items as $item){?>
              
                    <!-- List of the last 5 regestered users und theirs activate status-->
               
                   <li class="collection-item">
                       <div><?php echo $item['Name'] ?>
                           
                           <a class="secondary-content update-btn" 
                              item-id        ='<?php echo $item['Item_ID']; ?>'
                              item-Name      ='<?php echo $item['Name']; ?>'
                              item-descrp    ='<?php echo $item['Description']; ?>'
                              made-in        ='<?php echo $item['Made_In']; ?>'
                              price          ='<?php echo $item['Price']; ?>'
                              status         ='<?php echo $item['Status']; ?>'
                              members-id     ='<?php echo $item['Member_ID']; ?>'
                              cate-id        ='<?php echo $item['Cate_ID']; ?>'>
                               
                              <i class="material-icons">mode_edit</i>
                           </a>

                         <!--find out if this item is approved-->

                         <?php if ($item['approve'] == 0 or $item['approve'] == null){ ?>
                           
                                    <!--if item is not approved then show unapproverd button--> 
                                    <a data-id="<?php echo $item['Item_ID'] ?>"
                                       data-do ='approve_item'
                                       data-place ="#, #last-items-list" 
                                       class='secondary-content ajax-click'>
                                      <i class='material-icons'>thumb_down</i>
                                    </a>
                            <?php }?>
                      </div>
                   </li>
                        
              <?php } 
        
        //end dashboard result page 
        
        
        
        
    //check current page, if this categories then send this result to it back.
        
   } elseif(preg_match('/categories/', $fromPage)){
        
        $stmt = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY ID DESC");
        
        $stmt->execute();
        
        //fetch all data
        
        $cates = $stmt ->fetchAll();
       
        foreach ($cates as $cate){
         
          //check if visibltly and comment and advertising is allowed , if yes then chenge the thier background-color to peacefully color by class name, but if no then chenge it to danger color
            
         if($cate['Visbility'] == 0){
             $cls_visibility = "not-allowed";
             $allow_visibility = "Not allowed";
         }else {
             $cls_visibility = "allowed";
             $allow_visibility = "allowed";
         }    
        
        
        if($cate['Allow_Comment'] == 0){
             $cls_comment = "not-allowed";
             $allow_comment = "Not allowed";
         }else {
             $cls_comment = "allowed";
             $allow_comment = "allowed";
         }   
            
            
        if($cate['Allow_Ads'] == 0){
             $cls_ads = "not-allowed";
             $allow_ads = "Not allowed";
         }else {
             $cls_ads = "allowed";
             $allow_ads = "allowed";
         }   
           
        //data-status :- which means the status for (Visbility, Allow_Comment, Allow_Ads) 0 or 1? || to send (onClick) on (li span) the opposite value to database by ajax to make edit on it   
        //col-name : which means name of column in database  
         ?>
              <li class="collection-item" 
                  cate-id = "<?php echo $cate['ID'];?>"
                  cate-name = "<?php echo $cate['Name'];?>"
                  cate-descrp = "<?php echo $cate['Description'];?>"
                  cate-order = "<?php echo $cate['Ordering'];?>"
                  cate-parent = "<?php echo $cate['Parent'];?>"
                  >
                  <div class="cate-controll">
                     <a  class="secondary-content update-btn">
                       <i class="material-icons ">border_color</i>
                    </a>
                    <a class="secondary-content modal-trigger delete-btn">
                      <i class="material-icons delete-btn modal-trigger" data-id="<?php echo $cate['ID'];?>"  href="#modal<?php echo $cate['ID'];?>">delete_forever</i>
                    </a>
                  </div>      
                  
                  <h3 class= 'cate-name search-in'>
                      <a href="items.php?required=Cate&ID=<?php echo $cate['ID'];?>">
                          <?php echo $cate['Name'];?></a>
                  </h3>
                  <p>items Nember : <span> <?php echo checkItem("Cate_ID", "items", $cate['ID']);?></span></p>
                  Description : <span class= 'descrp search-in'><?php echo $cate['Description'];?></span>
                  <p>Ordering : <?php echo $cate['Ordering'];?></p>
                      
                  <span class="<?php echo $cls_visibility; ?> ajax-click"
                        data-status = "<?php echo $cate['Visbility'] ;?>"
                        col-name = "Visbility"  
                        data-id = "<?php echo $cate['ID']; ?>"
                        data-do = "change_cate_status"
                        data-place = "#mange-cate">
                        Visbility : <?php echo $allow_visibility;?>
                  </span>
                      
                   <span class ='<?php echo $cls_comment;?> ajax-click' 
                         data-status = "<?php echo $cate['Allow_Comment'] ;?>"
                         data-id = "<?php echo $cate['ID']; ?>"
                         col-name = "Allow_Comment"  
                         data-do = "change_cate_status"
                         data-place = "#mange-cate">
                         Allow_Comment : <?php echo $allow_comment;?>
                   </span>
                      
                   <span class="<?php echo $cls_ads;?> ajax-click" 
                         data-status = "<?php echo $cate['Allow_Ads'];?>"
                         data-id = "<?php echo $cate['ID']; ?>"
                         col-name = "Allow_Ads" 
                         data-do = "change_cate_status"
                         data-place = "#mange-cate"> 
                         Allow_Advertising : <?php echo $allow_ads;?>    
                   </span>
                  </div>
             </li>

             <div id="modal<?php echo $cate['ID'];?>" class='modal'>
               <div class='modal-content center-align'>
                 <h4><?php echo lang("SURE_MSG")?> </h4>
                 <p><?php echo lang("SURE_CATE_NAME_MSG")?> <?php echo $cate['Name']?></p>
               </div>
               <div class='modal-footer'>
                 <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                 <a class='modal-action modal-close waves-effect waves-green btn-flat ajax-click' data-id='<?php echo $cate['ID']; ?>'  data-id='<?php echo $cate['ID']; ?>' data-place = '#mange-cate' data-do = 'cate_delete'>Agree</a>
               </div> 
             </div> 
        <?php     
            
        $stmt = $con->prepare("SELECT * FROM categories WHERE parent = {$cate['ID']} ORDER BY ID DESC");
        
        $stmt->execute();
        
        //fetch all data
        
        $cates = $stmt ->fetchAll();
       
        foreach ($cates as $cate){
         
          //check if visibltly and comment and advertising is allowed , if yes then chenge the thier background-color to peacefully color by class name, but if no then chenge it to danger color
            
         if($cate['Visbility'] == 0){
             $cls_visibility = "not-allowed";
             $allow_visibility = "Not allowed";
         }else {
             $cls_visibility = "allowed";
             $allow_visibility = "allowed";
         }    
        
        
        if($cate['Allow_Comment'] == 0){
             $cls_comment = "not-allowed";
             $allow_comment = "Not allowed";
         }else {
             $cls_comment = "allowed";
             $allow_comment = "allowed";
         }   
            
            
        if($cate['Allow_Ads'] == 0){
             $cls_ads = "not-allowed";
             $allow_ads = "Not allowed";
         }else {
             $cls_ads = "allowed";
             $allow_ads = "allowed";
         }   
           
        //data-status :- which means the status for (Visbility, Allow_Comment, Allow_Ads) 0 or 1? || to send (onClick) on (li span) the opposite value to database by ajax to make edit on it   
        //col-name : which means name of column in database  
         ?>
              <li class="collection-item cate-child" 
                  cate-id = "<?php echo $cate['ID'];?>"
                  cate-name = "<?php echo $cate['Name'];?>"
                  cate-descrp = "<?php echo $cate['Description'];?>"
                  cate-order = "<?php echo $cate['Ordering'];?>"
                  cate-parent = "<?php echo $cate['Parent'];?>"
                  >
                  <div class="cate-controll">
                     <a  class="secondary-content update-btn">
                       <i class="material-icons ">border_color</i>
                    </a>
                    <a class="secondary-content modal-trigger delete-btn">
                      <i class="material-icons delete-btn modal-trigger" data-id="<?php echo $cate['ID'];?>"  href="#modal<?php echo $cate['ID'];?>">delete_forever</i>
                    </a>
                  </div>      
                  
                  <h3 class= 'cate-name search-in child-decrp'>
                      <a href="items.php?required=Cate&ID=<?php echo $cate['ID'];?>">
                          <?php echo $cate['Name'];?></a>
                  </h3>
                  <p class="child-decrp">items Nember : <span> <?php echo checkItem("Cate_ID", "items", $cate['ID']);?></span></p>
                  <p class="child-decrp"> Description : <span class= 'descrp search-in'><?php echo $cate['Description'];?></span></p>
                  <p class="child-decrp">Ordering : <?php echo $cate['Ordering'];?></p>
                      
                  <span class="<?php echo $cls_visibility; ?> ajax-click"
                        data-status = "<?php echo $cate['Visbility'] ;?>"
                        col-name = "Visbility" 
                        data-do = "change_cate_status"
                        data-id = "<?php echo $cate['ID'];?>"
                        data-place = "#mange-cate">
                        Visbility : <?php echo $allow_visibility;?>
                  </span>
                      
                   <span class ='<?php echo $cls_comment;?> ajax-click' 
                         data-status = "<?php echo $cate['Allow_Comment'] ;?>"
                         col-name = "Allow_Comment"
                         col-name = "Allow_Ads" 
                         data-id = "<?php echo $cate['ID'];?>"
                         data-do = "change_cate_status"
                         data-place = "#mange-cate">
                         Allow_Comment : <?php echo $allow_comment;?>
                   </span>
                      
                   <span class="<?php echo $cls_ads;?> ajax-click" 
                         data-status = "<?php echo $cate['Allow_Ads'];?>"
                         col-name = "Allow_Ads"
                         data-do = "change_cate_status"
                         data-id = "<?php echo $cate['ID'];?>"
                         data-place = "#mange-cate"> 
                         Allow_Advertising : <?php echo $allow_ads;?>    
                   </span>
                  </div>
             </li>

             <div id="modal<?php echo $cate['ID'];?>" class='modal'>
               <div class='modal-content center-align'>
                 <h4><?php echo lang("SURE_MSG")?> </h4>
                 <p><?php echo lang("SURE_CATE_NAME_MSG")?> <?php echo $cate['Name']?></p>
               </div>
               <div class='modal-footer'>
                 <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                 <a class='modal-action modal-close waves-effect waves-green btn-flat ajax-click' data-id='<?php echo $cate['ID']; ?>' data-place = '#mange-cate' data-do = 'cate_delete' >Agree</a>
               </div> 
             </div>
            
        
    <?php }
            
      }
        
     //chick if http_referer contains comments, if yes then show this list just inside it    
        
    } elseif (preg_match('/items/', $fromPage) && $data_required != "comments" ) { 
         
        // check if there is special query 
        $data_required = !empty($_post['ajxdata_required']) ?  $_post['ajxdata_required'] : 'no_required'; 
        if ($data_required != "no_required"){
            
        $query ="WHERE items.$data_required"; 
            
        } else {
            
            $query =" "; 
            
        }

         // select all items and make a two new column for category name and user Name, who posted the item 
        
         $stmt = $con->prepare(" SELECT 
                                     items.* ,
                                     categories.Name AS Cate_Name, 
                                     users.username AS User_Name 
                                 FROM
                                     items 
                                 INNER JOIN
                                     categories 
                                 ON 
                                     categories.ID = items.Cate_ID
                                 INNER JOIN 
                                     users
                                 ON 
                                     users.userID = items.Member_ID 
                                     
                                     $query ORDER BY Item_ID DESC");
 
         $stmt->execute();
         
         //fetch all items with their info from Datebase
         
         $rows =$stmt->fetchAll(); 
    
          //start table body
                
         foreach ($rows as $row){ 
             
         $item_ID = $row['Item_ID'];     
?>
             <tr class="table-row"> 
             <td class = 'itemID search-in'><?php echo $item_ID ?></td>
             <td class = 'ItemName search-in ajax-click' data-required ="comments" data-id = "<?php echo $item_ID ?>" data-place ="#comments-item"><?php echo $row['Name']?></td>
             <!-- prepare fotos to show them    -->
             <?php
               
                if (empty($row['Fotos'])) {
                     $img = "<img class = ''  data-id='" . $item_ID . "'  height ='60' width ='60' src='../uplaodedFiles/itemsFotos/foto1.jpg'>"; 
                    
                } else {
                    $imgs = unserialize($row['Fotos']);
                    $img = "<img class =' modal-trigger item-foto' data-id='" . $item_ID . "'  height ='60' width ='60' src='../uplaodedFiles/itemsFotos/" . $imgs[0] . "'>"; 
                }  

              ?>     
             <td class = 'itemFoto'><?php echo $img; ?></td>
             <td><?php echo checkItem("Item_ID", "comments", $row['Item_ID']);?></td>     
             <td class = 'Descrp search-in'><?php echo $row['Description']?></td>
             <td class = 'MadeIn search-in'><?php echo $row['Made_In']?></td>
             <td class = 'Price search-in'><?php echo $row['Price'] ?></td>
             <td class = 'Status search-in'><?php echo $row['Status'] ?></td>
             <td class = 'cate-name search-in'><?php echo $row['Cate_Name'] ?></td>
             <td class = 'user-name search-in'><?php echo $row['User_Name'] ?></td>
             <td class = 'AddDate'><?php echo $row['Add_Data'] ?></td>
             <td class = 'tags search-in'><?php echo $row['tags'] ?></td>

<!--           start table body   -->

<!--              Note <=========> in "sure Msg" <to delete user> from jave script href will equal #modal + userID  
                  (#modal+$row['userID']) /without this, the fuction  will selet and delet just the first id       -->
              
             <td>
                 
           <?php if ($row['approve'] == "0") { ?>
                 <!--if item is not activated then show unactivated button-->
                 <a class='btn-floating pink darken-4 a ajax-click' data-do = 'approve_item'  data-place = "#item-table-body" data-id ='<?php echo $row['Item_ID']; ?>'>
                   <i class="material-icons">thumb_down</i>
                 </a>

           <?php }else { ?>
                  <!--else if user is activated then show OK button-->
                  <a class='btn-floating light-green accent-3'>
                   <i class="material-icons">thumb_up</i>
                 </a>

                 <?php }?>
                 <!--Edit Butten-->
                 <a class='btn-floating teal update-item-btn modal-trigger' href='#update-add-item'>
                   <i class='large material-icons'>mode_edit</i>
                 </a><!-- end Edit Butten-->
                 <!--Delete Butten-->
                 <a class='btn-floating red modal-trigger' onclick="$('.modal').modal();" data-id="<?php echo $row['Item_ID'];?>"  href="#modal<?php echo $row['Item_ID'];?>">
                   <i class='large material-icons '>delete_forever</i>
                 </a><!--Delete Butten-->
                 
                 <!-- start modal delete butten-->
                 <div id="modal<?php echo $row['Item_ID']; ?>" class='modal' >
                   <div class='modal-content'>
                     <h4><?php echo lang("SURE_MSG")?> </h4>
                     <p><?php echo lang("SURE_FULLNAME_MSG")?> <?php echo $row['Name']?></p>
                   </div>
                   <div class='modal-footer'>
                     <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                     <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                        data-do = 'delete_item'
                        data-place = "#item-table-body"
                        data-id='<?php echo $row['Item_ID']; ?>'>Delete</a>
                  </div><!--end modal Delete Butten--> 
                </div>
              <!-- Modal Structure -->
               <div id="items-foto-slider<?php echo $item_ID; ?>" class="modal modal-fixed-footer">
                 <div class="modal-content">
                   <div class="carousel ">
                       
                      <?php foreach ($imgs as $img)  {
                                echo "<a class='carousel-item' href='#one!'><img src='../uplaodedFiles/itemsFotos/$img'></a>";
                            } 
                       ?>
    
                   </div>
                 </div>
                 <div class="modal-footer">
                   <a class="modal-action modal-close waves-effect waves-green btn-flat ">close</a>
                 </div>
               </div> 
              </td>
            </tr>


          <?php  } 
        
       //chick if http_referer contains comments, if yes then show this list just inside it
        
    }elseif(preg_match('/comments/', $fromPage)) { 
         
        if (!empty($_post['ajxdata_required'])){
            
        $data_require = $_post['ajxdata_required'];
            
        $query ="WHERE comments.$data_require";   
            
        } else {
            $query =" ";  
        }
                
        
         // select all items and make a two new column for category name and user Name, who posted the item 
        
         $stmt = $con->prepare(" SELECT 
                                     comments.* ,
                                     items.Name AS Item_Name, 
                                     users.username AS User_Name 
                                 FROM
                                     comments 
                                 INNER JOIN
                                     items
                                 ON 
                                     items.Item_ID = comments.Item_ID 
                                 INNER JOIN 
                                     users 
                                 ON 
                                     users.userID = comments.Member_ID
                                     $query"); 
         $stmt->execute();
         
         //fetch all items with their info from Datebase

         $rows =$stmt->fetchAll(); 
    
          //start table body
                
         foreach ($rows as $row){ 
?>
             <tr class="table-row"> 
                 
             <td class = 'commenID'><?php echo $row['C_ID']?></td>
             <td class = 'UserName search-in'><?php echo $row['User_Name']?> </td>
             <td class = 'comment search-in'><?php echo $row['Comment']?> </td>
             <td class = 'itemName '><?php echo $row['Item_Name']?></td>
             <td class = 'writtenIn'><?php echo $row['Comment_Data']?></td>

              
             <td>
                 
           <?php if ($row['Status'] == null || $row['Status'] == "0") { ?>
                 <!--if item is not activated then show unactivated button-->
                 <a class='btn-floating pink darken-4 ajax-click' 
                    data-id ='<?php echo $row['C_ID']; ?>'
                    data-do = 'approve_comment'
                    data-place = "#comments-table-body">
                   <i class="material-icons">thumb_down</i>
                 </a>

           <?php } else { ?>
<!--                  else if user is activated then show OK button-->
                  <a class='btn-floating light-green accent-3' >
                   <i class="material-icons">thumb_up</i>
                 </a>

                 <?php }?>
                 <!--Edit Butten-->
                 <a class='btn-floating teal update-comment-btn'  data-id = >
                   <i class='large material-icons'>mode_edit</i>
                 </a> <!--end Edit Butten-->
                 
                 <!--Delete Butten-->
                 <a class='btn-floating red modal-trigger' data-id="<?php echo $row['C_ID'];?>"  href="#modal<?php echo $row['C_ID'];?>" onclick="$('.modal').modal();">
                   <i class='large material-icons '>delete_forever</i>
                 </a> <!--Delete Butten-->
                 
                  <!-- start modal delete butten-->
                 <div id="modal<?php echo $row['C_ID']; ?>" class='modal' >
                   <div class='modal-content'>
                     <h4><?php echo lang("SURE_MSG")?> </h4>
                     <p><?php echo lang("SURE_MSG_COMMENTS")?> <?php echo $row['User_Name']?></p>
                   </div>
                   <div class='modal-footer'>
                     <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>  
                     <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click' data-do = 'delete_comment'  data-place = "#comments-table-body" data-id='<?php echo $row['C_ID']; ?>'>Delete</a>
                  </div> <!--end modal Delete Butten -->
                </div>
              </td>
            </tr>
          <?php  } 
        
       //chick if http_referer contains dashpoard, if yes then show this list just inside it
        
    } elseif (preg_match('/items/', $fromPage) && $data_required == "comments") {
        
                // to get item id after editing or deleting commment 
        
                if ($do == "delete_comment" || $do ==  "update_comment"){
                    
                    $itemID = isset($_POST['ajxItemID']) && is_numeric($_POST['ajxItemID'])? intval($_POST['ajxItemID']) : 0;
                    
                } else {
                    
                    $itemID = isset($_POST['ajxID']) && is_numeric($_POST['ajxID'])? intval($_POST['ajxID']) : 0;
                    
                }


                $check = checkItem("item_ID", "items", $itemID) ;
                  
                 if ($check > 0){

                     $stmt = $con->prepare('SELECT 
                                                comments.*,
                                                users.username as written_by
                                            FROM
                                                comments
                                            INNER JOIN 
                                                users
                                            ON
                                                users.userID = comments.Member_ID   
                                            WHERE 
                                                comments.Item_ID = :zitemID');
                     
                     $stmt->bindParam(":zitemID", $itemID);
                     
                     $stmt->execute();
                 
                     $rows =$stmt->fetchAll();?>
                    <!--start list of item comments with controlls btns-->
                     <li class="collection-header"><h4><?php echo lang("ITEM_COMMENT_MENGER")?></h4></li>
                    <?php foreach($rows as $row) {?>
                     
                            <li class="collection-item  avatar" data-id='<?php echo $row['C_ID']; ?>' item-id='<?php echo $row['Item_ID']; ?>'>
                               <div class="comment-controll">
                                 <a  class="secondary-content update-btn-to-item" onclick="$('.comment-form').attr('data-id',$(this).parent().parent().data('id'));$('.comment-form').attr('data-item',$(this).parent().parent().attr('item-id'));">
                                   <i class="material-icons ">border_color</i>
                                 </a>
                                 <a class="secondary-content delete-btn-to-item modal-trigger" onclick="$('.modal').modal();" data-id="<?php echo $row['C_ID'];?>"  href="#modal-item<?php echo $row['C_ID'];?>" >
                                  <i class="material-icons" >delete_forever</i>
                                 </a>
                               </div>       
                               <i class="circle material-icons">folder</i>
                               <p><?php echo $row['written_by'];?></p>
                                <p class="comment"><?php echo $row['Comment'];?></p>
                               <span><?php echo $row['Comment_Data'];?> </span> 
                                
                               <!--start modal-delete comment-->
                                 <div id="modal-item<?php echo $row['C_ID']; ?>" class='modal' >
                                   <div class='modal-content center-align black-text'>
                                     <h4 "><?php echo lang("SURE_MSG")?> </h4>
                                     <p ><?php echo lang("SURE_MSG_COMMENTS")?> <?php echo $row['written_by']?></p>
                                   <div class='modal-footer'>
                                     <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                                     <a class='modal-action ajax-click modal-close waves-effect waves-green btn-flat' 
                                        data-id='<?php echo $row['C_ID']; ?>'
                                        data-do = 'delete_comment'
                                        data-place = "#comments-item"
                                        data-required = "comments"
                                        data-item='<?php echo $row['Item_ID']; ?>'>Delete</a>
                                  </div> <!--end modal Delete Butten -->
                                </div>    
                             </li><!--end list of item comments with controlls btns-->
               <?php }
               } else {
                     echo "kusha" .'<br><br><br><br>'. $itemID .'<br><br><br><br>';
                 }
    } elseif (preg_match('/statistics/', $fromPage)){
        // check if there is special query 
        $data_required = !empty($_post['ajxdata_required']) ?  $_post['ajxdata_required'] : 'no_required'; 
        if ($data_required != "no_required"){
            
        $query ="WHERE items.$data_required"; 
            
        } else {
            
            $query =" "; 
            
        }

         // select all items and make a two new column for category name and user Name, who posted the item 
        
         $stmt = $con->prepare("SELECT 
                                     buy_operations.* ,
                                     users.username AS Buyer_Name ,
                                     u3.username AS Seller_Name, 
                                     items.Price AS Price, 
                                     u2.Name AS Bought_Item
                                 FROM
                                     buy_operations
                                 INNER JOIN
                                     users 
                                 ON 
                                     users.userID = buy_operations.Buyer_ID
                                   
                                INNER JOIN
                                     users u3
                                 ON 
                                     u3.userID = buy_operations.Seller_ID
                                 INNER JOIN 
                                     items
                                 ON 
                                     items.Price = buy_operations.Total_Amount
                                 INNER JOIN 
                                     items u2
                                 ON 
                                     u2.Item_ID = buy_operations.Item_ID
                                     $query ORDER BY Item_ID DESC");
        
        
        $stmt ->execute();
        
        $rows =$stmt->fetchAll(); 
        
         foreach ($rows as $row){ 
?>    
             <tr class="table-row"> 
               <td class = 'commenID'><?php echo $row['ID']?></td>
               <td class = 'UserName search-in'><?php echo $row['Buyer_Name']?> </td>
               <td class = 'comment search-in'><?php echo $row['Seller_Name']?> </td>
               <td class = 'itemName search-in'><?php echo $row['Bought_Item']?></td>
               <td class = 'itemName search-in'>$<?php echo $row['Total_Amount']?></td>
               <td class = 'writtenIn search-in'><?php echo $row['Time_Of_Purchase']?></td>
             </tr>
          <?php  } 


    }
 
    

    
}//end cindidtion Request

?>


