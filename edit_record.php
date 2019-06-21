<?php
	session_start();
	require_once('dbconfig/config.php');
	if(isset($_SESSION['id'])){ 

						

?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Record</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/main.js"></script>
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Edit Record</h2></center>
		<?php

				if(isset($_GET['id'])){ $id=$_GET['id']; 
					$query = "select * from record where u_id='".$_SESSION['id']."' and id='$id' ";
				
				$query_run = mysqli_query($con,$query);
				
				if($query_run->num_rows > 0)
					{		$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
						$namefdb=$row['name'];
						$mobilefdb=$row['mobileno'];
						?>
<form action="edit_record.php" method="post"  onsubmit="return addrecordvalidate(this);"  >

			<div class="inner_container">
				
				
				<div class="formgroup"><label class="lable-side"><b>Name</b></label>
				<input type="text" class="text-side" id="personname" value="<?=$namefdb ?>" name="personname" ></div>
				<div class="formgroup"><label class="lable-side" ><b>Mobile No.</b></label>
				<input type="text" class="text-side" id="mobile" onkeypress="return isNumber(event)" value="<?=$mobilefdb ?>" name="mobile" ></div>
				<input type="hidden" name="id" value="<?=$id?>">
				<div class="btngrp"><button class="login_button" name="edit_record"  type="submit">Submit</button>
				<a href="homepage.php"><div class="cancel_link">Cancel</div></a></div>
			
			</div>
		</form>

						<?php
					}	
					else
					{
						echo '<script type="text/javascript">alert("Something going wrong. Please try again!")</script>';
						echo '<h3>Go back.</h3>';
					}
				}
				?>
		
		
		<?php


			if(isset($_POST['edit_record']))
			{
				
				$personname=$_POST['personname'];
				$mobile=$_POST['mobile'];
				$email= $_SESSION["email"];

				
				if($mobile==""||$personname=="")
				{
						echo '<script type="text/javascript">alert("all field is required")</script>';
				}
				else
				{

								
									
									$query_run = "update  record SET name='$personname',mobileno='$mobile' where id='".$_POST['id']."' ";
									
									if(mysqli_query($con,$query_run) === TRUE)
									{
										echo '<script type="text/javascript">alert("Your record successfully changed")</script>';
											header( "Location: homepage.php");
									}
									else
									{
										echo '<script type="text/javascript">alert("Unsuccessful due to server error. Please try later")</script>';
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


<?php 

 }
	else{ 

		header( "Location: index.php");

	 }
?>