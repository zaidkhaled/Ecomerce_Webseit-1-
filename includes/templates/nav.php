<?php

// show login und register btn just if no $_SESSION['user'] exist.

$login = !isset($_SESSION['user'])? "<li><a href='logReg.php'>". lang("LOGIN/REGISETER") . "</a></li>" : "";
?>
 <ul id="dropdownSM" class="dropdown-content">
  <li><a  href = "profile.php"> <?php echo lang("PROFILE")?>  </a></li>
  <li><a href="#!"><?php echo lang('SETTING')?></a></li>
  <?php echo $login;?>
  <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

 <ul id="dropdownMED" class="dropdown-content">
    <li><a href = "profile.php"><?php echo lang("PROFILE")?></a></li>
    <li><a href="#!"><?php echo lang('SETTING')?></a></li>
    <?php echo $login;?> 
    <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

<nav>
   <div class="container">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
        <?php    
          foreach ( getCate() as $cat){
          echo "<li><a href='category.php?required=category&ID=" . $cat['ID'] . "&name=" . str_replace( " ", "-", $cat['Name']) . "'>" . $cat['Name'] . "</a></li>";
          }?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdownMED">Zeid<i class="material-icons right">arrow_drop_down</i></a></li> 
        </ul>
          
        <ul class="right">
           <li><a href="index.php" class="left-align brand-logo"><?php echo lang('HOME_ADMIN')?></a></li> 
        </ul>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

         <ul class="side-nav" id="mobile-demo">
        <?php    
          foreach ( getCate() as $cat){
          echo "<li><a href='category.php?required=category&ID=" . $cat['ID'] . "&name=" . str_replace( " ", "-", $cat['Name']) . "'>" . $cat['Name'] . "</a></li>";
          }?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdownSM">Zeid<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul><bu
      </div>
   </div>
      
</nav>
