<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
// $page = isset($_GET['menu']) ? $_GET['menu'] : '';

if (!isset($_GET['menu'])) {
	header('Location: index.php?menu=menu_list');
}

// echo "<pre>".print_r($_GET,true)."</pre>";



// die;
if ( !isset($_SESSION['User_NA']) ) {
	header('Location: login.php');
}
$_SESSION['menu'] = $_GET['menu'];
$_SESSION['lang'] = 'es';
$_SESSION['basePath'] = '';

require_once 'configs/default.conf.php';
require_once 'libs/misc.lib.php';
// require_once 'lang/loadLangVar.php';
require_once 'classes/loadLangVar.class.php';
$lang = new loadLangVar('');
$lang ->load();
global $arrLang;
/*
var modulepath = '<?php echo $arrConf['modulePath'];?>';
var language = '<?php echo $arrConf['language'];?>';
var themepath =  '<?php echo $arrConf['modulePath'];?>';
*/
//cargar headers html
load_hmlt_headers();
?>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<!-- 
<script type="text/javascript"> 
var userId = <?php echo $_SESSION['User_NA']; ?>;
var modulepath = '';
var language = '';
var themepath =  '';
</script>
 -->
<?php

global $arrMenu;

// echo "<pre>".print_r($arrLang,true)."</pre>";
$arrMenu = menuFiltered();
//cargar el menu ya filtrado
// echo $arrConf['moduleName'];
$arrConf['moduleName'] = isset($_GET['menu']) ? $_GET['menu'] : 'menu_list';
if (isset( $arrConf['moduleName'])){
	showMenu($arrConf['moduleName']);
}else{ 
	echo '<h3> hops.. invalid menu</h3> click <a href="?logout=yes&reason=falied">here</a> to reload ';
}
?>
<td valign="top">
<?php
//array_key_exists('myModule', $arrConf)
if (!array_key_exists('myModule', $arrConf)) {
// 	echo "pepe argento";
	$arrConf['myModule'] = "generic_index.php";
}
// echo "<pre>"; print_r(getdate());echo "</pre>";
// echo "<pre>"; print_r($arrLangModule);echo "</pre>";
require( $arrConf['myModule'] );
?>
</td>
</tr>
</table>

<div id="contenido" ></div>

</body>
</html>
<?php
 
ini_set('session.gc_maxlifetime', 4*60*60); // 3 hours
//mis includes
global $arrConf;

global $arrConf;
//current user

//cargo el idioma
// load_language( $_SESSION['userId'] );


//  cargo el id del grupo en arrconf
getGroupId ();

//cargar modulo y menus
load_module();
?>
