<?php
	
	$simpan_cust = $_POST['simpan_customer'];
	$simpan_transaksi = $_POST['simpan_transaction'];
	
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
			if($simpan_trans){
				alert('Terima Kasih ! \n Silahkan Datang Kembali ^^');
			}else{
				alert('Terjadi Kesalahan Server! \n Silahkan Ulangi Lagi! ');
			}
		}
		
	
?>
