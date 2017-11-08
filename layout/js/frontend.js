/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
    $('select').material_select(); //trigger  select field
    
    /* <=============define impotant functions ====================> */

                
    
  // ajax function
    
    function post($where, $do, $id) {
        
        var name         = "",
            email        = "",
            fname        = "",
            pass1        = "",
            pass2        = "",
            Description  = "",
            price        = "",
            madeIn       = "",
            $stus        = "",
            cateId       = "",
            tags         = "",
            comment      = "";
        
        if ($id === undefined) {
            $id = "";
        } 
        
        if ($do === "update-user-info") {
            
            name         = $("#update-name").val();
            email        = $("#update-email").val();
            fname        = $("#update-fName").val();
            
        } else if ($do === "change_pass") {
                
            pass1        = $("#pass1").val();
            pass2        = $("#pass2").val();
            $('.password-fields').slideUp();
            
        } else if ($do === "insert_item" || $do === "edit_item") {
            // get new values from "item add form " and send them to 'functionsdb.php' and insert them into database
            name         = $('#item-name').val();
            Description  = $('#item-descrp').val();
            price        = $('#item-price').val();
            madeIn       = $("#made-in").val();
            tags       = $("#tags").val();
            $stus        = $('#select-status option:selected').val();
            cateId       = $('#select-cate option:selected').val();
            
            //        empty inputs after ajax call
            $('.addItemForm .input, #item-descrp').each(function () { $(this).val(""); });

            // reset selectors inputs

            $('select').prop('selectedIndex', -1);

            $('select').material_select(); // materialze requirement

            $('.addItemForm').slideUp();
                
        } else if ($do === "add_comment") {
            
            comment       = $("#item-comment").val();
            $id           = $("#item-id").val();
            $("#item-comment").val("");
            $('.add-comment').slideUp();
        }
        
        $.ajax({
            
            url : "dbfunctions.php",
            
            type : "GET",
            
            data : {
                
                ajxdo          : $do,
                ajxID          : $id,
                ajxName        : name,
                ajxEmail       : email,
                ajxFname       : fname,
                ajxPass1       : pass1,
                ajxPass2       : pass2,
                ajxDescription : Description,
                ajxCateId      : cateId,
                ajxTags        : tags,
                ajxStatus      : $stus,
                ajxMadeIn      : madeIn,
                ajxPrice       : price,
                ajxComment     : comment
                
                
            
                
            }
            
        }).done(function (e) {
            
            $($where).html(e);
            
        }).fail(function () {
            
            alert("fail fail");
            
        });
    }
    
    // ajax call for user department
    
    $(document).on("click", ".ajax-click", function () {
        
        var $place = $(this).data("place"),
            
            $do = $(this).data("do"),
            
            item_ID = $(this).attr("data-id");
        
        
        post($place, $do, item_ID);
        
    });
    
                    /* <============= start login page ====================> */
    

    // show login input if user click on login in logReg page and show register form when user ckick on 
    
    $('.form-title').each(function () {
        
        $(this).on("click", function () {
            
            $(this).addClass('title-selected').siblings().removeClass('title-selected');

            $($(this).data('title')).addClass("selected").siblings("form").removeClass('selected');
        });
        
    });

//    start navbar
    $(".cate-menu").on("mouseover", function() {
        $(this).dropdown({ hover: false });
    })
    
//    end navbar
    
/*    $('.formy').submit(function () {
        
        return false;
    });*/
    
             /* <============= end login Register page ====================> */
    
    
    
             
    
    // show  item comment when user click on item name 
    
    $(".item-name").on('click', function () {
       
        $(this).siblings(".items-comment").slideToggle();
    });
    
    
    // add clss nav-fixed just when user is in profile page
    
    if (location.href.indexOf("profile") > 1) {
        $('nav').addClass('nav-fixed');
        $("#sidenav-overlay").css("color", "red");                                  /////////////////// مشكله ب side nav 
        
    }
    
    
    // slideToggel the password fields when user click on password-change
    
    $(".password-change").on('click', function () {
        
        $('.password-fields').slideToggle();
    });
    
    
    
    // slideToggel for add new item form in profile page 
    $('#add-item-btn').on('click', function () {
       
        $('.addItemForm').slideToggle();
    });


    
    
    /* <============= End profile page ====================> */
    
    
    /* <============= start item  page ====================> */
    
    
    // condition to make edit on item directly after page load
    
    if (location.href.indexOf("item") > -1 && location.href.indexOf("edit") > -1) {
        
        // check if update-btn already exist, which means this item belongs to this user 
        
        if ($(".details .update-btn").length > 0) {

            $(".details .update-btn").click();
        }
        
    }
    
    $('#plus-comment-btn').on("click", function () {
        
        $($(this).data("target")).slideToggle();
        
    });
    
    $('#item-comment').on('keyup', function () {
        
        if ($("#item-comment").val().length > 0) {
            
            $("#add-comment-btn").removeAttr("disabled");
            
        } else {
            
            $("#add-comment-btn").attr("disabled", "true");
        }
    });
                   /* <============= end item  page ====================> */
    
});  //ende


