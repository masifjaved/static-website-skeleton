/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
                  
    $(".slideshow").cycle({
                     
        fx:     "scrollHorz",
        pause: 1,
        speed:800,
        speedOut:1000,
        speedIn:1000,
        timout: 2000,
        pager:  '.bannerNav',
        pagerAnchorBuilder: function paginate(idx, el) {
            return '<li><a class="service' + idx + '" href="#" >&bull;</a></li>';
        }
                   
    });                
       
                
                
    jQuery('#mycarousel').jcarousel({
        // Configuration goes here
        });
                
    $(".slideshow3").colorbox({
        rel:'carouselImg', 
        slideshow:true
    });
                
    //$(".iframe").colorbox({iframe:true, innerWidth:"820px", innerHeight:"780"});                    
    $(".iframe").colorbox({
        iframe:true, 
        innerWidth:860, 
        innerHeight:780
    });                    
    
    //DD_belatedPNG.fix('.pngfix');
var validator = $('#frmContact').validate({ // initialize the plugin
	//onkeyup: false, // stop validating on key press
        rules: {
	    // you can validate using below but when you submit form again and revalidate using same captcha it will fail, as one captcha only validate onces
	    // to revalidate again you must reload and create another captcha to enter which make the whole process of validation useless
	    /*recaptcha_response_field: {
                required: true,
		remote:{
		    url:"/misc/process_recaptcha.php",
		    type:"post",
		    async:false,
		    data: {
			recaptcha_challenge_field: function() { return $('#recaptcha_challenge_field').val(); },
			recaptcha_response_field: function() { return $('#recaptcha_response_field').val(); }
		    }
		}
            },
	    */
	    
            fname: {
                required: true,
                minlength: 5
            },
            email: {
                email: true,
                required: true
            }
        },
	messages:{
	    email: {
		    required: "Please enter your email address.",
		    email: "Please enter a valid email address."
	    },
	    fname: {
		    required: "Please enter your First Name.",
		    minlength: "Please enter min 5 Character.",
	    }
	},
        submitHandler: function (form) { 
		  
		  var datastring = $("#frmContact").serialize(); 
		    $.ajax({
			type: "POST",
			url: "/misc/email.php",
			data: datastring, //{name:'',address:''}
			dataType: 'json',
		    }).done (function(msgData) {
			if(msgData.status){
			 $("#contact_form").html('<div id="response">' + msgData.msg + '</div>');	
			 } else {
			    Recaptcha.reload();
			    alert(msgData.msg);
			 }  
		    });
		    


		            //  return false; // for demo
        },
	invalidHandler: function(event, validator) {
			    Recaptcha.reload();
			    alert('Invalid Input');
	} 

		
    });

     		$("#submitbtn").click(function(e){
		  e.preventDefault();
		    if(validator.form() == true)
		    {
			$('#frmContact').submit();
		    } else {
			    //Recaptcha.reload();
		    }
		   return false; 
		 }); 
	   



});
            
            
 
