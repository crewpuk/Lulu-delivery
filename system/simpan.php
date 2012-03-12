<?php
	//require('../../configuration/config.php');
		
	$simpan_cust = $_POST['simpan_customer'];
	$simpan_transaksi = $_POST['simpan_transaction'];
	
/*
	if($simpan_cust){
		$kode 		= $_POST['kode_cust'];
		$nama 		= $_POST['nama_cust'];
		$alamat		= $_POST['alamat_cust'];
		$kode_pos	= $_POST['kodePos_cust'];
		$tlp		= $_POST['tlp_cust'];
		$tlpRmh		= $_POST['tlp_rmh_cust'];
		$web 		= $_POST['web_cust'];
		$email 		= $_POST['email_cust'];	
		$status 	= $_POST['status_cust'];
		
		$x = mysql_query("INSERT INTO `m_customer` values('$kode','$nama','$alamat','$kode_pos','$tlp','$tlpRmh','$email','$status')") or die("Salah Query");
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
*/

	
		$code_transaction 	= $_POST['code_transaction'];
		$code_customer		= $_POST['code_customer'];
		$publikasi 			= $_POST['publikasi'];
		$model_pembayaran 	= $_POST['model_pembayaran'];

		
		//dijit.byId('dialogSukses').show();
		if(isset($simpan_transaksi)){
			$simpan_trans  = mysql_query("INSERT INTO
									m_transaction values('',
									'$code_transaction',
									'$code_customer',CURRENT_TIMESTAMP(),'$publikasi','$model_pembayaran','1')") or die("query salah".mysql_error());
		}
		
	
?>
