<?php 
/*
=========================
   Mange Members Page
   Add | Delete | Edit
=========================    
*/

session_start();
  
    
if(isset($_SESSION['username'])){
        
     //  start mange Page 
    
     include "init.php";
    
     $pageTitle = "Members";
    
     include $tpl. "header.php";
    
     include $tpl. "nav.php"; 
    
     ?>
      <div class="container">
          <div class= "mange">
          <!-- Modal Structure -->
            
             <!--start table users-->
            
               <table  class="bordered responsive-table centered table" >
                   <!--start Table header-->
                <thead>
                  <tr>
                      <th>#ID</th>
                      <th id="in"><?php echo lang("FIRST_NAME" )?></th>
                      <th><?php echo lang("EMAIL")?></th>
                      <th><?php echo lang("FULLNAME")?></th>
                      <th><?php echo lang("REGISTERED")?></th>
                      <th><?php echo lang("CONTROL")?></th>
                  </tr>
                </thead>
                   
                  <!--End Table header-->
                   
                <tbody id="tabel-body">
                    
                <!--start table body-->    
            
<!--                table content will be sended by ajax -->
                    
                </tbody><!-- End table Body-->
              </table>
              <button type="button" id="add-btn" class="waves-effect waves-light btn">Add new Member</button>
               
            </div>
        </div>  

     <!--End table users-->
     
         
<!--       start modal "confirm" Add user-->
         
          <div id="add-user" class="modal modal-fixed-footer">
             <div class="modal-content">
                    <h1 class="center-align"><?php echo lang('ADD_MEMBERS')?></h1>
                    <form class="EditForm form " action="?do=Insert" method="POST">
                    
                      <div class="row"> 
                          
                          <!--End input "Add user Name" field--> 
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="add-name"
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
                          <input id="add-email" 
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
                                  id="icon_prefix " 
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
                          <input id="add-pass" 
                                 type="password"
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
                          <input id="add-fName" 
                                 type="text"
                                 class="validate input"
                                 value = "zaid kaled"
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

                    </form><!--End form-->
                  </div> <!--End content modal-->

      <!--         Members/End Add Form-->
    
            
                <div class="modal-footer">
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat" data-do="insert" id="info-send">Agree</a>
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
            </div>


<!--         Members/start Edit from (Update info)-->
         <div id=edit-btn>
             <li><a href="#updata-form" class="nav-edit2" userID="<?php echo $_SESSION['ID']?>"><?php echo lang('EDIT')?>
                </a></li>
              <div id="updata-form" class="modal modal-fixed-footer updata-form">
                 <div class="modal-content">
                        <h1 class="center-align"><?php echo lang('EDIT_MEMBERS')?></h1>
                        <form class="EditForm form " action="?do=update" method="POST">
                          <div class="row">
<!--                              user id will be saved in this hidden input-->
                              <input type="hidden" id ='user-id'> 
                              
                              <!--start input "user Name" field-->
                            <div class="input-field col s8 m5 push-m1 push-s2">
                              <i class="material-icons prefix">account_circle</i>
                              <input type="text" 
                                     data-value='0'
                                     session-name='<?php echo $_SESSION['username'];?>'
                                     class="validate input" 
                                     limit ="3"
                                     id = "NewuserName">
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
                                     session-Email='<?php echo $_SESSION['Email'];?>'
                                     class="validate input" 
                                     id="NewEmail"
                                     limit = "6">
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
                                     id = "oldPassword"
                                     value ='<?php echo $_SESSION['pass'];?>'
                                     >
                                
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
                                     id="NewPassword">
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
                              <input type="text" 
                                     class="validate input" 
                                     limit ="8"
                                     session-fullName='<?php echo $_SESSION['fullname'];?>'
                                     data-value='0'
                                     id="NewFullName">
                              <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                              <span></span>
                              <div class="errmsg">
                                 <p class='msg'> <?php echo lang('ERRMSG(8)_JS')?></p>
                              </div>
                            </div>
                              <!--End input "Full Name" field-->
                          </div>   
                        </form><!--End Edit form-->
                    </div> <!--End content modal-->
                  
                    <div class="modal-footer">
                        
                       <a  class="modal-action modal-close waves-effect waves-green btn-flat" id="info-updata" data-do="info-updata"><?php echo lang("SAVE");?></a>
                        
                       <a  class="modal-action modal-close waves-effect waves-green btn-flat "><?php echo lang("CLOSE");?></a>
                     </div>
                 </div> 
      <!--         Members/End Add Form-->

      <?php 
                 
       include $tpl."footer.php"; 
        
        
 } else { //if sission doesn't started then

 	header("Location:index.php");

 	exit();

 }

