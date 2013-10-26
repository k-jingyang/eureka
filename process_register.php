<?php

include 'db_connect.php';
include 'functions.php';
sec_session_start();

if(isset($_POST['email'], $_POST['p'], $_POST['username'])){
	$email = $_POST['email'];
	$password = $_POST['p'];
	$username = $_POST['username'];
	if(register($email, $password, $username, $mysqli) == true) {
		header('Location: ./login.php?success=1');
	}
}
else {
	
} 
?>
