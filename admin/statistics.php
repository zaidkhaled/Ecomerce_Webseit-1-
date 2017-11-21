<?php 
ob_start();
session_start();
  
    
if(isset($_SESSION['username'])){
        
     //  start mange Page 
    
     include "init.php";
    
     $pageTitle = lang("SALES_STATISTICS");
    
     include $tpl. "header.php";
    
     include $tpl. "nav.php"; 
    
     include  "forms.php"; 
    
    //get "data_required" like (pending members or category > item) from URL if exist, then sent it by ajax to process data and return #required-info ///////////////////////////
    
    $data_required = isset($_GET['page'])? $_GET['page'] : " "; 
     ?>
      <!--start serch field-->
      <div class="nav-wrapper" >
        <div class="input-field">
          <input id="search-statistics" type="search" class = "search-in" data-search = "#statistics-table-body .table-row" required >
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons close Large">close</i>
        </div>
      </div> <!--end serch field-->
      <h1 class="center-align"><?php echo lang("SALES_STATISTICS"); ?></h1>
      <div id="rst"></div>
      <div class="container">
        <!--in this div "required-info" requests will be saved, to send as ajax request-->
        <div class="required-info" style="display:none">
          <span id ='data_required'><?php echo $data_required; ?></span>
        </div>
        <div class= "">
          <!--start table users-->
          <table  class="bordered responsive-table centered " >
          <!--start Table header-->
          <thead>
            <tr>
              <th>#ID</th>
              <th><?php echo lang("BUYER")?></th>
              <th><?php echo lang("SELLER")?></th>
              <th><?php echo lang("ITEMS_NAME")?></th>
              <th><?php echo lang("ITEMS_PRICE")?></th>
              <th><?php echo lang( "TIME_OF_PURCHASE")?></th>
            </tr>
          </thead> <!--End Table header-->
        <tbody id="statistics-table-body">
        <!--start table body-->    
        <!--table content will be sended by ajax from dbfunctions -->
        </tbody><!-- End table Body-->
      </table>
    </div>
</div>  

     <!--End table users-->

           
      <!--         Members/End Add Form-->
      
      <?php 
                 
       include $tpl."footer.php"; 
        
        
   } else { //if sission doesn't started then

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>