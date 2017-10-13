<?php 
ob_start();
session_start();

$pageTitle  = "Items";

if(isset($_SESSION['username'])){
    
    include "init.php";

    include $tpl. "header.php";

    include $tpl. "nav.php"; 
    
   ?>

 <!-- start items manger-->
    
   <!-- start search field-->    
   <div class="nav-wrapper" >
      <form>
        <div class="input-field">
          <input id="search-item-info" type="search" id="search" required >
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons close Large">close</i>
        </div>
      </form>
   </div><!-- end search btn-->
  <!-- start add btn-->
   <div class="container">
       <div class="row">
         <a id ='add-item-btn' class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
       </div>
     <!--in this div "required-info" requests will be saved, to send as ajax request-->
     <div>
         <!--start table items-->
       <table  class="bordered responsive-table centered">
                   <!--start Table header-->
         <thead>
           <tr>
             <th>#ID</th>
             <th><?php echo lang("ITEM NAME" )?></th>
             <th><?php echo lang("DESCRIPTION")?></th>
             <th><?php echo lang("MADE_IN")?></th>
             <th><?php echo lang("PRICE")?></th>
             <th><?php echo lang("STATUS")?></th>
             <th><?php echo lang("CATEGORY")?></th>
             <th><?php echo lang("MEMBER_NAME")?></th>
             <th><?php echo lang("ADD_DATA")?></th>
             <th><?php echo lang("CONTROL")?></th>
           </tr>
         </thead>
           
         <!--End Table header-->
         <tbody id="item-table-body">
         <!--start table body-->    
         <!--table content will be sended by ajax from dbfunctions -->
                    
         </tbody><!-- End table Body-->
        </table>
      </div>
    </div>  

   <!-- start modal add item form -->
   <div id="add-item" class="modal modal-fixed-footer">
     <div class="modal-content">      
       <h1 class="center-align form-title-add"><?php echo lang("ADD_NEW_ITEMS")?></h1>
       <h1 class="center-align form-title-updata"><?php echo lang("UPDATA_ITEM")?></h1>
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
                       echo "<option value = '".$user['userID'] ."'>".$user['username']."</option>" ;
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
                       echo "<option value = '".$cate['ID'] ."'>".$cate['Name']."</option>" ;
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
            <a class="modal-action modal-close waves-effect waves-green btn-flat send-btn" id='updata-item' value="submit"> send </a>
            <a  class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
          </div>
      </div> <!-- start modal add new item form -->
    
    
    
<?php
    include $tpl."footer.php"; 
        
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>