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
    
    //get "page" value if exist, then sent it by ajax to process data and return #required-info 
    
    $query = isset($_GET['page'])? $_GET['page'] : " "; 
    
 
     ?>
     <!--start serch field-->
     
       <div class="nav-wrapper" >
            <div class="input-field">
              <input id="search-user-info" type="search" id="search" required >
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons close Large">close</i>
            </div>
        </div>
       
      <h1 class="center-align">Mange members</h1>
   <!--end serch field-->
      <div class="container">
          <!--in this div "required-info" requests will be saved, to send as ajax request-->
          <div class="required-info" style="display:none">
             <span id ='query'><?php echo $query; ?></span>
          </div>
          <div class= "">
          <!-- Modal Structure -->
             <!--start table users-->
           
               <table  class="bordered responsive-table centered " >
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
                   
                <tbody id="users-table-body">
                    
                <!--start table body-->    
            
             <!--   table content will be sended by ajax from dbfunctions -->
                    
                </tbody><!-- End table Body-->
              </table>
              <button type="button" id="add-btn" class="waves-effect waves-light btn">Add new Member</button>
            </div>
        </div>  

     <!--End table users-->
     
         
<!--       start modal "confirm" Add user-->
         
          <div id="add-user" class="modal modal-fixed-footer">
            <form id="form55"> 
             <div class="modal-content">
                    <h1 class="center-align"><?php echo lang('ADD_MEMBERS')?></h1>
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
                                 value = "zaid kaled"
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
                  </div> <!--End modal content -->
              

      <!--         Members/End Add Form-->
    
            
                <div class="modal-footer">
                  <a type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" data-do="insert" id='info-send' value="submit"> send </a>
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
             </form>
            </div>


<!--         Members/start Edit from (Update info)-->
           
      <!--         Members/End Add Form-->
      
      <?php 
                 
       include $tpl."footer.php"; 
        
        
   } else { //if sission doesn't started then

 	header("Location:index.php");

 	exit();

 }

