<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// load_language($_SESSION['userId']);
global $arrLang;
global $arrMenu;
global $langMenu;
// echo "<pre>"; print_r($_SESSION);echo "</pre>";
// echo "<pre>";
// echo print_r($arrLang,true);
// echo "</pre>";

?>
<script type="text/javascript"> 
	var modulo				= '<?php echo $_SESSION['menu'];?>'
	var userId	 			= '<?php echo $_SESSION['userId'];?>';
	var modulepath 			= '';
	var language 			= '<?php echo $_SESSION['lang'];?>';
	var themepath 			= '';
	var edit 				= '<?php echo $arrLang['edit'];?>';
	var del 				= '<?php echo $arrLang['del'];?>';
	var new_entry 			= '<?php echo $arrLang['new_entry'];?>';
	var copy_item			= '<?php echo $arrLang['copy_item'];?>';
	var delete_this_item 	= '<?php echo $arrLang['deleteThisItem'];?>';
	var select_item 		= '<?php echo $arrLang['SelectAnItem'];?>';
	var addnew 				= 'addnew';	
	var permission_add 		= 'yes';
	var permission_edit 	= 'yes';
	var permission_delete 	= 'yes';
</script>

<div id="modalbox" href="#data"></div>
<form id="foo" method="POST" action="?menu=<?php echo $arrLang['edit'];?>">
	<div id="contenido_form"></div>
</form>
<!-- Grid de datos-->
<div id="flex1"></div>
<input type = "hidden" id = "date" value = "">

