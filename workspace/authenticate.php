<?php 
session_start();
if(!(isset($_SESSION['login'])) || ($_SESSION['login'] != substr(md5('appletree'), 0, 20))) {
	session_destroy();
	header('Location:/workspace/login.php');
	die();
}
if(substr(basename($_SERVER['PHP_SELF']), 0, -4) == "workspace/workspace") {
	if($_SESSION['usertype'] != md5('editor')) {
		header('Location:/workspace/login.php');
		session_destroy();
		die();
	}
}
?>