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
                    <p>Total Members</p>
                    <span><a href="members.php"><?php echo countItems("userID","users")?></a></span><!--count users-->
                </div>
            </div>
            
            <div class="col s6  m3 box">
                <div class="stat">
                    <p>Pending Members</p>
                    <!--count unactivate users-->
                    <span><a href="members.php?page=pending"><?php echo checkItem("regStatus", "users", 0)?></a></span>
                </div>
            </div>
        
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p>Total Items</p>
                    <span><a href="mange.php"><?php echo countItems("item_ID","items")?></a></span>
                </div>
            </div>
       
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p>Total comments</p>
                    <span><a href="comments.php"><?php echo countItems("C_ID","comments")?></a></span>
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