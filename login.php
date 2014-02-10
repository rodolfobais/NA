<?php
session_start();
require_once 'configs/default.conf.php';
/*
if ( isset($_SESSION['submit_login']) ) {
	header('Location: validaLogin.php');
}
*/
// echo "<pre>"; print_r($_SESSION);echo "</pre>";
// echo "<pre>"; print_r($_REQUEST); echo "</pre>";
?>
<head>
<title>Nuevo Amanecer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		body,table,tr{
			text-align:center;
			align:center;
		}
		td img {
			display: block;
		}
		#page {
			border:0px solid;
			height:100%;
			margin: 0px auto;
		}
	</style>
<!--Fireworks CS5 Dreamweaver CS5 target.  Created Tue Jan 07 00:09:31 GMT-0300 (ART) 2014-->
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body>
	<div id="page">
	    <div id="header">
	      <h1><img src = "images/logo3.jpg" width = 500></h1>
	    </div>
	    <div id="content">
	
		     <form name="loginForm" id="loginForm" method="post" action="validaLogin.php" >
		          <?php 
		          if (array_key_exists('err', $_GET)) {
		          	echo "
			              	Usuario o password erroneos
		          	";
		          }
		          	
		          ?>
						          
	            <p>Usuario: <input type="text" name="input_user" value="" size="12"/></p>
				<p>Password: <input type="password" name="input_pass" value="" size="12"/></p>
			 	<input type="submit" name="submit_login" value="Ingresar"/>
		      </form>
	    </div>
  </div>
</body>
</html>
