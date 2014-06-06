<h1>Contact Us</h1>

<div id="addressArea" class="addressArea">        	
    <div class="right_container_pos" id="map-canvas"></div>           
<input type="hidden" id="address" value="W2 1RH" />
<input type="hidden" id="mapmarker" value="/images/mapmarker.png" />
    <div id="body_text">	        
        <p> Address goes here</p>
    </div>
</div> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>

<div id="contactFormArea">    
    <?php require_once CORE . '/inc/contact_form.php'; ?>    
</div>
<script>
    $(document).ready(function() {
        google.maps.event.addDomListener(window, 'load', initialize);

    });
</script>



