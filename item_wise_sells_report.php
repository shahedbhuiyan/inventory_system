<?php
include_once("model.php");
$base = new model;
?>
<form action="item_wise_sells_report.php" method="post">
<table align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">
	<tr>
    	<td>From : <input type="text" name="from" id="from" value="<?php echo date("Y-m-01"); ?>" /></td>
        <td>To : <input type="text" name="to" id="to" value="<?php echo date("Y-m-d"); ?>" /></td>
    	<td>OR Enter Item</td>
        <td><input type="text" name="iname" autocomplete="off" id="iname" /></td>
        <td><input type="submit" name="sub" id="sub" value="Search"/><input type="hidden" name="hid" id="hid" /></td>
   </tr>
</table>
</form>
<?php 
echo "<br><br>";
echo "<table border = '0' align='left' style='font-family:verdana; font-size:11px;' width = '600'>";
	echo "<tr style = 'font-weight:bold'>";
		echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
		echo "<td style = 'border-bottom:2px solid black'>Item</td>";
		echo "<td style = 'border-bottom:2px solid black'>Catagory</td>";
		echo "<td style = 'border-bottom:2px solid black'>Date</td>";
		echo "<td style = 'border-bottom:2px solid black'>Unit Price</td>";
		echo "<td style = 'border-bottom:2px solid black'>Quantity</td>";
		echo "<td style = 'border-bottom:2px solid black'>Total Taka</td>";
	echo "</tr>";

if(isset($_POST['sub'])){
	$id = $_POST['hid'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$today = date("Y-m-d");
	$sql = "SELECT * FROM voucher_list as vl, ledger as l WHERE vl.id = l.inv_sl AND vl.date >= '$from' AND vl.date <= '$to'";
	if($id != ''){
		$sql .= " AND l.item_id = '$id'";
	}
	//echo $sql;
	$rec = mysql_query($sql);
	$i = 0;
	$total_taka = 0;
	$total_qty = 0;
	while($row = mysql_fetch_array($rec)){
		$pid = $row['item_id'];
		$product = $row['product'];
		$unit = $row['unit_price'];
		$quantity = $row['quantity'];
		$total = $unit * $quantity;
		$total_qty += $quantity;
		$date = $row['date'];
		$total_taka += $total;
		$i++;
		
		echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".@$product."</td>";
			echo "<td>".cataName($pid)."</td>";
			echo "<td>".@$date."</td>";
			echo "<td>".@$unit."</td>";
			echo "<td>".@$quantity."</td>";
			echo "<td>".@$total."</td>";
		echo "</tr>";
	}
}
	echo "<tr><td colspan = '6' style = 'text-align:right; font-weight:bold'>Total Quantity : ".@$total_qty."</td><td style = 'text-align:right; font-weight:bold'> Total Taka : ".@$total_taka." BDT</td></tr>";
	echo "<tr><td><a href = '#' onclick = 'window.print()'>Print</a></td></tr>";
echo "</table>";

function cataName($id){
	$sql = "SELECT * FROM stock_info WHERE id = '$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$cata = $row['cata'];
	}
	return @$cata;	
}
?>


<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/ecmascript" src="js/auto_suggestion_4.js"></script>
<link href="css/auto_suggestion.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#iname").UISugestion();
    });
	
	/*function chkfield(){
		var val = document.getElementById("hid").value;
		if(val == ''){
			alert('Please enter or click over item name lists.....');
			return false;
		}
		return true;
	}*/
</script>