<?php
include_once("model.php");
$base = new model;
?>
<form action="item_wise_purchase_report.php" method="post">
<table align="left">
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
		
		$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date >= '$from' AND purchase_date <= '$to'";
		if($id != ''){
			$sql .= " AND pid = '$id'";
		}
		
		$rec = mysql_query($sql);
		$i = 0;
		$total_taka = 0;
		$total_item = 0;
		while($row = mysql_fetch_array($rec)){
			$pid	= $row['pid'];
			$item = $row['product'];
			$date = $row['purchase_date'];
			$qty = $row['quantity'];
			$purchase = $row['purchase_rate'];
			$suppliers_id = $row['suppliers_id'];
			$i++;
			
			$total = $qty * $purchase;
			$total_taka += $total;
			
			$total_item += $qty;
			
			echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".@$item."</td>";
				echo "<td>".cataName($pid)."</td>";
				echo "<td>".@$date."</td>";
				echo "<td>".@$purchase."</td>";
				echo "<td>".@$qty."</td>";
				echo "<td>".@$total." BDT</td>";
			echo "</tr>";
		}
	}
	echo "<tr><td colspan = '7' style = 'font-family:verdana; text-align:right; font-weight:bold'>Total Item : ".@$total_item." | Total Taka : ".@$total_taka." BDT</td></tr>";
	echo "<tr><td><a href = '#' onclick = 'window.print()'>Print</a></td></tr>";
echo "</table>";
	
function cataName($id){
	$sql = "SELECT * FROM stock_info WHERE id = '$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$cata = $row['cata'];
	}
	return $cata;	
}
	
	
	
	
	
	?>
	
    
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/ecmascript" src="js/auto_suggestion_4.js"></script>
<link href="css/auto_suggestion.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#iname").UISugestion();
    });
</script>