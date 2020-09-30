<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript">

	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("imglink").files[0]);
		
		oFReader.onload = function (oFREvent) {
			document.getElementById("uploadPreview").src = oFREvent.target.result;
		};
	};
	
</script>
</head>
<body style="background-color:#7f8c8d">

	<form class="myform" action="register.php" method="post" enctype="multipart/form-data" >
	<div id="main-wrapper">
		<center>
			<h2>Sign Up</h2>
			<img id="uploadPreview" src="imgs/avatar1.png" class="avatar1"/><br>
			<input type="file" id="imglink" name="imglink" accept=" .jpg, .jpeg, .png" onchange="PreviewImage();"/>

		</center>
	
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
				
				$img_name = $_FILES['imglink']['name'];
				$img_size = $_FILES['imglink']['size'];
				$img_tmp = $_FILES['imglink']['tmp_name']; 
				
				$directory = 'uploads/';
				$target_file = $directory.$img_name;
				
				if($password==$cpassword)
				{
					$query = "select * from fileuploadtable WHERE username='$username'";
					$query_run = mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						//there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists... try another username") </script>';
					}
					else if(file_exists($target_file))
					{
						echo '<script type="text/javascript"> alert("image file already exists... Try another image file") </script>';
					}
					else
					{
						move_uploaded_file($img_tmp,$target_file);
						$query="insert into fileuploadtable values ('','$username','$password','$fullname','$target_file','$gender')";
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