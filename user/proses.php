<?php
mysql_connect('localhost','root','admin');
mysql_select_db('db_lulu');


if($_GET['page']=='save')

	{
		$status= 1;
		$q=mysql_query("INSERT INTO user_account(id_account,username_account,password_account,status_account) VALUES('','$_POST[txtUser]','$_POST[txtPass]','$status')");	
		if($q)
		{
			echo"<script>location='user.php?user=select'</script>";	
		}
		else
		{
			echo"<script>location='user.php?page=error404'</script>";	
		}
	}
	
if($_GET['page']=='upd')
{
	$sql=mysql_query("UPDATE user_account SET username_account = '".$_POST[txtUserUpd]."' , password_account = '".$_POST[txtPassUpd]."' , status_account = '".$_POST[radYa]."' WHERE id_account = '".$_POST['id']."'");
	if($sql)
	{
		echo"<script>location='user.php'</script>";	
		
	}
	else
	{
		echo"<script>location='user.php?page=error404'</script>";
	}
	
}
if($_GET['page']=='del')
{
	
	$sqlDel = mysql_query("DELETE FROM user_account where id_account = '".$_GET['idDel']."'");
	if($sqlDel)
	{
		echo"<script>location='user.php'</script>";	
	}
	else
	{
		echo"<script>location='user.php?page=error404'</script>";
	}
}

?>
