<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser']) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
	include_once("header.php");
	include_once("model.php");
	
	$obj = new model();
	$table = "customer_info";
	$insert_data = array();
	
	if(isset($_POST['submit'])){
		@$state = $obj->existance_check("select * from customer_info where cust_id = '".$_POST['cust_id']."'");
		if($state == 0){
			$insert_data['cust_id']			= $_POST['cust_id'];
			$insert_data['name']			= $_POST['name'];
			$insert_data['contact']			= $_POST['contact'];
			$insert_data['cname']			= $_POST['cname'];
			$insert_data['addr']			= $_POST['addr'];
			
			@$status = $obj->dataInsertion($table,$insert_data);
			if($status){
				$flag = 1;
				echo "<table align='center' border='1'><tr><td>Data loading successfully.....</td></tr></table>";
			} else {
				$flag = 0;	
			}
		} else {
			$flag = 0;	
		}
	}
	
?>

</br>
</br>

<form action="customer_info.php" method="post">
<table align="center" width="350" style="font-family:tahoma; font-size:13px; text-align:left; margin-top:40px">
	<tr><td colspan="3" id="menu2">Customer Information</td></tr>
	<tr>
    	<td>Customer ID</td>
        <td>:</td>
        <td><input type="text" name="cust_id" id="cust_id"/></td>
    </tr>
    
    <tr>
    	<td>Name</td>
        <td>:</td>
        <td><input type="text" name="name" id="name"/></td>
    </tr>
    
    <tr>
    	<td>Contact</td>
        <td>:</td>
        <td><input type="text" name="contact" id="contact"/></td>
    </tr>
    
    <tr>
    	<td valign="top">Billing Addreess</td>
        <td valign="top">:</td>
        <td><textarea id="addr" name="addr"></textarea></td>
    </tr>
    
    <tr>
    	<td>Company Name</td>
        <td>:</td>
        <td><input type="text" name="cname" id="cname"/>(if any)</td>
    </tr>
    
    <tr>
    	<td colspan="3" align="center"><input type="submit" name="submit" value="Submit"/></td>
    </tr>
</table>
</form>

<?php
	include_once("footer.php");
?>