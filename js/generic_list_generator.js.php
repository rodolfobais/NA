<?php 
Header("content-type: application/x-javascript");


// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$basepath = '../';
$_SESSION['basePath'] = $basepath;
// echo "<pre>"; print_r($_SESSION);echo "</pre>";
// require_once '../classes/loadLangVar.class.php';
require_once '../classes/dataBase.class.php';
$db = new dataBase('../');
// $lang = new loadLangVar('../');
// $lang ->load();
// global $arrLang;


// include_once( $basepath.'configs/default.conf.php');
// include_once( $basepath.'libs/kangDB.class.php');
$_SESSION['basePath'] = '';
include_once( $basepath.'classes/funciones.class.php');
$fn = new funciones('../');
// include_once( $basepath.'themes/default/lang/es.lang');

$menu = $fn -> getParamValFromURL("menu");
// $menu = "group_list";//getParamValFromURL("menu");
$from = $fn -> getModuleQueryFrom($menu);
// echo "adsasdads".$menu;

//Consulto las propiedades del modulo
$sqlProp = "SELECT `dblClickFn` FROM `module` WHERE IdModulo = '".$menu."'";
$arrProp = $db -> QueryFetchArray($sqlProp);
$dblClickFn = $arrProp[0]['dblClickFn'];
if ($dblClickFn == 'true') {
	$dblClickFn = ",dblclickFunction: dobleClick";
}

//Consulto los campos del modulo
$sqlFilas = "SELECT `display`, Fields.`idCampo`, `width`, `sortable`, `hide`,`align`
FROM Fields
INNER JOIN moduleFields
ON Fields.idCampo = moduleFields.idCampo
WHERE IdModulo = '".$menu."'
AND moduleFields.Scope = 'GR'
ORDER BY moduleFields.Orden ASC";
$arrFilas = $db -> QueryFetchArray($sqlFilas);
// echo $sqlColumnas;
// echo "<pre>"; print_r($arrColumnas);echo "</pre>";
// die;
$filas = "{display: 'id', name : 'id', width : 100, sortable : true, hide: true,  align: 'left'}";
$searchitems = "";
foreach ($arrFilas as $result) {
	$result['display'] = utf8_encode($result['display']);
	if ($filas != "") {
		$filas .= ", ";
	}
	if ($searchitems != "") {
		$searchitems .= ", ";
		$isdefault = "";
	}else{
// 		$isdefault = ", isdefault: true";
				$isdefault = "";
	}
// 	$filas .= $result['campoFisico'];
	$filas .= "{display: '".$result['display']."', name : '".$result['idCampo']."', width : ".$result['width'].", sortable : ".$result['sortable'].", hide: false ,  align: '".$result['align']."'}";
	//{display: 'Name', name : 'name', isdefault: true}
	if ($result['hide'] != 'true') {
		$searchitems .= "{display: '".$result['display']."', name : '".$result['idCampo']."'".$isdefault."}";
	}
}
//  echo $filas;
//var modulepath 			= '".$arrConf['themePath']."';

/*
var modulo				= '".$menu."'
	var userId	 			= '".$_SESSION['userId']."';
	var modulepath 			= '';
	var language 			= 'es';
	var themepath 			= '';
	var edit 				= '".$arrLang['edit']."';
	var del 				= '".$arrLang['del']."';
	var new_entry 			= '".$arrLang['new_entry']."';
	var copy_item			= '".$arrLang['copy_item']."';
	var delete_this_item 	= '".$arrLang['deleteThisItem']."';
	var select_item 		= '".$arrLang['SelectAnItem']."';
	var addnew 				= 'addnew';	
	var permission_add 		= 'yes';
	var permission_edit 	= 'yes';
	var permission_delete 	= 'yes';
*/

$js = "
$(document).ready(function() {
	
	
	$('#flex1').flexigrid({
		url:  modulepath + 'generic_getlist.php',
		dataType: 'json',
		colModel : [
			".$filas."
		],
		buttons : [
		  {name: new_entry, bclass: 'add',    onpress : doCommand},
		  {name: copy_item, bclass: 'copy',   onpress : doCommand},
		  {name: edit,      bclass: 'edit',   onpress : doCommand},
		  {name: del,       bclass: 'delete', onpress : doCommand},
		  {separator: true}
		  /*,
		  {name: 'A', onpress: filtro},
		  {name: 'B', onpress: filtro},
		  {name: 'C', onpress: filtro},
		  {name: 'D', onpress: filtro},
		  {name: 'E', onpress: filtro},
		  {name: 'F', onpress: filtro},
		  {name: 'G', onpress: filtro},
		  {name: 'H', onpress: filtro},
		  {name: 'I', onpress: filtro},
		  {name: 'J', onpress: filtro},
		  {name: 'K', onpress: filtro},
		  {name: 'L', onpress: filtro},
		  {name: 'M', onpress: filtro},
		  {name: 'N', onpress: filtro},
		  {name: 'O', onpress: filtro},
		  {name: 'P', onpress: filtro},
		  {name: 'Q', onpress: filtro},
		  {name: 'R', onpress: filtro},
		  {name: 'S', onpress: filtro},
		  {name: 'T', onpress: filtro},
		  {name: 'U', onpress: filtro},
		  {name: 'V', onpress: filtro},
		  {name: 'W', onpress: filtro},
		  {name: 'X', onpress: filtro},
		  {name: 'Y', onpress: filtro},
		  {name: 'Z', onpress: filtro},
		  {separator: true}
		  */
		],
	// indicamos que columnas se pueden usar para filtrar las busquedas
		searchitems : [
		  ".$searchitems."
		],
		singleSelect:true,
		//sortname: 'id',
		//sortorder: 'asc',
		usepager: true,
		useRp: true,
		rp: 15,
		showTableToggleBtn: true,
		width: 'auto',
		height: 'auto',
		showTableToggleBtn:false
		".$dblClickFn."
	});//end flex1
	
	if(permission_add !='yes'){ 
		$('.flexigrid div.fbutton .add').hide(); 
	} 
	if(permission_edit !='yes'){ 
		$('.flexigrid div.fbutton .edit').hide();	 
	} 
	if(permission_delete !='yes'){ 
		$('.flexigrid div.fbutton .delete').hide();	 
	} 
	
	function dobleClick(grid){
		var item = $('.trSelected td:first-child div').text();
		var contenido = '';//$('.trSelected').text();
		if(item.length>0){
			var json = {clase: 'generic_abm' , metodo: 'commentGrid', carpeta : 'libs/',modulo: modulo, id : item};
			$.ajax({
				data: {json: $.toJSON(json) },
				type: 'POST',
				dataType: 'json',
				url: 'AjaxRequest.php',
				success: function(data){
					if (data.error == 0){
    	           		var response=$(data.html); //mis datos de ajax
                		var formulario = response.find('#data'); //filtro lo que busco 
                		$('#contenido_form').empty();
			   			$('#contenido_form').html(data.html);// lo meto en el div 
               			$('#modalbox').trigger('click'); //abro el div con fancybox
	  					$('#date').val(data.msg);
					}else{
						alert(data.msg);
				   	}
					proces = 0;
				}
			});//end .ajax function
			return false; // avoid to execute the actual submit of the form.
		}
	}	  		
  	
	// funcion para los botones de filtro
	function filtro(com){
	   jQuery('#flex1').flexOptions({
	      // indicamos los parametros del filtro
	      newp:1, params:[
	         {name:'letter_pressed', value: com},
	         {name:'qtype',value:$('select[name=qtype]').val()}
	      ]
	   });
	   // recargamos la grid
	   jQuery('#flex1').flexReload();
	}
	function filtro(com){ 
		jQuery('#flex1').flexOptions({newp:1, params:[{name:'letter_pressed', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
		jQuery('#flex1').flexReload(); 
	}
	function doCommand(com,grid){
// 		alert('grid: '+grid);
//   		alert('com:'+com+'asd');
		if (com == del){
			var item = $('.trSelected td:first-child div').text() ;
			var name = $('.trSelected td:nth-child(2) div').text();
			if(item.length>0){
				if(confirm( delete_this_item + ' \"' + name + '\" ?')){
					var json = {clase: 'generic_abm' , metodo: 'delete', carpeta : 'libs/',modulo: modulo, id : item};
					$.ajax({
						data: {json: $.toJSON(json) },
						type: 'POST',
						dataType: 'json',
						url: 'AjaxRequest.php',
						success: function(data){
							if (data.error == 0){
								//alert('success!');
								$('#flex1').flexReload();
							}else{
								alert(data.msg);
						   	}
							proces = 0;
						}
				   });
				}
			}else{
				alert(select_item);
				return false;
			} 
		}//end delete
		//nuevo registro
	    else if (com == new_entry){
			var json = {clase: 'generic_abm' , metodo: 'new_entry', carpeta : 'libs/',modulo: modulo};
			$.ajax({
				data: {json: $.toJSON(json) },
				type: 'POST',
				dataType: 'json',
				url: 'AjaxRequest.php',
				success: function(data){
					if (data.error == 0){
						var response=$(data.html); //mis datos de ajax
		                var formulario = response.find('#data'); //filtro lo que busco 
		                $('#contenido_form').html('');
					   	$('#contenido_form').html(data.html);// lo meto en el div 
 		               	$('#modalbox').trigger('click'); //abro el div con fancybox
		  				$('#date').val(data.msg);
					}else{
						alert(data.msg);
				   	}
					proces = 0;
				}
		   	});//end .ajax function
			return false; // avoid to execute the actual submit of the form.   
		}//end nuevo registro
	    else if (com == edit){
			var item = $('.trSelected td:first-child div').text();
			var contenido = '';//$('.trSelected').text();
			$('.trSelected td').each( function() {
				if (contenido != '') {
					contenido += '|~';
				}
				//contenido += $(this).find('div').text();//.attr(\'id\');
			    contenido += $(this).find('div').text();
			    //contenido += ',,';
			});
			//alert(contenido);
			if(item.length>0){
				var json = {clase: 'generic_abm' , metodo: 'edit', carpeta : 'libs/',modulo: modulo, id : item};
				$.ajax({
					data: {json: $.toJSON(json) },
					type: 'POST',
					dataType: 'json',
					url: 'AjaxRequest.php',
					success: function(data){
						if (data.error == 0){
	    	           		var response=$(data.html); //mis datos de ajax
	                		var formulario = response.find('#data'); //filtro lo que busco 
	                		$('#contenido_form').empty();
				   			$('#contenido_form').html(data.html);// lo meto en el div 
	               			$('#modalbox').trigger('click'); //abro el div con fancybox
		  					$('#date').val(data.msg);
						}else{
							alert(data.msg);
					   	}
						proces = 0;
					}
			   	});//end .ajax function
    			return false; // avoid to execute the actual submit of the form.
           	}//end lenght|edit
			else{
				alert(select_item);
		   	}
		} //end if edit  
		else if (com == copy_item){
			var item = $('.trSelected td:first-child div').text() ;
			if(item.length>0){
				var json = {clase: 'generic_abm' , metodo: 'copy', carpeta : 'libs/',modulo: modulo, id : item};
				$.ajax({
					data: {json: $.toJSON(json) },
					type: 'POST',
					dataType: 'json',
					url: 'AjaxRequest.php',
					success: function(data){
						if (data.error == 0){
	    	           		var response=$(data.html); //mis datos de ajax
	                		var formulario = response.find('#data'); //filtro lo que busco 
	                		$('#contenido_form').html('');
				   			$('#contenido_form').html(data.html);// lo meto en el div 
	               			$('#modalbox').trigger('click'); //abro el div con fancybox
		  					$('#date').val(data.msg);
						}else{
							alert(data.msg);
					   	}
						proces = 0;
					}
			   	});//end .ajax function
    			return false; // avoid to execute the actual submit of the form.
           	}//end lenght|edit
            else{
				alert(select_item);
		   	}
		} //end if copy
	} //end doCommand function
});//end function ready jQ
function saveNew(action){ 
  	var date = $('#date').val();
	var datosFrm = $.base64.encode($('#form_client_gen_'+date).serialize());
	var json = {clase: 'generic_abm' , metodo: 'save_new', carpeta : 'libs/',modulo: '".$menu."', datos : datosFrm};
	$.ajax({
		data: {json: $.toJSON(json) },
		type: 'POST',
		dataType: 'json',
		url: 'AjaxRequest.php',
		success: function(data){
			if (data.error == 0){
				if (action == 'close'){
					$.fancybox.close();
				}else{
					document.getElementById('form_client_gen_'+date).reset();
				}
    	       	$('#flex1').flexReload();
				return;        
			}else{
				alert(data.msg);
		   	}
			proces = 0;
		}
   	});//end .ajax function
}
function saveEdit(action){ 
	var item = $('.trSelected td:first-child div').text() ;
	var date = $('#date').val();
	var datosFrm = $.base64.encode($('#form_client_gen_'+date).serialize());
	var json = {clase: 'generic_abm' , metodo: 'saveEdit', carpeta : 'libs/',modulo: '".$menu."', datos : datosFrm, id : item};
	$.ajax({
		data: {json: $.toJSON(json) },
		type: 'POST',
		dataType: 'json',
		url: 'AjaxRequest.php',
		success: function(data){
			if (data.error == 0){
				if (action == 'close'){
					$.fancybox.close();
				}else{
					document.getElementById('form_client_gen_'+date).reset();
				}
               	$('#flex1').flexReload();
				return;        
			}else{
				alert(data.msg);
		   	}
			proces = 0;
		}
   	});//end .ajax function
}
function saveComment(){
	var item = $('.trSelected td:first-child div').text() ;
	var date = $('#date').val();
	var datosFrm = $.base64.encode($('#form_client_gen_'+date).serialize());
	var json = {clase: 'generic_abm' , metodo: 'saveComment', carpeta : 'libs/',modulo: '".$menu."', datos : datosFrm, id : item};
	$.ajax({
		data: {json: $.toJSON(json) },
		type: 'POST',
		dataType: 'json',
		url: 'AjaxRequest.php',
		success: function(data){
			if (data.error == 0){
				$.fancybox.close();
               	$('#flex1').flexReload();
				return;        
			}else{
				alert(data.msg);
		   	}
			proces = 0;
		}
   	});//end .ajax function
}
";

echo $js;

?>