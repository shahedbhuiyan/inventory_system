<?php
if(!session_id()) session_start();
	if((!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) || ($_SESSION['sesUserType'] == 'User')) {
		header("Location: ./login.php");
		exit;
	}
include_once("header.php");
include_once("model.php");
$base = new model;


echo "<table align='center' style='font-family:verdana; font-size:11px' width='600'>";
	echo "<tr>";
		echo "<td style='border-bottom:2px solid black'>S.L</td>";
		echo "<td style='border-bottom:2px solid black'>Employee Name</td>";
		echo "<td style='border-bottom:2px solid black'>User Name</td>";
		echo "<td style='border-bottom:2px solid black'>User Type</td>";
		echo "<td style='border-bottom:2px solid black'>Password</td>";
		echo "<td style='border-bottom:2px solid black'>Change State</td>";
	echo "</tr>";

$sql = "SELECT * FROM user_auth";
$rec = mysql_query($sql);
$i = 0;
while($row = mysql_fetch_array($rec)){
	$eid = $row['emp_id'];
	$ename = getName($eid);
	$user = $row['user'];
	$user_t = $row['auth_type'];
	$pass = $row['pass'];
	$state = $row['state'];
	$i++;
	
	echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$ename."</td>";
		echo "<td>".$user."</td>";
		echo "<td>".$user_t."</td>";
		echo "<td>".$pass."</td>";
		if($state == 0)
			echo "<td><input type = 'checkbox' name = 'chk' id = 'chk' class = 'sh' value = '$eid'/></td>";
		else 
			echo "<td><input type = 'checkbox' checked name = 'chk' id = 'chk' class = 'sh' value = '$eid'/></td>";
	echo "</tr>";
}
echo "</table>";

function getName($eid){
	$sql = "SELECT * FROM employee_info WHERE emp_id = '$eid'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$fname = $row['fname'];
		$lname = $row['lname'];
	}
	return @$fname." ".@$lname;	
}
include_once("footer.php");

?>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="application/javascript">
	$(document).ready(function(e) {
    		$(".sh").bind('click',function(){
				var isChecked = $(this).attr('checked');
				if(isChecked == 'checked'){
					$.ajax({
						type:"POST",
						url:"invoice_sql.php",
						data:{val:$(this).val(),action:'set'},
						success: function(res){
							//alert(res);	
						}	
					});	
				} else {
					$.ajax({
						type:"POST",
						url:"invoice_sql.php",
						data:{val:$(this).val(),action:'reset'},
						success: function(res){
							//alert(res);	
						}
					});	
				}
			});   
    });
	
</script>