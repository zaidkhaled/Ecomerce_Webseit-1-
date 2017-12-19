 <?php 
 @session_start();
 ob_start();
 $pageTitle = "shop-online";

 include "init.php"; 

 include $tpl."header.php";
 include $tpl."nav.php";
?>

<div class="container margin">
  <h1 class="center-align">Shop Online</h1>
<?php 
//if (isset($_SESSION["user"])){ ?>

  <div class="row plus-btn"> 
    <a id ='add-item-btn' title="<?php echo lang("ADD_NEW_ITEMS")?>" class="btn-floating btn-large waves-effect waves-light red right add-item-btn"><i class="material-icons">add</i></a>
  </div> 


  <!--staet add item form-->

    
     <form class="form addItemForm  ajax-form col s12"  
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
                    pattern= ".{2,12}"
                    type="text" 
                    class="validate input" 
                    required>

             <label for="icon_prefix"><?php echo lang("ITEM_NAME")?></label>
             </div><!--End input "Add item Name" field  -->


            <!-- stsrt "price" field -->
             <div class="input-field col m5 s10 push-m1 push-s1">
               <i class="material-icons prefix">attach_money</i>
               <input id ='item-price' 
                      minlenght = "1" 
                      type="text"
                      class="validate password1 input" 
                      value = "$"
                      required>

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
                    <div class="input-field col m3 s10 push-m1 push-s1 ">
                      <i class="material-icons prefix">texture</i>
                      <input id ='made-in'
                             type="text"
                             class="validate password1 input">
                      <label for="icon_telephone"><?php echo lang("ITEMS_MIND_IN")?></label>
                    </div><!-- stsrt "made in" field -->

                    <div class="input-field col m3 s10 push-m1 push-s1">
                      <i class="material-icons prefix">texture</i>
                      <input id ='tags'
                             type="text"
                             class="validate password1 input">
                      <label for="icon_telephone"><?php echo lang("TAGS")?></label>
                     </div><!-- stsrt "made in" field -->
                     <div class=" input-field col m3 s10 push-m2 push-s1">    
                       <input type="number"
                              value = "1" 
                              min= "1" 
                              max= "100000"
                              id = "num-item"
                              required>
                        <label for="icon_prefix"><?php echo lang("HOW_MANY")?></label>
                      </div> 
                    </div>    

            <div class="row">
              <div class="col m5 s10 push-m1 push-s1">
                <!--start category selector-->
                <label><?php echo lang("CATEGORY_NAME")?></label>
                <select id="select-cate" class="browser-default select">
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
                  <select id="select-status" class="browser-default select">
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
                            placeholder = "<?php echo lang("MAIN_FOTO"); ?>">
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
            
    
  <div class="row" id = "index-items">
      
    <?php home_items(); ?>
        
  </div>
</div>

<?php

include $tpl."footer.php";
 ob_end_flush();
?>