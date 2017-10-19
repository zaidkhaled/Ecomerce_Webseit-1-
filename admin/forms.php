<?php
    
       $url = $_SERVER['REQUEST_URI'];
       if (strpos($url, "members") !== false){;?>
     
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
              

                 <!--Members/End Add Form-->
    
            
                <div class="modal-footer">
                  <a type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" data-do="insert" id='info-send' value="submit"> send </a>
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
             </form>
            </div>

 
           <!--Members/start Edit from (Update info)-->
   <?php } elseif (strpos($url, "categories") !== false) {?>
           
           <!--start categories/ Add and update Categories Form-->
            <div id="update-add-cate" class="modal modal-fixed-footer">
              <div class="modal-content">      
                <h1 class="center-align form-title-add"><?php echo lang('ADD_NEW_CATEGORIES')?></h1>
                <h1 class="center-align form-title-update"><?php echo lang("EIDT_CATEGORIES")?></h1>
                <form class="form AddFormCate">
              <!--start input "Add Category Name" field-->       
                  <div class="row"> 
                    <div class="input-field col s8 m5 push-m1 push-s2">
                     <i class="material-icons  prefix">queue</i> 
                     <input type="hidden" id="cate-id">    
                      <input id="cate-name"
                             type="text" 
                             class="validate input" 
                             limit ="3"
                             name="CateName"
                             data-required='required'>
                      <label for="icon_prefix"><?php echo lang("CATEGORY_NAME")?></label>
                      <span></span>
                      <div class="errmsg">
                         <p class='msg'> <?php echo lang("ERRMSG(3)_JS")?></p>
                      </div>
                    </div>
                      <!--End input "Add Category Name" field-->     

                     <!--start input "Add Description" field--> 

                    <div class="input-field col s8 m5 push-m1 push-s2">
                      <i class="material-icons prefix">border_color</i>
                      <input id="cate-descrp" 
                             limit ="6"
                             type="text"
                             limit = "8"
                             class="validate input" 
                             name="description"
                             data-required='free'>
                      <label for="icon_prefix"><?php echo lang('DESCRIPTION')?></label>
                    </div>
                       <!--End input "Description" field--> 
                   </div>

                <!--start input "Ordering" field--> 
                  <div class="row order">
                    <div class="input-field col s8 m4 push-m4 push-s2">
                      <i class="material-icons prefix">event_note</i>
                      <input  id = 'cate-order'
                             type="text"
                              class="validate password1 input" 
                             name = 'order'
                              limit ="4"
                             data-required='free'>
                      <label for="icon_telephone"><?php echo lang("ORDERING")?></label>
                    </div>
                  </div>

                    <!--End input "ordring" field-->

                   <!--start radio buttons for visiblity and allow comment and advertising field--> 

                    <div class="row cate-status">  
    <!--                  start radio btn for visibilty-->
                         <div class="col s8 m2 push-m3 push-s2 radio">
                             <span><?php echo lang('VISIBILTY')?></span>
                            <p>
                              <input type="checkbox" class="filled-in" id="visble" checked="checked" />
                              <label for="visble">Allow</label>
                            </p>
                        </div> <!--End radio btn for visibilty-->

                       <!--start radio btn for Comment-->
                        <div class="col s8 m2 push-m3 push-s2 radio">
                            <span><?php echo lang("Comment")?></span>
                          <p>
                          <input type="checkbox" class="filled-in" id="comment" checked="checked" />
                          <label for="comment">Allow</label>
                        </p>
                        </div>  
         <!--                  End radio btn for Comment-->

         <!--                  start radio btn for Adevertising-->

                        <div class="col s8 m2 push-m3 push-s2 radio">
                            <span><?php echo lang("ADVERTISING")?></span>
                             <p>
                              <input type="checkbox" class="filled-in" id="adv" checked="checked" />
                              <label for="adv">Allow</label>
                            </p>
                        </div><!--End radio btn for Adevertising-->    
                     </div>  <!--End radio buttons for visiblity and allow comment and advertising field--> 
                  </form><!--End form-->
                </div><!--end modal contant-->

          <!--         Members/End Add Form-->

               <div class="modal-footer">
                  <a class="modal-action modal-close waves-effect waves-green btn-flat"  id='add-cate'> send </a>
                   <a class="modal-action modal-close waves-effect waves-green btn-flat"  id='update-cate'> send </a>
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
          </div> <!--End modal-->

        
    <?php } elseif (strpos($url, 'items') !== false or strpos($url, 'dashboard') !== false) {?>

            <!-- start modal add item form -->
           <div id="update-add-item" class="modal modal-fixed-footer">
             <div class="modal-content">      
               <h1 class="center-align form-title-add"><?php echo lang("ADD_NEW_ITEMS")?></h1>
               <h1 class="center-align form-title-update"><?php echo lang("UPDATA_ITEM")?></h1>
               <form class="form AddFormCate" action="?do=insert" method="POST">
                  <!--start input "Add item Name" field-->       
                  <div class="row"> 
                    <div class="input-field col s8 m5 push-m1 push-s2">
                      <i class="material-icons  prefix">queue</i>
                         <input type="hidden" value="" id="item-id"> 
                        <input id="item-name"
                               type="text" 
                               class="validate input" 
                               limit ="3"
                               name="CateName"
                               data-required='required'>
                        <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
                        <span></span>
                        <div class="errmsg">
                          <p class='msg'> <?php echo lang("ERRMSG(3)_JS")?></p>
                        </div>
                        </div><!--End input "Add item Name" field-->  

                         <!--start input "Add Description" field--> 
                    <div class="input-field col s8 m5 push-m1 push-s2">
                      <i class="material-icons prefix">border_color</i>
                        <input id="item-descrp" 
                               limit ="6"
                               type="text"
                               limit = "8"
                               class="validate input" 
                               name="description"
                               data-required='required'>
                          <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
                       </div>
                     </div><!--End input "Description" field--> 

                    <!--start input "price and made in" field--> 
                    <div class="row">
                        <!-- stsrt "price" field -->
                       <div class="input-field col s8 m5 push-m1 push-s2">
                         <i class="material-icons prefix">attach_money</i>
                         <input id ='item-price'
                                type="text"
                                class="validate password1 input" 
                                name = 'order'
                                limit ="4"
                                data-required='required'>
                         <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
                       </div><!-- end "price" field -->
                      <!-- stsrt "made in" field -->
                       <div class="input-field col s8 m5 push-m1 push-s2">
                         <i class="material-icons prefix">texture</i>
                         <input id ='made-in'
                                type="text"
                                class="validate password1 input" 
                                name = 'order'
                                limit ="4"
                                data-required='required'>
                         <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
                       </div><!-- stsrt "made in" field -->
                     </div>  
                   <!--start user and categories selector -->
                    <div class="row">
                         <!--  make  user selector, in database -->
                         <div class="input-field col s8 m5 push-m1 push-s2">
                           <select id="select-user">
                             <!--the first selection will be current "$_SESSION['ID']" and user name -->     
                             <option value="<?php echo $_SESSION['ID'];?>" selected> <?php echo $_SESSION['username'];?> </option>   

                             <?php  
                             $users = getAll("*", "users", $_SESSION['ID']); // fetch all "user name" from database without current "$_SESSION['ID']" and print them in this selector 
                             foreach($users as $user){
                               echo "<option value ='".$user['userID'] ."'>".$user['username']."</option>" ;
                            }
                            ?>   

                           </select>
                         <label><?php echo lang("USER_NAME")?></label>
                       </div> <!--  end user <select> -->
                      <!--start category selector-->
                      <div class="input-field col s8 m5 push-m1 push-s2">
                           <select id="select-cate">
                             <option value="" selected>...</option>    

                             <?php  
                             $cates = getAll("*", "categories"); // fetch all categories from database and print them in this selector 
                             foreach($cates as $cate){
                               echo "<option value ='".$cate['ID'] ."'>".$cate['Name']."</option>" ;
                             }
                             ?>

                           </select>
                         <label><?php echo lang("CATEGORY_NAME")?></label>
                      </div><!--end  category selector-->
                    </div><!--end user and categories selector -->

                    <!--start status selector "new, old"-->
                    <div class ='row'>
                      <div class="input-field col s8 m4 push-m4 push-s2">
                        <select id="select-status"> 
                          <option value="new" selected><?php echo lang("NEW")?></option>
                          <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
                          <option value="used"><?php echo lang("USED")?></option>
                          <option value="old"><?php echo lang("OLD")?></option>
                        </select>
                      <label><?php echo lang("STATUS")?></label>
                     </div>
                   </div>  <!--start status selector "new, old"-->

                   </form><!--End form-->
                 </div><!--end modal contant-->


                  <div class="modal-footer">
                    <a class="modal-action modal-close waves-effect waves-green btn-flat send-btn" id='add-new-item' value="submit"> send </a>
                    <a class="modal-action modal-close waves-effect waves-green btn-flat send-btn" id='update-item' value="submit"> send </a>
                    <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                  </div>
              </div> <!-- start modal add new item form -->

             <!--start edit comments-->
             <div id="update-comments-form" class="modal">
               <div class="modal-content"> 
                 <div class="input-field col s6">
                   <i class="material-icons prefix">mode_edit</i>
                   <textarea id="icon_prefix2 " class="materialize-textarea comment-update-field"></textarea>
                   <input type="hidden" class="comment-id">
                   <label for="icon_prefix2">First Name</label>
                 </div>
               </div><!--end modal contant--> 
              <div class="modal-footer">
                <a class="modal-action modal-close waves-effect waves-green btn-flat send-btn" id='update-comments-to-item' value="submit"> send </a>
                <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
              </div>
            </div> <!--end edit comments-->
             
  <?php  } elseif (strpos($url, 'comments') !== false) { ?>

     <!--start edit comments-->
     <div id="update-comments-form" class="modal">
       <div class="modal-content"> 
         <div class="input-field col s6">
           <i class="material-icons prefix">mode_edit</i>
           <textarea id="icon_prefix2 " class="materialize-textarea comment-update-field"></textarea>
           <input type="hidden" class="comment-id">
           <label for="icon_prefix2">First Name</label>
         </div>
       </div><!--end modal contant--> 
      <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat send-btn" id='update-comments' value="submit"> send </a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
      </div>
    </div>
     <!--end edit comments-->
      <?php }












