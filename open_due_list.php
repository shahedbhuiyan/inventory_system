<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	
	$base_precess = new model;
	$from = date("Y-m-01");
	$to = date("Y-m-d");
	
	echo "<br>";
	echo "<form action='open_due_list.php' method='post'>";
	echo "<table align='center' border = '0' cellspacing='0' style='font-family:verdana; font-size:11px'>";
		echo "<tr>";
			echo "<td>From</td>";
			echo "<td><input type='text' name='from' value = '$from'/></td>";
			echo "<td>To</td>";
			echo "<td><input type='text' name='to' value = '$to'/></td>";
			echo "<td>OR Customer : <input type='text' autocomplete = 'off' name='customer' id = 'customer'/><input type='hidden' name = 'hid' id = 'hid'></td>";
			echo "<td><input type = 'submit' name='search' value = 'Search'/></td>";
		echo "</tr>";
	echo "</table>";
	echo "</form>";
	echo "<br>";
	//echo "<table width = '750'><tr><td style = 'text-align:right; font-family:verdana; font-size:12px'>Date : ".date("Y/m/d")."</td></tr></table>";
	echo "<table align='center' style='font-family:verdana; font-size:14px; font-weight:bold'><tr><td>Customer Due List</td></tr></table>";
	echo "<table align='center' cellspacing='1' style='font-family:verdana; font-size:11px;' border='0' width='700'>";
		echo "<tr style='font-weight:bold'>";
			echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
			echo "<td style = 'border-bottom:2px solid black'>Customer Name</td>";
			echo "<td style = 'border-bottom:2px solid black'>Customer Contact</td>";
			echo "<td style = 'border-bottom:2px solid black'>Invoice No</td>";
			echo "<td style = 'border-bottom:2px solid black'>Last Payment Date</td>";
			echo "<td style = 'border-bottom:2px solid black'>Dues</td>";
		echo "</tr>";
	
		if(isset($_POST['search'])){
			$from = $_POST['from'];
			$to = $_POST['to'];
			$cust_id = $_POST['hid'];
			$sql = "SELECT * FROM payment WHERE payment_date>='$from' AND payment_date<='$to' AND due != 0";
			if($cust_id != ''){
				$sql .= " AND cst_id = '$cust_id'";
			}
			$rec = mysql_query($sql);
			$i = 0;
			$total_dues = 0;
			while($row = mysql_fetch_array($rec)){
				$i++;
				$due = $row['due'];
				$invoice = $row['invoice_no'];
				$date = $row['payment_date'];
				$cst_id	= $row['cst_id'];
				$cst_info = getCustomerInfo($cst_id);
				$cst_info = explode("|",$cst_info);
				echo "<tr>";
					echo "<td>".@$i."</td>";
					echo "<td>".@$cst_info[0]."</td>";
					echo "<td>".@$cst_info[1]."</td>";
					echo "<td>".@$invoice."</td>";
					echo "<td>".@$date."</td>";
					echo "<td>".@$due."</td>";
				echo "</tr>";
				$total_dues += $due;			
			}
		} else {
			$sql = "SELECT * FROM payment WHERE payment_date='$to' AND due != 0";
			$rec = mysql_query($sql);
			$i = 0;
			$total_dues = 0;
			while($row = mysql_fetch_array($rec)){
				$i++;
				$due = $row['due'];
				$invoice = $row['invoice_no'];
				$date = $row['payment_date'];
				$cst_id	= $row['cst_id'];
				$cst_info = getCustomerInfo($cst_id);
				$cst_info = explode("|",$cst_info);
				echo "<tr>";
					echo "<td>".@$i."</td>";
					echo "<td>".@$cst_info[0]."</td>";
					echo "<td>".@$cst_info[1]."</td>";
					echo "<td>".@$invoice."</td>";
					echo "<td>".@$date."</td>";
					echo "<td>".@$due."</td>";
				echo "</tr>";
				$total_dues += $due;
			}
		}
		echo "<tr><td colspan = '6' style = 'border-top:2px solid black; text-align:right; font-weight:bold'>Total Due's : ".@$total_dues." BDT</td></tr>";
	echo "</table>";
function getCustomerInfo($cst_id){
	if($cst_id != ''){
		$sql = "SELECT * FROM customer_info WHERE cust_id = '$cst_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$cst_name = $row['name'];
			$contact = $row['contact'];
		}
		return @$cst_name."|".@$contact;
	}
}
include_once("footer.php");

?>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/auto_suggestion_4.js"></script>
<link rel="stylesheet" type="text/css" href="css/auto_suggestion.css" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#customer").UISugestion();
    });
	/*function chkfrm(){
		var val = document.getElementById("hid").value;
		if(val == ''){
			alert('Please click or enter on item lists...');
			return false;
		}
		return true;
	}*/
</script>