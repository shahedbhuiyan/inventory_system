<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	$base_system = new model();
	
	$sql = "SELECT * FROM suppliers";
	$rec = mysql_query($sql);
	$suppliers_array = array();
	while($row = mysql_fetch_array($rec)){
		$id		= $row['sid'];
		$name	= $row['sname'];
		
		$suppliers_array[$id] = $name;
	}
	
	echo "<table align='left'>";
		echo "<tr>";
			echo "<td><select name='sname_select' id='sname_select' size = '15' style = 'border:1px solid white; font-family:verdana; font-size:10px; font-weight:bold'>"; 
				foreach($suppliers_array as $k=>$v){
					echo "<option value='$k'>$v</option>";
				}
			echo "</select></td>";
		echo "</tr>";
	echo "</table>";
	
	echo "<table align='left' border='0' style='font-family:verdana; font-size:11px; text-align:left'>";
	
		echo "<tr>";
			echo "<td colspan='3' style='text-align:center; font-weight:bold'>Suppliers Details Info</td>";
		echo "</tr>";
			
		echo "<tr>";
			echo "<td>Suppliers Name</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='sname' id='sname' style = 'width:200px; font-family:tahoma; font-size:12px; color:red'/></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Suppliers Email</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='semail' id='semail' style = 'width:200px; font-family:tahoma; font-size:12px; color:red'/></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Suppliers Contact</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='scontact' id='scontact' style = 'width:200px; font-family:tahoma; font-size:12px; color:red'/></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td valign='top'>Suppliers Address</td>";
			echo "<td>:</td>";
			echo "<td><textarea name='saddress' id='saddress' style = 'color:red'></textarea></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Contact Person 1</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='contact1' id='contact1' style = 'font-family:tahoma; font-size:12px; color:red'/> With Name : <input type='text' style = 'font-family:tahoma; font-size:12px; color:red' name='name1' id='name1'/></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Contact Person 2</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='contact2' id='contact2' style = 'font-family:tahoma; font-size:12px; color:red'/> With Name : <input type='text' name='name2' id='name2' style = 'font-family:tahoma; font-size:12px; color:red'/></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>Contact Person 3</td>";
			echo "<td>:</td>";
			echo "<td><input type='text' name='contact3' id='contact3' style = 'font-family:tahoma; font-size:12px; color:red'/> With Name : <input type='text' name='name3' id='name3' style = 'font-family:tahoma; font-size:12px; color:red'/></td>";
		echo "</tr>";
	echo "</table>";
	
	include_once("footer.php");
?>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#sname_select").bind('change',function(){
			var id = $(this).val();
			$.ajax({
				type:"POST",
				url:"new_sql.php",
				data:{action:'hit',id:id},
				success: function(resp){
					var resp = resp.split("|");
					$("#sname").val(resp[0]);
					$("#semail").val(resp[1]);
					$("#scontact").val(resp[2]);
					$("#saddress").val(resp[3]);
					$("#contact1").val(resp[4]);
					$("#name1").val(resp[5]);
					$("#contact2").val(resp[6]);
					$("#name2").val(resp[7]);
					$("#contact3").val(resp[8]);
					$("#name3").val(resp[9]);
				}	
			});
		});
    });
</script>