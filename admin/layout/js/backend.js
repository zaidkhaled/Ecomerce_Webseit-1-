/*global $*/

$(function () {
    
    "use strict";
     
    
    $(".button-collapse").sideNav(); //triger sidenav for Phones
    
    $('.modal').modal(); //triger the warning Msg befor Deleting the User///////////
    
    
     // start Edit Members Form controll
    
//    =========================================================================================================
//    ===> in folgenes Code nutze ich das Attribute (data-value), um Edit Form und Add Form zu unterscheiden und 
//    ===> die wiederholung von Code damit zu vermeiden 
//    =========================================================================================================
    
    
      //   define importent functions
    
    function showRong($rong) { // function to show the red circel when the values are not approved Values
    
        if ($rong.val().length < $rong.attr('limit')) { //check if the values is acceptable

            $rong.siblings('span').fadeIn(1000);
            
        } else {
         
            $rong.siblings('span').fadeOut(1500);

        }
    }
    

    $('.container .input').blur(function () {
        
        if ($(this).attr("data-value") === "0") {//When this is the "Edit form" then :
        
            if ($(this).val().length > 0) {//this Condition just for Edit Form and to now which data, that user want to updating 
                
                showRong($(this));
            }
            
        } else { //When this is the "Add Form" then do showRong  :
            
            showRong($(this));
        }
    });
    
    
    $(".container .EditForm").submit(function (e) {
        
        
        function msgSubmit($input) { // submit function => show the red massge on submit  just when the values are not acceptable 
        
            if ($input.val().length < $input.attr('limit')) {

                e.preventDefault();

                $input.blur().siblings('.errmsg').fadeIn(1000).delay(5000).fadeOut(1000);

            }
        }
        
        
        $('.container .input').each(function () {
            
            if ($(this).attr("date-value") === "0") {
                
                if ($(this).val().length > 0) { //When this is the Edit form then :
                    
                    msgSubmit($(this));
                }
              
            } else { //When this is the Add Form then:
              
                msgSubmit($(this));
            }
            
        });
    });
    
    
      
});

