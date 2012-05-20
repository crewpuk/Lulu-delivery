<?php
$json = array("identifier"=>"id");
$data_all = array();
include "../configuration/config.php";

$sumquery = "(";
$q_so = mysql_query("SELECT * FROM m_sub_office");
$j=0;
while($a_so = mysql_fetch_array($q_so)){
	if($j>0){
		$sumquery .= "+";
	}
	$no=$j+1;
	$sumquery .= "(SELECT stock FROM m_stock WHERE id_sub_office = '".$a_so['id_sub_office']."' AND code_product = id)";
	$j++;
}
$sumquery .= ")";
//echo($str4query);

$q = mysql_query("SELECT code_product AS id,CONCAT(name_product, ' - ', size_product,' [ Stok : ',$sumquery,' ]') AS nama,group_product AS product,price_product AS harga FROM m_product WHERE status_product = '1'");

while($data = mysql_fetch_assoc($q)){
	$data_all[] = $data;
}

$json['items'] = $data_all;

echo json_encode($json);
?>
