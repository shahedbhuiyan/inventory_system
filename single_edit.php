<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	$obj = new model();
	if(isset($_GET['emp_id'])){
		$emp_id		= $_GET['emp_id'];
	} else {
		$emp_id		= $_POST['emp_id'];
	}
	
	if(isset($_POST['update'])){
		$insert_data 					= array();
		$where['emp_id']				= $_POST['emp_id'];
		$insert_data['fname']			= $_POST['fname'];
		$insert_data['lname']			= $_POST['lname'];
		$insert_data['dob']				= $_POST['dob'];
		$insert_data['blood']			= $_POST['blood'];
		$insert_data['gender']			= $_POST['gender'];
		$insert_data['email']			= $_POST['email'];
		$insert_data['contact']			= $_POST['contact'];
		$insert_data['addr']			= $_POST['addr'];
		
		$status = $obj->update_query("employee_info",$insert_data,$where);
		
		if(@$status){
			
		} else {
			exit("Update Failed");	
		}
	}
	
	$select		= array();
	$select[] 	= '*';
	$from		= array();
	$from[]		= "employee_info";
	$where		= array();
	$where['emp_id']	= @$emp_id;
	
	$row = $obj->get($select,$from,$where);
	foreach($row as $row){
		extract($row);
	}
	
	echo "<form id='SINGLE_EDIT' action='$_SERVER[SCRIPT_NAME]' method='post' enctype='multipart/form-data'>";
	echo "<table align='center' width='400' border='0' style='font-family:courier new; font-size:15px; text-align:left'>";
		echo "<tr>";
			echo "<td colspan='3' align='center' style='font-family:verdana; font-size:15px; font-weight:bold'>Edit Information</td>";
		echo "</tr>";
		
		echo "<tr><td height = '13'></td></tr>";
		
		echo "<tr>";
			echo "<td width='40%'>Employee ID</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$emp_id' readonly name='emp_id'></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>First Name</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$fname' name = 'fname'></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Last Name</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value=\"$lname\" name = 'lname'</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Date of Birth</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$dob' name = 'dob'></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Blood Group</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$blood' name = 'blood'</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Gender</td>";
			echo "<td>:</td>";
			echo "<td><select name = 'gender'>";
				if(@$gender == 'M'){
					echo "<option selected value='M'>Male</option>";
					echo "<option value='F'>Female</option>";
				} else {
					echo "<option value='M'>Male</option>";
					echo "<option selected value='F'>Female</option>";
				}		
			echo "</select></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Email</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$email' name = 'email'></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Contact</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' value='$contact' name = 'contact'</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Address</td>";
			echo "<td>:</td>";
			echo "<td><textarea name='addr'>$addr</textarea></td>";
		echo "</tr>";
		
		echo "<tr><td colspan = '3' align = 'center'><input type = 'submit' name = 'update' value = 'Update' style = 'background-color:white'/></td></tr>";
	echo "</table>";
	echo "</form>";
?>
<script>
$(function() {
	//$(".colorboxButton").colorbox();
	
	 $("#SINGLE_EDIT").submit(function() {
        $.post($(this).attr("action"), $(this).serialize(), function(data) {
            $.colorbox({html:data});
        },
        'html');
        return false;
    });
});
</script>