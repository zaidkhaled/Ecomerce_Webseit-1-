/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
        
     
    //ajax function it will send data from different pages to 'functionsdb.php', to processing the info , and to deal with database
        
    function post($where, $do, $id, $cateColNmae, $stus, $pending) {

        var name  = "",
            email = "",
            pass  = "",
            oldPass = "",
            fullname = "",
            CateName = "",
            Description = "",
            Order = "",
            Visibilty = "",
            Comment = "",
            Ads = "",
            VisbilityStatus = "",
            CommentStatus = "",
            AdsStatus = "",
            cateNewName = "",
            cateNewDescrp = "",
            cateNewOrder = "";
        


        
        if ($id === undefined) {
            $id = "";
        }
        
        //if "pending members" request is exist then retuen just pending members in table body
        
        $pending = $('#query').html();
        
        if ($do === 'insert') {
            // get new values from 'add form' and send them to 'functionsdb.php' and insert them into database
            name     = $('#add-name').val();  
            email    = $('#add-email').val();
            pass     = $('#add-pass').val();
            fullname = $('#add-fName').val();
            
        } else if ($do === "updata") {
            // get new values from 'edit form' and send them to 'functionsdb.php' and insert them into database
            $id      = $('#user-id').val();
            name     = $('#NewuserName').val();
            email    = $('#NewEmail').val();
            pass     = $("#NewPassword").val();
            oldPass  = $('#oldPassword').val();
            fullname = $('#NewFullName').val();
            
        } else if ($do === "insert_cate") { 
           // get new values from "Catogory add form " and send them to 'functionsdb.php' and insert them into database
            CateName    = $('#cate-name').val();
            Description = $('#cate-descrp').val();
            Order       = $('#cate-order').val();
            Visibilty   = $("#visble").is(":checked") ? 1 : 0;
            Comment     = $("#comment").is(":checked") ? 1 : 0;
            Ads         = $("#adv").is(":checked") ? 1 : 0;

        } else if ($do === "cate_updata") { 
        // get new values from "Catogory updata form " and send them to 'functionsdb.php' and insert them into database
            $id           = $('#cate-id').val();    
            cateNewName   = $('#new-cate-name').val();
            cateNewDescrp = $('#new-cate-descrp').val();
            cateNewOrder  = $('#new-cate-order').val();
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
                ajxpending      : $pending,
                ajxCateName     : CateName,  
                ajxDescription  : Description,
                ajxOrder        : Order,
                ajxVisibilty    : Visibilty,
                ajxAds          : Ads,
                ajxCateColName  : $cateColNmae,
                ajxStatus       : $stus,
                ajxComment      : Comment,
                ajxNewCateName  : cateNewName,
                ajxNewDescrp    : cateNewDescrp,
                ajxNewOrder     : cateNewOrder,
            }





            
        }).done(function (e) { // return info from dbfunction
            
            $($where).html(e);
            
        }).fail(function () {
            
            alert('Error');
            
        });

    }
    
 /* ===================== start ajax controll on page loading =========================== */ 
    
    
    // At beginning i will target in which page should be ajax request sended on page loading
    
    if (location.href.indexOf("members") > 1) { // if Current page is members then 
        
        
        $(window).on("load", function () {

            post("#tabel-body");
            
        });
        
    } else if (location.href.indexOf("dashboard") > 1) { // if Current page is dashboard then 
        
        $(window).on("load", function () {

            post("#last-user-list");
        });
        
        
    } else if (location.href.indexOf("categories") > 1) {
        
        $(window).on("load", function () {

            post("#mange-cate");
            
        });
    }
    
/* ============================== end ajax controll on page loading ============================== */ 
    
    
/* ============================  start members and dashboard page ================================ */ 
    
    //show add new Member Form, if user ckick add btn 
    
    $('#add-btn').on("click", function () {

        $('#add-user').modal('open');
        
    });
    
    // send now user info to database
    
    $('#info-send').on('click', function () {
        
        post("#tabel-body", "insert");
        
    });
    
//    delete user from database
    
    $("#tabel-body").on("click", ".modal-trigger", function () {
        
        $('.modal').modal();  //trigger modal in dbfunctions.php before delete user
        
        $('.modal-footer .delete').on("click", function () { //send delete request to dbfunctions.php to delete user data
         
            post("#tabel-body", 'delete', $(this).attr('data-id'));
            
        });
        
    });
    
    // The following functoin to bring old data to edit form
    
    function bring_old_data($id_input, $val, $target_info) {  
        
        $($id_input).val($val.attr($target_info)); // target old data in "functions.php" page
        
    }
    
     
    // the following function is for "edit btn" in dashboard page and members page because both of them have "edit btn"
    
    $("#tabel-body, #last-user-list").on("click", ".updata-btn", function () {
         
        $('#updata-form').modal('open'); //triger edit form
        
         //edit form old info
         
        bring_old_data('#user-id', $(this), 'data-id'); //print user id
         
        bring_old_data('#NewuserName', $(this), 'data-userNname'); //print old user name
         
        bring_old_data('#NewEmail', $(this), 'data-email'); //print old user Email 
         
        bring_old_data('#NewFullName', $(this), 'data-fullName'); //print old fullName
         
        bring_old_data('#oldPassword', $(this), 'data-oldPass'); //print old user oldpassword
         
        //end edit form info
       
    });
 
    // edit button from "Edit form"
    $('.edit-button').on('click', function () {
        
        $('#updata-form').modal('open');
        
        // set session info, to edit form ("in nav bar").on click of edit button in navbar."edit just personal data"
        $('#user-id').val($('#user-id').attr('session-id'));
        $('#NewuserName').val($('#NewuserName').attr("session-name"));
        $('#NewEmail').val($('#NewEmail').attr("session-Email"));
        $('#NewFullName').val($('#NewFullName').attr("session-fullName"));
        $('#oldPassword').val($('#oldPassword').attr("value"));
    });
    
       // send updated info to database
    
    $('#info-updata').on('click', function () {
        
        post("#tabel-body, #last-user-list", "updata");
        
        // empty password field and other inputs will be automatically chenged
        
        $('#pass').removeAttr("value");
        $('#NewPassword').removeAttr("value");
        
    });
    
   // the following function is for "edit btn" in dashboard page and members page because both of them have "activate btn"
    
    $("#tabel-body, #last-user-list").on("click", "#unactivated", function () { //send userId to activate user 

        post("#tabel-body ,#last-user-list", 'activate', $(this).attr('data-id'));
        
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
    
    
    /*
               <======================================================================>
     function to looking for a specific values in database, the function will recognize data by ($elm_class1, $elm_class2, $elm_class3)
     admin have just to write one of them in search input, after that the function will filter INFO and return the best result
               <=======================================================================>
    */
    
    
    
    function search($search_field, $parent_elm, $elm_class1, $elm_class2, $elm_class3) {
        
        var curr = $search_field.val(); // "search input" value
        
        $parent_elm.hide(); // first hide all data 
        
        // if user start writing in "search input", then start data filtering and hide all useless data
         
        if (curr !== "") {
            
            $parent_elm.each(function () { // for each "$elm_class.html()" in database 
                   
                var search_array  = [],
                    value1    = $(this).find($elm_class1).html(), // bring name value 
                    value2    = $(this).find($elm_class2).html(), //  bring user email vlaue
                    elem; 
                
                 //make an 'array' for eech #elm_class data
                
                search_array.push(value1, value2);
                
                if ($elm_class3 !== undefined) { // if there is a elm_class3 (third param), then insert into search_array
                    
                    var value3 = $(this).find($elm_class3).html();  // bring fullName value
                    
                    search_array.push(value3);  
                }
                
                // make a loop in array each "$elm_class" data 
                console.log(search_array);
                for (elem in search_array) {   
                    
            //search in this array and find out if searched value is one of "$elm_class". search will be insenstive for Capital and small letters 
                    
                    if (search_array[elem].toUpperCase().indexOf(curr.toUpperCase()) > 0) {  
                        
                        //if yes then show all info it about it "show all row from databse"
                           
                        $(this).show();

                    }
                }
            });
               
        } else { //if there is no value in search input, then show all data in "tabel-body".
            
            $parent_elm.show();
            
        }
          
    };
    
    
    $('#search-user-info').on("keyup", function () {
        
        //  use search function to looking for (.username .Email .fullName) in #tabel-body
        
        search($(this), $('#tabel-body .table-row'), ".username", ".Email", ".fullName");
        
    });
    
    
    /* =============================     end members and dashboard pages  =======================*/
    
    
    
    /* ================================  Start categories page  ================================ */
      
   // start categories Page 
    
    // if user click on plus btn, then open add "category form".
    
    $('#add-cate-btn').on("click", function () {
        $('#new-cate-name').removeAttr("value");
        $('#new-cate-descrp').removeAttr("value");
        $('#new-cate-order').removeAttr("value");
        $('#add-cate').modal('open');
    }); 
    
    
    
    // if user ckick on OK in add "category form", then send new data by ajax to "dbfunctions.php".
    
    $('#info-cate-send').on('click', function () {
    
        post("#mange-cate", "insert_cate");
        
        // remove old values in "add catrgory form", after ajax request, to be ready for next time
        
    }); 
       
    // the fallowing function is for (Visbility, Allow_Comment, Allow_Ads) (0 or 1)? || to send (onClick) the opposite value by ajax to make fast edit on it 
    
    $('#mange-cate').on("click", "li span", function () {
        
        var newStaus = $(this).attr("data-status") === "1" ? 0 : 1,
            colName  = $(this).attr("col-name"),
            cate_id  = $(this).parent().parent().attr("cate-id");
          
        post("#mange-cate", "change_cate_status", cate_id, colName, newStaus);
    });    
     
    
    $('#mange-cate').on("click", "li .updata-btn", function () {
        
        $('#updata-cate').modal('open');
        
        $('#cate-id').val($(this).parent().parent("li").attr('cate-id'));
        $('#new-cate-name').val($(this).parent().parent("li").attr('cate-name'));
        $('#new-cate-descrp').val($(this).parent().parent("li").attr('cate-descrp'));
        $('#new-cate-order').val($(this).parent().parent("li").attr('cate-order'));
        
    });  
    
    
    $('#mange-cate').on("click", "li .delete-btn", function () {
        
        $('.modal').modal();
    });
    
    $("#updata-cate-info").on('click', function () {
        
        post('#mange-cate', "cate_updata");
        
    });
    
    
    $('#mange-cate').on("click", "#delete-cate", function () {
      
        var cateID = $(this).attr("data-id");
        
        post('#mange-cate', 'cate_delete', cateID);
    });
    
    
    
    
    
//    $('#mange-cate').on("click", "li", function () {
//          
//      $(this).children(".cate-controll, .cate-details").addClass("cate-active");
//        
//    });
    
//    $('#mange-cate').on("click", "li .close-btn", function () {
//          console.log('yes');
//      $(this).parent().siblings('.cate-details').removeClass("cate-active");
//        
//    });
    
    $('#search-cate-info').on("keyup", function () {
        
        //  use search function to looking for (.username .Email .fullName) in #tabel-body
         
        search($(this), $('#mange-cate li'), ".cate-name", ".descrp");
        
    });
    /* ==========================  End categories page =================================== */
        
});

