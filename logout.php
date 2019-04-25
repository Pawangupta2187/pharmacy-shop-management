<?php
	session_start();
	session_unset();
	session_destroy();//session destroy when you click logout
	header("location:index.php");
?>