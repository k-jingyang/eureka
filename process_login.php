<?php
include 'db_connect.php';
include 'functions.php';
sec_session_start();

if(isset($_POST['email'], $_POST['p'])) {
	$email = $_POST['email'];
	$password = $_POST['p'];
	if(login($email, $password, $mysqli) == true) {
	?>
	<html>
	<body>
	Success: You have been logged in!</br>
	<a href="main.php">Continue</a>
	</body>
	</html>
	<?php
	}
	else {
		header('Location: ./login.php?error=1');
	}

}
?>
