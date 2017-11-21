<?php 
ob_start();
session_start();

$pageTitle  = "Items";

if(isset($_SESSION['username'])){
    
    include "init.php";

    include $tpl. "header.php";

    include $tpl. "nav.php"; 
    
    include  "forms.php";
    
  

//  get "data_required" like (id members or id categoriese) from URL if exist, then sent it by ajax to process data and return #required-info /////////////////////
    
    if (isset($_GET['required']) && isset($_GET['ID'])){
        
    $required = $_GET['required'] ;//category or members
    
    $ID = isset($_GET['ID'])? $_GET['ID'] : " "; // id from category or member
    
    $data_required = "$required"."_ID=$ID";
        
    } else {
        
       $data_required = ""; 
        
    }
     ?>

   <div class="required-info" style="display:none">
     <span id ='data_required'><?php echo $data_required; ?></span>
   </div>
 <!-- start items manger-->
    
   <!-- start search field-->    
   <div class="nav-wrapper" >
      <form>
        <div class="input-field">
          <input id="search-item-info" type="search" class = 'search-in' data-search = '#item-table-body .table-row' required >
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons close Large">close</i>
        </div>
      </form>
   </div><!-- end search btn-->
<div id="rst">
</div>
    <h1 class="center-align">Items Manger</h1>
    <div class="container">
       <!-- start add btn-->    
       <div class="row">
         <a id ='add-item-btn' onclick="reset($('#imgs'));" class="btn-floating btn-large waves-effect waves-light red right modal-trigger" href="#update-add-item"><i class="material-icons">add</i></a>
       </div>
     <!--in this div "required-info" requests will be saved, to send as ajax request-->
     <div class= 'container-grid'>
         <!--start table items-->
       <table  class="bordered responsive-table centered ">
                   <!--start Table header-->
         <thead>
           <tr>
             <th>#ID</th>
             <th><?php echo lang("ITEM NAME" )?></th>
             <th><?php echo lang("FOTOS")?></th>
             <th><?php echo lang("COMT")?></th>
             <th><?php echo lang("DESCRIPTION")?></th>
             <th><?php echo lang("MADE_IN")?></th>
             <th><?php echo lang("PRICE")?></th>
             <th><?php echo lang("STATUS")?></th>
             <th><?php echo lang("CATEGORY")?></th>
             <th><?php echo lang("MEMBER_NAME")?></th>
             <th><?php echo lang("ADD_DATA")?></th>
             <th><?php echo lang("TAG_SHOW")?></th>
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

   <div class="comment-item container">
     <div class="row">
       <div class= 'container-grid'>  
          <ul class=" col s12 collection with-header" id="comments-item">
            <li class="collection-header"><h4><?php echo lang("ITEM_COMMENT_MENGER")?></h4></li>
            <li class="collection-item chose-item"><?php echo lang("CHOSE_ITEM")?></li>
             <!-- the list items will be sended by ajax -->
          </ul>
       </div>   
     </div>
   </div>
    
<?php
    include $tpl."footer.php"; 
        
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>