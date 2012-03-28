<?php
	
	$simpan_cust = $_POST['simpan_customer'];
	$simpan_transaksi = $_POST['simpan_transaction'];
	
		$code_transaction 	= $_POST['code_transaction'];
		$code_customer		= $_POST['code_customer'];
		$model_pembayaran 	= $_POST['model_pembayaran'];
		$delivery_man 		= $_POST['delivery_man'];
		$send_email		 	= $_POST['send_email'];
		$id_account			= $_SESSION['id'];

		
		//dijit.byId('dialogSukses').show();
		if(isset($simpan_transaksi)){
			$simpan_trans  = mysql_query("INSERT INTO
									m_transaction values('',
									'$code_transaction',
									'$id_account',
									'$code_customer',CURRENT_TIMESTAMP(),'$delivery_man','$model_pembayaran','1')") or die("query salah".mysql_error());
			
			$url = "user/cetak.php?kT=$code_transaction&kC=$code_customer&email=".$send_email."&delivery=".$delivery_man;
			$title = "_blank";
			$option = "width=800,height=700,scrollbars=yes";

			echo("<script type='text/javascript'>window.open('$url','$title','$option');</script>");

			if($simpan_trans){
				alert('Terima Kasih ! \n Silahkan Datang Kembali ^^');
			}else{
				alert('Terjadi Kesalahan Server! \n Silahkan Ulangi Lagi! ');
			}
		}
		
	
?>
