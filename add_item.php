<?php
if(!session_id()) session_start();
if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
	header("Location: ./login.php");
	exit;
}
include_once("model.php");
$base_process = new model();
$suppliers_ids = $base_process->getSuppliersArray();

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM stock_info WHERE id = '$id'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$product = $row['product'];
		$cata	= $row['cata'];
		$quantity = $row['quantity'];
		$brand = $row['brand'];
		$purchase = $row['purchase'];
	}
}

if(isset($_POST['upd'])){
	$id = $_POST['id'];
	$dat = $_POST['dat'];
	$suppliers = $_POST['suppliers'];
	$pqty = $_POST['pqty'];
	$pre_qty = $_POST['pre_qty'];
	$ni_qty = $_POST['ni_qty'];
	$product = $_POST['iname'];
	
	$brand = $_POST['brand'];
	$purchase = $_POST['purchase'];
	
	$sql = "UPDATE stock_info SET quantity = '$pre_qty' WHERE id = '$id'";
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
		$sql1 = "INSERT into stock_qty_log SET pid = '$id', up_date = '$dat', prev_qty = '$pqty', pres_qty = '$pre_qty', added_qty = '$ni_qty'";
		mysql_query($sql1);
		$sql2 = "INSERT into suppliers_buying_ledger SET pid = '$id', product = '$product', purchase_date = '$dat', quantity = '$ni_qty',purchase_rate = '$purchase', brand = '$brand', suppliers_id = '$suppliers'";
		mysql_query($sql2);
		if(!check_suppliers($suppliers,$dat)){
			$sql = "INSERT into daily_suppliers SET sid = '$suppliers', date = '$dat'";
			mysql_query($sql);
		}
	}
	if(mysql_affected_rows() == 1){
	?>
    <script type="text/javascript">
    	alert("Update Sucessfully");
		self.close();
		top.window.opener.location.reload();
    </script>
    <?php
	} else {
		echo "Item insertion failed....";	
	}
}

	function check_suppliers($sid,$sdate){
		$sql = "SELECT * FROM daily_suppliers WHERE date = '$sdate' AND sid = '$sid'";
		$rec = mysql_query($sql);
		$numRows = mysql_num_rows($rec);
		if($numRows>0){
			return true;
		} else {
			return false;	
		}
	}

?>
<form action="add_item.php" method="post" onSubmit="return checkForm(this)">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<input type="hidden" name="brand" id="brand" value="<?php echo $brand; ?>"/>
<input type="hidden" name="purchase" id="purchase" value="<?php echo $purchase; ?>">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:left">
	<tr>
    	<th colspan="3" style="text-align:center; font-family:Verdana, Geneva, sans-serif">Add Item</th>
    </tr>
    
    <tr>
    	<td>Suppliers</td>
        <td>:</td>
        <td><select id="suppliers" name="suppliers">
        	<option value="">---------------------</option>
        <?php
			foreach($suppliers_ids as $k=>$v){
				echo "<option value = '".@$k."'>".@$v."</option>";
			}
		?>
        </select></td>
    </tr>
    <tr>
    	<td>Date</td>
        <td>:</td>
        <td><input type="text" name="dat" id="dat" value="<?php echo date("Y-m-d"); ?>" readonly></td>
    </tr>
    <tr>
    	<td>Item Name</td>
        <td>:</td>
        <td><input type="text" name="iname" id="iname" readonly value="<?php echo @$product; ?>"></td>
    </tr>
    
    <tr>
    	<td>Item Catagory</td>
        <td>:</td>
        <td><input type="text" name="cata" id="cata" readonly value="<?php echo @$cata; ?>"></td>
    </tr>
    
    <tr>
    	<td>Previous Quantity</td>
        <td>:</td>
        <td><input type="text" name="pqty" id="pqty" readonly style="text-align:center; color:red;" value="<?php echo @$quantity; ?>"></td>
    </tr>
    
    <tr>
    	<td>Present Quantity</td>
        <td>:</td>
        <td><input type="text" name="pre_qty" id="pre_qty" readonly style="text-align:center; color:red;" value="<?php echo @$quantity; ?>"></td>
    </tr>
    
    <tr>
    	<td>New Item Quantity</td>
        <td>:</td>
        <td><input type="text" name="ni_qty" id="ni_qty"/></td>
    </tr>
    
    <tr><td colspan="3" align="center"><input type="submit" name="upd" value="Insert" style="background-color:white"/></td></tr>
</table>
</form>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	var t = 0;
	var new_item = 0;
	$(document).ready(function(e) {
        $("#ni_qty").bind('keyup',function(){
			var prev = $("#pqty").val();
			var val = parseFloat(this.value);
			if(!val) val = 0;
			val = val - t;
			
			new_item = parseFloat(prev) + parseFloat(val);
			$("#pre_qty").val(new_item);
		});
    });
	function checkForm(){
		var suplrs = document.getElementById("suppliers").value;
		if(suplrs == ''){
			alert('Select suppliers name....');
			return false;
		}
		var ni_qty = document.getElementById("ni_qty").value;
		if(ni_qty == ''){
			alert('Fill new item quantity....');
			return false;
		}	
		return true;
	}
</script>