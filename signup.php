<!DOCTYPE html>
<html>
	<head>
		<title>RA/RD/AD--Register</title>
		<link rel="stylesheet" href="resources/signup.css" type="text/css" />
		<link rel="stylesheet" href="resources/header.css" type="text/css" />
	</head>
	<body>
		<div id="header">
			<div id="red-top"></div>
			<div id="header-block">
				<div id="logo">
					<a href="index.php"><img src="resources/images/RPIlogo.png" alt="logo";"></a>
				</div>
			</div>

			<!-- The navigation bar -->
			<div id="nav-bar">
				<ul id="nav-list">
					<li class="nav-item"><a class="nav-item" href="aboutUs.php">About ResLife</a></li>
					<li class="nav-item"><a class="nav-item" href="activityCalendar.php">Activity Calendar</a></li>
					<li class="nav-item"><a class="nav-item" href="generalForm.php">General Form</a></li>
					<li class="nav-item"><a class="nav-item" href="contactUs.php">Contact RPI ResLife</a></li>
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
					<div class="login-value"><input type="password" name="pass"/></div>
					<label>Confirm Password: </label>
					<div class="login-value"><input type="password" name="passConfirm"/></div>
					<label>Account Type: </label>
					<div class="login-value">
						<select name="accountType">
								<option value="RA">RA</option>
								<option value="RD">RD</option>
								<option value="AD">AD</option>
						</select>
					</div>
					<label>Code (ADs only): </label>
					<input type="number" name="code" /><br>
					<input type="submit" value="Create account" id="login-login" name="submit">
				</form>
				<p class="login-registerNowText">Don't have an account?</p>
          		<button type="button" class="login-registerNow" onclick="location.href='login.php'">Already have an account? Login now!</button>
			</div>
		</div>ss

		<div id="footer">
			
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
		// echo "Email: ".$email."<br>";
		// echo "Password: ".$password."<br>";
		// echo "Hashed password: ".$hashpass."<br>";
		// echo "Account type: ".$accountType."<br>";
		// echo "Code: ".$code;
		header("location: dashboard.php");
	} else {
		echo $errorText;
	}
}
?>

