<?php 
/*
=========================
   Mange comments Page
     Delete | Edit
=========================    
*/
ob_start();
session_start();
  
    
if(isset($_SESSION['username'])){
        
     //  start mange Page 
    
     include "init.php";
    
     $pageTitle = "Comments";
    
     include $tpl. "header.php";
    
     include $tpl. "nav.php"; 
    
     include  "forms.php"; 
    
    //  get "data_required" like (id members or id categoriese) from URL if exist, then sent it by ajax to process data and return #required-info /////////////////////
    
    if (isset($_GET['required']) && isset($_GET['ID'])){
        
    $required = $_GET['required'] ; //category or members
    
    $ID = isset($_GET['ID'])? $_GET['ID'] : " "; // id from category or member
    
    $data_required = "$required"."_ID=$ID";
        
    } else {
        
       $data_required = ""; 
        
    }
     ?>

<div class="required-info" style="display:none">
  <span id ='data_required'><?php echo $data_required; ?></span>
</div>
<!--start serch field-->
<div id="rst"></div>
   <div class="nav-wrapper" >
      <form>
        <div class="input-field">
          <input id="search-in-comments" type="search" class = 'search-in' data-search = '#comments-table-body .table-row'>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons close Large">close</i>
        </div>
      </form>
   </div><!-- end search btn-->
       
      <h1 class="center-align">Comments manger</h1>
   <!--end serch field-->
      <div class="container">
          <!--in this div "required-info" requests will be saved, to send as ajax request-->
             <!--start table users-->
           
               <table  class="bordered responsive-table centered " >
                   <!--start Table header-->
                <thead>
                  <tr>
                      <th>#ID</th>
                      <th id="in"><?php echo lang("USER_NAME" )?></th>
                      <th><?php echo lang("COMMENTS")?></th>
                      <th><?php echo lang("ITEM_NAME")?></th>
                      <th><?php echo lang("WRITTEN_IN")?></th>
                      <th><?php echo lang("CONTROL")?></th>
                  </tr>
                </thead>
                   
                  <!--End Table header-->
                   
                <tbody id="comments-table-body">
                    
                <!--start table body-->    
            
             <!--   table content will be sended by ajax from dbfunctions -->
                    
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
