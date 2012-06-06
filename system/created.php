<?php
	$save_product 		= $_POST['save_product'];
	$kode_transaction	= $_POST['kode'];
	$codeCust			= $_POST['kodeCust'];
	$produk				= $_POST['produk'];
	$cabang				= ($_SESSION['level']=='user')?'0':$_POST['cabangfilter'];
	$qty				= $_POST['qty'];
	$ket				= $_POST['ket'];
	if($_SESSION['level']=='user'){
		$queryCabang 		= mysql_query("SELECT SUM(stock) AS stock FROM `m_stock` where code_product = '$produk'");
		$sqlCabang			= mysql_fetch_array($queryCabang);
		$stokDB				= $sqlCabang['stock'];
	}
	else{
		$queryCabang 		= mysql_query("SELECT * FROM `m_stock` where code_product = '$produk' and `id_sub_office` = $cabang");
		$sqlCabang			= mysql_fetch_array($queryCabang);
		$stokDB				= $sqlCabang['stock'];
	}

	if(isset($save_product)){
		if($qty > $stokDB){
			alert('Stok Tidak Cukup');	
		}else{

			// check for double product
			$res_double_product = mysql_query("SELECT id_detail_transaction AS id_detail FROM m_detail WHERE code_transaction = '$kode_transaction' AND code_product = '$produk' AND id_sub_office = '$cabang'");
			$nmr_double_product = mysql_num_rows($res_double_product);

			if($nmr_double_product==0){
				$simpan_pro = mysql_query("INSERT INTO `m_detail_transaction` values('','$kode_transaction','$produk','$qty','ok','$cabang',CURRENT_TIMESTAMP,'1')");
			}
			else{
				$simpan_pro = mysql_query("UPDATE `m_detail_transaction` SET quantity_detail_transaction = (quantity_detail_transaction	+ $qty) WHERE code_transaction = '$kode_transaction' AND code_product = '$produk' AND id_sub_office = '$cabang'");
			}

			// ini buat apa?
			$x = $qty * $harga;
		}
	}
?>
