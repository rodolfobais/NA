<?php
/**
 * ++Clase contenedora de las funciones de conexion a la base de datos
 * @author rodolfo.bais 
 */
class dataBase{
	public $msg = '';
	private $dir = '';
	function __construct($param){
		$this -> dir = $param;
	} 
	function dbConnect(){
		require($this->dir.'configs/default.conf.php');
		
	    $dbConn = mysql_pconnect( $arrConf['hostDB_NA'], $arrConf['userDB_NA'], $arrConf['passwordDB_NA'] );
	    if (!$dbConn) {
	    	$this -> msg = 'No pudo conectarse: ' . mysql_error();
	    	echo $this -> msg; 
	    	return false;
	    }/*
	    else{
	    	echo "<br/> 1 db false<br/>";
	    }
	    */
	    $dbConn = mysql_select_db( $arrConf['nameDB_NA'], $dbConn );
		if (!$dbConn) {
	    	$this -> msg = 'No pudo seleccionarse la base (): ' . mysql_error();
	    	echo $this -> msg;
	    	return false;
	    }
	    /*else{
	    	echo "<br/> 2 db false<br/>";
	    }
	    */
		return true;
	}
	
	function dbClose(){
	    mysql_close() or die( "Could not disconnect from database" );
	}	
	
	function QueryArray ($query){
		$this -> dbConnect();
		
		//echo "<br/> ".$query."<br/>";
		
		$sql =  mysql_query($query);
		$datos = mysql_fetch_array($sql) ;
		
		return $datos;
		$this -> dbClose();
	}
	
	function QueryFetchArray ($query){
		$this -> dbConnect();
// 		echo $query."<br/>";
		$sql =  mysql_query($query);
		//$datos = mysql_fetch_array($sql) ;
		$datos = array();
		while ($fila = @mysql_fetch_array($sql, MYSQL_BOTH)) {
			$datos[] = $fila;
		}
	
		return $datos;
		$this -> dbClose();
	}
	
	
	function QuerySimple ($query){
		$this -> dbConnect();
		$sql =  mysql_query($query);
		
		return $sql;
		$this -> dbClose();
	}
	function QueryFetchArrayASSOC ($query)
	{
		$this -> dbConnect();
		//echo $query;
		$sql =  mysql_query($query);
		//$datos = mysql_fetch_array($sql) ;
		$datos = array();
		while ($fila = mysql_fetch_array($sql, MYSQL_ASSOC)) {
			$datos[] = $fila;
		}
	
		return $datos;
		$this -> dbClose();
	}
	function QueryFetchArrayNum ($query)
	{
		$this -> dbConnect();
		//echo $query;
		$sql =  mysql_query($query);
		//$datos = mysql_fetch_array($sql) ;
		$datos = array();
		while ($fila = mysql_fetch_array($sql,MYSQL_NUM)) {
			$datos[] = $fila;
		}
	
		return $datos;
		$this -> dbClose();
	}		
}		
?>
