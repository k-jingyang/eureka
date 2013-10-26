<html>
<title>Eureka</title>
<head>
<script type="text/javascript" src="sha512.js"></script>
<link rel="stylesheet" href="stylesheets/foundation.min.css">
<link rel="stylesheet" href="stylesheets/main.css">
<link rel="stylesheet" href="stylesheets/app.css">
<script src="javascripts/modernizr.foundation.js"></script>
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />	

<script>
function formhash(form, password) {
	var p = document.createElement("input");
	p.name = "p";
	p.type = "hidden";
	p.value = hex_sha512(password.value);
	password.value = "";
	form.appendChild(p);	
	form.submit;
}
</script>
<?php

	include 'functions.php';
	sec_session_start();
	if(isset($_GET['error'])) {
		echo 'Error logging in!';
	}
	if(isset($_GET['success'])) {
		echo 'Successfully registered, please login below!';
	}
	if(login_check()) { 
		header('Location: ./main.php');
	}

?>
</head>
<body>
	<div class="six columns">
	<div class="panel">
	<form action="process_login.php" method="post" name="login_form">
	Email:	<input type="text" name="email" class="input_title_invoice"/></br>
	Password: <input type="password" name="password" id="password" /></br>
	<input type="submit" value="Login" onclick="return formhash(this.form, this.form.password);"/>	
	</form>
	<a href="register.php">Register</a>
	</div>
	</div>
</body>
</html>
