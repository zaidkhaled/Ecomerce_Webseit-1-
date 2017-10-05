/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger  msg or show form before some actions in website "confirm"
    
        
     
    //ajax function it will send data from different pages to 'functionsdb.php', to processing the info , and to deal with database
        
    function post($do, $id) {

        var name  = "",
            email = "",
            pass  = "",
            oldPass = "",
            fullname = "";
        
        
        if ($id === undefined) {
            $id = "";
        }
        
        if ($do === 'insert') {
            
//            take new value from 'add form' and send them to 'functionsdb.php' and insert them into database
            
            name     = $('#add-name').val();  
            email    = $('#add-email').val();
            pass     = $('#add-pass').val();
            fullname = $('#add-fName').val();
            
        } else if ($do === "updata") {
//            take new value from 'edit form' and send them to 'functionsdb.php' and insert them into database
            
            $id      = $('#user-id').val();
            name     = $('#NewuserName').val();
            email    = $('#NewEmail').val();
            pass     = $("#NewPassword").val();
            oldPass  = $('#oldPassword').val();
            fullname = $('#NewFullName').val();
            
        }

        $.ajax({
            url  : "dbfunctions.php",
            
            type : "GET",
            
            data : {
                
                do           : $do, 
                ajxUserID    : $id, 
                ajxName      : name,
                ajxEmail     : email,
                ajxPass      : pass,
                ajxOldPass   : oldPass,
                ajxFullname  : fullname
            }
            
        }).done(function (e) { // return info from dbfunction
            
            $("#tabel-body").html(e);
            
        }).fail(function () {
            
            alert('Error');
            
        });

    }
    
    //bring table info on page laod
    $(window).on("load", function () {
        
        post();
    });
    
    
    //show add new Member Form, if user ckick add btn 
    
    $('#add-btn').on("click", function () {

        $('#add-user').modal('open');
        
    });
    
    // send now user info to database
    
    $('#info-send').on('click', function () {
        
        post("insert");
        
    });
    
//    delete user from database
    
    $("#tabel-body").on("click", ".modal-trigger", function () {
        
        $('.modal').modal();  //trigger modal in dbfunctions.php before delete user
        
        $('.modal-footer .delete').on("click", function () { //send delete request to dbfunctions.php to delete user data
         
            post('delete', $(this).attr('data-id'));
            
        });
        
    });
    
    
    function bring_old_data($id_input, $val, $target_info) {  //functoin to bring old data to edit form
        
        $($id_input).val($val.parent().siblings($target_info).text()); // target old data in "functions.php" page
        
    }
    
    
    $("#tabel-body").on("click", ".updata-btn", function () {
         
        $('#updata-form').modal('open'); //triger edit form
        
         //edit form old info
         
        bring_old_data('#user-id', $(this), '.userID'); //print user id
         
        bring_old_data('#NewuserName', $(this), '.username'); //print old user name
         
        bring_old_data('#NewEmail', $(this), '.Email'); //print old user Email 
         
        bring_old_data('#NewFullName', $(this), '.fullName'); //print old fullName
         
        bring_old_data('#oldPassword', $(this), '.oldpassword'); //print old user oldpassword
         
        //end edit form info
       
    });
    

    // call madal content "#updata-form " from 'members.php', if user is not in 'members.php' page only. it should be helpful in case that user want updata his own data. this "#updata-form" will be called just from edit button in navbar
    
    if (window.location.href.indexOf('members') < 1) {
        
        $('.edit-form-user-ssision').load('members.php #updata-form')
//                                          ,function (){
//            find('#updata-form').modal('open');
//        });
        }
    $('#updata-form').bind('click','.nav-edit2',function () {
         console.log('yes');
        $('.edit-form-user-ssision').find('#updata-form').modal('open');
    });
    
//    $('.edit-form-user-ssision').bind('load','#updata-form', function() {
//          $('.nav-edit2').on('click', function () {
//                   console.log('yes');
//                  $('.edit-form-user-ssision').find('#updata-form').modal('open');
//            });
//    })
//    
////    $(document).on("click", '.nav-edit2', function(){
        
     
    
      
            
            
           
            
//        });
//    });

     
    
    
   
    
    
    
   
    
       // send updated info to database
    
    $('#info-updata').on('click', function () {
        
        post("updata");
        
    });
  
    $("#tabel-body").on("click", "#unactivated", function () { //send userId to activate user 

        post('activate', $(this).attr('data-id'));
        
    });
     // start controll forms 
    
    
    
 /*   
   ============================================================================================================
    ===> Im Folgendem Code nutze ich das Attribute (data-value), um Edit Form und Add Form zu unterscheiden und 
    ===> die Wiederholung des Codes zu vermeiden 
   ============================================================================================================
 */
    
    // note =>> if input (data-value) = 0, then no action is required. ex (edit form)
    
      //   define important functions
    
    function showRong($rong) { // function to show the red circel, if values are not approved
    
        if ($rong.val().length < $rong.attr('limit')) { //check if values are acceptable

            $rong.siblings('span').fadeIn(1000);
            
        } else {
         
            $rong.siblings('span').fadeOut(1500);

        }
    }
    

    $('.modal-content .form input').blur(function () {
        
        if ($(this).attr("data-value") === "0") {//if this is the "edit form" then :
        
            if ($(this).val().length > 0) {//this Condition is just for (edit members form) and to know which data the user wants to update
                
                showRong($(this));
            }
            
        } else { //if this is the "Add Form" then do showRong  :
            
            showRong($(this));
        }
    });
    
    
    $(".modal-content .form").submit(function (e) {
        
        
        function msgSubmit($input) { // submit function => show the red message on submit,  just when values are not acceptable 
        
            if ($input.val().length < $input.attr('limit')) {

                e.preventDefault();

                $input.blur().siblings('.errmsg').fadeIn(1000).delay(5000).fadeOut(1000);

            }
        }
        
        
        $('.modal-content .form input').each(function () {
            
            if ($(this).attr("date-value") === "0") {
                
                if ($(this).val().length > 0) { //if this is the Edit form then :
                    
                    msgSubmit($(this));
                }
              
            } else { // if this is the Add Form then :
              
                msgSubmit($(this));
            }
            
        });
    });
    
 
    
      
});

