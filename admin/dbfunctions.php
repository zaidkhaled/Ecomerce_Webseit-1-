<?php 

 include "init.php";
 
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
     $do = isset($_GET['do']) ? $_GET['do'] : 'mange';
    
    // to know from which page this request is ====> get the link "HTTP_REFERER" then send data back just to this page
    
     $fromPage = isset( $_SERVER['HTTP_REFERER']) ?  $_SERVER['HTTP_REFERER'] : 'members.php';  
    

    if($do == "insert"){
         
          //Insert new user info 
             
           $userName = $_GET['ajxName'];
           $password = sha1($_GET['ajxPass']);
           $email    = $_GET['ajxEmail'];
           $fullName = $_GET['ajxFullname'];
         
            //SHA1 password <=> empty value
             
            $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  
        
            // Make an error array for add form 
         
            $addFormErr = [];
         
           if (empty($userName) or strlen($userName) > 20){
               
               $addFormErr[] = lang("PHP_ERRMSG_NAME");
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
               
               $stmt = $con->prepare("INSERT INTO
                                                users
                                                     (userName, password, Email, fullName, regStatus, date)
                                                VALUES 
                                                     (:zusername, :zpassword, :zEmail, :zfullName, 1, now())");
                   
                $stmt->execute(["zusername" => $userName,
                                "zpassword"  => $password,
                                "zEmail"     => $email,
                                "zfullName"  => $fullName]);
               
         
         }
         
     // End inset new user 
        
    }elseif($do == "delete") {
         
      $userID = isset($_GET['ajxID']) && is_numeric($_GET['ajxID'])? intval($_GET['ajxID']) :0;

      //check if ID is allredy exist in Datebase

      $check = checkItem("userID", "users", $userID)  ;

      // check if id info has been stored in database, if yes then delete user

      if ($check > 0){

          $stmt=$con->prepare("DELETE FROM users  WHERE userID = :zuserID");

          $stmt->bindParam(":zuserID", $userID);

          $stmt->execute();

      }
    
    }elseif($do == "updata"){
         
           //Update user info
        
        // set new password just if user changes it
                                 
        $password = empty($_GET['ajxPass'])? $_GET['ajxOldPass']: sha1($_GET['ajxPass']);

        $NewUserName= $_GET['ajxName'];

        $NewEmail= $_GET['ajxEmail'];

        $NewFullName= $_GET['ajxFullname'];

        $userID = $_GET['ajxID'];

        $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";

       //  anther way to show errors <====> check if all values are approved 

       if(

          strlen($NewUserName) < 3 or
          strlen($NewEmail)    < 6 or  
          strlen($NewFullName) < 6 or
          !$password =  $emptyPass 


      // PHP error msg  in case that Jave script disables
       ){?>

           <div class='errmsg' style='display:block'> 
              <p class='msg'> <?php echo lang('PHP_ERRMSG_NAME')?> </p> <br>
              <p class='msg'> <?php echo lang('PHP_ERRMSG_EMAIL')?></p> <br>
              <p class='msg'> <?php echo lang("PHP_EMPTY_PASS")?></p> <br>
              <p class='msg'> <?php echo('PHP_ERRMSG_FULLNAME') ?></p>
           </div>

<?php }else {
                   
           $stmt=$con->prepare("UPDATE 
                                 users
                               SET
                                 username = ?, Email = ?, fullName = ?, password = ? 
                               WHERE 
                                 userID = ? ");  //Info Updating

            $stmt->execute(array($NewUserName, $NewEmail, $NewFullName, $password, $userID)); //insert new values

       }
        
        
        
   }elseif($do == "activate") {
         
           $userID = isset($_GET['ajxID']) && is_numeric($_GET['ajxID'])? intval($_GET['ajxID']) :0;
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("userID", "users", $userID)  ;
                  
                  // check if this id has info in database, when yes then activate the user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE users SET regStatus = 1 WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                      
                      $stmt->execute();
         
                   }    
         
        
        
    }elseif($do == "insert_cate"){
        
               //prepare new Categorie info

               $CateName     = $_GET['ajxCateName'];
               $description  = $_GET['ajxDescription'];
               $order        = $_GET['ajxOrder'];
               $vis          = $_GET['ajxVisibilty'];
               $comment      = $_GET['ajxComment'];
               $ads          = $_GET['ajxAds'];


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
                                                         (Name, Description, ordering, 	Visbility, Allow_Comment, Allow_Ads)
                                                    VALUES 
                                                         (:zName, :zDescription, :zordering, :zVisbility, :zAllow_Comment, :zAllow_Ads)");

                    $stmt->execute([":zName"           => $CateName,
                                    "zDescription"     => $description,
                                    "zordering"        => $order,
                                    "zVisbility"       => $vis,
                                    "zAllow_Comment"   => $comment,
                                    "zAllow_Ads"       => $ads ,
                                   ]);

               
           } 
        
        
        
    } elseif($do == "cate_updata"){
         
           //Update Categories info            

        $NewCateName = $_GET['ajxNewCateName'];

        $NewDescrp = $_GET['ajxNewDescrp'];

        $NewOrder = $_GET['ajxNewOrder'];

        $ID = $_GET['ajxID'];
       

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
                                 Name = ?, Description = ?, ordering= ? 
                               WHERE 
                                 ID = ? ");  //Info Updating

            $stmt->execute([$NewCateName, $NewDescrp, $NewOrder, $ID]); //insert new values

       }
        
        
        
   } elseif($do == "change_cate_status"){ 
        
        // get category id 
        
         $cate_ID = isset($_GET['ajxID']) && is_numeric($_GET['ajxID'])? intval($_GET['ajxID']) :0;
    

         // get category column name with new status (1 or 0).
        
         $cate_col_name = $_GET['ajxCateColName'];
         $stus = $_GET['ajxStatus'];
         
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
         
      $cateID = isset($_GET['ajxID']) && is_numeric($_GET['ajxID'])? intval($_GET['ajxID']) :0;

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
    
    }
     
    
    
    
     // start controll this "php code" result. to which page this result should be sended back
    
    //http_referer have "members", then send this result just to "members page" 
    
    if(preg_match('/members/', $fromPage)) { 
      
      //start mange und control buttons
        
         //select pending members "not activated members", just if user click on pending members in dashboard page
        
         $query = $_GET['ajxpending'] == 'pending'? "AND regStatus = 0" : " "; 
         
         // select all users except admin
        
         $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY userID DESC ");
         
         $stmt->execute();
         
         //fetch all users with theire info from Datebase
         
         $rows =$stmt->fetchAll(); 
    
                 //start table body
                
         foreach ($rows as $row){ 
             
?>
             <tr class="table-row"> 
                 
             <td class = 'userID'>     <?php echo $row['userID']?>  </td>
             <td class = 'username'>  <?php echo $row['username']?> </td>
             <td class = 'Email'>      <?php echo $row['Email']?>   </td>
             <td class = 'fullName'>   <?php echo $row['fullName']?></td>
             <td class = 'date'>        <?php echo $row['date'] ?>  </td>

<!--           start table body   -->

<!--              Note <=========> in "sure Msg" <to delete user> from jave script href will equal #modal + userID  
                  (#modal+$row['userID']) /without this, the fuction  will selet and delet just the first id       -->
              
             <td>
                <!--Activate Button--> 
              <?php 

                if ($row['regStatus'] == 0) { ?>
                 <!--if user is not activated then show unactivated button-->
                 <a class='btn-floating pink darken-4' id='unactivated' data-id ='<?php echo $row['userID']; ?>'>
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
                 <a class='btn-floating teal updata-btn'
                    data-id='<?php echo $row['userID']; ?>' 
                    data-userNname='<?php echo $row['username']; ?>'
                    data-email='<?php echo $row['Email']; ?>'
                    data-fullname='<?php echo $row['fullName']; ?>'
                    data-oldPass='<?php echo $row['password']; ?>'
                    >
                   <i class='large material-icons'>mode_edit</i>
                 </a>
                 <!--Edit Butten-->

                 <!--Delete Butten-->
                 <a class='btn-floating red modal-trigger' data-id="<?php echo $row['userID'];?>"  href="#modal<?php echo $row['userID']; ?>">
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
                    <a  class='modal-action delete modal-close waves-effect waves-green btn-flat' data-id='<?php echo $row['userID']; ?>'>Agree</a>
                 </div>
                  <!--Delete Butten-->   

             </div>
            </td>
            </tr>
            

          <?php  } 
        
       //chick if http_referer contains dashpoard, if yes then show this list just inside it
        
    }elseif (preg_match('/dashboard/', $fromPage)){ 
        ?>
          <li class="collection-header"><h4><?php echo lang("LATEST_USER")?></h4></li>
            <?php
         
             //function to bring just the last 5 registerd users
         
              $users = getLatest("*", "users", "userID", 5);
     
                 foreach($users as $user){?>
              
                    <!-- List of the last 5 regestered users und theres activate status-->
               
                   <li class="collection-item">
                       <div><?php echo $user['username'] ?>
                           
                           <a class="secondary-content updata-btn" 
                              data-id        ='<?php echo $user['userID']; ?>'
                              data-userNname ='<?php echo $user['username']; ?>'
                              data-email     ='<?php echo $user['Email']; ?>'
                              data-fullname  ='<?php echo $user['fullName']; ?>'
                              data-oldPass   ='<?php echo $user['password']; ?>'>
                               <i class="material-icons">mode_edit</i>
                           </a>

                           <!-- check the register Status-->

                         <?php if ($user['regStatus'] == 0){ ?>
                           
                                    <!--if user is not activated then show unactivated button-->
                           
                                    <a data-id="<?php echo $user['userID'] ?>" id='unactivated' class='secondary-content'>
                                      <i class='material-icons'>thumb_down</i>
                                    </a>
                            <?php }?>
                      </div>
                   </li>
                        
              <?php } 
        
        //end dashboard result page 
        
        
        
        
    //check current page, if this categories then send this result to it back.
        
   } elseif(preg_match('/categories/', $fromPage)){
        
        $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID DESC");
        
        $stmt->execute();
        
        //fetch all data
        
        $cates = $stmt ->fetchAll();
       
        foreach ($cates as $cate){
            
//          $Visbility     = $cate['Visbility']     == 0 ? 'No' : 'Yes' ;  
//          $Allow_Comment = $cate['Allow_Comment'] == 0 ? 'No' : 'Yes' ;  
//          $Allow_Ads     = $cate['Allow_Ads']     == 0 ? 'No' : 'Yes' ;  
         
          //check if visibltly and comment and advertising is allowed , if yes then chenge the background-color to peacefully color by class name, but if no then chenge it to danger color
            
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
                  >
                  <div class="cate-controll">
<!--
                    <a  class="secondary-content close-btn">
                      <i class="material-icons ">close</i>
                    </a>
-->
                      <a  class="secondary-content updata-btn">
                      <i class="material-icons ">border_color</i>
                    </a>
                    <a class="secondary-content modal-trigger delete-btn">
                      <i class="material-icons delete-btn modal-trigger" data-id="<?php echo $cate['ID'];?>"  href="#modal<?php echo $cate['ID'];?>">delete_forever</i>
                    </a>
                  </div>      
                  
                  <h3 class= 'cate-name'> <?php echo $cate['Name'];?></h3>
                  
                  <div class="cate-details">
                      Description : <span class= 'descrp'><?php echo $cate['Description'];?></span>
                      <p>Ordering : <?php echo $cate['Ordering'];?></p>
                      
                        <span class="<?php echo $cls_visibility; ?>"
                              data-status = "<?php echo $cate['Visbility'] ;?>"
                              col-name = "Visbility">
                              Visbility : <?php echo $allow_visibility;?>
                        </span>
                      
                        <span class ='<?php echo $cls_comment;?>' 
                              data-status = "<?php echo $cate['Allow_Comment'] ;?>"
                              col-name = "Allow_Comment">
                              Allow_Comment : <?php echo $allow_comment;?>
                        </span>
                      
                        <span class="<?php echo $cls_ads;?>" 
                              data-status = "<?php echo $cate['Allow_Ads'];?>"
                              col-name = "Allow_Ads"> 
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
                 <a class='modal-action modal-close waves-effect waves-green btn-flat' data-id='<?php echo $cate['ID']; ?>' id = "delete-cate">Agree</a>
               </div> 
             </div>
            
        
    <?php }
    }
}//end cindidtion Request

?>


