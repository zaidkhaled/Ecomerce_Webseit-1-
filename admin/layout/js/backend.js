/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //trigger sidenav for phones
    
    $('.modal').modal(); //trigger the warning msg before deleting user///////////
    
    
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
    

    $('.container .input').blur(function () {
        
        if ($(this).attr("data-value") === "0") {//if this is the "edit form" then :
        
            if ($(this).val().length > 0) {//this Condition is just for (edit members form) and to know which data the user wants to update
                
                showRong($(this));
            }
            
        } else { //if this is the "Add Form" then do showRong  :
            
            showRong($(this));
        }
    });
    
    
    $(".container .form").submit(function (e) {
        
        
        function msgSubmit($input) { // submit function => show the red message on submit,  just when values are not acceptable 
        
            if ($input.val().length < $input.attr('limit')) {

                e.preventDefault();

                $input.blur().siblings('.errmsg').fadeIn(1000).delay(5000).fadeOut(1000);

            }
        }
        
        
        $('.container .input').each(function () {
            
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

