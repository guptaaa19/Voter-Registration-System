<?php
	session_start();
	session_destroy();
	header("Location: dashboard.php");
	exit(); // Make sure to exit after header redirection to stop further script execution
?>
