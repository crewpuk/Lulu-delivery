<?php
	$id = $_GET['id'];
	$halaman = $_GET['halaman'];
	$codeGet = $_GET['txt_search'];
	$wereGet = $_GET['data_cust'];

	//echo "<script>if(confirm('apakah anda ingin keluar')){alert('yes')};</script>";

	if($halaman == 'delete'){
		$del = mysql_query("DELETE FROM `db_lulu`.`m_detail_transaction` WHERE 					`m_detail_transaction`.`id_detail_transaction` = ".$id."");

		if($del){echo"<script>alert('berhasil');</script>";}else{echo"<script>alert('gagal');</script>";}
	}


?>
