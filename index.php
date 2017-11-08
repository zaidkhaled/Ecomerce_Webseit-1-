 <?php 
 ob_start();
 session_start();

 $pageTitle = "shop-online";

 include "init.php"; 

 include $tpl."header.php";
 include $tpl."nav.php";
?>

<div class="container">
    <?php if  (isset($_SESSION["user"])) { ?>
    
              <div class="row plus-btn"> 
                <a id ='add-item-btn' title="<?php echo lang("ADD_NEW_ITEMS")?>" class="btn-floating btn-large waves-effect waves-light red right add-item-btn"><i class="material-icons">add</i></a>
              </div> 
    
    <?php } ?>
    
  <!--staet add item form-->
  <form class="form addItemForm row">
    <h3 class="center-align addItemTitle"><?php echo lang("ADD_NEW_ITEMS") ?></h3>
    <h3 class="center-align editItemTitle" style="display:none;"><?php echo lang("ADD_NEW_ITEMS") ?></h3>
  <!--  start input "Add item Name" field -->
    <div class="col m6 s12 ">    
      <div class="input-field">
         <i class="material-icons  prefix">queue</i>
         <input type="hidden" id = "userID" value="<?php echo $_SESSION["ID"]; ?>" > 
         <input id="item-name" 
                pattern= ".{2,}"
                type="text" 
                class="validate input" 
                required>
         <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
         </div><!--End input "Add item Name" field  -->

        <!--start input "Add Description" field--> 
         <div class="input-field area">
             <textarea id="item-descrp"  class="materialize-textarea"></textarea>
             <label for="icon_prefix"><?php echo lang("ITEMS_DESCRP")?></label>
         </div>

        <!-- stsrt "price" field -->
        <div class="input-field">
          <i class="material-icons prefix">attach_money</i>
          <input id ='item-price' 
                 minlenght = "2" 
                 type="text"
                 class="validate password1 input" 
                 value = "$"
                 required>
          <label for="icon_telephone"><?php echo lang("ITEMS_PRICE")?></label>
        </div><!-- end "price" field -->
      <!-- stsrt "made in" field -->
        <div class="input-field">
          <i class="material-icons prefix">texture</i>
          <input id ='made-in'
                 type="text"
                 class="validate password1 input">
          <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
        </div><!-- stsrt "made in" field -->
        <div class="input-field col s12 ">
          <i class="material-icons prefix">texture</i>
          <input id ='tags'
                 type="text"
                 class="validate password1 input">
          <label for="icon_telephone"><?php echo lang("TAGS")?></label>
        </div><!-- stsrt "made in" field -->
      <!--start category selector-->
       <label><?php echo lang("CATEGORY_NAME")?></label>
       <select id="select-cate" class="browser-default ">
       <option value="" >...</option> 
       <?php  
       $cates = getAll("*", "categories"); // fetch all categories from database and print them in this selector 
       foreach($cates as $cate){
       echo "<option value ='" . $cate['ID'] . "'>" . $cate['Name'] . "</option>" ;
       }
       ?>
       </select>

       <!--start status selector "new, old"-->
       <label><?php echo lang("STATUS")?></label>
         <select id="select-status" class="browser-default"> 
           <option value="new" selected><?php echo lang("NEW")?></option>
           <option value="like-new"><?php echo lang("LIKE_NEW")?></option>
           <option value="used"><?php echo lang("USED")?></option>
           <option value="old"><?php echo lang("OLD")?></option>
      </select><!--end status selector "new, old"-->
    </div>
    <div class="col m6 s12 add-form-foto">
      <img src="layout/images/Lv.jpg">
    </div>

    <div class ="col s12">
        <button type="button" id="add-new-item-btn" data-do ="insert_item"   data-place ="#profile-items" class="waves-effect waves-light btn right ajax-click" ><?php echo lang("ADD_NEW_ITEMS")?></button>
    </div> 

 </form><!--End form--> 
    
  <div class="row">
      
    <?php home_items(); ?>
        
  </div>
</div>

<?php

include $tpl."footer.php";
 ob_end_flush();
?>