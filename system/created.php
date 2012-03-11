<?php
/*
mysql_connect('localhost','root','admin');
mysql_select_db('db_lulu');
*/

//include("../configuration/config.php");

	$save_product 		= $_POST['save_product'];
	$kode_transaction	= $_POST['kode'];
	$codeCust			= $_POST['kodeCust'];
	$produk				= $_POST['produk'];
	$qty				= $_POST['qty'];
	$ket				= $_POST['ket'];
	
	if(isset($save_product)){
		$simpan_pro = mysql_query("INSERT INTO `m_detail_transaction` values('','$kode_transaction','$produk','$qty','$ket','1')");
		$x = $qty * $harga;
/*
		if ($simpan_pro){
			echo"<script>
					
					location='../index.php?page=transaksi_customer&kode=$code&kC=$codeCust';
				</script>" ;
		}else{
			echo"<script>alert('Terjadi Kesalahan pada Server');</script>";
		}
*/
	}
?>
