<?php
	include_once("header.php");
	include_once("model.php");
	$base = new model();
	
	
	@$total_payment = getPayment();
	
	function getPayment(){
		$today = date("Y-m-d");
		$sql = "SELECT * FROM payment WHERE payment_date = '$today' AND paid_amount != '0'";
		$rec = mysql_query($sql);
		$total_paid = 0;
		while($row = mysql_fetch_array($rec)){
			$paid = $row['paid_amount'];
			
			$total_paid += $paid;
		}
		return @$total_paid;
	}
	
	@$total_due = getDues();
	
	function getDues(){
		$today = date("Y-m-d");
		$sql = "SELECT * FROM payment WHERE payment_date = '$today' AND due != '0'";
		$rec = mysql_query($sql);
		$total_due = 0;
		while($row = mysql_fetch_array($rec)){
			$due = $row['due'];
			
			$total_due += $due;
		}
		return @$total_due;
	}
	
	
	@$total_sales_price = getDailySales_Amount();
	
	function getDailySales_Amount(){
		$date = date("Y-m-d");
		$sql = "SELECT * FROM voucher_list as vl, ledger as l WHERE vl.id = l.inv_sl AND vl.date = '$date'";
		$rec = mysql_query($sql);
		$sales_total = 0;
		$purchase_total = 0;
		while($row = mysql_fetch_array($rec)){
			$unit_price = $row['unit_price'];
			$purchase_price = $row['purchase'];
			
			$quantity = $row['quantity'];
			
			$sales_total += ($unit_price * $quantity);
			///$purchase_total += ($purchase_price * $quantity);
		}
		return $sales_total;
	}
	
	
	$total_purchase_price = total_purchase_price();
	
	function total_purchase_price(){
		$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date = '".date("Y-m-d")."'";	
		$rec = mysql_query($sql);
		$total_taka = 0;
		while($row = mysql_fetch_array($rec)){
			$purchase_rate = $row['purchase_rate'];
			$quantity = $row['quantity'];
			
			$total_taka += ($purchase_rate * $quantity);
		}
		
		return $total_taka;
	}
	
	$total_expense_price = total_expense_price();
	
	function total_expense_price(){
		$sql = "SELECT * FROM daily_expense WHERE dat = '".date("Y-m-d")."'";
		$rec = mysql_query($sql);
		$total_amount = 0;
		while($row = mysql_fetch_array($rec)){
			$taka = $row['eamount'];
			$total_amount += $taka;
		}
		return $total_amount;	
	}
	
	echo "<table align='center' style = 'font-family:verdana; font-size:11px; font-weight:bold'>";
		echo "<tr><td height = '20' colspan = '3'></td></tr>";
		echo "<tr>";
			echo "<td>Today's Summery</td>";
			echo "<td> | </td>";
			echo "<td>".date("F d, Y")."</td>";
		echo "</tr>";
		echo "<tr><td height = '15' colspan = '3'></td></tr>";
	echo "</table>";
	
	echo "<table align='center' border = '0' style = 'font-family:verdana; font-size:11px' width='500'>";
		echo "<tr style = 'font-weight:bold'>";
			echo "<td style='border-bottom:2px solid black'>Name of Field's</td>";
			echo "<td style='border-bottom:2px solid black;' width='100'>Amount</td>";
		echo "</tr>";
	
		echo "<tr>";
			echo "<td>Total Sales Price</td>";
			echo "<td>".@$total_sales_price." BDT</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Total Due Amount</td>";
			echo "<td>".@$total_due." BDT</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Total Paid Amount</td>";
			echo "<td>".@$total_payment." BDT</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Total Purchase Price</td>";
			echo "<td>".@$total_purchase_price." BDT</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Total Expense Price</td>";
			echo "<td>".@$total_expense_price." BDT</td>";
		echo "</tr>";
	echo "</table>";
	
	include_once("footer.php");
?>