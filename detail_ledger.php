<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	$base_process = new model();
	if(isset($_GET['inv_sl'])){
		$get_invoice = get_invoice($_GET['inv_sl']);
		$get_customer_id = get_customer_id($_GET['inv_sl']);
		$get_customer = get_customer($get_customer_id);
	}
	
	echo "<table align='left' border='0' cellspacing='0'>";
	echo "<tr>";
	echo "<td>";
	echo "<table align='left' width='700' style='font-family:verdana; font-size:11px'>";
		echo "<tr>";
			echo "<td colspan='6' style='font-family:verdana; font-size:13px; font-weight:bold; text-align:center'>Company Name Here</td>";
		echo "</tr>";
		echo "<tr><td height = '20'></td></tr>";
		echo "<tr>";
			echo "<td>Invoice No</td>";
			echo "<td>:</td>";
			echo "<td><b>".@$get_invoice."</b></td>";
			echo "<td>Customer Name</td>";
			echo "<td>:</td>";
			echo "<td><b>".@$get_customer."</b></td>";
		echo "</tr>";
	echo "</table>";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr><td height = '15'></td></tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "<table align='left' border='0' width='700' style='font-family:verdana; font-size:11px'>";
		echo "<tr style='font-weight:bold'>";
			echo "<td>S.L</td>";
			echo "<td>Item Name</td>";
			echo "<td>Quantity</td>";
			echo "<td>Unit Price</td>";
			echo "<td>Total</td>";
		echo "</tr>";
	
	if(isset($_GET['inv_sl'])){
		$inv_sl = $_GET['inv_sl'];
		$sql = "SELECT * FROM voucher_list as vl, ledger l WHERE vl.id = l.inv_sl AND vl.id = '$inv_sl'";
		$rec = mysql_query($sql);
		$i = 0;
		$g_total = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$product 	= $row['product'];
			$unit_price	= $row['unit_price'];
			$quantity	= $row['quantity'];
			$total		= $row['total'];
			
			echo "<tr>";
				echo "<td>".@$i."</td>";
				echo "<td>".@$product."</td>";
				echo "<td>".@$quantity."</td>";
				echo "<td>".@$unit_price."</td>";
				echo "<td>".@$total."</td>";
			echo "</tr>";
			$g_total += $total;
		}
	}
	
	echo "</table>";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td style = 'border-top:2px solid black; font-family:verdana; font-size:13px; font-weight:bold; text-align:right'>Grand Total : ".@$g_total." BDT"."</td></tr>";
	echo "</table>";
	
	
	function get_invoice($inv_sl){
		$sql = "SELECT * FROM voucher_list WHERE id = '$inv_sl'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$invoice = $row['invoice_no'];
		}
		return $invoice;
	}
	
	function get_customer_id($inv_sl){
		$sql = "SELECT * FROM voucher_list WHERE id = '$inv_sl'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$cust_id = $row['cust_id'];
		}
		return $cust_id;
	}
	
	function get_customer($id){
		$sql = "SELECT * FROM customer_info WHERE cust_id = '$id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$name = $row['name'];
		}
		return $name;
	}