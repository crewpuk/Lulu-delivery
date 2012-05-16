<?php
	include ('../../configuration/config.php');
	$show = $_GET['s'];
	$cd_customer = $_GET['c'];
	$data_customer = mysql_fetch_array(mysql_query("SELECT * FROM m_customer WHERE code_customer = '$cd_customer'"));
?>
<html>
<head>
	<title><?php echo $show;?> Produk Favorite <?php echo $data_customer['name_customer'];?></title>
</head>
<body>
	<h3 align="center"><?php echo $show;?> Produk Favorite <?php echo $data_customer['name_customer'];?></h3>
	<table border='1' cellpadding='2' cellspacing='0' align='center' width='450'>
		<tr>
			<th>No.</th>
			<th>Nama Produk</th>
			<th>Ukuran</th>
			<th>Jumlah Beli</th>
		</tr>
		<?php
		$res_profav = mysql_query("SELECT name_product AS product,size_product AS size,SUM(quantity_detail_transaction) AS most_bought FROM m_detail_transaction AS A INNER JOIN m_transaction AS B ON A.code_transaction = B.code_transaction INNER JOIN m_product AS C ON A.code_product = C.code_product WHERE B.code_customer = '$cd_customer' GROUP BY A.code_product ORDER BY most_bought DESC LIMIT $show");
		$num_profav = mysql_num_rows($res_profav);
		if($num_profav>0){
			$no=0;
			while($data_profav = mysql_fetch_array($res_profav)){
			$no++;
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $data_profav['product'];?></td>
			<td><?php echo $data_profav['size'];?></td>
			<td><?php echo $data_profav['most_bought'];?></td>
		</tr>
		<?php
			}
		}
		else{
		?>
		<tr>
			<td colspan="4" align="center"><h3 style="margin:0px;color:#b50000;">Tidak Ada Data Produk Favorit.</h3></td>
		</tr>
		<?php
		}?>
	</table>
</body>
</html>