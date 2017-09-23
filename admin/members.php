<?php 
/*
=========================
   Mange Members Page
   Add | Delete | Edit
=========================    
*/

session_start();



include "init.php";
$pageTitle = "Members";
include $tpl. "header.php";

if(!isset($nonav)){ //check if Navbar can show here 
       
    include $tpl. "nav.php"; 
    
  }
    
if(isset($_SESSION['username'])){
     
     
     include $conn; // then connect Database 
       
     $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
        
     //  start mange the Page 
        
     if($do == "mange"){//Mange Page  
         
         // Select all users Excpect Admin
         
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1");
         
        $stmt->execute();
         
        $rows =$stmt->fetchAll(); 
     ?>
        <div class= "mange">

  <!-- Modal Structure -->
  
          <div class="container">
               <table  class="bordered responsive-table centered" >
                <thead>
                  <tr>
                      <th>#ID</th>
                      <th><?php echo lang("FIRST_NAME" )?></th>
                      <th><?php echo lang("EMAIL")?></th>
                      <th><?php echo lang("FULLNAME")?></th>
                      <th><?php echo lang("REGISTERED")?></th>
                      <th><?php echo lang("CONTROL")?></th>
                  </tr>
                </thead>

                <tbody>
                <?php 
                 foreach ($rows as $row){
                     echo "<tr>";
                     echo "<td>". $row['userID'] ."</td>";
                     echo "<td>". $row['username'] ."</td>";
                     echo "<td>". $row['Email'] ."</td>";
                     echo "<td>". $row['fullName'] ."</td>";
                     echo "<td></td>"; 
                     
                     // Note =========> in "sure Msg" <to user deleting> from jave script <==> href will equal #modal + userID (#modal.$row['userID']) /without this, the fuction  will selet and delet just the first id  
                     
                     echo "<td>
                         <a class='btn-floating teal' href='members.php?do=Edit&userID=".$row['userID']."'>
                           <i class='large material-icons'>mode_edit</i>
                         </a>

                         <a class='btn-floating red modal-trigger' href='#modal".$row['userID']."' >
                          <i class='large material-icons '>delete_forever</i>
                         </a>
                       
                         <div id='modal".$row['userID']."' class='modal'>
                          <div class='modal-content'>
                            <h4>Are you sure </h4>
                            <p>you will delet this user : ". $row['fullName']. "</p>
                          </div>
                        
                          <div class='modal-footer'> 
                            <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                            <a href='members.php?do=delet&userID=". $row['userID'] ."' class='modal-action modal-close waves-effect waves-green btn-  flat'>Agree</a>
                         </div>

                    </td>";
                     echo "</tr>";
                 }
                 ?>
                     
                    </div>
                </tbody>
              </table>
               <a class="waves-effect waves-light btn" href =' members.php?do=Add'>Add new Member
                  <i class="material-icons">exposure_plus_1</i>
              </a>
            </div>
        </div>    
     <?php   
         
       //start Add page
         
     }elseif($do == "Add") { 
         
       ?>

<!--         Members/start Add Form-->

          <div class="container">
            <h1 class="center-align"><?php echo lang('ADD_MEMBERS')?></h1>
            <form class="EditForm" action="?do=Insert" method="POST">
                
              <div class="row">      
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="icon_prefix"
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         name="AddUserName"
                         data-value ="1">
                  <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(3)_JS")?></p>
                  </div>
                </div>


                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">email</i>
                  <input id="icon_prefix input" 
                         limit ="6"
                         type="email"
                         limit = "6"
                         class="validate input" 
                         name="AddNewEmail"
                         data-value ="1">
                  <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(6)_JS")?></p>
                  </div>
                </div>
               </div>

              <div class="row">
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">lock_outline</i>
                  <input  type="password"
                          class="validate password1 input" 
                          limit ="6"
                         data-value ="1">

                  <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(6)_JS")?></p>
                  </div>
                </div>

                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">lock_outline</i>
                  <input type="password"
                         class="validate password2 input" 
                         limit ="6"
                         name="AddUserPassword"
                         data-value ="1">
                  <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                   <span></span>
                   <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(6)_JS")?></p>
                   </div>
                </div>  
              </div>

              <div class="row">    
                <div class="input-field col s8 m4 push-m4 push-s2">
                  <i class="material-icons prefix">account_box</i>
                  <input type="text"
                         class="validate input" 
                         limit ="8" 
                         name="AddNewFullName"
                         data-value ="1">
                  <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(8)_JS")?></p>
                  </div>
                </div>
              </div>     

              <div class="row"> 
                 <button class="btn btnMebers waves-effect waves-light col s4 m2 push-s4 push-m5  "type="submit" name="action"><?php echo lang('REGISTER')?>
                   <i class="material-icons right">autorenew</i>     
                 </button> 
                </div>
            </form><!--End form-->
          </div> <!--End container-->

      <!--         Members/End Add Form-->
    
   <?php
           
     }elseif($do == "Insert"){
         
         if($_SERVER['REQUEST_METHOD'] == 'POST'){ //change the user info
             
           $userName = $_POST['AddUserName'];
           $password = sha1($_POST['AddUserPassword']);
           $email    = $_POST['AddNewEmail'];
           $fullName = $_POST['AddNewFullName'];
         
            //SHA1 password empty Value
             
            $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  
         
          
           
           
            // Make an Error Array for Add form 
         
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
          // End  Error Array for Add form 
          
           if (!empty($addFormErr)){// check if the values are approved values
               
           ?>

          

                 <div class = "container hm">
                     
                     <!-- print caught Errorrs-->
                     
                     <?php foreach($addFormErr as $Err){ ?> 
                     <div class="row">
                       <div class='errmsg' style='display:block'>
                           
                           <!--Err : Erorr msg -->
                         <p class='msg'><?php echo $Err; ?></p> 
                       </div>
                    </div>
                     <?php } ?>
                 </div>

         <?php
            // when yes then insert the new user to Datebase
               
           }else {
               
               $stmt = $con->prepare("INSERT INTO users(userName, password, Email, fullName)
                                                VALUES 
                                                     (:zusername,:zpassword,:zEmail,:zfullName)");
                   
                $stmt->execute(["zusername" => $userName,
                                "zpassword"  => $password,
                                "zEmail"     => $email,
                                "zfullName"  => $fullName]);
               
               if ($stmt->rowCount() == 1){ // check if this Record Inserted 
              ?>

                       <!--//Echo success Massege-->

                       <div class='succmsg'>
                           
                           <p class='msg'><?php echo lang("PHP_SUCCMSG")." : ". $stmt->rowCount()?></p>
                           
                       </div>
                   
              <?php }else { ?>

                       <!--Echo success Massege-->

                       <div class='RecErrMsg'>

                           <p class='msg'> <?php lang("PHP_Rec_Err_Msg"); echo $stmt->rowCount()?></p>

                       </div>
                   
        <?php }
               
           }  }
         
     }elseif ($do == "Edit"){ //Edit Page 
         
                 //check if Request userid is Numeric & Get the integer of value it 
         
                 $userID = isset($_GET['userID']) && is_numeric($_GET['userID'])? intval($_GET['userID']) :0;
                  
                  
                  
                  $stmt=$con->prepare("SELECT * FROM users  WHERE userID = ? LIMIT 1");
         
                   //check if ID is allredy exist in Datebase
         
                  $stmt->execute([$userID]);

                  // fetch all info(row) from Database
         
                  $row = $stmt->fetch();

                  $rowcount= $stmt->rowCount(); 
                  
                  // check if this id has info in Database, when yes then let user make his Update 
         
                  if ($rowcount > 0){
                      
              ?>

<!--         Members/start Edit from (Update info)-->

                    <div class="container">
                        <h1 class="center-align"><?php echo lang('EDIT_MEMBERS')?></h1>
                        <form class="EditForm" action="?do=update" method="POST">
                          <div class="row">
                            <input type="hidden" name="id" value="<?php echo $userID;?>">      
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">account_circle</i>
                              <input type="text" 
                                     data-value='0'
                                     class="validate input" 
                                     limit ="3"
                                     name="NewUserName"
                                     value = "<?php echo $row['username'];?>">
                              <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                              <span></span>
                              <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(6)_JS')?></p>
                              </div>
                            </div>
                              
                              
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">email</i>
                              <input limit ="6"
                                     data-value='0'
                                     type="email" 
                                     class="validate input" 
                                     name="NewEmail"
                                     limit = "6"
                                     value = "<?php echo $row['Email'];?>">
                              <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                              <span></span>
                              <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(6)_JS')?></p>
                              </div>
                            </div>
                           </div>

                          <div class="row">
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">lock_outline</i>
                              <input  type="password"
                                      data-value='0'
                                      class="validate password1 input" >
                                
                              <input type="hidden"
                                     class="validate "
                                     name = "oldPassword"
                                     value="<?php echo $row['password'];?>">
                                
                              <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                              <span></span>
                              <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(8)_JS')?></p>
                              </div>
                            </div>
                              
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">lock_outline</i>
                              <input type="password"
                                     class="validate password2 input" 
                                     data-value='0'
                                     name="NewPassword">
                              <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                               <span></span>
                               <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(8)_JS')?></p>
                               </div>
                            </div>  
                          </div>

                          <div class="row">    
                            <div class="input-field col s8 m4 push-m4 push-s2">
                              <i class="material-icons prefix">account_box</i>
                              <input id="icon_telephone"
                                     type="text" class="validate input" 
                                     limit ="8" 
                                     data-value='0'
                                     name="NewFullName"
                                     value = "<?php echo $row['fullName'];?>">
                              <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                              <span></span>
                              <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(8)_JS')?></p>
                              </div>
                            </div>
                          </div>     
                            
                          <div class="row"> 
                             <button class="btn btnMebers waves-effect waves-light col s4 m2 push-s4 push-m5  "type="submit" name="action"><?php echo lang('SAVE')?>
                               <i class="material-icons right">autorenew</i>     
                            </button> 
                            </div>
                        </form><!--End Edit form-->
                    </div> <!--End container-->
                    

<!--        Members/end Edit from (Update info)-->

      <?php 
                 } else {//end  (check if this id has info in Datebase)=> when not then :
                      
                      echo "There is no Info";
                  }
                      
           
        }elseif($do == "update"){
          
           echo "<h1 class= center-align>Update Members</h1>";
         
           //Update user info
         
           if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                
                // set new password when the user change his password
               
                $password = empty($_POST['NewPassword'])? $_POST['oldPassword']  : 
               sha1($_POST['NewPassword']);//Set new password if  changed +++================+++
               
                $NewUserName= $_POST['NewUserName'];
               
                $NewEmail= $_POST['NewEmail'];
               
                $NewFullName= $_POST['NewFullName'];
               
                $userID = $_POST['id'];
               
                $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";
               
               
               if(// check if all values are approved Values
                   
                  strlen($NewUserName) < 3 or
                  strlen($NewEmail)    < 6 or  
                  strlen($NewFullName) < 6 or
                  !$password =  $emptyPass 
                   
               ){
                   
                   echo " <div class='errmsg' style='display:block'> 
                              <p class='msg'> " . lang('PHP_ERRMSG_NAME') . "</p> <br>
                              <p class='msg'> ". lang('PHP_ERRMSG_EMAIL')."</p> <br>
                              <p class='msg'> ". lang("PHP_EMPTY_PASS")."</p> <br>
                              <p class='msg'>" . lang('PHP_ERRMSG_FULLNAME') ."</p>
                              
                          </div>"; // PHP Error msg, in Case,that Jave script disabled
                   
               }else {
//                   
                   $stmt=$con->prepare("UPDATE 
                                         users
                                       SET
                                         username = ?, Email = ?, fullName = ?, password = ? 
                                       WHERE 
                                         userID = ? ");//Info Updating

                    $stmt->execute(array($NewUserName, $NewEmail, $NewFullName, $password, $userID));//insert the new values

                   echo  " <div class='succmsg'> <p class='msg'> ".lang('PHP_SUCCMSG') ." : ". $stmt->rowCount()."</p></div>";//Echo success Massege 
                   
               }
           }else {
               
               echo "Sorry you can't browse this Page directly";
           }
           
       //end (Edit Page )
         
     }elseif($do == "delet") {
         
           $userID = isset($_GET['userID']) && is_numeric($_GET['userID'])? intval($_GET['userID']) :0;
                  
                  
                  // SELECT all data depent of this ID
         
                  $stmt=$con->prepare("SELECT * FROM users  WHERE userID = ? LIMIT 1");
         
                   //check if ID is allredy exist in Datebase
         
                  $stmt->execute([$userID]);
         
                  $rowcount= $stmt->rowCount(); 
                  
                  // check if this id has info in Database, when yes then delet the user
         
                  if ($rowcount > 0){
                     
                      $stmt=$con->prepare("DELETE FROM users  WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                     
                    echo  " <div class= 'container'>
                               <div class='succmsg'> 
                                 <p class='msg'> ".lang("PHP_SUCCMSG_DEL_MSG") ." : ". $stmt->rowCount()."</p>
                               </div>
                           </div>";//Echo success Massege 
                  }
                      
              

         
     }


                  
        
       include $tpl."footer.php"; 
        
        

 	
 } else {

 	header("Location:index.php");

 	exit();

 }

