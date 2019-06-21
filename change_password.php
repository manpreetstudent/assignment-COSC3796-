<?php
	session_start();
	require_once('dbconfig/config.php');
	if(isset($_SESSION['id'])){ 
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/main.js"></script>
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Reset Password</h2></center>
		<form action="change_password.php" method="post"  onsubmit="return resetpdvalidate(this);"  >

			<div class="inner_container">
				
				
				<div class="formgroup"><label class="lable-side"><b>Current Password</b></label>
				<input type="password" class="text-side" id="currentpassword" name="currentpassword" ></div>
				<div class="formgroup"><label class="lable-side"><b>New Password</b></label>
				<input type="password" class="text-side" id="password" name="password" ></div>
				<div class="formgroup"><label class="lable-side"><b>Confirm Password</b></label>
				<input type="password" class="text-side" name="cpassword" id="cpassword" ></div>
				<div class="btngrp"><button class="login_button" name="changepassword"  type="submit">Submit</button>
				<a href="homepage.php"><div class="cancel_link">Cancel</div></a></div>
			
			</div>
		</form>
		
		<?php


			if(isset($_POST['changepassword']))
			{
				
				$currentpassword=$_POST['currentpassword'];
				$password=$_POST['password'];
				$cpassword=$_POST['cpassword'];
				$email= $_SESSION["email"];

				$query = "select * from users where email='$email' ";
				
				$query_run = mysqli_query($con,$query);
				
				if($query_run)
				{
					if($query_run->num_rows > 0)
					{
							$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);

							$hash_pwd = $row['password'];
							$hash = password_verify($currentpassword,$hash_pwd);

						if($password==$cpassword)
						{
							if($hash == 0) {
								echo '<script type="text/javascript">alert("Your current password not match. Please try again!")</script>';
							}
							else{


									$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
									
									$query_run = "update  users SET password='$encrypted_password' where email='".$_SESSION["email"]."' ";
									
									if(mysqli_query($con,$query_run) === TRUE)
									{
										echo '<script type="text/javascript">alert("Your password successfully changed")</script>';
											header( "Location: homepage.php");
									}
									else
									{
										echo '<script type="text/javascript">alert("Unsuccessful due to server error. Please try later")</script>';
									}
							}
						}
						else{
							echo '<script type="text/javascript">alert("New Password and Confirm Password do not match")</script>';
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else{
						echo '<script type="text/javascript">alert("DB error")</script>';
				}
			}

				
		else
		{
		}
		?>
	</div>
</body>
</html>


<?php 

 }
	else{ 

		header( "Location: index.php");

	 }
?>