<?php
if ($page == "contactus")
{
    $frmtype = "Contact Us";        
}
?>

<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white'
 };
</script>

<div id="contact_form">
    <form action="" method="post" id="frmContact">
        <input type="hidden" id="frmtype" name="frmtype" value="<?php echo $frmtype; ?>" />
    <dl>
        
        <dt><label for="title">Title</label></dt>
        <dd><select name="title" id="title" >
                <option value="mr">Mr</option>
                <option value="mrs">Mrs</option>
                <option value="miss">Miss</option>                
		<option value="dr">Dr</option>
            </select>
        </dd>

        <dt><label for="fname">First Name</label></dt>
        <dd><input type="text" name="fname" id="fname" maxlength="50" size="26" placeholder="First Name" class="textfield" required /></dd>

        <dt><label for="lname">Last Name</label></dt>
        <dd><input type="text" name="lname" id="lname" maxlength="50" size="26" placeholder="Last Name" class="textfield" /></dd>

        <dt><label for="email">Email</label></dt>
        <dd><input type="email" name="email" id="email" maxlength="150" size="26" placeholder="Email Address" class="textfield" required /></dd>        

        <dt><label for="">Telephone</label></dt>
        <dd><input type="tel" name="telephone" id="telephone" maxlength="20" size="26" placeholder="Telephone Number" class="textfield" /></dd>        

        <dt><label for="">Description</label></dt>
        <dd><textarea name="description" id="description" rows="5" cols="43" placeholder="Message Description" ></textarea></dd>        
            <dd><?php 
                require_once(CORE . '/inc/recaptchalib.php');
                $publickey = "6LfiwPQSAAAAAPcPbKE5oORXD0M6xoyXTBfs4u3o"; 
                echo recaptcha_get_html($publickey);
            ?></dd>        
        <dt><label for="">&nbsp;</label></dt>
        <dd id="submitBtnCon">
            <a href="#" name="submitbtn" id="submitbtn" ><span><img src="/images/btn-submit.jpg" alt="Submit" title="Submit" /></span></a>
         </dd>        
                
    </dl>
    </form>
        
</div>
