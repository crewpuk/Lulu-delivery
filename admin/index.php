<?php
@session_start();
include "../configuration/config.php";
if(empty($_SESSION['su_user']) || empty($_SESSION['su_pass']) || $_SESSION['level'] != 'su_admin')
{
echo"<script>
location='../index?page=page_login';
</script>";
}
else
{
$arrHari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum\'at","Sabtu");
$hari = date('w');
?>
<style type="text/css">
			@import "../lib/dojo/dojo/resources/dojo.css";
			@import "../lib/dojo/dijit/themes/claro/claro.css";
			@import "../lib/dojo/dijit/themes/tundra/tundra.css";
			@import "../lib/dojo/dijit/themes/soria/soria.css";
			@import "../lib/dojo/dojox/grid/resources/Grid.css";
			@import "../lib/dojo/dojox/grid/resources/claroGrid.css";
			@import "../css/lulu.css";
			@import "../css/panel.css";
            @import "../css/ribbon.css";
            @import "../css/menu.css";
            @import "../css/layout.css";
			
			</style>

			<script type="text/javascript">
				var djConfig = { parseOnLoad: true };
			</script>
			
	<script type="text/javascript" src="../lib/dojo/dojo/dojo.js"></script>
			<script type="text/javascript" src="../js/main.js"></script>
			<script type="text/javascript" src="../js/require.js"></script>
<link href="../images/32x32/logo.png" rel="shortcut icon" />
<title>Administrator</title>
<body class="claro">
<div id="headerMenu">Anda Login Sebagai : <?php echo $_SESSION['su_user']; ?>.
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
<div id="ribbon"><?php include "ribbon_ad.php"; ?></div>
<div id="container">
	<div id="content">
    <?php 
	$page = (isset($_GET['page']))?$_GET['page']:"";
    $sub = (isset($_GET['sub']))?$_GET['sub']:"";
	@include "form/$sub.php"; 
	?>
    </div>
</div>
<div id="footer">Copyright &copy; 2012 Lulu Delivery App <br />
All Rights Reserved</div>
</body>
<?php } ?>