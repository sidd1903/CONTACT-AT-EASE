<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#7f8c8d">

	<div id="main-wrapper">
		<center>
			<h2>Sign Up</h2>
			<img src="imgs/avatar1.png" class="avatar1"/><br>
		</center>
	
		<form class="myform" action="register.php" method="post">
			<label><b>Full name:</b></label><br>
			<input name="fullname" type="text" class="inputvalues" placeholder="Type your fullname" required/><br>
			<label><b>Gender:</b></label>
			<input type="radio" class="radiobtns" name="gender" value="male" required/> Male
			<input type="radio" class="radiobtns" name="gender" value="female" required/> Female <br>
			<label><b>Username:</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
			<label><b>Password:</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="Your password" required/><br>
			<label><b>Confirm Password:</b></label><br>
			<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required/><br>
			<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
			<a href="index.php"><input type="button" id="back_btn" value="<< Back"/></a>


		</form>
		
		<?php
			if(isset($_POST['submit_btn']))
			{
				//echo '<script type="text/javascript"> alert("Sign Up button clicked") </srcript> ';
				
				$fullname = $_POST['fullname'];
				$gender = $_POST['gender'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$cpassword = $_POST['cpassword'];
				
				
				if($password==$cpassword)
				{
					$encrypted_password = md5($password);
					
					$query = "select * from userinfotable WHERE username='$username'";
					$query_run = mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						//there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists... try another username") </script>';
					}
					else
					{
						
						$query="insert into userinfotable values ('','$username','$fullname','$gender','$encrypted_password')";
						$query_run = mysqli_query($con,$query);

						if($query_run)
						{
							echo '<script type="text/javascript"> alert("User registered... Go to login page to login") </script>';

						}
						else
						{
							echo '<script type="text/javascript"> alet("ERROR!") </script>';

						}
					}	
				}
				else
				{
					echo '<script type="text/javascript"> alert("Password and Confirm Password does not match!") </script>';
				}
			}
		?>
	</div> 
</body>
</html>