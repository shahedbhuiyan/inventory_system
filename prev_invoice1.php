<?php
if(!session_id()) session_start();
if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
	header("Location: ./login.php");
	exit;
}

include_once("invoice_class.php");
$invoice_no = $_GET['inv'];
$inv_obj = new invoice();
//$lst_id = $inv_obj->getLastId();
//$last_invoice_no = $inv_obj->getLastInvoiceNo($lst_id); // for last invoice no
if($invoice_no != ''){
	@$paid_amount = $inv_obj->getPaidAmount($invoice_no);
	$delivery_info = $inv_obj->getDeliveryInfo($invoice_no);
	$item_record = $inv_obj->getItemRows($invoice_no); // item reocrd info
	$payment_mode = $inv_obj->getPaymentMode($invoice_no);
	$cust_id = $inv_obj->getCustomerId($invoice_no);
	$cust_id = explode("|",$cust_id);
	$cust_info = $inv_obj->getCustomerInfo(@$cust_id[0]);
	$delivery_ary = explode("|",$delivery_info);
}

?>
<table align="left" width="750" border="0" cellspacing="0">
	<tr>
    	<td height="20" colspan="3"></td>
    </tr>
    <tr>
    	<td colspan="3" style="text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:23px; font-weight:bold">Bishmillah Paper House</td>
    </tr>
    <tr>
    	<td height="10" colspan="3"></td>
    </tr>
    <tr><td colspan="3" style="text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold">Invoice/Bill</td></tr>
    <tr>
    	<td valign="top"><fieldset style="width:200px; height:75px; font-family:Verdana, Geneva, sans-serif; font-size:13px"><legend>Customer Info</legend>
        Name 	: <?php echo @$cust_info->name." ".@$cust_info->cname; ?><br />
        Contact : <?php echo @$cust_info->contact; ?><br />
        Address : <?php echo @$cust_info->addr; ?>
        </fieldset>
        </td>
        <td valign="top">
        <fieldset style="width:200px; height:75px; font-family:Verdana, Geneva, sans-serif; font-size:13px; float:left"><legend>Invoice</legend>
        Invoice No : <?php echo @$invoice_no; ?><br />
        Date : <?php echo @$cust_id[1]; ?><br />
        Promise Mode : <?php echo isset($payment_mode)?$payment_mode : "N/A"; ?>
        </fieldset>
        </td>
        <td valign="top">
        	<fieldset style="width:200px; height:75px; font-family:Verdana, Geneva, sans-serif; font-size:13px; float:left"><legend>Delivery Info</legend>
        Name : <?php echo @$delivery_ary[0]; ?><br />
        Contact : <?php echo @$delivery_ary[1]; ?><br />
        Postal Code : <?php echo @$delivery_ary[2]; ?><br />
        Address : <?php echo @$delivery_ary[3]; ?>
        </fieldset>
        </td>
    </tr>
    <tr>
    	<td colspan="3" valign="top">
        	<table align="left" width="100%" border="0" cellpadding="2" cellspacing="1" style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
                <tr><td height="10"></td></tr>
                <tr bgcolor="black" style="color:white; font-weight:bold; font-size:12px">
                    <td>S.L</td>
                    <td>Item's Name</td>
                    <td>Quantity</td>
                    <td>Unit Price</td>
                    <td>Warranty</td>
                    <td>Total</td>
                </tr>
                	<?php
						$i = 0;
						$gt = 0;
						if(isset($item_record))
						foreach($item_record as $val){
							$i++;
							$warranty = "N/A";
							if(isset($val)){
								extract($val);
								echo "<tr>";
								echo "<td>".@$i."</td>";
								echo "<td>".@$item_name."</td>";
								echo "<td>".@$quantity."</td>";
								echo "<td>".@$unit_price."</td>";
								echo "<td>".@$warranty."</td>";
								echo "<td>".@$total_taka."</td>";
								echo "</tr>";
								$gt += $total_taka;
							}
						}
						$due = $gt - $paid_amount;
					?>
                    <tr><td colspan="6" style="border-top:2px solid black">&nbsp;</td></tr>
            </table>
        </td>
    </tr>
    <tr><td colspan="3" height="15"></td></tr>
    <tr>
    	<td colspan="3" style="text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">Grand Total : <?php echo @$gt." "."BDT"; ?></td>
    </tr>
    <tr>
    	<td colspan="3" style="text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">Paid Amount : <?php echo @$paid_amount." "."BDT"; ?></td>
    </tr>
    <tr>
    	<td colspan="3" style="text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">Due Amount : <?php echo @$due." "."BDT"; ?></td>
    </tr>
    <tr><td height="20"></td></tr>
    <tr><td colspan="3" style="text-align:left; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">In Word : <?php echo $inv_obj->convert_number(@$gt)." Taka Only"; ?> </td></tr>
	<tr><td height="20"></td></tr>
    <tr><td valign="top" colspan="3">
    
    <table align = 'center' width = '100%' border = '0'><tr style = 'font-family:tahoma; font-size:13px; color:#666666;'><td width = '400' style = 'text-align:left; text-decoration:underline;'>Received with good condition by</td><td width = '400' style = 'text-align:right; text-decoration:underline;'>Authorised Signature & Company Stamp</td></tr></table>
	<table><tr><td height = '15'></td></tr></table>
	<table width = '100%' align = 'center' border = '0'><tr style = 'font-family:tahoma; font-size:11px; color:#000000;'><td width = '400'><p style = 'text-align:justify;'>Warranty will be void if any physical damage to the product<br>or warranty sticker are removed and sold goods are not refundable</p></td><td style = 'text-align:right;'>Printing Date:<br>Time of Printing:</td><td width = '75'><?php echo date("d/M/Y"); echo "<br>"; echo date("h:i:s A"); echo "</td></tr></table>"; ?>
	<table align = 'center' width = '100%'><tr><td style = 'font-family:verdana; text-align:right; font-size:11px;'>For print <a href = '#' onclick='window.print(); return false'>click</a> here</td></tr></table>

    </td></tr>
</table>


