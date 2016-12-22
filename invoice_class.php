<?php
	if(!session_id()) session_start();
	if(!isset($_SESSION['sesUser']) || empty($_SESSION['sesUser'])) {
		header("Location: ./login.php");
		exit;
	}
	
	include_once("conn.php");
	class invoice{
		private $system_db = array();
		private $mysql_link;
		public function __construct(){
			$this->system_db['host_name']		= DB_HOST;
			$this->system_db['user_name']		= DB_USER;
			$this->system_db['pass']			= DB_PASSWORD;
			$this->system_db['database']		= DB_NAME;
			
			$this->mysql_link = mysql_connect($this->system_db['host_name'],$this->system_db['user_name'],$this->system_db['pass']);
			if(!$this->mysql_link){
				die("Could not connet : " . mysql_error());
			} else if($this->system_db['database'] != NULL){
				if(!mysql_select_db($this->system_db['database'],$this->mysql_link)) 
					die("Could not select database : " . mysql_error());
			}
		}
		
		public function getLastId(){
			$sql = "SELECT MAX(id) as id FROM voucher_list";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$id = $row['id'];
			}
			return $id;
		}
		
		public function getLastInvoiceNo($id){
			$sql = "SELECT * FROM voucher_list WHERE id = '$id'";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$inv = $row['invoice_no'];
			}
			return @$inv;
		}
		
		public function getCustomerId($invoice){
			$sql = "SELECT * FROM voucher_list WHERE invoice_no = '$invoice'";
			$rec = mysql_query($sql);
			if($row = mysql_fetch_object($rec)){
				$cust_id = $row->cust_id;
				$date	= $row->date;
			}
			return $cust_id."|".$date;
		}
		
		public function getCustomerInfo($cust_id){
			$sql = "SELECT * FROM customer_info WHERE cust_id = '$cust_id'";
			$rec = mysql_query($sql);
			if($row = mysql_fetch_object($rec)){
				return $row;
			}
		}
		
		public function getPaymentMode($invoice_no){
			$sql = "SELECT * FROM payment WHERE invoice_no = '$invoice_no'";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$payment_mode = $row['payment_mode'];
			}
			return @$payment_mode;
		}
		
		public function getItemRows($invoice_no){
			$sql1 = "SELECT * FROM voucher_list WHERE invoice_no = '$invoice_no'";
			$rec1 = mysql_query($sql1);
			if($row1 = mysql_fetch_array($rec1)){
				$inv_sl = $row1['id'];
			}
			
			$sql = "SELECT * FROM ledger WHERE inv_sl = '$inv_sl'";
			$rec = mysql_query($sql);
			$row_basic = array();
			$row_col = array();
			$i = 0;
			while($row = mysql_fetch_array($rec)){
				$item_id = $row['item_id'];
				$item_name = $row['product'];
				$unit_price = $row['unit_price'];
				$quantity = $row['quantity'];
				$total_taka = $row['total'];
				
				for($j = 0; $j<1; $j++){
					$row_basic['item_id'] = $item_id;
					$row_basic['item_name'] = $item_name;
					$row_basic['unit_price'] = $unit_price;
					$row_basic['quantity'] = $quantity;
					$row_basic['total_taka'] = $total_taka;
				}
				$row_col[$i] = $row_basic;
				$i++;
			}
			return $row_col;
		}
		
		public function convert_number($number) { 
			if (($number < 0) || ($number > 999999999)) 
			{ 
			throw new Exception("Number is out of range");
			} 
		
			$Gn = floor($number / 1000000);  /* Millions (giga) */ 
			$number -= $Gn * 1000000; 
			$kn = floor($number / 1000);     /* Thousands (kilo) */ 
			$number -= $kn * 1000; 
			$Hn = floor($number / 100);      /* Hundreds (hecto) */ 
			$number -= $Hn * 100; 
			$Dn = floor($number / 10);       /* Tens (deca) */ 
			$n = $number % 10;               /* Ones */ 
		
			$res = ""; 
		
			if ($Gn) 
			{ 
				$res .= $this->convert_number($Gn) . " Million"; 
			} 
		
			if ($kn) 
			{ 
				$res .= (empty($res) ? "" : " ") . 
					$this->convert_number($kn) . " Thousand"; 
			} 
		
			if ($Hn) 
			{ 
				$res .= (empty($res) ? "" : " ") . 
					$this->convert_number($Hn) . " Hundred"; 
			} 
		
			$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
				"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
				"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
				"Nineteen"); 
			$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
				"Seventy", "Eigthy", "Ninety"); 
		
			if ($Dn || $n) 
			{ 
				if (!empty($res)) 
				{ 
					$res .= " and "; 
				} 
		
				if ($Dn < 2) 
				{ 
					$res .= $ones[$Dn * 10 + $n]; 
				} 
				else 
				{ 
					$res .= $tens[$Dn]; 
		
					if ($n) 
					{ 
						$res .= "-" . $ones[$n]; 
					} 
				} 
			} 
		
			if (empty($res)) 
			{ 
				$res = "zero"; 
			} 
		
			return $res; 
		}
		
		public function getDeliveryInfo($invoice_id){
			$sql = "SELECT * FROM delivery_info WHERE invoice_no = '$invoice_id'";	
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$name = $row['hname'];
				$contact = $row['contact'];
				$pcode = $row['pcode'];
				$addr = $row['addr'];
			}
			return @$name."|".@$contact."|".@$pcode."|".@$addr;	
		}
		
		public function getPaidAmount($invoice){
			$sql = "SELECT * FROM payment WHERE invoice_no = '$invoice'";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$due = $row['paid_amount'];
			}
			return $due;
		} 
	
	}