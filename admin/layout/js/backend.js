/*global $*/
/*jslint indent: 4 */
/*global plugin, data, $, i, dataLoadedEvent: true, privateLoadPic, index, container */
$(function () {
//    clearBn.on("click", function(){
//    control.replaceWith( control.val('').clone( true ) );
//});
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
     $('.carousel').carousel();
    
    $('select').material_select(); //trigger  select field
    
    
        /* <=============define impotant functions ====================> */

    
    // show the user foto functions 
    
    function fotoReader(foto) {
      
        if (foto.files && foto.files[0]) {
           
            var reader = new FileReader();
            
            reader.onloadend = function (e) {
                
                $('.img-preview').attr('src', e.target.result);
                
            };
            
            reader.readAsDataURL(foto.files[0]);
           
        } 
        
    }
    
    // prepare deleting item img array
    
    var deletingImgs = [];
    
    // if inputFile in add item form change do this 
    
    $('#imgs').on("change", function (e) {
        
        var files = e.target.files;
        
        // set how many fotos are they, if more then 8 show rong
        
        if ($(this).attr('len') > 8) {
            
            $(".file-path").addClass("invalid");
            
        } else {
            
            $(".file-path").removeClass("invalid");
        }
        
        // show all uploaded fotos in item form
        
        $.each(files, function (i, file) {  
            
            var reader = new FileReader();
        
            reader.readAsDataURL(file);
              
            reader.onload = function (e) {
                  
                var template = "<img class ='delete-img' title= 'delete' foto-name = '" + file.name + "'height='80px' width='80px' src='" + e.target.result + "'>"; 
                 
                $(".imgs-preview").append(template); // show foto
                  
            }; 
            
        });
        
        
        $(".imgs-preview  .delete-img").each(function () {
            
            $(this).remove();  
            
        });

    });
    
    // add deleting fotos to deletingImgs array and and set imgs num in inputFile attr to now if num is acceptable
    
    $(document).on('click', ".delete-img", function () {
        
        // push name of deleting foto 
        
        deletingImgs.push($(this).attr('foto-name'));
        
        $(this).remove();
        
        
        if ($(".imgs-preview .delete-img").length <= 8) {
            
            $(".file-path").removeClass("invalid");
            
            $("#imgs").attr('len', $(".imgs-preview .delete-img").length);
        } 
        
    });
    
    // show foto in add new user form 
    
    $("form .newFoto").on('change', function () {fotoReader(this);}); 
    
    
    // show foto in update form
    
    $("form .updateFoto").on('change', function () {fotoReader(this); });
    
    
    
    // prepare values for ajax 
    
    function sendData(value, $place) {
                
        var fData  = new FormData();

        if (value !== undefined) {
            
            var $do =  value.data("do"),

                $where =  value.data("place"),

                newStaus = value.attr("data-status") === "1" ? 0 : 1,

                colName  = value.attr("col-name"),

                required  = value.data("required"),

                itemID  = value.data("item");

            fData.append("ajxID", value.data('id'));
            fData.append("ajxStatus", newStaus);
            fData.append('ajxCateColName', colName);
            fData.append('ajxdata_required', required);
            fData.append('ajxItemID', itemID);
            fData.append("do", $do);

            if ($do === 'insert_user') {
                // get new values from 'add form' and send them to 'functionsdb.php' and insert them into database
                fData.append("ajxName", $("#add-name").val());
                fData.append("ajxEmail", $("#add-email").val());
                fData.append("ajxPassword1", $("#add-pass1").val());
                fData.append("ajxPassword2", $("#add-pass2").val());
                fData.append("ajxFullname", $("#add-fName").val());
                fData.append("ajxGroup", $('#select-group option:selected').val());
                fData.append("foto", $("form .newFoto")[0].files[0]);

            } else if ($do === "update_user_info") {
                // get new values from 'edit form' and send them to 'functionsdb.php' and insert them into database
                fData.append("ajxId", $('#user-id').val());
                fData.append("ajxUserName", $('#NewUserName').val());
                fData.append("ajxEmail", $('#NewEmail').val());
                fData.append("ajxPass1", $("#pass1").val());
                fData.append("ajxPass2", $("#pass2").val());
                fData.append("ajxOldPass", $('#oldPassword').val());
                fData.append("ajxFullname", $('#NewFullName').val());
                fData.append("ajxGroup", $('#select-group option:selected').val());

                if($(".updateFoto").attr("len") > 0){
                    
                   fData.append("foto", $("form .updateFoto")[0].files[0]);
                }

            } else if ($do === "insert_item" || $do === "update-item") {
                // get new values from "item add form " and send them to 'functionsdb.php' and insert them into database
                fData.append("ajxId", $('#item-id').val());
                fData.append("ajxName", $('#item-name').val());
                fData.append("ajxDescription", $('#item-descrp').val());
                fData.append("ajxPrice", $('#item-price').val());
                fData.append("ajxMadeIn", $("#made-in").val());
                fData.append("ajxTags", $("#tags").val());
                fData.append("ajxStatus", $('#select-status option:selected').val());
                fData.append("ajxUserId", $('#select-user option:selected').val());
                fData.append("ajxCateId", $('#select-cate option:selected').val());


                // send fotos just with add item form 

                if ($do === "insert_item") {

                    // len is number of imgs

                    var i = 0, len = $("#imgs").attr('len');

                    if (len > 8) {

                        alert("foto shuld not be more than 8 fotos");

                        fData.delete();

                    } else {

                        for (i; i < len; i++) {

                              // sent just imgs, which user did not delete    

                            if (deletingImgs.indexOf($("#imgs")[0].files[i].name) === -1) {

                                fData.append($("#imgs")[0].files[i].name, $("#imgs")[0].files[i]);

                            } 

                        }
                    }
                }

            } else if ($do === "insert_cate" || $do === "cate_update") { 

                // get new values from "Catogory add form " and send them to 'functionsdb.php' and insert them into database
                fData.append('ajxID', $('#cate-id').val());
                fData.append("ajxName", $('#cate-name').val());
                fData.append('ajxDescription', $('#cate-descrp').val());
                fData.append('ajxOrder', $('#cate-order').val());
                fData.append('ajxParent', $('#select-parent option:selected').val());
                fData.append('ajxVisibilty', $("#visble").is(":checked") ? 1 : 0);
                fData.append('ajxComment', $("#comment").is(":checked") ? 1 : 0);
                fData.append('ajxAds', $("#adv").is(":checked") ? 1 : 0);

            } else if ($do === "update_comment") {
                fData.append('ajxcomment', $("#update-comments-form .comment-update-field").val());
            }
            
        } else {
            var $where = $place;
            fData.append('open', $place);
            fData.append('ajxdata_required', $('#data_required').html());
            console.log($('#data_required').html()); // تجربه 
        }
        
        $.ajax({
//            url : "fm.php",
            url : "dbfunctions.php",
            type : "POST",
            data : fData,
            processData : false,
            contentType : false,
            success : function (data) {
                
                // <||> : which means there is multiple results received;
            
                if (data.indexOf("<||>") > -1) { // dealing with multiple results;
                
                // Note : This condition will only in one page (dashbaord),
                // because it have two lists, which will receive two requests at the same time, for (#last-users-list, #last-items-list)    
           
                    var res = data.split("<||>"), 
                        palace = $where.split(",");
                
                    $(palace[0]).html(res[0]);
                    $(palace[1]).html(res[1]);
                 
                } else {
                    $($where).html(data);
                }
            },
            error : function (em) {
                
                $($where).html(em + "rong");
                
            },
            
            dataType : 'html'
            
        });
        

    }
      
    $(".ajax-form").submit(function (e) {

        e.preventDefault();
         
        sendData($(this), "");
    });
    
     $(document).on("click", ".ajax-click", function () {
         
        sendData($(this), "");

        
    });
    
    /*
    onload function : this function will send ajax request on page load 
    $where : the tag id, where content shuold be placed
    */
    
    function onload($where) {
        
        $(window).on("load", function () {
            
            sendData(undefined, $where);
            
//            post($where);
        }); 
    }
    
    
/*
               <======================================================================>
     function to looking for a specific values in the table, the function will recognize data by class .search-in.
     the function will filter table INFO and return the best result
               <=======================================================================>
*/
    
        // use search function to looking for (category name and description) in #mange-cate in categories page
    
    $('.search-in').on("keyup", function () {

        search($(this));
        
    });
    
    function search($search_field) {
        
        var $search_in = $($search_field.data('search')),
        
             curr = $search_field.val(); // "search input" value
      
        
        $search_in.hide(); // first hide all data 
        
        // if user start to writing in "search field", then start data filtering and hide all useless data
        
        if (curr !== "") {
            
            $search_in.hide(); // first hide all data 
            
            $search_in.find(".search-in").each(function () { //for each elment have "search-in" class in the table  
    
                var  value =  $(this).html(); // get html value  
                
                // check if $search_field.val() exist in this row 
                          
                if (value.toUpperCase().indexOf(curr.toUpperCase()) > -1) {  
                                
                        //if yes then show all info it about it and change the background-color
                                
                    $(this).css("background-color", "red").parent($search_in).show();

                } else {
                    
                    //reset background color
                    
                    $(this).css("background-color", "");
                }
//                }   
                        
            });
               
        } else { //if there is no value in search field, then show all data in "tabel-body". and reset background color for all
            
            $search_in.show().find(".search-in").each(function () {$(this).css("background-color", ""); });
            
        } 
          
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
    else if (location.href.indexOf("statistics") > 1) { // if Current page is Items page then  
        
        onload("#statistics-table-body");

    }
    
    
    
 //         The following functoin to bring old data to edit form
    
    function bring_item_data($id_input, $val, $target_info) {  
        
        $($id_input).val($val.attr($target_info)); // target old data in "functions.php" page
        
    }      
    
        // The following functoin to bring old data to edit form
    
    function bring_old_data($id_input, $val, $target_info) {  
        
        $($id_input).val($val.attr($target_info)); // target old data in "functions.php" page
        
    }
    
/* ============================== end ajax controll on page loading ============================== */ 
    
    
/* ============================  start members and dashboard page ================================ */ 
    

     
    // the following function is for "edit btn" in dashboard page and members page because both of them have "edit btn"
    
    $("#users-table-body, #last-users-list").on("click", ".update-btn", function () {
        
        $('#update-form').modal('open'); //triger edit form
        
         //edit form old info
         
        bring_old_data('#user-id', $(this), 'data-id'); //print user id
         
        bring_old_data('#NewUserName', $(this), 'data-userNname'); //print old user name

        $(".img-preview").attr("src", "../uplaodedFiles/usersFoto/" + $(this).attr('data-foto'));
        
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
        $('#NewUserName').val($('#NewUserName').attr("session-name"));
        $('#NewEmail').val($('#NewEmail').attr("session-Email"));
        $('#NewFullName').val($('#NewFullName').attr("session-fullName"));
        $('#oldPassword').val($('#oldPassword').attr("admin-pass"));
    });
    
    // send updated info to database
    
    $(document).on('click', ".update-btn", function() {
        
        $(".edit-user").attr("data-place", $(".edit-user").data('dash'));
        
    });
    
    $('#info-update').on('click', function () {
        
        // empty password field and other inputs will be automatically chenged
        
        $('#pass').removeAttr("value");
        $('#NewPassword').removeAttr("value");
        
    });
    
     // start controll forms 
   
    
    
 
    /* =============================     end members and dashboard pages  =======================*/
    
    
    
    /* ================================  Start categories page  ================================ */

   // start categories Page 
    
    // if user click on plus btn, then open add "category form".
    
    $('#add-cate-btn').on("click", function () {
        
        $(".AddFormCate").attr("data-do", $(".AddFormCate").data('add'));
        
        $('#update-add-cate .input').each(function () { $(this).val(""); }); // reset input fields
        
        $('#update-add-cate').modal('open'); 
        
        $('#update-cate, #update-add-cate .form-title-update').hide(); // hide update btn "#update-item" and update form title
        
        $('#add-cate, #update-add-cate .form-title-add, #update-add-cate .cate-status').show(); // show send btn "#add-new-item" and add form title category status comment and visbility and ads
        
        // reset selectors inputs
        $('select').prop('selectedIndex', -1);
        $('select').material_select(); // materialze requirement
    }); 

     
    // open modal "edit category form" and insert all old data to the input fields.
    
    $('#mange-cate').on("click", "li .update-btn", function () {
        
        $(".AddFormCate").attr("data-do", $(".AddFormCate").data('update'));
        
        var parent = $(this).parent().parent("li").attr('cate-parent');
        
        $('#update-add-cate').modal('open');
        $('#update-add-cate .input').each(function () { $(this).focusin(); }); // reset input fields
        // get all old category infos and set them in the update form
        
        $('#cate-id').val($(this).parent().parent("li").attr('cate-id'));
        $('#cate-name').val($(this).parent().parent("li").attr('cate-name'));
        $('#cate-descrp').val($(this).parent().parent("li").attr('cate-descrp'));
        $('#cate-order').val($(this).parent().parent("li").attr('cate-order'));
        $("#select-parent").find("option[value ='" + parent + "']").prop("selected", true);
        $('select').material_select(); // materialze requirement

        $('#update-cate, #update-add-cate .form-title-update').show(); // show update btn "#update-item" and update form title
        $('#add-cate,#update-add-cate .form-title-add, #update-add-cate .cate-status').hide(); // hide send btn "#add-new-item" and add form title category status comment and visbility and ads
        
    });  
    
    // open "delete warning" on click of  ".delete-btn"
    
    $('#mange-cate').on("click", "li .delete-btn", function () {
        
        $('.modal').modal();
    });
    

    

    /* ==========================  End categories page =================================== */
    
    
    
    
    
    
    /* ==========================  start item page =================================== */ 
    
  
    $(document).on('click', ".item-foto", function () {

        $('.carousel').carousel();
        $('.modal').modal();
        
        $('#items-foto-slider' + $(this).data('id')).modal('open');
        
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
    
    // prepare update-add-item form to add new items, reset all inputs fields
    
    $('#add-item-btn').on("click", function () {
        
        
        $(".addItem").attr("data-do", $(".addItem").data('add'));
        
        $('.form-title-add, .files-place, .imgs-preview').show(); // sohw send btn "#add-new-item" and add form title
        
        $('.form-title-update').hide(); // hide update btn "#update-item" and update form title
        
        // empty the input fields
          
        $('#update-add-item .input').each(function () { $(this).val(""); });
        
        // reset selectors inputs
        $('select').prop('selectedIndex', -1);
        $('select').material_select(); // materialze requirement
        
        // remove all loaded fotos 
        $(".imgs-preview img").each(function () { $(this).remove(); });
    }); 
    
    
    // on click of edit item icon '.update-item-btn' then do the following orders. in items page
    
    $('#item-table-body').on('click', '.update-item-btn', function (e) {
        
        $(".addItem").attr("data-do", $(".addItem").data('update'));
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
        $("#tags").val($(this).parent().siblings(".tags").html());
      
        $('#select-user').find('option:contains("' + oldUserName + '")').prop("selected", true);
        $('#select-cate').find('option:contains("' + oldCate + '")').prop("selected", true);
        $('#select-status').find('option[value="' + oldstus + '"]').prop("selected", true);

        $('select').material_select(); // materialze requirement
        
        $('.form-title-update').show(); // show update btn "#update-item" and update form title
        
        $('.form-title-add, .files-place, .imgs-preview').hide(); // hide send btn "#add-new-item" and add form title
        
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

        // set values above into "update add item form" to edit the item 
        
        $('#select-user').find('option[value="' + oldUserName + '"]').prop("selected", true); 
        $('#select-cate').find('option[value="' + oldCate + '"]').prop("selected", true);
        $('#select-status').find('option[value="' + oldstus + '"]').prop("selected", true);

        $('#select-cate, #select-user, #select-status').material_select(); // materialze requirement
        
        $('#update-item, #update-add-item .form-title-update').show(); // show update btn "#update-item" and update form title
        $('#add-new-item, #update-add-item .form-title-add').hide(); // hide send btn "#add-new-item" and add form title

        $(".addItem").attr("data-do", $(".addItem").data('update'));
        $(".addItem").attr("data-place", "#item-table-body, #last-items-list");
  
    });
    


    
    /* ==========================  End item page =================================== */ 
    
    
    /* ==========================  Start Comments page =================================== */ 

    // open modal "edit comments form" and insert all old data to the input field.
    
    $('#comments-table-body').on("click", ".table-row td .update-comment-btn", function () {
        
        // open texteara to edit the comment 
        
        $('#update-comments-form').modal('open');
        
        // get all old comment infos and set them in the update form
        
        $("#update-comments-form .comment-update-field").val($(this).parent().siblings(".comment").html());
        $(".edit-comment").attr("data-id", $(this).parent().siblings(".commenID").html());

        
    });  
  
    
    
        
    /* ==========================  End comments page =================================== */ 
    
    
    /* ==========================  Start statitics page =================================== */
    

    
    
    
        /* ==========================  Start statitics page =================================== */
    
});


