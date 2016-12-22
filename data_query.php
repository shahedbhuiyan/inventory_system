<?php
	include_once("model.php");
	$base = new model();
	
	$iname_data = getIname();
	$brand_data	= getBname();
	$cata_data	= getCata();
	$sname_data = getSname();
	$cust_data	= getCustomer();
	//echo "<br>ksdj";
	function getIname(){
		$sql = "SELECT * FROM stock_info";
		$rec = mysql_query($sql);
		$drg_ary = array();
		
		$data = "[";
		while($row = mysql_fetch_array($rec)){
			$id = $row['id'];
			$drug = $row['product'];
			
			$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
		}
		
		$data = trim($data,",");
		$data .= "]";
		
		return $data;	
	}
	
	function getBname(){
		$sql = "SELECT * FROM stock_info";
		$rec = mysql_query($sql);
		$drg_ary = array();
		
		$data = "[";
		while($row = mysql_fetch_array($rec)){
			$id = $row['id'];
			$drug = $row['brand'];
			
			$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
		}
		
		$data = trim($data,",");
		$data .= "]";
		
		return $data;	
	}
	
	
	function getCata(){
		$sql = "SELECT * FROM stock_info";
		$rec = mysql_query($sql);
		$drg_ary = array();
		
		$data = "[";
		while($row = mysql_fetch_array($rec)){
			$id = $row['id'];
			$drug = $row['cata'];
			
			$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
		}
		
		$data = trim($data,",");
		$data .= "]";
		
		return $data;	
	}
	
	
	function getSname(){
		$sql = "SELECT * FROM suppliers";
		$rec = mysql_query($sql);
		$drg_ary = array();
		
		$data = "[";
		while($row = mysql_fetch_array($rec)){
			$id = $row['sid'];
			$drug = $row['sname'];
			
			$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
		}
		
		$data = trim($data,",");
		$data .= "]";
		
		return $data;	
	}
	
	function getCustomer(){
		$sql = "SELECT * FROM customer_info";
		$rec = mysql_query($sql);
		$drg_ary = array();
		
		$data = "[";
		while($row = mysql_fetch_array($rec)){
			$id = $row['cust_id'];
			$drug = $row['name'];
			
			$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
		}
		
		$data = trim($data,",");
		$data .= "]";
		
		return $data;	
	}
	
	
	@$action = $_POST['action'];
	if($action == 'iname'){
		echo $iname_data;
	} else if($action == 'bname'){
		echo $brand_data;	
	} else if($action == 'cata'){
		echo $cata_data;
	} else if($action == 'sname'){
		echo $sname_data;
	} else if($action == 'customer'){
		echo $cust_data;
	}