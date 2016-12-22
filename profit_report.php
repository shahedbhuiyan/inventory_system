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

echo "<form action='profit_report.php' method='post'>";
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
	echo "<table align='center' width = '750' border='0' cellspacing='0'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Custom Profit Report</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td style = 'font-family:verdana; font-size:11px; text-align:right'>From : ".@$_POST['from']." To : ".@$_POST['to']."</td>";
		echo "</tr>";
	echo "</table>";
} else {
		echo "<table align='center' width = '750'>";
		echo "<tr>"; 
			echo "<td style = 'font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Today's Profit Report</td>";
		echo "</tr>";
	echo "</table>";
}

echo "<table align='center' border='0' cellspacing='1' width='450' style = 'font-family:verdana; font-size:11px; font-weight:bold'>";
	echo "<tr style = 'font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>Name of Field's</td>";
		echo "<td style = 'border-bottom:2px solid black'>Amount</td>";
	echo "</tr>";

if(isset($_POST['src'])){
	$sql = "SELECT * FROM voucher_list as vl, ledger as l WHERE vl.id = l.inv_sl AND vl.date >= '".$_POST['from']."' AND vl.date <= '".$_POST['to']."'";
	$rec = mysql_query($sql);
	$sales_total = 0;
	$purchase_total = 0;
	while($row = mysql_fetch_array($rec)){
		$unit_price = $row['unit_price'];
		$purchase_price = $row['purchase'];
		$quantity = $row['quantity'];
		
		$sales_total += ($unit_price * $quantity);
		$purchase_total += ($purchase_price * $quantity);
	}
	
	@$get_total_profit = @$sales_total - @$purchase_total;

	$sql1 = "SELECT * FROM daily_expense WHERE dat >= '".$_POST['from']."' AND dat <= '".$_POST['to']."'";
	$rec1 = mysql_query($sql1);
	$total_amount = 0;
	while($row = mysql_fetch_array($rec1)){
		$taka = $row['eamount'];
		$total_amount += $taka;
	}
	
	$total_due = getDues(@$_POST['from'],@$_POST['to']);

	
	echo "<tr>";
		echo "<td>Total Sales Amount</td>";
		echo "<td>".@$sales_total." BDT</td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td>Total Purchase Amount</td>";
		echo "<td>".@$purchase_total." BDT</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>Total Due Amount</td>";
		echo "<td>".@$total_due." BDT</td>";
	echo "</tr>";
	echo "<tr><td style = 'border-top:2px solid black; text-align:left; color:red'>Total Profit</td><td style = 'border-top:2px solid black; color:red'>".(@$sales_total - @$purchase_total)." BDT</td></tr>";
	
	echo "<tr>";
		echo "<td>Total Expense</td>";
		echo "<td>".@$total_amount." BDT</td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td style = 'border-top:2px solid black; text-align:left; color:red'>Net Profit</td>";
		echo "<td style = 'border-top:2px solid black; text-align:left; color:red'>".(@$get_total_profit - @$total_amount)." BDT</td>";
	echo "</tr>";
	
} else {
	$total_sales_price = 0;
	$total_ary = array();
	$total_expense_price = 0;
	
	$total_sales_price = getDailySales_Amount();
	$total_ary = explode("|",$total_sales_price);
	
	$get_total_profit = $total_ary[0] - $total_ary[1];
	//$total_purchase_price = total_purchase_price();
	$total_expense_price = total_expense_price();	
	$total_due = getDues();
	
	echo "<tr>";
		echo "<td>Total Sales Amount</td>";
		echo "<td>".@$total_ary[0]." BDT</td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td>Total Purchase Amount</td>";
		echo "<td>".@$total_ary[1]." BDT</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>Total Due Amount</td>";
		echo "<td>".@$total_due." BDT</td>";
	echo "</tr>";
	echo "<tr><td style = 'border-top:2px solid black; text-align:left; color:red'>Total Profit</td><td style = 'border-top:2px solid black; color:red'>".(@$total_ary[0] - @$total_ary[1])." BDT</td></tr>";
	
	echo "<tr>";
		echo "<td>Total Expense</td>";
		echo "<td>".@$total_expense_price." BDT</td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td style = 'border-top:2px solid black; text-align:left; color:red'>Net Profit</td>";
		echo "<td style = 'border-top:2px solid black; text-align:left; color:red'>".(@$get_total_profit - @$total_expense_price)." BDT</td>";
	echo "</tr>";
}
echo "</table>";


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
			$purchase_total += ($purchase_price * $quantity);
		}
		return @$sales_total."|".@$purchase_total;
	}
	
	
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
	
	function getDues($from = NULL,$to = NULL){
		$today = date("Y-m-d");
		if($from != '' && $to != ''){
			$sql = "SELECT * FROM payment WHERE payment_date >= '$from' AND payment_date <= '$to' AND due != '0'";	
		} else {
			$sql = "SELECT * FROM payment WHERE payment_date = '$today' AND due != '0'";
		}
		$rec = mysql_query($sql);
		$total_due = 0;
		while($row = mysql_fetch_array($rec)){
			$due = $row['due'];
			
			$total_due += $due;
		}
		return $total_due;
	}
include_once("footer.php");