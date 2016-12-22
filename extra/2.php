<?php
	getstr('artyu','adksadskldlsadkjflsakdfjlsakdfjjfh','mahtab uddin shahed','slakdfj laksdjflaskdfj lakdsfjaslkdfj defg');
	
	function getstr($a,$b,$c,$d){
		if(strlen($a) > strlen($b)){
			if(strlen($a) > strlen($c)){
				if(strlen($a)>strlen($d)){
					echo "a is big";
				} else {
					echo "d is big";	
				}
			} else {
				if(strlen($c)>strlen($d)){
					echo "c is big";
				} else {
					echo "d is big";	
				}
			}		
		} else {
			if(strlen($b)>strlen($c)){
				if(strlen($b)>strlen($d)){
					echo "b is big";
				} else {
					echo "d is big";	
				}	
			} else {
				if(strlen($c)>strlen($d)){
					echo "c is big";
				} else {
					echo "d is big";	
				}	
			}
		}
	}
?>