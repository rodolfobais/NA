<?PHP
/**
 * ++Clase generadora de controles de HTML
 * @author rodolfo.bais
 * @param propiedades: debe ser un array con la siguiente estructura -> $propiedades = array('clase' => 'campos', 'name' => 'test'); 
 */
class html{
	private $basepath = '';
	private $db = '';
	function __construct(){
		include_once( 'classes/dataBase.class.php');
		$this -> db = new dataBase($this -> basepath);
	}
	function textarea($name, $value,$propiedades = array()){
		$ta  = "<TEXTAREA name='".$name."' id='".$name."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$ta .= $propiedad." = '".$valor."' ";
			}
		}
		$ta .= " >\n";
		$ta .= "".$value."";
		$ta .= "</TEXTAREA>";
        return $ta;
    }
    function select($name, $aoptions, $propiedades = array()){
    	$vs = "<SELECT ";
   		if ($name != '') {
   			$vs .= " name='".$name."' id = '".$name." '";
   		}
   		if ($propiedades['value']) {
   			$selected = $propiedades['value'];
   			unset($propiedades['value']);
   		}else{
   			$selected = '';
   		}
   		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$vs .= $propiedad." = '".$valor."' ";
			}
		}
    	
    	//Genero una opci�n vac�a por default
    	$vs .= " >\n";
    	$vs .= "<OPTION value='' ></OPTION>\n";
    	if ($aoptions != ''){
    		foreach ($aoptions as $a=>$b){
    			$vs .= "<OPTION value='".$b[0]."'";
    			if ($selected == $b[0]){
    				$vs .= " SELECTED ";
    			}
//     			echo "<pre>"; print_r($aoptions); echo "</pre>";
//     			echo "a: ".print_r($a)."<br>";
//     			echo "b: ".print_r($b)."<br><br>";
    			$vs .= ">".utf8_encode($b[1])."</OPTION>\n";
    		}
    	}
    	$vs .= "</SELECT>\n";
//     	$vs .= "<pre>".print_r($aoptions,true)."</pre>";
    	return $vs;
    }
	function hidden($name, $value){
		$hi  = "<INPUT type='hidden' name='".$name."' id='".$name."'";
		$hi .= " value='".$value."'";
		$hi .= ">\n";
        return $hi;
    } 
	function checkbox($name, $value, $propiedades = array()){
		$ch .= "<INPUT type='checkbox' name='".$name."' id='".$name."' value='".$value."'";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$ch .= $propiedad." = '".$valor."' ";
			}
		}
	  	$ch .= " >\n";
	  	return $ch;
	}
	function text($name, $value, $propiedades = array()){
		$te .= "<INPUT type='text' name='".$name."' id='".$name."' value='".$value."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$ch .= $propiedad." = '".$valor."' ";
			}
		}
	  	$te .= " >\n";
		
		return $te;
	}
	function textFile($name, $value, $propiedades = array()){
	  	$fl .= "<INPUT type='file' name='".$name."' id='".$name."' value='".$value."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$fl .= $propiedad." = '".$valor."' ";
			}
		}
	  	$fl .= " >\n";
		
		return $fl;
	}
	function psswrd($name, $value, $propiedades = array()){
	  	$psw .= "<INPUT type='password' name='".$name."' id='".$name."' value='".$value."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$psw .= $propiedad." = '".$valor."' ";
			}
		}
	  	$psw .= " >\n";
		
		return $psw;
    }
	function submit($name, $value, $propiedades = array()){
		$su .= "<INPUT type='submit' name='".$name."' id='".$name."' value='".$value."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$su .= $propiedad." = '".$valor."' ";
			}
		}
	  	$su .= " >\n";
		
		return $su;
    }
	function button($name, $value, $propiedades = array()){
     	$bu .= "<INPUT type='button' name='".$name."' id='".$name."' value='".$value."' ";
		if($propiedades != ''){
			foreach ($propiedades as $propiedad => $valor) {
				$bu .= $propiedad." = '".$valor."' ";
			}
		}
	  	$bu .= " >\n";
		return $bu;
    }
    /**
     * 
     * @param array $propiedades
     * @return string
     * Éste método genera un input sólo con las propiedades que le vienen por parámetro
     */
    function genericInput($propiedades){
    	include_once( 'configs/default.conf.php');
		

    	switch ($propiedades['type']) {
    		case 'select':
    			unset($propiedades['type']);
    			$name = $propiedades['name'];
    			unset($propiedades['name']);
    			unset($propiedades['id']);
    			if ($propiedades['sql']) {
    				$sql = $propiedades['sql'];
    				unset($propiedades['sql']);
    				$aoptions = $this -> db -> QueryFetchArray($sql);
//     				unset($propiedades['sql 	Editar Editar 	Copiar Copiar 	Borrar Borrar 	group.id 	id 	group.id 	id 	50 	true 	left 			text 	']);
//     				echo "<pre>"; print_r($aoptions); echo "</pre>";
    			}
    			
    			$gn = $this->select($name, $aoptions, $propiedades);
    		break;
    		
    		case 'dateasadsasd':
    			unset($propiedades['type']);
    			$name = $propiedades['name'];
    			unset($propiedades['name']);
    			unset($propiedades['id']);
    			if ($propiedades['sql']) {
    				$sql = $propiedades['sql'];
    				unset($propiedades['sql']);
    				$aoptions = $this -> db -> QueryFetchArray($sql);
//     				unset($propiedades['sql 	Editar Editar 	Copiar Copiar 	Borrar Borrar 	group.id 	id 	group.id 	id 	50 	true 	left 			text 	']);
    				//     				echo "<pre>"; print_r($aoptions); echo "</pre>";
    			}
    			$gn = $this->select($name, $aoptions, $propiedades);
    		break;
    		
    		default:
    			$gn = "<INPUT ";
		    	if($propiedades != ''){
		    		foreach ($propiedades as $propiedad => $valor) {
		    			$gn .= $propiedad." = '".$valor."' ";
		    		}
		    	}
		    	$gn .= " >\n";
    		break;
    	}
    	return $gn;
    }
}
?>
