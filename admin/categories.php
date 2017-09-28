<?php 
ob_start();
session_start();

$pageTitle  = "Categries";

if(isset($_SESSION['username'])){
       
     $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
    
    include "init.php";

    include $tpl. "header.php";

    include $tpl. "nav.php"; 
    
    if ($do == "mange"){
        
        
    }elseif ($do == "add"){
        
        ?>
         
<!--         Categories/start Add Categories Form-->

          <div class="container add">
            <h1 class="center-align"><?php echo lang('ADD_NEW_CATEGORIES')?></h1>
            <form class="form AddFormCate" action="?do=insert" method="POST">
          <!--start input "Add Category Name" field-->       
              <div class="row"> 
                <div class="input-field col s8 m5 push-m1 push-s2">
                 <i class="material-icons  prefix">queue</i>
                  <input id="icon_prefix"
                         type="text" 
                         class="validate input" 
                         limit ="3"
                         name="CateName"
                         data-value ="1">
                  <label for="icon_prefix"><?php echo lang("CATEGORY_NAME")?></label>
                  <span></span>
                  <div class="errmsg">
                     <p class='msg'> <?php echo lang("ERRMSG(3)_JS")?></p>
                  </div>
                </div>
                  <!--End input "Add Category Name" field-->     

                 <!--start input "Add Description" field--> 
                  
                <div class="input-field col s8 m5 push-m1 push-s2">
                  <i class="material-icons prefix">border_color</i>
                  <input id="icon_prefix input" 
                         limit ="6"
                         value = " "
                         type="text"
                         limit = "8"
                         class="validate input" 
                         name="description"
                         data-value ="0">
                  <label for="icon_prefix"><?php echo lang('DESCRIPTION')?></label>
                </div>
                   <!--End input "Description" field--> 
               </div>
                
            <!--start input "Ordering" field--> 
              <div class="row order">
                <div class="input-field col s8 m4 push-m4 push-s2">
                  <i class="material-icons prefix">event_note</i>
                  <input  type="text"
                          value=" "
                          class="validate password1 input" 
                         name = 'order'
                          limit ="4"
                         data-value ="0">
                  <label for="icon_telephone"><?php echo lang("ORDERING")?></label>
                </div>
              </div>
                
                <!--End input "ordring" field-->
                
               <!--start radio buttons for visiblity and allow comment and advertising field--> 

                <div class="row">  
<!--                  start radio btn for visibilty-->
                     <div class="col s8 m2 push-m3 push-s2 radio">
                         <span><?php echo lang('VISIBILTY')?></span>
                        <p>
                          <input class="with-gap" name="visibilty" type="radio" id="vis-yes" value ="0" checked/>
                          <label for= "vis-yes"><?php echo lang("ALLOW")?></label>
                        </p>
                        <p>
                          <input class="with-gap" name="visibilty" type="radio" id="vis-no" value ="1" />
                          <label for="vis-no"><?php echo lang('NOT_ALLOW')?></label>
                        </p>
                    </div>   
      <!--                  End radio btn for visibilty-->

       <!--                  start radio btn for Comment-->

                    <div class="col s8 m2 push-m3 push-s2 radio">
                        <span><?php echo lang("Comment")?></span>
                        <p>
                          <input class="with-gap" name="comment" type="radio" id="comment-yes" value ="0" checked/>
                          <label for= "comment-yes"><?php echo lang('ALLOW')?></label>
                        </p>
                        <p>
                          <input class="with-gap" name="comment" type="radio" id="comment-no" value ="1" />
                          <label for="comment-no"><?php echo lang('NOT_ALLOW')?></label>
                        </p>
                    </div>  
     <!--                  End radio btn for Comment-->

     <!--                  start radio btn for Adevertising-->

                    <div class="col s8 m2 push-m3 push-s2 radio">
                        <span><?php echo lang("ADVERTISING")?></span>
                        <p>
                          <input class="with-gap" name="ads" type="radio" id="ads-yes" value ="0" checked/>
                          <label for= "ads-yes"><?php echo lang("ALLOW")?></label>
                        </p>
                        <p>
                          <input class="with-gap" name="ads" type="radio" id="ads-no" value ="1" />
                          <label for="ads-no"><?php echo lang('NOT_ALLOW')?></label>
                        </p>
                    </div>  
     <!--                  End radio btn for Adevertising-->                    
                  </div>  <!--End row-->  

              <!--End radio buttons for visiblity and allow comment and advertising field--> 
     
              <!--start Add new Categories button-->
                
              <div class="row"> 
                 <button class="btn btnMebers waves-effect waves-light col s4 m2 push-s4 push-m5  "type="submit" name="action"><?php echo lang('ADD_CATEGORIES')?>
                   <i class="material-icons right">autorenew</i>     
                 </button> 
                </div>
                
            </form><!--End form-->
          </div> <!--End container-->

      <!--         Members/End Add Form-->
    
   <?php
            
            
    }elseif ($do = 'insert'){
        
        //insert new Categorie info
        
       if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
             
           $CateName     = $_POST['CateName'];
           $description  = $_POST['description'];
           $order        = $_POST['order'];
           $vis          = $_POST['visibilty'];
           $comment      = $_POST['comment'];
           $ads          = $_POST['ads'];
         
         
            // Make an Error Array for Add form 
         
            $addFormErr = [];
         
           if (empty($CateName) or strlen($CateName) > 25){
               
               $addFormErr[] = lang("PHP_ERRMSG_NAME");
           }
             
             // function to check the name if it reapeted, when yes => 1; but when no => return 0
             
             $check = checkItem("Name", "categories", $CateName ); 
             
           if ($check == 1){
               
              $addFormErr[] = lang("PHP_REAPETED_EMPTY");
           }
             
          
              
          // End  Error Array for Add form 
             
            // check if the values are approved values 
          
           if (!empty($addFormErr)){
               
             //when yes then Echo this Error Messege
           ?>

          

                 <div class = "container">
                     
                     <!-- print the caught Errorrs-->
                     
                     <?php foreach($addFormErr as $Err){ ?> 
                     <div class="row">
                       <div class='errmsg_php' style='display:block'>
                           
                           <!--Err : Erorr msg -->
                         <p class='msg'><?php echo $Err; ?></p> 
                       </div>
                    </div>
                     <?php } ?>
                 </div>

         <?php
               
                redirectPage("","back");
               
            // when yes then insert the new user to Datebase
               
           }else {
               
               $stmt = $con->prepare("INSERT INTO
                                                categories
                                                     (Name, Description, ordering, 	Visbility, Allow_Comment, Allow_Ads)
                                                VALUES 
                                                     (:zName, :zDescription, :zordering, :zVisbility, :zAllow_Comment, :zAllow_Ads)");
                   
                $stmt->execute([":zName"           => $CateName,
                                "zDescription"     => $description,
                                "zordering"        => $order,
                                "zVisbility"       => $vis,
                                "zAllow_Comment"   => $comment,
                                "zAllow_Ads"       => $ads ,
                               ]);
               
 
 


 
               // check if this Record Inserted
               
               if ($stmt->rowCount() > 0){  
              

                       //Echo success Massege

                       redirectPage(lang("SUCCESS"),"back");
                   
               }else { 

                       //Echo failed Massege

                       redirectPage("","back");
                       
                   
         }
               
           } 
         }
         
        
    }
    
    include $tpl."footer.php"; 
        
 } else {

 	header("Location:index.php");

 	exit();

 }

ob_end_flush();
?>