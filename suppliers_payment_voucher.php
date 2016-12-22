<?php
	include_once("header.php");
	include_once("model.php");
	$obj = new model();
	
	echo "<table align='center' border='1' cellspacing='1' style='font-family:tahoma; font-size:13px; width:700px'>";
		echo "<tr style='font-weight:bold'>";
			echo "<td>S.L</td>";
			echo "<td>Suppliers Name</td>";
			echo "<td>Payment Mode</td>";
			echo "<td>Total Payable</td>";
			echo "<td>Paid Amount</td>";
			echo "<td>Due</td>";
			echo "<td>Date</td>";
			echo "<td>View</td>";
		echo "</tr>";
	$sql = "SELECT * FROM suppliers_payment WHERE date = '".date("Y-m-d")."'";
	$rec = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($rec)){
		$i++;
		$suppliers_id		= $row['suppliers_id'];
		$suppliers_name		= getSuppliersName($suppliers_id);
		$payment_mode		= $row['payment_mode'];
		$total_payable		= $row['total_payable'];
		$due				= $row['due'];
		$paid_amount		= $row['paid_amount'];
		$date				= $row['date'];
		if($payment_mode == 'Bank'){
			$bank_id			= $row['bank_id'];
			$bank_name			= getBankName($bank_id);
		}
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$suppliers_name</td>";
			if($payment_mode == 'Bank'){
				echo "<td>$bank_name</td>";
			} else {
				echo "<td>$payment_mode</td>";
			}
			echo "<td>$total_payable BDT</td>";
			echo "<td>$paid_amount BDT</td>";
			echo "<td>$due BDT</td>";
			echo "<td>$date</td>";
			echo "<td><a href = 'payment_voucher.php?id=$suppliers_id&dat=$date' target = '_blank'>View</a></td>";
		echo "</tr>";
	}
	
	function getSuppliersName($suppliers_id){
		$sql = "SELECT * FROM suppliers WHERE sid = '".$suppliers_id."'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$name = $row['sname'];
		}
		return $name;	
	}
	
	function getBankName($bank_id){
		$sql = "SELECT * FROM bank WHERE id = '$bank_id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$bname = $row['bname'];
		}
		return $bname;	
	}
	include_once("footer.php");
?>