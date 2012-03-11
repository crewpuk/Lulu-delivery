<?php
include("../configuration/config.php");
$genSo = $_GET['genso'];
$sql = "SELECT m_detail_transaction.*,
					m_product.name_product,
					m_product.price_product AS harga,
					(m_detail_transaction.quantity_detail_transaction * m_product.price_product) AS totalHarga 
					FROM m_detail_transaction,m_product
					where m_detail_transaction.code_transaction = 
					'".$genSo."' AND m_product.code_product = m_detail_transaction.code_product";
					
$cek = mysql_query($sql)  or die("query product salah".mysql_error());
//echo $sql;

$json = array();
while($data = mysql_fetch_assoc($cek)){
	$json[] = $data;
}
echo json_encode($json);
?>
