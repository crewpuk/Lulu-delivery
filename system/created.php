<?php
	print_r($_POST);
	$save_product 		= $_POST['save_product'];
	$kode_transaction	= $_POST['kode'];
	$codeCust			= $_POST['kodeCust'];
	$produk				= $_POST['produk'];
	$cabang				= $_POST['cabangfilter'];
	$qty				= $_POST['qty'];
	$ket				= $_POST['ket'];
	$queryCabang 		= mysql_query("SELECT * FROM `m_stock` where code_product = '$produk' and `id_sub_office` = $cabang");
	$sqlCabang			= mysql_fetch_array($queryCabang);
	$stokDB				= $sqlCabang['stock'];
	if(isset($save_product)){
		if($qty > $stokDB){
			alert('Stok Tidak Cukup');	
		}else{
		$simpan_pro = mysql_query("INSERT INTO `m_detail_transaction` values('','$kode_transaction','$produk','$qty','ok','$cabang',CURRENT_TIMESTAMP,'1')");
		$x = $qty * $harga;
		}
	}
?>
