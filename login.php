<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="resources/login.css" type="text/css" />
		<link rel="stylesheet" href="resources/header.css" type="text/css" />
	</head>
	<body>
		<div id="header">
			<div id="red-top"></div>
			<div id="header-block">
				<div id="logo">
					<a href="index.php"><img src="resources/images/RPIlogo.png" alt="logo";"></a>
				</div>
				<div id="login-topRight">
					<a class="white-link" href="login.php">RA/RD/AD Log in</a><br>
					<a class="white-link" href="signup.php">Create account</a>
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
					<div class="login-value"><input type="password" name="password"/></div>

					<input type="submit" value="Log in" id="login-login" name="submit"/>
				</form>
				<p class="login-registerNowText">Don't have an account?</p>
          		<button type="button" class="login-registerNow" onclick="location.href='signup.php'">Sign Up Now!</button>
			</div>
		</div>
		

		<div id="footer">
			
		</div>
	</body>
	
</html>


<?php
session_start();
ob_start();

require_once 'dbconnect.php';

if( isset($_SESSION['user'])!="") {
	header("Location: home.php");
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
			header("Location: home.php");
		} else {
			$errorText = "Incorrect email and password combination";
			echo $errorText;
		}
	} else {
		echo $errorText;
	}
}
?>