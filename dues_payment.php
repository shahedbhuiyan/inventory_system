<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	$base_process = new model();
		
	if(isset($_POST['pay'])){
		$insert_data = array();
		$update_info = array();
		
		$table1 = "payment_log";
		$table = 'payment';
		$where = array();
		$where['invoice_no'] = $_POST['invoice_no'];
		
		$sql = "SELECT * FROM payment WHERE invoice_no = '".$_POST['invoice_no']."'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$paid_amt = $row['paid_amount'];
		}
		
		$update_info['due'] 		= $_POST['due'];
		$update_info['paid_amount']	= $_POST['amt_pay'] + $paid_amt;
		
		$insert_data['invoice_no'] 	= $_POST['invoice_no'];
		$insert_data['payment']		= $_POST['amt_pay'];
		$insert_data['due']			= $_POST['due'];
		$insert_data['payment_mode']= $_POST['payment_mode'];
		$insert_data['cst_id']		= $_POST['cust_id'];
		$insert_data['date']		= date("Y-m-d");
		
		$status = $base_process->update_query($table,$update_info,$where);
		$base_process->dataInsertion($table1,$insert_data);
		if($status){
			echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px'>Data loading successfully</td></tr></table>";
		}
	}
?>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/auto_suggestion_1.js"></script>
<link rel="stylesheet" type="text/css" href="css/auto_suggestion.css" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#invoice_no").UISugestion();
    });
			
</script>
<table height="50"></table>
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold"><tr><td>Apply Due Payment</td></tr></table>
<form action="dues_payment.php" method="post" onSubmit="return checkForm()">
<input type="hidden" name="cust_id" id="cust_id" />
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
	<tr>
    	<td>Invoice No</td>
        <td>:</td>
        <td><input type="text" autocomplete="off" name="invoice_no" id="invoice_no" /></td>
    	<td>Date</td>
        <td>:</td>
        <td><input type="text" name="date" id="date" value="<?php echo date("Y/m/d"); ?>" readonly="readonly" /></td>
    </tr>
    
    <tr>
    	<td>Customer Name</td>
        <td>:</td>
        <td><input type="text" name="cname" id="cname" readonly="readonly" /></td>
        <td>Payment Mode</td>
        <td>:</td>
        <td><select name="payment_mode" id="payment_mode" onchange="getInfo()">
        	<option value="">-----Select-----</option>
            <option value="Cash">Cash</option>
            <option value="Check">Check</option>
        </select></td>
    </tr>
    
    <tr id="show">
    	<td>Bank Name</td>
        <td>:</td>
        <td><input type="text" name="bank" id="bank" /></td>
    	<td>Check Number</td>
        <td>:</td>
        <td><input type="text" name="check_number" id="check_number" /></td>
    </tr>
    
    <tr>
    	<td>Payable Amount</td>
        <td>:</td>
        <td><input type="text" name="payable_amount" id="payable_amount" readonly="readonly" /></td>
        <td>Due</td>
        <td>:</td>
        <td><input type="text" name="due" id="due" readonly="readonly" /></td>
    </tr>
    
    <tr>
    	<td>Amount for pay</td>
        <td>:</td>
        <td><input type="text" name="amt_pay" id="amt_pay" /></td>
        <td></td>
        <td colspan="2"><input type="submit" value="Pay" name="pay" /></td>
    </tr>
</table>
</form>
<?php
	include_once("footer.php");
?>
<style type="text/css">
	#show{
		display:none;	
	}
</style>
<script type="text/javascript">
	function getInfo(){
		var val = document.getElementById("payment_mode").value;
		if(val == 'Check'){
			$("#show").fadeIn(500);	
		} else {
			$("#show").fadeOut(500);	
		}
	}
	$(document).ready(function(e) {
        $("#amt_pay").bind('keyup',function(e) {
            var val = $(this).val();
			var due = $("#payable_amount").val();
			
			var main_amt = due - val;

			$("#due").val(main_amt);
        });
		
    });
	
	function checkForm(){
		var invoice = document.getElementById("invoice_no").value;
		if(invoice == ''){
			alert("Invoice Field is Null...");
			return false;
		}
		
		var payment_mode = document.getElementById("payment_mode").value;
		if(payment_mode == ''){
			alert("Payment Mode is Null....");
			return false;
		}
		
		if(payment_mode == 'Check'){
			var bank = document.getElementById("bank").value;
			if(bank == ''){
				alert("Bank Field is Null....");
				return false;
			}
			var check_no = document.getElementById("check_number").value;
			if(check_no == ''){
				alert("Check Number Field is Null....");
				return false;
			}
		}
		
		var payable = document.getElementById("payable_amount").value;
		if(payable == 0){
			alert("Payable is Null");
			return false;
		}
		
		var amt_pay = document.getElementById("amt_pay").value;
		if(amt_pay == ''){
			alert("Amount for pay Field is Null....");
			return false;
		}
		return true;	
	}
</script>