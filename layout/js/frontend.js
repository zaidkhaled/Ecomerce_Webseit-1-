/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
    $('select').material_select(); //trigger  select field
 
//    $('select').material_select('destroy');
    
        /* <=============define impotant functions ====================> */
     
    //ajax function it will send data from different pages to 'functionsdb.php', to processing the info , and to deal with database
        
//    function post($where, $do, $id, $cateColNmae, $stus, $data_required, $item_id) {
//
//        var name  = "",
//            email = "",
//            pass  = "",
//            oldPass = "",
//            fullname = "",
//            Description = "",
//            Order = "",
//            Visibilty = "",
//            Comment = "",
//            Ads = "",
//            price = "",
//            madeIn = "",
//            userId = "",
//            cateId = "",
//            comment = "";
//
//        
//        if ($id === undefined) {
//            $id = "";
//        }
//        if ($item_id === undefined) {
//            $item_id = "";
//        }
//        
//        //if "pending members" request is exist then retuen just pending members in table body
//        if ($data_required === undefined) {
//            $data_required = $('#data_required').html();
//        }
//        if ($do === 'insert') {
//            // get new values from 'add form' and send them to 'functionsdb.php' and insert them into database
//            name     = $('#add-name').val();  
//            email    = $('#add-email').val();
//            pass     = $('#add-pass').val();
//            fullname = $('#add-fName').val();
//            
//        } else if ($do === "update") {
//            // get new values from 'edit form' and send them to 'functionsdb.php' and insert them into database
//            $id      = $('#user-id').val();
//            name     = $('#NewuserName').val();
//            email    = $('#NewEmail').val();
//            pass     = $("#NewPassword").val();
//            oldPass  = $('#oldPassword').val();
//            fullname = $('#NewFullName').val();
//            
//        } else if ($do === "insert_cate" || $do === "cate_update") { 
//           // get new values from "Catogory add form " and send them to 'functionsdb.php' and insert them into database
//            $id         = $('#cate-id').val(); 
//            name        = $('#cate-name').val();
//            Description = $('#cate-descrp').val();
//            Order       = $('#cate-order').val();
//            Visibilty   = $("#visble").is(":checked") ? 1 : 0;
//            Comment     = $("#comment").is(":checked") ? 1 : 0;
//            Ads         = $("#adv").is(":checked") ? 1 : 0;
//
//        } else if ($do === "insert_item" || $do === "update-item") {
//            // get new values from "item add form " and send them to 'functionsdb.php' and insert them into database
//            $id         = $('#item-id').val();
//            name        = $('#item-name').val();
//            Description = $('#item-descrp').val();
//            price       = $('#item-price').val();
//            madeIn      = $("#made-in").val();
//            $stus       = $('#select-status option:selected').val();
//            userId      = $('#select-user option:selected').val();
//            cateId      = $('#select-cate option:selected').val();
//            
//        } else if ($do === "update_comment") {
//            $id          = $("#update-comments-form .comment-id").val(); 
//            comment      = $("#update-comments-form .comment-update-field").val(); 
//            
//            
//        }
//        
//        
//        $.ajax({
//            url  : "dbfunctions.php",
//            
//            type : "GET",
//            
//            data : {
//                
//                do              : $do, 
//                ajxID           : $id, 
//                ajxName         : name,
//                ajxEmail        : email,
//                ajxPass         : pass,
//                ajxOldPass      : oldPass,
//                ajxFullname     : fullname,
//                ajxdata_required: $data_required, 
//                ajxItem_ID      : $item_id, 
//                ajxDescription  : Description,
//                ajxOrder        : Order,
//                ajxVisibilty    : Visibilty,
//                ajxAds          : Ads,
//                ajxCateColName  : $cateColNmae,
//                ajxStatus       : $stus,
//                ajxMadeIn       : madeIn,
//                ajxComment      : Comment,
//                ajxPrice        : price,
//                ajxUserId       : userId,
//                ajxCateId       : cateId,
//                ajxPrice        : price,
//                ajxcomment      : comment,
//            }
//            
//        }).done(function (e) { // return info from dbfunction
//            
//            // <||> : which means there is multiple results received
//            
//            if (e.indexOf("<||>") > -1) { // dealing with multiple results 
//           
//                var res = e.split("<||>"), 
//                    palace = $where.split(",");
//                
//                $(palace[0]).html(res[0]);
//                $(palace[1]).html(res[1]);
//                 
//            } else {
//                $($where).html(e);
//            }
//        }).fail(function () {
//            
//            alert('Error');
//            
//        });
//
//    }
    
    
    
/*
               <======================================================================>
     function to looking for a specific values in the table, the function will recognize data by class .search-in.
     the function will filter table INFO and return the best result
               <=======================================================================>
*/
    
    
    
//    function search($search_field, $parent_elm) {
//        
//        var curr = $search_field.val(); // "search input" value
//        
//        $parent_elm.hide(); // first hide all data 
//        
        // if user start to writing in "search field", then start data filtering and hide all useless data
        
//        if (curr !== "") {
//            
//            $parent_elm.hide(); // first hide all data 
//            
//            $parent_elm.find(".search-in").each(function () { //for each elment have "search-in" class in the table  
//    
//                var  value =  $(this).html(); // get html value  
//                
//                // check if $search_field.val() exist in this row 
//                          
//                if (value.toUpperCase().indexOf(curr.toUpperCase()) > -1) {  
//                                
//                        //if yes then show all info it about it and change the background-color
//                                
//                    $(this).css("background-color", "red").parent($parent_elm).show();
//
//                } else {
//                        //rest background color
//                    $(this).css("background-color", "");
//                }
////                }   
//                        
//            });
//               
//        } else { //if there is no value in search field, then show all data in "tabel-body". and rest background color for all
//            
//            $parent_elm.show().find(".search-in").each(function () {$(this).css("background-color", ""); });
//            
//        } 
//          
//    }
//    
    
    /*
    onload function : this function will send ajax request on page load 
    $where : the tag id, where content shuold be placed
    */
    
//    function onload($where, $do) {
//        
//        $(window).on("load", function () {
//
//            post($where, $do);
//            
//        }); 
//    }
//    
//    
     /* <============= End definition the impotant functions ====================> */
    
    
                /* <============= start login page ====================> */
    if (location.href.indexOf("profile") > 1) {
        $('nav').addClass('nav-fixed');
        $("#sidenav-overlay").css("color", "red");                                  /////////////////// مشكله ب side nav 
    }
    
   
 
    $('#register').on('click', function () {
        $(this).addClass('title-selected').siblings().removeClass('title-selected');
        $(".register-form").removeClass("selected").siblings(".login-form").addClass('selected');
    });
    
    $('#login').on('click', function () {
        $(this).addClass('title-selected').siblings().removeClass('title-selected');
        $(".login-form").removeClass("selected").siblings(".register-form").addClass('selected');
    });
    
    $(".item-name").on('click', function () {
       
        $(this).siblings(".items-comment").slideToggle();
    });

    
    
    
    function post($do, $where) {
        var name  = "",
            email = "",
            fname = "",
            pass1 = "",
            pass2 = "";
        
        if ($do === "update-user-info") {
            name  = $("#update-name").val();
            email = $("#update-email").val();
            fname = $("#update-fName").val();
        }
        
        if ($do === "change_pass") {
                
            pass1 = $("#pass1").val();
            pass2 = $("#pass2").val();
        }
        
        $.ajax({
            url : "dbfunctions.php",
            
            type : "GET",
            
            data : {
                
                ajaxdo     : $do,
                ajaxname   : name,
                ajaxemail  : email,
                ajaxfname  : fname,
                ajaxPass1  : pass1,
                ajaxPass2  : pass2
            
                
            }
            
        }).done(function (e) {
            
            $($where).html(e);
            
        }).fail(function () {
            
            alert("fail fail");
            
        });
    }
    
    $(".info-item-clm .info .update-btn").on("click", function () {
        post("show_inputs_field", "#user-info");
        
    });
    
    $("#user-info").on('click', "#update-user-info-btn", function () {
        post('update-user-info', "#user-info");
    });
    
    
    $(".password-change").on('click', function () {
        $('.password-fields').slideToggle();
    });
    
    $("#change-user-pass-btn").on('click', function () {
        post("change_pass", "#errors");
        $('.password-fields').slideUp();
    });
    
    
});  //ende


