<?php

	$save_product 		= $_POST['save_product'];
	$kode_transaction	= $_POST['kode'];
	$codeCust			= $_POST['kodeCust'];
	$produk				= $_POST['produk'];
	$qty				= $_POST['qty'];
	$ket				= $_POST['ket'];
	$sqlProduct			= mysql_fetch_array(mysql_query("SELECT * FROM `m_product` where code_product = '$produk'"));
	$stokDB				= $sqlProduct['stock_product'];
	if(isset($save_product)){
		if($qty > $stokDB){
			alert('Stok Tidak Cukup');	
		}else{
		$simpan_pro = mysql_query("INSERT INTO `m_detail_transaction` values('','$kode_transaction','$produk','$qty','ok','1')");
		$x = $qty * $harga;
		}
	}
?>
