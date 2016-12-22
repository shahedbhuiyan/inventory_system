<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
?>
<script>
$(function() {
	$(".colorboxButton").colorbox();
});
</script>
<?php
	
	include_once("model.php");
	$obj = new model();
	
	$select 		= array();
	$select[] 		= '*';
	$from 			= array();
	$table 			= "employee_info";
	$from[] 		= $table;

	echo "<table align='center' border='1' cellspacing='1' style='margin-top:40px; text-align:center; font-size:11px; font-family:verdana;' width='800'>";
		echo "<tr>";
			echo "<td>S.L</td>";
			echo "<td>ID</td>";
			echo "<td>Name</td>";
			echo "<td>Date of Birth</td>";
			echo "<td>Blood Group</td>";
			echo "<td>Sex</td>";
			echo "<td>Address</td>";
			echo "<td>Email</td>";
			echo "<td>Contact</td>";
			echo "<td>Salary</td>";
			echo "<td>View</td>";
			echo "<td>Edit</td>";
			echo "<td>Delete</td>";
		echo "</tr>";
	
	$query = $obj->get($select,$from);
	$i = 1;
	foreach($query as $value){
		if(isset($value));
			extract($value);
			@$gender = (@$gender == 'M')?"Male":"Female";
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$emp_id</td>";
			echo "<td>$fname $lname</td>";
			echo "<td>$dob</td>";
			echo "<td>$blood</td>";
			echo "<td>$gender</td>";
			echo "<td>$addr</td>";
			echo "<td>$email</td>";
			echo "<td>$contact</td>";
			echo "<td>".@$salary."</td>";
			//echo "<td><a href='#' onclick = \"window.open('single_view.php?emp_id=$emp_id','','width=500,height=500')\">View</a></td>";
			echo "<td><a href='single_view.php?emp_id=$emp_id' class='colorboxButton'>View</a></td>";
			echo "<td><a href='single_edit.php?emp_id=$emp_id' class='colorboxButton'>Edit</a></td>";
			echo "<td><a href='#'>Delete</a></td>";
		echo "</tr>";
		$i++;
	}
	echo "</table>";
		
	include("footer.php");
?>

