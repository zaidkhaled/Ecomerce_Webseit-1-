<?php

ob_start();

session_start();

$pageTitle = str_replace("-", " ", $_GET['name']); 

$item_ID = $_GET['ID'];

include "init.php";
include $tpl."header.php";
include $tpl."nav.php";

?>
<div class="container margin"> 
  <h1 class="center-align"><?php echo $pageTitle; ?></h1>
   <div id= "rst"></div>
   <div class="row item">  
                           
  <?php
        
        $userID = isset($_SESSION['ID']) ? $_SESSION['ID'] : "0";   
       
        // check_info is variable to check out, if current user is user who post this item
       
        $check_info = getSpecialInfo("items", "Item_ID", "Member_ID", $item_ID, $userID);
       
        // $row is variable to fetch item info 
       
        $row = getSpecialInfoOnce("items", "Item_ID", "", $item_ID);
       
        // check if userID und itemID in same row in database in "items table", if yes give user the ability to edit his    own item
        
        if (!empty($check_info)){

            $edit_passible = "<a class='ajax-click secondary-content update-btn deep-orange-text text-darken-4' id= 'edit-item-icon' data-id='$item_ID' data-do = 'edit_item_form' data-place ='#item-details' ><i class='material-icons'>mode_edit</i></a>";

        }
      
       ?>
      
      <div class="details col s12 "  ><!--fetch item info-->
       
            <!-- Modal Trigger -->
            <?php
            // if this user is not the owner let him buy this item
            if (empty($check_info) && isset($_SESSION['ID']) ){
                echo "
                 <div id = 'buy-rst'> </div>  
                   <div class='row'>
                   <div class = 'col m4 s8 push-m4 push-s2'>
                     <a class='waves-effect waves-light btn modal-trigger buy-btn' href='#buy-form-modal' >" . lang("BUY") .
                       "<i class='material-icons buy-icon'>add_shopping_cart</i>
                     </a>  
                  
                   <!--Modal Structure-->
                   <div id='buy-form-modal' class='modal modal-fixed-footer'>
                     <form class = 'ajax-form buy-form' data-do = 'buy_item'   data-place = '#buy-rst' data-id ='" . $item_ID . "'>
                       <div class='modal-content center-align'>
                         <h4>" . lang("BUY") . " : " . $pageTitle . "</h4>
                         <h4>$" . $row["Price"] . "</h4>
                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu   fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum</p>
                         <div class='row'> 
                           <div class='input-field col m6 s10 push-m3 push-s1'>
                             <input type = 'hidden' id ='item-price' value = '" . $row["Price"] . "'> 
                             <input type = 'hidden' id ='owner-id' value = '" . $row["Member_ID"] . "'> 
                             <input type='number' 
                                    class = 'col s6 push-s3' 
                                    id = 'nums-item'
                                    value = '1' 
                                    min='1' 
                                    max=" .  ifEmpty($row["nums_item"], '1') .  "
                                    required>
                             <label for='icon_prefix'>" . lang("HOW_MANY_ITEM") . " </label>
                        </div>   
                      </div>   
                    </div>
                     
                    <div class='modal-footer'>
                      <input type= 'submit' class='modal-action  waves-effect waves-green btn-flat' value = ' " . lang("AGREE") . "'>
                      <a class='modal-action modal-close waves-effect waves-green btn-flat'> " .lang("CLOSE") . "</a>
                    </div>
                  </form>  
                 </div>
               </div> 
              </div>   
               ";
            }  
            ?>  


  
           
        <div class="row">
           <div class = "col m4 s8 push-m4 push-s2 item-main-img-show">
             <img class="responsiv-img materialboxed main-foto" data-caption ="<?php echo ifEmpty($row["Description"], '') ?>"  src="uplaodedFiles/itemsFotos/<?php echo ifEmpty($row["Main_Foto"], "foto1.jpg") ?>">
           </div> 
        </div> 
        <div class="row"> 
          <div class = "col s12 m8 push-m2 items_imgs">
             <?php 
              if(empty($row["Fotos"])){
                 echo " ";
              } else {
                  $items_imgs = unserialize($row["Fotos"]);
                  // for medium screen and up 
                  foreach ($items_imgs as $src){
                       echo   "
                        <img class='responsiv-img materialboxed hide-on-small-and-down' data-caption ='" . ifEmpty($row['Description'], ' ') . "' style='height:140px;width:120px' src='uplaodedFiles/itemsFotos/" . $src . "'>
                      " ; 
                        }
                      ?>
                      <!-- for small screen -->
                      <div class='carousel hide-on-med-and-up'>
                      <?php      
                       foreach ($items_imgs as $src){
                       echo   "
                          <a class='carousel-item' ><img  data-caption ='" . ifEmpty($row['Description'], ' ') . "'   src='uplaodedFiles/itemsFotos/" . $src . "'></a>
                            " ; 
                       }
                    ?>      
                        </div>
                 <?php }
              
             ?>
           </div>
         </div> 
         <div class="row ">
             <?php if (isset($edit_passible)){echo $edit_passible; }; ?>
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
                     <a id = "plus-comment-btn" href = "#comment-form" title="<?php echo lang("ADD_NEW_COMMENT")?>" class="btn-floating btn-large waves- effect waves-light  right modal-trigger "><i class="material-icons">comment</i></a>
                   </div>
                   <div class="add-comment modal" id="comment-form" style="display:none">
                      <form class="ajax-form" data-addComment = "add_comment" data-updateComment = "update_comment" data-do = "" data-place = "#comment-call" id="add-comment-form" > 
                        <h4 class="center-align" id="add-comment-title"><?php echo lang("ADD_COMMENT"); ?></h4>     
                        <h4 class="center-align" id="update-comment-title"><?php echo lang("UPDATE_COMMENT"); ?></h4>     
                        <input type="hidden" id="item-id" value="<?php echo $item_ID; ?>"> 
                        <input type="hidden" id="comment-id" value=""> 
                        <input type="hidden" id = "owner-id" value="<?php echo $row['Member_ID'];?>"> 
                        <div class="input-field area">
                          <textarea id="item-comment"  class="materialize-textarea"></textarea>   
                          <label for="icon_prefix"><?php echo lang("WRITE_COMMENT")?></label>
                        </div>
                        <input type="submit"
                               disabled
                               id="add-comment-btn" 
                               class="waves-effect waves-light btn right"
                               value = <?php echo lang("SENT_IT")?>> 

                      </form>       
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
?>            