<?php
include_once("header.php");
include_once("model.php");
$base = new model();
?>
<table height="30"></table>
<table width="700" align="center"><tr><td style="font-family:Calibri; font-size:17px; font-weight:bold; text-align:center">Suppliers Summary</td></tr></table>
<table align="center" style="font-family:Calibri; font-size:13px" cellspacing="1" cellpadding="3" width="700">
	<tr style="font-weight:bold">
    	<td style="border-bottom:2px solid black">S.L</td>
        <td style="border-bottom:2px solid black">Suppliers Name</td>
        <td style="border-bottom:2px solid black">Contact</td>
        <td style="border-bottom:2px solid black">Payable Amount</td>
        <td style="border-bottom:2px solid black">Paid Amount</td>
        <td style="border-bottom:2px solid black">Due Amount</td>
    </tr>
<?php
$sql = "SELECT * FROM suppliers";
$rec = mysql_query($sql);
$i = 0;
while($row = mysql_fetch_array($rec)){
	$i++;
	$sid 			= $row['sid'];
	$sname 			= $row['sname'];
	$scontact		= $row['scontact'];
	
	$payable_amount	= getPayableAmount($sid);
	$paid_amount	= getPaidAmount($sid);
	
	$total_due		= ($payable_amount - $paid_amount);
	
	echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>$sname</td>";
		echo "<td>$scontact</td>";
		echo "<td>$payable_amount BDT</td>";
		echo "<td>$paid_amount BDT</td>";
		echo "<td>$total_due BDT</td>";
	echo "</tr>";
}

echo "</table>";

function getPayableAmount($sid){
	$sql = "SELECT * FROM suppliers_buying_ledger WHERE suppliers_id = '$sid'";	
	$rec = mysql_query($sql);
	$total_payable = 0;
	while($row = mysql_fetch_array($rec)){
		$quantity 	= $row['quantity'];
		$purchase	= $row['purchase_rate'];
		
		$total_payable += ($purchase * $quantity);
	}
	return $total_payable;
}

function getPaidAmount($sid){
	$sql = "SELECT * FROM suppliers_payment WHERE suppliers_id = '$sid'";
	$rec = mysql_query($sql);
	$total_paid = 0;
	while($row = mysql_fetch_array($rec)){
		$paid_amount		= $row['paid_amount'];
		$total_paid += $paid_amount;
	}
	return $total_paid;	
}

include_once("footer.php");