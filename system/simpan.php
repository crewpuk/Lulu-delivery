<?php
	
	$simpan_cust = $_POST['simpan_customer'];
	$simpan_transaksi = $_POST['simpan_transaction'];
	
		$code_transaction 	= $_POST['code_transaction'];
		$code_customer		= $_POST['code_customer'];
		$model_pembayaran 	= $_POST['model_pembayaran'];
		$delivery_man 		= ($_SESSION['level']=='user')?'1':$_POST['delivery_man'];
		$send_email		 	= $_POST['send_email'];
		$id_account			= $_SESSION['id'];

		
		//dijit.byId('dialogSukses').show();
		if(isset($simpan_transaksi)){
			$simpan_trans  = mysql_query("INSERT INTO
									m_transaction(code_transaction,id_account,code_customer,time_transaction,id_delivery,cost_type_transaction,status_transaction) values(
									'$code_transaction',
									'$id_account',
									'$code_customer',CURRENT_TIMESTAMP(),'$delivery_man','$model_pembayaran','1')") or die("INSERT INTO
									m_transaction(code_transaction,id_account,code_customer,time_transaction,id_delivery,cost_type_transaction,status_transaction) values(
									'$code_transaction',
									'$id_account',
									'$code_customer',CURRENT_TIMESTAMP(),'$delivery_man','$model_pembayaran','1') ".mysql_error());
			
			$url = "cetak.php?kT=$code_transaction&kC=$code_customer&email=".$send_email."&delivery=".$delivery_man;
			$title = "_blank";
			$option = "width=800,height=700,scrollbars=yes";

			echo("<script type='text/javascript'>window.open('$url','$title','$option');</script>");
			// if($simpan_trans){
			// 	alert('Terima Kasih ! \n Silahkan Datang Kembali ^^');
			// }else{
			// 	alert('Terjadi Kesalahan Server! \n Silahkan Ulangi Lagi! ');
			// }
		}
		
	
?>
