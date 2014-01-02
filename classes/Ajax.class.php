<?php
/**
 * Clase Ajax
 *
 * @author Rodolfo Bais <rodolfo@electroturno.com>
 */

class Ajax{

    /**
    * Llama un método de una clase (los cuales se especifican en el objeto que recibe como parámetro), valida que la clase a la cuál estamos haciendo referencia y el método existan,
    * y de ser así retorna el resultado en JSON (haciendo uso del método encode() ), de lo contrario retorna el mensaje de error correspondiente.
    *
    * @param object $json objecto JSON con el set de datos. Los atributos "clase" y "metodo" son obligatorios.
    * @return object objeto JSON
    */
    public function getRequest($json){
//     	echo "<pre>"; echo print_r($_SERVER); echo "<pre>";
        $obj = $this->decode($json);
        $clase = $obj->carpeta.$obj->clase.".class.php";
		if (file_exists($clase)){
			require_once($clase);
			$class = new $obj->clase;
		}else{
        	return $this->encode(1, 'La clase a la cúal hace referencia no existe',$clase);
		}
		$method = $obj->metodo;
		if (method_exists($class, $method)) {
			$result = $class->$method($obj);
			return $this->encode($result->error, $result->msg, $result->html);
		}else{
			return $this->encode(1, 'El método de la clase a la cúal hace referencia no existe');
		}
    }
    
    /**
    * Transforma los datos pasados como parametro en un JSON válido
    *
    * @param int $error si hubo error en la operación o no (0 = NO o 1 = SI)
    * @param string $msg mensaje a mostrar al usuario
    * @param string $html html a incluir en el JSON
    * @return object objeto PHP
    */
    public function encode($error, $msg, $html = ''){
//         include_once("classes/JSON.class.php");
        $json = new Services_JSON;
        $data = array(  "error" => $error,
                        "msg" => $msg,
                        "html" => $html);
        return $json->encode($data);
    }

    /**
    * Transforma el texto enviado en formato JSON a un objeto PHP
    *
    * @param string $html texto JSON a decodear
    * @return object objeto PHP
    */
    public function decode($html){
//         include_once("classes/JSON.class.php");
        $json = new Services_JSON();
        $data = stripslashes($html);
        return $json->decode($data);
    }
    
}
?>
