<?php

ob_start();

session_start();

$pageTitle = str_replace("-", " ", $_GET['name']); 

$item_ID = $_GET['ID'];

include "init.php";
include $tpl."header.php";
include $tpl."nav.php";

?>
<div class="container"> 
  <h1 class="center-align"><?php echo $pageTitle; ?></h1>
   <div id= "rst"></div>
   <div class="row item">  
                           
  <?php
        
        $userID = isset($_SESSION['ID']) ? $_SESSION['ID'] : "0";   
       
        // check_info is variable to check out, if current user is user who post this item
       
        $check_info = getSpecialInfo("items", "Item_ID", "Member_ID", $item_ID, $userID);
       
        // $row is variable to fetch item info 
       
        $row = getSpecialInfo("items", "Item_ID", "", $item_ID);
       
        // check if userID und itemID in same row in database in "items table", if yes give user the ability to edit his    own item
        
        if (!empty($check_info)){

            $edit_passible = "<a class='ajax-click secondary-content update-btn deep-orange-text text-darken-4' id= 'edit-item-icon' data-id='$item_ID' data-do = 'edit_item_form' data-place ='#item-details' ><i class='material-icons'>mode_edit</i></a>";

        }else {

            $edit_passible = "";
        }
      
       ?>
      
      <div class="details col s12 margin"  ><!--fetch item info-->
        <div id = "buy-rst"> </div>  
        <div class="row">
          <div class = "col m4 s8 push-m4 push-s2">
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn modal-trigger buy-btn" href="#buy-form-modal" ><?php echo lang("BUY"); ?>
              <i class="material-icons buy-icon">add_shopping_cart</i>
            </a>

             <!-- Modal Structure -->
             <div id="buy-form-modal" class="modal">
               <form class = "ajax-form buy-form" data-do = "buy_item"   data-place = "#buy-rst" data-id ="<?php echo $item_ID; ?>">
                 <div class="modal-content center-align">
                   <h4><?php echo lang("BUY") . " : " . $pageTitle; ?></h4>
                   <h4 ><?php echo $row["Price"]; ?></h4>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu   fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum</p>
                   <div class="row"> 
                     <div class="input-field col m6 s10 push-m3 push-s1">
                       <input type="number" 
                              class = "col s6 push-s3" 
                              value = "1" 
                              min="1" 
                              max="<?php echo ifEmpty($row["nums_item"], '1'); ?>"
                             required>
                       <label for="icon_prefix"><?php echo lang("HOW_MANY")?></label>
                     </div>   
                   </div>   
                 </div>

                 <div class="modal-footer">
                   <input type= "submit" class="modal-action  waves-effect waves-green btn-flat"  value = "<?php echo lang("AGREE"); ?>">
                   <a class="modal-action modal-close waves-effect waves-green btn-flat"><?php echo lang("CLOSE"); ?></a>
                 </div>
               </form>  
             </div>
           </div>    
        </div>   
        <div class="row">
           <div class = "col m4 s8 push-m4 push-s2 item-main-img-show">
             <img class="responsiv-img materialboxed main-foto" data-caption ="<?php echo ifEmpty($row["Description"], '') ?>"  src="uplaodedFiles/itemsFotos/<?php echo ifEmpty($row["Main_Foto"], "foto1.jpg") ?>">
           </div> 
        </div> 
        <div class="row"> 
          <div class = "col s8 push-s2 items_imgs">
             <?php 
              if(empty($row["Fotos"])){
                 echo " ";
              } else {
                  $items_imgs = unserialize($row["Fotos"]);
                  foreach ($items_imgs as $src){
                       echo   "
                       <img class='responsiv-img materialboxed' data-caption ='" . ifEmpty($row['Description'], ' ') . "' style='height:140px;width:120px' data-caption = 'hihihi' src='uplaodedFiles/itemsFotos/" . $src . "'>
                       " ;
                      
                  }
              }
             ?>
           </div>
         </div> 
         <div class="row">
             <?php echo $edit_passible; ?>
         </div>  
          <!-- fetch item data-->
          <div id="item-details" >
          <?php
          showItemInfo($item_ID); 
           ?>
          </div>  
       </div>   
    </div>
    <div class = "comments col 12">
      <?php  if (isset($_SESSION['user'])){ ?>
              <div class="add-comment-icon row">
                <a id ='plus-comment-btn' data-target = ".add-comment" title="<?php echo lang("ADD_NEW_COMMENT")?>" class="btn-floating btn-large waves-effect waves-light  right "><i class="material-icons">add</i></a>
              </div>
           <div class="add-comment" style="display:none">
               <div class="input-field area">
                 <form class="ajax-form" data-do = "add_comment" data-place = "#comment-call" > 
                   <input type="hidden" id="item-id" value="<?php echo $item_ID; ?>">   
                   <textarea id="item-comment"  class="materialize-textarea"></textarea>
                   <label for="icon_prefix"><?php echo lang("WRITE_COMMENT")?></label>
                   <input type="submit"
                           disabled 
                           id="add-comment-btn" 
                           class="waves-effect waves-light btn"
                           value = <?php echo lang("SENT_IT")?>>
                 </form>       
               </div>
           </div>
        <?php } ?>
  
        <div id="comment-call">
          <!-- get item comment.-->    
          <?php showComment($item_ID)  ?> 
      </div>
    </div><!--end comment-->
  </div><!-- end container-->
<?php

include $tpl."footer.php";
ob_end_flush();