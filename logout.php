<?php
if(!session_id()) session_start();

unset($_SESSION['sesUser']);
unset($_SESSION['sesID']);
session_unset();
session_destroy();

header("Location: ./login.php");
exit;