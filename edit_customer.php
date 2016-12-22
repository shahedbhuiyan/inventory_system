<?php
include_once("model.php");
$obj = new model();
if(isset($_GET['id'])){
	$sql = "SELECT * FROM customer_info WHERE cust_id = '".$_GET['id']."'";
	$rec = mysql_query($sql);
	if($row = mysql_fetch_array($rec)){
		$cust_id = $row['cust_id'];
		$name = $row['name'];
		$cname = $row['cname'];
		$addr = $row['addr'];
		$contact = $row['contact'];
	}
}

if(isset($_POST['sub'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$cname = $_POST['cname'];
	$addr = $_POST['addr'];
	$contact = $_POST['contact'];
	
	$sql = "UPDATE customer_info SET name = '$name', cname = '$cname', contact = '$contact', addr = '$addr' WHERE cust_id = '$id'";
	mysql_query($sql);
	if(mysql_affected_rows() == 1){
	?>
    <script type="text/javascript">
    	alert("Update Sucessfully.......");
		self.close();
		top.window.opener.location.reload();
    </script>
    <?php
	} else {
		?>
    <script type="text/javascript">
    	alert("Update failed..........");
		self.close();
		top.window.opener.location.reload();
    </script>
    <?php		
	}
}

?>
<form action="edit_customer.php" method="post">
<input type="hidden" name="id" id="id" value="<?php echo @$_GET['id']; ?>">
<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; text-align:left">
	<tr><td colspan="3" align="center" style="font-weight:bold; text-align:center">Edit Customer Info</td></tr>
    <tr>
    	<td>Name</td>
        <td>:</td>
        <td><input type="text" name="name" id="name" value="<?php echo @$name; ?>"></td>
    </tr>
    
    <tr>
    	<td>Contact</td>
        <td>:</td>
        <td><input type="text" name="contact" id="contact" value="<?php echo @$contact; ?>"></td>
    </tr>
    
    <tr>
    	<td>Company Name</td>
        <td>:</td>
        <td><input type="text" name="cname" id="cname" value="<?php echo @$cname; ?>"></td>
    </tr>
    
    <tr>
    	<td>Address</td>
        <td>:</td>
        <td><textarea id="addr" name="addr"><?php echo @$addr; ?></textarea></td>
    </tr>
    
    <tr>
    	<td colspan="3" align="center"><input type="submit" name="sub" value="Update"></td>
    </tr>
    
    <tr>
    	<td></td>
        <td></td>
        <td></td>
    </tr>
</table>
</form>