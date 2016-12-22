<?php 
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
include_once("model.php");
$base_process = new model();
$incr = $base_process->incrementId("voucher_list","id");
$employee_name = getEmployeeName($_SESSION['sesID']);
function getEmployeeName($id){
	$sql = "SELECT * FROM employee_info WHERE emp_id = '".$id."'";
	$rec = mysql_query($sql);
	while($row = mysql_fetch_array($rec)){
		$fname = $row['fname'];
		$lname = $row['lname'];
	}
	return @$fname." ".@$lname;
}
?>
<style type="text/css">
input,select,textarea{background-color:white}
.dropdown { margin:0; padding:0; max-height:200px; width:216px; border:1px solid #CCC; overflow:auto;}
.dropdown li { padding:0 0 0 5px; margin:0; list-style:none; height:25px; border:1px solid #666; border-top:none; }
.dropdown, #dropdown_input { width:200px; }

.dropdownItemSelected { background-color:#999; }
td{font-family:'Courier New', Courier, monospace; font-size:12px;}
</style>


<input type="text" readonly="readonly" style="border:1px solid white"/>

<table align="left" width="900" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" cellspacing="1">  
	<tr>
    	<td height="15"></td>
    </tr>
    <tr><td colspan="3" style="font-family:'Courier New', Courier, monospace; text-align:center; font-size:25px; font-weight:bold">Bishmillah Paper House</td></tr>
    <tr>
    	<td height="15"></td>
    </tr>
    <tr>
    	<td valign="top">
        	<table>
            	<tr>
                	<td>Customer ID</td>
                    <td><input type="text" readonly="readonly" style="text-align:center; color:red;" name="id_no" id="id_no" /></td>
                </tr>
            	<tr>
                	<td>Customer Name</td>
                    <td><input type="text" name="cname1" id="cname1" /></td>
                </tr>
                <tr>
                    <td>Contact No</td>
                    <td><input type="text" name="contact" id="contact" /></td>
                </tr>
                <tr>
                    <td>Company Name</td>
                    <td><input type="text" name="cname" id="cname" /></td>
                </tr>
                <tr>
                    <td valign="top">Billing Address</td>
                    <td><textarea name="addr" id="addr"></textarea></td>
                </tr>
            </table>
        </td>
      	<td valign="top">
        	<table>
            	<tr>
                	<td>Sold By</td>
                    <td><input type="text" name="solder" id="solder" value="<?php echo @$employee_name; ?>" readonly="readonly" style="text-align:center; color:red" /></td>
                </tr>
                <tr>
                    <td>Invoice SL</td>
                    <td><input type="text" style="text-align:center; color:red" readonly="readonly" name="inv_sl" id="inv_sl" /></td>
                </tr>
                <tr>
                    <td>Invoice No</td>
                    <td><input type="text" name="inv_no" id="inv_no" style="width:143px; text-align:center; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:red" readonly="readonly" /></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><input type="text" name="odate" id="odate" readonly="readonly" value="<?php echo date("Y/m/d"); ?>" /></td>
                </tr>
            </table>
        </td>
        <td valign="top">
        	<table>
            	<tr>
                	<td>Holder Name</td>
                    <td><input type="text" name="hname" id="hname"/></td>
                </tr>
                <tr>
                	<td>Contact</td>
                    <td><input type="text" name="contact1" id="contact1"/></td>
                </tr>
                <tr>
                	<td>Postal Code</td>
                    <td><input type="text" name="pcode" id="pcode"/></td>
                </tr>
                <tr>
                	<td valign="top">Delevery Address</td>
                    <td><textarea id="d_addr" name="d_addr"></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table align="left" width="900" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold" border="0" cellspacing="1">
	<tr>
    	<td width="150">Item</td>
        <td width="250">Item Descreption</td>
        <td width="175">Unit Price</td>
        <td width="175">Quantity</td>
        <td>Total</td>
    </tr>
</table>
<!--<div id="invoice_content" style="float:left"></div>-->
<table align="left" border="0" id="invoice_content"></table>
<table align="left" border="0" width="800" cellspacing="1">
	<tr><td colspan="3" height="10">&nbsp;</td></tr>
	<tr><td align="right">Total</td><td width="1">:</td><td width="150"><input type="text" name="g_total" readonly="readonly" value="0" style="text-align:center; color:red; width:116px" id="g_total" /></td></tr>
</table>
<table align="left" width="900" border="0" cellspacing="1">
	<tr>
    	<td align="left"><input type="submit" name = "save" id="save" value="Save"/>&nbsp;&nbsp;<input type="submit" name = "invoice" id="invoice" value="Invoice"/> </td>
    </tr>
</table>

<a href="#" id="new"></a>
<a href="prev_invoice.php" target="_blank" id="link"></a>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/auto_suggestion.js"></script>
<link href="css/auto_suggestion.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
	$(document).ready(function(e) {
		getInvoice();		
		function getInvoice(){
			$.ajax({
				type:"POST",
				url:"invoice_sql.php",
				data:{action:'create_invoice'},
				success: function(invoice){
					//alert(invoice);
					var invoice = invoice.split("|");
					var inv = invoice[0].trim();
					$("#inv_no").val(inv);
					//$("#inv_no").val(invoice[0]);
					$("#inv_sl").val(invoice[1]);
				}	
			});
			$.ajax({
				type:"POST",
				url:"invoice_sql.php",
				data:{action:'get_cust_id'},
				success: function(rsp){
					var rsp = parseInt(rsp) + 1;
					$("#id_no").val(rsp);
				}	
			});
			$("#cname").val("");
			$("#cname1").val("");
			$("#contact").val("");
			$("#addr").val("");
			
			$("#hname").val("");
			$("#pcode").val("");
			$("#contact1").val("");
			$("#d_addr").val("");			
		}
		
		$("#cname1").UISugestion();
		var i = 0;
       	$("#new").click(function(){
			$.ajax({
				type:"POST",
				url:"invoice_sql.php",
				data:{id:i,action:'create'},
				success:function(resp1){
					$("#invoice_content").append(resp1);
					//suggestion_dropdown
					var j;
					for(j = 0; j<=i; j++){
						$("#dropdown_input_"+j).UISugestion();
					}
					$("#dropdown_input_"+i).bind('click',function(){
						var loc = $(this).attr('rel');
						loc = parseInt(loc) + 1;
						if(i == loc){
							$("#new").click();
						}
					});
					
					$("#quantity_"+i).bind('keyup',function(){
						var qty = $(this).val();
						var id = $(this).attr('rel');
						var unit_price = $("#unit_"+id).val();
						
						var total = parseFloat(qty) * parseFloat(unit_price);
						if(!isNaN(total)){
							$("#total_"+id).val(total);
						} else {
							$("#total_"+id).val(0);	
						}
						
						var gt = 0;
					
						for(j = 0; j<i; j++){
							var tp = $("#total_"+j).val();
							if(tp!=''){
								gt += parseFloat(tp);
							}
						}
						
						$("#g_total").val(gt);
					});
					
					//start 
					$("#unit_"+i).bind('keyup',function(){
						var unit_price = $(this).val();
						var id = $(this).attr('rel');
						var quantity = $("#quantity_"+id).val();
						
						var total = parseFloat(unit_price) * parseFloat(quantity);
						if(!isNaN(total)){
							$("#total_"+id).val(total);
						} else {
							$("#total_"+id).val(0);	
						}
						
						var gt = 0;
					
						for(j = 0; j<i; j++){
							var tp = $("#total_"+j).val();
							if(tp!=''){
								gt += parseFloat(tp);
							}
						}
						
						$("#g_total").val(gt);
					});
					
					//end
					i++;
				}	
			});	
		});
		$("#new").click();
		$("#save").click(function(e) {
			
			var invoice		= $("#inv_no").val();
			var inv_sl		= $("#inv_sl").val();
			
			var cust_id		= $("#id_no").val();
			var cust_name 	= $("#cname1").val();
			var contact		= $("#contact").val();
			var addr		= $("#addr").val();
			var cname		= $("#cname").val();
			
			var odate		= $("#odate").val();
			var solder		= $("#solder").val();
			var g_total		= $("#g_total").val();
			
			//for delivery information 
			var hname 		= $("#hname").val();
			var contact1 	= $("#contact1").val();    
			var pcode 		= $("#pcode").val();
			var d_addr		= $("#d_addr").val();
			
			if(hname != '' || contact1 != '' || addr != ''){
				$.ajax({
					type:"POST",
					url:"invoice_sql.php",
					data:{invoice:invoice,hname:hname,contact:contact1,pcode:pcode,addr:d_addr,action:'delilery_info'},
					success: function(feedback){
					
					}
				});
			}
			
			for(j = 0; j<i; j++){
				var item_id		= $("#item_"+j).val();
				var product 	= $("#dropdown_input_"+j).val();
				var unit_price	= $("#unit_"+j).val();
				var quantity	= $("#quantity_"+j).val();
				var warrenty	= $("#warrenty_"+j).val();
				var total		= $("#total_"+j).val();
				var purchase	= $("#purchase_"+j).val();
				
				var total = parseFloat(total);
				
				if(total.length != 0 && !isNaN(total)){
					$.ajax({
						type:"POST",
						url:"invoice_sql.php",
						data:{inv_sl:inv_sl,
						sold_by:solder,
						item_id:item_id,
						product:product,
						unit_price:unit_price,
						quantity:quantity,
						warrenty:warrenty,
						purchase:purchase,
						total:total,
						action:'ledger'},
						success: function(resp3){
							getInvoice();
						}
					});
				}
			}
			
			$.ajax({
				type:"POST",
				url:"invoice_sql.php",
				data:{inv_sl:inv_sl,invoice_no:invoice,g_total:g_total,odate:odate,cust_id:cust_id,cust_name:cust_name,contact:contact,addr:addr,cname:cname,action:'invoice_list'},
				success: function(resp2){
					window.open('prev_invoice.php','','');
					self.location = "invoice.php";
				}	
			});
			
			$("#invoice_content").html("");
			$("#new").click();
        });
    });	
</script>
