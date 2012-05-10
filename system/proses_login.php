<?php

include("../configuration/config.php");

$user=$_REQUEST['nama'];
$pass=$_REQUEST['kunci'];

	if($user=="" and $pass=="")
	{
	echo"<script>
	alert('Masukan Username dan Password!');
	location='../index.php?page=page_login';
	</script>";
	}
	else
	{
	$que=mysql_query("select * from user_account where username_account='$user' and password_account='$pass' and status_account = '1'") or die("query Salah  ->   ".mysql_error());
	$lock=mysql_fetch_array($que);
	
	$id			= $lock['id_account'];
	$username	= $lock['username_account'];
	$password	= $lock['password_account'];
	$level		= $lock['name_role'];
	
		if($user==$username and $pass==$password)
		{
		session_start();
		$_SESSION['id']			= $id;
		$_SESSION['level']		= $level;
		
			if($level=='su_admin')
			{
			$_SESSION['su_user']	= $username;
			$_SESSION['su_pass']	= $password;
			echo"<script>
			location='../admin/index.php';
				</script>";
			}
			elseif($level=='admin')
			{
			$_SESSION['user']		= $username;
			$_SESSION['pass']		= $password;
			echo"<script>
			location='../index.php?page=dashboard';
			</script>";
			}
		}
		elseif($user!=$username and $pass!=$password)
		{
		echo"<script>
		alert('Username dan password salah');
		location='../index.php?page=page_login';
		</script>";
		}
		elseif($user!=$username)
		{
		echo"<script>
		alert('Username salah');
		location='../index.php?page=page_login';
		</script>";
		}
		elseif($pass!=$password)
		{
		echo"<script>
		alert('Password salah');
		location='../index.php?page=page_login';
		</script>";
		}
		
	}



?>
