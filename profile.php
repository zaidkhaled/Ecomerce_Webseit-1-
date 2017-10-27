 <?php 
 ob_start();
 session_start();

 $pageTitle = $_SESSION['user'];

 include "init.php"; 
 include $tpl."header.php";
 include $tpl."nav.php";


 if(isset($_SESSION['user'])){ //check if user alrady logined ?>
     
       <div class="row">

         <div class="col m3 "> <!-- Note that "m4 l3" was added -->
           <div class="info-item-clm ">
            <div class="container">
               <div class="info">
                 <?php $info =  getSpecialInfo("users", "userID",  $_SESSION['ID']);?>
                 <h4 class="info-title"><?php echo lang("PERSONAL_INFO");?></h4>
                 <!--Edit btn for prsonal info -->
                 <div class="row">
                   <a class="secondary-content update-btn">
                     <i class="material-icons">mode_edit</i>
                   </a>
                 </div> <!--End edit btn for prsonal info -->
                 <!-- start personal info-->
                 <div class="row" id = "user-info">
                   <p class="user-info"><?php echo lang("FIRST_NAME");?>: <?php echo $info['username'];?></p>
                   <p class="user-info"><?php echo lang("EMAIL");?>:      <?php echo $info['Email'];?></p>
                   <p class="user-info"><?php echo lang("FULLNAME");?>:   <?php echo $info['fullName'];?></p>
                </div> <!-- end personal info-->
                <p class="center-align password-change"><?php echo lang("CHANGE_PASSWORD");?></p>
                 
                <div class="password-fields">
                    <!--start input "Add password" field--> 
                     <div class="input-field">
                       <i class="material-icons prefix">lock_outline</i>
                       <input type="password"
                              id="pass1" 
                              class="validate password1 input" 
                              limit ="6"
                              data-required ="required">
                       <label for="icon_telephone"><?php echo lang('PASSWORD')?></label>
                     </div> <!--End input "Add password" field--> 
                      <!--start input "Repeat password" field--> 
                     <div class="input-field">
                       <i class="material-icons prefix">lock_outline</i>
                       <input id="pass2" 
                              type="password"
                              class="validate password2 input" 
                              limit ="6"
                              data-required ="required">
                      <label for="icon_telephone"><?php echo lang('REPEAT_PASSWORD')?></label>
                    </div>  <!--End input "Repeat password" field-->
                    <button type="button" id="change-user-pass-btn" class="waves-effect waves-light btn right"><?php echo lang("CHANGE")?>   
                </div>
                <div id="errors">
                </div> 
             </div>
       
             <p class = "divider"></p>
             <div class="info">
               <h4 class="info-title"><?php echo lang("COMMENTS"); ?></h4>
                 
                 
                 
                 
                 
               <?php foreach (getItems("Member_ID", $_SESSION['ID']) as $item){?>
                     <div class = "last-comment">
                     <p class="item-name"><?php echo $item['Name'];?> (<?php echo checkItem("Item_ID", "comments", $item['Item_ID'])?>)</p>
                     
                     <?php foreach(getSpecialComments($item['Item_ID']) as $comment) {?>
                           <div class="items-comment">
                             <h5 class="written_by"><?php echo $comment["written_by"];?></h5>   
                             <span class ="comment-data"><?php echo $comment["Comment_Data"];?></span>   
                             <p class ="comments"><?php echo $comment["Comment"];?></p>
                             
                           </div>
                 <?php } ?> 
                  </div>
                 <?php } ?> 
                
                 
                 
                 
             </div>
            </div>
           </div>
         </div>

         <div class="col s12 m9 items"> <!-- Note that "m8 l9" was added -->
         
              <div class="container">
                <div class="row">
                <!--  show the all items from this category-->
                   <h1 class="center-align"><?php echo $pageTitle;?></h1>
                    
                <?php foreach (getItems("Member_ID", $_SESSION['ID']) as $item){?> 
                     <!-- start card item  -->
                     <div class="col s12 m4">
                       <div class="card"> 
                        <div class="card-image waves-effect waves-block waves-light">
                          <img class="activator" src="layout/images/Lv.jpg">
                        </div>
                        <div class="card-content">
                          <span class="card-title activator"><?php echo $item['Name'];?></span>
                          <span class="right price-num"><?php echo $item['Price'];?></span>
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



         </div>

       </div>

 <?php } else {
     
      header("Location:logReg.php");// redirect to index.php.
 }


 include $tpl."footer.php";

 ob_end_flush();
?>