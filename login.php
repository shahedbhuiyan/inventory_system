<?php
	include_once("model.php");
	$base = new model();
	if(isset($_POST['sub'])){
		$user_type = $_POST['user_type'];
		$user = mysql_real_escape_string($_POST['user_id']);
		$pass = mysql_real_escape_string($_POST['password']);
		
		$sql = "SELECT * FROM user_auth WHERE user = '$user' AND pass = '$pass' AND state = '1' AND auth_type = '$user_type'";
		$rec = mysql_query($sql);
		$numRows = mysql_num_rows($rec);
		if($numRows == 1){
			$row = mysql_fetch_array($rec);
			$user = $row['user'];
			$eid	= $row['emp_id'];
			$user_t = $row['auth_type'];
			
			if(!session_start()) session_start();
			$_SESSION['sesUser'] = $user;
			$_SESSION['sesID'] = $eid;
			$_SESSION['sesUserType'] = $user_t;
		
			//if($_SESSION['sesUserType'] == 'Admin'){
			?>
				<script type="text/javascript">
                    self.location = "index.php";
                </script>
            <?php
			//}
		} else {
			$err = "Login Information Invalid";
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bishmillah Paper House</title>
<link href="css/css/m-buttons.css" type="text/css" rel="stylesheet">
<link href="css/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>

<div class="main_body">
	<div class="container">
    	<div class="area">
        	<div id="left"></div>
            <div class="right">
            	<div class="logo">Bishmillah Paper House</div>
                <div class="space"><?php echo isset($err)?$err:""; ?></div>
                <span class="login_title"><a style="color:black">Have a account?</a><a style="color:#0066FF"> login here</a></span>
                <div class="space2"></div>
                <div class="login_form">
                	<form action="login.php" method="post">
                    <select name="user_type" id="user_type" class="input_box">
                    	<option value="">-------------</option>
                        <option value="Admin">Admin User</option>
                        <option value="User">Normal User</option>
                    </select>
                	<div class="space3"></div>
                    <input type="text" name="user_id" class="input_box">
                    <div class="space3"></div>
                    <input type="password" name="password" class="input_box">
                    <div class="space3"></div>
                    <input type="checkbox" name="keep"> <a style="font-family:Microsoft Tai Le; font-size:13px">Keep me signed in</a>
                    
                    
                     <div class="enter"></div>
                     <input type="submit" class="m-btn" name="sub" value="Sing In">
                     </form>
                      <div class="enter"></div>
                      <a style="color:#0066FF; font-family:Microsoft Tai Le; font-size:12px">Can't access your account?</a>
                      
                      <div class="enter1"></div>
                      <a target="_blank" style="color:#0066FF; text-decoration:none; font-family:Microsoft Tai Le; font-size:11px" href="http://www.ssibd.com">Powered by Software Solution Inc.</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
