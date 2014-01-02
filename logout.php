<?php
//si hizo logout destruyo la session
if(isset($_REQUEST['logout']) && $_REQUEST['logout']=='yes') {
	$uid = $_SESSION['userId'];

	if( isset($_REQUEST['reason']) && $uid > 0 ){
		$reason=$_REQUEST['reason'];
		$sql="INSERT INTO `login_logout` (id_user,in_out,timestamp,reason) VALUES ('$uid','out',NOW(),'$reason'); ";
		kangQuerySimple($sql);
		$sql="UPDATE `user` SET status='0' WHERE id='$uid' ";
		kangQuerySimple($sql);

	}
	elseif( $uid > 0 ){
		 
		$sql="INSERT INTO `login_logout` (id_user,in_out,timestamp,reason) VALUES ('$uid','out',NOW(),'SystemLogout'); ";
		kangQuerySimple($sql);
		$sql="UPDATE `user` SET status='0' WHERE id='$uid' ";
		kangQuerySimple($sql);
	}
	session_destroy();
	session_start();
	$_SESSION['userId'] = 'none'; //esto en en caso de que el usuario este dentro de un menu y desloge sin esto saltaria que la variable $_SESSION['userId']  del index.php ppal  no esta nombrada

}

?>