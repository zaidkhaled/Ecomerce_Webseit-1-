<?php 

ob_start();

 session_start();

$pageTitle = "Dashbord";

 if(isset($_SESSION['username'])){
        
      
     
        
       include "init.php"; 
        
       include $tpl. "header.php";     

       include $tpl."nav.php"; 
      
    
     //start Dashbord page
     
     ?>
    
     <div class="container home-stats center-align">
        <div class = "row"> 
            <h1 >Dashbord</h1>
        </div>
        
        <div class="row">
            <div class="col s6  m3 box">
                
                <div class="stat">
                    <p>Total Members</p>
                    <span><a href="members.php?do=mange"><?php echo countItems("userID","users")?></a></span>
                </div>
            </div>
            
            <div class="col s6  m3 box">
                <div class="stat">
                    <p>Pending Members</p>
                    <span><a href="members.php?do=mange&page=pending"><?php echo checkItem("regStatus", "users", 0)?></a></span>
                </div>
            </div>
        
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p>Total Items</p>
                    <span><a href="mange.php"><?php echo countItems("userID","users")?></a></span>
                </div>
            </div>
       
            <div class="col s6  m3 box">
                <div class="stat ">
                    <p>Total coments</p>
                    <span><a href="mange.php"><?php echo countItems("userID","users")?></a></span>
                </div>
            </div>
            
        </div> 
    </div>


    
  <!--start Latest user collection-->

    <div class="container">
        <div class="row">
            <div class = "mm col s12 m6">
           <ul class="collection with-header">
               
            <li class="collection-header"><h4><?php echo lang("LATEST_USER")?></h4></li>
            <?php
         
             //function to bring just the last 5 registerd users
         
              $users = getLatest("*", "users", "userID", 5);
     
                 foreach($users as $user){?>
              
                    <!-- List of the last 5 regestered users und theres activate status-->
               
                   <li class="collection-item"><div><?php echo $user['username'] ?>
                       
                       <a href="members.php?do=Edit&userID=<?php echo $user['userID']?>" class="secondary-content">
                           <i class="material-icons">mode_edit</i>
                       </a>
                       
                       <!-- check the register Status-->
                       
                         <?php if ($user['regStatus'] == 0){
                               echo "<a href='members.php?do=activate&userID=". $user['userID'] ."' class = 'secondary-content'><i class='material-icons'>thumb_down</i></a>";
                             }?>
                     </div>
                   </li>
                        
              <?php } ?> 
                  
            
          
              </ul>
              </div>
              <div class="col m6">
              <ul class="collection with-header">

                <li class="collection-header"><h4><?php echo lang("LATEST_USER")?></h4></li>

               
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