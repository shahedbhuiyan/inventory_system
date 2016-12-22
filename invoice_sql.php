<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("model.php");
	
	$base_system = new model();
	$action = $_POST['action'];
	
	if($action == 'create'){
		data_grid();
	} else if($action == 'getPrice'){
		getPrice();
	} else if($action == 'getInfo'){
		getInfo();	
	} else if($action == 'invoice_list'){
		voucher_list();
		set_payment();
	} else if($action == 'ledger'){
		setLedger();
	} else if($action == 'create_invoice'){
		create_vno();
	} else if($action == 'getDuesInfo'){
		getDuesInfo();
	} else if($action == 'delilery_info'){
		set_delivery_info();
	} else if($action == 'get_cust_id'){
		getLastCustId();	
	} else if($action == 'set'){
		set();
	} else if($action = 'reset'){
		Reset_1();	
	}
	
	function getDuesInfo(){
		$invoice = $_POST['invoice'];
		
		$sql = "SELECT * FROM voucher_list WHERE invoice_no = '$invoice'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			@$cust_id = $row['cust_id'];
		}
		
		$sql = "SELECT * FROM customer_info WHERE cust_id = '".@$cust_id."'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			@$name = $row['name'];
		}
		
		$sql = "SELECT * FROM payment WHERE invoice_no = '$invoice'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			@$paid_amount		= $row['paid_amount'];
			@$due				= $row['due'];
		}
		
		echo $str = @$name."|".@$due."|".@$cust_id;	
	}
	
	function create_vno(){
		$sql = "SELECT MAX(id) as id FROM voucher_list";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$id = $row['id'];
		}
		
		$sql2 = "SELECT * FROM voucher_list WHERE id = '$id'";
		$rec12 = mysql_query($sql2);
		while($row2 = mysql_fetch_array($rec12)){
			$vno = $row2['invoice_no'];
		}
		
		if(isset($vno)){
			$sql1 = "SELECT * FROM voucher_list WHERE invoice_no = '$vno'";
			$rec1 = mysql_query($sql1);
			if($row1 = mysql_fetch_array($rec1)){
				$id = $row1['id'];
			}
		} else {
			$id = 0;	
		}
		@$vno = substr($vno,-4);
		$vno++;
		@$id++;
		if($vno == 1){
			$new_vno = "INV-BP-".str_pad($vno,4,0,STR_PAD_LEFT);
		} else {
			$new_vno = "INV-BP-".str_pad($vno,4,0,STR_PAD_LEFT);	
		}
		
		echo $new_vno."|".$id;	
	}
	
	function set_payment(){
		$invoice_no = $_POST['invoice_no'];
		$g_total	= $_POST['g_total'];
		$cust_id	= $_POST['cust_id'];
		$date = date("Y/m/d");
		$sql = "INSERT into payment SET invoice_no = '$invoice_no', cst_id = '$cust_id', payable_amount = '$g_total', due = '$g_total', payment_date = '$date'";
		mysql_query($sql);	
	}
	
	function data_grid(){
		$i = $_POST['id'];
			echo "<tr>";
				echo "<td><input type='text' rel = '$i' id='dropdown_input_$i' class = 'enter'/></td>";
				echo "<td><input type='text' rel = '$i' style = 'width:250px' id='desc_$i' name='desc_$i'/></td>";
				echo "<td><input type='text' rel = '$i' name='unit_$i' style = 'width:175px' id='unit_$i'/></td>";
				echo "<td><input type='text' rel = '$i' name='quantity_$i' id='quantity_$i'/></td>";
				echo "<td><input type='hidden' name='warrenty_$i' id='warrenty_$i'/></td>";
				echo "<td><input type='text' readonly style = 'color:red' rel = '$i' name='total_$i' id='total_$i'/></td>";
				echo "<td><input type='hidden' name='purchase_$i' id='purchase_$i'/></td>";
				echo "<td><input type='hidden' name='item_$i' id='item_$i'/></td>";
			echo "</tr>";
	}

	
	function getPrice(){
		$id = $_POST['id_d'];
		$sql = "select * from stock_info where id = '$id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			echo $row['sales']."|".$row['purchase']."|".$row['id']."|".$row['description'];
		}	
	}
	
	function getInfo(){
		$id = $_POST['id_d'];
		$sql = "select * from customer_info where cust_id = '$id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$name = $row['name'];
			$cname	= $row['cname'];
			$contact = $row['contact'];
			$addr = $row['addr'];
			$cust_id	= $row['cust_id'];
		}
		$str = $name."|".$cname."|".$contact."|".$addr."|".$id;
		echo $str;
	}
	
	function voucher_list(){
		$inv_sl 	= $_POST['inv_sl'];
		$invoice 	= $_POST['invoice_no'];
		$g_total	= $_POST['g_total'];
		$date		= $_POST['odate'];
		
		$id			= $_POST['cust_id'];
		$cust_name	= $_POST['cust_name'];
		$contact	= $_POST['contact'];
		$addr		= $_POST['addr'];
		$cname		= $_POST['cname'];
		
		echo $sql = "INSERT into voucher_list SET id = '$inv_sl',invoice_no = '$invoice', g_total = '$g_total', date = '$date', cust_id = '$id'";
		mysql_query($sql);	
		
		if(isExist($id)){
			$sql1 = "INSERT into customer_info SET cust_id = '$id', name = '$cust_name', cname = '$cname', contact = '$contact', addr = '$addr'";
			mysql_query($sql1);
		}
	}
	
	function isExist($id){
		$sql = "SELECT * FROM customer_info WHERE cust_id = '$id'";
		$rec = mysql_query($sql);
		$numRows = mysql_num_rows($rec);
		if($numRows>0){
			return false;
		} else {
			return true;	
		}	
	}
	
	function setLedger(){
		$inv_sl = $_POST['inv_sl'];
		$sold_by	= $_POST['sold_by'];
		$item_id	= $_POST['item_id'];
		$unit_price	= $_POST['unit_price'];
		$quantity	= $_POST['quantity'];
		$warrenty	= $_POST['warrenty'];
		$total		= $_POST['total'];
		$purchase	= $_POST['purchase'];
		$product	= $_POST['product'];
		
		$item_qty = getQuantity($item_id);
		if($item_qty >= $quantity){
			$new_qty = $item_qty - $quantity;
			$sql = "UPDATE stock_info SET quantity = '$new_qty' WHERE id = '$item_id'";
			mysql_query($sql);
		}
		
		$sql = "INSERT into ledger SET inv_sl = '$inv_sl', product = '$product', purchase = '$purchase', sold_by = '$sold_by', item_id = '$item_id', unit_price = '$unit_price', quantity = '$quantity', warrenty = '$warrenty', total = '$total'";
		mysql_query($sql);
		
	}
	
	function getQuantity($item_id){
		$sql = "SELECT * FROM stock_info WHERE id = '$item_id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$qty = $row['quantity'];
		}
	return $qty;	
	}
	
	function set_delivery_info(){
		$invoice = $_POST['invoice'];
		$hname = $_POST['hname'];
		$contact = $_POST['contact'];
		$pcode = $_POST['pcode'];
		$addr = $_POST['addr'];
		
		$sql = "INSERT into delivery_info SET hname = '$hname', contact = '$contact', pcode = '$pcode', addr = '$addr', invoice_no = '$invoice'";
		mysql_query($sql);	
	}
	
	function getLastCustId(){
		$sql = "SELECT MAX(cust_id) as cust_id FROM customer_info";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$cust_id = $row['cust_id'];
		}
		if($cust_id == ''){
			echo $cust_id = 100000;
		} else {
			echo $cust_id;
		}
	}
	
	function set(){
		$sql = "UPDATE user_auth SET state = '1' WHERE emp_id = '".$_POST['val']."'";
		mysql_query($sql);	
	}
	
	function Reset_1(){
		$sql = "UPDATE user_auth SET state = '0' WHERE emp_id = '".$_POST['val']."'";
		mysql_query($sql);
	}
?>

