<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();

	if(isset($_SESSION['id'])){ 

						

?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main-wrapper">
		
		
	
			
			<div class="inner_container">
				<div class="btngrp">
					
					<a href="change_password.php" > <div class="change_password">Change Password</div></a>
				</div>

				<a href="logout.php"><button class="logout_button" type="button">Log Out</button></a>	
			</div>
		
		

	</div>
</body>
</html>

<?php 

 }
	else{ 

		header( "Location: index.php");

	 }
?>