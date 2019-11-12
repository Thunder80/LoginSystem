<?php 
if(isset($_POST['submit'])){
	require 'dbh.php';

	$username = $_POST['susername'];
	$password = $_POST['spassword'];

	if(empty($username) || empty($password)){
		header("Location: ../index.php?error=nousernameorpassword");
		exit();
	}
	else{
		$sql = "SELECT * FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, 's', $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0)
			{
				header("Location: ../index.php?error=usernamealreayexists");
				exit();
			}
			else
			{
				$sql = "INSERT INTO users(username, password) VALUES (?, ?)";
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../index.php?error=sqlerror");
					exit();
				}
				else
				{
					$hashPassword = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, 'ss', $username, $hashPassword);
					mysqli_stmt_execute($stmt);
					header("Location: ../index.php?signup=success");
					exit();
				}
			}
		}
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else
{
	header("Location: index.php");
	exit();
}


