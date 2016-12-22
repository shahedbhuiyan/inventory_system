<?php
	include_once("model.php");
	$base = new model();
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT * FROM stock_info WHERE id = '$id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$id = $row['id'];
			$product = $row['product'];
			$brand	= $row['brand'];
			$cata = $row['cata'];
			$desc = $row['description'];
			$purchase = $row['purchase'];
			$sales = $row['sales'];
			$quantity = $row['quantity'];
		}
	}
	
	if(isset($_POST['upd'])){
		$id = $_POST['id'];
		$product = $_POST['iname'];
		$brand = $_POST['brand'];
		$cata = $_POST['cata'];
		$desc = $_POST['desc'];
		$purchase = $_POST['purchase'];
		$sales = $_POST['sales'];
		$quantity = $_POST['quantity'];
		
		$sql = "UPDATE stock_info SET product = '$product', brand = '$brand', cata = '$cata', description = '$desc', purchase = '$purchase', sales = '$sales', quantity = '$quantity' WHERE id = '$id'";
		mysql_query($sql);
		
		if(mysql_affected_rows() == 1){
		?>
        <script type="text/javascript">
        	alert("Update Sucessfully");
			self.close();
			top.window.opener.location.reload();
        </script>
        <?php
		} else {
			echo "<table align='center'><tr><td style = 'color:red; font-family:verdana; font-size:12px; font-weight:bold; text-align:center'>Update Failed</td></tr></table>";	
		}		
	}
?>

<form action="edit_stock_item.php" method="post">
<input type="hidden" name="id" id="id" value="<?php echo @$id; ?>"/>
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; text-align:left">
	<tr>
    	<td colspan="3" style="font-size:13px; text-align:center; font-weight:bold">Edit Item</td>
    </tr>
    
    <tr>
    	<td>Item Name</td>
        <td>:</td>
        <td><input type="text" name="iname" id="iname" value="<?php echo @$product; ?>"></td>
    </tr>
    
    <tr>
    	<td>Brand</td>
        <td>:</td>
        <td><input type="text" name="brand" id="brand" value="<?php echo @$brand; ?>"></td>
    </tr>
    
    <tr>
    	<td>Catagory</td>
        <td>:</td>
        <td><input type="text" name="cata" id="cata" value="<?php echo @$cata; ?>"></td>
    </tr>
    
    <tr>
    	<td>Descreption</td>
        <td>:</td>
        <td><input type="text" name="desc" id="desc" value="<?php echo @$desc; ?>"></td>
    </tr>
    
    <tr>
    	<td>Purchase Rate</td>
        <td>:</td>
        <td><input type="text" name="purchase" id="purchase" value="<?php echo @$purchase; ?>"></td>
    </tr>
    <tr>
    	<td>Sales Rate</td>
        <td>:</td>
        <td><input type="text" name="sales" id="sales" value="<?php echo @$sales; ?>"></td>
    </tr>
    
    <tr>
    	<td>Quantity</td>
        <td>:</td>
        <td><input type="text" name="quantity" id="quantity" value="<?php echo @$quantity; ?>"></td>
    </tr>
    
    <tr><td colspan="3" align="center"><input type="submit" name="upd" style="background-color:white" value="Update"/></td></tr>
</table>
</form>