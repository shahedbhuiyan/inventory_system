<?php
if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
include_once("header.php");
include_once("model.php");
$base = new model();


$from = date("Y-m-01");
$to = date("Y-m-d");

echo "<form action='purchase_report.php' method='post'>";
echo "<table align='center' border = '0' width='700' style = 'font-size:10px; font-family:verdana;'>"; 
	echo "<tr>"; 
		echo "<td>From</td>";
		echo "<td><input type='text' name='from' id = 'from' value = '".@$from."'/></td>";
		echo "<td>To</td>";
		echo "<td><input type='text' name='to' id = 'to' value = '".@$to."'/></td>";
		echo "<td>OR Suppliers Name</td>";
		echo "<td><input type = 'text' autocomplete = 'off' name = 'sname' id = 'sname' style = 'width:170px'/></td>";
		echo "<input type='hidden' name = 'sid' id = 'sid'/>";
		echo "<input type = 'hidden' name = 'hi' value = '1'>";
		echo "<td><input type='submit' name='src' id = 'src' value = 'Search' style = 'background-color:white'/></td>";
	echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br><br>";
if(@$_POST['hi'] == 1){
	echo "<table align='center' width = '750' border='0' cellspacing='0'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Custom Purchae Report</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td style = 'font-family:verdana; font-size:11px; text-align:right'>From : ".@$from." To : ".@$to."</td>";
		echo "</tr>";
	echo "</table>";
} else {
		echo "<table align='center' width = '750'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Today's Purchase Report</td>";
		echo "</tr>";
	echo "</table>";
}

echo "<br>";
echo "<table align='center' width='700' style = 'font-family:verdana; font-size:11px'>";
	echo "<tr style='font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Item Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Brand Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Suppliers Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Quantity</td>";
		echo "<td style = 'border-bottom:2px solid black'>Unit Price</td>";
		echo "<td style = 'border-bottom:2px solid black'>Total</td>";
	echo "<tr>";
if(isset($_POST['src'])){
	$from = $_POST['from'];
	$to = $_POST['to'];
	$sid = $_POST['sid'];
	$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date >= '$from' AND purchase_date <= '$to'";
	if($sid != ''){
		$sql .= " AND suppliers_id = '$sid'";
	}
	$rec = mysql_query($sql);
	$j = 0;
	$total = 0;
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$j++;
		$product 			= $row['product'];
		$date				= $row['purchase_date'];
		$quantity			= $row['quantity'];
		$unit_rate			= $row['purchase_rate'];
		$brand 				= $row['brand'];
		$suppliers_id		= $row['suppliers_id'];
		$total				= ($quantity * $unit_rate);
		$suppliers_name		= suppliers_name($suppliers_id);
		$g_total			+= $total;
		
		echo "<tr>"; 
			echo "<td>".@$j."</td>";
			echo "<td>".@$product."</td>";
			echo "<td>".@$brand."</td>";
			echo "<td>".@$suppliers_name."</td>";
			echo "<td>".@$date."</td>";
			echo "<td>".@$quantity."</td>";
			echo "<td>".@$unit_rate."</td>";
			echo "<td>".@$total."</td>";
		echo "</tr>";
	}
} else {
	$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date = '".date("Y-m-d")."'";
	$rec = mysql_query($sql);
	$j = 0;
	$total = 0;
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$j++;
		$product 			= $row['product'];
		$date				= $row['purchase_date'];
		$quantity			= $row['quantity'];
		$unit_rate			= $row['purchase_rate'];
		$brand 				= $row['brand'];
		$suppliers_id		= $row['suppliers_id'];
		$total				= ($quantity * $unit_rate);
		$suppliers_name		= suppliers_name($suppliers_id);
		$g_total			+= $total;
		
		echo "<tr>"; 
			echo "<td>".@$j."</td>";
			echo "<td>".@$product."</td>";
			echo "<td>".@$brand."</td>";
			echo "<td>".@$suppliers_name."</td>";
			echo "<td>".@$date."</td>";
			echo "<td>".@$quantity."</td>";
			echo "<td>".@$unit_rate."</td>";
			echo "<td>".@$total."</td>";
		echo "</tr>";
		
	}	
}
	echo "<tr><td colspan = '8' style = 'font-weight:bold; border-top:2px solid black; text-align:right'>Grand Total : ".@$g_total." BDT</td></tr>";
echo "</table>";

function suppliers_name($suppliers_id){
	$sql = "SELECT * FROM suppliers WHERE sid = '$suppliers_id'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$sname = $row['sname'];
	}
	return @$sname;	
}
include_once("footer.php");

?>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/auto_suggestion_3.js"></script>
<link rel="stylesheet" type="text/css" href="css/auto_suggestion.css" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#sname").UISugestion();
    });
</script>