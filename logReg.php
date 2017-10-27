<?php
ob_start();
session_start();

$pageTitle = "Login & Regester";

if(isset($_SESSION['user'])){//check if user alrady logined
     
    header("Location:index.php");// redirect to index.php.

 }
 
 include "init.php"; 
 
 include $tpl."header.php";
 include $tpl."nav.php";

 if ($_SERVER['REQUEST_METHOD'] == "POST"){ 
     
     $userName = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

     $hashedpass = sha1($_POST['pass']);
     
     // check if user is realy exist in Database.

     $stmt=$con->prepare("SELECT
                             userID, username, password
                          FROM 
                             users 
                          WHERE 
                             username = ? 
                          AND 
                             password = ? 
                          LIMIT 1");

     $stmt->execute([$userName,$hashedpass]);
     
    $row = $stmt->fetch();
     
     $count= $stmt->rowCount();
     
     if($count > 0){      //check if the user is admin, if yes then 
         
         
         //fetch all user info, it should be helpful, in case that user want to edit his personal data "for edit form".
         
         $_SESSION['user'] = $userName; // Registering the sesstion name.
         
         $_SESSION['ID'] = $row['userID']; // Registering the sesstion ID.
//         
//         $_SESSION['pass'] = $row['password']; // Registering the sesstion ID pass.
//         
//         $_SESSION['Email'] = $row['Email']; // Registering the sesstion  Email.
//         
//         $_SESSION['fullname'] = $row['fullname']; // Registering the sesstion fullname.
        
         header("Location:index.php");// redirect to index.php.
      
         exit();
     }
 }

?> 
     <div class="row">
       <div class="title center-align col s12">
         <h2 class="login-title title-selected" id ="login"><?php echo lang("LOGIN")?></h2> 
         <h2 class = "login-title">|</h2>   
         <h2 class=" login-title" id ="register"><?php echo lang("REGISTER")?></h2>
        </div>
      </div>


     <form id = 'login-form' action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="col s12 add login-form">
       <div class="row">
         <div class="input-field col s10 m4 push-s1  push-m4">
              <i class="material-icons prefix">account_circle</i>
              <input    id="icon_telephone"
                        type="text"
                        class="validate"
                        name="name" 
                        autocomplete="off"
                        value="<?php if (isset($userName)){echo $userName;}?>"
                        >
              <label for="first_name"><?php echo lang('FIRST_NAME')?></label>
          </div>
        </div>  

        <div class="row">
           <div class="input-field col s10 m4 push-s1  push-m4">    
               <i class="material-icons prefix">border_color</i>
               <input   id="icon_telephone"
                        type="password" 
                        class="validate"
                        name="pass"
                        limit='3'
                        autocomplete = "new-password" 
                        value="<?php if (isset($password)){echo $password;}?>">
                 <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
           </div>
       </div> 
         
        <div class="row">
            <button class="btn waves-effect waves-light col s4 m2 push-s4 push-m5  " type="submit" name="login"><?php echo lang('LOG_IN')?>
                <i class="material-icons right">send</i>
            </button> 
          </div>         
     </form>
    
    



     <form  class="selected register-form"> 
          <div class="row"> 
            <!--End input "Add user Name" field--> 
            <div class="input-field col s8 m5 push-m1 push-s2">
               <i class="material-icons prefix">account_circle</i>
                  <input id="add-name"
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         name="AddUserName"
                         data-required ="required">
                  <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(3)_JS")?></p>
                  </div>
                </div>

                 <!--start input "Add Email" field--> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">email</i>
                  <input id="add-email" 
                         limit ="6"
                         type="email"
                         class="validate input" 
                         name="AddNewEmail"
                         data-required ="required">
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
                          id="icon_prefix " 
                          class="validate password1 input" 
                          limit ="6"
                         data-required ="required">

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
                  <input id="add-pass" 
                         type="password"
                         class="validate password2 input" 
                         limit ="6"
                         name="AddUserPassword"
                         data-required ="required">
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
                  <input id="add-fName" 
                         type="text"
                         class="validate input"
                         value = ""
                         limit ="8" 
                         name="AddNewFullName"
                         data-required ="required">
                  <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(8)_JS")?></p>
                  </div>
                </div>
                  <!--End input "Full Name" field-->
              </div> 
              <div class="row">
                <button class="btn waves-effect waves-light col s4 m2 push-s4 push-m5  " type="submit" name="action"><?php echo lang("REGISTER")?>
                <i class="material-icons right">send</i>
               </button> 
              </div>
          </form>

<?php 
    
    include $tpl."footer.php";
    ob_end_flush();
?>





