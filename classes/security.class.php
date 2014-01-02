<?PHP
/**
 * ++Clase contenedora de las funciones de seguridad
 * @author rodolfo.bais 
 */
class security{
	public $arrayLogin = array();
	function __construct(){
		require 'dataBase.class.php';
		$this -> db = new dataBase('');
		
	}
	function authenticateUser ($login,$password){
		global $arrConf;
// 		$password = $password;
		$sqlString = "SELECT `user`.id, `user`.surname, `user`.login, `user`.password
				FROM `user`
				WHERE login = '$login' AND password = '$password' AND active = '1'";
		$sql = $this -> db -> QueryArray($sqlString);
// 		echo $sqlString;
// 		echo "<pre>"; print_r($sql);echo "</pre>";die;
		$query_login = $sql['login'];
		$query_password = $sql['password'];
		$query_userId = $sql['id'];
		$query_surname = $sql['surname'];
		$_SESSION['userId'] = $query_userId;
	
		if ( $login == $query_login && $password == $query_password ) {
			$result = true;
		}else{
			$result = false;
		}
		/*
		echo "result: ".$result."<br/>";
		echo "login: ".$login."<br/>";
		echo "query_login: ".$query_login."<br/>";
		echo "password: ".$password."<br/>";
		echo "query_password: ".$query_password."<br/>";
		die;
		*/
		$this -> arrayLogin = $sql;
		
		return $result;
	}
}
?>
