<?php
include_once("header.php");
include_once("model.php");
$base = new model;
@$suppliers_ary = getSuppliersName();
@$getAccount_ary = getAccountName();
function getSuppliersName(){
	$sql = "SELECT * FROM suppliers";
	$rec = mysql_query($sql);
	$s_ary = array();
	while($row = mysql_fetch_array($rec)){
		$sid = $row['sid'];
		$sname = $row['sname'];
		
		$s_ary[$sid] = $sname;
	}
	return @$s_ary;
}

function getAccountName(){
	$sql = "SELECT * FROM bank";
	$rec = mysql_query($sql);
	$acc_ary = array();
	while($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$bname = $row['bname'];
		
		$acc_ary[$id] = $bname;
	}
	return @$acc_ary;	
}
if(isset($_POST['sub'])){
	$table = "suppliers_payment";
	$insert_data = array();
	$insert_data_into_transec = array();
	$where = array();
	$update_bank_data = array();
	
	$insert_data['id']						= $_POST['id'];
	$insert_data['suppliers_id']			= $_POST['suppliers_name'];
	$insert_data['date'] 					= $_POST['dat'];
	$insert_data['payment_mode'] 			= $_POST['payment_mode'];
	$insert_data['total_payable'] 			= $_POST['total_payable'];
	$insert_data['due']						= $_POST['due'];
	$insert_data['paid_amount']				= $_POST['amt_pay'];
	
	if($_POST['payment_mode'] == 'Bank'){
		$insert_data['bank_id']				= $_POST['bank'];
		$insert_data['check_no']			= $_POST['check_number'];
		
		$insert_data_into_transec['acc_id'] 			= $_POST['bank'];
		$insert_data_into_transec['trns_date']			= date("Y-m-d");
		$insert_data_into_transec['trnsection_taka']	= $_POST['amt_pay'];
		$insert_data_into_transec['balance']			= $_POST['balance'];
		$insert_data_into_transec['prev_balance']		= $_POST['balance1'];
		$insert_data_into_transec['paid_to']			= $_POST['suppliers_name'];
		$insert_data_into_transec['trns_type']			= "DR";
		$insert_data_into_transec['id']					= $_POST['trns_incr'];
		
		$update_bank_data['balance']  					= $_POST['balance'];
		$where['id']									= $_POST['bank'];
	}
	if(isExists($_POST['id'])){
		if($base->dataInsertion($table,$insert_data)){
			if($_POST['bank'] != ''){
				$base->dataInsertion("transec",$insert_data_into_transec);
				$base->update_query("bank",$update_bank_data,$where);
			}
			echo "<table align='center'><tr><td style = 'font-family:tahoma; color:green; font-size:13px'>Transection done successfully...</td></tr></table>";	
		} else {
			echo "<table align='center'><tr><td style = 'font-family:tahoma; color:red; font-size:13px'>Transection failed...</td></tr></table>";	
		}
	} else {
		echo "<table align='center'><tr><td style = 'font-family:tahoma; color:red; font-size:13px'>Transection already exist...</td></tr></table>";	
	}
}
$inc_id = $base->incrementId("transec","id");
$incr = $base->incrementId("suppliers_payment","id");
function isExists($id){
	$sql = "SELECT * FROM suppliers_payment WHERE id = '$id'";
	$rec = mysql_query($sql);
	$numRows = mysql_num_rows($rec);
	if($numRows > 0){
		return false;
	} else {
		return true;	
	}
}
?>
<form action="suppliers_payment.php" method="post" onSubmit="return checkForm(this)">
<input type="hidden" name="balance1" id="balance1" />
<input type="hidden" name="id" id="id" value="<?php echo @$incr; ?>" />
<input type="hidden" name="trns_incr" id="trns_incr" value="<?php echo @$inc_id; ?>" />
<table><tr><td width="600" align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; text-align:center">Suppliers Payment</td></tr></table>
<table align="center" width="600" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:left" border="0" cellspacing="0">    
    <tr>
    	<td width="150">Select Suppliers</td>
        <td width="1">:</td>
        <td><select name="suppliers_name" id="suppliers_name">
			<option value="">-------------------</option>
		<?php 
			foreach($suppliers_ary as $k=>$v){
				echo "<option value='".@$k."'>".@$v."</option>";
			}
		?></select></td>
    </tr>
    <tr>
    	<td>Date</td>
        <td>:</td>
        <td><input type="text" name="dat" id="dat" value="<?php echo date("Y-m-d"); ?>" readonly/></td>
    </tr>
    
    <tr>
    	<td>Payment Mode</td>
        <td>:</td>
        <td><select name="payment_mode" id="payment_mode" onChange="getInfo()">
        	<option value="">------------</option>
            <option value="Cash">Cash</option>
            <option value="Bank">Bank</option>
        </select></td>
    </tr>
    
    <tr id="show">
    	<td>Bank Name</td>
        <td>:</td>
        <td><select name="bank" id="bank">
        	<option value="">-----------</option>
        	<?php
				foreach($getAccount_ary as $k=>$v){
					echo "<option value = '".@$k."'>".@$v."</option>";
				}
			?>
        </select></td>
    	<td width="130">Account No</td>
        <td>:</td>
        <td><input type="text" name="account_no" id="account_no" readonly style="text-align:center; font-family:Verdana, Geneva, sans-serif; color:red" /></td>
    </tr>
    
    <tr id="show1">
    	<td>Account Balance</td>
        <td>:</td>
        <td style="color:red"><input type="text" name="balance" id="balance" readonly value="0" style="width:80px; text-align:center; font-family:Verdana, Geneva, sans-serif; color:red;"/> BDT</td>
    	<td>Check Number</td>
        <td>:</td>
        <td><input type="text" name="check_number" id="check_number" /></td>
    </tr>
    
    <tr>
    	<td>Total Payable</td>
        <td>:</td>
        <td style="color:red"><input type="text" name="total_payable" id="total_payable" readonly value="0" style="width:80px; text-align:center; font-family:Verdana, Geneva, sans-serif; color:red;"/> BDT</td>
    </tr>
    
    <tr>
    	<td>Due</td>
        <td>:</td>
        <td style="color:red"><input type="text" name="due" id="due" value="0" style="font-family:Verdana, Geneva, sans-serif; color:red; text-align:center; width:80px;" readonly/> BDT</td>
    </tr>
    
    <tr>
    	<td>Amount for Pay</td>
        <td>:</td>
        <td><input type="text" name="amt_pay" id="amt_pay"/></td>
    </tr>
   
   <tr>
    	<td colspan="3"><input type="submit" name="sub" id="sub" value="Pay"/></td>
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
	#show1{
		display:none;	
	}
</style>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	function getInfo(){
		var val = document.getElementById("payment_mode").value;
		if(val == 'Bank'){
			$("#show").fadeIn(500);
			$("#show1").fadeIn(500);	
		} else {
			$("#show").fadeOut(500);
			$("#show1").fadeOut(500);	
		}
	}
	
	function checkForm(){
		var sname = document.getElementById("suppliers_name").value;
		if(sname == ''){
			alert('Select suppliers name.......');
			return false;
		}
		var payment_mode = document.getElementById("payment_mode").value;
		if(payment_mode == ''){
			alert('Select payment mode........');
			return false;
		}
		
		if(payment_mode == 'Bank'){
			var bank = document.getElementById("bank").value;
			if(bank == ''){
				alert('Select bank name.......');
				return false;
			}
			var balance = document.getElementById("balance").value;
			if(balance <= 499){
				alert('Account balance is less or equal 500 BDT......');
				return false;
			}
			var total_payable = document.getElementById("total_payable").value;
			var balance1 = document.getElementById("balance1").value;
			/*
			if(parseInt(balance1) <= parseInt(total_payable)){
				alert('Account has not enough balance...');
				return false;
			}
			*/
		}
		
		var total_payable = document.getElementById("total_payable").value;
		if(total_payable == 0){
			alert('Total payable is Zero.......');
			return false;
		}
		
		var amt_for_pay = document.getElementById("amt_pay").value;
		if(amt_for_pay == '' || amt_for_pay == 0){
			alert('Amount for pay is NULL.');
			return false;
		}
		return true;
	}
	
	$(document).ready(function(e) {
       	$("#amt_pay").attr("disabled","disabled");
		$("#payment_mode").bind('change',function(){
			if($(this).val() == 'Cash'){
				$("#amt_pay").attr("disabled",false);
			} else {
				$("#amt_pay").attr("disabled","disabled");	
			}
		});
	    $("#suppliers_name").bind('change',function(){
			if($(this).val() != ''){
				$.ajax({
					type:"POST",
					url:"suppliers_sql.php",
					data:{action:'getSary',id:$(this).val()},
					success: function(resp){
						//alert(resp);
						$("#total_payable").val(resp);
						$("#due").val(resp);
					}	
				});
			}
		});
		
		$("#bank").bind('change',function(){
			if($(this).val() != ''){
				$("#amt_pay").attr("disabled",false);
				$.ajax({
					type:"POST",
					url:"suppliers_sql.php",
					data:{action:'getBary',id:$(this).val()},
					success: function(resp){
						var val = resp.split("|");
						
						$("#balance1").val(val[0]);
						$("#balance").val(val[0]);
						$("#account_no").val(val[1]);
					}	
				});
			} else {
				$("#amt_pay").attr("disabled","disabled");	
			}
		});
		
		$("#amt_pay").bind('keyup',function(){
			var payment_mode = $("#payment_mode").val();
			var original_val = $("#total_payable").val();
			var bank_val = $("#balance1").val();
			
			var amt_pay = $(this).val();
			
			var new_val = original_val - amt_pay;
			var new_bank = bank_val - amt_pay;
			
			if(payment_mode == 'Bank'){
				if(new_bank >= 500){
					$("#due").val(new_val);
					$("#balance").val(new_bank);
				} else {
					alert('Account balance must be 500 BDT above.');
					$("#due").val(original_val);
					$("#balance").val(bank_val);
					$("#amt_pay").val(0);
				}
			} else {
				$("#due").val(new_val);
				$("#balance").val(new_bank);	
			}
		});
    });
</script>