<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: landing.php");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: home.php");
	}
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	header("Location: landing.php");
	exit;