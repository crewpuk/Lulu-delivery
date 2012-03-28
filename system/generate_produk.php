<?php

/*
 * {
	identifier:"id",
	items: [{
		"id":"1",
		"nama":"Feldy",
		"product":"SUSU",
		"harga":"1000"
	}, {
		"id":"2",
		"nama":"Rian",
		"product":"SESE",
		"harga":"100"
	}]
}
*/

$json = array("identifier"=>"id");
$data_all = array();
include "../configuration/config.php";

$str4query = "";
$q_so = mysql_query("SELECT * FROM m_sub_office");
$j=0;
while($a_so = mysql_fetch_array($q_so)){
	if($j>0)$str=", ' : '";
	else $str="";
	$str4query .= $str.", (SELECT stock FROM m_stock WHERE id_sub_office = '".$a_so['id_sub_office']."' AND code_product = id)";
	$j++;
}
//echo($str4query);

$q = mysql_query("SELECT code_product AS id,CONCAT(name_product, ' - ', size_product,' ['$str4query,']') AS nama,group_product AS product,price_product AS harga FROM m_product WHERE status_product = '1'");

while($data = mysql_fetch_assoc($q)){
	$data_all[] = $data;
}

$json['items'] = $data_all;

echo json_encode($json);
?>
