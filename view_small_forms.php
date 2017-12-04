<?php
session_start();
ob_start();

require_once 'dbconnect.php';

if(!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$id = $_POST['data'];
$event = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$id'"));
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
	    <h2>Small Community Program Proposal</h2>
	    <div class="ui raised very padded text container segment">
		
		<!-- Name values are selectors for posting to php -->
		<form class="ui form" action="change_status.php" method="POST">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $event['name']; ?>" readonly/><br>
			<label>RPI Email</label>
			<input type="text" name="email" value="<?php echo $event['email']; ?>" readonly/><br>
			<label>Building</label>
			<input type="text" name="building" value="<?php echo $event['building']; ?>" readonly/><br>
			<label>Program Date</label>
			<input type="date" name="date" value="<?php echo $event['date']; ?>" readonly/><br>
			<label>Program Time</label>
			<input type="time" name="time" value="<?php echo $event['time']; ?>" readonly/><br>
			<label>Program Location</label>
			<input type="text" name="location" value="<?php echo $event['location']; ?>" readonly/><br>
			<label>Title</label>
			<input type="text" name="title" value="<?php echo $event['title']; ?>" readonly/><br>
			<label>Description</label>
			<textarea name="description" rows="5" cols="50" readonly><?php echo $event['description']; ?></textarea><br>
			<label>Learning objective (one)</label>
			<input type="text" name="learningObjective" value="<?php echo $event['learningObjective']; ?>" readonly/><br>
			<label>Pre Assessment Questions</label><br>
			<input type="text" name="q1" value="<?php echo $event['q1']; ?>" readonly/><br>
			<input type="text" name="q2" value="<?php echo $event['q2']; ?>" readonly/><br>
			<input type="text" name="q3" value="<?php echo $event['q3']; ?>" readonly/><br>
			<label>Budget Propsal</label>
			<input type="number" name="budget" value="<?php echo $event['budget']; ?>" readonly/><br>
			<input type="hidden" value="<?php echo $event['ID']; ?>" name="id"/>
			<input type="hidden" value="small" name="formtype"/>
			<div id="costList">
			<label>Item Costs</label><br>
			<?php 
			$itemNames = unserialize($event['itemNames']);
			$itemCosts = unserialize($event['itemCosts']);
			for($i=0; $i < count($itemNames); $i++) {
				echo('<p>'.$itemNames[$i].': '.$itemCosts[$i].'</p>');
			}
			?>
			</div><br>
			<div class="ui two buttons">
			<input class="ui basic red button" type="submit" value="Reject" name="reject"/>
	        <input class="ui basic green button" type="submit" value="Accept" name="accept"/>
	      </div>
		</form>
	  </div>
	</div>
</body>
</html>