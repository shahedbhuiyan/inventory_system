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

echo "<br>";
echo "<form action='supliers_provided_item.php' method='post'>";
	echo "<table align='center' border='0' style = 'font-family:verdana; font-size:11px'>";
		echo "<tr>";
			echo "<td>From</td>";
			echo "<td><input type='text' name='from' id='from' value = '".@$from."'></td>";
			echo "<td>To</td>";
			echo "<td><input type='text' name='to' id='to' value = '".@$to."'/></td>";
			echo "<td>OR Suppliers Name</td>";
			echo "<td><input type = 'text' autocomplete = 'off' name = 'sname' id = 'sname' style = 'width:170px'/></td>";
			echo "<input type='hidden' name = 'sid' id = 'sid'/>";
			echo "<td><input type = 'submit' name = 'src' value = 'Search' style = 'background-colo:white'/></td>";
		echo "</tr>";
	echo "</table>";
echo "</form>";
echo "<br>";
echo "<table align='center' width='650' style = 'font-family:verdana; font-size:11px' border='0' cellspacing='1'>";
	echo "<tr>";
		echo "<td colspan='4' style = 'text-align:center; font-family:verdana; font-weight:bold; font-size:12px'>Daily Suppliers Report</td>";
	echo "</tr>";
	
	echo "<tr style = 'font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Suppliers Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Amount</td>";
	echo "</tr>";
	
if(isset($_POST['src'])){
	$sql = "SELECT * FROM daily_suppliers WHERE date >= '".$_POST['from']."' AND date <= '".$_POST['to']."'";
	if($_POST['sid'] != ''){
		$sql .= " AND sid = '".$_POST['sid']."'";
	}
	$i = 0;
	$grand_total = 0;
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$sid 	= $row['sid'];
		$date 	= $row['date'];
		
		$sname = get_sname($sid);
		$total = get_total($sid,$date);
		$grand_total += $total;
		$i++;
		echo "<tr>";
			echo "<td>".@$i."</td>";
			echo "<td>".@$sname."</td>";
			echo "<td><a href='details_suppliers.php?id=$sid&dat=$date' target = '_blank'>".@$date."</a></td>";
			echo "<td>".@$total."</td>";
		echo "</tr>";
	}
} else {
	$date = date("Y-m-d");
	$sql = "SELECT * FROM daily_suppliers WHERE date = '$date'";
	$i = 0;
	$grand_total = 0;
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$sid 	= $row['sid'];
		$date 	= $row['date'];
		
		$sname = get_sname($sid);
		$total = get_total($sid,$date);
		$grand_total += $total;
		$i++;
		echo "<tr>";
			echo "<td>".@$i."</td>";
			echo "<td>".@$sname."</td>";
			echo "<td><a href='details_suppliers.php?id=$sid&dat=$date' target = '_blank'>".@$date."</a></td>";
			echo "<td>".@$total."</td>";
		echo "</tr>";
	}	
}
	echo "<tr><td colspan = '4' style = 'text-align:right; font-weight:bold; border-top:2px solid black' >Grand Total : ".@$grand_total." BDT</td></tr>";
echo "</table>";

function get_sname($sid){
	$sql = "SELECT * FROM suppliers WHERE sid = '$sid'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$sname = $row['sname'];
	}
	return @$sname;
}

function get_total($sid,$date){
	$sql = "SELECT * FROM suppliers_buying_ledger WHERE suppliers_id = '$sid' AND purchase_date = '$date'";	
	$rec = mysql_query($sql);
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$quantity = $row['quantity'];
		$purchase_reate = $row['purchase_rate'];
		
		$g_total += ($quantity * $purchase_reate);
	}
	return $g_total;
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