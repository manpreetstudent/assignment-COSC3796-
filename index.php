<?php
	session_start();
	require_once('dbconfig/config.php');

if(isset($_SESSION['id'])){ 

							header( "Location: homepage.php");
 }
	else{
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/main.js"></script>
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Sign In</h2></center>
			
		<form action="index.php" method="post"  onsubmit="return validate(this);">
		
			<div class="inner_container">
					<div class="formgroup"><label class="lable-side"><b>Email</b></label>  <input type="text" class="text-side"  name="email" id="email" value="<?php if(isset($_POST['login'])) { echo $_POST['email']; } else{ }  ?>" autofocus ></div>
				
				<div class="formgroup"><label class="lable-side"><b>Password</b></label>
				<input type="password" id="password" class="text-side"  name="password" ></div>
				<div class="btngrp"><button class="login_button" name="login" type="submit">Login</button>
				<button type="reset" class="reset_btn">Reset</button></div>
				<div class="register_div">Register new account <a href="register.php" class="register_link"><span>Register</span></a></div>
			</div>
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				$email=$_POST['email'];
				$password=$_POST['password'];

				$query = $con->prepare("select * from users where email=?");
				$query->bind_param('s', $email);

				$query->execute();
				$result = $query->get_result();
				$row = $result->fetch_assoc();
				
				$hash_pwd = $row['password'];
				$hash = password_verify($password,$hash_pwd);

				if($hash == 0) {
					echo '<script type="text/javascript">alert("Invalid Credentials")</script>';
				}
				else{

						$query = $con->prepare("select * from users where email='$email' and password=? ");
						$query->bind_param('s', $hash_pwd);
						$query->execute();
						$query_run = $query->get_result();
					
						if($query_run)
						{
							if(mysqli_num_rows($query_run)>0)
							{
							$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
							$_SESSION['email'] = $row['email'];
							$_SESSION['id'] = $row['id'];
							
							
							
							header( "Location: homepage.php");
							}
							else
							{
								echo '<script type="text/javascript">alert("No such Email exists. Invalid Credentials")</script>';
							}
						}
						else
						{
							echo '<script type="text/javascript">alert("Database Error")</script>';
						}

				}

			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>

<?php  } ?>