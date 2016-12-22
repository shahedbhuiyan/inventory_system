<?php
	if(!session_id()) session_start();
	if((!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	//echo $_SESSION['sesUserType'];
	include_once("header.php");
	include_once("model.php");
	$base = new model;
	$emp_ary = getArray();
	function getArray(){
		$sql = "SELECT * FROM employee_info";
		$rec = mysql_query($sql);
		$emp_ary = array();
		while($row = mysql_fetch_array($rec)){
			$emp_id = $row['emp_id'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$emp_ary[$emp_id] = $fname." ".$lname; 
		}
		return $emp_ary;	
	}
	
	if(isset($_POST['sub'])){
		$eid = $_POST['emp'];
		$user = $_POST['user'];
		$user_t = $_POST['user_type'];
		$pass = $_POST['pass'];
		
		$sql = "INSERT INTO user_auth SET user = '$user', auth_type = '$user_t', pass = '$pass', emp_id = '$eid'";
		mysql_query($sql);
		
		if(mysql_affected_rows() == 1){
			echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px;'>Data loading successfully...</td></tr></table>";
		} else {
			echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px;'>Data loading failed...</td></tr></table>";
		}
	}
?>

<form action="UserAccess.php" method="post" onSubmit="return chksub(this)">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
	<tr>
    	<td colspan="3" style="text-align:center; font-weight:bold">User Access</td>
    </tr>
    <tr>
    	<td>Employee ID</td>
        <td>:</td>
        <td>
		<select name="emp" id="emp">
        	<option value="">-----------</option>
		<?php 
			foreach($emp_ary as $k=>$v){
				echo "<option value='".$k."'>".$v."</option>";
			}
		?></select></td>
    </tr>
    
    <tr>
    	<td>User Name</td>
        <td>:</td>
        <td><input type="text" id="user" name="user" style="background-color:white"></td>
    </tr>
    
    <tr>
    	<td>User Type</td>
        <td>:</td>
        <td><select name="user_type" id="user_type">
        	<option>------------</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select></td>
    </tr>
    
    <tr>
    	<td>Password</td>
        <td>:</td>
        <td><input type="text" name="pass" id="pass"></td>
    </tr>
    
    <tr>
    	<td>Re-Password</td>
        <td>:</td>
        <td><input type="text" name="re-pass" id="re-pass"></td>
    </tr>
    <tr><td colspan="3" align="center"><input type="submit" name="sub" id="sub" value="Save"></td></tr>
</table>
</form>
<script type="text/javascript">
	function chksub(){
		var eid = document.getElementById("emp").value;
		if(eid == ''){
			alert('select employee ID');
			return false;	
		}
		var user = document.getElementById("user").value;
		if(user == ''){
			alert('enter user name...');
			return false;
		}
		
		var user_t = document.getElementById("user_type").value;
		if(user_t == ''){
			alert('enter user type...');
			return false;
		}
		
		var pass = document.getElementById("pass").value;
		if(pass == ''){
			alert('enter password...');
			return false;
		}
		return true;
	}
</script>
<?php
include_once("footer.php");