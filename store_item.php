<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	$base_process = new model();
	$suppliers_ids = $base_process->getSuppliersArray();
	$new_id = $base_process->incrementId("stock_info","id");
	if(isset($_POST['sub'])){
		@$status_02 = $base_process->existance_check("SELECT * FROM stock_info WHERE id = '".$_POST['pid']."'");
		if(!$status_02){
			$data_insert 			= array();
			$suppliers_data 		= array();
			$purchase_date			= date("Y-m-d");
			$table_of_suppliers 	= "suppliers_buying_ledger";
			$table 					= "stock_info";
			
			$table_of_stock_qty = "stock_qty_log";
			$stock_qty_log = array();
			
			//for suppliers_buying_ledger table
			$suppliers_data['product']				= $_POST['iname'];
			$suppliers_data['purchase_date']		= $purchase_date;
			$suppliers_data['quantity']				= $_POST['quantity'];
			$suppliers_data['purchase_rate']		= $_POST['pprice'];
			$suppliers_data['suppliers_id']			= $_POST['sname'];
			$suppliers_data['brand']				= $_POST['bname'];
			$suppliers_data['pid']					= $_POST['pid'];
			
			$status_01	= $base_process->dataInsertion($table_of_suppliers,$suppliers_data);
			
			//for stock_info table
			$data_insert['id']				= $_POST['pid'];
			$data_insert['product']			= $_POST['iname'];
			$data_insert['brand']			= $_POST['bname'];
			$data_insert['cata']			= $_POST['cata'];
			$data_insert['description']		= $_POST['desc'];
			$data_insert['purchase']		= $_POST['pprice'];
			$data_insert['sales']			= $_POST['sprice'];
			$data_insert['quantity']		= $_POST['quantity'];
			
			$status = $base_process->dataInsertion($table,$data_insert);
			
			$stock_qty_log['pid']			= $_POST['pid'];
			$stock_qty_log['up_date']		= $purchase_date;
			$stock_qty_log['pres_qty']		= $_POST['quantity'];
			$stock_qty_log['added_qty']		= $_POST['quantity'];
			
			$status_03 = $base_process->dataInsertion($table_of_stock_qty,$stock_qty_log);
			if(!check_suppliers($_POST['sname'],$purchase_date)){
				$sql = "INSERT into daily_suppliers SET sid = '".$_POST['sname']."',date = '".$purchase_date."'";
				mysql_query($sql);	
			}
			$new_id = $base_process->incrementId("stock_info","id");
		} else {
			echo "Data is already exists....";	
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
<table height="50"></table>
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; vertical-align:text-top"><tr><td>New Items</td></tr></table>
<form action="store_item.php" method="post" onsubmit="return check_form()">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; vertical-align:text-top">
	<tr>
    	<td>Item ID</td>
        <td>:</td>
        <td><input type="text" name="pid" id="pid" readonly="readonly" style="text-align:center; color:red;" value="<?php echo @$new_id; ?>" /></td>
    </tr>
	<tr>
    	<td>Suppliers Name</td>
        <td>:</td>
        <td><select name="sname" id="sname">
        <option value="">------Select------</option>
		<?php
			foreach($suppliers_ids as $k=>$v){
				echo "<option value = '$k'>$v</option>";
			}
		?>
        </select></td>
    </tr>
        
    <tr>
    	<td>Item Name</td>
        <td>:</td>
        <td><input type="text" name="iname" id="iname"></td>
    </tr>
    
    <tr>
    	<td>Brand Name</td>
        <td>:</td>
        <td><input type="text" name="bname" id="bname"></td>
    </tr>
    
    <tr>
    	<td>Catagories</td>
        <td>:</td>
        <td><input type="text" name="cata" id="cata"></td>
    </tr>
    
    <tr>
    	<td>Description</td>
        <td>:</td>
        <td><textarea id="desc" name="desc"></textarea></td>
    </tr>
    
    <tr>
    	<td>Purchase Price(Per Unit)</td>
        <td>:</td>
        <td><input type="text" name="pprice" id="pprice"></td>
    </tr>
    
    <tr>
    	<td>Sales Price(Per Unit)</td>
        <td>:</td>
        <td><input type="text" name="sprice" id="sprice"></td>
    </tr>
    
    <tr>
    	<td>Quantity</td>
        <td>:</td>
        <td><input type="text" name="quantity" id="quantity"></td>
    </tr>
    
    <tr>
    	<td colspan="3"><input type="submit" name="sub" id="sub" value="Save"></td>
    </tr>
</table>
</form>
<?php	
	include_once("footer.php");
?>

<script type="text/javascript">
	function check_form(){
		
		var sname	= document.getElementById("sname").value;
		if(sname.length == 0){
			alert('Suppliers name is null....');
			return false;
		}
		
		var iname	= document.getElementById("iname").value;
		if(iname.length == 0){
			alert('Item name is null....');
			return false;
		}
		var purchase_price = document.getElementById("pprice").value;
		if(purchase_price.length == 0){
			alert('Purchase price is null....');
			return false;
		}
		var quantity = document.getElementById("quantity").value;
		if(quantity.length == 0){
			alert('Quantity is null....');
			return false;
		}
		return true;
	}
</script>