<?php
$conn = mysql_connect("localhost","root","blackmagic");
mysql_select_db("inv_sys",$conn);
@$action = isset($_POST["action"]) ? $_POST["action"] : "";

$drug_data = getDrug();
$drug1_data = getDrug1();
$invoice_data = getInvoice();

function getDrug(){
	$sql = "SELECT * FROM stock_info";
	$rec = mysql_query($sql);
	$drg_ary = array();
	
	$data = "[";
	while($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$drug = $row['product'];
		$mg = $row['brand'];
		
		$drug = $drug." -> ".$mg;;
		
		$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
	}
	
	$data = trim($data,",");
	$data .= "]";
	
	return $data;	
}

function getDrug1(){
	$sql = "SELECT * FROM customer_info";
	$rec = mysql_query($sql);
	$drg_ary = array();
	
	$data = "[";
	while($row = mysql_fetch_array($rec)){
		$id = $row['cust_id'];
		$drug = $row['name'];
		
		//$drug = $drug;
		
		$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
	}
	
	$data = trim($data,",");
	$data .= "]";
	
	return $data;	
}

function getInvoice(){
	$sql = "SELECT * FROM payment";
	$rec = mysql_query($sql);
	$drg_ary = array();
	
	$data = "[";
	while($row = mysql_fetch_array($rec)){
		$id = $row['id'];
		$drug = $row['invoice_no'];
		//$mg = $row['sales'];
		
		//$drug = $drug." ".$mg;;
		//$drug = trim($drug,);
		$data .= "{\"id\":\"$id\",\"txt\":\"$drug\"},";
	}
	
	$data = trim($data,",");
	$data .= "]";
	
	return $data;	
}

if($action=="invoice") {
	echo $invoice_data;
}
if($action=="drug1") {
	echo $drug1_data;
}
if($action=="drug") {
	echo $drug_data;	
}