<?php
@session_start();
if(empty($_SESSION['username']) || empty($_SESSION['password']) || $_SESSION['level'] != 'su_admin')
{
echo"<script>
location='index?page=page_login';
</script>";
}
else
{
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<div id="layout">
<div id="menu">
	<div id="menuHead">Menu Utama</div>
    <a href="?p=transaksi">Transaksi</a><br />
    <a href="?p=akun">Tambah Akun</a><br />
    <a href="logout.php">Keluar</a>
</div>

    <div id="form">
    <?php
	$page = $_GET['p'];
    if($page == ''){
	return;	
	}
	else{ 
	include "page/$p.php";
	}
	?>
    </div>
</div>
<?php } ?>
