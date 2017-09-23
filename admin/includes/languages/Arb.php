<?php 

function lang($phrase){
    
    static $lang = [ 
    "message" => "hi",
    "admin" => "hm"    
    ];
        
    return $lang[$phrase];
    
}