<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	$base_process = new model();
	
	if(isset($_GET['delete_id'])){
		$sql = "DELETE FROM customer_info WHERE cust_id = '".$_GET['delete_id']."'";
		mysql_query($sql);
	}
	
	$select = array();
	$select[] = '*';
	
	$from = array();
	$table = "customer_info";
	$from[] = $table;
	
	echo "<br>";
	echo "<table align='center' border='0' width='600' style='font-family:verdana; font-size:11px' cellspacing='1'>";
		echo "<tr>";
			echo "<td colspan='7' style='font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Customer List</td>";
		echo "</tr>";
		echo "<tr><td height = '10'></td></tr>";
		echo "<tr style='font-weight:bold'>";
			echo "<td style='border-bottom:2px solid black'>S.L</td>";
			echo "<td style='border-bottom:2px solid black'>Name</td>";
			echo "<td style='border-bottom:2px solid black'>Company Name</td>";
			echo "<td style='border-bottom:2px solid black'>Contact</td>";
			echo "<td style='border-bottom:2px solid black'>Address</td>";
			echo "<td style='border-bottom:2px solid black'>Edit</td>";
			echo "<td style='border-bottom:2px solid black'>Delete</td>";
		echo "</tr>";
	$data = $base_process->get($select,$from);
	$i = 0;
	foreach($data as $value){
		if(is_array($value)){
			extract($value);
		}
		$i++;
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$name</td>";
			echo "<td>$cname</td>";
			echo "<td>$contact</td>";
			echo "<td>$addr</td>";
			echo "<td><a href = '#' onclick = \"window.open('edit_customer.php?id=$cust_id','','width=400,height=300')\">Edit</a></td>";
			echo "<td><a href = 'view_customer.php?delete_id=$cust_id' onclick = \"return confirm('Do you want to delete ? (Y/N)')\">Delete</a></td>";
		echo "</tr>";
	}
	echo "</table>";
	include_once("footer.php");
?>