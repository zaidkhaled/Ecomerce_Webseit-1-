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
    "ERRMSG(3)_JS"        => "Please fill out this field with <strong> more then 3 </strong>Letters", // JS: Witch means the Error Msg will show form Javescript
    "ERRMSG(6)_JS"        => "Please fill out this field with<strong> more then 6 </strong>Letters",
    "ERRMSG(8)_JS"        => "Please fill out this field with <strong> more then 8 </strong>Letters",
    "PHP_ERRMSG_NAME"     => "Your Name should be <strong> more then 3 </strong>Letters",// Php: Witch means Error rong Msg will show form PHP
    "PHP_ERRMSG_EMAIL"    => "Your Email should be <strong> more then 6 </strong>Letters  but not more then 20 letters",
    "PHP_ERRMSG_FULLNAME" => "You full Name shoud be <strong> more then 8 </strong>Letters but not more then 25 letters ",
    "PHP_ERR_EMPTY_PASS"  => "You Password shoud NOT be <strong> Empty </strong>",
    "PHP_REAPETED_EMPTY"  => "This Email is alrady exsit",
    "PHP_Rec_Err_Msg"     => "this order is not <strong> Accepted </strong> pleace try again" ,
    "PHP_SUCCMSG"         => "Mission completed info updated",
    "PHP_SUCCMSG_DEL_MSG" => "Mission completed info deleted",
    "SURE_MSG"            => "Are you sure",
    "SURE_FULLNAME_MSG"   => "you will delet this user : ",
    "FIRST_NAME"          => "First name", 
    "EMAIL"               => "Email", 
    "PASSWORD"            => "Password", 
    "REPEAT_PASSWORD"     => "Reapet Password", 
    "FULLNAME"            => "Full name",
    "SAVE"                => "save",
    "EDIT_MEMBERS"        => "Edit Members",
    "ADD_MEMBERS"         => "Add members",
    "REGISTER"            => "Register",
    "REGISTERED"          => "Registered",
    "CONTROL"             => "Control",
    "CLOSE"               => "Close",
    "SURE_MSG"            => "Are you sure",
    "SURE_MSG_CONTENT"    => "you will delet this user ",
    "REDIRECTED"          => "you will be redirected to last Page after ",
    "SECONDS"             => "seconds",
    "SUCCESS"             => "Mission completed",
    "FAILED"              => "Mission failed",
    "LATEST_USER"         => "Latest Registerd Users",

    //Category Page 
        
    "ADD_NEW_CATEGORIES"  => "Add New Category",    
    "ADD_CATEGORIES"      => "Add Category",    
    "CATEGORY_NAME"       => "CATEGORY NAME",    
    "DESCRIPTION"         => "DESCRIPTION",    
    "ORDERING"            => "Ordering",    
    "VISIBILTY"           => "Visiblty",    
    "Comment"             => "Comment",    
    "ADVERTISING"         => "Advertising",                  
    "ALLOW"               => "Allow",    
    "NOT_ALLOW"           => "prevent",    
                
    ];
        
    return $lang[$phrase];
    
}
 