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
  <div class="row item">  
                           
  <?php
        
        $userID = isset($_SESSION['ID']) ? $_SESSION['ID'] : "0";   
      
        $check_info = getSpecialInfo("items", "Item_ID", "Member_ID", $item_ID, $userID);
      
        // check if userID und itemID in same row in database in "items table", if yes give user the ability to edit his    own item
        
        if (!empty($check_info)){

            $edit_passible = "<a class='ajax-click secondary-content update-btn deep-orange-text text-darken-4' id= 'edit-item-icon' data-id='$item_ID' data-do = 'edit_item_form' data-place ='#item-details' ><i class='material-icons'>mode_edit</i></a>";

        }else {

            $edit_passible = "";
        }
      
       ?>
      <div class="details col m6 s12 "><!--fetch item info-->
          
         <div class="row">
             <?php echo $edit_passible; ?>
         </div> 
          
          <!-- fetch item data-->
          
          <div id="item-details">
              <?php showItemInfo($item_ID); ?>
          </div>      
       </div>
      <div class = "foto col s12 m6 ">
          <img class="" src="layout/images/Lv.jpg">
      </div> <!--end fetch item info-->   
    </div>
    <div class = "comments col 12">
      <?php  if (isset($_SESSION['user'])){ ?>
              <div class="add-comment-icon row">
                <a id ='plus-comment-btn' data-target = ".add-comment" title="<?php echo lang("ADD_NEW_COMMENT")?>" class="btn-floating btn-large waves-effect waves-light  right "><i class="material-icons">add</i></a>
              </div>
           <div class="add-comment" style="display:none">
               <div class="input-field area">
                 <input type="hidden" id="item-id" value="<?php echo $item_ID; ?>">   
                 <textarea id="item-comment"  class="materialize-textarea"></textarea>
                 <label for="icon_prefix"><?php echo lang("WRITE_COMMENT")?></label>
                 <button type="button"
                         disabled 
                         id="add-comment-btn" 
                         class="waves-effect waves-light btn ajax-click"
                         data-do = "add_comment"
                         data-place = "#comment-call"><?php echo lang("SENT_IT")?>
                 </button>
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