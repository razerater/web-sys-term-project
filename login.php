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


<html>
	<h1>Login Page</h1>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<label>Email: </label>
		<input type="text" name="email"/><br>
		<label>Password: </label>
		<input type="password" name="password"/><br>

		<input type="submit" value="Log in" name="submit">
	</form>
	<a href="signup.php">Dont have an account? Click here</a>
	<a href="landing.php">Landing Page</a>
</html>