<?php 
/*
=========================
   Mange Members Page
   Add | Delete | Edit
=========================    
*/

session_start();
  
    
if(isset($_SESSION['username'])){
       
     $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
        
     //  start mange the Page 
    
     include "init.php";
    
     $pageTitle = "Members";
    
     include $tpl. "header.php";
    
     include $tpl. "nav.php"; 
    
     if($do == "mange"){  
                                                            
         $query = isset($_GET['page']) && $_GET['page'] == 'pending'? "AND regStatus = 0" : " ";
         
         // select all users except admin
         
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
         
        $stmt->execute();
         
         //fetch all users with theire info from Datebase
         
        $rows =$stmt->fetchAll(); 
     ?>
        <div class= "mange">

        <!-- Modal Structure -->
            
          <!--start table users-->
            
          <div class="container">
               <table  class="bordered responsive-table centered table" >
                   <!--start the Table header-->
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
                  <!--End the Table header-->
                <tbody>
                <!--start table body-->    
                <?php 
                 foreach ($rows as $row){
                     echo "<tr>";
                     echo "<td>". $row['userID'] ."</td>";
                     echo "<td>". $row['username'] ."</td>";
                     echo "<td>". $row['Email'] ."</td>";
                     echo "<td>". $row['fullName'] ."</td>";
                     echo "<td>". $row['date'] ."</td>";
                     
                   //start table body   
                     
                     // Note <=========> in "sure Msg" <to delete user> from jave script <==> href will equal #modal + userID (#modal.$row['userID']) /without this, the fuction  will selet and delet just the first id  
                      ?>
                     <td>
                        <!--Activate Button--> 
                      <?php 
                   
                        if ($row['regStatus'] == 0) { ?>
                         <a class='btn-floating pink darken-4' href='members.php?do=activate&userID=<?php echo $row['userID']; ?>'>
                           <i class="material-icons">thumb_down</i>-->
                         </a>
                            
                        <?php }else {?>
                         
                          <a class='btn-floating light-green accent-3' href=''>
                           <i class="material-icons">thumb_up</i>-->
                         </a>
                         
                         <?php }?>
                         <!--Activate  Button--> 
                         
                         <!--Edit Butten-->
                         <a class='btn-floating teal' href='members.php?do=Edit&userID=<?php echo $row['userID']; ?>'>
                           <i class='large material-icons'>mode_edit</i>
                         </a>
                         <!--Edit Butten-->
                         
                         <!--Delete Butten-->
                         <a class='btn-floating red modal-trigger' href="#modal<?php echo $row['userID']; ?>">
                          <i class='large material-icons '>delete_forever</i>
                         </a>
                         <!--Delete Butten-->
                         
                         <div id="modal<?php echo $row['userID']; ?>" class='modal'>
                          <div class='modal-content'>
                            <h4>Are you sure </h4>
                            <p>you will delet this user : <?php echo $row['fullName']?></p>
                          </div>
                        
                          <div class='modal-footer'> 
                            <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>    
                            <a href='members.php?do=delet&userID= <?php echo $row['userID']; ?>' class='modal-action modal-close waves-effect waves-green btn-  flat'>Agree</a>
                         </div>
                          <!--Delete Butten-->   
                             

                    </td>
                    </tr>
                   
                  <?php  } ?>  
                   
                    </div>
                </tbody>
              </table>
               <a class="waves-effect waves-light btn" href =' members.php?do=Add'>Add new Member
                  <i class="material-icons">exposure_plus_1</i>
              </a>
            </div>
        </div>  

     <!--End table users-->
     <?php   
         
       //start Add page
         
     }elseif($do == "Add") { 
         
       ?>

<!--         Members/start Add Form-->

          <div class="container">
            <h1 class="center-align"><?php echo lang('ADD_MEMBERS')?></h1>
            <form class="EditForm form " action="?do=Insert" method="POST">
                
              <div class="row"> 
                  <!--End input "Add user Name" field--> 
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

                 <!--start input "Add Email" field--> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">email</i>
                  <input id="icon_prefix input" 
                         limit ="6"
                         type="email"
                         class="validate input" 
                         name="AddNewEmail"
                         data-value ="1">
                  <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(6)_JS")?></p>
                  </div>
                </div>
                  <!--End input "Email" field--> 
               </div>

              <div class="row">
                  <!--start input "Add password" field--> 
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
                 <!--End input "Add password" field--> 
                  <!--start input "Repeat password" field--> 
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
                  <!--End input "Repeat password" field-->
              </div>

              <div class="row">  
                  <!--start input "Full Name" field-->
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
                  <!--End input "Full Name" field-->
              </div>     

              <div class="row"> 
                  <!--start Register button-->
                 <button class="btn btnMebers waves-effect waves-light col s4 m2 push-s4 push-m5  "type="submit" name="action"><?php echo lang('REGISTER')?>
                   <i class="material-icons right">autorenew</i>     
                 </button> 
                  <!--End Register button-->
                </div>
            </form><!--End form-->
          </div> <!--End container-->

      <!--         Members/End Add Form-->
    
   <?php
           
           
     }elseif($do == "Insert"){
         
          //Insert new user info
         
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
           $userName = $_POST['AddUserName'];
           $password = sha1($_POST['AddUserPassword']);
           $email    = $_POST['AddNewEmail'];
           $fullName = $_POST['AddNewFullName'];
         
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
               
                redirectPage("","back");
               
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
               
               // check if record is inserted
               
               if ($stmt->rowCount() == 1){  
              

                       //Echo success Massege

                       redirectPage(lang("SUCCESS"),"back");
                   
               }else { 

                       //Echo failed Massege

                       redirectPage("","back");
                       
                   
         }
               
           } 
         }
         
     }elseif ($do == "Edit"){ //Edit Page 
         
                 //check if request userid is numeric & get the integer value of it 
         
                 $userID = isset($_GET['userID']) && is_numeric($_GET['userID'])? intval($_GET['userID']) :0;
                  
                  
                  
                  $stmt=$con->prepare("SELECT * FROM users  WHERE userID = ? LIMIT 1");
         
                   //check if ID allredy exists in database
         
                  $stmt->execute([$userID]);

                  // fetch all info(row) from database
         
                  $row = $stmt->fetch();

                  $rowcount= $stmt->rowCount(); 
                  
                  // check if id info has been stored in database, if yes then allow user to update 
         
                  if ($rowcount > 0){
                      
              ?>

<!--         Members/start Edit from (Update info)-->

                    <div class="container">
                        <h1 class="center-align"><?php echo lang('EDIT_MEMBERS')?></h1>
                        <form class="EditForm form " action="?do=update" method="POST">
                          <div class="row">
                              <!--start input hidden value, to print the old value of password-->
                            <input type="hidden" name="id" value="<?php echo $userID;?>">     
                              <!--start input hidden value-->
                              <!--start input "user Name" field-->
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
                             <!--End input "user Name" field--> 
                             <!--End input "Email" field--> 
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
                              <!--End input "Email" field--> 
                           </div>

                          <div class="row">
                              <!--End input "password" field--> 
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
                               <!--End input "password" field--> 
                               <!--start input "repeat password" field--> 
                              
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
                              <!--End input "repeat password" field-->
                          </div>

                          <div class="row"> 
                              <!--start input "Full Name" field-->
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
                              <!--End input "Full Name" field-->
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
                  //end  (check if id info has been stored in database)=> if not then :
                  
                 } else {
                      
                      
                      
                redirectPage("","back");

                  }
                      
           
        }elseif($do == "update"){
          
           echo "<h1 class= center-align>Update Members</h1>";
         
           //Update user info
         
           if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                
                // set new password just if user changes it
               
                $password = empty($_POST['NewPassword'])? $_POST['oldPassword']  : 
               
               sha1($_POST['NewPassword']);//Set new password if  changed +++================+++
               
                $NewUserName= $_POST['NewUserName'];
               
                $NewEmail= $_POST['NewEmail'];
               
                $NewFullName= $_POST['NewFullName'];
               
                $userID = $_POST['id'];
               
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
                                         userID = ? ");//Info Updating

                    $stmt->execute(array($NewUserName, $NewEmail, $NewFullName, $password, $userID));//insert new values

                    redirectPage(lang("SUCCESS"),"back");   //Echo success Massege 
                   
               }
           }else {
               
              redirectPage("","back");
           }
           
          //end (Edit Page )
                      
     } elseif($do == "activate") {
         
           $userID = isset($_GET['userID']) && is_numeric($_GET['userID'])? intval($_GET['userID']) :0;
         
                   //check if ID allredy exists in database
         
                  $check = checkItem("userID", "users", $userID)  ;
                  
                  // check if this id has info in database, when yes then delet the user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("UPDATE users SET regStatus = 1 WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                      
                      $stmt->execute();
                      
                     
                      redirectPage(lang("SUCCESS"),"back",1); 
         
     }    
         
     }elseif($do == "delet") {
         
           $userID = isset($_GET['userID']) && is_numeric($_GET['userID'])? intval($_GET['userID']) :0;
                  
                   //check if ID is allredy exist in Datebase
         
                  $check = checkItem("userID", "users", $userID)  ;
                  
                  // check if id info has been stored in database, if yes then delete user
         
                  if ($check > 0){
                     
                      $stmt=$con->prepare("DELETE FROM users  WHERE userID = :zuserID");
                      
                      $stmt->bindParam(":zuserID", $userID);
                      
                      $stmt->execute();
                      
                     
                      redirectPage(lang("SUCCESS"),"back"); 
                      
                  }else {
         
                  redirectPage();
                      
                  }
         
     }


                  
        
       include $tpl."footer.php"; 
        
        

 	
 } else {

 	header("Location:index.php");

 	exit();

 }

