<?php
    
   $url = $_SERVER['REQUEST_URI'];

   if (strpos($url, "members") !== false){ ; ?>
     
         <!-- start modal "confirm" Add user-->
          <div id="add-user" class="modal modal-fixed-footer">
            <form class = "ajax-form" data-do="insert_user" data-place ="#users-table-body" form-num = "1" enctype="multipart/form-data" > 
             <div class="modal-content">
                    <h1 class="center-align"><?php echo lang('ADD_MEMBERS')?></h1>
                      <div class="row"> 
                          <!--End input "Add user Name" field--> 
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="add-name"
                                 pattern=".{3,}"
                                 title = "<?php echo lang("PHP_ERRMSG_NAME"); ?>"
                                 type="text" 
                                 class="validate input" 
                                 limit ="3"
                                 required>
                          <label for="icon_prefix"><?php echo lang('FIRST_NAME')?></label>
                        </div>

                         <!--start input "Add Email" field--> 
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">email</i>
                          <input id="add-email" 
                                 pattern=".{3,}"
                                 title = "<?php echo lang("PHP_ERRMSG_EMAIL"); ?>"
                                 type="email"
                                 class="validate input"
                                 required>
                          <label for="icon_prefix"><?php echo lang('EMAIL')?></label>
                        </div>
                          <!--End input "Email" field--> 
                       </div>

                      <div class="row">
                          <!--start input "Add password" field--> 
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">lock_outline</i>
                          <input  type="password" 
                                  minlength="4"
                                  id="add-pass1" 
                                  class="validate input"
                                  required>
                          <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                        </div>
                         <!--End input "Add password" field--> 
                          <!--start input "Repeat password" field--> 
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">lock_outline</i>
                          <input id="add-pass2" 
                                 minlength="4"
                                 type="password"
                                 class="validateinput"
                                 required>
                          <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                        </div>  
                          <!--End input "Repeat password" field-->
                      </div>

                      <div class="row">  
                          <!--start input "Full Name" field-->
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <i class="material-icons prefix">account_box</i>
                          <input id="add-fName" 
                                 pattern=".{4,}"
                                 title = "<?php echo lang("PHP_ERRMSG_FULLNAME"); ?>"
                                 type="text"
                                 class="validate input"
                                 required>
                          <label for="icon_telephone"><?php echo lang('FULLNAME')?></label>
                        </div> <!--End input "Full Name" field-->
                        <div class="input-field col s8 m5 push-m1 push-s2">
                          <select id="select-group">
                            <option value="0" selected>User</option>    
                            <option value="1" >Admin</option>    
                          </select>
                          <label><?php echo lang("GRUOP")?></label>
                        </div><!--end  category selector-->    
                     </div>
                     <div class="row ">
                       <div class="file-field input-field col s10 m6 push-m3 push-s1">
                         <img src ="../uplaodedFiles/usersFoto/foto1.JPG" class="responsive-img img-preview">    
                         <div class="btn">
                            <span>File</span>
                            <input type  ="file" 
                                   class = "newFoto"
                                   len = "0"
                                   onchange="$(this).attr('len',this.files.length);">
                          </div>
                          <div class="file-path-wrapper">
                            <input class = "file-path validate"
                                   placeholder = "<?php echo lang("FOTO_UPLOAD"); ?>">
                          </div>
                        </div>
                      </div>     
                   </div> <!--End modal content -->
              
                 <!--Members/End Add Form-->
                <div class="modal-footer">
                  <input type="submit" name = "submit" class="modal-action waves-effect waves-green btn-flat"  value="send">
                  <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
             </form>
            </div>

 
           <!--Members/start Edit from (Update info)-->
   <?php } elseif (strpos($url, "categories") !== false) {?>
           
           <!--start categories/ Add and update Categories Form-->
            <div id="update-add-cate" class="modal modal-fixed-footer">

              <form class="form AddFormCate ajax-form" data-update="cate_update" data-add = "insert_cate" data-do = "" data-place = "#mange-cate" > 
                <div class="modal-content">      
                  <h1 class="center-align form-title-add"><?php echo lang('ADD_NEW_CATEGORIES')?></h1>
                  <h1 class="center-align form-title-update"><?php echo lang("EIDT_CATEGORIES")?></h1>
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
                             required>
                      <label for="icon_prefix"><?php echo lang("CATEGORY_NAME")?></label>
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
                             required>
                      <label for="icon_prefix"><?php echo lang('DESCRIPTION')?></label>
                    </div>
                       <!--End input "Description" field--> 
                    </div>
                    <div class="row">
                      <!--start input "Ordering" field--> 
                      <div class="input-field col s8 m5 push-m1 push-s2">
                         <i class="material-icons prefix">event_note</i>
                         <input  id = 'cate-order'
                                 type="text"
                                 class="validate password1 input" 
                                 name = 'order'
                                 limit ="4"
                                 required>
                         <label for="icon_telephone"><?php echo lang("ORDERING")?></label>
                       </div>
                      <!--start category selector-->
                      <div class="input-field col s8 m5 push-m1 push-s2">
                           <select id="select-parent">
                             <option value="0" selected>None</option>    

                             <?php  
                             $cates = globalGet("*", "categories", "WHERE Parent = 0"); // fetch all categories from database and print them in this selector 
                             foreach($cates as $cate){
                               echo "<option value ='".$cate['ID'] ."'>".$cate['Name']."</option>" ;
                             }
                             ?>

                           </select>
                         <label><?php echo lang("PARENT")?></label>
                      </div><!--end  category selector-->                    
                  </div>

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
                            <span><?php echo lang("COMMENT")?></span>
                          <p>
                            <input type="checkbox" class="filled-in" id="comment" checked="checked" />
                            <label for="comment">Allow</label>
                          </p>
                        </div>  
                        <!--End radio btn for Comment-->
                        <!-- start radio btn for Adevertising-->
                        <div class="col s8 m2 push-m3 push-s2 radio">
                            <span><?php echo lang("ADVERTISING")?></span>
                             <p>
                              <input type="checkbox" class="filled-in" id="adv" checked="checked" />
                              <label for="adv">Allow</label>
                            </p>
                        </div><!--End radio btn for Adevertising-->    
                     </div>  <!--End radio buttons for visiblity and allow comment and advertising field--> 
                   </div>
                   <!--   Members/End Add Form-->
                  <div class="modal-footer">
                     <input type="submit"  class="modal-action waves-effect waves-green btn-flat" value="send">
                     <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                 </div>
              </form><!--End form-->
            </div> <!--End modal-->
            

        
    <?php } elseif (strpos($url, 'items') !== false or strpos($url, 'dashboard') !== false) { ?>

            <!-- start modal add item form -->
           <div id="update-add-item" class="modal modal-fixed-footer">
             <form class="form addItem ajax-form"
                   data-add ="insert_item"
                   data-update = "update-item"
                   data-do = "" 
                   data-place = "#item-table-body" 
                   enctype="multipart/form-data"> 
                 
               <div class="modal-content">      
                  <h1 class="center-align form-title-add"><?php echo lang("ADD_NEW_ITEMS")?></h1>
                  <h1 class="center-align form-title-update"><?php echo lang("UPDATA_ITEM")?></h1>
                  <!--start input "Add item Name" field-->       
                  <div class="row"> 
                    <div class="input-field col s8 m5 push-m1 push-s2">
                      <i class="material-icons  prefix">queue</i>
                         <input type="hidden" value="" id="item-id"> 
                        <input pattern=".{3,}"
                               title = "<?php echo lang("PHP_ERRMSG_ITEM_NAME"); ?>"
                               id="item-name"
                               type="text" 
                               class="validate input" 
                               >
                        <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
                     </div><!--End input "Add item Name" field-->  

                         <!--start input "Add Description" field--> 
                    <div class="input-field col s8 m5 push-m1 push-s2">
                      <i class="material-icons prefix">border_color</i>
                        <input id="item-descrp" 
                               pattern=".{3,}"
                               title = "<?php echo lang("PHP_ERRMSG_ITEM_NAME"); ?>"
                               type="text"
                               limit = "8"
                               class="validate input" 
                               >
                          <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
                       </div>
                     </div><!--End input "Description" field--> 

                    <!--start input "price and made in" field--> 
                    <div class="row">
                        <!-- stsrt "price" field -->
                       <div class="input-field col s8 m5 push-m1 push-s2">
                         <i class="material-icons prefix">attach_money</i>
                         <input id ='item-price'
                                pattern=".{1,}"
                                type="text"
                                class="validate input" 
                                name = 'order'
                                >
                         <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
                       </div><!-- end "price" field -->
                      <!-- stsrt "made in" field -->
                       <div class="input-field col s8 m5 push-m1 push-s2">
                         <i class="material-icons prefix">texture</i>
                         <input id ='made-in'
                                type="text"
                                class="validate input">
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
                               $cate_child = globalGet("*", "categories", "WHERE Parent ={$cate['ID']}");     
                               foreach($cate_child as $child){
                                  echo "<option value ='".$cate['ID'] ."'> ---- ".$child['Name']."</option>" ;   
                               }  
                             }
                             ?>
                           </select>
                         <label><?php echo lang("CATEGORY_NAME")?></label>
                      </div><!--end  category selector-->
                    </div><!--end user and categories selector -->
                    <!--start status selector "new, old"-->
                    <div class ='row'>
                      <div class="input-field col m3 s10 push-s1 push-m1">
                        <select id="select-status"> 
                          <option value="new" selected><?php echo lang("NEW")?></option>
                          <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
                          <option value="used"><?php echo lang("USED")?></option>
                          <option value="old"><?php echo lang("OLD")?></option>
                        </select>
                      <label><?php echo lang("STATUS")?></label>
                     </div><!--end status selector "new, old"-->
                    
                   <!-- start "tags" field -->
                     <div class="input-field col m4 s10 push-m1 push-s1">
                       <i class="material-icons prefix">texture</i>
                       <input id ='tags'
                              type="text"
                              class="validate input">
                       <label for="icon_telephone"><?php echo lang("TAGS")?></label>
                     </div><!-- end "tags" field -->
                     <div class=" input-field col m3 s10 push-m1 push-s1">    
                       <input type="number"
                              value = "1" 
                              min= "1" 
                              max= "100000"
                              id = "num-item">
                        <label for="icon_prefix">how many</label>
                      </div>   
                   </div>         
                        
                  <div class = "row files-place">
                     <div class="file-field input-field col s8 m5 push-m1 push-s2">
                        <div class="btn">
                          <span>File</span>
                          <input type="hidden" id="user-id" value="<?php echo $_SESSION["ID"]; ?>">         
                          <input id = "imgs"
                                 type="file"
                                 name= "foto" multiple 
                                 onchange="$(this).attr('len',this.files.length);"
                                 >
                         </div>
                         <div class="file-path-wrapper">
                           <input class = "file-path validate"
                                  id = 'filePath'
                                  placeholder = "<?php echo lang("FOTO_ITEM_UPLOAD"); ?>">
                         </div>
                      </div> 
                      <div class="main-foto col s8 m5 push-m1 push-s2">
                        <div class="file-field input-field ">
                          <div class="btn" >
                            <span>File</span>
                            <input data-do = "check_foto"
                                   data-place = "#foto-erorr"
                                   id = "item-main-img"
                                   class = "item-main-img"
                                   type="file"
                                   remove = "#main-item-foto h5, #main-item-foto .user-foto "
                                   onchange="$(this).attr('len',this.files.length);"
                                   name= "foto" 
                                   preview = "#main-item-foto">
                           </div>
                           <div class="file-path-wrapper">
                             <input class = "file-path validate"
                                    id = "#path-main-item"
                                    placeholder = "Main foto">
                           </div>
                        </div>

                     </div> 
                  </div>
                  <div class="row">
                    <div class="imgs-preview col m5 s12 push-m1">
                        <h5 class="center-align">item-fotos</h5>
                    </div>  
                    <div class="img-preview col m5 s12 push-m1" id="main-item-foto">
                      <h5 class="center-align">Main foto</h5>
                    </div>   
                  </div>
                  
               </div><!--end modal contant-->
               
               <div class="modal-footer">
                  <input  type="submit" class="modal-action waves-effect waves-green btn-flat send-btn" value="send">
                   
                  <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
               </form><!--End form-->
             </div> <!-- start modal add new item for m -->
             <!--start edit comments-->
             <div id="update-comments-form" class="modal">
              <form class="ajax-form comment-form" data-place = "#comments-item" data-item = ""  data-do = "update_comment" data-id =""  data-required = "comments">   
                <div class="modal-content"> 
                  <div class="input-field col s6">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2 " class="materialize-textarea comment-update-field"></textarea>
                    <input type="hidden" class="comment-id">
                    <label for="icon_prefix2">update Comment</label>
                  </div>
                </div><!--end modal contant--> 
               <div class="modal-footer">
                 <input type = "submit" class="modal-action modal-close waves-effect waves-green btn-flat send-btn" value="send">   
                 <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
              </form>  
            </div> <!--end edit comments-->
             
  <?php  } elseif (strpos($url, 'comments') !== false) { ?>

     <!--start edit comments-->
     <div id="update-comments-form" class="modal">
           
       <form class = 'ajax-form edit-comment' data-do= "update_comment"  data-id ="" data-place = '#comments-table-body'>
         <h1 class="center-align">Update comment</h1>     
         <div class="modal-content"> 
           <div class="input-field col s6">
             <i class="material-icons prefix">mode_edit</i>
             <textarea id="icon_prefix2 " class="materialize-textarea comment-update-field"></textarea>
             <input type="hidden" class="comment-id">
             <label for="icon_prefix2">update Comment</label>
           </div>
         </div><!--end modal contant--> 
        <div class="modal-footer">
          <input type="submit" class="modal-action modal-close waves-effect waves-green btn-flat send-btn" value="Send" >
          <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
        </div>
      </form>     
    </div>
     <!--end edit comments-->
      <?php }












