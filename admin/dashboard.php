<?php 

ob_start();

 session_start();

$pageTitle = "Dashbord";

 if(isset($_SESSION['username'])){
        
       include "init.php"; 
        
       include $tpl. "header.php";     

       include $tpl."nav.php"; 
       
       include  "forms.php";
    
     //start Dashbord page
     
     ?>
    
     <div class="container home-stats center-align">
        <div class = "row"> 
            <h1 ><?php echo lang("DASHBOARD")?></h1>
        </div>
        <div class="row">
            <div class="col s6  m3 box">
                <div class="stat">
                    <p><?php echo lang("TOTAL_MEMBERS"); ?></p>
                    <span><a href="members.php"><?php echo countItems("userID","users")?></a></span><!--count users-->
                </div>
            </div>
            
            <div class="col s6  m3 box">
                <div class="stat">
                    <p><?php echo lang( "PENDING_MEMBERS"); ?></p>
                    <!--count unactivate users-->
                    <span><a href="members.php?page=pending"><?php echo checkItem("regStatus", "users", 0)?></a></span>
                </div>
            </div>
        
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p><?php echo lang("TOTAL_ITEMS"); ?></p>
                    <span><a href="items.php"><?php echo countItems("item_ID","items")?></a></span>
                </div>
            </div>
       
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p><?php echo lang( "TOTAL_COMMENTS"); ?></p>
                    <span><a href="comments.php"><?php echo countItems("C_ID","comments")?></a></span>
                </div>
            </div>
        </div> 
         
        <div class="row">
            <div class="col s6  m3 box push-m1">
                <div class="stat ">
                    <p><?php echo lang( "BUY_OPERATIONS"); ?></p>
                    <span><a href="statistics.php"><?php echo countItems("ID","buy_operations")?></a></span>
                </div>
            </div>
            <div class="col s6  m3 box push-m1">
                <div class="stat ">
                    <p><?php echo lang("DEBIT_DEPOSIT"); ?></p>
                    <span><a href="debit_deposit.php"><?php echo countItems("ID","debit_deposit_operations")?></a></span>
                </div>
            </div>
            <div class="col s6  m3 box push-s3 push-m1">
                <div class="stat ">
                    <p><?php echo lang("Online")?></p>
                    <span><a><?php echo countItems("ID","login_details WHERE last_activity > DATE_SUB(NOW(), INTERVAL 5 SECOND)")?></a></span>
                </div>
            </div>
        </div> 
         
    </div>


    
  <!--start Latest user collection-->

    <div class="container">
        <div class="row">
            <div class = "mm col s12 m6">
               <ul class="collection with-header" id="last-users-list">
               
                 <!-- the collection content will be called by ajax-->
                </ul>
            </div>
               <!--start Latest user collection-->
            
              <div class="col m6">
                <ul class="collection with-header" id="last-items-list">
                    
    <!--         <li class='collection-item'><div><a href='#!' class='secondary-content'></a></div></li>-->
               </ul>
              </div> 
            </div>
        </div>

  <!--start Latest user collection-->
   <?php
     
     //End Dashbord page
        
       include $tpl."footer.php"; 

 	
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>