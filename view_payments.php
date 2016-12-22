<?php
 if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
 include_once("header.php");
 include_once("model.php");
 
 $base_process = new model();
 $select = array();
 $select[] = '*';
 
 $from = array();
 $table = "payment_log";
 $from[] = $table;
 $where = array();
 $where['date'] = date("Y-m-d");
 
 
 $frm 	= date("Y-m-01");
 $to	= date("Y-m-d");
 
 echo "<form action='view_payments.php' method='post'>";
 echo "<table align='center' style='font-family:verdana; font-size:11px;'>";
 	echo "<tr>";
		echo "<td>From</td>";
		echo "<td><input type='text' name='from' value = '$frm'></td>";
		echo "<td>To</td>";
		echo "<td><input type='text' name='to' value = '$to'></td>";
		echo "<td>OR Name : </td>";
		echo "<td><input type='text' autocomplete = 'off' name = 'cust_name' id = 'cust_name'/></td>";
		echo "<td><input type = 'hidden' name = 'cust_id' id = 'cust_id'/></td>";
		echo "<td><input type = 'submit' name = 'search' value = 'Search'/></td>";
	echo "</tr>";
 echo "</table>";
 echo "</form>";
 echo "<br>";
 echo "<table align='center' style='font-family:verdana; font-weight:bold; font-size:12px'><tr><td>Payment Details</td></tr></table>";
 echo "<br>";
 echo "<table align='center' width='500' border='0' style='font-family:verdana; font-size:11px;' cellspacing='1'>";
 	echo "<tr style = 'font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Invoice No</td>";
		echo "<td style = 'border-bottom:2px solid black'>Customer Name</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Payment</td>";
		echo "<td style = 'border-bottom:2px solid black'>Edit</td>";
	echo "</tr>";
	if(isset($_POST['search'])){
		$form 	= $_POST['from'];
		$to		= $_POST['to'];
		$sql = "SELECT * FROM payment_log WHERE date>='$form' AND date<='$to'";
		if($_POST['cust_id'] != ''){
			$sql .= "AND cst_id = '".$_POST['cust_id']."'";
		}
		$rec = mysql_query($sql);
		$i = 0;
		$total_paid = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$invoice_no = $row['invoice_no'];
			$date		= $row['date'];
			$payment	= $row['payment'];
			$cst_id 	= $row['cst_id'];
			@$cust_name = getCustomerName($cst_id);
			echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>$invoice_no</td>";
				echo "<td>".@$cust_name."</td>";
				echo "<td>$date</td>";
				echo "<td>$payment</td>";
				if($date == date("Y-m-d")){
					echo "<td><a href = '#' onclick = \"window.open('edit_payment.php?inv=$invoice_no','','width=400,height=250')\">Edit</a></td>";
				} else {
					echo "<td>Edit</td>";	
				}
			echo "</tr>";
			$total_paid += $payment;
		}
	} else {
		$data = $base_process->get($select,$from,$where);
		$i = 0;
		$total_paid = 0;
		foreach($data as $val){
			if(is_array($val))
				extract($val);
			$i++;
			@$cust_name = getCustomerName($cst_id);
			echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>$invoice_no</td>";
				echo "<td>".@$cust_name."</td>";
				echo "<td>$date</td>";
				echo "<td>$payment</td>";
				if($date == date("Y-m-d")){
					echo "<td><a href = '#' onclick = \"window.open('edit_payment.php?inv=$invoice_no','','width=400,height=250')\">Edit</a></td>";
				} else {
					echo "<td>Edit</td>";
				}
			echo "</tr>";
			$total_paid += $payment;
		}
	}
	echo "<tr><td colspan = '6' style = 'font-size:12px; font-weight:bold; border-top:2px solid black; text-align:right'>Total Paid : ".@$total_paid." BDT</td></tr>";
 echo "</table>";

function getCustomerName($cst_id){
	$sql = "SELECT * FROM customer_info WHERE cust_id = '$cst_id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		@$name = $row['name'];
	}
	return @$name;	
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
