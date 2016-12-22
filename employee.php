<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	
	include_once("header.php");
	include_once("model.php");
	$obj = new model();
	$last = $obj->incrementId("employee_info","emp_id");
	$table = "employee_info";
	$insert_data = array();
	
	if(isset($_POST['sub'])){
		$state = $obj->existance_check("select * from employee_info where emp_id = '".$_POST['emp_id']."'");
		if($state == 0){
			$insert_data['emp_id']			= $_POST['emp_id'];
			//$insert_data['pass']			= $_POST['pass'];
			$insert_data['fname']			= $_POST['fname'];
			$insert_data['lname']			= $_POST['lname'];
			$insert_data['dob']				= $_POST['dob'];
			$insert_data['blood']			= $_POST['blood'];
			$insert_data['gender']			= $_POST['gender'];
			$insert_data['email']			= $_POST['email'];
			$insert_data['addr']			= $_POST['addr'];
			$insert_data['contact']			= $_POST['contact'];
			$insert_data['salary']			= $_POST['salary'];
			
			$file_name						= $_FILES['pic']['name'];
			if($file_name != NULL){
				$ext = substr($file_name, -3);
				$file_name = $insert_data['emp_id'].".".$ext;
			}
			
			$insert_data['pic']				= $file_name;
			
			$status = $obj->dataInsertion($table,$insert_data,$_FILES);
			$last = $obj->incrementId("employee_info","emp_id");
			if($status){
				$str = "Data Save successfully";
			} else { 
				$str = "Data dont save successfully";
			}
		} else {
			$str = "Already Exists";
		}
	}
	
?>

<form action="employee.php" method="post" onSubmit="return formValidation()" enctype="multipart/form-data">
<table align="center" style="font-family:tahoma; font-size:13px; text-align:left; margin-top:40px" border="0">
	<tr><td colspan="3" style="text-align:center"><?php echo @$str; ?></td></tr>
	<tr>
		<td colspan="3" id="menu2">New Employee</td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td>Employee ID</td>
		<td>:</td>
		<td><input type="text" name="emp_id" value="<?php echo @$last; ?>" readonly="readonly" style="background-color:white; text-align:center" id="emp_id"/></td>
	</tr>
	
	<tr>
		<td class="td-left">First Name</td>
		<td>:</td>
		<td class="td_left"><input type="text" name="fname" id="fname" style="background-color:white"/></td>
	</tr>
	
	<tr>
		<td class="td-left">Last Name</td>
		<td>:</td>
		<td class="td_left"><input type="text" name="lname" id="lname"  style="background-color:white"></td>
	</tr>
	
	<tr>
		<td class="td-left">Date of Birth</td>
		<td>:</td>
		<td class="td_left"><input type="text" name="dob" style="background-color:white"></td>
	</tr>
	
	<tr>
		<td>Blood</td>
		<td>:</td>
		<td>
		
		<select name="blood" id="blood">
			<option value="A+">A+</option>
			<option value="A-">A-</option>
			<option value="B+">B+</option>
			<option value="B-">B-</option>
			<option value="O+">O+</option>
			<option value="O-">O-</option>
			<option value="AB+">AB+</option>
			<option value="AB-">AB-</option>
		</select>
		
		</td>
	</tr>
	
	<tr>
		<td>Gender</td>
		<td>:</td>
		<td>
		
		<select name="gender" id="gender">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>
		
		</td>
	</tr>
	
	<tr>
		<td>Address</td>
		<td>:</td>
		<td><textarea name="addr"></textarea></td>
	</tr>
	
	<tr>
		<td>E-mail</td>
		<td>:</td>
		<td><input type="text" name="email" style="background-color:white"></td>
	</tr>
	
	<tr>
		<td class="td-left">Contact</td>
		<td>:</td>
		<td class="td_left"><input type="text" name="contact" style="background-color:white"></td>
	</tr>
	
    <tr>
		<td>Salary</td>
		<td>:</td>
		<td><input type="text" name="salary" id="salary" style="background-color:white"></td>
	</tr>
    
	<tr>
		<td class="td-left">Designation</td>
		<td>:</td>
		<td class="td_left"><select name="title" id="title">
			<option value="0" selected="selected">-------Select-------</option>
			<option value="SE">Sales Executive</option>
			<option value="MG">Manager</option>
			<option value="ST">Staff</option>
			
		</select></td>
	</tr>
	
	<tr>
		<td class="td-left">Photo</td>
		<td>:</td>
		<td class="td_left"><input type="file" name="pic" style="background-color:white"></td>
	</tr>
	
	<tr>
		<td colspan="3" align="center"><input type="submit" style="background-color:white" name="sub" value="Submit"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset"/></td>
	</tr>
	
</table>
</form>
<?php
	include_once("footer.php");
?>
<script type="text/javascript">
function formValidation()
{
	var uid = document.getElementById("emp_id").value;
	if(uid.length==0) {
		alert("Please Enter Emp. ID");
		return false;
	}
		
	var fname = document.getElementById("fname").value;
	if(fname=="") {
		alert("Please enter first name.");
		return false;
	}
	
	var lname = document.getElementById("lname").value;
	if(lname=="") {
		alert("Please enter last name.");
		return false;
	}
	
	
	return true;
}
</script>
