<?php
ob_start();
session_start();

if( isset($_SESSION['user'])!="" ) {
	header("Location: dashboard/index.php");
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
		header("location: dashboard/index.php");
	} else {
		echo $errorText;
	}
}
?>

<html>
	<h1>Create Account Page</h1>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<label>Email: </label>
		<input type="text" name="email"/><br>
		<label>Password: </label>
		<input type="password" name="pass"/><br>
		<label>Confirm Password: </label>
		<input type="password" name="passConfirm"/><br>
		<label>Account Type: </label>
		<select name="accountType">
			<option value="RA">RA</option>
			<option value="RD">RD</option>
			<option value="AD">AD</option>
		</select>
		<label>Code (ADs only): </label>
		<input type="number" name="code" /><br>
		<input type="submit" value="Create account" name="submit">
	</form>
	<a href="login.php">Already created account? Click here to log in</a>
	<a href="index.php">Landing Page</a>
</html>

