/*global $*/

$(function () {
    
    "use strict";
     
    $('#select-user').material_select(); //trigger  select field
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
    $('.carousel').carousel(); // trigger carousel "Slider"
    
    // Hide sideNav
//    $('.button-collapse').sideNav('hide');
    // Destroy sideNav
//    $('.button-collapse').sideNav('destroy');
    
    // <=============define impotant functions ====================> 

                
    
  // ajax function
    
    function post(value) {
        
        var fData = new FormData(),
            
            $where = value.data("place"),
            
            $do = value.data("do"),
        
            $id = value.data("id");
        
        fData.append("ajxdo", $do);
        
        fData.append("ajxID", $id);

        
        if ($do === "update-user-info") {
            
            fData.append("ajxName", $("#update-name").val());
            fData.append("ajxEmail", $("#update-email").val());
            fData.append("ajxFname", $("#update-fName").val());
            
        } else if ($do === "change_pass") {
            
            fData.append("ajxPass1", $("#pass1").val());   
            fData.append("ajxPass2", $("#pass2").val());   
            $('.password-fields').slideUp();
            
        } else if ($do === "insert_item" || $do === "edit_item") {

//            $('.progress').show(300);
            
            // get new values from "item add form " and send them to 'functionsdb.php' and insert them into database
            fData.append("ajxName", $('#item-name').val());
            fData.append("ajxDescription", $('#item-descrp').val());
            fData.append("ajxPrice", $('#item-price').val());
            fData.append("ajxItemNum", $('#item-price').val());
            fData.append("ajxMadeIn", $("#made-in").val());
            fData.append("ajxTags", $("#tags").val());
            fData.append("ajxStatus", $('#select-status option:selected').val());
            fData.append("ajxCateId", $('#select-cate option:selected').val());
            
            // send fotos just with add item form 

            if ($do === "insert_item") {

                // len is number of imgs

                if ($("#item-main-img").attr("len") > 0) {

                    fData.append("main_foto", $("#item-main-img")[0].files[0]);

                }

                var i = 0, len = $("#items-fotos").attr('len');

                if (len > 7) {

                    alert("foto shuld not be more than 8 fotos");

                    fData.delete();

                } else {

                    var progressWidth = parseInt($(".progress").css('width')),

                        part = progressWidth / len;

                    for (i; i < len; i++) {


                        var nameOfFoto = $("#items-fotos")[0].files[i].name,

                            value = i + 1;

                        $(".progress .determinate").css("width", (value * part) + "px");

                        // sent just imgs, which user did not delete    

                        if (deletingImgs.indexOf(nameOfFoto) === -1) {

                            fData.append(nameOfFoto, $("#items-fotos")[0].files[i]);

                        } 

                    }
                }
            }
            

            //  empty inputs after ajax call
            
            $(".progress .determinate").css("width", "0px");
            
            $("#main-item-foto .user-foto").remove();
            
            $("form .items-fotos-preview .delete-img").each(function () { $(this).remove(); });
            
            $('.addItemForm .input, #item-descrp').each(function () { $(this).val(""); });

            // reset selectors inputs
       
            $('select').prop('selectedIndex', -1);

            $('select').material_select(); // materialze requirement
                     
             $('.addItemForm').slideUp();   

          
        } else if ($do === "add_comment" || $do === "update_comment") {
                          
            fData.append("ajxComment", $("#item-comment").val()); 
            
            fData.append("ajxID", $("#item-id").val()); 
            
            fData.append("ajxCommentID", $("#comment-id").val());
            
            fData.append("ajxOwnerID", $("#owner-id").val()); 
            
            // $("#item-comment").val("");
            
        
            
        } else if ($do === "check_foto" || $do === "change_user_foto") {
    
            
            if ($("#user-img").attr("len") > 0) {
                   
                fData.append("foto", $("#user-img")[0].files[0]);
                
            } else {
                    
                fData.delete();
            }

            
        }else if ($do === "add_money") {
            
           fData.append("ajxAddedMoney", $("#added-money").val()); 
            
           $("#added-amount").val('');    
            
        } else if ($do === "buy_item") {
               
            fData.append("ajxItemPrice", $("#item-price").val()); 
            
            fData.append("ajxNumsItem", $("#nums-item").val()); 
            
            fData.append("ajxOwnerId", $("#owner-id").val()); 
            
        } else if ($do === 'search') {
            
            if ($(".search-nav").val().length > 2) { 
                
            fData.append("ajxSearchInput", $(".search-nav").val()); 
                
            } else {
                
                fData.append("ajxSearchInput", $("#search-nav-sm").val()); 
                
            }
            
        }
       
        

        $.ajax({
            
            url : "dbfunctions.php",
//            url : "fm.php",
            
            type : "POST",
            
            data : fData,
            
            processData : false,
            
            contentType : false
            
        }).done(function (e) {
           
            $($where).html(e);
//            $("#rst").html(e);
            
        }).fail(function () {
            
            alert("fail fail");
            
        });
        
    }
   
   
    // nontifications function 
    
    function ajax_check($do) {
        
        $.ajax({
            url      : "dbfunctions.php",
            method   : "POST",
            data     : {ajxdo : $do},
            dataType : "json",
            success  : function (data) {
                
                $("#notif").html(data.notif);
                
                if (data.unseen_notif > 0) {
                 
                    $("<span id = 'notif_new'>" + data.unseen_notif + "</span>").insertBefore("#notification .events");
                } 
            }
        });
        
    }
    
    // run ajax_check function with parameter do = seen 
    
    $('#notif-icon').click(function() {
         ajax_check('seen');
         $('#notif_new').remove();
        
    });
    
    // check nontifications every 3 second
    
    setInterval(function() {ajax_check("check_notif");}, 3000);
    
    // if user has been logged sent Last activate time every 5 second
    
    if ($("#logout").length > 0){

        setInterval(function(){ajax_check("Last_activated");}, 5000);
    }

    
    
    // run  post function to sent ajax request
    
    $(document).on("click", ".ajax-click", function () {
    
        post($(this));
        
    });
    
    // run  post function to sent ajax request
    
    $(document).on("submit", ".ajax-form", function (e) {
        e.preventDefault();
        post($(this));
        
    });
    
    $("#select-lang").change(function () {
        $("#lang-form").submit();
    });
    

    
 // run files reder on input File change  
    
    $('#items-fotos').on("change", function (e) {
        
        var  files = e.target.files;
        
        // set how many fotos are they, if more then 8 show rong
        
        if ($(this).attr('len') > 7) {
            
            $("#input-fotos-path").addClass("invalid");
            $("form .items-fotos-preview").addClass("preview-fotos");
            
            
        } else {
           
            $("input-fotos-path").removeClass("invalid");
            $("form .items-fotos-preview").removeClass("preview-fotos");
        }
        
        $("form .items-fotos-preview .delete-img").each(function () { $(this).remove(); });
        $("form .items-fotos-preview h5 ").remove();
        
        // show all uploaded fotos in item form
        
        $.each(files, function (i, file) {  
         
            var reader = new FileReader();
        
            reader.readAsDataURL(file);
              
            reader.onload = function (e) {
               
                var template = "<img class ='delete-img' title= 'delete' foto-name = '" + file.name + "' style='width:85px;height:95px;' src='" + e.target.result + "'>"; 
                 
                $("form .items-fotos-preview").append(template); // show foto
                  
            }; 
            
        });

    });
    
    
    
    $('.nav-click-show').on("click", function () {
        $($(this).data('hide')).hide(10);
        $($(this).data('show')).toggle(500);
        
    });
    
    $("#search-icon").on('click', function() {
         $('.search-nav').show().animate({
             display : "block",
             width : "60%"
         }, 500);
    });
    
    $("#search-icon-sm").on('click', function(){
         $('#search-nav-sm').slideToggle().focos();
    });
    
    
       
   $(".search-nav, #search-nav-sm ").on('keyup', function() {
       
        if($(this).val().length > 1){
            
            $($(this).data('show')).show();
            
            post($(this));
            
            $(".search-nav .search-box a, #search-nav-sm .search-box-sm a").remove();
            
        } else {
            
            $($(this).data('show')).hide();
            
        }

   });
    

    // prepare deleting item img array
    
    var deletingImgs = [];
    
    // add deleted fotos to deletingImgs array and and set imgs num in inputFile attr to now if num is acceptable
    
    $(document).on('click', "form .items-fotos-preview .delete-img", function () {
        
        // push name of deleting foto 
        
        deletingImgs.push($(this).attr('foto-name'));
        
        $(this).remove();
        
        
        if ($(".imgs-preview .delete-img").length <= 7) {
            
            $(".file-path").removeClass("invalid");
            
            $("#imgs").attr('len', $(".imgs-preview .delete-img").length);
            $("form .items-fotos-preview").removeClass("preview-fotos");
        } 
        
    });
    
    
    // show the user foto functions 
    
    function fotoReader(foto) {
        
        var previewPlace = foto.getAttribute("preview"),
            
            removeContent = foto.getAttribute("remove");
        
        
        if (foto.files && foto.files[0]) {
            
            var reader = new FileReader();
            
            reader.onloadend = function (e) {
                
                var template = "<img class ='user-foto responsive-img' style='width:120px;height:144px;'  foto-name = '' src='" + e.target.result + "'>";
                
                $(removeContent).remove();
                
                $(previewPlace).append(template); // show foto

            };
            
            reader.readAsDataURL(foto.files[0]);
           
        } 
        
    }

    // show foto in add new user form 
   

    $("form .user-img").on('change', function () {fotoReader(this); post($(this)); }); 
    $(".item-main-img").on('change', function () {fotoReader(this); }); 
    
    
    
                     // <============= start login page ====================> 
    

    // show login input if user click on login in logReg page and show register form when user ckick on 
    
    $('.form-title').each(function () {
        
        $(this).on("click", function () {
            
            $(this).addClass('title-selected').siblings().removeClass('title-selected');

            $($(this).data('title')).addClass("selected").siblings("form").removeClass('selected');
        });
        
    });

//    start navbar
    $(".cate-menu").on("mouseover", function () {
        $(this).dropdown({ hover: false });
    });
    
//    end navbar

    
       // <============= end login Register page ====================> 
    
    
    
    
     // <============= start profile page ====================> 
    
    
    
     $("#mobile-dimo").on("click", function () {
        // Hide sideNav
//        $('.button-collapse').sideNav('hide');
         console.log('jj');
         $('.button-collapse').sideNav('destroy');
     })      
    
    // show  item comment when user click on item name 
    
    $(".item-name").on('click', function () {
       
        $(this).siblings(".items-comment").slideToggle();
    });
    
      

    
    
    // slideToggel the password fields when user click on password-change
    
    $(".password-change").on('click', function () {
        
        $('.password-fields').slideToggle();
    });
    
    
    
    // slideToggel for add new item form in profile page 
    $('#add-item-btn').on('click', function () {
       
        $('.addItemForm').slideToggle();
    });
    

    
    // <============= End profile page ====================> 
    
    
    // <============= start item  page ====================> 
    
    
    // condition to make edit on item directly after page load
    
    if (location.href.indexOf("item") > -1 && location.href.indexOf("edit") > -1) {
        
        // check if update-btn already exist, which means this item belongs to this user 
        
        if ($(".details .update-btn").length > 0) {

            $(".details .update-btn").click();
        }
        
    }
    
    
    $('#plus-comment-btn').on("click", function () {
        
        $('#add-comment-title').show();
        
        $('#update-comment-title').hide();
        
        $("#add-comment-form").attr("data-do", $("#add-comment-form").attr("data-addComment"));
        
        if ($(this).val().length < 2) {

            $("#add-comment-btn").attr("disabled", "true");
            
        }
        
    });
    
    $('#item-comment').on('keyup', function () {
        
        if ($(this).val().length > 0) {
           
            
            $("#add-comment-btn").removeAttr("disabled");
            
        } else {
            
            $("#add-comment-btn").attr("disabled", "true");
        }
    });
    
    
    $(document).on("click", ".comment-controller i", function() {
        
        $('#add-comment-title').hide();
        
        $('#update-comment-title').show();
        
        $("#add-comment-form").attr("data-do", $("#add-comment-form").attr("data-updateComment"));
        
        $("#comment-id").val($(this).data('id'));
        
        $("#item-comment").val($(this).parent().siblings(".comment").html());
        
    });
                   // <============= end item  page ====================> 
    
                  // <============= public style  ====================>
    
    

});  //ende


