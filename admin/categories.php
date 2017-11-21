<?php 


ob_start();
session_start();

$pageTitle  = "Categries";

if(isset($_SESSION['username'])){
    
    include "init.php";

    include $tpl. "header.php";

    include $tpl. "nav.php"; 
    
    include  "forms.php";
    
    ?>

     <!-- start search field-->

     <div class="nav-wrapper" >
          <form>
            <div class="input-field">
              <input id="search-cate-info" type="search" class = "search-in" data-search = '#mange-cate li' required >
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons close Large">close</i>
            </div>
          </form>
        </div><!-- end search btn-->
<div id="rst"></div>
     <!-- start add btn-->
     <div class="container">
       <h1 class = 'center-align'><?php echo lang("MANGE CATEGORIES")?></h1>
         <div class="row">
           <a id ='add-cate-btn' class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
         </div>  <!-- end add btn-->
        <!-- start categories list-->
        <div  class="row">
            <ul class="collection with-header" id="mange-cate">
               
               <!-- the content will be sended by ajax-->
               
            </ul>
          </div>
        </div><!-- end categories list-->
     
   <?php
            
    
    include $tpl."footer.php"; 
        
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>