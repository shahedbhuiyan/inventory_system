<?php
include_once("header.php");
include_once("model.php");
$base = new model();
?>
<form action="suppliers_payment_history.php" method="post">
<table align="center">
	<tr>
    	<td>From : <input type="text" name="from" id="from" value="<?php echo date("Y-m-01"); ?>"> To : <input type="text" name="to" id="to" value="<?php echo date("Y-m-d"); ?>"/> <input type="submit" name="search" value="Query"/></td>
    </tr>
</table>
</form>
<table height="30"></table>
<table align="center" border="0" style="font-family:calibri; font-size:13px;" width="750" cellspacing="1" cellpadding="3">
	<tr style="font-weight:bold">
    	<td style="border-bottom:2px solid black">S.L</td>
        <td style="border-bottom:2px solid black">Date</td>
        <td style="border-bottom:2px solid black">Suppliers Name</td>
        <td colspan="2" style="border-bottom:2px solid black">Payment Mode</td>
        <td style="border-bottom:2px solid black">Payable Amount</td>
        <td style="border-bottom:2px solid black">Paid Amount</td>
        <td style="border-bottom:2px solid black">Due Amount</td>
    </tr>
<?php
if(isset($_POST['from'],$_POST['to'])){
	$sql = "SELECT * FROM suppliers_payment WHERE date >= '".$_POST['from']."' AND date <= '".$_POST['to']."'";
	$rec = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($rec)){
		$i++;
		$dat 			= $row['date'];
		$suppliers		= $row['suppliers_id'];
		$payment_mode	= $row['payment_mode'];
		$payable_amount	= $row['total_payable'];
		$paid_amount	= $row['paid_amount'];
		$bank_id		= $row['bank_id'];
		$due_amount		= $row['due'];
		
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$dat</td>";
			echo "<td>".suppliersName($suppliers)."</td>";
			if($payment_mode == 'Bank'){
				echo "<td colspan='2'>Bank - ".getPaymentMode($bank_id)."</td>";
			} else {
				echo "<td colspan='2' style='text-align:left'>$payment_mode</td>";	
			}
			echo "<td>$payable_amount BDT</td>";
			echo "<td>$paid_amount BDT</td>";
			echo "<td>$due_amount BDT</td>";
		echo "</tr>";
	}
} else {
	$sql = "SELECT * FROM suppliers_payment WHERE date = '".date("Y-m-d")."'";
	$rec = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($rec)){
		$i++;
		$dat 			= $row['date'];
		$suppliers		= $row['suppliers_id'];
		$payment_mode	= $row['payment_mode'];
		$payable_amount	= $row['total_payable'];
		$paid_amount	= $row['paid_amount'];
		$bank_id		= $row['bank_id'];
		$due_amount		= $row['due'];
		
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$dat</td>";
			echo "<td>".suppliersName($suppliers)."</td>";
			if($payment_mode == 'Bank'){
				echo "<td colspan='2'>Bank - ".getPaymentMode($bank_id)."</td>";
			} else {
				echo "<td colspan='2' style='text-align:left'>$payment_mode</td>";	
			}
			echo "<td>$payable_amount BDT</td>";
			echo "<td>$paid_amount BDT</td>";
			echo "<td>$due_amount BDT</td>";
		echo "</tr>";
	}	
}
echo "</table>";
function suppliersName($suppliers){
	$sql = "SELECT * FROM suppliers WHERE sid = '$suppliers'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$sname	= $row['sname'];
	}
	return @$sname;	
}

function getPaymentMode($id){
	$sql = "SELECT * FROM bank WHERE id = '$id'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$bname = $row['bname'];
	}
	return $bname;
}

include_once("footer.php");