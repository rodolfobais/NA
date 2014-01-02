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
<body>
	<div id="page">
	    <div id="header">
	      <h1> <?php echo $_SESSION['_COMPANY'];?></h1>
	    </div>
	    <div id="content">
	
		     <form name="loginForm" id="loginForm" method="post" action="validaLogin.php" >
		        <table id="loginTable" class="minor" cellspacing="0">
			          <tbody>
			          <?php 
			          if (array_key_exists('err', $_GET)) {
			          	echo "
			          		<tr>
				              	<td colspan = 2 color = red>Usuario o password erròneos</td>
				            </tr>
			          	";
			          }
			          	
			          ?>
			          
				            <tr>
				              	<td class="colLeft">Usuario</td>
				              	<td class="colRight"><input type="text" name="input_user" value="" size="12"/></td>
				            </tr>
				            <tr>
				              	<td class="colLeft">Password</td>
				              	<td class="colRight"><input type="password" name="input_pass" value="" size="12"/></td>
				            </tr>
						</tbody>
		        </table>
				 	<input type="submit" name="submit_login" value="Ingresar"/>
		      </form>
	    </div>
  </div>
</body>
</html>
