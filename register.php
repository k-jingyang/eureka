<html>
<title>Register</title>
<head>
<script type="text/javascript" src="sha512.js"></script>
<script>
function formhash(form, password, confirm_password, username, email) {
	var error=0;
	if(username.value===""){
		error+=1
	}
	if(email.value===""){
		error+=2
	}
	if(password.value!==""){	
		if(password.value==confirm_password.value){
			var p = document.createElement("input");
			p.name = "p";
			p.type = "hidden";
			p.value = hex_sha512(password.value);
			password.value = "";
			form.appendChild(p);	
			form.submit;
			return true;
		}
		else {	
			error+=8
		}
	}
	else {
		error+=4
	}
	window.location.href = './register.php?error='+error;
        return false;
}
</script>
<?php
	include 'functions.php';
	sec_session_start();
	if(isset($_GET['error'])) {
		$message = "";
		$error = $_GET['error'];
		if($error>=8){
			$message .="Passwords do not match"."</br>";
			$error-=8;
		}
		if($error>=4) {
			$message .="Please fill in a passsword to be used."."</br>";
			$error-=4;
		}
		if($error>=2){
			$message .="Please fill in an email address."."</br>";
			$error-=2;
		}
		if($error>=1){
			$message .="Please fill in an username.";
			$error-=1;
		}
		echo $message;
	}
?>
</head>
<body>
<form action="process_register.php" method="post" name="register_form">
	Username: <input type="text" name="username" id="username"/></br>
	Email: <input type="text" name="email" id="email"/></br>
	Password: <input type="password" id="password" name="password"/></br>
	Confirm Password: <input type="password" id="confirm_password" name="confirm_password"/></br>
	<input type="submit" value="Register" onclick="return formhash(this.form, this.form.password, this.form.confirm_password, this.form.username, this.form.email);"/>
</form>
</body>
</html>
