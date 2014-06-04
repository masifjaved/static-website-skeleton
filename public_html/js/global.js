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
     $("#submitbtn").click(function(e){
	  e.preventDefault();
	  var datastring = $("#frmContact").serialize(); 
	    $.ajax({
		type: "POST",
		url: "/misc/email.php",
		data: datastring //{name:'',address:''}
	    }).done (function(msg) {
		 $("#contact_form").html(msg);	
	    });
	   return false; 
	    }); 
});
            
            
 
