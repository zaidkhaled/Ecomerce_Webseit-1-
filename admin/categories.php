<?php 
ob_start();
session_start();

$pageTitle  = "Categries";

if(isset($_SESSION['username'])){
    
    include "init.php";

    include $tpl. "header.php";

    include $tpl. "nav.php"; 
    
    ?>

     <div class="nav-wrapper" >
          <form>
            <div class="input-field">
              <input id="search-cate-info" type="search" id="search" required >
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons close Large">close</i>
            </div>
          </form>
        </div>
    <div class="container">
       <h1 class = 'center-align'><?php echo lang("MANGE CATEGORIES")?></h1>
         <div class="row">
           <a id ='add-cate-btn' class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
         </div>         
          <div  class="row">
            <ul class="collection with-header" id="mange-cate">
               
               <!-- the content will be sended by ajax-->
               
            </ul>
          </div>
        </div>
       <!--Categories/start Add Categories Form-->
        <div id="add-cate" class="modal modal-fixed-footer">
          <div class="modal-content">      
            <h1 class="center-align"><?php echo lang('ADD_NEW_CATEGORIES')?></h1>
            <form class="form AddFormCate" action="?do=insert" method="POST">
          <!--start input "Add Category Name" field-->       
              <div class="row"> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                 <i class="material-icons  prefix">queue</i>
                  <input id="cate-name"
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         name="CateName"
                         data-value ="1">
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
                         data-value ="0">
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
                         data-value ="0">
                  <label for="icon_telephone"><?php echo lang("ORDERING")?></label>
                </div>
              </div>
                
                <!--End input "ordring" field-->
                
               <!--start radio buttons for visiblity and allow comment and advertising field--> 

                <div class="row">  
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
              <a class="modal-action modal-close waves-effect waves-green btn-flat" data-do="insert" id='info-cate-send' value="submit"> send </a>
              <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
      </div> <!--End modal-->

   
      <!--start categories updata form -->

        <div id="updata-cate" class="modal modal-fixed-footer" class = 'modal'>
          <div class="modal-content">      
            <h1 class="center-align"><?php echo lang("EIDT_CATEGORIES")?></h1>
            <form class="form AddFormCate" action="?do=insert" method="POST">
          <!--start input "Add Category Name" field-->   
            <input type="hidden" id="cate-id">    
              <div class="row"> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                 <i class="material-icons  prefix">queue</i>
                  <input id="new-cate-name"
                         cate-id = ""
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         data-required ="required">
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
                  <input id="new-cate-descrp" 
                         limit ="6"
                         type="text"
                         limit = "8"
                         class="validate input" 
                         data-required ="free">
                  <label for="icon_prefix"><?php echo lang('DESCRIPTION')?></label>
                </div>
                   <!--End input "Description" field--> 
               </div>
                
            <!--start input "Ordering" field--> 
              <div class="row order">
                <div class="input-field col s8 m4 push-m4 push-s2">
                  <i class="material-icons prefix">event_note</i>
                  <input  id = 'new-cate-order'
                         type="text"
                          class="validate password1 input" 
                          limit ="4"
                         data-required ="free">
                  <label for="icon_telephone"><?php echo lang("ORDERING")?></label>
                </div>
              </div>
                
                <!--End input "ordring" field-->
 
              </form><!--End form-->
            </div><!--end modal contant-->

      <!--         Members/End Add Form-->

           <div class="modal-footer">
              <a class="modal-action modal-close waves-effect waves-green btn-flat" id='updata-cate-info' > send </a>
              <a class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
           </div>
      </div> <!--End modal-->

     <!--end categories updata form -->

     
   <?php
            
    
    include $tpl."footer.php"; 
        
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>