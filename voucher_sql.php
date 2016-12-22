<?php
if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
$conn = mysql_connect("localhost","root","");
mysql_select_db("voucher",$conn);

$val = isset($_POST["val"]) ? trim($_POST["val"]) : "";

$sub_sql="";
if(!empty($val)) $sub_sql = " WHERE product LIKE '$val%'";

$sql = "SELECT * FROM product $sub_sql LIMIT 7";
$rec = mysql_query($sql);

$object = array();
while($row = mysql_fetch_array($rec))
{
	$product = $row["product"];
	$price = $row["price"];
	$product_id = $row["id"];
	
	$obj = new stdClass();
	$obj->id = $product_id;
	$obj->product = $product;
	$obj->price = $price;
	
	$object[] = $obj;
}

echo json_encode($object);
?>