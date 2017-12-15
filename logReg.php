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
     
     // check from which form the request is comming
     
     if (isset($_POST['login'])){
         
         // check if user is realy exist in Database.
         
         $hashedpass = sha1($_POST['pass']);
         
         $value = $_POST['name_or_email'];
          
         
         if(preg_match('/@/', $value) || preg_match('/.com/', $value)){
             
             $req     = "Email";
             
             $req_val = filter_var($_POST['name_or_email'], FILTER_SANITIZE_EMAIL);
             
             
         } else {
             
             $req     = "username";
             
             $req_val = filter_var($_POST['name_or_email'], FILTER_SANITIZE_STRING);
             
         }
         
         
         // $count = checkItem("password", "users", $hashedpass, "AND username = $userName");
             
             
         $stmt=$con->prepare("SELECT
                                 userID, username, password
                              FROM 
                                 users 
                              WHERE 
                                 $req = ?
                              AND 
                                 password = ? 
                              LIMIT 1");

         $stmt->execute([$req_val,$hashedpass]);

         $row = $stmt->fetch();

         $count= $stmt->rowCount();
             
             

         if($count > 0){      //check if the user is admin, if yes then 


             // fetch all user info, it should be helpful, in case that user want to edit his personal data "for edit form".

             $_SESSION['user'] = $req_val; // Registering the sesstion name.

             $_SESSION['ID'] = $row['userID']; // Registering the sesstion ID.

             
            // add login time to login_details table          
            // check out if this id is already exist
             
            if(checkItem("user_ID", 'login_details', $_SESSION['ID']) > 0 ){
                
                // make  update 
                
                UpdateLastActivity('login_details', $_SESSION['ID']);
                
            } else {
                // add new id to login_details table
                LastActivity('login_details', $_SESSION['ID']);
                
            }
             
             header("Location:index.php");// redirect to index.php.

             exit();
            
         }
         
         
     }elseif(isset($_POST['register'])) {
         
          $userName  = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
          $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
          $fullName  = filter_var($_POST['fName'], FILTER_SANITIZE_STRING);
          $password1 = sha1($_POST['pass1']);
          $password2 = sha1($_POST['pass2']);
          $emptyPass = "da39a3ee5e6b4b0d3255bfef95601890afd80709";  
          $fotoName = $_FILES['foto']['name'];
          $fotoSize = $_FILES['foto']['size'];
          $fotoTmp  = $_FILES['foto']['tmp_name'];
          $fotoType = $_FILES['foto']['type'];
         
          //Allowed extensions array
         
          $fotoAllowedExtension = ["png", "jpg", "jpeg", "gif"];
         
          $value = explode(".", $fotoName);

          $fotoextension = strtolower(end($value));
          // prepare erorr array 
        
          $ErrArray = [];
        
          if (empty($userName) or strlen($userName) > 20){
               
               $ErrArray[] = lang("PHP_ERRMSG_NAME");
           }
         
          if (!in_array($fotoextension, $fotoAllowedExtension)) {
              
              $ErrArray[] = lang("PHP_ERR_FOTO_EXTENTIONS");
          }
         
          if(empty($fotoName)) {
              
              $ErrArray[] = lang("PHP_ERR_FOTO_EMPTY");
          }
         
          if ($fotoSize > 4194304){
              
              $ErrArray[] = lang("PHP_ERR_FOTO_SIZE");
              
          }
         
          if (filter_var($email, FILTER_VALIDATE_EMAIL) != true){
             
              $ErrArray[] = lang("ERRMSG_VALIDATE_EMAIL");
          }
         
           if(empty($email)){
               
               $ErrArray[] = lang("PHP_ERRMSG_EMAIL");
           }
         
           if(empty($fullName) or ($fullName) > 25 ){
               
               $ErrArray[] = lang("PHP_ERRMSG_FULLNAME"); 
           }
        
             
           // function to check Email Adress if it's reapeted, if yes => 1; but if no => return 0

           $check = checkItem("Email", "users", $email); 
             
           if ($check > 0){
               
              $ErrArray[] = lang("PHP_REAPETED_EMPTY");
           }
         
          if ($password2 == $emptyPass && $password2 == $emptyPass){

              $ErrArray[] = lang("PHP_EMPTY_PASS");
              
              } 
        
          if ($password1 != $password2){

              $ErrArray[] = lang("PHP_ERR_DIFFERENT_PASS"); 
              
              }
           // insert the values into database if all values are approved 
        
            if (empty($ErrArray)){
                
                $foto = rand(0, 100000). "_" . $fotoName;
                
                move_uploaded_file($fotoTmp, "uplaodedFiles/usersFoto/" . $foto);
                
                $stmt = $con-> prepare("INSERT INTO users (username, Foto, Email, password, fullName, regStatus, Amount, data)
                                                VALUES
                                                          (:zusername, :zfoto, :zEmail ,:zpassword, :zfullName, 0, 0, now())");
                
                $stmt->execute(["zusername"  => $userName,
                                "zfoto"      => $foto,
                                "zpassword"  => $password2,
                                "zEmail"     => $email,
                                "zfullName"  => $fullName]); 
                       
          

                
                $fetchInfo =   getSpecialInfoOnce("users", "userName", "password", $userName, $password1);
                
                $_SESSION['user'] = $fetchInfo["username"];
                $_SESSION['ID']   = $fetchInfo["userID"];
                
        
                // add user id into "login_details" table  
                    
                LastActivity('login_details', $_SESSION['ID']);
         
                
                redirectPage(lang("PHP_SUCCMSG_REGISTER"));
                
                
//             header("Location:index.php");// redirect to index.php.

            } else {
                foreach ($ErrArray as $err){
                    echo "<p>" . $err . "</p>";
                }
            }
            
     }// end check login and register
 } // end request question 

?> 
     <div class="row">
       <div class="title center-align col s12">
         <h2 class="login-title form-title title-selected"  data-title=".register-form"><?php echo lang("LOGIN")?></h2> 
         <h2 class = "login-title">|</h2>   
         <h2 class=" login-title form-title" data-title=".login-form"><?php echo lang("REGISTER")?></h2>
        </div>
      </div>


     <form  action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="col s12 login-form">
       <div class="row">
         <div class="input-field col s10 m4 push-s1  push-m4">
              <i class="material-icons prefix">account_circle</i>
              <input    id="icon_telephone"
                        type="text"
                        class="validate"
                        name="name_or_email" 
                        autocomplete="off"
                        value="<?php if (isset($userName)){echo $userName;}?>"
                        >
              <label for="first_name"><?php echo lang("FIRST_NAME_OR_EMAIL")?></label>
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
    
    


     <!-- start register form-->
     <form  class="selected register-form"  action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" enctype="multipart/form-data"> 
          <div class="row"> 
            <!--End input "Add user Name" field--> 
            <div class="input-field col s8 m5 push-m1 push-s2">
               <i class="material-icons prefix">account_circle</i>
                  <input pattern=".{3,}"
                         title = "pleace fill this field with more then 3 char"
                         id="add-name"
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         name="name" 
                         required
                         >
                  <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                </div>

                 <!--start input "Add Email" field--> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">email</i>
                  <input pattern=".{6,}"
                         title = "pleace fill this field with more then 6 char"
                         id="add-email" 
                         limit ="6"
                         type="email"
                         class="validate input" 
                         name="email"
                         data-required ="required">
                  <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                </div>
                  <!--End input "Email" field--> 
               </div>

              <div class="row">
                  <!--start input "Add password" field--> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">lock_outline</i>
                  <input  minlength = "4"
                          type="password"
                          id="icon_prefix" 
                          class="validate password1 input" 
                          limit ="6"
                          name ="pass1"
                         required>

                  <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                </div>
                 <!--End input "Add password" field--> 
                  <!--start input "Repeat password" field--> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">lock_outline</i>
                  <input minlength = "4"
                         id="add-pass" 
                         type="password"
                         class="validate password2 input" 
                         limit ="6"
                         name = "pass2"
                         required>
                  <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label></div>  
                  <!--End input "Repeat password" field-->
              </div>

              <div class="row">  
                <!--start input "Full Name" field-->
                <div class="input-field col s8 m6 push-m3 push-s2">
                  <i class="material-icons prefix">account_box</i>
                  <input pattern=".{6,}"
                         title = "pleace fill this field with more then 6 char"
                         id="add-fName" 
                         type="text"
                         class="validate input"
                         value = ""
                         limit ="8" 
                         name= "fName"
                         required>
                  <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                </div><!--End input "Full Name" field-->
               </div>  
               <div class="row">
                  <div class="img-preview col s8 m4 push-m4 push-s2">
                      <h5 class="center-align"><?php echo lang("FOTO_UPLOAD")?></h5>
                  </div>     
               </div>
                <div class = 'row'>
                  <div class="file-field input-field col s8 m6 push-m3 push-s2">
                    <div class="btn">
                      <span>File</span>
                      <input type="file"
                             class = 'user-img'
                             id = "user-img"
                             preview = ".img-preview"
                             onchange="$(this).attr('len',this.files.length);"
                             remove = ".img-preview h5, .img-preview img"
                             name  = "foto"
                             data-do = "check_foto"
                             data-place = "#foto-erorr">
                    </div>
                    <div class="file-path-wrapper">
                      <input class = "file-path validate"
                             placeholder = "<?php echo lang("FOTO_UPLOAD"); ?>">
                        
                    </div>
                    <div class="center-align" id="foto-erorr"></div>  
                  </div>  
                </div>   
              </div> 
              <div class="row">
                <button class="btn waves-effect waves-light col s4 m2 push-s4 push-m5  " type="submit" name="register"><?php echo lang("REGISTER")?>
                <i class="material-icons right">send</i>
               </button> 
              </div>
          </form>

        <!--print Erorrs register form form -->

        <div class="erorrs">
            
          <?php    if(isset($ErrArray)){ 

                      foreach($ErrArray as $Err){ ?> 

                             <!--Err : Erorr msg -->
                             <p class='errmsg-php center-align' style='display:block'><?php echo $Err; ?></p> 

                         <?php }
                   } ?>
        </div>
        <!--End erorrs -->
<?php 
    
    include $tpl."footer.php";
    ob_end_flush();
?>