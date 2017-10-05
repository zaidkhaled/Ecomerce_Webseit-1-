<?php 

 include "init.php";
 
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
     $do = isset($_GET['do']) ? $_GET['do'] : 'mange';
    

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

          

                 <div class = "container">
                     
                     <!-- print caught errorrs-->
                     
                     <?php foreach($addFormErr as $Err){ ?> 
                     <div class="row">
                       <div class='errmsg_php' style='display:block'>
                           
                           <!--Err : Erorr msg -->
                         <p class='msg'><?php echo $Err; ?></p> 
                       </div>
                    </div>
                     <?php } ?>
                 </div>

         <?php
               
                
               
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
         
      $userID = isset($_GET['ajxUserID']) && is_numeric($_GET['ajxUserID'])? intval($_GET['ajxUserID']) :0;

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

        $password = empty($_GET['ajxPass'])? $_GET['ajxOldPass']:

        sha1($_POST['ajxPass']);//Set new password if  changed +++================+++

        $NewUserName= $_GET['ajxName'];

        $NewEmail= $_GET['ajxEmail'];

        $NewFullName= $_GET['ajxFullname'];

        $userID = $_GET['ajxUserID'];

        $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";

       //  anther way to show errors <====> check if all values are approved 

       if(

          strlen($NewUserName) < 3 or
          strlen($NewEmail)    < 6 or  
          strlen($NewFullName) < 6 or
          !$password =  $emptyPass 


      // PHP error msg  in case that Jave script disables
       ){

           echo " <div class='errmsg' style='display:block'> 
                      <p class='msg'> " . lang('PHP_ERRMSG_NAME') . "</p> <br>
                      <p class='msg'> ". lang('PHP_ERRMSG_EMAIL')."</p> <br>
                      <p class='msg'> ". lang("PHP_EMPTY_PASS")."</p> <br>
                      <p class='msg'>" . lang('PHP_ERRMSG_FULLNAME') ."</p>

                  </div>"; 

       }else {
//                   
           $stmt=$con->prepare("UPDATE 
                                 users
                               SET
                                 username = ?, Email = ?, fullName = ?, password = ? 
                               WHERE 
                                 userID = ? ");  //Info Updating

            $stmt->execute(array($NewUserName, $NewEmail, $NewFullName, $password, $userID)); //insert new values

       }
        
   }elseif($do == "activate") {
         
           $userID = isset($_GET['ajxUserID']) && is_numeric($_GET['ajxUserID'])? intval($_GET['ajxUserID']) :0;
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("userID", "users", $userID)  ;
                  
                  // check if this id has info in database, when yes then delet the user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE users SET regStatus = 1 WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                      
                      $stmt->execute();
         
                   }    
         
        }
     
    
      
      //start mange und control buttons
    
         $query = isset($_GET['page']) && $_GET['page'] == 'pending'? "AND regStatus = 0" : " "; // select all users except admin
         
         // select all users except admin JUST IF $query value is exist
         
         $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 ORDER BY userID DESC $query");
         
         $stmt->execute();
         
         //fetch all users with theire info from Datebase
         
         $rows =$stmt->fetchAll(); 
    
                 //start table body
                
         foreach ($rows as $row){?>
             <tr>
             <td class = 'userID'>     <?php echo $row['userID']?>  </td>
             <td class = 'username'>  <?php echo $row['username']?> </td>
             <td class = 'Email'>      <?php echo $row['Email']?>   </td>
             <td class = 'fullName'>   <?php echo $row['fullName']?></td>
             <td class = 'date'>        <?php echo $row['date'] ?>  </td>
                 
<!--            password will userful on info editing and it will be invisible and it will be Required just on editing -->
                 
             <td class = 'oldpassword' style="display:none;"> <?php echo $row['password'] ?> </td>

<!--           start table body   -->

<!--              Note <=========> in "sure Msg" <to delete user> from jave script href will equal #modal + userID                                     (#modal+$row['userID']) /without this, the fuction  will selet and delet just the first id  -->
              
             <td>
                <!--Activate Button--> 
              <?php 

                if ($row['regStatus'] == 0) { ?>
                 <a class='btn-floating pink darken-4' id='unactivated' data-id ='<?php echo $row['userID']; ?>'>
                   <i class="material-icons">thumb_down</i>-->
                 </a>

                <?php }else {?>

                  <a class='btn-floating light-green accent-3'>
                   <i class="material-icons">thumb_up</i>-->
                 </a>

                 <?php }?>

                 <!-- end Activate  Button--> 

                 <!--Edit Butten-->
                 <a class='btn-floating teal updata-btn' data-id='<?php echo $row['userID']; ?>' >
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

                    
    
       //end mange 
   
}   //end cindidtion Request

?>


