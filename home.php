<?php
session_start();
ob_start();

require_once 'dbconnect.php';

if(!isset($_SESSION['user'])) {
	header("Location: login.php");
	exit;
}
$userRow=mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE ID= '".$_SESSION['user']."'"));
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Welcome <?php echo $userRow['accountType'].' '.$userRow['email']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" href="myCSS.css" type="text/css" />
	</head>
	<body>
		<h1>Home Page</h1>
		<h2>Welcome <?php echo $userRow['accountType'].' '.$userRow['email']; ?> </h2>
		<a href="logout.php?logout">Log out</a>
	</body>
</html>