/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
    $('select').material_select(); //trigger  select field
    
    
//    $('select').material_select('destroy');
    
        /* <=============define impotant functions ====================> */
     
    //ajax function it will send data from different pages to 'functionsdb.php', to processing the info , and to deal with database
        
    function post($where, $do, $id, $cateColNmae, $stus, $data_required, $item_id) {

        var name  = "",
            email = "",
            pass  = "",
            oldPass = "",
            fullname = "",
            Description = "",
            Order = "",
            Visibilty = "",
            Comment = "",
            Ads = "",
            price = "",
            madeIn = "",
            userId = "",
            cateId = "",
            comment = "";

        
        if ($id === undefined) {
            $id = "";
        }
        if ($item_id === undefined) {
            $item_id = "";
        }
        
        //if "pending members" request is exist then retuen just pending members in table body
        if ($data_required === undefined) {
            $data_required = $('#data_required').html();
        }
        if ($do === 'insert') {
            // get new values from 'add form' and send them to 'functionsdb.php' and insert them into database
            name     = $('#add-name').val();  
            email    = $('#add-email').val();
            pass     = $('#add-pass').val();
            fullname = $('#add-fName').val();
            
        } else if ($do === "update") {
            // get new values from 'edit form' and send them to 'functionsdb.php' and insert them into database
            $id      = $('#user-id').val();
            name     = $('#NewuserName').val();
            email    = $('#NewEmail').val();
            pass     = $("#NewPassword").val();
            oldPass  = $('#oldPassword').val();
            fullname = $('#NewFullName').val();
            
        } else if ($do === "insert_cate" || $do === "cate_update") { 
           // get new values from "Catogory add form " and send them to 'functionsdb.php' and insert them into database
            $id         = $('#cate-id').val(); 
            name        = $('#cate-name').val();
            Description = $('#cate-descrp').val();
            Order       = $('#cate-order').val();
            Visibilty   = $("#visble").is(":checked") ? 1 : 0;
            Comment     = $("#comment").is(":checked") ? 1 : 0;
            Ads         = $("#adv").is(":checked") ? 1 : 0;

        } else if ($do === "insert_item" || $do === "update-item") {
            // get new values from "item add form " and send them to 'functionsdb.php' and insert them into database
            $id         = $('#item-id').val();
            name        = $('#item-name').val();
            Description = $('#item-descrp').val();
            price       = $('#item-price').val();
            madeIn      = $("#made-in").val();
            $stus       = $('#select-status option:selected').val();
            userId      = $('#select-user option:selected').val();
            cateId      = $('#select-cate option:selected').val();
            
        }else if ($do === "update_comment") {
           $id          = $("#update-comments-form .comment-id").val(); 
           comment      = $("#update-comments-form .comment-update-field").val(); 
            
            
        }
        
        
        $.ajax({
            url  : "dbfunctions.php",
            
            type : "GET",
            
            data : {
                
                do              : $do, 
                ajxID           : $id, 
                ajxName         : name,
                ajxEmail        : email,
                ajxPass         : pass,
                ajxOldPass      : oldPass,
                ajxFullname     : fullname,
                ajxdata_required: $data_required, 
                ajxItem_ID      : $item_id, 
                ajxDescription  : Description,
                ajxOrder        : Order,
                ajxVisibilty    : Visibilty,
                ajxAds          : Ads,
                ajxCateColName  : $cateColNmae,
                ajxStatus       : $stus,
                ajxMadeIn       : madeIn,
                ajxComment      : Comment,
                ajxPrice        : price,
                ajxUserId       : userId,
                ajxCateId       : cateId,
                ajxPrice        : price,
                ajxcomment      : comment,
            }
            
        }).done(function (e) { // return info from dbfunction
            
            // <||> : which means there is multiple results received
            
            if (e.indexOf("<||>") > -1) { // dealing with multiple results 
           
                var res = e.split("<||>"), 
                    palace = $where.split(",");
                
                $(palace[0]).html(res[0]);
                $(palace[1]).html(res[1]);
                 
            } else {
                $($where).html(e);
            }
        }).fail(function () {
            
            alert('Error');
            
        });

    }
    
    
    
/*
               <======================================================================>
     function to looking for a specific values in the table, the function will recognize data by class .search-in.
     the function will filter table INFO and return the best result
               <=======================================================================>
*/
    
    
    
    function search($search_field, $parent_elm) {
        
        var curr = $search_field.val(); // "search input" value
        
        $parent_elm.hide(); // first hide all data 
        
        // if user start to writing in "search field", then start data filtering and hide all useless data
        
        if (curr !== "") {
            
            $parent_elm.hide(); // first hide all data 
            
            $parent_elm.find(".search-in").each(function () { //for each elment have "search-in" class in the table  
    
                var  value =  $(this).html(); // get html value  
                
                // check if $search_field.val() exist in this row 
                          
                if (value.toUpperCase().indexOf(curr.toUpperCase()) > -1) {  
                                
                        //if yes then show all info it about it and change the background-color
                                
                    $(this).css("background-color", "red").parent($parent_elm).show();

                } else {
                        //rest background color
                    $(this).css("background-color", "");
                }
//                }   
                        
            });
               
        } else { //if there is no value in search field, then show all data in "tabel-body". and rest background color for all
            
            $parent_elm.show().find(".search-in").each(function () {$(this).css("background-color", ""); });
            
        } 
          
    }
    
    
    /*
    onload function : this function will send ajax request on page load 
    $where : the tag id, where content shuold be placed
    */
    
    function onload($where, $do) {
        
        $(window).on("load", function () {

            post($where, $do);
            
        }); 
    }
    
    
     /* <============= End definition the impotant functions ====================> */
    
 /* ===================== start ajax controll on page loading =========================== */ 
    
    
    // At beginning i will target in which loading page should be ajax request sended 
    

    if (location.href.indexOf("members") > 1) { // if Current page is members then 
        
        onload("#users-table-body");

    } else if (location.href.indexOf("dashboard") > 1) { // if Current page is dashboard then 
        
        onload("#last-users-list, #last-items-list");

        
    } else if (location.href.indexOf("categories") > 1) { // if Current page is categoris page then 
        
        onload("#mange-cate"); 
        
    } else if (location.href.indexOf("items") > 1) { // if Current page is Items page then  
        
        onload("#item-table-body");

    } else if (location.href.indexOf("comments") > 1) { // if Current page is Items page then  
        
        onload("#comments-table-body");

    }
    

    
/* ============================== end ajax controll on page loading ============================== */ 
    
    
/* ============================  start members and dashboard page ================================ */ 
    
    //show add new Member Form, if user ckick add btn 
    
    $('#add-btn').on("click", function () {

        $('#add-user').modal('open');
        
    });
    
    // send now user info to database
    
    $('#info-send').on('click', function () {
        
        post("#users-table-body", "insert");
        
    });
    
//    delete user from database
    
    $("#users-table-body").on("click", ".modal-trigger", function () {
       
        $('.modal').modal();  //trigger modal in dbfunctions.php before delete user
        
        $('.modal-footer .delete').on("click", function () { //send delete request to dbfunctions.php to delete user data
         
            post("#users-table-body", 'delete', $(this).attr('data-id'));
            
        });
        
    });
    
    // The following functoin to bring old data to edit form
    
    function bring_old_data($id_input, $val, $target_info) {  
        
        $($id_input).val($val.attr($target_info)); // target old data in "functions.php" page
        
    }
    
     
    // the following function is for "edit btn" in dashboard page and members page because both of them have "edit btn"
    
    $("#users-table-body, #last-users-list").on("click", ".update-btn", function () {
        
        $('#update-form').modal('open'); //triger edit form
        
         //edit form old info
         
        bring_old_data('#user-id', $(this), 'data-id'); //print user id
         
        bring_old_data('#NewuserName', $(this), 'data-userNname'); //print old user name
         
        bring_old_data('#NewEmail', $(this), 'data-email'); //print old user Email 
         
        bring_old_data('#NewFullName', $(this), 'data-fullName'); //print old fullName
         
        bring_old_data('#oldPassword', $(this), 'data-oldPass'); //print old user oldpassword
         
        //end edit form info
       
    });
 
    
    // edit button from "Edit form" in navbar
    
    $('.edit-button').on('click', function () {
        
        $('#update-form').modal('open');
        
        // set session info, to edit form ("in nav bar").on click of edit button in navbar."edit just personal data"
        $('#user-id').val($('#user-id').attr('session-id'));
        $('#NewuserName').val($('#NewuserName').attr("session-name"));
        $('#NewEmail').val($('#NewEmail').attr("session-Email"));
        $('#NewFullName').val($('#NewFullName').attr("session-fullName"));
        $('#oldPassword').val($('#oldPassword').attr("value"));
    });
    
       // send updated info to database
    
    $('#info-update').on('click', function () {
        
        post("#users-table-body, #last-user-list", "update");
        
        // empty password field and other inputs will be automatically chenged
        
        $('#pass').removeAttr("value");
        $('#NewPassword').removeAttr("value");
        
    });
    
   // the following function is for "edit btn" in dashboard page and members page because both of them have "activate btn"
    
    $("#users-table-body, #last-users-list").on("click", "#unactivated", function () { //send userId to activate user 

        post("#users-table-body ,#last-users-list", 'activate', $(this).attr('data-id'));
        
    });
     // start controll forms 
    
    
    
 /*   
   ============================================================================================================
    ===> Im Folgendem Code nutze ich das Attribute (data-value), um Edit Form und Add Form zu unterscheiden und 
    ===> die Wiederholung des Codes zu vermeiden 
   ============================================================================================================
 */
    
    // note =>> if input (data-required) = free, then no action is required. example for (edit form)
    
      //   define important functions
    
    function msgSubmit($input) { // submit function => show the red message on submit,  just when values are not acceptable 
        
        if ($input.val().length < $input.attr('limit')) {
                
            $input.siblings('.errmsg').fadeIn(1000);

        }
    }
    

    $('.modal form input').blur(function () {
        
        if ($(this).attr("data-required") === "free") {//if this is the "edit form" then :
        
            if ($(this).val().length > 0) {//this Condition is just for (edit members form) and to know which data the user wants to update
                
                msgSubmit($(this));
            }
            
        } else if ($(this).attr("data-required") === "required") { //if this is the "Add Form" then do showRong()  :
            
            msgSubmit($(this));
        }
    });
    
//    $('.modal form input').each(function () {
//        
//        if ($(this).val().length < $(this).attr('limit')) {
//            
////            console.log('yes');
//            
////              $('#info-send').fadeOut(6000);////////////////////////
//            
//        }
//    });
    
    
 
    //  use search function to looking for (.username .Email .fullName) in #tabel-body
    
    $('#search-user-info').on("keyup", function () {
        
        search($(this), $('#users-table-body .table-row'));
        
        
        // if user start to writing in "search input", then start data filtering and hide all useless data///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         
        
    });
    
    
    /* =============================     end members and dashboard pages  =======================*/
    
    
    
    /* ================================  Start categories page  ================================ */
      
   // start categories Page 
    
    // if user click on plus btn, then open add "category form".
    
    $('#add-cate-btn').on("click", function () {
        
        $('#update-add-cate .input').each(function () { $(this).val(""); }); // rest input fields
        
        $('#update-add-cate').modal('open'); 
        
        $('#update-cate, #update-add-cate .form-title-update').hide(); // hide update btn "#update-item" and update form title
        
        $('#add-cate, #update-add-cate .form-title-add, #update-add-cate .cate-status').show(); // show send btn "#add-new-item" and add form title category status comment and visbility and ads
    }); 
    
    
    // if user ckick on OK in add "category form", then send new data by ajax to "dbfunctions.php".
    
    $('#add-cate').on('click', function () {
    
        post("#mange-cate", "insert_cate");
        
    }); 
       
    // the fallowing function is for (Visbility, Allow_Comment, Allow_Ads) (0 or 1)? || to send (onClick) the opposite value by ajax to make fast edit on category 
    
    $('#mange-cate').on("click", "li span", function () {
        
        var newStaus = $(this).attr("data-status") === "1" ? 0 : 1,
            colName  = $(this).attr("col-name"),
            cate_id  = $(this).parent().attr("cate-id");
          
        post("#mange-cate", "change_cate_status", cate_id, colName, newStaus);
    });    
     
    // open modal "edit category form" and insert all old data to the input fields.
    
    $('#mange-cate').on("click", "li .update-btn", function () {
        
        $('#update-add-cate').modal('open');
   
        // get all old category infos and set them in the update form
        
        $('#cate-id').val($(this).parent().parent("li").attr('cate-id'));
        $('#cate-name').val($(this).parent().parent("li").attr('cate-name'));
        $('#cate-descrp').val($(this).parent().parent("li").attr('cate-descrp'));
        $('#cate-order').val($(this).parent().parent("li").attr('cate-order'));
        

        $('#update-cate, #update-add-cate .form-title-update').show(); // show update btn "#update-item" and update form title
        $('#add-cate, #update-add-cate .form-title-add, #update-add-cate .cate-status').hide(); // hide send btn "#add-new-item" and add form title category status comment and visbility and ads
        
    });  
    
    // open "delete warning" on click of  ".delete-btn"
    
    $('#mange-cate').on("click", "li .delete-btn", function () {
        
        $('.modal').modal();
    });
    
    // send update category request on click of "#update-cate-info"
    
    $("#update-cate").on('click', function () {
        
        post('#mange-cate', "cate_update");
        
    });
    
    // send delete category request on click of "#delete-cate"
    
    $('#mange-cate').on("click", "#delete-cate", function () {
      
        var cateID = $(this).attr("data-id");
        
        post('#mange-cate', 'cate_delete', cateID);
    });
    
  
    // use search function to looking for (category name and description) in #mange-cate in categories page
    
    $('#search-cate-info').on("keyup", function () {

        search($(this), $('#mange-cate li'));
        
    });
    

    /* ==========================  End categories page =================================== */
    
    
    
    
    
    
    /* ==========================  start item page =================================== */ 
    
  
     // comment manger  will appeared when name of item in items.php page is  clicked 
    
    $('#item-table-body').on('click', '.table-row .ItemName', function () {
     
       var item_id = $(this).siblings('.itemID').html();
        
        $(this).css("background-color", "red").parent().siblings().children(".ItemName").css("background-color", "");
        
        post("#comments-item", "", "", "", "", "comments", item_id);
        
        
    });
    
    // open modal "edit comments form" and insert all old data to the input field.
    
    $('#comments-item').on("click", ".collection-item .comment-controll .update-btn-to-item", function () {
        
        // open texteara to edit the comment 
        
        $('#update-comments-form').modal('open');
        
        // get all old comment infos and set them in the update form
        
        $("#update-comments-form .comment-update-field").val($(this).parent().siblings(".comment").html());
        $("#update-comments-form .comment-id").val($(this).parent().parent("li").attr("data-id"));
        $('#update-comments-to-item').attr("item-id", $(this).parent().parent("li").attr("item-id"));

    }); 
    
    
    $('#update-comments-to-item').on("click", function () {
        
        var  item_id = $(this).attr("item-id");
        
        post("#comments-item", "update_comment", "", "", "", "comments", item_id);
        
    });     
    
    
    // show warning msg on click of .delete-icon in item page
    
    $('#comments-item').on('click', ".comment-controll .delete-btn-to-item", function () {
        
        $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
        
        $('#delete-to-item').on("click", function () { //send delete request to dbfunctions.php to delete user data
            
            var comment_id = $(this).attr("data-id"),
                item_id    = $(this).attr("item-id");
            
            post("#comments-item", 'delete_comment', comment_id, "", "", "comments", item_id);
           
        });
        
    });
    
    
    // prepare update-add-item form to add new items, reset all inputs fields
    
    $('#add-item-btn').on("click", function () {
      
        $('#update-add-item').modal('open'); // open "add new item" form 
        
        $('#add-new-item, #update-add-item .form-title-add').show(); // sohw send btn "#add-new-item" and add form title
        
        $('#update-item, #update-add-item .form-title-update').hide(); // hide update btn "#update-item" and update form title
        
        // empty the input fields
          
        $('#update-add-item .input').each(function () { $(this).val(""); });
        
        // reset selectors 
        
        $('#select-cate, #select-user, #select-status').prop('selectedIndex', -1);
        $('#select-cate, #select-user, #select-status').material_select(); // materialze requirement

    }); 
 
    // send ajax request to dbfunctions.php page to add new item in database
    
    $('#add-new-item').on('click', function () {
    
        post("#item-table-body", "insert_item");
        
    });
    
    // show warning msg on click of .delete-icon in item page
    
    $('#item-table-body').on('click', '.table-row .modal-trigger', function () {
        
        $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
        
        $('.modal-footer .delete').on("click", function () { //send delete request to dbfunctions.php to delete user data
         
            post("#item-table-body", 'delete_item', $(this).attr('data-id'));
           
        });
        
    });
    
    // on click of edit item icon '.update-item-btn' then do the following orders. in items page
    
    $('#item-table-body').on('click', '.update-item-btn', function () {
        
        $('#update-add-item').modal('open'); // open add new item form 
        
        
        //old selectors values
        
        var oldstus = $(this).parent().siblings(".Status").html(),
            oldCate = $(this).parent().siblings(".cate-name").html(),
            oldUserName = $(this).parent().siblings(".user-name").html();
      
        // get all old item infos to set them in update form
        
        $('#item-id').val($(this).parent().siblings(".itemID").html());
        $('#item-name').val($(this).parent().siblings(".ItemName").html());
        $('#item-descrp').val($(this).parent().siblings(".Descrp").html());
        $('#item-price').val($(this).parent().siblings(".Price").html());
        $("#made-in").val($(this).parent().siblings(".MadeIn").html());
      
        $('#select-user').find('option:contains("' + oldUserName + '")').prop("selected", true);
        $('#select-cate').find('option:contains("' + oldCate + '")').prop("selected", true);
        $('#select-status').find('option[value="' + oldstus + '"]').prop("selected", true);

        $('#select-cate, #select-user, #select-status').material_select(); // materialze requirement
        
        $('#update-item, #add-item .form-title-update').show(); // show update btn "#update-item" and update form title
        $('#add-new-item, #add-item .form-title-add').hide(); // hide send btn "#add-new-item" and add form title
        
    });
    
    
    // prepare "add edit item form" in dashboard page
    
    $("#last-items-list").on("click", ".update-btn", function () {
        
        $('#update-add-item').modal('open'); //triger edit form
        
         //edit form old info
        bring_item_data('#item-id', $(this), 'item-id'); //get item id
         
        bring_item_data('#item-name', $(this), 'item-Name'); //get old Name
         
        bring_item_data('#item-descrp', $(this), 'item-descrp'); //get old description
         
        bring_item_data('#item-price', $(this), 'price'); //get old price
        
        bring_item_data("#made-in", $(this), 'made-in'); //get old made in country
        
        var oldstus = $(this).attr("status"), //get old status 
            oldCate = $(this).attr("cate-id"), //get old category
            oldUserName = $(this).attr("members-id"); // get old user name 

        // set values above into "update add item form" 
        
        $('#select-user').find('option[value="' + oldUserName + '"]').prop("selected", true); 
        $('#select-cate').find('option[value="' + oldCate + '"]').prop("selected", true);
        $('#select-status').find('option[value="' + oldstus + '"]').prop("selected", true);

        $('#select-cate, #select-user, #select-status').material_select(); // materialze requirement
        
        $('#update-item, #update-add-item .form-title-update').show(); // show update btn "#update-item" and update form title
        $('#add-new-item, #update-add-item .form-title-add').hide(); // hide send btn "#add-new-item" and add form title

    });
    
    
    // send request by ajax on click of '#update-item' to update item info 
    
    $('#update-item').on('click', function () {
        
        post("#item-table-body", 'update-item');

    });
    
    
    //  use search function to looking for (item name, decription, category, user name ) in #tabel-body
    
    $('#search-item-info').on("keyup", function () {
        
        search($(this), $('#item-table-body .table-row'));
        
    });

    
    // if user "adimin" click on "#unapproved" btn in items page or in dashboard, then the item will be approved
    
    $("#item-table-body, #last-items-list").on("click", "#unapproved", function () { //send Item_ID to activate user 

        post("#item-table-body , #last-items-list", 'approve_item', $(this).attr('data-id'));
        
    });
    
    
    
        // The following functoin to bring old data to edit form
//    
//    function bring_item_data($id_input, $val, $target_info) {  
//        
//        $($id_input).val($val.attr($target_info)); // target old data in "functions.php" page
//        
//    }
//    
    
    /* ==========================  Edd item page =================================== */ 
    
    
    
    
    
    
    /* ==========================  Start Comments page =================================== */ 
    
    
    // show warning msg on click of .delete-icon in item page
    
    $('#comments-table-body').on('click', '.table-row .modal-trigger', function () {
        
        $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
        
        $('.modal-footer .delete').on("click", function () { //send delete request to dbfunctions.php to delete user data
         
            post("#comments-table-body", 'delete_comment', $(this).attr('data-id'));
           
        });
        
    });
    
    // approve a comment, change status from 0 to 1
    $("#comments-table-body").on("click", "#unapproved", function () { //send Item_ID to activate user 

        post("#comments-table-body", 'approve_comment', $(this).attr('data-id'));
        
    });
    
    
    // open modal "edit comments form" and insert all old data to the input field.
    
    $('#comments-table-body').on("click", ".table-row td .update-comment-btn", function () {
        
        // open texteara to edit the comment 
        
        $('#update-comments-form').modal('open');
        
        // get all old comment infos and set them in the update form
        
        $("#update-comments-form .comment-update-field").val($(this).parent().siblings(".comment").html());
        $("#update-comments-form .comment-id").val($(this).parent().siblings(".commenID").html());

        
    });  
    
    // make an edit on comment 
    
    $('#update-comments').on('click', function () {
        
        post("#comments-table-body", 'update_comment');
        
    });
    
  
    
    //  use search function to looking for (item name, decription, category, user name ) in #tabel-body
    
    $('#search-in-comments').on("keyup", function () {
        
        search($(this), $('#comments-table-body .table-row'));
        
    });
    
    
    
    
    
    
    
    
    
    
});


