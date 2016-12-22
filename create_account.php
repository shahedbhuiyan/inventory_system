<?php
include_once("header.php");
include_once("model.php");
$base = new model;
$increment = $base->incrementId("bank","id");
if(isset($_POST['sub'])){
	$table = "bank";
	$insert_data = array();
	
	$insert_data['id']					= $_POST['ac_id'];
	$insert_data['acname']				= $_POST['ac_name'];
	$insert_data['acno']				= $_POST['ac_no'];
	$insert_data['bname']				= $_POST['bank_name'];
	$insert_data['type']				= $_POST['ac_type'];
	$insert_data['balance']				= $_POST['op_balance'];
	
	
	if(isAlreadyExists($_POST['ac_id'])){
		$status = $base->dataInsertion($table,$insert_data);
	
		if($status){
			echo "<table align='center'><tr><td style='font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Data loading successfully....</td></tr></table>";
		} else {
			echo "<table align='center'><tr><td style='font-family:verdana; font-size:12px; font-weight:bold; text-align:center; color:red'>Data loading failed....</td></tr></table>";	
		}
	} else {
		echo "<table align='center'><tr><td style='font-family:verdana; font-size:12px; font-weight:bold; text-align:center; color:red'>Data already exists....</td></tr></table>";	
	}
}
function isAlreadyExists($id){
	$sql = "SELECT * FROM bank WHERE id = '$id'";
	$rec = mysql_query($sql);
	$numRows = mysql_num_rows($rec);
	if($numRows > 0){
		return false;
	} else {
		return true;	
	}	
}
?>

<form action="create_account.php" method="post" onSubmit="return checkForm(this)">
<table align="center" style="text-align:left; font-family:Verdana, Geneva, sans-serif; font-size:11px">
	<tr>
    	<td colspan="3" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; text-align:center; font-weight:bold">Create Account</td>
    </tr>
    
    <tr>
    	<td>Account ID</td>
        <td>:</td>
        <td><input type="text" name="ac_id" id="ac_id" value="<?php echo @$increment; ?>" readonly="readonly" style="text-align:center"></td>
    </tr>
    
    <tr>
    	<td>Account Name</td>
        <td>:</td>
        <td><input type="text" name="ac_name" id="ac_name"></td>
    </tr>
    
    <tr>
    	<td>Account No</td>
        <td>:</td>
        <td><input type="text" name="ac_no" id="ac_no"></td>
    </tr>
    
    <tr>
    	<td>Account Type</td>
        <td>:</td>
        <td><select name="ac_type" id="ac_type">
        	<option value="">------------------------------</option>
            <option value="CA">Current Account</option>
            <option value="SA">Saving's Account</option>
            <option value="FD">Fixed Deposit</option>
        </select></td>
    </tr>
    
    <tr>
    	<td>Bank Name</td>
        <td>:</td>
        <td><input type="text" name="bank_name" id="bank_name"/></td>
    </tr>
    
    <tr>
    	<td>Opening Balance</td>
        <td>:</td>
        <td><input type="text" name="op_balance" id="op_balance"/></td>
    </tr>
    
    <tr>
    	<td colspan="3" align="center"><input type="submit" name="sub" id="sub" value="Save"/></td>
    </tr>
</table>
</form>

<style type="text/css">
	input,select{background-color:white}
</style>
<script type="text/javascript">
function checkForm(){
	var acname = document.getElementById("ac_name").value;
	if(acname == ''){
		alert('Account Name is null.');
		return false;
	}
	var acno = document.getElementById("ac_no").value;
	if(acno == ''){
		alert('Account No is null.');
		return false;
	}
	var actype = document.getElementById("ac_type").value;
	if(actype == ''){
		alert('Account Type is null.');
		return false;
	}
	var bname = document.getElementById("bank_name").value;
	if(bname == ''){
		alert('Bank Name is null.');
		return false;
	}
	var balance = document.getElementById("op_balance").value;
	if(balance == ''){
		alert('Opening Balance is null.');
		return false;
	}
	return true;
}
</script>
<?php
include_once("footer.php");