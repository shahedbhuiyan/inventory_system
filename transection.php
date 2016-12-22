<?php
include_once("header.php");
include_once("model.php");
$base = new model;
if(isset($_POST['sub'])){
	$dat = date("Y-m-d");
	$inc_id		= $_POST['inc_id'];
	$id 		= $_POST['id'];
	$balance 	= $_POST['balance'];
	$tr_type 	= $_POST['tr_type'];
	$paid_to  	= $_POST['paid_to'];
	$amt 		= $_POST['amt'];
	$prev_balance = $_POST['balance1'];
	if(isExists($inc_id)){
		if($tr_type == 'DR'){
			$satae1 = (bool)debitBalance($id,$amt);
		}
		
		if($tr_type == 'CR'){
			$state2 = (bool)creditBalance($id,$amt);
		}
		if(@$satae1 || @$state2){
			$sql = "INSERT INTO transec SET id = '$inc_id', acc_id = '$id', trns_date = '$dat', trnsection_taka = '$amt', balance = '$balance', paid_to = '$paid_to', trns_type = '$tr_type', prev_balance = '$prev_balance'";
			mysql_query($sql);
			if(mysql_affected_rows() == 1){
				echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:13px; font-weight:bold; text-align:center'>Transaction successfully done....</td></tr></table>";
			} else {
				echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:13px; font-weight:bold; text-align:center; color:red'>Transaction unsuccessfull....</td></tr></table>";	
			}
		}
	} else {
		echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:13px; font-weight:bold; text-align:center; color:red'>Transaction already exists....</td></tr></table>";
	}
}
$inc_id = $base->incrementId("transec","id");

function isExists($id){
	$sql = "SELECT * FROM transec WHERE id = '$id'";
	$rec = mysql_query($sql);
	$numRows = mysql_num_rows($rec);
	if($numRows > 0){
		return false;
	} else {
		return true;		
	}
}
function debitBalance($id,$amt){
	$sql = "SELECT * FROM bank WHERE id = '$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$balance = $row['balance'];
	}
	
	$new_val = $balance - $amt;
	
	$sql = "UPDATE bank SET balance = '$new_val' WHERE id = '$id'";
	$rec = mysql_query($sql);
	
	$numRows = mysql_affected_rows();
	if($numRows > 0){
		return true;
	} else {
		return false;	
	}	
}

function creditBalance($id,$trns){
	$sql = "SELECT * FROM bank WHERE id = '$id'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$balance = $row['balance'];
	}
	
	$new_val = $balance + $trns;
	
	$sql1 = "UPDATE bank SET balance = '$new_val' WHERE id = '$id'";
	$rec1 = mysql_query($sql1);
	$numRows = mysql_affected_rows();
	if($numRows > 0){
		return true;
	} else {
		return false;	
	}	
}

$select = array();
$select[] = '*';

$from = array();
$from[] = "bank";

$data = $base->get($select,$from);
$account_ary = array();
foreach($data as $v){
	$id = $v['id'];
	$ac = $v['acname'];
	$account_ary[$id] = $ac;
}

echo "<form action='transection.php' method='post'>";
echo "<input type='hidden' name = 'inc_id' id = 'inc_id' value='$inc_id'/>";
echo "<input type = 'hidden' id = 'balance1' name = 'balance1'/>";
echo "<table align='left' border='0' width='700' class='cls'>";
	echo "<tr>";
		echo "<td width='150' valign='top'><select size='10' id = 'id' name = 'id'>";
			echo "<option value='' selected>-------------------------------------------</option>"; 
			foreach($account_ary as $k=>$v){
				echo "<option value = '".@$k."'>".@$v."</option>";
			}
		echo "</select></td>";
		echo "<td>";
			echo "<table width='100%'>";
				echo "<tr>";
					echo "<td colspan='3' class='trns'>Transaction Panel</td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Account Name</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'ac_name' name = 'ac_name'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Account No</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'ac_no' name = 'ac_no'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Bank Name</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'bank' name = 'bank'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Account Balance</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'balance' name = 'balance'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Transaction Type</td>";
					echo "<td>:</td>";
					echo "<td><select id = 'tr_type' name = 'tr_type'/>
						<option value=''>------------</option>
						<option value='DR'>Debit</option>
						<option value='CR'>Credit</option>
					</select></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Paid To</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'paid_to' name = 'paid_to'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>Amount</td>";
					echo "<td>:</td>";
					echo "<td><input type = 'text' id = 'amt' name = 'amt'/></td>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td colspan='3' align='center'><input type = 'submit' id = 'sub' name = 'sub' value = 'Done' style = 'color:black; font-weight:bold'/></td>";
				echo "</tr>";
				
			echo "</table>";
		echo "</td>";
	echo "</tr>";
echo "</table>";
echo "</form>";

include_once("footer.php");
?>

<style type="text/css">
	.cls{font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:left}
	.trns{text-align:center; font-size:13px; font-weight:bold}
	.cls input{width:190px; color:red}
</style>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		$("#tr_type").attr("disabled","disabled");
		$("#paid_to").attr("disabled","disabled");
		$("#amt").attr("disabled","disabled");
        $("#id").change(function(e) {
        	var val = $(this).val();
			if(val != ''){
			$("#tr_type").attr("disabled",false);
				$.ajax({
					type:"POST",
					url:"suppliers_sql.php",
					data:{action:'getAccInfo',id:val},
					success: function(resp){
						var val = resp.split("|");
						$("#ac_name").val(val[0]);
						$("#ac_no").val(val[1]);
						$("#bank").val(val[2]);
						$("#balance").val(val[3]);
						$("#balance1").val(val[3]);
					}	
				});
			} else {
				$("#ac_name").val("");
				$("#ac_no").val("");
				$("#bank").val("");
				$("#balance").val("");
				$("#balance1").val("");
				$("#tr_type").attr("disabled","disabled");	
			}
        });
		$("#tr_type").change(function(e) {
            var state = $(this).val();
			if(state != ''){
				$("#paid_to").attr("disabled",false);
				$("#amt").attr("disabled",false);
			} else {
				$("#paid_to").attr("disabled","disabled");
				$("#amt").attr("disabled","disabled");				
			}
			var balance = 0;
			var amt = 0;
			var new_val = 0;
			$("#amt").bind('keyup',function(){
				var type = $("#tr_type").val();
				if(type == 'CR'){
					balance = $("#balance1").val();
					amt = $(this).val();
					if(amt == '')
					amt = 0;
					new_val = (parseInt(balance) + parseInt(amt));
					
					$("#balance").val(parseFloat(new_val));
				}
				if(type == 'DR'){
					balance = $("#balance1").val();
					var chk = balance - 500;
					amt = $(this).val();
					if(amt<=chk){
					if(amt == '')
						amt = 0;
					new_val = (parseInt(balance) - parseInt(amt));
					$("#balance").val(parseFloat(new_val));
					} else {
						alert('Type less or equal '+chk);
						$("#amt").val("");
						$("#balance").val(balance);	
					}	
				}
			});  
        });
    });
</script>