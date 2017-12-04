<?php
session_start();
ob_start();

require_once 'dbconnect.php';

if(!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}
$id = $_POST['id'];
if($_POST['formtype'] == 'small') {
	if(isset($_POST['reject'])) {
		$sql="UPDATE small_program_proposals SET status='Rejected' WHERE ID='$id'";
	}
	if(isset($_POST['accept'])) {
		$sql="UPDATE small_program_proposals SET status='Accepted' WHERE ID='$id' ";
	}
}
if($_POST['formtype'] == 'big') {
	if(isset($_POST['reject'])) {
		$sql="UPDATE big_program_proposals SET status='Rejected' WHERE ID='$id'";
	}
	if(isset($_POST['accept'])) {
		$sql="UPDATE big_program_proposals SET status='Accepted' WHERE ID='$id' ";
	}
}

if(!mysql_query($sql)) {
	die('Error: ' . mysql_error());
}
header("Location: dashboard.php");

?>