<?php 

if(isset($_POST['login'])){
	require "dbh.php";

	$username = $_POST['pusername'];
	$password = $_POST['ppassword'];

	if(empty($username) || empty($password))
	{
		header("Location: ../index.php?nousernameorpasswordgiven");
		exit();
	}
	else
	{
		$sql = "SELECT * FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../index.php?sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);

			$results = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($results))
			{
				$pwdCheck = password_verify($password, $row['password']);
				if($pwdCheck == false)
				{
					header("Location: ../index.php?wrongpassword");
					exit();
				}
				else if($pwdCheck == true)
				{
					session_start();
					$_SESSION['userid'] = $row['username'];
					header("Location: ../index.php?login=success");
					exit();
				}
				else
				{
					header("Location: ../index.php?sqlerror");
					exit();
				}
			}
			else
			{
				header("Location: ../index.php?nodatafound");
				exit();
			}

		}
	}
}