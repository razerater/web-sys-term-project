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
	$name = htmlspecialchars($_POST['name']);
	// $email = $_POST['email'];
	$building = htmlspecialchars($_POST['building']);
	$date = htmlspecialchars($_POST['date']);
	// $time = $_POST['time'];
	// $location = $_POST['location'];
	$title = htmlspecialchars($_POST['title']);
	$description = htmlspecialchars($_POST['description']);
	// $learningObjective = $_POST['learningObjective'];
	$pre1 = htmlspecialchars($_POST['pre1']);
	$pre2 = htmlspecialchars($_POST['pre2']);
	$pre3 = htmlspecialchars($_POST['pre3']);
	$post1 = htmlspecialchars($_POST['post1']);
	$post2 = htmlspecialchars($_POST['post2']);
	$post3 = htmlspecialchars($_POST['post3']);
	// $budget = $_POST['budget'];
	//Arrays cannot be put in SQL tables, so they must be converted into a string, 
	//which can later be decoded back to an array in php using the unserialize() function
	// $itemNames = serialize($_POST['itemName']);
	// $itemCosts = serialize($_POST['itemCost']);

	//form validation, makes sure nothiing is empty. Add more later
	if(empty($name) || empty($building) || empty($date) || empty($title) || empty($description) || empty($pre1) || empty($pre2) || empty($pre3) || empty($post1) || empty($post2) || empty($post3)) {
		$error = true;
		$errorText = 'must fill all required fields';
	}
	//if no error run sql code, small_program_proposals is the table name, need new table for each form type
	if(!$error) {
		$sql = "INSERT INTO program_assessments (name, email, building, `date`, title, description, pre1, pre2, pre3, post1, post2, post3) VALUES ('$name','$email','$building','$date','$title','$description','$pre1','$pre2','$pre3','$post1','$post2','$post3')";
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
	    <script src="resources/static/semantic.min.js"></script>
	    <link rel="stylesheet" href="resources/static/semantic.min.css">
	    <link rel="stylesheet" href="resources/static/style.css">
	    <link rel="stylesheet" href="resources/static/font-awesome.css">
	</head>
	<body>
	  <div class="singleform">
		<h2>Staff Post Program Assessment</h2>
  		<div class="ui raised very padded text container segment">
		
		<!-- Name values are selectors for posting to php -->
		<form class="ui form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<label>Name</label>
			<input type="text" name="name"/><br>
			<label>Building</label>
			<select id="building" name="building">
				<option value="barton">Barton Hall</option>
				<option value="barh">BARH</option>
				<option value="bray">Bray Hall</option>
				<option value="cary">Cary Hall</option>
				<option value="hall">Hall Hall</option>
				<option value="nugent">Nugent Hall</option>
				<option value="crockett">Crockett Hall</option>
				<option value="nason">Nason Hall</option>
				<option value="davison">Davison Hall</option>
				<option value="sharp">Sharp Hall</option>
				<option value="warren">Warren Hall</option>
				<option value="quadI">Quad I</option>
				<option value="quadII">Quad II</option>
				<option value="blitman">Blitman Residence Commons</option>
				<option value="north">North Hall</option>
				<option value="ecomplex">E-Complex</option>
				<option value="rahpA">RAHPs A</option>
				<option value="rahpB">RAHPs B</option>
				<option value="bryckwyck">Bryckwyck</option>
			</select><br>
			<label>Program Date</label>
			<input type="date" name="date"/><br>
			<!-- <label>Program Time</label>
			<input type="time" name="time"/><br>
			<label>Program Location</label>
			<input type="text" name="location"/><br> -->
			<label>Title</label>
			<input type="text" name="title"/><br>
			<label>Attendance</label><br>
			<input type="text" name="attendance"/><br>
			<!-- <label>Learning objective (one)</label>
			<input type="text" name="learningObjective"/><br> -->
			<label>Assessment Questions:</label><br>
			<input type="text" name="q1"/><br>
			<input type="text" name="q2"/><br>
			<input type="text" name="q3"/><br>
			<label>Percent correct answers for each question for pre assessment:</label><br>
			<input type="text" name="pre1"/><br>
			<input type="text" name="pre2"/><br>
			<input type="text" name="pre3"/><br>
			<label>Percent correct answers for each question for post assessment:</label><br>
			<input type="text" name="post1"/><br>
			<input type="text" name="post2"/><br>
			<input type="text" name="post3"/><br>
			<!-- <label>Budget Propsal</label>
			<input type="number" name="budget"/><br> -->
			<!-- The [] at the end of itemName and itemCost signify an array type.  -->
			<!-- <div id="costList">
			<label>Item Costs</label>
			<input type="text" name="itemName[]"/>
			<input type="number" name="itemCost[]"/>
			<button type="button" id="addItem">Add item</button><br>
			</div> -->
			<label>Additional comments/information:</label>
			<input type="text" name="comments"/><br>
			<input class="ui primary button submitbutton" type="submit" value="Submit" name="submit">
		</form>
	  </div>
	</div>
	</body>
</html>
