<?php
	include_once("model.php");
	$base = new model();
	
	@$action  =  $_POST['action'];
	
	if($action == 'hit'){
		getSuppliersInfo();
	}
	
	function getSuppliersInfo(){
		$id = $_POST['id'];
		$sql = "SELECT * FROM suppliers WHERE sid = '$id'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$name 		= $row['sname'];
			$email		= $row['semail'];
			$contact 	= $row['scontact'];
			$address 	= $row['saddress'];
			$contact1 	= $row['contact1'];
			$name1 		= $row['name1'];
			$contact2 	= $row['contact2'];
			$name2		= $row['name2'];
			$contact3 	= $row['contact3'];
			$name3 		= $row['name3'];
		}
		$str = $name."|".$email."|".$contact."|".$address."|".$contact1."|".$name1."|".$contact2."|".$name2."|".$contact3."|".$name3;
		echo $str;	
	}
	

?>