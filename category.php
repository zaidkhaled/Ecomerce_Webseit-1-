<?php
ob_start();
session_start();

$pageTitle = str_replace("-", " ", $_GET['name']); 

include "init.php";

 include $tpl."header.php";
 include $tpl."nav.php";

// get item category ID

$Cate_ID    = $_GET['ID'];

if(checkItem("ID", "categories", $Cate_ID) > 0){ // at first chick if this category already exist 

        echo "<h1 class = 'center-align'>". $pageTitle . "</h1><br>";?>
        <div class="container">
          <div class="row">

        <!--  show the all category items -->

        <?php foreach (getItems("Cate_ID" , $Cate_ID) as $item){ ?> 
             <!-- start card item  -->
             <div class="col s12 m4">
               <div class="card"> 
                <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="layout/images/Lv.jpg">
                </div>
                <div class="card-content">
                  <span class="card-title activator"><?php echo $item['Name'];?>
                      <i class="material-icons right">more_vert</i>
                  </span>
                  <span class="right"><?php echo $item['Price'];?></span>        
                  <p><a href="#"><?php echo lang('VIST');?></a></p>   
                </div>
                <div class="card-reveal">
                  <span class="card-title"><?php echo $item['Name'];?><i class="material-icons right">close</i></span>
                  <p><?php echo $item['Description'];?>.</p>
                </div>
              </div><!-- start card item  -->
            </div>

        <?php } ?>
          </div><!--end card-->
        </div><!--end container-->

<?php }  else {// end check item condition 
    
    echo "SOMETHING RONG";
}
include $tpl."footer.php"; 
ob_end_flush();
?>
