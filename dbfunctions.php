<?php 
ob_start();
session_start();
include "init.php";

if($_SERVER['REQUSET_METHOD'] = "GET"){
    
    $do = $_GET['ajaxdo'];

    // show this fields, when user want to update his info (profile page)
    
    if ($do == "show_inputs_field"){ ?>
          <?php $info =  getSpecialInfo("users", "userID",  $_SESSION['ID']);?>
          <div class="row"> 
              <!--End input "Add user Name" field-->
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
          </div> <!--End input "Full Name" field-->

          <button type="button" id="update-user-info-btn" class="waves-effect waves-light btn right"><?php echo lang("EDIT")?></button>
<?php
    
    //Edit user info from profile page 
    } elseif ($do == "update-user-info"){  
        
          $userName  = filter_var($_GET['ajaxname'], FILTER_SANITIZE_STRING);
          $email     = filter_var($_GET['ajaxemail'], FILTER_SANITIZE_EMAIL);
          $fullName  = filter_var($_GET['ajaxfname'], FILTER_SANITIZE_STRING);

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
        
            $info =  getSpecialInfo("users", "userID",  $_SESSION['ID']);?>

           <p class="user-info"><?php echo lang("FIRST_NAME");?>: <?php echo $info['username'];?></p>
           <p class="user-info"><?php echo lang("EMAIL");?>:      <?php echo $info['Email'];?></p>
           <p class="user-info"><?php echo lang("FULLNAME");?>:   <?php echo $info['fullName'];?></p>
        
        
        
<?php       
        
        
        
} elseif ($do == "change_pass"){
              
          $password1 = sha1($_GET['ajaxPass1']);
          $password2 = sha1($_GET['ajaxPass2']);
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
          }
    

    
    } //ende 
    
    
ob_end_flush();
?>