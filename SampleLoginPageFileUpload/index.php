<?php
	session_start();
	require 'dbconfig/config.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#7f8c8d">

	<div id="main-wrapper">
		<center>
			<h2>Sign In</h2>
            <img src="imgs/avatar.png" class="avatar"/>
		</center>
	
		<form class="myform" action="index.php" method="post">
			<label><b>Username:</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
			<label><b>Password:</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="Typr your password" required/><br>
			<input name="login" type="submit" id="login_btn" value="Sign In"/><br>
			<a href="register.php"><input type="button" id="register_btn" value="Register"/></a>
		</form>
		<?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="select * from fileuploadtable WHERE username='$username' AND password='$password'";
			
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				$row = mysqli_fetch_assoc($query_run);
				//valid
				$_SESSION['username'] = $row['username'];
				$_SESSION['imglink'] = $row['imglink'];

				header('location:homepage.php');
			}
			else
			{
				//invalid
				echo '<script type="text/javascript"> alert("Invalid credentials!") </script>';

			}
		}
		?>
	</div>
</body>
</html>