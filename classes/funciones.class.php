<?php
session_start();
class funciones{
	private $dir = '';
	private $db = '';
	function __construct($param){
		$this -> dir = $param;
		require_once $this -> dir.'classes/dataBase.class.php';
		$this -> db = new dataBase($this -> dir);
	}
	function getParamValFromURL($var){
		/*
		$parametros = parse_url($_SERVER['HTTP_REFERER']);
	 	
		$parametros = $parametros['query'];
		$parametros2 = explode('&',$parametros);
		
		foreach ($parametros2 as $value) {
			$parametros3 = explode('=',$parametros);
	// 		echo "<pre>"; print_r($parametros3);echo "</pre>";
			if ($parametros3[0] == $var) {
				$salida = $parametros3[1];
			}
		}
		*/
		$salida = $_SESSION['menu'];
	// 	echo $salida;
		return $salida;
	}
	function getModuleQueryFrom($menu){
		$sql = "SELECT `from` , tablebase FROM module where idmodulo = '".$menu."'";
// 	  	 echo $sql;
		$result = $this -> db -> QueryFetchArray($sql);
	// 	echo "<pre>"; print_r($result);echo "</pre>";
		$from = $result[0]['from'];
		$tableBase = $result[0]['tablebase'];
		if ($from == "") {
			$from = "FROM `".$tableBase."`";
		}
	// 	echo $from;
		return $from;
	}
	function uptime(){
		$data = shell_exec('uptime');
		$uptime = explode(' up ', $data);
		$uptime = explode(',', $uptime[1]);
		$uptime = $uptime[0].', '.$uptime[1];
	  return $uptime;
	}
	
	function killchromium(){
	exec("sudo pkill chromium");
	}
	
	
	
	
	// Time format is UNIX timestamp or
	  // PHP strtotime compatible strings
	 function dateDiff($time1, $time2, $precision = 6) {
	    // If not numeric then convert texts to unix timestamps
	    if (!is_int($time1)) {
	      $time1 = strtotime($time1);
	    }
	    if (!is_int($time2)) {
	      $time2 = strtotime($time2);
	    }
	 
	    // If time1 is bigger than time2
	    // Then swap time1 and time2
	    if ($time1 > $time2) {
	      $ttime = $time1;
	      $time1 = $time2;
	      $time2 = $ttime;
	    }
	 
	    // Set up intervals and diffs arrays
	    $intervals = array('year','month','day','hour','minute','second');
	    
	     $diffs = array();
	 
	    // Loop thru all intervals
	    foreach ($intervals as $interval) {
	      // Set default diff to 0
	      $diffs[$interval] = 0;
	      // Create temp time from time1 and interval
	      $ttime = strtotime("+1 " . $interval, $time1);
	      // Loop until temp time is smaller than time2
	      while ($time2 >= $ttime) {
		$time1 = $ttime;
		$diffs[$interval]++;
		// Create new temp time from time1 and interval
		$ttime = strtotime("+1 " . $interval, $time1);
	      }
	    }
	 
	    $count = 0;
	    $times = array();
	    // Loop thru all diffs
	    foreach ($diffs as $interval => $value) {
	      // Break if we have needed precission
	      if ($count >= $precision) {
		break;
	      }
	      // Add value and interval 
	      // if value is bigger than 0
	      if ($value > 0) {
		// Add s if value is not 1
		if ($value != 1) {
		  $interval .= "s";
		}
		// Add value and interval to times array
		$times[] = $value . " " . $interval;
		$count++;
	      }
	    }
	 
	    // Return string with times
	    return implode(", ", $times);
		
	  }
	
	  
	  
	  function clear_space_dot($cadena){
	$cadena = str_replace(' ', '', $cadena);
	$cadena = str_replace('.', '', $cadena);
	$cadena = str_replace('-', '', $cadena);
	return $cadena;
	}
	
	
	function reformat_date($input){
	//input dd-mm0-yyyy
	//output yyyy-mm-dd
	
	$arr = explode('-', $input);
	$date = $arr[2].'-'.$arr[1].'-'.$arr[0];
	/*
	if($date == '--') {
		$date=date("Y-m-d");
		}
	*/
	return $date;
	}
}
?>
