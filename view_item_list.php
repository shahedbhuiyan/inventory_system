<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	
	$base_process = new model();
		
	$select = array();
	$select[] = '*';
	
	$from = array();
	$table = "stock_info";
	$from[] = $table;
	
	$data = $base_process->get($select,$from);
	
	echo "<form action='view_item_list.php' method='post'>";
	echo "<table style='font-family:verdana; font-size:11px'>";
		echo "<tr>";
			echo "<td>Item Name</td>";
			echo "<td><input type='text' autocomplete = 'off' name='iname' id='iname'></td>";
			echo "<td>Brand Name</td>";
			echo "<td><input type='text' autocomplete = 'off' name='bname' id='bname'></td>";
			echo "<td>Catagory</td>";
			echo "<td><input type='text' name='cata' autocomplete = 'off' id='cata'></td>";
			echo "<td><input type='submit' name='src' value='Search'></td>";
		echo "</tr>";
	echo "</table>";
	echo "</form>";
	
	echo "<table border='0' align='left' width = '1000'><tr><td height = '10' style = 'text-align:center; font-weight:bold'>Total Stock Amount : ".getTotalStockAmount()." BDT</td></tr></table>";
	echo "<br><br>";
	echo "<table cellspacing='1' align='left' width='1000' border='0' style='font-family:\"verdana\"; font-size:12px;'>";
		echo "<tr style='font-weight:bold; color:black'>";
			echo "<td style='border-bottom:2px solid black'>S.L</td>";
			echo "<td style='border-bottom:2px solid black'>Item Name</td>";
			echo "<td style='border-bottom:2px solid black'>Brand</td>";
			echo "<td style='border-bottom:2px solid black'>Cetagory</td>";
			echo "<td style='border-bottom:2px solid black'>Descreption</td>";
			echo "<td style='border-bottom:2px solid black'>Purchase</td>";
			echo "<td style='border-bottom:2px solid black'>Sales</td>";
			echo "<td style='border-bottom:2px solid black'>Quantity</td>";
			echo "<td style='border-bottom:2px solid black'>Edit</td>";
			echo "<td style='border-bottom:2px solid black'>Add Item</td>";
		echo "</tr>";
	if(isset($_POST['src'])){
		$iname 	= $_POST['iname'];
		$brand	= $_POST['bname'];
		$cata 	= $_POST['cata'];
		$sql = "SELECT * FROM stock_info WHERE product = '$iname' OR brand = '$brand' OR cata = '$cata'";	
		$rec = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$id			= $row['id'];
			$product 	= $row['product'];
			$brand		= $row['brand'];
			$cata		= $row['cata'];
			$desc  		= $row['description'];
			$purchase	= $row['purchase'];
			$sales		= $row['sales'];
			$quantity	= $row['quantity'];
			
			echo "<tr style = 'font-size:11px'>";
				echo "<td>".$i."</td>";
				echo "<td>".@$product."</td>";
				echo "<td>".@$brand."</td>";
				echo "<td>".@$cata."</td>";
				echo "<td>".@$desc."</td>";
				echo "<td>".@$purchase."</td>";
				echo "<td>".@$sales."</td>";
				echo "<td>".@$quantity."</td>";
				echo "<td><a href='#' onclick = 'window.open(\"edit_stock_item.php?id=$id\",\"\",\"height=300,width=400\")'>Edit</a></td>";
				echo "<td><a href='#' onclick = 'window.open(\"add_item.php?id=$id\",\"\",\"height=300,width=400\")'>Add Item</a></td>";
			echo "</tr>";
		}
	} else {
		$i = 0;
		foreach($data as $val){
			$i++;
			if(isset($val)){
				extract($val);
				echo "<tr style = 'font-size:11px'>";
					echo "<td>$i</td>";
					echo "<td>$product</td>";
					echo "<td>$brand</td>";
					echo "<td>$cata</td>";
					if($description == ''){
						$description = 'N/A';	
					}
					echo "<td>$description</td>";
					echo "<td>$purchase</td>";
					echo "<td>$sales</td>";
					echo "<td>$quantity</td>";
					echo "<td><a href='#' onclick = 'window.open(\"edit_stock_item.php?id=$id\",\"\",\"height=300,width=400\")'>Edit</a></td>";
					echo "<td><a href='#' onclick = 'window.open(\"add_item.php?id=$id\",\"\",\"height=300,width=400\")'>Add Item</a></td>";
				echo "</tr>";	
			}
			
		}
	}
	echo "</table>";
	
	function getTotalStockAmount(){
		$sql = "SELECT * FROM stock_info";
		$rec = mysql_query($sql);
		$grand_total = 0;
		$total = 0;
		while($row = mysql_fetch_array($rec)){
			$qty = $row['quantity'];
			$purchase = $row['purchase'];
			
			$total = ($qty * $purchase);
			
			$grand_total += $total;
		}
		//return $grand_total;
		return number_format($grand_total,0,",",",");	
	}	
?>
<style type="text/css">
	.aa{text-decoration:none}
body {
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 13px;
    color: #444;
}	
.zebra td, .zebra th {
    padding: 2px;
    border-bottom: 1px solid #f2f2f2;    
}

.zebra tbody tr:nth-child(even) {
    background: #f5f5f5;
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
}

.zebra th {
    text-align: left;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
    border-bottom: 1px solid #ccc;
    background-color: #eee;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
    background-image: -webkit-linear-gradient(top, #f5f5f5, #eee);
    background-image:    -moz-linear-gradient(top, #f5f5f5, #eee);
    background-image:     -ms-linear-gradient(top, #f5f5f5, #eee);
    background-image:      -o-linear-gradient(top, #f5f5f5, #eee); 
    background-image:         linear-gradient(top, #f5f5f5, #eee);
}

.zebra th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;  
}

.zebra th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.zebra th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.zebra tfoot td {
    border-bottom: 0;
    border-top: 1px solid #fff;
    background-color: #f1f1f1;  
}

.zebra tfoot td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.zebra tfoot td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

.zebra tfoot td:only-child{
    -moz-border-radius: 0 0 6px 6px;
    -webkit-border-radius: 0 0 6px 6px
    border-radius: 0 0 6px 6px
}
</style>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/auto_suggestion_2.js"></script>
<link rel="stylesheet" type="text/css" href="css/auto_suggestion.css" />
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#iname").UISugestion();
		$("#bname").UISugestion();
		$("#cata").UISugestion();
    });
	
</script>