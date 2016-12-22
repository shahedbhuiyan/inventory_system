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
$to	= date("Y-m-d");

echo "<form action='daily_expense_report.php' method='post'>";
echo "<table align='center' border = '0' width='600' style = 'font-size:12px; font-family:verdana;'>"; 
	echo "<tr>"; 
		echo "<td>From</td>";
		echo "<td><input type='text' name='from' id = 'from' value = '".@$from."' /></td>";
		echo "<td>To</td>";
		echo "<td><input type='text' name='to' id = 'to' value = '".@$to."' /></td>";
		echo "<input type = 'hidden' name = 'hi' value = '1'>";
		echo "<td><input type='submit' name='src' id = 'src' value = 'Query' style = 'background-color:white'/></td>";
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

echo "<table align='center' width='650' style = 'font-family:verdana; font-size:11px'>";
	echo "<tr style='font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Expense Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Expense Type</td>";
		echo "<td style = 'border-bottom:2px solid black'>Descreption</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Amount</td>";
	echo "<tr>";

if(isset($_POST['src'])){
	$sql = "SELECT * FROM daily_expense WHERE dat >= '".$_POST['from']."' AND dat <= '".$_POST['to']."'";
	$rec = mysql_query($sql);
	$i = 0;
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$i++;
		$ename = $row['ename'];
		$etype = $row['etype'];
		$desc = $row['description'];
		$dat = $row['dat'];
		$eamount = $row['eamount'];
		$g_total += $eamount;
		
		echo "<tr>";
			echo "<td>".@$i."</td>";
			echo "<td>".@$ename."</td>";
			echo "<td>".@$etype."</td>";
			echo "<td>".@$desc."</td>";
			echo "<td>".@$dat."</td>";
			echo "<td>".@$eamount."</td>";
		echo "</tr>";
	}
} else {
	$date = date("Y-m-d");
	$sql = "SELECT * FROM daily_expense WHERE dat = '$date'";
	$rec = mysql_query($sql);
	$i = 0;
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$i++;
		$ename = $row['ename'];
		$etype = $row['etype'];
		$desc = $row['description'];
		$dat = $row['dat'];
		$eamount = $row['eamount'];
		$g_total += $eamount;
		echo "<tr>";
			echo "<td>".@$i."</td>";
			echo "<td>".@$ename."</td>";
			echo "<td>".@$etype."</td>";
			echo "<td>".@$desc."</td>";
			echo "<td>".@$dat."</td>";
			echo "<td>".@$eamount."</td>";
		echo "</tr>";
	}	
}
	echo "<tr><td colspan = '6' style = 'border-top:2px solid black; text-align:right; font-weight:bold'>Total Expense : ".@$g_total." BDT</td></tr>";
echo "</table>";
include_once("footer.php");