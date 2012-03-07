<?php
mysql_connect('localhost','root','root');
mysql_select_db('db_lulu');

	$save_product 	= $_POST['save_product'];
	$code			= $_POST['kode'];
	$produk			= $_POST['produk'];
	$qty			= $_POST['qty'];
	$ket			= $_POST['ket'];
	
	if($save_product){
		$simpan_pro = mysql_query("INSERT INTO `m_detail_transaction` values('','$code','$produk','$qty','$ket','')");
		$x = $qty * $harga;
		if ($simpan_pro){
			echo"<script>
					location='../index.php';
				</script>" ;
		}else{
			echo"gagal";
		}
	}
?>