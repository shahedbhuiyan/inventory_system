<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	$obj = new model();
	if(isset($_GET['emp_id'])){
		$emp_id = $_GET['emp_id'];
	}
	
	$select		= array();
	$select[] 	= '*';
	$from		= array();
	$from[]		= "employee_info";
	$where		= array();
	$where['emp_id']	= $emp_id;
	
	$row = $obj->get($select,$from,$where);
	foreach($row as $row){
		extract($row);
	}
	
	echo "<table align='center' width='600' border='0' style='font-family:courier new; font-size:15px; text-align:left'>";
		echo "<tr>";
			echo "<td colspan='3' align='center' style='font-family:verdana; font-size:15px; font-weight:bold'>Staff Information</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td colspan='3' align='left'><img src='photo/$pic' height = '150' width = '150'></td>";
		echo "</tr>";
		
		echo "<tr><td height = '13'></td></tr>";
		
		echo "<tr>";
			echo "<td width='40%'>Employee ID</td>";
			echo "<td>:</td>";
			echo "<td>$emp_id</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>First Name</td>";
			echo "<td>:</td>";
			echo "<td>$fname</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Last Name</td>";
			echo "<td>:</td>";
			echo "<td>$lname</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Date of Birth</td>";
			echo "<td>:</td>";
			echo "<td>$dob</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Blood Group</td>";
			echo "<td>:</td>";
			echo "<td>$blood</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Gender</td>";
			echo "<td>:</td>";
			echo "<td>$gender</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Email</td>";
			echo "<td>:</td>";
			echo "<td>$email</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Contact</td>";
			echo "<td>:</td>";
			echo "<td>$contact</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Salary</td>";
			echo "<td>:</td>";
			echo "<td>$salary BDT</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Address</td>";
			echo "<td>:</td>";
			echo "<td>$addr</td>";
		echo "</tr>";
	echo "</table>";
?>