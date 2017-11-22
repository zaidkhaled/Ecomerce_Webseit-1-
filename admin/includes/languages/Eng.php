<?php

function lang($phrase){

    // haompage
    
    static $lang = [ 
  
    "ITEMS"               => "Items",
    "SHOP"                => "Shop",
    "CATEGORIES"          => "Categories",
    "MEMBERS"             => "Members",    
    "STATISTICS"          => "Statistics",   
    "LOGS"                => "Logs",    
    "EDIT"                => "Edit",    
    "SETTING"             => "Setting",    
    "LOGOUT"              => "Logout",
    "LOG_IN"              => 'Log in',
    "HOME_ADMIN"          => "Home",  
    "DASHBOARD"           => "Dashboard",  
    "FOTOS"               => "Fotos",  
    "PHP_ERRMSG_NAME"     => "Your Name should be  more then 3 Letters",// Php: Witch means Error rong Msg will show form PHP
    "PHP_ERRMSG_ITEM_NAME"=> "Your item Name should be  more then 3 Letters",// Php: Witch means Error rong Msg will show form PHP
    "PHP_ERRMSG_EMAIL"    => "Your Email should be more then 6 Letters  but not more then 20 letters",
    "PHP_ERRMSG_FULLNAME" => "Your full Name shoud be more then 4 Letters",
    "PHP_ERR_EMPTY_PASS"  => "Your Password shoud NOT be empty ",
    "PHP_REAPETED_EMPTY"  => "This Email is alrady exsit",
    "PHP_Rec_Err_Msg"     => "this order is not <strong> Accepted </strong> pleace try again" ,
    "PHP_SUCCMSG"         => "Mission completed info updated",
    "PHP_SUCCMSG_DEL_MSG" => "Mission completed info deleted",
    "PHP_DEFFRENT_PASS"   => "The passwords are diffrent",
    "PHP_ERR_FOTO_EXTENTIONS"=> "Foto extension should be jpg or jpg or jpeg or gif",
    "ERRMSG_VALIDATE_EMAIL"=> "This email is not valid",   
    "SURE_MSG"            => "Are you sure",
    "SURE_FULLNAME_MSG"   => "you will delete this user : ",
    "FIRST_NAME"          => "First name", 
    "EMAIL"               => "Email", 
    "PASSWORD"            => "Password", 
    "REPEAT_PASSWORD"     => "Reapet Password", 
    "COMMENT_TIMES"       => "Cmt_times", 
    "ITEMS_NUM"           => "Items_num", 
    "PHP_EMPTY_PASS"      => "password should not be empty", 
    "FULLNAME"            => "Full name",
    "FOTO_UPLOAD"         => "Uplaod your foto",
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
    "GRUOP"               => "Gruop",
    "TOTAL_MEMBERS"       => "Total Members",
    "PENDING_MEMBERS"     => "Pending Members",
    "TOTAL_ITEMS"         => "Total Items",
    "TOTAL_COMMENTS"      => "Total comments",
    "BUY_OPERATIONS"      => "Buy operations",




    //Category Page 
        
    "MANGE CATEGORIES"    => "Mange categories",    
    "ADD_NEW_CATEGORIES"  => "Add New Category",    
    "EIDT_CATEGORIES"     => "Edit  Category",
    "PHP_CATE_NAME"       => "Category name is empty",
    "ADD_CATEGORIES"      => "Add Category",    
    "CATEGORY_NAME"       => "CATEGORY NAME",    
    "DESCRIPTION"         => "DESCRIPTION",    
    "ORDERING"            => "Ordering",    
    "PARENT"              => "Parent",    
    "VISIBILTY"           => "Visiblty",    
    "COMMENTS"             => "Comments",    
    "ADVERTISING"         => "Advertising",                  
    "ALLOW"               => "Allow",    
    "NOT_ALLOW"           => "prevent",    
    "SURE_CATE_NAME_MSG"  => "you will delete this category : ", 
        
    //statistics
        
     "BUYER"              => "Buyer_Name",    
     "SELLER"             => "seller_Name",    
     "ITEMS_NAME"         => "Item_Name",    
     "TIME_OF_PURCHASE"   => "Time of purchase",    
     "SALES_STATISTICS"   => "Sales statistics",    
         
    //depit deposit page
        
     "DEPIT_DEPOSIT"      => "Depit - Deposit",
     "AMOUNT"             => "Amount",
     "TIME_OF_OPERATION"  => "Time of operation",
     "AMUONT_DEPOSITED"   => "Amount deposited",
     "WITHDRAWAL"         => "Withdrawal",
     "CURRENCY_TYPE"      => "Currency_Type",   
        
        
        
    //items page 
      
    "ITEMS_MANGER"        => "Items manger", 
    "ADD_NEW_ITEMS"       => "Add New Item",    
    "UPDATA_ITEM"         => "Updata item",    
    "ITEM_NAME"           => "Name",  
    "ITEMS_DESCRP"        => "Description",  
    "COMMENT"             => "Comment",  
    "COMT"                => "COMTS",  
    "ITEMS_PRICE"         => "Price",  
    "ITEMS_MIND_IN"       => "Made-in", 
    "NEW"                 => "New", 
    "STATUS"              => "Status", 
    "LIKE_NEW"            => "Like new", 
    "USED"                => "Used", 
    "OLD"                 => "old",  
    "FOTO_ITEM_UPLOAD"    => "Uplaod item foto",  
    "TAGS"                => "Tags ( , )", 
    "TAG_SHOW"            => "Tags", 
    "PHP_ERRMSG_TAGS"     => "Place fill the tag field without space",    
    "USER_NAME"           => "User name", 
    "PHP_ERRMSG_ITEM_NAME"=> "Item name should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_DSCRP"    => "Item Description should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_MADE_IN"  => "Item 'made in country' selector should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_CATE"     => "place choose category Name" ,  
    "PHP_ERRMSG_PRICE"    => "Item price field should be <strong> more then 6 </strong>Letters ",  
    "ITEM NAME"           => "Name",  
    "DESCRIPTION"         => "Description ",  
    "PRICE"               => "Price",  
    "MADE_IN"             => "Made in ",  
    "CATEGORY"            => "category",  
    "MEMBER_NAME"         => "Mamber Name",  
    "STATUS"              => "Status",  
    "ADD_DATA"            => "Add_data",
    "LATEST_ITEMS"        => "Latest uploaded items",
    "ITEM_COMMENT_MENGER" => "Item comment manger",
    "CHOSE_ITEM"          => "Chose Item",
    "NUMS_ITEMS"          => "Nums_item",
    
    //comments Page  
     
    "ITEM_NAME"           => "Item_name",
    "WRITTEN_IN"          => "Written in",
    "SURE_MSG_COMMENTS"   => "Delete comments from : ",
    
    ];
        
    return $lang[$phrase];
    
}
 