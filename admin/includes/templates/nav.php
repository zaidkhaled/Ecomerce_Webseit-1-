 <ul id="dropdownSM" class="dropdown-content">
  <li><a href="members.php?do=Edit&userID=<?php echo $_SESSION['ID']?>"><?php echo lang('EDIT')?></a></li>
  <li><a href="#!"><?php echo lang('SETTING')?></a></li>
  <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

 <ul id="dropdownMED" class="dropdown-content">
  <li><a href="members.php?do=Edit&userID=<?php echo $_SESSION['ID']?>"><?php echo lang('EDIT')?></a></li>
  <li><a href="#!"><?php echo lang('SETTING')?></a></li>
  <li><a href="logout.php"><?php echo lang('LOGOUT')?></a></li>
</ul>

<nav>
   <div class="container">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
          <li><a href=""><?php echo lang('ITEMS')?></a></li>
          <li><a href="members.php?do=mange"><?php echo lang('MEMBERS')?></a></li>
          <li><a href=""><?php echo lang('STATISTICS')?></a></li>
          <li><a href=""><?php echo lang('LOGS')?></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdownMED">Zeid<i class="material-icons right">arrow_drop_down</i></a></li>    
        </ul>
          
        <ul class="left">
           <li><a href="dashbord.php" class="left-align brand-logo"><?php echo lang('HOME_ADMIN')?></a></li> 
        </ul>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

         <ul class="side-nav" id="mobile-demo">
           <li><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
           <li><a href=""><?php echo lang('ITEMS')?></a></li>
           <li><a href="members.php?do=mange"><?php echo lang('MEMBERS')?></a></li>
           <li><a href=""><?php echo lang('STATISTICS')?></a></li>
           <li><a href=""><?php echo lang('LOGS')?></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdownSM">Zeid<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
   </div>
</nav>
        
