<?php

function lang($phrase){

    // haompage
    
    static $lang = [ 
    
//    category page
    
        
    "VIST"                 => "Vist",
    "PROFILE"              => "Profile",
    "LOGIN"                => "Login",
    "LOGIN/REGISETER"      => "Login/Register",
    "PERSONAL_INFO"        => "Personal info",
    "CHANGE_PASSWORD"      => "Change password",
    "CHANGE"               => "Change",
    "FOTO_UPLOAD"          => "Upload your foto...",
    "FOTO_ITEM_UPLOAD"     => "Upload your item foto",
    "APPROVE_WAIT"         => "Wait to be approved",
    "MAIN_FOTO"            => "Main foto",
    "ITEMS_FOTOS"          => "Item fotos",
    "ADD_BALANCE"          => "Add balance to your account",
    "COMMENT"              => "Comment",
    "COMMENT_ON"           => "commented on",
        
        
        
        
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
    "ERRMSG(3)_JS"        => "Please fill out this field with <strong> more then 3 </strong>Letters", // JS: Witch means the Error Msg will show form Javescript
    "ERRMSG(6)_JS"        => "Please fill out this field with<strong> more then 6 </strong>Letters",
    "ERRMSG(8)_JS"        => "Please fill out this field with <strong> more then 8 </strong>Letters",
    "PHP_ERRMSG_NAME"     => "Your Name should be <strong> more then 3 </strong>Letters",// Php: Witch means Error rong Msg will show form PHP
    "PHP_ERRMSG_EMAIL"    => "Your Email should be <strong> more then 6 </strong>Letters  but not more then 20 letters",
    "ERRMSG_VALIDATE_EMAIL"=> "This email is not valid",
    "PHP_ERRMSG_FULLNAME" => "You full Name shoud be <strong> more then 8 </strong>Letters but not more then 25 letters ",
    "PHP_ERR_EMPTY_PASS"  => "You Password shoud NOT be <strong> Empty </strong>",
    "PHP_ERR_DIFFERENT_PASS"=> "The passwords are different ",
    "PHP_ERR_FOTO_EXTENTIONS"=> "Foto extension should be jpg or jpg or jpeg or gif",
    "PHP_ERR_FOTO_EMPTY"  => "Foto field should not be empty",
    "PHP_ERR_FOTO_SIZE"   => "Foto size should not be biger then 40MB",
    "PHP_REAPETED_EMPTY"  => "This Email is alrady exsit",
    "PHP_Rec_Err_Msg"     => "this order is not <strong> Accepted </strong> pleace try again" ,
    "PHP_SUCCMSG"         => "Mission completed info updated",
    "PHP_SUCCMSG_DEL_MSG" => "Mission completed info deleted",
    "PHP_SUCCMSG_REGISTER"=> "Your data have been registerd",
    "SURE_MSG"            => "Are you sure",
    "SURE_FULLNAME_MSG"   => "you will delete this user : ",
    "FIRST_NAME_OR_EMAIL" => "First name or Email", 
    "FIRST_NAME"          => "First name",    
    "EMAIL"               => "Email", 
    "PASSWORD"            => "Password", 
    "REPEAT_PASSWORD"     => "Reapet Password", 
    "COMMENT_TIMES"       => "Cmt_times", 
    "ITEMS_NUM"           => "Items_num", 
    "PHP_EMPTY_PASS"      => "password should not be empty", 
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
    "GRUOP"               => "Gruop",
    "CURRENT_BALANCE"     => "Current balance",

    //Category Page 
        
    "MANGE CATEGORIES"    => "Mange categories",    
    "ADD_NEW_CATEGORIES"  => "Add New Category",    
    "EIDT_CATEGORIES"     => "Edit  Category",
    "PHP_CATE_NAME"       => "Category name is empty",
    "ADD_CATEGORIES"      => "Add Category",    
    "CATEGORY_NAME"       => "CATEGORY NAME",    
    "DESCRIPTION"         => "DESCRIPTION",    
    "ORDERING"            => "Ordering",    
    "VISIBILTY"           => "Visiblty",    
    "COMMENTS"             => "Comments",    
    "ADVERTISING"         => "Advertising",                  
    "ALLOW"               => "Allow",    
    "NOT_ALLOW"           => "prevent",    
    "SURE_CATE_NAME_MSG"  => "you will delete this category : ",    
       
    //items page 
    "BUY"                 => "Buy",    
    "AGREE"               => "Agree",    
    "CLOSE"               => "Close",    
    "EMPTY"               => "Empty",
    "HOW_MANY"            => "How many  $",
    "HOW_MANY_ITEM"       => "How many",
    "ITEMS_MANGER"        => "Items manger", 
    "ADD_NEW_ITEMS"       => "Add New Item",    
    "ADD_NEW_COMMENT"     => "Add New Comment",
    "SENT_IT"             => "Sent it",
    "WRITE_COMMENT"       => "Write your comment",
    "UPDATA_ITEM"         => "Updata item",    
    "ITEM_NAME1"          => "Name",  
    "ITEMS_DESCRP"        => "Description",  
    "ITEMS_PRICE"         => "Price",  
    "ITEMS_MIND_IN"       => "Made-in", 
    "TAGS"                => "Tags ( , )", 
    "TAG_SHOW"            => "Tags", 
    "RATING"              => "Rating", 
    "NEW"                 => "New", 
    "STATUS"              => "Status", 
    "LIKE_NEW"            => "Like new", 
    "USED"                => "Used", 
    "OLD"                 => "old",  
    "USER_NAME"           => "User name", 
    "PHP_ERRMSG_ITEM_NAME"=> "Item name should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_DSCRP"    => "Item Description should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_MADE_IN"  => "Item 'made in country' selector should be <strong> more then 6 </strong>Letters ",  
    "PHP_ERRMSG_CATE"     => "place choose category Name" ,  
    "PHP_ERRMSG_PRICE"    => "place write your item price ",  
    "PHP_ERRMSG_TAGS"     => "Place fill the tag field without space",  
    "ITEM NAME"           => "Name",  
    "DESCRIPTION"         => "Description ",  
    "PRICE"               => "Price",  
    "MADE_IN"             => "Made in ",  
    "CATEGORY"            => "category",  
    "MEMBER_NAME"         => "Mamber Name",  
    "STATUS"              => "Status",  
    "OWNER"               => "Owner",  
    "ADD_DATA"            => "Add_data",
    "LATEST_ITEMS"        => "Latest uploaded items",
    "ITEM_COMMENT_MENGER" => "Item comment manger",
    "CHOSE_ITEM"          => "Chose Item",
    "DELETE_ITEM_MSG"     => "Delete this item",
    "NUMS_ITEM"           => "Nums_item",
    "ADD_COMMENT"         => "Add comment",
    "UPDATE_COMMENT"      => "Update comment",
    "DELETE"              => "Delete",    
    "SOLD"                => "Sold",
    "BOUGHT YOUR"         => "bought your",
    "NO_RESULT_FUOND"     => "No result found",
    "NO_ITEM"             => "there is no items to show",
    
    //comments Page  
     
    "ITEM_NAME"           => "Item_name",
    "WRITTEN_IN"          => "Written in",
    "NO_NOTIF"            => "No notification found ",
    
   //lang
        
    "CHANGE_LANG"         => "Change lang"
    ];
        
    return $lang[$phrase];
    
}
 ?>