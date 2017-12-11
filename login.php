<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>RA/RD/AD--Login</title>
		<link rel="stylesheet" href="resources/login.css" type="text/css" />
		<link rel="stylesheet" href="resources/header_footer.css" type="text/css" />
	</head>
	<body>
		<div id="header">
			<div id="red-top"></div>
			<div id="header-block">
				<div id="logo">
					<a href="index.php"><img src="resources/images/RPIlogo.png" alt="logo"></a>
				</div>
			</div>

			<!-- The navigation bar -->
			<div id="nav-bar">
				<ul id="nav-list">
					<li class="nav-item"><a class="nav-item" href="aboutUs.php">About ResLife</a></li>
					<li class="nav-item"><a class="nav-item" href="activityCalendar.php">Activity Calendar</a></li>
					<li class="nav-item"><a class="nav-item" href="partner_proposal_form.php">General Form</a></li>
					<li class="nav-item"><a class="nav-item" href="program_evaluation.php">Evaluation Form</a></li>
					<li class="nav-item"><a class="nav-item" href="https://webforms.rpi.edu/contact-student-living-learning">Contact RPI ResLife</a></li>
				</ul>
			</div>
		</div>
		<!--====================login box===================-->
		<div id="login-centered">
			<div id="login-box">
				<div id="login-header">RA/RD/AD Login</div>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<label>Email: </label>
					<div class="login-value"><input type="text" name="email"/></div>
					<label>Password: </label>
					<div class="login-value"><input type="password" name="password"/></div>

					<input type="submit" value="Log in" id="login-login" name="submit"/>
				</form>
				<p class="login-registerNowText">Don't have an account?</p>
          		<button type="button" class="login-registerNow" onclick="location.href='signup.php'">Sign Up Now!</button>
			</div>
		</div>
		<div id="footer">
			<div id="footer-text">
				<nav class="footList">
					<a class="footLink" href="aboutUs.php">About us</a> | 
					<a class="footLink" href="login.php">Login</a> | 
					<a class="footLink" href="signup.php">Register</a> |
					<a class="footLink" href="https://webforms.rpi.edu/contact-student-living-learning">Contact us</a> |   
					<a class="footLink" href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-square fa-lg" aria-hidden="true" title="Friend us on Facebook!"></i></a>
					<a class="footLink" href="https://twitter.com" target="_blank"><i class="fa fa-twitter-square fa-lg" aria-hidden="true" title="Follow us on Twitter!"></i></a>
					<a class="footLink" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin-square fa-lg" aria-hidden="true" title="Connect with us on LinkedIn!"></i></a>
				</nav>
				<div id="copyright">
					&copy; RPI ResLife Assistant
				</div>
			</div>
		</div>
	</body>
	
</html>


<?php
session_start();
ob_start();

require_once 'dbconnect.php';

if( isset($_SESSION['user'])!="") {
	header("Location: dashboard.php");
	exit;
}

$error = false;
$errorText = "";

if(isset($_POST['submit'])) {

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['password']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	if(empty($email)) {
		$error = true;
		$errorText = "Please enter your email address";
	}
	if(empty($pass)) {
		$error = true;
		$errorText = "Please enter your password";
	}

	//continue to log in if no error
	if (!$error) {
		$hashpass = hash('sha256', $pass);

		$sql = mysql_query("SELECT * FROM accounts WHERE email = '$email'");
		$row = mysql_fetch_array($sql);
		$count = mysql_num_rows($sql);	//value will be 1 if correct
		if($count == 1 && $row['password'] == $hashpass) {

			$_SESSION['user'] = $row['ID'];
			header("Location: dashboard.php");
		} else {
			$errorText = "Incorrect email and password combination";
			echo $errorText;
		}
	} else {
		echo $errorText;
	}
}
?>