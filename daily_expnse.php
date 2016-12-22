<?php
if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
include_once("header.php");
include_once("model.php");
$base = new model();
if(isset($_POST['save'])){
	$incr_id	= $_POST['incr_id'];
	$ename 		= $_POST['ename'];
	$etype 		= $_POST['etype'];
	$desc 		= $_POST['desc'];
	$date 		= $_POST['dat'];
	$eamount 	= $_POST['eamount'];
	
	if(!$base->existance_check("SELECT * FROM daily_expense WHERE id = '$incr_id'")){
		$sql = "INSERT INTO daily_expense SET id = '$incr_id', ename = '$ename', etype = '$etype', description = '$desc', dat = '$date', eamount = '$eamount'";
		mysql_query($sql);
		
		if(mysql_affected_rows() == 1){
			echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px;'>Data Loading successfully...........</td></tr></table>";
		} else {
			echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px;'>Data Loading failed...........</td></tr></table>";
		}
	} else {
		echo "<table align='center'><tr><td style = 'font-family:verdana; font-size:12px;'>Already exists...........</td></tr></table>";
	}
}
$incr = $base->incrementId("daily_expense","id");
?>
	<form action="daily_expnse.php" method="post" onsubmit="return check_func(this)">
	<input type="hidden" id="incr_id" name="incr_id" value="<?php echo $incr; ?>"/>
	<table align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; text-align:left">
    	<tr><td colspan="3" style="font-weight:bold; text-align:center">Daily Expense</td></tr>
      
        <tr>
        	<td>Expense Name</td>
            <td>:</td>
            <td><input type="text" name="ename" id="ename"></td>
        </tr>
        
        <tr>
        	<td>Expense Type</td>
            <td>:</td>
            <td><input type="text" name="etype" id="etype"></td>
        </tr>
        
        <tr>
        	<td>Descreption</td>
            <td>:</td>
            <td><textarea name="desc" id="desc"></textarea></td>
        </tr>
        
        <tr>
        	<td>Date</td>
            <td>:</td>
            <td><input type="text" name="dat" id="dat" value="<?php echo date("Y-m-d"); ?>" readonly="readonly"></td>
        </tr>
        
        <tr>
        	<td>Expense Amount</td>
            <td>:</td>
            <td><input type="text" name="eamount" id="eamount"></td>
        </tr>
        
        <tr><td colspan="3" align="center"><input type="submit" name="save" id="save" value="Save"></td></tr>
    </table>
    </form>
<?php
include_once("footer.php");

?>

<script type="text/javascript">
	function check_func(){
		var ename = document.getElementById("ename").value;
		if(ename == ''){
			alert('Enter expense name....');
			return false;
		}
		var eamount = document.getElementById("eamount").value;
		if(eamount == ''){
			alert('Enter expense amount....');
			return false;
		}
		return true;	
	}
</script>