<?php
@session_start();
include "configuration/config.php";
if(empty($_SESSION['user']) || empty($_SESSION['pass']) || $_SESSION['level'] != 'admin')
{
echo"<script>
location='index.php?page=page_login';
</script>";
}
else
{
$arrHari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum\'at","Sabtu");
$hari = date('w');

$id = $_SESSION['id'];
$q_user = mysql_query("SELECT fullname_account FROM user_account WHERE id_account = '$id' LIMIT 1");
$data_user = mysql_fetch_array($q_user);

?>
<div id="headerMenu">Anda Login Sebagai : <?php echo $data_user['fullname_account']; ?>.
<div id='jam'>
<script language='javascript'>
function jam(){
var waktu = new Date();
var jam = waktu.getHours();
var menit = waktu.getMinutes();
var detik = waktu.getSeconds();

if(jam < 10){
	jam = '0' + jam;	
}
if(menit < 10){
	menit = '0' + menit;	
}
if(detik < 10){
	detik = '0' + detik;	
}

var jam_div = document.getElementById('jam');
jam_div.innerHTML = '<?php echo $arrHari[$hari]; ?>, <?php echo date('d-m-Y');?> '  + jam + ':' + menit + ':' + detik;
setTimeout('jam()', 1000);
}
jam();
</script></div>
</div>
<div id="ribbon"><?php include "ribbon.php"; ?></div>
<div id="container">
	<div id="content">
    <?php 
	$page = (isset($_GET['page']))?$_GET['page']:"";
    $sub = (isset($_GET['sub']))?$_GET['sub']:"";
	@include "user/$sub.php";
    if($page == 'dashboard' and $sub == 'keluar'){
                    location('logout.php');                    
    }
	?>
    </div>
</div>
<div id="footer">Copyright &copy; 2012 Lulu Delivery App <br />
All Rights Reserved</div>
<?php } ?>
