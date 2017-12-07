<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Welcome to RPI ResLife Assistant!</title>
		<link rel="stylesheet" href="resources/index.css" type="text/css" />
		<link rel="stylesheet" href="resources/header_footer.css" type="text/css" />
		<!-- font awesome version 4.7.0 -->
		<link rel="stylesheet" type="text/css" href="resources/font-awesome/css/font-awesome.min.css">
	</head>
	<body>
		<div id="header">
			<div id="red-top"></div>
			<div id="header-block">
				<div id="logo">
					<a href="index.php"><img src="resources/images/RPIlogo.png" alt="logo"></a>
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
					<li class="nav-item"><a class="nav-item" href="partner_proposal_form.php">General Form</a></li>
					<li class="nav-item"><a class="nav-item" href="program_assessment.php">Evaluation Form</a></li>
					<li class="nav-item"><a class="nav-item" href="contactUs.php">Contact RPI ResLife</a></li>
				</ul>
			</div>
		</div>

		<div id="welcome-index">
			<img id="indexBack" src="resources/images/index_background.jpg" alt="index_back" height="500">
			<div id="welcome-triangle"></div>
			<div id="welcome-text">
			For Clubs and <br>
			Other Organization: <br>
			<a class="white-link" href="partner_proposal_form.php">Click here for submitting an idea</a>
			</div>
		</div>
		<div id="footer">
			<div id="footer-text">
				<nav class="footList">
					<a class="footLink" href="about.html">About us</a> | 
					<a class="footLink" href="login.html">Login</a> | 
					<a class="footLink" href="signup.html">Register</a> |
					<a class="footLink" href="contact.html">Contact us</a> |   
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