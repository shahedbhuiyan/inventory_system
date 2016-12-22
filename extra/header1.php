<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shop Management Explorer</title>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="lib/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<link href="lib/colorbox/colorbox.css" type="text/css" rel="stylesheet" />

<script type='text/javascript' src='js/jquery.cookie.js'></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcjqaccordion.2.7.min.js'></script>
<link href="css/dcaccordion.css" rel="stylesheet" type="text/css" />
<link href="css/skins/graphite.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function($){
	$('#accordion-1').dcAccordion();
});

$(function() {
	$(".colorboxButton").colorbox();
});

</script>

<style type="text/css">
a{color:#099; text-decoration:none}
</style>
</head>
<body>
<table align="center" width="1000" border="0">
	<tr>
    	<td colspan="2" align="center" bgcolor="black" style="font-family:Microsoft JhengHei; font-size:30px; font-weight:bold"><a href="index.php" style="color:white">Bismillah Paper House</a></td>
    </tr>
    <tr>
    	<td height="500" valign="top" width="160" bgcolor="black">
        	<!--table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Invoices</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">Create New Invoice</a></td></tr>
                            <tr><td><a href="#">Open Invoice List</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Payments</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">Apply Payments</a></td></tr>
                            <tr><td><a href="#">Apply Due Payments</a></td></tr>
                            <tr><td><a href="#">Open Payment List</a></td></tr>
                            <tr><td><a href="#">Open Due List</a></td></tr>
                            <tr><td><a href="#">View Payments</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Customers</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="customer_info.php">New Customers</a></td></tr>
                            <tr><td><a href="view_customer.php">View Customers List</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Items</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">New Items</a></td></tr>
                            <tr><td><a href="#">View Items List</a></td></tr>
                            <tr><td><a href="#">View Inventory Rpt.</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Banking Transections</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">New Account</a></td></tr>
                            <tr><td><a href="#">Account Summery</a></td></tr>
                            <tr><td><a href="#">Transection Report</a></td></tr>
                            <tr><td><a href="#">Per Bank Report</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Reports</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">Invoices Report</a></td></tr>
                            <tr><td><a href="#">Payment Report</a></td></tr>
                            <tr><td><a href="#">Customer Repost</a></td></tr>
                            <tr><td><a href="#">Last Update Item</a></td></tr>
                            <tr><td><a href="#">Last Sales Item</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Employee</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="employee.php">New Employee</a></td></tr>
                            <tr><td><a href="view_emp.php">View Employee</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px; margin-bottom:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Suppliers</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="#">New Suppliers</a></td></tr>
                            <tr><td><a href="#">View Suppliers</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table-->
            <div class="graphite demo-container">
                <ul class="accordion" id="accordion-1">
                    <li><a href="#">Home</a></li>
                    <li class="dcjq-current-parent"><a href="#">Invoices</a><ul>
                            <li class="dcjq-current-parent"><a href="invoice.php">Create New Invoice</a></li>
                            <li><a href="open_invoice_list.php">Open Invoice List</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Payments</a>
                        <ul>
                            <li><a href="payment.php">Apply Payments</a></li>
                            <li><a href="dues_payment.php">Apply Due Payments</a></li>
                            <li><a href="#">Open Due List</a></li>
                            <li><a href="#">View Payments</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Inventory</a>
                        <ul>
                            <li><a href="#">New Items</a></li>
                            <li><a href="#">View Items List</a></li>
                            <li><a href="#">View Inventory Rpt.</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Banking Transection</a>
                        <ul>
                            <li><a href="#">Create Account</a></li>
                            <li><a href="#">Account Summery</a></li>
                            <li><a href="#">Transection Report</a></li>
                            <li><a href="#">Per Bank Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Reports</a>
                        <ul>
                            <li><a href="#">Invoices Report</a></li>
                            <li><a href="#">Payment Report</a></li>
                            <li><a href="#">Customer Report</a></li>
                            <li><a href="#">Last Update Item</a></li>
                            <li><a href="#">Last Sales Item</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Customers</a>
                        <ul>
                            <li><a href="customer_info.php">New Customers</a></li>
                            <li><a href="view_customer.php">View Customers List</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Employee</a>
                        <ul>
                            <li><a href="employee.php" class="colorboxButton">New Employee</a></li>
                            <li><a href="view_emp.php">View Employee</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Suppliers</a>
                        <ul>
                            <li><a href="#">New Suppliers</a></li>
                            <li><a href="#">View Suppliers</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">LogOut</a></li>
                </ul>
            </div>
        </td>
        <td valign="top">