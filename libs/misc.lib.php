<?php 
require './classes/dataBase.class.php';

$db = new dataBase('');
function load_language( $userid )
{
	$ruta_base='';
    include_once $ruta_base."configs/default.conf.php";
    global $arrConf;
	include_once $ruta_base."libs/kangDB.class.php";
    include $ruta_base."configs/default.conf.php";
    include_once $ruta_base."configs/languages.conf.php";
    $lang="";
    //conectarse a la base de settings para obtener el idioma actual
	//echo $userid;
	$arrConf['userId'] = $userid;
	if ( !empty($userid) && $userid != 'none') {
	
		$sql = kangQueryArray('SELECT lang FROM `user` WHERE id ='.$userid);
		$lang = $sql['lang'];
		
		if ( isset($lang) ) {
			$arrConf['language'] = $lang;
		}
		
		/*
		foreach( glob('../configs/*.php') as $class_filename )   {
	     require_once($class_filename);
		}
		*/
		//cargo idiomas 
	    $directorio = dir($arrConf['themePath'].'/modules');
	    
	    $incluirIndexLang =  $arrConf['themePath'].'lang/'.$arrConf['language'].'.lang' ;
		$incluirIndexLangMenu = $arrConf['themePath'].'lang/'.$arrConf['language'].'_menu.lang' ;
		$incluirMenuLang = $arrConf['themePath'].'modules/'.$_REQUEST['menu'].'/lang/'.$arrConf['language'].'.lang' ;
		
		
		
// 		echo "incluirIndexLangMenu: ".$incluirIndexLangMenu.'<br>';
// 		echo "incluirMenuLang: ".$incluirMenuLang.'<br>';
// 		echo "incluirIndexLang: ".$incluirIndexLang;
		
		
	    include_once($incluirIndexLang);
	    include_once($incluirIndexLangMenu);
	    if (@file_exists($incluirMenuLang)) {
	    	include_once($incluirMenuLang);
		}    
	    /*
		while ($carpeta = $directorio->read()) {
		
			if ($carpeta != '.' && $carpeta != '..'  ) {
				$incluirIndexLang =  $arrConf['themePath'].'lang/'.$arrConf['language'].'.lang' ;
				$incluirIndexLangMenu = $arrConf['themePath'].'lang/'.$arrConf['language'].'_menu.lang' ;
				$incluirLang =  $arrConf['themePath'].'modules/'.$carpeta.'/lang/'.$arrConf['language'].'.lang' ;
			    echo $incluirLang.'<br>';
				//cargo el lang del index ppal
				if( @file_exists($incluirIndexLang) ) {
					include_once($incluirIndexLang);
				}
				if( @file_exists($incluirIndexLangMenu) ) {
					include_once($incluirIndexLangMenu);
				}
				
				//cargo lang de modulos
				if( @file_exists($incluirLang) ) {
				   	include_once( $incluirLang );
					//echo $incluirLang.'<br>';							
				} 
			}	
			
		}
		$directorio->close();
		*/
		$result = true;
	}
}

function authenticateUser ($login,$password){
	global $arrConf;
	
	$sql = kangQueryArray("SELECT `user`.id, `user`.surname, `user`.login, `user`.md5_password, `user`.status,`section`.id as id_section
							FROM `user`
							JOIN `section` ON  `user`.id_section = `section`.id
							WHERE login = '$login' AND md5_password = '$password' AND active = '1'");
							
	$query_login = $sql['login'];
	$query_password = $sql['md5_password'];
	$query_userId = $sql['id'];
	$query_user_status = $sql['status'];
	$query_surname = $sql['surname'];
    $_SESSION['physical_id_section'] = $sql['id_section'];


	if ( $login == $query_login && $password == $query_password ) {
	//echo "Loading";
	
		if($query_user_status == 'e') {
			//si el usuario no se deslogeo anteriormente avisarle
			$arrConf['error'] = "Still logged in another Computer";
			
			}
		else{
		
			$_SESSION['userId'] = $query_userId ;
			$arrConf['userId'] = $query_userId ;
			$_SESSION['user_surname'] = $query_surname;
			$result = true;
			 //para chat
			$_SESSION['username'] = $query_login;
			$_SESSION['user_id'] = $query_userId;     
					
			$sql="INSERT INTO `login_logout` (id_user,in_out,timestamp,reason) VALUES ('$query_userId','in',NOW(),'login'); ";
			kangQuerySimple($sql);
			$sql="UPDATE `user` SET status='1' WHERE id='$query_userId' ";
			kangQuerySimple($sql);
			$sql = kangQueryArray("SELECT `section`.  FROM `user` WHERE login = '$login' AND md5_password = '$password' AND active = '1'");
			
			
		}
	
   
    }
	else {
	$result = false;
	$arrConf['error'] = '<div style="color:red;">wrong username or password </div>';
	echo "failed";
	}
	
	
	return $result;
}

function load_module() 
{
	global $arrConf;
	
	//si esta el usuario autenticado cargar el modulo
	//if ( isset($arrConf['moduleName']) &&  isset( $_SESSION['userId'] ) && isset( $_SESSION['user']) && isset ( $_SESSION['pass'] )  ) {
	if ( isset($_SESSION['User_NA']) ) {	
		$myIndex = 'index.php' ;
		$genericIndex = 'generic_index.php' ;
		$myModule = 'fakeDir/index.php';
		
// 		$arrConf['modulePath'] = $arrConf['modulePath'].$arrConf['moduleName'].'/';
		
// 		echo "genericIndex:".$genericIndex.file_exists($myModule)."<br/>";
// 		echo "myModule:".$myModule."<br/>";
// 		echo "myIndex:".$myIndex."<br/>";
		include_once($myIndex);
		if( @file_exists($myModule) ) {
			$arrConf['myModule'] = $myModule;
			include_once($myIndex);  //el index.php base del theme
// 			echo "TRUE<br/>";
		}else{
			$arrConf['myModule'] = $genericIndex;
// 			echo '<div style="color:red">Error</div>';
//  			echo "FALSE<br/>";
//  			echo "<pre>"; print_r(getdate());echo "</pre>";
		}
	}else{
		//el usuario no esta authenticado cargo el login de nuevo
	
		$myIndex = $arrConf['themePath'].'login.php';		
		include_once($myIndex);
	}
}//end function

 //##########################################################################################################################################################################

// * incluir todos los subfiles comunes y los del modulo en el que estamos trabajando
function include_subfiles() {
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	global $db;
	global $arrConf;
	/*
	 * Primero cargo los includes genéricos
	 */
	$sql="SELECT path, type , orden FROM includes WHERE idmodulo = 'GENERIC'";
// 	echo $sql;
	//$query = $db -> QuerySimple(
	$datos =  $db -> QueryFetchArray($sql);
	foreach ($datos AS $inc) {
		if (is_array($inc)) {
			if (!file_exists($inc['path'])){
				echo "<br/>No existe el archivo: ".$inc['path'];
			}
			switch ($inc['type']) {
				case 'css' :
					?>
						<link rel="stylesheet" href="<?php echo $inc['path']; ?>" >
					<?php
				break;
				case 'js' :
					?>
					<script  type="text/javascript" src="<?php echo $inc['path']; ?>"></script>
					<?php			
				break;
				case 'php' :
					include_once($inc['path']);
// 					echo $class_filename.'<br>';					
				break;
			}
		}
	}

	/*
	 * Ahora cargo los puntuales para el módulo
	 */
	$sql="SELECT path, type , orden FROM includes WHERE idModulo = '".$_GET['menu']."'";
	$datos =  $db -> QueryFetchArray($sql);
// 	echo $sql;
	
// 	echo "<pre>";
// 	print_r($datos);
// 	echo "</pre>";
	
	//echo "asdadsadsx:".$_GET['menu'];
	//aca pongo en un array que tipo de carpetas y que tipos de archivo para cada carpeta voy a incluir
// 	$load_file_ext = Array ('configs'=>'*.php', 'libs'=>'*.php', 'css'=>'*.css', 'js'=>'*.js'); 
	//ciclo para cargar los archivos adjuntos de la carpeta LIBS/JS ORIGINAL BASE   JQUERY
	
// 	echo "<pre>";
// 	print_r($datos);
// 	echo "</pre>";
	
	foreach ($datos AS $inc) {
		if (is_array($inc)) {
			if (!file_exists($inc['path'])){
				echo "<br/>No existe el archivo: ".$inc['path'];
			}
			switch ($inc['type']) {
				case 'css' :
					?>
					<link rel="stylesheet" href="<?php echo $inc['path']; ?>" >
					<?php
				break;
				case 'js' :
					?>
					<script  type="text/javascript" src="<?php echo $inc['path']; ?>"></script>
					<?php			
				break;
				case 'php' :
					include_once($inc['path']);
					//echo $class_filename.'<br>';					
				break;
			}
		}
	}
	/*
	foreach ($load_file_ext AS $folder => $file) {
		$includeFile = 'libs/js/'.$file ;
		
		echo "<pre>";
		print_r(glob($includeFile));
		echo "</pre>";
		
		echo "DELETE FROM `Includes` WHERE `IdModulo` = '".$_GET['menu']."';";
		echo "<br/>";
		$ordenamiento = 1;
		foreach( glob($includeFile) as $class_filename )   {
			$extensionFile = getFileExtension($class_filename);
			switch ($extensionFile) {

			case 'css' :
				?>
				<link rel="stylesheet" href="<?php echo $class_filename; ?>" >
				<?php
				echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','css',".$ordenamiento.");";
				$ordenamiento ++;
				echo "<br/>";
			break;
			case 'js' :
				?>
				<script  type="text/javascript" src="<?php echo $class_filename; ?>"></script>
				<?php			
				echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','js',".$ordenamiento.");";
				$ordenamiento ++;
				echo "<br/>";
			break;
			case 'php' :
				include_once($class_filename);
				//echo $class_filename.'<br>';
				echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','php',".$ordenamiento.");";
				$ordenamiento ++;
				echo "<br/>";
			}
		}
	}	
	*/
	//ciclo para cargar los archivos adjuntos de la carpeta BASICA del THEME debajo de la carpeta modules
	/*
	foreach ($load_file_ext AS $folder => $file) {
		$includeFile = $arrConf['themePath'].$folder.'/'.$file ;
		
		echo "<pre>";
		print_r(glob($includeFile));
		echo "</pre>";
		
		foreach( glob($includeFile) as $class_filename )   {			
			$extensionFile = getFileExtension($class_filename);
			
			switch ($extensionFile) {
				case 'css' :
					?>
					<link rel="stylesheet" href="<?php echo $class_filename; ?>" >		
					<?php
					echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','css',".$ordenamiento.");";
					$ordenamiento ++;
					echo "<br/>";
				break;
				case 'js' :
					?>
					<script type="text/javascript" src="<?php echo $class_filename; ?>"></script>
					<?php
					echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','js',".$ordenamiento.");";
					$ordenamiento ++;
					echo "<br/>";
				break;
				case 'php' :
					include_once($class_filename);
					//echo $class_filename.'<br>';
					echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','php',".$ordenamiento.");";
					$ordenamiento ++;
					echo "<br/>";
			}
		}
	}//end include de carpeta basica del THEME
	*/
	if ( isset($_SESSION['userId']) ) { //si el usuario esta loggeado
	
	$arrConf['userStatus'] = 1;
			
			if( isset($_GET['menu']) ){ //si apreto un boton 
			
			
				$is_it_parent = ifmenu_parent_skip_next( $_GET['menu'] );
					
					if( $is_it_parent == false ){  //si el modulo no es parent 0 lo cargo tal cual lo pasa
					$arrConf['moduleName'] = $_GET['menu'];
					}
					else{
					$arrConf['moduleName'] = $is_it_parent;	
					
					}
			
			//echo 	$is_it_parent;				   
			}
			else{ // sino apreto el boton
			
					$sql="SELECT   menu.id FROM user
						  LEFT JOIN `membership` ON  user.id = membership.id_user 
						  LEFT JOIN `group` ON membership.id_group = group.id
						  LEFT JOIN `group_permission` ON group.id = group_permission.id_group
						  LEFT JOIN `resource` ON group_permission.id_resource = resource.id
						  LEFT JOIN `menu` ON resource.name = menu.id  
						  WHERE user.id = '$_SESSION[userId]'
						  AND group_permission.id_action = '1' AND menu.type != 0 LIMIT 1";
					
					$datos =  $db -> QueryFetchArray($sql);
					$arrConf['moduleName'] = $datos['id'];		
					
				}
				
		/*
		//hago el ciclo para cargar los archivos del la carpeta dentro de los MODULOS
		foreach ($load_file_ext AS $folder => $file) {
			
			$includeFile = $arrConf['themePath'].'modules/'.$arrConf['moduleName'].'/'.$folder.'/'.$file ;
		//echo $includeFile.'<br>';
			
			foreach( glob($includeFile) as $class_filename )   {
				$extensionFile = getFileExtension($class_filename);
				switch ($extensionFile) {
					case 'css' :
						?>
						<link rel="stylesheet" href="<?php echo $class_filename; ?>" >		
						<?php
						echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','css',".$ordenamiento.");";
						$ordenamiento ++;
						echo "<br/>";
					break;
					case 'js' :
						?>
						<script type="text/javascript" src="<?php echo $class_filename; ?>"></script>
						<?php	
						echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','js',".$ordenamiento.");";
						$ordenamiento ++;
						echo "<br/>";
					break;
					case 'php' :
					//echo $class_filename.'<br>';	
						include_once($class_filename);
						echo "INSERT INTO `Includes`(`IdModulo`, `Path`, `Type`, `Orden`) VALUES ('".$_GET['menu']."','".$class_filename."','php',".$ordenamiento.");";
						$ordenamiento ++;
						echo "<br/>";
				}
			}		
		}
		*/
	} //end if usuario en session

}//end function  include subfiles
//##########################################################################################################################################################################
function load_hmlt_headers()
{
	global $arrConf;
	
?>
<!DOCTYPE html > 
<html >
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">


<title><?php echo $_SESSION['_TITLE']; ?></title>
<link rel="icon"  href="images/favicon.ico" />
<?php 
	include_subfiles();
	
?>
<script type="text/javascript" src="own_id.inc.php"></script>
<script type="text/javascript"> 
var base_url =  '';
var physical_id_section = '';

</script>

</head>

<?php
}

function quitarEspacios($texto) 
{
	$texto = trim($texto) ;
	$texto = htmlspecialchars($texto) ;
	# --> Elimina espacios que no pueden ser borrados por trim()
	$texto = str_replace(chr(160),'',$texto) ;
	return $texto ;
}

function cargar_menu()
{
	global $db;
   //leer el contenido de la tabla menu y devolver un arreglo con la estructura
    $menu = array ();
//     $query = kangQuerySimple("SELECT m1.*, (SELECT count(*) FROM menu m2 WHERE m2.IdParent=m1.id) AS HasChild FROM	menu m1 ORDER  BY id_org ASC;");
    $query = $db -> QuerySimple("SELECT m1.*, (SELECT count(*) FROM menu m2 WHERE m2.IdParent=m1.id) AS HasChild FROM	menu m1 ORDER  BY id_org ASC;");
	//armo un array de todos los botones con su informacion 
	while ( $value = mysql_fetch_array($query)  ) {
		$arrMenu[$value['1']] = Array("id" => $value['1'], "IdParent" => $value['2'], "Link" =>$value['3'], "Name" => $value['4'], "Type" =>$value['5'], "HasChild" =>$value['6']);
	}
	//print_r($arrMenu);
	return $arrMenu;	
}

function menuFiltered () 
{
	global $db;
	//cargo el menu ppal
	$arrMenu = cargar_menu() ;
// 	echo "<pre>";
// 	print_r($arrMenu);
// 	echo "</pre>";
	//- Primero me barro todos los submenus
	$arrSubmenu=array();
	
	$queryString = "
		SELECT   menu.id, menu.link,menu.* FROM user
	   	LEFT JOIN `membership` ON  user.id = membership.id_user 
	   	LEFT JOIN `group` ON membership.id_group = group.id
	   	LEFT JOIN `group_permission` ON group.id = group_permission.id_group
   		LEFT JOIN `menu` ON group_permission.id_menu = menu.id_org  
		WHERE user.login = '$_SESSION[User_NA]';";
// 	echo $queryString;
// 	$queryString = "SELECT   menu.id, menu.link FROM menu";
// 	echo "<br/>".$queryString."<br/>";
	$query = $db -> QuerySimple($queryString);
	
	while ( $value = mysql_fetch_array($query)  ) {
		$menuPermissionArray[] = $value['id'];
	}
	// * aca saco el array de los menu que el usuario tiene permiso	
	$arrFiltered = @array_diff($menuPermissionArray,$arrMenu);
// 	echo "<pre>FILTERED"; print_r($arrFiltered);echo "</pre>";
// 	echo "<pre>MENU"; print_r($arrMenu); echo "</pre>";

	
	foreach($arrMenu as $idMenu=>$arrMenuItem) {
		if(!empty($arrMenuItem['IdParent'])) {
			//aca borro del array de menus todos aquellos a los que el usuario no tiene persmisos
			foreach ($arrFiltered AS $k => $v) {
				if ( $idMenu == $v) {
					$arrSubmenu[$idMenu] = $arrMenuItem;
					$arrMenuFiltered[$idMenu] = $arrMenuItem;
				}
			}				
		}
		/*else{
			echo "<br/>ASD:".$arrMenuItem['id']."<br/>";
		}*/
	}	
	
	//- Ahora me barro el menu principal
	foreach($arrMenu as $idMenu=>$arrMenuItem) {
		if(empty($arrMenuItem['IdParent'])) {
			
			foreach($arrSubmenu as $idSubMenu=>$arrSubMenuItem) {
				if($arrSubMenuItem['IdParent']==$idMenu) {
					$arrMenuFiltered[$idMenu] = $arrMenuItem;
				}
			}
		}
	}
// 	echo "<pre>FILTERED"; print_r($arrMenuFiltered);echo "</pre>";

// 		echo "<pre>";
// 	print_r($arrMenuFiltered['module_list']);
// 	echo "</pre>";	
	return($arrMenuFiltered);
}


function getFileExtension($fileName)
{
   $parts=explode(".",$fileName);
   return $parts[count($parts)-1];
}


function Navigation($arrMenu)
{
        // El defaultManu deberia ser el primer submenu
        foreach($arrMenu as $idMenu=>$arrMenuItem) {
            if(empty($arrMenuItem['IdParent'])) {
                $defaultMenu = $idMenu;
                echo $defaultMenu;
				break;
            }
        }
        
}

	
//Navigation($arrMenu);  //funciona
function getArrParentIds($idMenuSelected)  
{
        $idMenuActual = getIdParentMenu($idMenuSelected);
        $limite=10;
        $arrIdParentMenus=array();
        for($i=1; $i<=$limite; $i++) { // Le pongo un limite de 10 iteraciones. No creo que hayan mas de 10 menus padres
            if($idMenuActual=="") {
                break;
            } else {
                $arrIdParentMenus[]=$idMenuActual;
                $idMenuActual=getIdParentMenu($idMenuActual);    
            }
            if($i==$limite) {
                // Si llego hasta aqui, probablemente no encontre el menu raiz
                return false; // Hmm... no estoy seguro de esto
            }
        }

       $arrResult=array_reverse($arrIdParentMenus);
	   //print_r($arrResult);
       return $arrResult; 
}
	//getArrParentIds('network_parameters'); //funciona

function getArrChildrenIds($idMenuSelected)
{
        $limite=10;
        $arrResult = array();
        $idSubMenu=getIdFirstSubMenu($idMenuSelected);
        for($i=1; $i<=$limite; $i++) {
            if($idSubMenu==false) {
                break;  
            } else {
                $arrResult[]=$idSubMenu;
                $idSubMenu=getIdFirstSubMenu($idSubMenu);
            }
        }
		//print_r( print_r($arrResult));
        return $arrResult;
 }
//getArrChildrenIds('network_parameters'); //funciona
  
  // Esta funcion muestra el menu que se debe presentar si el menu idMenuSelected
    // ha sido cliqueado
function showMenu($idMenuSelected)
{
		global $arrMenu;
		global $arrConf;
		global $arrLang;
        $arrIds=array();
//         echo "<pre>".print_r($arrLang,true)."</pre>";
	
		$is_it_parent = ifmenu_parent_skip_next( $_SESSION['menu'] );
// 		echo 	"asd".$idMenuSelected."asdasd";	
		if( $is_it_parent == false ){  //si el modulo no es parent 0 lo cargo tal cual lo pasa
			$arrConf['moduleName'] = $_SESSION['menu'];
		}
		else{
			$menuId = $is_it_parent;		
		}

        // Valido el menu que se paso como argumento
        if(!empty($idMenuSelected) ) {
            // Debo encontrar entonces sus menus padres y sus menus hijos
            // Encuentro todos los menus padres
            $arrIdParentMenus=getArrParentIds($idMenuSelected);
            if(is_array($arrIdParentMenus)) {
                $arrIds=$arrIdParentMenus;
            }
            // Le sumo el menu actual
            $arrIds[]= $idMenuSelected;
            // Encuentro los menus hijos. 
            $arrIdChildrenMenus=getArrChildrenIds($idMenuSelected);
            if(is_array($arrIdChildrenMenus)) {
                foreach($arrIdChildrenMenus as $elemento) {
                    $arrIds[]=$elemento;
                }
            }
            //print_r($arrIds); 
            // En este punto $arrIds deberia contener los Ids activos de cada menu para los n niveles
            // Como por ahora manejamos hasta 3 niveles unicamente voy a mapear los 3 primeros elementos
            $currMainMenu=NULL;
            $currSubMenu =NULL;
            $currSubMenu2=NULL;
            if(count($arrIds)==1){
                $currMainMenu=$arrIds[0];
            }
            if(count($arrIds)==2){
                $currMainMenu=$arrIds[0];
                $currSubMenu =$arrIds[1];
            }
            if(count($arrIds)==3){
                $currMainMenu=$arrIds[0];
                $currSubMenu =$arrIds[1];
                $currSubMenu2=$arrIds[2];
            }
        } else {
            // Is not a valid menu
            $currMainMenu = $defaultMenu;
            $currSubMenu  = $getIdFirstSubMenu($currMainMenu);
            $currSubMenu2 = $getIdFirstSubMenu($currSubMenu);
        }

        $currMainMenu = $currMainMenu;
		//echo $currMainMenu.'<br>';
        $currSubMenu  = $currSubMenu;
		//echo $currSubMenu.'<br>';
        $currSubMenu2 = $currSubMenu2;
		//echo $currSubMenu2.'<br>';

        // Get the main menu
        $arrMainMenu = getArrSubMenu("");
		//print_r($arrMainMenu);
        //$this->smarty->assign("arrMainMenu", $arrMainMenu);

        // Get the submenu
        $arrSubMenu = getArrSubMenu($currMainMenu); 
		//print_r($arrSubMenu);
        //$this->smarty->assign("arrSubMenu", $arrSubMenu);

        // Get the 3th level menu
        $arrSubMenu2 = getArrSubMenu($currSubMenu); 
// 		echo "<pre>arrSubMenu2";print_r($arrSubMenu2);echo "</pre>";
// 		echo "<pre>arrMenuTotal";print_r($arrMenuTotal);echo "</pre>";
 
	   // imprimo la cabeza
	echo '<table cellspacing=0 cellpadding=0 width="100%" border=0>';
    echo '<tr>';
    echo '<td>';
	echo '<table height="76" cellspacing="0" cellpadding="0" border="0" width="100%">';
	echo '<tr>';
    echo '<td widt="380" height="70" class="menulogo"><img border="0" src="images/logo2.jpg" width="255"></td>';

	//aca imprimo los menu PRINCIPALES
	foreach ( $arrMenu as $menuId => $value ) {

		if ( $value['Type'] == '0' ) {
		echo '<td class="headlink" valign="bottom"><table height="30" cellspacing="0" cellpadding="2" border="0"><tr>';
		//echo   $menuId.'<br>'; //esto me da el id del menu
		//echo $_SESSION['langMenu'][$menuId].'<br>';  //esto me da el nombre del modulo ya en el idioma del usuario
		//echo $value['id']; //esto me da directo el id 

			if ( $menuId == $currMainMenu ) {	
			 
			//boton main estado apretado
			//echo '<td class="headlink" valign="bottom"><table height="30" cellspacing="0" cellpadding="2" border="0"><tr>';
			
			//Hasta estar seguro lo quito
// 			echo '<td class="menutabletaboff_left" nowrap valign="top"><img src="'.$arrConf['themePath'].'images/1x1.gif"></td>';
			
			echo '<td class="menutabletaboff" nowrap="" title="" ><a href="?menu='.ifmenu_parent_skip_next($menuId).'"  class="menutableoff">'.$arrLang[$menuId].'</a></td>';
			
			//Hasta estar seguro lo quito
// 			echo '<td  class="menutabletaboff_right" nowrap="" valign="top"><img src="'.$arrConf['themePath'].'images/1x1.gif"></td>';
			
			echo '</tr></table></td>';
			}
			elseif ( $value['Type'] == '0' && $value['Type'] !== $currMainMenu) {

			//boton main estado normal
			
			//Hasta estar seguro lo quito
// 			echo '<td class="menutabletabon_left" nowrap valign="top"><img src="'.$arrConf['themePath'].'images/1x1.gif"></td>';
			echo '<td class="menutabletabon" nowrap="" title="" ><a href="?menu='.ifmenu_parent_skip_next($menuId).'"  class="menutableon ">'.$arrLang[$menuId].'</a></td>';
// 			echo '<td  class="menutabletabon_right" nowrap="" valign="top"><img src="'.$arrConf['themePath'].'images/1x1.gif"></td>';
			echo '</tr></table></td>';

			//echo   $menuId.','; 
			//echo $_SESSION['langMenu'][$menuId].',';
			}   
		}   
	}
?>

	<td class="menuaftertab" align="right" width="40%"><a href=""><?php echo $_SESSION['_VERSION']; ?></a></td>
	<td class="menuaftertab" align="right" width="20%"><div class="logout_button" ><?php echo $_SESSION['User_NA'].' Logout'; ?></div></td>
	</tr>
	<tr>
	</table>
	</td></tr>
	<td class="menudescription">
	<table cellspacing="0" cellpadding="2" width="100%">
	<tr>
	<td>
	<table cellspacing="2" cellpadding="4" border="0">
	<tr>
<?php
// echo "<pre>arrSubMenu";print_r($arrSubMenu);echo "</pre>";
	//aca imprimo los menu SECUNDARIOS
	foreach ( $arrSubMenu as $menuId => $value ) {    

	//if ( $value['id'] == '1'
		if ( $value['Type'] == '1' &&  $menuId == $currSubMenu ) {	
		//boton apretado
		echo '<td class="botonon" valign="center">';
		echo '<a class="submenu_on" href="?menu='.$menuId.'">'.$arrLang[$menuId].'</a></td>';		
		}
		else {
		// boton normal
		echo '<td class="botonoff" valign="center">';
		echo '<a class="submenu_off" href="?menu='.$menuId.'">'.$arrLang[$menuId].'</a></td>';
		}	
	}	
?>
</tr></table>
</td>
</tr>
</table>
 </td>
</tr>
</table>

<table  cellspacing="0" cellpadding="2" height="100%" width="100%">
<tr>
<td  id="menuLeft"align="left" width="200"  height="100%" valign="top">

<table cellspacing="0" align="left" cellpadding="0" width="100%" >

<?php 

	if (is_array($arrSubMenu2)) {
	//aca imprimo los menu TERCIARIOS
		foreach ( $arrSubMenu2 as $menuId => $value ) { 
// 			echo "<pre>arrSubMenu2";print_r($_SESSION['langMenu']);echo "</pre>";
// 			echo "type:aaa".$value['Type']."aaa<br/>";
// 			echo "menuId:aaa".$menuId."aaa<br/>";
// 			echo "currSubMenu2:aaa".$currSubMenu2."aaa<br/>";
			if ( $value['Type'] == '2' &&  $menuId == $currSubMenu2 ) {	
// 			if ( 1 == 1 ) {
// 			echo "adsasdadsadsadsssssssssssssssssssssssssss".$_SESSION['langMenu'][$menuId];
				echo '<tr><td width=200 class="menuiz_botonon" ><a href=?menu='.$menuId.'>';
				echo $arrLang[$menuId].'</a><br>';
				echo '</tr>';
			}else{
				echo '<tr><td width=200 class="menuiz_botonoff" ><a href=?menu='.$menuId.'>';
				echo $arrLang[$menuId].'</a><br>';
				echo '</tr>';
			}
		}
	}
echo '</table></td>';
	   
}


function getIdParentMenu($id)
{
	global $arrMenu;
        // verificar que $arrMenu[$id] exista
        return $arrMenu[$id]['IdParent'];
}
function isValidMenu($id)  
{
        return $id;
}

 function getArrSubMenu($idParent)
{
        global $arrMenu;
        $arrSubMenu = array();
 
        $sysinfo    = array();
        
        foreach($arrMenu as $id => $element) {
            if($element['IdParent']==$idParent) {
                if( $id != "sys"){
                  $arrSubMenu[$id] = $element;
                }
                else $sysinfo[$id]=$element; // lo encontro a sysinfo, esto se hace para en el caso del grupo admin
                                             // salga primero para este user el menu sysinfo.
            }
        }
//         echo "<pre>";
//         print_r($arrSubMenu);
//         echo "</pre>";
        if(count($arrSubMenu)<=0) return false;

        // lo encontro a sysinfo, esto se hace para en el caso del grupo admin
        // salga primero para este user el menu sysinfo.
        $arrSubMenu = array_merge($sysinfo,$arrSubMenu);
        //print_r($arrSubMenu);
        return $arrSubMenu;
 }

 function getIdFirstSubMenu($idParent)
{
        $arrSubMenu=getArrSubMenu($idParent);
        if($arrSubMenu==false) return false;
        list($id, $value) = each($arrSubMenu);
        return $id;
}

function getGroupId ()
{
	global $arrConf, $db;
	$sql = $db -> QueryArray(" SELECT id_group  FROM `membership` WHERE  id_group = '".$_SESSION['userId']."' ");
	$arrConf['groupId'] = $sql['id_group'];
}

function ifmenu_parent_skip_next($menu_name){ //si es parent devuelve el nombre del child sino false
	global $arrConf, $db;
	$sql = " SELECT type, (SELECT id FROM `menu` WHERE idparent ='$menu_name'  LIMIT 1 ) as children FROM `menu` WHERE  id = '$menu_name' ";
	$dato = $db -> QueryArray($sql);
// 	        echo "<pre>";
// 	        print_r($dato);
// 	        echo "</pre>";
	$menu_type = $dato['type'];
	$name_children = $dato['children'];
	
	if( $menu_type == '1' ){ 
		$children = false;
		}
	else{
		$children = $name_children;
		}

	return $children;
	}
	

?>
