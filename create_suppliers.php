<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	include_once("header.php");
	$base_process = new model();
	
	if(isset($_POST['sub'])){
		$insert_data = array();
		$table = "suppliers";
		
		$insert_data['sid']			= $_POST['sid'];
		$insert_data['sname']		= $_POST['sname'];
		$insert_data['semail']		= $_POST['email'];
		$insert_data['scontact']	= $_POST['scontact'];
		$insert_data['saddress']	= $_POST['saddress'];
		$insert_data['contact1']	= $_POST['p_contact1'];
		$insert_data['name1']		= $_POST['p_name1'];
		$insert_data['contact2']	= $_POST['p_contact2'];
		$insert_data['name2']		= $_POST['p_name2'];
		$insert_data['contact3']	= $_POST['p_contact3'];
		$insert_data['name3']		= $_POST['p_name3'];
		
		$state = $base_process->existance_check("SELECT * FROM suppliers WHERE sid = '".$_POST['sid']."'");
		if($state == false){
			$status = $base_process->dataInsertion($table,$insert_data);
			if($status>0){
				?>
				<script type="text/javascript"> alert('Data successfully loaded.....'); </script>
				<?php
			} else {
				?>
				<script type="text/javascript"> alert('Data loading failed.....'); </script>
				<?php	
			}
		}
	}
	
	$last_id = $base_process->incrementId("suppliers","sid");
?>
<table height="50" style="vertical-align:text-top"></table>
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; vertical-align:text-top"><tr><td>New Suppliers</td></tr></table>
<form action="create_suppliers.php" method="post" onsubmit="return check_from()">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; vertical-align:text-top">
	<tr>
    	<td>Suppliers ID</td>
        <td>:</td>
        <td><input type="text" name="sid" id="sid" value="<?php echo @$last_id; ?>" style="text-align:center" readonly="readonly"></td>
    </tr>
    
    <tr>
    	<td>Suppliers Name</td>
        <td>:</td>
        <td><input type="text" name="sname" id="sname"></td>
    </tr>
    
    <tr>
    	<td>E-mail</td>
        <td>:</td>
        <td><input type="text" name="email" id="email"></td>
    </tr>
    
    <tr>
    	<td>Suppliers Contact</td>
        <td>:</td>
        <td><input type="text" name="scontact" id="scontact"></td>
    </tr>
    
    <tr>
    	<td>Suppliers Address</td>
        <td>:</td>
        <td><textarea name="saddress" id="saddress"></textarea></td>
    </tr>
    
    <tr>
    	<td>Contact Person 1</td>
        <td>:</td>
        <td><input type="text" name="p_contact1" id="p_contact1" autocomplete="off" placeholder="Only Numeric..." onkeypress="return checkNumber(event)">With Name<input type="text" name="p_name1" id="p_name1"></td>
    </tr>
    
    <tr>
    	<td>Contact Person 2</td>
        <td>:</td>
        <td><input type="text" name="p_contact2" id="p_contact2" autocomplete="off" placeholder="Only Numeric..." onkeypress="return checkNumber(event)">With Name<input type="text" name="p_name2" id="p_name2"></td>
    </tr>
    
    <tr>
    	<td>Contact Person 3</td>
        <td>:</td>
        <td><input type="text" name="p_contact3" id="p_contact3" autocomplete="off" placeholder="Only Numeric..." onkeypress="return checkNumber(event)">With Name<input type="text" name="p_name3" id="p_name3"></td>
    </tr>
    
    <tr>
    	<td colspan="3"><input type="submit" name="sub" id="sub" value="Save Record"/></td>
    </tr>
</table>
</form>
<?php
	include_once("footer.php");
?>

<script type="text/javascript">
	function check_from(){
		var sname = document.getElementById("sname").value;
		if(sname.length = 0){
			alert("Suppliers name is null....");
			return false;
		}
			
		var scontact = document.getElementById("scontact").value;
		if(scontact.length == 0){
			alert("Suppliers contact is null....");
			return false;
		}
		
		var saddress = document.getElementById("saddress").value;
		if(saddress.length == 0){
			alert("Suppliers address is null....");
			return false;
		}
		return true;
	}
	
	function checkNumber(event){
		var val = event.keyCode;
		if(val == 0) val = event.which;
		if(val>=48 && val<=57 || val == 9 || val == 8 || val == 116 || val == 37 || val == 39 || val == 32 || val == 43){
			return true;	
		}
		return false;	
	}
</script>