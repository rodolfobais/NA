<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// echo "asadsadsadsads";
$_SESSION['basePath'] = '../';
$basepath = '';
// include_once( $basepath.'configs/default.conf.php');
// include_once( $basepath.'libs/kangDB.class.php');
require_once 'classes/dataBase.class.php';
$db = new dataBase('');
include_once( $basepath.'classes/funciones.class.php');
$fn = new funciones($basepath);
$menu = $fn -> getParamValFromURL("menu");
// $menu = "group_list";
$from = $fn -> getModuleQueryFrom($menu);
// echo $from;
// echo "<pre>"; print_r($_POST);echo "</pre>";
$qtype = '';	 // Search column
$query = '';	 // Search string

header("Content-type: text/x-json");
// dbConnect();
$page = isset($_POST['page']) ? $_POST['page'] : '';
$rp = isset($_POST['rp']) ? $_POST['rp'] : '';
//isset($_POST['page']) ? $_POST['page'] : '';
$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : '';
$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : '';

if( $_POST['query'] !=''){
	if ($_POST['busqExac'] == 'false') {
		$where = "WHERE ".$_POST['qtype']." LIKE '%".$_POST['query']."%'";
	}else{
		$where = "WHERE ".$_POST['qtype']." = '".$_POST['query']."'";
	}
} else {
	$where = "";
}
if( isset($_POST['letter_pressed']) !=''){
	$where = "WHERE ".$_POST['qtype']." LIKE '".$_POST['letter_pressed']."%' ";
}

// $where = "";
// conseguimos el total de registros
$sql = "SELECT count(1) ".$from." ".$where;
//   echo $sql;
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$total = $row[0];

// numero de pagina por defecto 1
$page = (int)(empty($_POST['page']) ? 1 : $_POST['page']);

// numero de registros a mostrar
$rp = (int)(empty($_POST['rp']) ? 10 : $_POST['rp']);

// desde donde comenzar
$start = (($page-1) * $rp);

// limite de registros a mostrar
$limit = "LIMIT $start, $rp";

// arrmamos un array con los datos a codificar
$arrDatos = array('page' => $page,'total' => $total);
/*
$sql = "SELECT company_email_subject FROM `config`";
$datos = $db -> QueryArray($sql);
$company_email_subject = $datos['company_email_subject'];
*/
$sqlPK = "SELECT campofisico
FROM fields
INNER JOIN modulefields
ON fields.idcampo = modulefields.idcampo
WHERE idmodulo = '".$menu."'
AND modulefields.scope = 'PK'
ORDER BY modulefields.orden ASC";
$arrPK = $db -> QueryFetchArray($sqlPK);
// echo $sqlPK."<br/>";
$PKs = "";
foreach ($arrPK as $result) {
	if ($PKs != "") {
		$PKs .= ", '|~' , ";
	}
	$PKs .= " ".$result['campofisico']."";
}


// consulta general
$sqlColumnas = "
	SELECT 
		CASE `tipocampo` 
			WHEN 'select' THEN `sqlmostardescrp` 
			ELSE `campofisico` 
		END AS campofisico,
		`tipocampo` as tipocampo
	FROM fields
	INNER JOIN modulefields
		ON fields.idcampo = modulefields.idcampo
	WHERE idmodulo = '".$menu."'
		AND modulefields.scope = 'GR'
	ORDER BY modulefields.orden ASC";
$arrColumnas = $db -> QueryFetchArray($sqlColumnas);

if (!$sortname) $sortname = $arrColumnas[0]['campofisico'];
if (!$sortorder) $sortorder = 'desc';

$sort = "ORDER BY $sortname $sortorder";


// echo $sqlColumnas;
$columnas = "";
foreach ($arrColumnas as $result) {
	if ($columnas != "") {
		$columnas .= ", ";
	}
	if ($result['tipocampo'] == 'date'){
		$columnas .= "DATE_FORMAT(".$result['campofisico'].",'%d/%m/%Y')";
	}else{
		$columnas .= "".$result['campofisico']."";
	}
}
$sql = "SELECT CONCAT(".$PKs."), ".$columnas." ".$from." ".$where." ".$sort." ".$limit;
//   echo $sql;
$ArrCols = $db -> QueryFetchArrayNum($sql);

foreach ($ArrCols as $CCols) {
	$id = $CCols[0];
	for ($i = 0; $i < count($CCols); $i++) {
		$CCols[$i] = utf8_encode($CCols[$i]);
	}
   	$arrDatos['rows'][] = array(
		'id' => $id,
		'cell' => $CCols
	);
}

//  dbClose();
// pasamos el array a formato json

$salida = json_encode($arrDatos);
// $salida = utf8_encode($salida);
echo $salida;
?>
