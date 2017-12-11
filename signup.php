<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>RA/RD/AD--Register</title>
		<link rel="stylesheet" href="resources/signup.css" type="text/css" />
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
					<li class="nav-item"><a class="nav-item" href="https://webforms.rpi.edu/contact-student-living-learningp">Contact RPI ResLife</a></li>
				</ul>
			</div>
		</div>
		<!--====================register box===================-->
		<div id="register-centered">
			<div id="register-box">
				<div id="register-header">RA/RD/AD Register</div>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<label>Email: </label>
					<div class="register-value"><input type="text" name="email"/></div>
					<label>Password: </label>
					<div class="register-value"><input type="password" name="pass"/></div>
					<label>Confirm Password: </label>
					<div class="register-value"><input type="password" name="passConfirm"/></div>
					<label>Account Type: </label>
					<div class="register-value">
						<select name="accountType">
								<option value="RA">RA</option>
								<option value="RD">RD</option>
								<option value="AD">AD</option>
						</select>
					</div>
					<label>Code (ADs only): </label>
					<div class="register-value"><input type="number" name="code" /></div>
					<input type="submit" value="Create account" id="register-register" name="submit">
				</form>
				<p class="register-loginNowText">Already have an account?</p>
          		<button type="button" class="register-loginNow" onclick="location.href='login.php'">Login now!</button>
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
ob_start();
session_start();

if( isset($_SESSION['user'])!="" ) {
	header("Location: dashboard.php");
}

include_once 'dbconnect.php';

$error = false;
$errorText = "";
$ADMIN_AD_CODE = "123";

if ( isset($_POST['submit']) ) {
// clean user inputs to prevent sql injections
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$password = trim($_POST['pass']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);

	$passConfirm = trim($_POST['passConfirm']);
	$passConfirm  = strip_tags($passConfirm );
	$passConfirm  = htmlspecialchars($passConfirm);

	$hashpass = hash('sha256', $password);

	$accountType = $_POST['accountType'];

	$code = $_POST['code'];

	$query = mysql_query("SELECT email FROM accounts WHERE email='$email'");
	$count = mysql_num_rows($query);
	if($count != 0) {
		$error = true;
		$errorText = "Provided account name is already in use.";
	}
	if($password != $passConfirm) {
		$error = true;
		$errorText = "Password and password confirmation must match";
	}
	if($code != $ADMIN_AD_CODE  && $accountType == "AD") {
		$error = true;
		$errorText = "Incorrect code";
	}

	if( !$error ) {
		$sql = "INSERT INTO accounts (email, password, accountType) VALUES ('$email', '$hashpass', '$accountType')";

		if(!mysql_query($sql)) {
			die('Error: ' . mysql_error());
		}
		$sql = mysql_query("SELECT * FROM accounts WHERE email = '$email'");
		$row = mysql_fetch_array($sql);
		$_SESSION['user'] = $row['ID'];
		header("location: dashboard.php");
	} else {
		echo $errorText;
	}
}
?>

