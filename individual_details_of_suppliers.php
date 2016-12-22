<?php
	include_once("model.php");
	$base = new model();
	if(isset($_POST['s_id'])){
		@$ids = $_POST['s_id'];
	}
	$sql = "SELECT * FROM suppliers";
	$rec = mysql_query($sql);
	$s_ary = array();
	while($row = mysql_fetch_array($rec)){
		$id  = $row['sid'];
		$name = $row['sname'];
		
		$s_ary[$id] = $name;
	}
?>
<style type="text/css">
	.cls{
		cursor:pointer;
		font:14px "Trebuchet MS";
		display:inline-block;
		text-decoration:none;
		border-radius:3px;
		padding:0px 16px;
		background:slategrey;
		color:#fff;
		width:80px	
	}
	.inp{
		color:gray;
		font-size:13px;
		font-family:Calibri;
		border:1px solid gray;
		width:150px
	}
</style>
<form action="individual_details_of_suppliers.php" method="post">
<table align="left" style="font-family:Calibri; font-size:14px;">
	<tr>
    	<td>From : <input type="text" class="inp" name="from" id="from" value="<?php echo date("Y-m-01"); ?>" /> To : <input type="text" name="to" id="to" class="inp" value="<?php echo date("Y-m-d"); ?>" /> <select id="s_id" name="s_id">
        <option value="">-------------</option>
        <?php
			foreach($s_ary as $k=>$v){
				if($k == @$ids){
					echo "<option value='$k' selected>$v</option>";
				} else {
					echo "<option value='$k'>$v</option>";
				}
			}
		?>
        </select>  <input type="submit" name="sub" class="cls" value="Serach" /></td>
    </tr>
</table>
</form>
<?php
	
	function getPaidAmount($sid,$from,$to){
		$sql = "SELECT * FROM suppliers_payment WHERE date >= '".$from."' AND date <= '".$to."' AND suppliers_id = '".$sid."'";
		$rec = mysql_query($sql);
		$total_paid = 0;
		while($row = mysql_fetch_array($rec)){
			$paid_amount		= $row['paid_amount'];
			$total_paid 		+= $paid_amount;
		}
		return $total_paid;	
	}
	
	function getPayableAmount($sid,$from,$to){
		//$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date >= '".$from."' AND purchase_date <= '".$to."' AND suppliers_id = '".$sid."'";	
		$sql = "SELECT * FROM suppliers_buying_ledger WHERE suppliers_id = '".$sid."'";
		$rec = mysql_query($sql);
		$total_payable = 0;
		while($row = mysql_fetch_array($rec)){
			$quantity 	= $row['quantity'];
			$purchase	= $row['purchase_rate'];
			
			$total_payable += ($purchase * $quantity);
		}
		return $total_payable;
	}
	
	function getSuppliersName($id){
		$sql = "SELECT * FROM suppliers WHERE sid = '".$id."'";
		$rec = mysql_query($sql);
		while($row = mysql_fetch_array($rec)){
			$sname = $row['sname'];
			$contact = $row['scontact'];
		}
		return @$sname."|".@$contact;
	}
	if(@$_POST['s_id'] != ''){
		$sary = getSuppliersName(@$_POST['s_id']);
		$sary = explode("|",$sary);
	}
	if(@$_POST['s_id'] != '' && @$_POST['from'] != '' && @$_POST['to'] != ''){
		$sid 				= $_POST['s_id'];
		$from 				= $_POST['from'];
		$to 				= $_POST['to'];
		$total_payable 		= getPayableAmount($sid,$from,$to);
		$total_paid 		= getPaidAmount($sid,$from,$to);
		$total_due			= ($total_payable - $total_paid);
	}
?>
<table height="30" align="left" width="800"><tr><td></td></tr></table>
<br />
<table style="font-family:Calibri; font-size:13px;" border="0" align="left" width="750" cellspacing="1">
	<tr>
    	<td>Suppliers Name</td>
        <td width="1">:</td>
        <td><b><?php echo @$sary[0]; ?></b></td>
        <td>Contact</td>
        <td width="1">:</td>
        <td colspan="4"><b><?php echo @$sary[1]; ?></b></td>
    </tr>
    <tr>
    	<td>Total Payable</td>
        <td>:</td>
        <td><b><?php echo @$total_payable." BDT"; ?></b></td>
        
        <td>Total Paid</td>
        <td>:</td>
        <td><b><?php echo @$total_paid." BDT"; ?></b></td>
        
        <td>Total Due</td>
        <td>:</td>
        <td><b><?php echo @$total_due." BDT"; ?></b></td>
    </tr>
   </table>
   <br />
    <table width="800" border="0" height="40" align="left"><tr><td></td></tr></table>
    <br />
   <table align="left" cellspacing="2" width="800" border="0">
   		<tr style="font-family:Calibri; font-size:14px; text-align:center; font-weight:bold">
        	<td style="border-bottom:2px solid black" width="50%">Purchase List</td>
            <td style="border-bottom:2px solid black" width="50%">Paid List</td>
        </tr>
		<tr>
        	<td valign="top" width="100%">
            
            <table width="400" border="0" style="font-family:Calibri; font-size:13px;">
            	<tr>
                	<td style="border-bottom:2px solid black; font-weight:bold">S.L</td>
                    <td style="border-bottom:2px solid black; font-weight:bold">Date</td>
                    <td style="border-bottom:2px solid black; font-weight:bold">Purchase Amount</td>
                </tr>
<?php
	if(@$_POST['s_id'] != '' && @$_POST['from'] != '' && @$_POST['to'] != ''){
		$sid 				= $_POST['s_id'];
		$from 				= $_POST['from'];
		$to 				= $_POST['to'];
		$sql = "SELECT * FROM suppliers_buying_ledger WHERE purchase_date >= '".$from."' AND purchase_date <= '".$to."' AND suppliers_id = '".$sid."'";
		$rec = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_array($rec)){
			$i++;
			$date = $row['purchase_date'];
			$rate = $row['purchase_rate'];
			$qty = $row['quantity'];
			
			$total = $qty * $rate;
			echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>$date</td>";
				echo "<td>$total BDT</td>";
			echo "</tr>";
		}
			echo "</table>";
		echo "</td>";
		
		echo "<td width='100%' valign='top'>";
			echo "<table cellspacing='1' border='0' width='400' style='font-family:Calibri; font-size:13px;'>";
				echo "<tr>";
					echo "<td style='border-bottom:2px solid black; font-weight:bold'>S.L</td>";
					echo "<td style='border-bottom:2px solid black; font-weight:bold'>Date</td>";
					echo "<td style='border-bottom:2px solid black; font-weight:bold'>Paid Amount</td>";
					echo "<td style='border-bottom:2px solid black; font-weight:bold'>Paid Through</td>";
				echo "</tr>";
				
				$sql = "SELECT * FROM suppliers_payment WHERE date >= '".$from."' AND date <= '".$to."' AND suppliers_id = '".$sid."'";
				$rec = mysql_query($sql);
				$j = 0;
				while($row = mysql_fetch_array($rec)){
					$j++;
					$date			= $row['date'];
					$paid_amt		= $row['paid_amount'];
					$bank_id		= $row['bank_id'];
					$payment_mode	= $row['payment_mode'];
					if(@$bank_id != 0){
						$pymt_mode = getPaymentMode($bank_id);
					} else {
						$pymt_mode = $payment_mode;
					}
					echo "<tr>";
						echo "<td>$j</td>";
						echo "<td>$date</td>";
						echo "<td>$paid_amt BDT</td>";
						echo "<td>$pymt_mode</td>";
					echo "</tr>";
				}
				
			echo "</table>";
		echo "</td>";
	}
	
		echo "</tr>";
	echo "</table>"; 
	
	function getPaymentMode($id){
		$sql = "SELECT * FROM bank WHERE id = '$id'";
		$rec = mysql_query($sql);
		if($row = mysql_fetch_array($rec)){
			$bname = $row['bname'];
		}
		return $bname;
	}