<?php
/**
 * PCMAjaxRequest
 *
 * Archivo encargado de funcionar como disparador de pedidos Ajax, el mismo funciona como nexo entre
 * el método a llamar de la clase en cuestion y el php que realiza el pedido
 *
 * @author Rodolfo Bais <rodolfo@electroturno.com>
 */
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once("classes/JSON.class.php");
    require_once("classes/Ajax.class.php");
    $ajax = new Ajax();
    echo $ajax->getRequest($_POST['json']);
?>
