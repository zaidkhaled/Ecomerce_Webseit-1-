<?php

// show login und register btn just if no $_SESSION['user'] exist.

$login = !isset($_SESSION['user'])? "<li><a href='logReg.php'>". lang("LOGIN/REGISETER") . "</a></li>" : "";
$logout = isset($_SESSION['user'])? "<li><a href='logout.php'>". lang('LOGOUT') . "</a></li>" : "";
?>
 <ul id="dropdownSM" class="dropdown-content">
  <li><a  href ="profile.php"> <?php echo lang("PROFILE")?> </a></li>
  <li><a href="#"><?php echo lang('SETTING')?></a></li>
  <?php echo $login;?>
  <?php echo $logout;?>
</ul>

 <ul id="dropdown11" class="dropdown-content">
    <li><a href = "profile.php"><?php echo lang("PROFILE")?></a></li>
    <li><a href="#!"><?php echo lang('SETTING')?></a></li>
    <?php echo $login;?> 
    <?php echo $logout;?> 
    
</ul>

<ul id="search-sm-rst" class="dropdown-content">
   <a>hiihi</a>
   <a>hiihi</a>
   <a>hiihi</a>
   <a>hiihi</a>
</ul>

<nav class="nav-fixed">
   <div class="container">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
            
        <?php
          // fetch category      
          $getCate = globalGet("*", "categories", "WHERE Parent = 0", "", "ID", $ordering = "ASC");  
            
          foreach ( $getCate as $cat){
              
                  echo "<li><a class = 'cate-menu' data-activates='drop". $cat['ID'] . "'>" . $cat['Name'] . "</a></li>"; ?>
            
                  <ul id="drop<?php echo $cat['ID']; ?>"  class="dropdown-content"> <?php  
              
                      echo "<li><a href='category.php?required=category&ID=" . $cat['ID'] . "&name=" . str_replace( " ", "-", $cat['Name']) . "'>" . $cat['Name'] . "</a></li>";
              
                      // fetch child category
              
                      $cate_child = globalGet("*", "categories", "WHERE Parent ={$cat['ID']}");
              
                            foreach ($cate_child as $child){
                                
                                     echo "<li><a href='category.php?required=category&ID=" . $child['ID'] . "&name=" . str_replace( " ", "-", $child['Name']) . "'>" . $child['Name'] . "</a></li>"; 
                            } ?>
                   
                       
                   
                  </ul> 
         <?php  } ?>
          <li><a class="dropdown-button" class = "dropdown-button" data-activates="dropdown11"><?php $value = isset($_SESSION['user'])? $_SESSION['user']: "Drop"; echo $value; ?><i class="material-icons right">arrow_drop_down</i></a></li> 
        </ul>
          
        <ul class="right col s3 hide-on-large-only">
          <li id="search-icon-sm"><a><i class="material-icons">search</i></a></li>   
        </ul>

          
        <ul class="left col s3 hide-on-med-and-down">
          <li  id = "search-icon" class="nav-click-show" data-hide = "#notification > .events" ><a><i class="material-icons">search</i></a></li>   
          <input type="search" class="search-nav" data-show = ".search-box">
          <div class="search-box">
              <a>ali ali ali ali aliali ali ali ali aliali ali ali ali ali </a>
              <a>ali ali ali ali ali </a>
              <a>ali ali ali ali ali </a>
              <a>ali ali ali ali ali </a>
              <a>ali ali ali ali ali </a>
          </div>    
        </ul>
          
        <ul class="right">
           <li><a href="index.php" class="left-align brand-logo"><?php echo lang('HOME_ADMIN')?></a></li>         
        </ul>                    
          
        <div class="left nav-click-show" id="notification" data-show = "#notification > .events" data-hide = ".search-nav, .search-box">
          <a><i class="material-icons">add_alert</i></a>
          <span>44</span>  
          <div class="events" >
            <div id="up"></div>  
            <ul class="collection">
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>  
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>
              <li class="collection-item avatar">
                <img src="uplaodedFiles/itemsFotos/foto1.jpg" alt="" class="circle">
                <span class="title">Title</span>
                <p>First Line <br>
                   Second Line
                </p>
              </li>    
            </ul>    
         </div>
       </div>

        <ul class="side-nav" id="mobile-demo">
        <?php    
          foreach ( $getCate as $cat){
                 //  echo "<li><a href='category.php?required=category&ID=" . $cat['ID'] . "&name=" . str_replace( " ", "-", $cat['Name']) . "'>" . $cat['Name'] . "</a></li>"; 
                   
                   echo "<li><a class = 'cate-menu' data-activates='drop". $cat['ID'] . "'>" . $cat['Name'] . "</a></li>"; ?>
               
         <?php  }?>                                                              
           <li><a class="dropdown-button"  data-activates="dropdownSM"><?php $value = isset($_SESSION['user'])? $_SESSION['user']: "Drop"; echo $value; ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
     </div>
   </div>
   <div class="search-sm hide-on-large-only">
     <input type="search" class="search-nav-sm" data-show = ".search-box-sm" id="search-nav-sm">  
     <div class="search-box-sm">
       <a>ali ali ali ali aliali ali ali ali aliali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
       <a>ali ali ali ali ali </a>
     </div>   
   </div>
</nav>
<div id="nav-sm" class="hide-on-large-only">
  <a  data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>  
</div>

