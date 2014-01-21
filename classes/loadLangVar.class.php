<?php
/**
 * ++Clase contenedora de las funciones de seguridad
 * @author rodolfo.bais
 */
class loadLangVar{
	private $dir = '';
	function __construct($param){
		$this -> dir = $param;
	} 
	function load() {
		include_once( $this -> dir.'classes/dataBase.class.php');
		$db = new dataBase($this -> dir);
		global $arrLang;
		
		$sql = "SELECT `idvar`, `descrp` FROM `languajevar` WHERE `module` IN ('GENERIC','MENU','".$_SESSION['menu']."') AND `languaje` = '".$_SESSION['lang']."'";
		// echo $sql;
		$result = $db -> QueryFetchArrayASSOC($sql);
		$arrLang = array();
		foreach ($result as $value) {
			$arrLang[$value['idvar']] = utf8_encode($value['descrp']);
		}
// 		echo "<pre>".print_r($arrLang,true)."</pre>";
	}
}
?>
