<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'configs/default.conf.php'; 
require_once 'classes/security.class.php';

$login = $_POST['input_user'];
$password = $_POST['input_pass'];
// echo "<pre>"; print_r($_POST);echo "</pre>";
$sc = new security();
if ($sc -> authenticateUser ($login,$password)){
	$_SESSION['User_NA'] = $login;
	//echo "<pre>"; print_r($_SESSION);echo "</pre>";
	//die;
	header('Location: index.php');
}else{
	header('Location: login.php?err=1');
}



?>