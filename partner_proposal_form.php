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
	$name = $userRow['name']; // htmlspecialchars($_POST['name']);
	$email = $userRow['email']; // htmlspecialchars($_POST['email']);
	$department = htmlspecialchars($_POST['department']);
	$date = htmlspecialchars($_POST['date']);
	$time = htmlspecialchars($_POST['time']);
	$location = htmlspecialchars($_POST['location']);
	$classYear = htmlspecialchars($_POST['classYear']);
	$curricularExperience = htmlspecialchars($_POST['curricularExperience']);
	$description = htmlspecialchars($_POST['description']);
	$learningObjectives = htmlspecialchars($_POST['learningObjectives']);
	$assessed = htmlspecialchars($_POST['assessed']);
	$SLLsupport = htmlspecialchars($_POST['SLLsupport']);
	$additional = htmlspecialchars($_POST['additional']);

	//form validation, makes sure nothiing is empty. Add more later

	//if no error run sql code, small_program_proposals is the table name, need new table for each form type
	if(!$error) {
		$sql = "INSERT INTO partner_proposals (name, email, department, `date`, `time`, location, classYear, curricularExperience, description, learningObjectives, assessed, SLLsupport, additional) VALUES ('$name','$email','$department','$date','$time','$location','$classYear','$curricularExperience','$description','$learningObjectives','$assessed','$SLLsupport','$additional')";
		if(!mysql_query($sql)) {	//if the sql is bad it prints an error, else it just runs the script
			die('Error: ' . mysql_error());
		}
		header("Location: index.php");	//moves user back to dashboard
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
			<h2>Campus Partners Program Proposal</h2>
			<!-- Name values are selectors for posting to php -->
			<div class="ui raised very padded text container segment">
				<form class="form ui" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<!-- <label>Your Name</label>
					<input type="text" name="name"/><br>
					<label>RPI Email</label>
					<input type="text" name="email"/><br> -->
					<label>Department</label>
					<input type="text" name="department"/><br>
					<label>Program Date</label>
					<input type="date" name="date"/><br>
					<label>Program Time</label>
					<input type="time" name="time"/><br><br>

					<label>Program Location</label><br>
					<input type="radio" name="location" value="EC-4" checked> EC 4 (2 rooms holding 45 people in each, plus outdoor space)<br>
					<input type="radio" name="location" value="Bray"> Bray Classroom (max 30 people)<br>
					<input type="radio" name="location" value="Cary"> Cary (max 30 people)<br>
					<input type="radio" name="location" value="DCC"> DCC Classroom (large programs)<br>
					<input type="radio" name="location" value="Accademy Hall"> Academy Hall Auditorium (max 75 people)<br><br>

					<label>Class Year Program is Designed For</label>
					<select name="classYear">
						<option value="first">First Years</option>
						<option value="second">Second Years</option>
						<option value="third">Third Years</option>
						<option value="fourth">Fourth Years</option>
						<option value="mix">Mix of years (describe below)</option>
					</select> <br>

					<br><label>What section of the CLASS curricular experience will this program support and enhance?</label>
					<select name="curricularExperience">
						<option value="MCGP">Multicultural Sophistication and Global Perspective</option>
						<option value="HESA">Health and Emotional Self-Awareness</option>
						<option value="PIR">Problem Identification and Resolution</option>
						<option value="CCE">Campus Community Engagement</option>
						<option value="IA">Intelectual Agility</option>
					</select><br><br>

					<label>Program Description</label><br>
					<textarea name="description" rows="4" cols="50"></textarea><br>
					<label>Two to Four Learning Objectives</label><br>
					<textarea name="learningObjectives" rows="4" cols="50"></textarea><br>
					<label>How will this program be assesed?</label><br>
					<textarea name="assessed" rows="4" cols="50"></textarea><br>
					<lable>Additional Additional Student Living and Learning support needed. Please be specific</lable><br>
					<textarea name="SLLsupport" rows="4" cols="50"></textarea><br>
					<lable>Additional Comments/Information</lable><br>
					<textarea name="additional" rows="4" cols="50"></textarea><br>
					<input class="ui primary button submitbutton" type="submit" value="Submit" name="submit">
				</form>
			</div>
		</div>
	</body>
</html>