<?php
function sec_session_start() {
	$session_name='secure_eureka_session';
	$secure = false;
	$httponly = true;
	ini_set('session.use_only_cookies', 1);
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name);
	session_start();
	session_regenerate_id(true);
}

function login($email, $password, $mysqli) {
	if($stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE email = ? LIMIT 1")) {
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user_id, $user_username, $db_password);
		$stmt->fetch();
		if($stmt->num_rows == 1) {
			if($db_password == $password) {
				$user_browser= $_SERVER['HTTP_USER_AGENT'];
	        	        $user_id = preg_replace("/[^0-9]+/", "", $user_id);
        	        	$_SESSION['user_id'] = $user_id;
                		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_username);
                		$_SESSION['username'] = $username;
				return true;
			}
		}
		else {
			return false;
		}
	}
}

function register($email, $password, $username, $mysqli) {
	if($stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)")) {
		$stmt->bind_param('sss', $username, $email, $password);
		$stmt->execute();
		if($stmt->affected_rows == 1) {
			return true;
		}
		else {
			return false;	
		}
	}
}

function get_owner_main_ideas($owner_id, $mysqli) {
	if($stmt = $mysqli->prepare("SELECT description, timestamp, votes, id FROM ideas WHERE owner_id = ?")){ 
		$stmt->bind_param('i', $owner_id);
                $stmt->execute();
                $stmt->store_result();	
		$stmt->bind_result($description, $timestamp, $votes, $id);		
		$json = array();
		while($stmt->fetch()){
			array_push($json, array("description" => $description, "timestamp" => $timestamp, "votes" => $votes, "id"=>$id));
		}
		return json_encode($json);
	}
	return false;
}

function login_check() {
	if(isset($_SESSION['user_id'], $_SESSION['username'])) {
		return true;
	}
	else {
		return false;
	}
}
?>
