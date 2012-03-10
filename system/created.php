<?php
/*
mysql_connect('localhost','root','admin');
mysql_select_db('db_lulu');
*/

include("../configuration/config.php");

	$save_product 	= $_POST['save_product'];
	$code			= $_POST['kode'];
	$produk			= $_POST['produk'];
	$qty			= $_POST['qty'];
	$ket			= $_POST['ket'];
	$sqlDB	 		= mysql_fetch_array(mysql_query("SELECT * FROM `m_product`"));
	$produkDB		= $sqlDB['name_product'];
	if($save_product){
		if(!$produk or !$qty){
			location('../dashboard2.php?p=transaksi&e=1');
		}elseif($produk!=$produkDB){
			location('../dashboard2.php?p=transaksi&e=2');
		}elseif(!is_numeric($qty)){
			location('../dashboard2.php?p=transaksi&e=3');
		}else{
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
	}
?>
