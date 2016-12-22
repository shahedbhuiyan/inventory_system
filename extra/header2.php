<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	include_once("data_query.php");
	include_once("drug_data.php");
?>
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
	$(".colorboxButton").colorbox();
});


</script>

<style type="text/css">
a{color:#000000; text-decoration:none;
font-size:14px;}


</style>
</head>
<body bgcolor="#D0D0D0">
<table align="center" width="920" style="border:4px solid #B0B0B0; border-radius:5px;">
	<tr><td colspan = '5'  height="90"><img src="image/banner.png" height="90"/></td></tr>
    <tr bgcolor="black"><td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold"></td></tr>
    <tr>
    	<td height="500" valign="top" width="160" bgcolor="#F0F0F0" rowspan="4">
        	<table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" border = '0' cellpadding="3">
            	<?php if($_SESSION['sesUserType'] == 'User'){ ?>
                <tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Invoices</td>
                </tr>
                
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="150" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;" >
                        	<tr><td><a href="invoice.php" target="_blank">Create New Invoice</a></td></tr>
                            <tr><td><a href="open_invoice_list.php">Open Invoice List</a></td></tr>
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
                        	<tr><td><a href="payment.php">Apply Payments</a></td></tr>
                            <tr><td><a href="dues_payment.php">Apply Due Payments</a></td></tr>
                            <tr><td><a href="open_due_list.php">Open Due List</a></td></tr>
                            <tr><td><a href="view_payments.php">View Payments</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Office Expense</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="daily_expnse.php">Daily Expense</a></td></tr>
                            <tr><td><a href="daily_expense_report.php">Daily Expense Report</a></td></tr>
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
                        	<tr><td><a href="store_item.php">New Items</a></td></tr>
                            <tr><td><a href="view_item_list.php" target="_blank">View Items List</a></td></tr>
                            <tr><td><a href="item_wise_sells_report.php" target="_blank">Item-Wise sells Report</a></td></tr>
                            <tr><td><a href="item_wise_purchase_report.php" target="_blank">Item-Wise Purchase Report</a></td></tr>
                        </table>
                    </td>
                </tr>
                <tr><td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold"><a href="logout.php">Logout</a></td></tr>
            </table>
                <?php } else {?>
                <tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Invoices</td>
                </tr>
                
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="invoice.php" target="_blank">Create New Invoice</a></td></tr>
                            <tr><td><a href="open_invoice_list.php">Open Invoice List</a></td></tr>
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
                        	<tr><td><a href="payment.php">Apply Payments</a></td></tr>
                            <tr><td><a href="dues_payment.php">Apply Due Payments</a></td></tr>
                            <tr><td><a href="open_due_list.php">Open Due List</a></td></tr>
                            <tr><td><a href="view_payments.php">View Payments</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Office Expense</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="daily_expnse.php">Daily Expense</a></td></tr>
                            <tr><td><a href="daily_expense_report.php">Daily Expense Report</a></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <table width="150" align="center" bgcolor="white" style="margin-top:7px" cellspacing="0" cellpadding="3">
            	<tr>
                	<td bgcolor="#CCCCCC" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold">Repost's</td>
                </tr>
                <tr>
                	<td bgcolor="#FFFFFF" valign="top">
                    	<table align="center" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:11px">
                        	<tr><td><a href="daily_dashboard.php">Dash Board</a></td></tr>
                        	<tr><td><a href="daily_sales_report.php">Daily Sales Report</a></td></tr>
                            <tr><td><a href="supliers_provided_item.php">Supplier's Report</a></td></tr>
                            <tr><td><a href="purchase_report.php">Purchase Report</a></td></tr>
                            <tr><td><a href="profit_report.php">Custom Profit Report</a></td></tr>
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
                        	<tr><td><a href="store_item.php">New Items</a></td></tr>
                            <tr><td><a href="view_item_list.php" target="_blank">View Items List</a></td></tr>
                            <tr><td><a href="item_wise_sells_report.php" target="_blank">Item-Wise sells Report</a></td></tr>
                            <tr><td><a href="item_wise_purchase_report.php" target="_blank">Item-Wise Purchase Report</a></td></tr>
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
                            <tr><td><a href="UserAccess.php">User Access</a></td></tr>
                            <tr><td><a href="ViewUserAccess.php">View User Access</a></td></tr>
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
                        	<tr><td><a href="create_suppliers.php">New Suppliers</a></td></tr>
                            <tr><td><a href="view_suppliers.php">View Suppliers</a></td></tr>
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
                <tr><td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#099; font-weight:bold"><a href="logout.php">Logout</a></td></tr>
            </table

         <?php } ?>
        </td>
        
        <td valign="top" style="vertical-align:text-top">