 <ul id="dropdownSM" class="dropdown-content">
  <li><a class='edit-button'> <?php echo lang('EDIT')?>  </a></li>
  <li><a href="#!"><?php echo lang('SETTING')?></a></li>
  <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

 <ul id="dropdownMED" class="dropdown-content">
    <li><a class= 'edit-button'><?php echo lang('EDIT')?></a></li>
    <li><a href="#!"><?php echo lang('SETTING')?></a></li>
    <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

<nav>
   <div class="container">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a href="../index.php"><?php echo lang('SHOP')?></a></li>    
          <li><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
          <li><a href="items.php"><?php echo lang('ITEMS')?></a></li>
          <li><a href="members.php"><?php echo lang('MEMBERS')?></a></li>
          <li><a href="statistics.php"><?php echo lang('STATISTICS')?></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdownMED">Zeid<i class="material-icons right">arrow_drop_down</i></a></li> 
        </ul>
          
        <ul class="left">
           <li><a href="dashboard.php" class="left-align brand-logo"><?php echo lang('HOME_ADMIN')?></a></li> 
        </ul>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

         <ul class="side-nav" id="mobile-demo">
           <li><a href="../index.php">Shop</a></li>
           <li><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
           <li><a href="items.php"><?php echo lang('ITEMS')?></a></li>
           <li><a href="members.php"><?php echo lang('MEMBERS')?></a></li>
           <li><a href="statistics.php"><?php echo lang('STATISTICS')?></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdownSM">Zeid<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul><bu
      </div>
   </div>
      
</nav>

 <!--modal "edit form" "confirm" , if user click on Edit button to give user the ability to edit own data from any page any time, and to edit any user info if user is in members.php page-->
    
            <div id="update-form" class="modal modal-fixed-footer update-form">
              <form  
                    class = "ajax-form edit-user" 
                    data-do ="update_user_info" 
                    data-place = "" 
                    enctype="multipart/form-data"
                    form-num = "2"
                    data-dash = "#last-users-list, #users-table-body"
                    data-memb = "#users-table-body" >

                 <div class="modal-content">
                        <h1 class="center-align"><?php echo lang('EDIT_MEMBERS')?></h1>
                          <div class="row">
                            <!--  user id will be saved in this hidden input-->
                            <input type="hidden" id ='user-id' session-id="<?php echo $_SESSION['ID'];?>"> 
                              <!--start input "user Name" field-->
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">account_circle</i>
                              <input type="text" 
                                     pattern=".{3,}"
                                     title = "<?php echo lang("PHP_ERRMSG_NAME"); ?>"
                                     required
                                     session-name='<?php echo $_SESSION['username']; ?>'
                                     class="validate input" 
                                     id = "NewUserName">
                              <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                            </div>
                             <!--End input "user Name" field--> 
                              
                             <!--End input "Email" field--> 
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">email</i>
                              <input pattern=".{3,}"
                                     title = "<?php echo lang("PHP_ERRMSG_EMAIL"); ?>"
                                     required
                                     type="email" 
                                     session-Email= '<?php echo $_SESSION['Email'];?>'
                                     class="validate input" 
                                     id="NewEmail">
                              <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                            </div>
                              <!--End input "Email" field--> 
                           </div>

                          <div class="row">
                              <!--End input "password" field--> 
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">lock_outline</i>
                              <input  type="password"
                                      minlength="4"
                                      id = 'pass1'
                                      class="validate input" >
                                
                              <input type="hidden"
                                     class="validate "
                                     id = "oldPassword"
                                     admin-pass ='<?php echo $_SESSION['pass'];?>'
                                     >
                                
                              <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                            </div>
                               <!--End input "password" field--> 
                               <!--start input "repeat password" field--> 
                              
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">lock_outline</i>
                              <input type="password"
                                     minlength="4"
                                     class="validate input" 
                                     id="pass2">
                              <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                            </div> 
                              <!--End input "repeat password" field-->
                          </div>

                          <div class="row"> 
                              <!--start input "Full Name" field-->
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">account_box</i>
                              <input type="text"
                                     pattern=".{4,}"
                                     title = "<?php echo lang("PHP_ERRMSG_FULLNAME"); ?>"
                                     class="validate input"         
                                     session-fullName = '<?php echo $_SESSION['fullname']; ?>'
                                     required
                                     id="NewFullName">
                              <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                            </div>
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <select id="select-group">
                                <option value="0" selected>User</option>    
                                <option value="1" >Admin</option>    
                              </select>
                              <label><?php echo lang("GRUOP")?></label>
                            </div><!--end  category selector-->   
                              <!--End input "Full Name" field-->
                          </div>
                          <div class="row">
                            <div class="file-field input-field col s10 m6 push-m3 push-s1">
                              <img src ="../uplaodedFiles/userFotos/foto1.JPG" class="responsive-img img-preview">    
                              <div class="btn">
                                <span>File</span>
                                <input type  ="file" 
                                       class = "updateFoto"
                                       len = "0"
                                       onchange="$(this).attr('len',this.files.length);">
                              </div>
                              <div class="file-path-wrapper">
                                <input class = "file-path validate"
                                       placeholder = "<?php echo lang("FOTO_UPLOAD"); ?>">
                              </div>
                            </div>
                          </div>   
                        </div> <!--End content modal-->    
                        <div class="modal-footer">
                           <input type="submit"
                                  class="modal-action waves-effect waves-green btn-flat"
                                  value="<?php echo lang("SAVE");?>">
                           <a  class="modal-action modal-close waves-effect waves-green btn-flat "><?php echo lang("CLOSE");?></a>
                         </div>    
                        </form><!--End Edit form-->
                    </div>

        
