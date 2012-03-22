<?php
include "../../configuration/config.php";

$user = isset($_POST['txtUser'])?$_POST['txtUser']:"";
$pass = isset($_POST['txtPass'])?$_POST['txtPass']:"";

$userUpd = isset($_POST['txtUserUpd'])?$_POST['txtUserUpd']:"";
$passUpd = isset($_POST['txtPassUpd'])?$_POST['txtPassUpd']:"";
$stts = isset($_POST['radYa'])?$_POST['radYa']:"";
if(isset($_POST['save']))

	{
		$status= 1;
		$q=mysql_query("INSERT INTO user_account(id_account,username_account,password_account,status_account) VALUES('','$user','$pass','$status')");	
		if($q)
		{
			echo"<script>alert('Data Berhasil Disimpan');location='../index.php?page=dashboard&sub=akun'</script>";	
		}
		else
		{
			echo"<script>location='../index.php?page=dashboard&sub=akun'</script>";	
		}
	}
	
if(isset($_POST['ubah_akun']))
{
	$sql=mysql_query("UPDATE user_account SET username_account = '$userUpd' , password_account = '$passUpd' , status_account = '$stts' WHERE id_account = '".$_POST['id']."'");
	if($sql)
	{
		echo"<script>location='../index.php?page=dashboard&sub=akun'</script>";	
		
	}
	else
	{
		echo"<script>location='../index.php?page=dashboard&sub=akun'</script>";
	}
	
}
if(isset($_GET['del']))
{
	
	$sqlDel = mysql_query("DELETE FROM user_account where id_account = '".$_GET['idDel']."'");
	if($sqlDel)
	{
		echo"<script>location='../index.php?page=dashboard&sub=akun'</script>";	
	}
	else
	{
		echo"<script>location='../index.php?page=dashboard&sub=akun'</script>";
	}
}

?>
