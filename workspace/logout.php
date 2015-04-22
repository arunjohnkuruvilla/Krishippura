<?php 
	session_start();
	session_destroy();
	header("Location: /workspace/login.php");
?>