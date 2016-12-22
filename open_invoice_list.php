<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	$base_process = new model();
	
	if(isset($_GET['inv_sl'])){
		delete_invoice_info($_GET['inv_sl']);
	}
	
	$from 	= date("Y-m-01");
	$to		= date("Y-m-d");	
	echo "<table height='50'></table>";
	echo "<form action='open_invoice_list.php' method='post'>";
	echo "<table align='center' style='font-family:verdana; font-size:11px;' width='700'>";
		echo "<tr>";
			echo "<td>From</td>";
			echo "<td><input type='text' name = 'from' id = 'from' value = '$from'></td>";
			echo "<td>To</td>";
			echo "<td><input type='text' name='to' id = 'to' value = '$to'></td>";
			echo "<td>OR Name : </td>";
			echo "<td><input type='text' autocomplete = 'off' name = 'cust_name' id = 'cust_name'/></td>";
			echo "<td><input type = 'hidden' name = 'cust_id' id = 'cust_id'/></td>";
			echo "<td><input type='submit' value='Search' name='src'/></td>";
		echo "</tr>";
	echo "</table>";
	echo "</form>";
	
	
	//$table = 'voucher_list';
	echo "<table height='20'></table>";
	echo "<table align='center' width='650'>";
		echo "<tr>";
			echo "<td colspan='6' style='font-family:verdana; font-size:13px; font-weight:bold; text-align:center'>Invoice List</td>";
		echo "</tr>";
		echo "<tr><td height = '15'></td></tr>";
		echo "<tr style='font-family:verdana; font-size:12px; color:black; font-weight:bold'>";
			echo "<td style = 'border-bottom:2px solid black'>SL</td>";
			echo "<td style = 'border-bottom:2px solid black'>Invoice No</td>";
			echo "<td style = 'border-bottom:2px solid black'>Date</td>";
			echo "<td style = 'border-bottom:2px solid black'>Print Invoice</td>";
			echo "<td style = 'border-bottom:2px solid black'>Customer Name</td>";
			echo "<td style = 'border-bottom:2px solid black'>Contact</td>";
			echo "<td style = 'border-bottom:2px solid black'>Delete</td>";
			echo "<td style = 'border-bottom:2px solid black'>Total Taka</td>";
		echo "</tr>";
	if(isset($_POST['src'])){
		$from 	= $_POST['from'];
		$to		= $_POST['to'];
		
		$sql = "SELECT * FROM voucher_list WHERE date >= '$from' AND date <= '$to'";
		if($_POST['cust_id'] != ''){
			$sql .= "AND cust_id = '".$_POST['cust_id']."'";
		}
		
		$rec = mysql_query($sql);
		$i = 0;
		$t_total = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$inv_sl 		= $row['id'];
			$invoice_no 	= $row['invoice_no'];
			$g_total		= $row['g_total'];
			$cust_id		= $row['cust_id'];
			$date 			= $row['date'];
			$cust_info = getCustInfo($cust_id);
			
			echo "<tr style='font-family:verdana; font-size:11px;'>";
				echo "<td>".@$i."</td>";
				echo "<td><a href='detail_ledger.php?inv_sl=$inv_sl' target='_blank'>".@$invoice_no."</a></td>";
				echo "<td>".@$date."</td>";
				echo "<td><a href = 'prev_invoice1.php?inv=$invoice_no' target = '_blank'>Print</a></td>";
				echo "<td>".@$cust_info[0]."</td>";
				echo "<td>".@$cust_info[1]."</td>";
				echo "<td><a href = 'open_invoice_list.php?inv_sl=$inv_sl' onclick = \"return confirm('Do you want to delete ? (Y/N)')\">Delete</a></td>";
				echo "<td>".@$g_total." BDT</td>";
			echo "</tr>";
			$t_total += $g_total;
		}
	} else {
		$to		= date("Y-m-d");
		$sql = "SELECT * FROM voucher_list WHERE date = '$to'";
		$rec = mysql_query($sql);
		$i = 0;
		$t_total = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$inv_sl 		= $row['id'];
			$invoice_no 	= $row['invoice_no'];
			$g_total		= $row['g_total']."<br>";
			$cust_id		= $row['cust_id'];
			$date 			= $row['date'];			
			$cust_info = getCustInfo($cust_id);
			//print_r($cust_info);
			echo "<tr style='font-family:consolas; font-size:12px;'>";
				echo "<td>".@$i."</td>";
				echo "<td><a href='detail_ledger.php?inv_sl=$inv_sl' target = '_blank'>".@$invoice_no."</a></td>";
				echo "<td>".@$date."</td>";
				echo "<td><a href = 'prev_invoice1.php?inv=$invoice_no' target = '_blank'>Print</a></td>";
				echo "<td>".@$cust_info[0]."</td>";
				echo "<td>".@$cust_info[1]."</td>";
				echo "<td><a href = 'open_invoice_list.php?inv_sl=$inv_sl' onclick = \"return confirm('Do you want to delete ? (Y/N)')\">Delete</a></td>";
				echo "<td>".@$g_total."</td>";
			echo "</tr>";
			$t_total += $g_total;
		}	
	}
	echo "</table>";
	echo "<table align='center' border='0' cellspacing='0' width = '650'><tr><td style = 'text-align:right; border-top:2px solid black; font-family:verdana; font-size:12px; font-weight:bold'>Grand Total : ".@$t_total." BDT</td></tr></table>";
	
	
	function getCustInfo($cust_id){
		$cust_info = array();
		$sql = "SELECT * FROM customer_info WHERE cust_id = '$cust_id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$name = $row['name'];
			$contact = $row['contact'];
			
			$cust_info[] = $name;
			$cust_info[] = $contact;
		}
		return $cust_info;
	}
	
	function delete_invoice_info($inv_sl){
		$sql = "DELETE FROM voucher_list WHERE id = '$inv_sl'";
		mysql_query($sql);
		$sql1 = "DELETE FROM ledger WHERE inv_sl = '$inv_sl'";
		mysql_query($sql1);
	}
	
	include_once("footer.php");
?>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/new_js/auto_suggestion_1.js"></script>
<link href="css/auto_suggestion.css" type="text/css" rel="stylesheet" />

<script type="text/javascript">
	$(document).ready(function(e) {
        $("#cust_name").UISugestion_1();
    });
</script>