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
.fnt{font-weight:bold; font-size:12px}
</style>
</head>
<body>
<table align="left" width="1000" border="0">
	
    <tr>
    	<td width="160" height="100%" valign="top" nowrap="nowrap" bgcolor="black">
            <div class="graphite demo-container">
                <ul class="accordion" id="accordion-1">
                    <li><a href="index.php" class="fnt">Home</a></li>
                    <li class="dcjq-current-parent"><a href="#" class="fnt">Invoices</a><ul>
                            <li class="dcjq-current-parent"><a href="invoice.php" target="_blank">Create New Invoice</a></li>
                            <li><a href="open_invoice_list.php">Open Invoice List</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="fnt">Payments</a>
                        <ul>
                            <li><a href="payment.php">Apply Payments</a></li>
                            <li><a href="dues_payment.php">Apply Due Payments</a></li>
                            <li><a href="open_due_list.php">Open Due List</a></li>
                            <li><a href="view_payments.php">View Payments</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Office Expense</a>
                        <ul>
                            <li><a href="daily_expnse.php">Daily Expense</a></li>
                            <li><a href="daily_expense_report.php">Daily Expense Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Reports</a>
                        <ul>
                            <li><a href="daily_dashboard.php">Dash Board</a></li>
                            <li><a href="daily_sales_report.php">Daily Sales Report</a></li>
                            <li><a href="supliers_provided_item.php">Supplier's Report</a></li>
                            <li><a href="purchase_report.php">Purchase Report</a></li>
                            <li><a href="profit_report.php">Custom Profit Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Inventory</a>
                        <ul>
                            <li><a href="store_item.php">New Items</a></li>
                            <li><a href="view_item_list.php" target="_blank">View Items List</a></li>
                            <li><a href="item_wise_sells_report.php" target="_blank">Item-Wise sales Report</a></li>
                            <li><a href="item_wise_purchase_report.php" target="_blank">Item-Wise Purchase Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Banking</a>
                        <ul>
                            <li><a href="create_account.php">Create Account</a></li>
                            <li><a href="view_account.php">View Account</a></li>
                            <li><a href="transection.php">Transection</a></li>
                            <li><a href="transection_rpt.php">Transection Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Employee</a>
                        <ul>
                            <li><a href="employee.php">New Employee</a></li>
                            <li><a href="view_emp.php">View Employee</a></li>
                            <li><a href="UserAccess.php">User Access</a></li>
                            <li><a href="ViewUserAccess.php">View User Access</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Suppliers</a>
                        <ul>
                            <li><a href="create_suppliers.php">New Suppliers</a></li>
                            <li><a href="view_suppliers.php">View Suppliers</a></li>
                            <li><a href="suppliers_payment.php">Suppliers Payment</a></li>
                            <li><a href="suppliers_payment_history.php">View Suppliers Payment</a></li>
                            <li><a href="individual_history.php">Payment Summary</a></li>
                            <li><a href="individual_details_of_suppliers.php" target="_blank">Payment History</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#" class="fnt">Customers</a>
                        <ul>
                            <li><a href="customer_info.php">New Customers</a></li>
                            <li><a href="view_customer.php">View Customers List</a></li>
                        </ul>
                    </li>
                    
                    
                    <li><a href="logout.php" class="fnt">LogOut</a></li>
                </ul>
            </div>
        </td>
        <td valign="top">