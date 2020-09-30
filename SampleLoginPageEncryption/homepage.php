<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#7f8c8d">

	<div id="main-wrapper">
		<center>
			<h2>Home Page</h2>
			<h3>Welcome
				 <?php echo $_SESSION['username']?>
			</h3>
			<img src="imgs/avatar2.png" class="avatar2"/> 
		</center>
	
		<form class="myform" action="homepage.php" method="post">

			<input name="logout" type="submit" id="logout_btn" value="Log out"/><br>

		</form>
		
		<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header('location:index.php');
			}
		?>
	</div>
</body>
</html> 