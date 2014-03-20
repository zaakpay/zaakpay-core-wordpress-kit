<?php
/*
Template Name: Zaakpay Payment Page
*/
?>
<?php get_header(); ?>
<div id="container">
<form action="http://www.yourdomain.com/posttozaakpay" method="post">
Your Email: <input name="buyerEmail" type="text" value="" />
Your First Name: <input name="buyerFirstName" type="text" value="" />
Your Last Name: <input name="buyerLastName" type="text" value="" />
Your Address : <input name="buyerAddress" type="text" value="" />
Your City: <input name="buyerCity" type="text" value="" />
Your State: <input name="buyerState" type="text" value="" />
Your Country: <input align="middle" name="buyerCountry" type="text" value="" />
Pin Code: <input align="middle" name="buyerPincode" type="text" value="" />
Your Phone No: <input align="middle" name="buyerPhoneNumber" type="text" value="" />
Amount: <input align="middle" id="amount" name="amount" type="text" value="" />
<input align="middle" onclick="submitForm();" type="submit" value="Donate Now" /> 
<input name="txnType" type="hidden" value="1" />
<input name="zpPayOption" type="hidden" value="1" /> 
<input name="mode" type="hidden" value="1" /> 
<input name="currency" type="hidden" value="INR" /> 
<input name="merchantIpAddress" type="hidden" value="184.168.224.178" /> 
<input name="purpose" type="hidden" value="1" /> 
<input name="productDescription" type="hidden" value="Donation" /> 
<input id="txnDate" name="txnDate" type="hidden" /> 
<input name="merchantIdentifier" type="hidden" value="00ab8ab860c845fe931db26f6f55bad7" /> 
<input id="orderId" name="orderId" type="hidden" /> 
<input name="returnUrl" type="hidden" value="http://www.yourdomain.com/zaakpayresponse" />
</form>
<script type="text/javascript">
	document.getElementById("orderId").value= "ZPLive" + String(new Date().getTime());	//	Autopopulating orderId
	var today = new Date();
	var dateString = String(today.getFullYear()).concat("-").concat(String(today.getMonth()+1)).concat("-").concat(String(today.getDate()));
	document.getElementById("txnDate").value= dateString;
</script>
<script type="text/javascript">
function submitForm()
{
    value = parseFloat(document.getElementById("amount").value);
    newvalue = parseInt(value*100);
    document.getElementById("amount").value=newvalue;
    return true;
}
</script>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>