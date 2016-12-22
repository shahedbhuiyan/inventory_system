<?php
	include_once("header.php");
	include_once("model.php");
	$base = new model;
	
	$select = array();
	$select[] = '*';
	
	$from = array();
	$from[] = "bank";
	
	echo "<table align='center' style='font-family:verdana; font-size:10px; font-weight:bold' border='0' width='750' cellspacing='1'>";
		echo "<tr style='font-size:12px; text-align:center; font-weight:bold'>";
			echo "<td style = 'border-bottom:2px solid black'>S.L</td>";
			echo "<td style = 'border-bottom:2px solid black'>Account Name</td>";
			echo "<td style = 'border-bottom:2px solid black'>Account No</td>";
			echo "<td style = 'border-bottom:2px solid black'>Account Type</td>";
			echo "<td style = 'border-bottom:2px solid black'>Bank Name</td>";
			echo "<td style = 'border-bottom:2px solid black'>Account Balance</td>";
		echo "</tr>";
	
	$data = $base->get($select,$from);
	$i = 0;
	foreach($data as $v){
		if(isset($v))
			extract($v);
		$i++;
		if($type == 'CA') $type = 'Current Account';
		if($type == 'SA') $type = 'Saving Account';
		if($type == 'FD') $type = 'Fixed Deposit';
		echo "<tr>";
			echo "<td>".@$i."</td>";
			echo "<td>".@$acname."</td>";
			echo "<td>".@$acno."</td>";
			echo "<td>".@$type."</td>";
			echo "<td>".@$bname."</td>";
			echo "<td>".@$balance." BDT</td>";
		echo "</tr>";
	}
	echo "</table>";
	include_once("footer.php");
?>