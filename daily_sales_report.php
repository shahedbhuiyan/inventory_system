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

echo "<form action='daily_sales_report.php' method='post'>";
echo "<table align='center' border = '0' width='700' style = 'font-size:12px; font-family:verdana;'>"; 
	echo "<tr>"; 
		echo "<td>From</td>";
		echo "<td><input type='text' name='from' id = 'from' value = '".@$from."'/></td>";
		echo "<td>To</td>";
		echo "<td><input type='text' name='to' id = 'to' value = '".@$to."'/></td>";
		echo "<input type = 'hidden' name = 'hi' value = '1'>";
		echo "<td><input type='submit' name='src' id = 'src' value = 'Query' style = 'background-color:white'/></td>";
	echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br><br>";
if(@$_POST['hi'] == 1){
	echo "<table align='center' width = '750'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Custom Sales Report</td>";
		echo "</tr>";
	echo "</table>";
} else {
		echo "<table align='center' width = '750'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Today's Sales Report</td>";
		echo "</tr>";
	echo "</table>";
}

echo "<br>";
echo "<table align='center' width='750' style = 'font-family:verdana; font-size:11px'>";
	echo "<tr style='font-weight:bold'>";
		echo "<td style='border-bottom:2px solid black'>S.L</td>";
		echo "<td style='border-bottom:2px solid black'>Invoice No</td>";
		echo "<td style='border-bottom:2px solid black'>Date</td>";
		echo "<td style='border-bottom:2px solid black'>Item</td>";
		echo "<td style='border-bottom:2px solid black'>Unit Price</td>";
		echo "<td style='border-bottom:2px solid black'>Quantity</td>";
		echo "<td style='border-bottom:2px solid black'>Sold By</td>";
		echo "<td style='border-bottom:2px solid black'>Total</td>";
	echo "<tr>";
	
	if(isset($_POST['src'])){
		$sql = "SELECT * FROM voucher_list as vl, ledger as l WHERE vl.id = l.inv_sl AND vl.date >= '".$_POST['from']."' AND vl.date <= '".$_POST['to']."'";
		$rec = mysql_query($sql);
		$i = 0;
		$g_total = 0;
		while($row = mysql_fetch_array($rec)){
			$invoice_no = $row['invoice_no'];
			$inv_sl = $row['id'];
			$dat = $row['date'];
			
			$item = $row['product'];
			$unit = $row['unit_price'];
			$quantity = $row['quantity'];
			$total = $row['total'];
			$solder = $row['sold_by'];
			$g_total += $total;
			$i++;
			echo "<tr>";
				echo "<td>".@$i."</td>";
				echo "<td>".@$invoice_no."</td>";
				echo "<td>".@$dat."</td>";
				echo "<td>".@$item."</td>";
				echo "<td>".@$unit."</td>";
				echo "<td>".@$quantity."</td>";
				echo "<td>".@$solder."</td>";
				echo "<td>".@$total."</td>";
			echo "</tr>";
		}
	} else {
		$date = date("Y-m-d");
		$sql = "SELECT * FROM voucher_list as vl, ledger as l WHERE vl.id = l.inv_sl AND vl.date = '$date'";
		$rec = mysql_query($sql);
		$i = 0;
		$g_total = 0;
		while($row = mysql_fetch_array($rec)){
			$invoice_no = $row['invoice_no'];
			$inv_sl = $row['id'];
			$dat = $row['date'];
			
			$item = $row['product'];
			$unit = $row['unit_price'];
			$quantity = $row['quantity'];
			$total = $row['total'];
			$solder = $row['sold_by'];
			$g_total += $total;
			$i++;
			echo "<tr>";
				echo "<td>".@$i."</td>";
				echo "<td>".@$invoice_no."</td>";
				echo "<td>".@$dat."</td>";
				echo "<td>".@$item."</td>";
				echo "<td>".@$unit."</td>";
				echo "<td>".@$quantity."</td>";
				echo "<td>".@$solder."</td>";
				echo "<td>".@$total."</td>";
			echo "</tr>";
		}
	}
	echo "<tr><td colspan = '8' style = 'border-top:2px solid black; text-align:right; font-weight:bold'>Grand Total : ".@$g_total." BDT</td></tr>";
echo "</table>";
include_once("footer.php");