<?php

function lang($phrase){

    // haompage
    
    static $lang = [ 
  
    "ITEMS"               => "Item",
    "CATEGORIES"          => "Categories",
    "MEMBERS"             => "Members",    
    "STATISTICS"          => "Statistics",   
    "LOGS"                => "Logs",    
    "EDIT"                => "Edit",    
    "SETTING"             => "Setting",    
    "LOGOUT"              => "Logout",
    "LOG_IN"              => 'Log in',
    "HOME_ADMIN"          => "Home",  
    "ERRMSG(3)_JS"        => "You have to write <strong> more then 3 </strong>Letters", // js: Witch means the Error Msg will show form Javescript
        
    "ERRMSG(6)_JS"        => "You have to write <strong> more then 6 </strong>Letters",
    "ERRMSG(8)_JS"        => "You have to write <strong> more then 8 </strong>Letters",
    "PHP_ERRMSG_NAME"     => "Your Name should be <strong> more then 3 </strong>Letters",// Php: Witch means Error rong Msg will show form PHP
        
    "PHP_ERRMSG_EMAIL"    => "Your Email should be <strong> more then 6 </strong>Letters  but not more then 20 letters",
        
    "PHP_ERRMSG_FULLNAME" => "You full Name shoud be <strong> more then 8 </strong>Letters but not more then 25 letters ",
    "PHP_ERR_EMPTY_PASS"  => "You Password shoud NOT be <strong> Empty </strong>",
    "PHP_Rec_Err_Msg"     => "this order is not <strong> Accepted </strong> pleace try again" ,
    "PHP_SUCCMSG"         => "Mission completed info updated",
    "PHP_SUCCMSG_DEL_MSG" => "Mission completed info deleted",
    "FIRST_NAME"          => "First name", 
    "EMAIL"               => "Email", 
    "PASSWORD"            => "Password", 
    "REPEAT_PASSWORD"     => "Reapet Password", 
    "FULLNAME"            => "Fullname",
    "SAVE"                => "SAVE",
    "EDIT_MEMBERS"        => "Edit Mambers",
    "ADD_MEMBERS"         => "Add members",
    "REGISTER"            => "Register",
    "REGISTERED"          => "Registered",
    "CONTROL"             => "Control",
    "SURE_MSG"            => "Are you sure",
    "SURE_MSG_CONTENT"    => "you will delet this user "
        
    
        
    
    ];
        
    return $lang[$phrase];
    
}
 