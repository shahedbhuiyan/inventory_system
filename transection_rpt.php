<?php
include_once("header.php");
include_once("model.php");
$base = new model();
?>
<form action="transection_rpt.php" method="post">
<table align="center">
	<tr><td>From : <input type="text" name="from" id="from" value="<?php echo date("Y-m-01"); ?>" /> To : <input type="text" name="to" id="to" value="<?php echo date("Y-m-d"); ?>" />  <input type="submit" name="search" value="Search"/></td></tr>
</table>
</form>
<table height="30"></table>
<?php
	echo "<table align='center' width='800' border='0' style='font-family:calibri; font-size:13px;' cellpadding='3'>";
		echo "<tr>";
			echo "<td style='border-bottom:2px solid black'>S.L</td>";
			echo "<td style='border-bottom:2px solid black'>Date</td>";
			echo "<td style='border-bottom:2px solid black'>Bank Name</td>";
			echo "<td style='border-bottom:2px solid black'>Debit</td>";
			echo "<td style='border-bottom:2px solid black'>Credit</td>";
			echo "<td style='border-bottom:2px solid black'>Previous Balance</td>";
			echo "<td style='border-bottom:2px solid black'>Balance</td>";
			echo "<td style='border-bottom:2px solid black'>Paid To</td>";
		echo "</tr>";
if(isset($_POST['from'],$_POST['to'])){
	$sql = "SELECT * FROM transec WHERE trns_date >= '".$_POST['from']."' AND trns_date <= '".$_POST['to']."'";
	$rec = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($rec)){
		$acc_id 			= $row['acc_id'];
		$trnsection_taka	= $row['trnsection_taka'];
		$balance			= $row['balance'];
		$paid_to			= $row['paid_to'];
		$trns_type 			= $row['trns_type'];
		$trns_date			= $row['trns_date'];
		$prev_balance		= $row['prev_balance'];
		
		$bank_name			= getAccountName($acc_id);
		$get_name			= getPaidName($paid_to);
		$i++;
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$trns_date</td>";
			echo "<td>$bank_name</td>";
			if($trns_type == 'DR'){
				echo "<td style='text-align:center'>$trnsection_taka BDT</td>";
				echo "<td style='text-align:center'> --- </td>";	
			} else {
				echo "<td style='text-align:center'> --- </td>";
				echo "<td style='text-align:center'>$trnsection_taka BDT</td>";	
			}
			echo "<td>$prev_balance BDT</td>";
			echo "<td>$balance BDT</td>";
			echo "<td>$get_name</td>";
		echo "</tr>";
	}
} else {
	$sql = "SELECT * FROM transec WHERE trns_date = '".date("Y-m-d")."'";
	$rec = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($rec)){
		$acc_id 			= $row['acc_id'];
		$trnsection_taka	= $row['trnsection_taka'];
		$balance			= $row['balance'];
		$paid_to			= $row['paid_to'];
		$trns_type 			= $row['trns_type'];
		$trns_date			= $row['trns_date'];
		$prev_balance		= $row['prev_balance'];
		
		$bank_name			= getAccountName($acc_id);
		$get_name			= getPaidName($paid_to);
		$i++;
		echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>$trns_date</td>";
			echo "<td>$bank_name</td>";
			if($trns_type == 'DR'){
				echo "<td style='text-align:center'>$trnsection_taka BDT</td>";
				echo "<td style='text-align:center'> --- </td>";	
			} else {
				echo "<td style='text-align:center'> --- </td>";
				echo "<td style='text-align:center'>$trnsection_taka BDT</td>";	
			}
			echo "<td>$prev_balance BDT</td>";
			echo "<td>$balance BDT</td>";
			echo "<td>$get_name</td>";
		echo "</tr>";
	}	
}
echo "</table>";

function getAccountName($acc_id){
	$sql = "SELECT * FROM bank WHERE id = '".$acc_id."'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$bank = $row['bname'];
	}
	return $bank;	
}

function getPaidName($paid_to){
	$sql = "SELECT * FROM suppliers WHERE sid = '".$paid_to."'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$sname = $row['sname'];
	}
	if(@$sname != ''){
		return @$sname;
	} else {
		return @$paid_to;	
	}
}
include_once("footer.php");