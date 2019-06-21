<?php
	
		session_start();
		if(isset($_SESSION['id'])){ 
	require_once('dbconfig/config.php');

					if(isset($_POST['id']))
					{
							if($_POST['id']!="")
							{
									$query_run = "delete from  record where id='".$_POST['id']."' ";
									
									if(mysqli_query($con,$query_run) === TRUE)
									{
										echo '<script type="text/javascript">alert("Your record successfully deleted")</script>';
											header( "Location: homepage.php");
									}
									else
									{
										echo '<script type="text/javascript">alert("Unsuccessful due to server error. Please try later")</script>';
									}
							}
							else{
								echo '<script type="text/javascript">alert("Something going wrong. Please try again!")</script>';
					
							}		
					}
					else
					{
								echo '<script type="text/javascript">alert("Something going wrong. Please try again!")</script>';

					}
									
?>


<?php 

 }
	else{ 

		header( "Location: index.php");

	 }
?>