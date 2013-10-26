<?php
include 'functions.php';
include 'db_connect.php';
sec_session_start();
if(login_check()){
?>
	<html>
	<head>
	<title>Eureka Main Page</title>
	<link rel="stylesheet" href="stylesheets/foundation.min.css">
       	<link rel="stylesheet" href="stylesheets/main.css">
  	<link rel="stylesheet" href="stylesheets/app.css">
 	<script src="javascripts/modernizr.foundation.js"></script>
	<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />	
	</head>
	
	<body>
	<a href="main.php"><img src="images/Project-Eureka.png" alt="desc" class="header_logo" /></a>
	<div class="twelve columns header_nav_fullwidth">	
	<div class="ten columns" style="padding-top:8px"></div>
        <div class="two columns">
	 	
		<p align="right" style="margin: 6px 0">
		<b><?php echo $_SESSION['username'];?></b>
		<a href="logout.php" class="button small">Logout</a> 
            	</p>
        </div>
	</div>	
	<h2>Your ideas</h2>
	<table border="1">
	<tr><td>No.</td><td>Title</td><td>Date Created</td><td>Votes</td></tr>
	<?php 
	$ideas_array = json_decode(get_owner_main_ideas($_SESSION['user_id'], $mysqli),true);
	$idea_index = 1;
	for ($i = 0; $i<sizeof($ideas_array); $i++) {
		echo "<tr>";
		echo "<td>". $idea_index."</td>";
		echo "<td><a href=\"ideas.php?id=". $ideas_array[$i]['id']. "\">".$ideas_array[$i]['description']. "</a></td>";
		echo "<td>". $ideas_array[$i]['timestamp']."</br></td>";
		echo "<td>". $ideas_array[$i]['votes']."</br></td>";
		$idea_index+=1;
		echo "</tr>";
	}
	?>
	</table>
	</body>
	</html>
<?php
}
else {
	header('Location: ./login.php');
}
?>
