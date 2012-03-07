<?php
	include("../../configuration/config.php");
	$simpan_cust = $_POST['simpan_customer'];
	if($simpan_cust){
		$kode 		= $_POST['kode_cust'];
		$nama 		= $_POST['nama_cust'];
		$alamat		= $_POST['alamat_cust'];
		$kode_pos	= $_POST['kodePos_cust'];
		$tlp		= $_POST['tlp_cust'];
		$hp 		= $_POST['hp_cust'];
		$web 		= $_POST['web_cust'];
		$email 		= $_POST['email_cust'];	
		$status 	= $_POST['status_cust'];
		$telepon	= $tlp.','.$hp;
		
		$x = mysql_query("INSERT INTO `m_customer` values('$kode','$nama','$alamat','$kode_pos','$telepon','$email','$status')") or die("Salah Query");
		if($x){
			echo "<script>
					alert('Data BERHASIL disimpan')
					location='../index.php'
				</script>";
		}else{
			echo "<script>
					alert('Data GAGAL disimpan')
					location='../index.php'
				</script>";
		}
	}
?>