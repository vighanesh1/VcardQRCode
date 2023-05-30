<?php include("dbconn.php");


             
session_start();

if(isset($_POST['submit'])) {
    $usr_name = $_POST['id'];
    $pass = $_POST['pass'];
  
   

$query_check = "SELECT * FROM `login_details` WHERE username = '$usr_name' && password= '$pass'";

    $result_check = mysqli_query($conn, $query_check);

    $auth= mysqli_num_rows($result_check);
    
     


if($auth ==1){

 
   $_SESSION['user_id'] = $usr_name;  
    
                 header('location:home.php');
            exit();

          setcookie($_SESSION['user_id'], "", time() - 600);


           // <meta http-equiv = 'refresh' content = '0; url = form.php' />

              
    }

    else {
    	  echo '<script>alert("Invalid Username or Password")</script>';
    }







}
    ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		.container {
			margin: auto;
			width: 400px;
			padding: 20px;
			background-color: #ffffff;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
		}
		h2 {
			text-align: center;
		}
		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.sub {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			width: 100%;
		}
		button:hover {
			background-color: #45a049;
		}
		.cancelbtn {
			background-color: #f44336;
		}
		.imgcontainer {
			text-align: center;
			margin: 24px 0 12px 0;
			position: relative;
		}
		img.avatar {
			width: 100px;
			border-radius: 50%;
		}
		.container form {
			border: 1px solid #ccc;
			padding: 16px;
			border-radius: 5px;
		}
		span.psw {
			float: right;
			padding-top: 16px;
		}
		@media screen and (max-width: 600px) {
			.container {
				width: 100%;
			}
		}
	</style>
</head>
<body style="background-image: url('night.jpg');">
	<div class="container">
		<h2>BARCODE LOGIN</h2>
		<form action="" method="post" name="log">
			<div class="imgcontainer">
				<img src="logo.png" alt="Avatar" class="avatar">
			</div>

			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="id" required>

			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" required>

			<input type="submit" class="sub" name="submit"></input>
			
		
		</form>
	</div>
	<div class> Developed by Vighanesh Shirke </div>
</body>
</body>
</html>	