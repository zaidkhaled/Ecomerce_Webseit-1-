<?php
ob_start();
session_start();

$pageTitle = str_replace("-", " ", $_GET['tag']); 

include "init.php";
include $tpl."header.php";
include $tpl."nav.php"; ?>
<div class="margin"></div>
<div class ="container">
  <div class="row">
    <h1 class="center-align"><?php echo $pageTitle; ?></h1>
      <?php 
       $tags = globalGet("*", "items", "WHERE tags like '%$pageTitle%'", "AND approve = 1", "item_ID");
       foreach($tags as $item){ ?>
         <!-- start card item  -->
         <div class="col s6 m3">
           <div class="card"> 
             <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" style="height:198px" src="uplaodedFiles/itemsFotos/<?php echo $item['Main_Foto'] ?>">
             </div>
             <div style="height:95px"  class="card-content">   
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
     <?php }  ?>
  </div>
</div>
<?php 

include $tpl."footer.php"; 
ob_end_flush();
?>