<?php
	include_once("conn.php");
	class model{
		public $system_db = array();
		public $mysql_link;
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
		
		public function dataInsertion($table,$data,$file = ""){
			if($table != ""){
				$values = "";
				$key 	= "";
				foreach($data as $k=>$v){
					if($values != "") $values .= ", ";
					if($key != "")	  $key .= ", ";
					$values .= sprintf("'%s'",mysql_real_escape_string($v));
					$key	.= sprintf("`%s`",mysql_real_escape_string($k));
				}
				
				if($file != NULL){
					$file_type = $file['pic']['type'];
					$file_size = $file['pic']['size'];
					$file_name = $file['pic']['name'];
					$file_path = $file['pic']['tmp_name'];
					
					$ext = substr($file_name, -3);
					$file_name = $data['emp_id'].".".$ext;
					move_uploaded_file($file_path, "photo/$file_name");
				}
				
				$final_statement = "INSERT INTO `{$table}` ({$key}) VALUES ({$values})";
				mysql_query($final_statement) or die("Error on SQL : {$final_statement}");
				
				$id = mysql_insert_id();
				return true;
			}
			return false;
		}
		
		public function existance_check($qry = ""){
			if($qry != ""){
				$result 	= mysql_query($qry);
				$numRows 	= mysql_num_rows($result);
				if($numRows>0){
					return true;
				} else {
					return false;	
				}
			}
			return false;
		}
		
		public function get($select, $from, $where=array(), $order=array()) {
			if(sizeof($select)>0 && sizeof($from)>0) {
				$s	=	"";
				foreach($select as $v) {
					if($s != "")	$s	.= ", ";	
					if($v == '*')	$s	.=	"*";														
					else $s		.=	sprintf("`%s`", mysql_real_escape_string($v));				
				}	
				$f	=	"";
				foreach($from as $v) {
					if($f	!= "") $f	.= ", ";																
					$f		.=	sprintf("`%s`", mysql_real_escape_string($v));				
				}	
				$w	=	"";
				foreach($where as $k=>$v) {
					if($w	!= "") $w	.= " and ";																
					else $w	=	"where ";
					$w		.=	sprintf("`%s`=", mysql_real_escape_string($k));				
					$w		.=	sprintf("'%s'", mysql_real_escape_string($v));				
				}	
				$o	=	"";
				//print_r($order);
				foreach($order as $v) {
					if($w	!= "") $w	.= " and ";																
					else $w	=	"order by ";				
					$w		.=	sprintf("`%s`", mysql_real_escape_string($v));				
				}	
				$query		=		"select $s from $f $w $o";			
				$result = mysql_query($query);			
				$data	=	array();
				while($row = mysql_fetch_assoc($result)) {
					array_push($data, $row);
					//return $row;
				}
				mysql_free_result($result);
				//print_r($data);
				return $data;			
			}
			return false;
		}
		
		public function update_query($table, $data, $where) {
			if($table != "") {
				$set_value	=	"";			
				$whr_value	=	"";			
				foreach($data as $k=>$v) {
					if($set_value	!= "") $set_value	.= ", ";								
					$set_value	.=	sprintf("`%s`=", mysql_real_escape_string($k)).sprintf("'%s'", mysql_real_escape_string($v));				
				}	
				foreach($where as $k=>$v) {
					if($whr_value	== "")	$whr_value	.= "WHERE ";
					else 					$whr_value	.= " and ";
					$whr_value	.=	sprintf("`%s`='%s'", mysql_real_escape_string($k), mysql_real_escape_string($v));	
				}
				$query	=	"UPDATE `{$table}` SET {$set_value} $whr_value";			
				mysql_query($query) or die("error on $query");
				
				return true;				
			}
			return false;	
		}
		
		public function getLastId(){
			$sql = "SELECT MAX(id) as id FROM voucher_list";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$id = $row['id'];
			}
			return $id;
		}
		
		public function getLastInvoice($id){
			$sql = "SELECT * FROM voucher_list WHERE id = '$id'";
			$rec = mysql_query($sql);
			while($row = mysql_fetch_array($rec)){
				$last_inovice = $row['invoice_no'];
			}
			return @$last_inovice;	
		}
		
		public function incrementId($table,$field){
			$sql = "SELECT MAX($field) as last FROM $table";
			$rec = mysql_query($sql);
			if($row = mysql_fetch_array($rec)){
				$last	= $row['last'];
				$last++;
			}
			return $last;
		}
		
		public function getSuppliersArray(){
			$sql = "SELECT * FROM suppliers";
			$rec = mysql_query($sql);
			$suppliers_ids = array();
			$i = 0;
			while($row = mysql_fetch_array($rec)){
				$i++;
				$sid 	= $row['sid'];
				$sname	= $row['sname'];
						
				$suppliers_ids[$sid] = $sname;
			}
			
			return $suppliers_ids;
		}
		
	} 
?>