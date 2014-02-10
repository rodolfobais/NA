<?php
/**
 * Clase generic_abm
 *
 * @author Rodolfo Bais <rodolfo.bais@drb-webdesign.com.ar>
 */

class generic_abm {
	private $basepath = '';
	private $fn = '';
	private $db = '';
	private $html = '';
	private $lang = '';
	private $date = '';
	function __construct(){
		include_once( $this->basepath.'classes/funciones.class.php');
		include_once( $this->basepath.'classes/dataBase.class.php');
		include_once( $this->basepath.'classes/html.class.php');
		include_once( $this->basepath.'classes/loadLangVar.class.php');
		$this -> fn = new funciones($this->basepath);
		$this -> db = new dataBase($this->basepath);
		$this -> html = new html();
		$this -> lang = new loadLangVar($this->basepath);
		$this->lang->load();
		global $arrLang;
		$hoy = getdate();
		$this -> date = $hoy['year'].$hoy['mon'].$hoy['mday'].$hoy['hours'].$hoy['minutes'].$hoy['seconds'];
	}
	function delete($obj) {
		$salida = "";
		$error = 0;
		
		global $arrLang;
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
				
		$menu = $obj->modulo;
		$valor = explode("|~",$obj->id);
		
		$from = $this -> fn -> getModuleQueryFrom($menu);
		
		//Obtengo el campo que funciona como ID para usar en el delete
		$sqlCampos = "SELECT campofisico
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
		$campoFisico = $arrCampos[0]['campofisico'];
		
		$where = "";
		for ($i = 0; $i < count($arrCampos); $i++) {
			if ($where != "") {
				$where .= " AND ";
			}
			$where .= " ".$arrCampos[$i]['campofisico']." = '".$valor[$i]."'";
		}
		$where = " WHERE ".$where;
		
		$sqlDelete = "DELETE ".$from." ".$where;
		$this -> db -> QuerySimple($sqlDelete);
		
// 		echo $sqlDelete;
		
		return (object)array( 'error' => $error, 'msg' => 'OK', 'html' => $salida);
	}
	function new_entry($obj) {
// 		error_reporting(E_ALL);
// 		ini_set('display_errors', 1);
		
 		
		$error = 0;
		
		global $arrLang;
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
//  		include_once( $this->basepath.'themes/default/lang/es.lang');
 		
		$menu = $obj->modulo;
		
		$salida = $this -> armarGrilla($obj,'NR');
		
		$salida .= '		<br>	   
							<input type="button" onclick="saveNew(\'close\')" value="'.$arrLang['btnSaveClose'].'">
							<input type="button" onclick="saveNew(\'continue\')" value="'.$arrLang['btnSaveContinue'].'">
						</li>
					</ul> 		
				</form>
			</div>
		';
		
		return (object)array( 'error' => $error, 'msg' => $this -> date, 'html' => $salida);
	}
	function edit($obj) {
		$salida = "";
		$error = 0;
		global $arrLang;
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
// 		include_once( $this->basepath.'themes/default/lang/es.lang');
		
		$menu = $obj->modulo;
		$valor = explode("|~",$obj->id);
		
		$from = $this-> fn -> getModuleQueryFrom($menu);
		
		/*Armo el WHERE*/
		$sqlCampos = "SELECT campofisico
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
// 		echo $sqlCampos;
		$arrCampos = $this-> db -> QueryFetchArray($sqlCampos);
		
		$where = "";
		for ($i = 0; $i < count($arrCampos); $i++) {
			if ($where != "") {
				$where .= " AND ";
			}
			$where .= " ".$arrCampos[$i]['campofisico']." = '".$valor[$i]."'";
		}
		$where = " WHERE ".$where;
		
		/*Obtengo los campos*/
		$sqlCampos = "SELECT fields.`idcampo`,campofisico,`nombreenform`,`tipocampo` as tipocampo
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE Idmodulo = '".$menu."'
		AND modulefields.scope = 'ED'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this-> db -> QueryFetchArray($sqlCampos);
// 		echo $sqlCampos;
		$columnas = "";
		foreach ($arrCampos as $result) {
			if ($columnas != "") {
				$columnas .= ", ";
			}
			if ($result['tipocampo'] == 'date'){
				$columnas .= "DATE_FORMAT(".$result['campofisico'].",'%d/%m/%Y') AS ".$result['nombreenform']."";
			}else{
				$columnas .= "".$result['campofisico']."";
			}
		}
		
		$sql = "SELECT ".$columnas." ".$from." ".$where;
// 		echo $sql;
		$arrSelect = $this-> db -> QueryFetchArray($sql);
		
		$valoresPrevios = array();
// 		echo  "<pre>"; print_r($arrCampos); echo "</pre>";
// 		echo "<pre>"; print_r($arrSelect); echo "</pre>";
		foreach ($arrCampos as $value) {
// 			echo "<pre>"; print_r($value); echo "</pre>";
			$valoresPrevios[$value['idcampo']]['valor'] = $arrSelect[0][$value['nombreenform']];
// 			$valoresPrevios[$value[0]]['valor'] = $arrSelect[0][$value[1]];
		}	
// 		echo "<pre>"; print_r($valoresPrevios); echo "</pre>";
		$salida = $this -> armarGrilla($obj,'ED',$valoresPrevios);
		
		$salida .= '		<br>
							<input type="button" onclick="saveEdit(\'close\')" value="'.$arrLang['btnSaveClose'].'">
							<input type="button" onclick="saveEdit(\'continue\')" value="'.$arrLang['btnSaveContinue'].'">
							</li>
						</ul>
					</form>
				</div>
		';
//  		echo $sql;
		return (object)array( 'error' => $error, 'msg' => $this -> date, 'html' => $salida);
	}
	function save_new($obj) {
		$salida = "";
		$error = 0;
		$menu = $obj->modulo;
		$msg = "";
	
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
		
		//Obtengo los datos del formulario
		$GET = explode("&",base64_decode($obj->datos));
		$arrAsoc = Array();
		foreach ($GET as $value) {
			$ArrTemp = explode("=",$value);
			$arrAsoc[$ArrTemp[0]] = urldecode($ArrTemp[1]);
		}
// 		echo "<pre>"; print_r($arrAsoc); echo "</pre>";
		//Obtengo los campos PK
		$sqlCamposPK = "SELECT campofisico,`nombreenform`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
		
		$arrCamposPK = $this-> db -> QueryFetchArray($sqlCamposPK);
// 		echo $sqlCamposPK;
		$sql = "SELECT tablebase FROM module where idmodulo = '".$obj->modulo."'";
		$result = $this-> db -> QueryFetchArray($sql);
// 		echo $sql;
		$tableBase = $result[0]['tablebase'];
	
		$sqlCampos = "SELECT campofisico,`nombreenform`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'NR'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this-> db -> QueryFetchArray($sqlCampos);
		
		//Armo el array para usar en el select de las pk
		$arrSelectPk = Array();
		foreach ($arrCamposPK as $value) {
			$arrSelectPk[$value['nombreenform']]['campofisico'] = $value['campofisico'];
			$arrSelectPk[$value['nombreenform']]['valor'] = $arrAsoc[$value['nombreenform']];
		}
	
		//Armo el array para usar en el insert
		$arrInsert = Array();
		foreach ($arrCampos as $value) {
			$arrInsert[$value['nombreenform']]['campofisico'] = $value['campofisico'];
			$arrInsert[$value['nombreenform']]['valor'] = $arrAsoc[$value['nombreenform']];
		}
	
		$sqlInsertCampos = "";
		$sqlInsertValor = "";
		$sqlInsert = "INSERT INTO ".$tableBase." (";
		foreach ($arrInsert as $value) {
			if ($sqlInsertCampos != "") {
				$sqlInsertCampos .= ", ";
				$sqlInsertValor  .= ", ";
			}
			$sqlInsertCampos .= "".$value['campofisico']."";
			$sqlInsertValor  .= "'".$value['valor']."'";
		}
		$sqlInsert .= $sqlInsertCampos.") VALUES (".$sqlInsertValor.")";
		
		$sqlSelectPk = "";
		foreach ($arrSelectPk as $value) {
			if ($sqlSelectPk != "") {
				$sqlSelectPk .= " AND ";
			}
			$sqlSelectPk .= "".$value['campofisico']." = '".$value['valor']."'";
		}
		$sqlSelectPk = "SELECT 1 FROM ".$tableBase." WHERE ".$sqlSelectPk;
		$arrCamposPk = $this -> db -> QueryFetchArray($sqlSelectPk);
// 		echo $sqlSelectPk;
//  		echo $sqlSelectPk;
		if (count($arrCamposPk) > 0 ) {
			$error = 1;
			$msg = "No se pueden insertar registros duplicados. ".$sqlSelectPk;
		}else{
			$this -> db -> QuerySimple($sqlInsert);
		}
		// 		echo "<pre>"; print_r($arrInsert); echo "</pre>";
// 		echo $sqlInsert;
		return (object)array( 'error' => $error, 'msg' => $msg, 'html' => $salida);
	}
	function copy($obj) {
		$salida = "";
		$error = 0;
		global $arrLang;
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
		
// 		include_once( $this->basepath.'themes/default/lang/es.lang');
		
		$menu = $obj->modulo;
		$valor = explode("|~",$obj->id);
		
		$from = $this -> fn -> getModuleQueryFrom($menu);
		
		/*Armo el WHERE*/
		$sqlCampos = "SELECT campofisico
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
//  		echo $sqlCampos;
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
		$campoFisico = $arrCampos[0]['campofisico'];
		
		$where = "";
		for ($i = 0; $i < count($arrCampos); $i++) {
			if ($where != "") {
				$where .= " AND ";
			}
			$where .= " ".$arrCampos[$i]['campofisico']." = '".$valor[$i]."'";
		}
		$where = " WHERE ".$where;
		
		/*Obtengo los campos*/
		$sqlCampos = "SELECT fields.`idcampo`,campofisico,`nombreenform`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'ED'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
// 		echo "<pre>arrCampos"; print_r($arrCampos); echo "</pre>";
		$columnas = "";
		foreach ($arrCampos as $result) {
			if ($columnas != "") {
				$columnas .= ", ";
			}
			$columnas .= "".$result['campofisico']."";
		}

		$sql = "SELECT ".$columnas." ".$from." ".$where;
// 		echo $sql;
		$arrSelect = $this -> db -> QueryFetchArray($sql);
		
		$valoresPrevios = array();
// 		echo "<pre>arrSelect"; print_r($arrSelect); echo "</pre>";
		foreach ($arrCampos as $value) {
// 			echo "<pre>VALUE"; print_r($value); echo "</pre>";
			$valoresPrevios[$value['idcampo']]['valor'] = $arrSelect[0][$value['nombreenform']];
		}	
// 		echo "<pre>valoresPrevios"; print_r($arrLang); echo "</pre>";
		$salida = $this -> armarGrilla($obj,'ED',$valoresPrevios);
		
		$salida .= '		<br>
							<input type="button" onclick="saveNew(\'close\')" value="'.$arrLang['btnSaveClose'].'">
							<input type="button" onclick="saveNew(\'continue\')" value="'.$arrLang['btnSaveContinue'].'">
							</li>
						</ul>
					</form>
				</div>
		';
//  		echo $sql;
		return (object)array( 'error' => $error, 'msg' => $this -> date, 'html' => $salida);
	}
	function saveEdit($obj) {
		$salida = "";
		$error = 0;
		$menu = $obj->modulo;
		$valor = $obj->id;
		$msg = "";
		
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
		
		$GET = explode("&",base64_decode($obj->datos));
		$arrAsoc = Array();
		foreach ($GET as $value) {
			$ArrTemp = explode("=",$value);
			$arrAsoc[$ArrTemp[0]] = urldecode($ArrTemp[1]);
		}
		
		//Obtengo los campos PK
		$sqlCamposPK = "SELECT campofisico,`nombreenform`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
		// 		echo $sqlCampos;
		$arrCamposPK = $this -> db -> QueryFetchArray($sqlCamposPK);
		
		$sql = "SELECT tablebase FROM module where idmodulo = '".$obj->modulo."'";
		$result = $this-> db -> QueryFetchArray($sql);
		$tableBase = $result[0]['tablebase'];
		
		/*Armo el WHERE*/
		$sqlCampos = "SELECT campofisico
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'PK'
		ORDER BY modulefields.orden ASC";
		// 		echo $sqlCampos;
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
		$campoFisico = $arrCampos[0]['campofisico'];
		
		$sqlCampos = "SELECT campofisico,`nombreenform`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'ED'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
		
		//Armo el array para usar en el select de las pk
		$arrSelectPk = Array();
		foreach ($arrCamposPK as $value) {
			$arrSelectPk[$value['nombreenform']]['campofisico'] = $value['campofisico'];
			$arrSelectPk[$value['nombreenform']]['valor'] = $arrAsoc[$value['nombreenform']];
		}
		
		//Armo el array para usar en el insert
		$arrUpdate = Array();
		foreach ($arrCampos as $value) {
			$arrUpdate[$value['nombreenform']]['campofisico'] = $value['campofisico'];
			$arrUpdate[$value['nombreenform']]['valor'] = $arrAsoc[$value['nombreenform']];
		}
		//update TABLA set CAMPO 1 = VALOR 1 where CAMPOID = VALORID
		$sqlUpdateCampos = "";
		$sqlUpdate = "UPDATE `".$tableBase."` SET ";
		foreach ($arrUpdate as $value) {
			if ($sqlUpdateCampos != "") {
				$sqlUpdateCampos .= ", ";
			}
			$sqlUpdateCampos .= "".$value['campofisico']." = '".$value['valor']."'";
		}
		
		
		$sqlWherePk = "";
		foreach ($arrSelectPk as $value) {
			if ($sqlWherePk != "") {
				$sqlWherePk .= " AND ";
			}
			$sqlWherePk .= "".$value['campofisico']." = '".$value['valor']."'";
		}
// 		$sqlSelectPk = "SELECT 1 FROM `".$tableBase."` WHERE ".$sqlWherePk;
// 		$arrCamposPk = $this -> db -> QueryFetchArray($sqlSelectPk);
		
		$sqlUpdate .= $sqlUpdateCampos." WHERE ".$sqlWherePk;
		$this -> db -> QuerySimple($sqlUpdate);
		/*
		if (count($arrCamposPk) > 1 ) {
			$error = 1;
			$msg = "No se pueden duplicar registros";
		}else{
			$sqlUpdate .= $sqlUpdateCampos." WHERE ".$sqlWherePk;
			$this -> db -> QuerySimple($sqlUpdate);
		}
		*/
// 		echo "<pre>"; print_r($arrUpdate); echo "</pre>";
// 		echo $sqlUpdate;
		return (object)array( 'error' => $error, 'msg' => $msg, 'html' => $salida.$sqlUpdate);
	}
	function armarGrilla($obj, $scope, $valoresPrevios = array()){
		global $arrLangGeneric;
		global $arrConf;
		global $dbConn;
		$salida = '';
		include_once( $this->basepath.'configs/default.conf.php');
		
// 		include_once( $this->basepath.'themes/default/lang/es.lang');
		
		$menu = $obj->modulo;
		
		if (count($valoresPrevios) == 0) { 
			$valoresPreviosParametro = false; 
		}
		else{ 
			$valoresPreviosParametro = true; 
		}
		
		$sqlCampos = "SELECT fields.`idcampo`,`nombreenform`,`display`,`tipocampo`,`sql`,`mask`
		FROM fields
		INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
		WHERE idmodulo = '".$menu."'
		AND modulefields.scope = '".$scope."'
		ORDER BY modulefields.orden ASC";
		$arrCampos = $this -> db -> QueryFetchArray($sqlCampos);
		/*
		//Coloco los datepicker
		$dateFields = '';
		foreach ($arrCampos as $result) {
			if ($result['tipoCampo'] == 'date') {
				$dateFields .= '$( "#'.$result['idCampo'].'" ).datepicker();
';
			}
		}
		if ($dateFields != '') {
			$salida .= '
			<script>
  				$(function() {
					'.$dateFields.'
				});
 			</script>';
		}
		*/
		$salida .= '			
			<div id="data" style="display:none;">
				<form target="_top"  id="form_client_gen_'.$this -> date.'" name="form_client_gen_'.$this -> date.'"  method="POST" >
					<ul>';
		foreach ($arrCampos as $result) {
			if ($valoresPreviosParametro == false) {
				$valoresPrevios[$result['idcampo']]['valor'] = '';
			}
			$propiedadesInput = array('type' => $result['tipocampo'], 'value' => $valoresPrevios[$result['idcampo']]['valor'],'style' => "width:300px;", 'name' => $result['nombreenform'], 'id' => $result['nombreenform'], 'sql' => $result['sql'], 'placeholder' => $result['mask']);
			$salida .= '
						<li>
							<label>'.utf8_encode($result['display']).'</label>
							<div>
								'.$this -> html -> genericInput($propiedadesInput).'
							</div>
						</li>';
		}
		return $salida;
	}
	function commentGrid($obj) {
		$salida = "";
		$error = 0;
		global $arrLang;
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
		// 		include_once( $this->basepath.'themes/default/lang/es.lang');

		$sqlComm = "SELECT `comentario`,DATE_FORMAT(date,'%d/%m/%Y') as date FROM `comentarios` where `idMiembro` = '".$obj->id."' ORDER BY date DESC";
		// 		echo $sqlCampos;
		$arrComm = $this-> db -> QueryFetchArray($sqlComm);
	
		$salida .= '			
			<div id="data" style="display:none;">
				<ul>';
		foreach ($arrComm as $result) {
			$salida .= '
					<li type="circle">'.$result['date'].' - '.$result['comentario'].'</li>';
		}
		$salida .= '		
				</ul>
				<form target="_top"  id="form_client_gen_'.$this -> date.'" name="form_client_gen_'.$this -> date.'"  method="POST" >
					<br/>
					'.$this -> html->textarea("comentario","").'
					<br/>
					<input type="button" onclick="saveComment()" value="Guardar comentario">
				</form>
			</div>
		';
		//  		echo $sql;
		return (object)array( 'error' => $error, 'msg' => $this -> date, 'html' => $salida);
	}
	function saveComment($obj) {
		$salida = "";
		$error = 0;
		$msg = "";
	
		global $arrConf;
		global $dbConn;
		include_once( $this->basepath.'configs/default.conf.php');
	
		$GET = explode("&",base64_decode($obj->datos));
		$arrAsoc = Array();
		foreach ($GET as $value) {
			$ArrTemp = explode("=",$value);
			$arrAsoc[$ArrTemp[0]] = urldecode($ArrTemp[1]);
		}
	
	
		$sqlInsert = "INSERT INTO `comentarios` (idMiembro, comentario) VALUES (".$obj->id.", '".$arrAsoc['comentario']."');";
		$this -> db -> QuerySimple($sqlInsert);
	
// 		echo "<pre>"; print_r($arrAsoc); echo "</pre>";
		// 		echo $sqlUpdate;
		return (object)array( 'error' => $error, 'msg' => $msg, 'html' => $sqlInsert);
	}
}

?>