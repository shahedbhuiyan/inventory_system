<?php
include_once("model.php");
$base = new model;
if(isset($_GET['inv'])){
	$sql = "SELECT * FROM payment WHERE invoice_no = '".$_GET['inv']."'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$invoice = $row['invoice_no'];
		$payable = $row['payable_amount'];
		$due = $row['due'];
		$paid_amount = $row['paid_amount'];
	}
}
$status = 0;
if(isset($_POST['sub'])){
	$invoice = $_POST['invoice'];
	$amt_pay = $_POST['amt_pay'];
	$due = $_POST['due'];
	
	$sql = "UPDATE payment SET due = '$due', paid_amount = '$amt_pay' WHERE invoice_no = '$invoice'";
	mysql_query($sql);
	
	$status = (boolean)update_payment_log($invoice,$amt_pay,$due);
	
	if((mysql_affected_rows() == 1)&& $status){
	?>
    <script type="text/javascript">
    	alert("Update Sucessfully.......");
		self.close();
		top.window.opener.location.reload();
    </script>
    <?php
	} else {
	?>
    <script type="text/javascript">
    	alert("Update Failed.......");
		self.close();
		top.window.opener.location.reload();
    </script>
    <?php	
	}
}

function update_payment_log($inv,$amt_pay,$due){
	$sql = "UPDATE payment_log SET payment = '$amt_pay', due = '$due' WHERE invoice_no = '$inv' AND date = '".date("Y-m-d")."'";
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		return true;
	} else {
		return false;	
	}
}
?>
<table><tr><td height="10"></td></tr></table>
<form action="edit_payment.php" method="post">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:left">
	<tr><td colspan="3" align="center" style="font-size:13px; font-weight:bold">Edit Payment</td></tr>
    <tr>
    	<td>Invoice No</td>
        <td>:</td>
        <td><input type="text" name="invoice" id="invoice" value="<?php echo @$invoice; ?>" readonly ></td>
    </tr>
    
    <tr>
    	<td>Payable Amount</td>
        <td>:</td>
        <td><input type="text" name="payable_amount" id="payable_amount" value="<?php echo @$payable; ?>" readonly/></td>
    </tr>
    
    <tr>
    	<td>Due</td>
        <td>:</td>
        <td><input type="text" name="due" id="due" value="<?php echo @$due; ?>" readonly/></td>
    </tr>
    
    <tr>
    	<td>Amount for Pay</td>
        <td>:</td>
        <td><input type="text" name="amt_pay" autocomplete="off" id="amt_pay" ></td>
    </tr>
    
    <tr><td colspan="3" align="center"><input type="submit" name="sub" id="sub" value="Update"/></td></tr>
</table>
</form>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		var payable = 0;
		var amt_pay = 0;
		var new_val = 0;
        $("#amt_pay").bind('keyup',function(){
			payable = $("#payable_amount").val();
			amt_pay = $(this).val();
			
			new_val = payable - amt_pay;
			$("#due").val(new_val);	
		});
    });	
</script>
