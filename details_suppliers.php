<?php
include_once("model.php");
$base = new model();
$sid = $_GET['id'];
$dat = $_GET['dat'];

@$s_name = suppliers_name(@$sid);
echo "<table align='left' border='0' width = '700' style = 'font-family:verdana; font-size:11px;'>";
	echo "<tr>";
		echo "<td colspan='7' style = 'font-weight:bold; text-align:center'>Supplier's Details Item</td>";
	echo "</tr>";
	echo "<tr><td colspan = '7'>Supplier's Name : <b>".@$s_name."</b></td></tr>";
	echo "<tr><td height = '10'></td></tr>";
	echo "<tr style = 'font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Item</td>";
		echo "<td style = 'border-bottom:2px solid black'>Brand</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Quantity</td>";
		echo "<td style = 'border-bottom:2px solid black'>Unite Price</td>";
		echo "<td style = 'border-bottom:2px solid black'>Total</td>";
	echo "</tr>";
$sql = "SELECT * FROM suppliers_buying_ledger WHERE suppliers_id = '$sid' AND purchase_date = '$dat'";
$rec = mysql_query($sql);
$i = 0;
while($row = mysql_fetch_array($rec)){
	$product = $row['product'];
	$brand = $row['brand'];
	$date	= $row['purchase_date'];
	$quantity = $row['quantity'];
	$unit		= $row['purchase_rate'];
	$suppliers = $row['suppliers_id'];
	$total = ($unit * $quantity);
	$i++;
	echo "<tr>";
		echo "<td>".@$i."</td>";
		echo "<td>".@$product."</td>";
		echo "<td>".@$brand."</td>";
		echo "<td>".@$date."</td>";
		echo "<td>".@$quantity."</td>";
		echo "<td>".@$unit."</td>";
		echo "<td>".@$total."</td>";
	echo "<tr>";
}
echo "</table>";

function suppliers_name($suppliers){
	$sql = "SELECT * FROM suppliers WHERE sid = '$suppliers'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$sname = $row['sname'];
	}
	return $sname;
}