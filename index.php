<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>LoginSystem</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<div class="container">
		
		<?php
		if(isset($_SESSION['userid']))
		{
			echo '<h2 class="isLoggedIn">You are logged in</h2>';
			echo '<form method="POST" action="serverSide/logout.php">
			<button class="logoutButton" type="submit">Logout</button>
			</form>';
		}
		else
		{
			echo '<div class="signupBox">
			<h2 class="signupText">Signup</h2>
			<form method="POST" action="serverSide/signup.php">
			Username:<br/>
			<input type="text" name="susername"><br/>
			Passsword:<br/>
			<input type="password" name="spassword"><br>
			<input class="submitButton" type="submit" name="submit" value="Submit">
			</form>
			</div>
			<div class="loginBox">
			<h2 class="loginText">Login</h2>
			<form method="POST" action="serverSide/login.php">
			Username:<br/>
			<input type="text" name="pusername"><br/>
			Passsword:<br/>
			<input type="password" name="ppassword"><br>
			<input class="loginButton" type="submit" name="login" value="Login">
			</form>
			</div>';
			echo '<h2 class="isLoggedIn">You are logged out</h2>';
		}
		?>
	</div>
</body>
</html>