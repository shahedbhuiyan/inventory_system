<?php
include_once("model.php");
$base = new model;
@$action = $_POST['action'];
if(@$action == 'getSary'){
	getSuppliersAry();
} else if(@$action == 'getBary'){
	getBankAry();
} else if(@$action == 'getAccInfo'){
	getAccountInfo();
}

function getSuppliersAry(){
	$total_balance = 0;
	$sql = "SELECT * FROM suppliers_buying_ledger WHERE suppliers_id = '".$_POST['id']."'";
	$rec = mysql_query($sql);
	$g_total = 0;
	while($row = mysql_fetch_array($rec)){
		$qty = $row['quantity'];
		$purchase = $row['purchase_rate'];
		
		$g_total += ($qty * $purchase);
	}
	
	$sql1 = "SELECT * FROM suppliers_payment WHERE suppliers_id = '".$_POST['id']."'";
	$rec1 = mysql_query($sql1);
	$paid_total = 0;
	while($row1 = mysql_fetch_array($rec1)){
		$paid_amount = $row1['paid_amount'];
		
		$paid_total += $paid_amount;
	}
	
	$total_balance = ($g_total - $paid_total);
	
	echo @$total_balance;
}

function getBankAry(){
	$sql = "SELECT * FROM bank WHERE id = '".$_POST['id']."'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$balance = $row['balance'];
		$acno = $row['acno'];
	}
	echo $balance."|".$acno;	
}

function getAccountInfo(){
	$id = $_POST['id'];
	$sql = "SELECT * FROM bank WHERE id = '$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$ac = $row['acname'];
		$acno = $row['acno'];
		$bank = $row['bname'];
		$balance = $row['balance'];
	}
	echo $ac."|".$acno."|".$bank."|".$balance;	
}


