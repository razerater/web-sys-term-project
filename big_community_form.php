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
	$building = $_POST['building'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$location = $_POST['location'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$learningOutcomes = $_POST['learningOutcomes'];
	$partnerCollabs = $_POST['partnerCollabs'];
	$budget = $_POST['budget'];
	//Arrays cannot be put in SQL tables, so they must be converted into a string, 
	//which can later be decoded back to an array in php using the unserialize() function
	$itemNames = serialize($_POST['itemName']);
	$itemCosts = serialize($_POST['itemCost']);
	$additional = $_POST['additional'];

	//form validation, makes sure nothiing is empty. Add more later

	//if no error run sql code, small_program_proposals is the table name, need new table for each form type
	if(!$error) {
		$sql = "INSERT INTO big_program_proposals (name, building, `date`, `time`, location, title, description, learningOutcomes, budget, itemNames, itemCosts, additional) VALUES ('$name','$building','$date','$time','$location','$title','$description','$learningOutcomes','$budget','$itemNames','$itemCosts', '$additional')";
		if(!mysql_query($sql)) {	//if the sql is bad it prints an error, else it just runs the script
			die('Error: ' . mysql_error());
		}
		header("Location: dashboard.php");	//moves user back to dashboard
	}
}
//Side note: PHP echo is html code. It can be used to write html using php variables, creating dynamic pages similar to ajax from lab4

?>

<html>
	<head>
	    <script type="text/javascript" src="resources/jquery-3.2.1.js"></script>
	    <script src="resources/static/semantic.min.js"></script>
	    <link rel="stylesheet" href="resources/static/semantic.min.css">
	    <link rel="stylesheet" href="resources/static/style.css">
	    <link rel="stylesheet" href="resources/static/font-awesome.css">
	</head>
	<body>
		<div class="singleform">
			<h2>Big Community Program Proposal</h2>
	  		<div class="ui raised very padded text container segment">
		
		<!-- Name values are selectors for posting to php -->
		<form class="ui form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<label>Name</label>
			<input type="text" name="name"/><br>
			<label>Building</label>
			<input type="text" name="building"/><br>
			<label>Program Date</label>
			<input type="date" name="date"/><br>
			<label>Program Time</label>
			<input type="time" name="time"/><br>
			<label>Program Location</label>
			<input type="text" name="location"/><br>
			<label>Program Title</label>
			<input type="text" name="title"/><br>
			<label>Description</label><br>
			<textarea name="description" rows="5" cols="50"></textarea><br>
			<label>Learning Outcomes</label><br>
			<textarea name="learningOutcomes" rows="4" cols="50"></textarea><br>
			<label>Partner Collaborations</label><br>
			<textarea name="partnerCollabs" rows="3" cols="50"></textarea><br>
			<label>Budget Propsal</label>
			<input type="number" name="budget"/><br>
			<!-- The [] at the end of itemName and itemCost signify an array type.  -->
			<div id="costList">
			<label>Item Costs</label>
			<input type="text" name="itemName[]"/>
			<input type="number" name="itemCost[]"/>
			<button type="button" id="addItem">Add item</button><br>
			</div>
			<lable>Additional Comments/Information</lable><br>
			<textarea name="additional" rows="4" cols="50"></textarea><br>
			<input class="ui primary button submitbutton" type="submit" value="Submit" name="submit">
			<?php echo $errorText; ?>
		</form>
	  </div>
	</div>
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
