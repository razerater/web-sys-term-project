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
	$major = htmlspecialchars($_POST['major']);
	$staff = htmlspecialchars($_POST['staff']);
	$building = htmlspecialchars($_POST['building']);
	$date = htmlspecialchars($_POST['date']);
	$title = htmlspecialchars($_POST['title']);
	$category = htmlspecialchars($_POST['category']);
	$learned = htmlspecialchars($_POST['learned']);
	$enjoyment = htmlspecialchars($_POST['enjoyment']);
	$comments = htmlspecialchars($_POST['comments']);

	//form validation, makes sure nothiing is empty. Add more later
	if(empty($major) || empty($staff) || empty($building) || empty($date) || empty($title) || empty($category) || empty($learned) || empty($enjoyment)) {
		$error = true;
		$errorText = 'must fill all required fields';
	}
	//if no error run sql code, small_program_proposals is the table name, need new table for each form type
	if(!$error) {
		$sql = "INSERT INTO program_evaluation (major, staff, building, `date`, title, category, learned, enjoyment) VALUES ('$major','$staff','$building','$date','$title','$category','$learned','$enjoyment')";
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
		<h2>Staff Post Program Assessment</h2>
		<!-- Name values are selectors for posting to php -->
		<div class="ui raised very padded text container segment">
		<form class="ui form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<label>What is your major?</label>
			<input type="text" name="major"/><br>
			<label>RA/RD/CM Staff Member(s) that hosted the program:</label>
			<input type="text" name="staff"/><br>
			<label>Residence hall that hosted the program:</label>
			<select id="building" name="building">
				<option value="barton">Colonie</option>
				<option value="barh">Bryckwyck</option>
				<option value="bray">Stackwyck</option>
				<option value="cary">RAHP A</option>
				<option value="hall">RAHP B</option>
				<option value="nugent">BARH</option>
				<option value="crockett">Barton Hall</option>
				<option value="nason">Bray Hall</option>
				<option value="davison">Cary Hall</option>
				<option value="sharp">Hall Hall</option>
				<option value="warren">Nason Hall</option>
				<option value="warren">Davison Hall</option>
				<option value="warren">Nugent Hall</option>
				<option value="warren">Warren Hall</option>
				<option value="warren">Sharp Hall</option>
				<option value="warren">Polytech Apartments</option>
				<option value="quadI">Quad I</option>
				<option value="quadII">Quad II</option>
				<option value="warren">E Complex</option>
				<option value="blitman">Blitman</option>
				<option value="north">City Station West</option>
				<option value="ecomplex">Campus Partner Program - Multiple Buildings</option>
			</select><br>
			<label>Program Date</label>
			<input type="date" name="date"/><br>
			<label>Title</label>
			<input type="text" name="title"/><br>
			<label>Category</label><br> <!-- change to two radio buttons for social and educational -->
			<input type="text" name="category"/><br>
			<label>Tell us a few things you learned from the program:</label><br>
			<input type="text" name="learned"/><br>
			<label>Did you enjoy the program?</label> <!-- change to radio buttons 1-5 for enjoyment -->
			<input type="text" name="enjoyment"/><br>
			<label>Other feedback?</label>
			<input type="text" name="comments"/><br>
			<input class="ui primary button submitbutton" type="submit" value="Submit" name="submit">
			<?php echo $errorText; ?>
		</form>
	  </div>
     </div>
	</body>
</html>
