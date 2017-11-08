<?php
ob_start();
session_start();

$pageTitle = str_replace("-", " ", $_GET['tag']); 

include "init.php";
include $tpl."header.php";
include $tpl."nav.php"; ?>
<div class ="container">
  <div class="row">
    <h1 class="center-align"><?php echo $pageTitle; ?></h1>
      <?php 
       $tags = globalGet("*", "items", "WHERE tags like '%$pageTitle%'", "AND approve = 1", "item_ID");
       foreach($tags as $item){ ?>
         <!-- start card item  -->
         <div class="col s12 m4">
           <div class="card"> 
             <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="layout/images/Lv.jpg">
             </div>
             <div class="card-content">
               <div class="row profile-item-icons">   
                 <!--Delete Butten-->
                 <a class='modal-trigger' 
                    href="#modal<?php echo $item['Item_ID'];?>"
                    onclick= "$('.modal').modal();"
                    >
                   <i class='material-icons right'>delete_forever</i>
                 </a><!--Delete Butten-->   
                 <a href ="item.php?name=<?php echo $item['Name']; ?>&ID=<?php echo $item['Item_ID']; ?>&do=edit-item"> 
                   <i class="material-icons right">edit</i> 
                </a>     
               </div>     
               <span class="card-title activator"><?php echo $item['Name'];?></span>
               <span class="right"><?php echo $item['Price'];?></span>        
               <p><a href="item.php?name=<?php echo str_replace(" ", "-",$item['Name']); ?>&ID=<?php echo $item['Item_ID'];?>">
                   <?php echo lang('VIST');?>
                   </a>
                 </p>                 
             </div>
             <div class="card-reveal">
               <span class="card-title"><?php echo $item['Name'];?><i class="material-icons right">close</i></span>
               <p><?php echo $item['Description'];?>.</p>

               <?php $tags = explode("," , $item['tags']);     
                     foreach($tags as $tag){
                         echo "<a href='tags.php?tag=" . str_replace(" ", "-", $tag) . "'> ". $tag . "</a> |";
                     } ?> 
             </div>
          </div><!-- start card item  -->                             
        </div>
         <!-- start modal delete butten-->
         <div id="modal<?php echo $item['Item_ID']; ?>" class='modal' >
           <div class='modal-content center-align'>
             <h4><?php echo lang("SURE_MSG")?> </h4>
             <p><?php echo lang("DELETE_ITEM_MSG")?> <?php echo $item['Name']?></p> 
           </div>
           <div class='modal-footer'>
             <a class='modal-action modal-close waves-effect waves-green btn-flat'>Close</a>   

             <a class='modal-action delete modal-close waves-effect waves-green btn-flat ajax-click'
                data-do= "delete_item"
                data-place = "#profile-items" 
                data-id='<?php echo $item['Item_ID']; ?>' id="delete-item" >Delete</a>
          </div><!--end modal Delete Butten--> 
        </div>   
           
        
     <?php }  ?>
  </div>
</div>
<?php 

include $tpl."footer.php"; 
ob_end_flush();
?>
