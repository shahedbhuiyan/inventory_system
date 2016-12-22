<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	
	if(@$_GET['data'] == 1){
		echo "<table align='center'><tr><td>Transection Successfully done..</td></tr></table>";
	}
	
	$base_process = new model();
	$lst_id = $base_process->getLastId();
	$last_invoice = $base_process->getLastInvoice($lst_id);
	
	if(isset($last_invoice)){
		$array = last_customer($last_invoice);
		$array = explode("|",$array);	
	}
	
	function last_customer($last_invoice){
		$date 	= date("Y/m/d");
		$sql 	= "SELECT * FROM voucher_list WHERE invoice_no = '$last_invoice'";
		$rec 	= mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$cust_id = $row['cust_id'];
		}
		
		$sql = "SELECT * FROM payment WHERE invoice_no = '$last_invoice'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$due = $row['due'];
		}
		
		if(isset($cust_id)){
			$sql = "SELECT * FROM customer_info WHERE cust_id = '$cust_id'";
			$rec = mysql_query($sql);
			if($row = mysql_fetch_array($rec)){
				$cname = $row['name'];
				$cid	= $row['cust_id'];
			}
			return @$cname."|".@$due."|".@$cid;
		}
	}
	
	if(isset($_POST['save'])){
		
		$update_info = array();
		$table = 'payment';
		$where = array();
		$where['invoice_no'] = $_POST['invoice_no'];
		
		$table1 = "payment_log";
		$data_insertion = array();
		
		$sql = "SELECT * FROM payment WHERE invoice_no = '".$_POST['invoice_no']."'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$paid_amt = $row['paid_amount'];
		}
		
		$update_info['due'] 		= $_POST['dues'];
		$update_info['paid_amount']	= $_POST['amt_pay'] + $paid_amt;
		$update_info['payment_mode']		= $_POST['payment_mode'];
		
		$data_insertion['due']				= $_POST['dues'];
		$data_insertion['payment']			= $_POST['amt_pay'];
		$data_insertion['invoice_no']		= $_POST['invoice_no'];
		$data_insertion['date']				= $_POST['date'];
		$data_insertion['cst_id']			= $_POST['cst_id'];
		$data_insertion['payment_mode']		= $_POST['payment_mode'];
		
		
		$status 	= $base_process->update_query($table,$update_info,$where);
		$status1 	= $base_process->dataInsertion($table1,$data_insertion); 
		
		$array = last_customer($_POST['invoice_no']);
		$array = explode("|",$array);
		
		if($status && $status1){
			?>
            <script type="text/javascript">
            	window.open('prev_invoice.php');
				self.location = 'payment.php';
            </script>
            <?php
		}	
	}
	
?>

<table height="50"></table>
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold"><tr><td>Apply Payment</td></tr></table>
<form action="payment.php" method="post" onsubmit="return checkform()">
<input type="hidden" name="cst_id" value="<?php echo @$array[2]; ?>" />
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
	<tr>
    	<td>Invoice No</td>
        <td>:</td>
        <td><input type="text" name="invoice_no" id="invoice_no" value="<?php echo @$last_invoice; ?>" style="color:red; font-family:Verdana, Geneva, sans-serif; text-align:center; font-size:12px;"/></td>
        <td>Date</td>
        <td>:</td>
        <td><input type="text" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" /></td>
    </tr>
    
    <tr>
    	<td>Customer Name</td>
        <td>:</td>
        <td><input type="text" name="cust_name" id="cust_name" value="<?php echo @$array[0]; ?>" /></td>
        <td>Payment Mode</td>
        <td>:</td>
        <td><select name="payment_mode" id="payment_mode" onchange="getInfo()">
        	<option value="">-----Select------</option>
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
        <td><input type="text" name="payable" id="payable" value="<?php echo @$array[1]; ?>" readonly="readonly" style="text-align:center; color:red;" /></td>
        <td>Dues</td>
        <td>:</td>
        <td><input type="text" name="dues" id="dues" value="<?php echo @$array[1]; ?>" readonly="readonly" style="text-align:center; color:red;"/></td>
    </tr>
    
    <tr>
    	<td>Amount for Pay</td>
        <td>:</td>
        <td><input type="text" name="amt_pay" id="amt_pay" /></td>
        <td></td>
        <td colspan="2"><input type="submit" value="Save" name="save" /></td>
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
			var due = $("#payable").val();
			
			var main_amt = due - val;
			
			$("#dues").val(main_amt);
        });
		
    });
	
	function checkform(){
		var val = document.getElementById("payment_mode").value;
		if(val == ''){
			alert('Select payment mode....');
			return false;
		}
		
		var amt_pay = document.getElementById("amt_pay").value;
		if(amt_pay == ''){
			alert('Amount for pay field is null....');
			return false;
		}
		
		var state = document.getElementById("payment_mode").value;
		if(state == 'Check'){
			var bank = document.getElementById("bank").value;
			if(bank == ''){
				alert('Bank name field null....');
				return false;
			}
		}
		return true;	
	}
</script>