 <?php 
 ob_start();
 session_start();

 $pageTitle = $_SESSION['user'];

 include "init.php"; 
 include $tpl."header.php";
 include $tpl."nav.php";


 if(isset($_SESSION['user'])){ //check if user alrady logined ?>
  
       <div class="row">
         <div class="col m3 left hide-on-med-and-down"> <!-- Note that "m4 l3" was added -->
           <div class="info-item-clm ">
            <div class="container">
               <div class="info">
                 <?php $info =   globalGet("*", "users", " WHERE userID = " . $_SESSION['ID'] , "", "userID", "",$limit = 1); ?>
                 <h4 class="info-title"><?php echo lang("PERSONAL_INFO");?></h4>
                 <!--Edit btn for prsonal info -->
                 <div class="row">
                   <a class="secondary-content update-btn ajax-click" data-do ="show_inputs_field" data-place = "#user-info">
                     <i class="material-icons">mode_edit</i>
                   </a>
                 </div> <!--End edit btn for prsonal info -->
                 <!-- start personal info-->
                 <div class="row" id = "user-info">
                   <p class="user-info"><?php echo lang("FIRST_NAME");?>: <?php echo $info['username'];?></p>
                   <p class="user-info"><?php echo lang("EMAIL");?>:      <?php echo $info['Email'];?></p>
                   <p class="user-info"><?php echo lang("FULLNAME");?>:   <?php echo $info['fullName'];?></p>
                </div> <!-- end personal info-->
                <p class="center-align password-change"><?php echo lang("CHANGE_PASSWORD");?></p>
                <form class="ajax-form" data-do = "change_pass" data-place = "#errors" >
                  <div class="password-fields">
                    <!--start input "Add password" field--> 
                     <div class="input-field">
                       <i class="material-icons prefix">lock_outline</i>
                       <input pattern=".{6,}"
                              type="password"
                              id="pass1" 
                              class="validate password1 input"  
                              required>
                       <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                     </div> <!--End input "Add password" field--> 
                   
                      <!--start input "Repeat password" field--> 
                     <div class="input-field">
                       <i class="material-icons prefix">lock_outline</i>
                       <input pattern = ".{6,}"
                              id="pass2" 
                              type="password"
                              class="validate password2 input" 
                              required>
                      <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                    </div>  <!--End input "Repeat password" field-->
                        <button type="submit"   class="waves-effect waves-light btn right"><?php echo lang("CHANGE_PASSWORD") ; ?></button>
                  </div>
                </form> 
                <!--  the  where errors shuld be -->
                <div id="errors"> 
                </div> 
                   
               </div>
               
        
                <p class = "divider"></p>
                <div class="info">
                  <h4 class="info-title"><?php echo lang("COMMENTS"); ?></h4>
                    <!-- start comments items -->
                   <?php foreach (getItems("Member_ID", $_SESSION['ID']) as $item){ ?>
                      <div class = "last-comment">
                        <p class="item-name"><?php echo $item['Name'];?> (<?php echo checkItem("Item_ID", "comments", $item['Item_ID'])?>)</p>

                         <?php foreach(getSpecialComments($item['Item_ID']) as $comment) { ?>
                           <div class="items-comment">
                             <h5 class="written_by"><?php echo $comment["written_by"];?></h5>   
                             <span class ="comment-data"><?php echo $comment["Comment_Data"];?></span>   
                             <p class ="comments"><?php echo $comment["Comment"];?></p>
                           </div>

                          <?php } ?> 
                  </div>
                 <?php } // end comment loop ?> 
              </div>
            </div>
         </div>
       </div>
           
       <div class="col s12 m9">
         <!--  show all items and add item from -->
 
         <h1 class="center-align user-name col s12"><?php echo $pageTitle;?></h1>
         <div id="rst"></div>
         <div class="row">
           <!-- start personal img -->     
           <div class="img left col push-m1" id = "user-foto-place">
              <?php refresh_foto($info['Foto']) ?>
            </div>  <!-- end personal img -->    
           <a id ='add-item-btn' title="<?php echo lang("ADD_NEW_ITEMS")?>" class="btn-floating btn-large waves-effect waves-light red right add-item-btn"><i class="material-icons">add</i></a>
         </div> 
         
        <form class = "foto-uplaod modal ajax-form" 
              enctype="multipart/form-data" 
              id="change-foto" 
              data-do = "change_user_foto" 
              data-place = "#user-foto-place">
          <div class="row">
            <div class="img-preview col s8 m4 push-m4 push-s2" id= "user-img-preview">
              <h5 class="center-align"><?php echo lang("FOTO_UPLOAD")?></h5>
            </div>     
          </div> 
          <div class="row" data-do = "check_foto" data-place = "#foto-erorr">
            <div class="file-field input-field col s10 push-s1">
              <div class="btn" >
                <span>File</span>
                <input type="hidden" id="user-id" value="<?php echo $_SESSION["ID"]; ?>">         
                <input data-do = "check_foto" 
                       data-place = "#foto-erorr"
                       class = "user-img ajax-check"
                       type="file"
                       onchange="$(this).attr('len',this.files.length);"
                       id = "user-img"
                       name= "foto"
                       remove ="#user-img-preview h5 "
                       preview = "#user-img-preview">
                </div>
                <div class="file-path-wrapper">
                  <input class = "file-path validate"
                         placeholder = "<?php echo lang("FOTO_UPLOAD"); ?>">
                </div>
              </div>
            </div>
            <div class="center-align" id="foto-erorr"></div>
            <div class='modal-footer'>
              <input type = "submit" 
                     class='modal-action waves-effect waves-green btn-flat' 
                     value="Agree"
                     >   
              <a class='modal-action modal-close waves-effect waves-green btn-flat'>close</a>
            </div> 
         </form>   
           
           
         <form class="form addItemForm ajax-form col s12"  
               data-do ="insert_item" 
               data-place ="#profile-items" 
               enctype="multipart/form-data">
            <h3 class="center-align addItemTitle"><?php echo lang("ADD_NEW_ITEMS") ?></h3>
            <h3 class="center-align editItemTitle" style="display:none;"><?php echo lang("ADD_NEW_ITEMS") ?></h3>
           <!--  start input "Add item Name" field -->
            <div class="row"> 
               <div class="input-field col m5 s10 push-m1 push-s1">
                 <i class="material-icons  prefix">queue</i>
                 <input type="hidden" id = "userID" value="<?php echo $_SESSION["ID"]; ?>" > 
                 <input id="item-name" 
                        pattern= ".{2,}"
                        type="text" 
                        class="validate input" >
<!--                        required-->
                        
                 <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
                 </div><!--End input "Add item Name" field  -->
              

                <!-- stsrt "price" field -->
                 <div class="input-field col m5 s10 push-m1 push-s1">
                   <i class="material-icons prefix">attach_money</i>
                   <input id ='item-price' 
                          minlenght = "2" 
                          type="text"
                          class="validate password1 input" 
                          value = "$">
<!--                          required-->
                          
                   <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
                 </div><!-- end "price" field -->
                </div>
               <!--start input "Add Description" field--> 
               <div class="row">
                 <div class="input-field area col m10 s10 push-m1 push-s1">
                   <textarea id="item-descrp"  class="materialize-textarea"></textarea>
                   <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
                 </div>
               </div>
              <!-- stsrt "made in" field -->
              <div class="row">
                <div class="input-field col m5 s10 push-m1 push-s1 ">
                  <i class="material-icons prefix">texture</i>
                  <input id ='made-in'
                         type="text"
                         class="validate password1 input">
                  <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
                </div><!-- stsrt "made in" field -->

                <div class="input-field col m5 s10 push-m1 push-s1">
                  <i class="material-icons prefix">texture</i>
                  <input id ='tags'
                         type="text"
                         class="validate password1 input">
                  <label for="icon_telephone"><?php echo lang("TAGS")?></label>
                 </div><!-- stsrt "made in" field -->
                </div>   
             
                <div class="row">
                  <div class="col m5 s10 push-m1 push-s1">
                    <!--start category selector-->
                    <label><?php echo lang("CATEGORY_NAME")?></label>
                    <select id="select-cate" class="browser-default">
                      <option value="" >...</option> 
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
                    </div>                  
                    <div class="col m5 s10 push-m1 push-s1">
                      <!--start category selector-->
                      <label><?php echo lang("STATUS")?></label>
                      <select id="select-status" class="browser-default">
                         <option value="new" selected><?php echo lang("NEW")?></option>
                         <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
                         <option value="used"><?php echo lang("USED")?></option>
                         <option value="old"><?php echo lang("OLD")?></option>
                       </select>
                     </div>    
                  </div>  
             
                  <div class="row">
                    <div class="col m6 s10 push-m1 push-s1 add-form-foto">
                      <div class="row">
                        <div class="img-preview items-fotos-preview" id="#items-fotos-preview" >
                            <h5><?php echo lang("ITEMS_FOTOS") ?></h5>
                        </div>  
                      </div>
                      <div class="file-field input-field ">
                        <div class="btn fotos_input">
                          <span>File</span>
                          <input type="hidden" id="user-id" value="<?php echo $_SESSION["ID"]; ?>">         
                          <input id = "items-fotos"
                                 type="file"
                                 name= "foto"
                                 class = "items-fotos"
                                
                                 multiple
                                 onchange="$(this).attr('len',this.files.length);"
                                 maxlength = "4"
                                 >
                          </div>
                          <div class="file-path-wrapper">
                            <input class = "file-path validate"
                                   id = 'input-fotos-path'
                                   placeholder = "<?php echo lang("FOTO_ITEM_UPLOAD"); ?>">
                          </div>
                      </div>    
                  </div>
                  <div class="main-foto col s8 m3 push-m1 push-s2">
                    <div class="img-preview " id="main-item-foto">
                      <h5 class="center-align"><?php echo lang("MAIN_FOTO")?></h5>
                    </div>
                    <div class="file-field input-field ">
                      <div class="btn" >
                        <span>File</span>
                        <input type="hidden" id="user-id" value="<?php echo $_SESSION["ID"]; ?>">         
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
                                placeholder = "<?php echo lang("FOTO_UPLOAD"); ?>">
                       </div>
                    </div>
                 </div>
              </div>  
              <div class="progress col s6 push-s3" style ="">
                <div class="determinate"></div>
              </div>
              <div class ="col s12 btn-box">
                <input type="submit" id="add-new-item-btn" class="waves-effect waves-light btn right " value ="<?php echo lang("ADD_NEW_ITEMS")?>">
               </div>
           </form><!--End form-->  


        <div id = "profile-items">  
           <!--profile_Items to print the user items in profile page-->
          <?php  profile_Items(); ?>
        </div>  
      </div><!--end items-->
    </div> <!--end the main row-->
             

 <?php } else {
     
      header("Location:logReg.php");// redirect to index.php.
 }


 include $tpl."footer.php";

 ob_end_flush();
?>