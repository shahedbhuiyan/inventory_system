<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include("header.php");
	
	include("footer.php");
?>