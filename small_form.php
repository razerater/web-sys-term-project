<?php
session_start();
ob_start();
require_once 'dbconnect.php';

//uncomment after linking to dashboard, makes sure the user is still logged in
// if(!isset($_SESSION['user'])) {
// 	header("Location: login.php");
// 	exit;
// }

$error = false;
$errorText = '';

//set post data to php variables
//will be more useful later when we validate user entry
if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$building = $_POST['building'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$location = $_POST['location'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$learningObjective = $_POST['learningObjective'];
	$q1 = $_POST['q1'];
	$q2 = $_POST['q2'];
	$q3 = $_POST['q3'];
	$budget = $_POST['budget'];
	//Arrays cannot be put in SQL tables, so they must be converted into a string, 
	//which can later be decoded back to an array in php using the unserialize() function
	$itemNames = serialize($_POST['itemName']);
	$itemCosts = serialize($_POST['itemCost']);

	//form validation, makes sure nothiing is empty. Add more later
	if(empty($name) || empty($email) || empty($building) || empty($date) || empty($time) || empty($location) || empty($title) || empty($description) || empty($learningObjective) || empty($q1) || empty($q2) || empty($q3) || empty($budget) || empty($itemNames) || empty($itemCosts)) {
		$error = true;
		$errorText = 'must fill all required fields';
	}
	//if no error run sql code, small_program_proposals is the table name, need new table for each form type
	if(!$error) {
		$sql = "INSERT INTO small_program_proposals (name, email, building, `date`, `time`, location, title, description, learningObjective, q1, q2, q3, budget, itemNames, itemCosts) VALUES ('$name','$email','$building','$date','$time','$location','$title','$description','$learningObjective','$q1','$q2','$q3','$budget','$itemNames','$itemCosts')";
		if(!mysql_query($sql)) {	//if the sql is bad it prints an error, else it just runs the script
			die('Error: ' . mysql_error());
		}
		header("Location: dashboard.php");	//moves user back to dashboard
	} else {
		echo($errorText);
	}
}
//Side note: PHP echo is html code. It can be used to write html using php variables, creating dynamic pages similar to ajax from lab4
?>

<html>
	<head>
		<script type="text/javascript" src="resources/jquery-3.2.1.js"></script>
	</head>
	<body>
		<h2>Small Community Program Proposal</h2>
		<!-- Name values are selectors for posting to php -->
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<label>Name</label>
			<input type="text" name="name"/><br>
			<label>RPI Email</label>
			<input type="text" name="email"/><br>
			<label>Building</label>
			<input type="text" name="building"/><br>
			<label>Program Date</label>
			<input type="date" name="date"/><br>
			<label>Program Time</label>
			<input type="time" name="time"/><br>
			<label>Program Location</label>
			<input type="text" name="location"/><br>
			<label>Title</label>
			<input type="text" name="title"/><br>
			<label>Description</label><br>
			<textarea name="description" rows="5" cols="50"></textarea><br>
			<label>Learning objective (one)</label>
			<input type="text" name="learningObjective"/><br>
			<label>Pre Assessment Questions</label><br>
			<input type="text" name="q1"/><br>
			<input type="text" name="q2"/><br>
			<input type="text" name="q3"/><br>
			<label>Budget Propsal</label>
			<input type="number" name="budget"/><br>
			<!-- The [] at the end of itemName and itemCost signify an array type.  -->
			<div id="costList">
			<label>Item Costs</label>
			<input type="text" name="itemName[]"/>
			<input type="number" name="itemCost[]"/>
			<button type="button" id="addItem">Add item</button><br>
			</div>
			<input type="submit" value="Submit" name="submit">
		</form>
	</body>
</html>
<script>
$(document).ready(function(){
	var i=1;
	$('#addItem').click(function(){
		i++;
		var html = '<input type="text" name="itemName[]"/>';
		html += '$<input type="number" name="itemCost[]"/> <br>';
		$('#costList').append(html);
	});
});
</script>