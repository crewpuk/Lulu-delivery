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

$q = mysql_query("SELECT code_product AS id,name_product AS nama,group_product AS product,price_product AS harga FROM m_product");

while($data = mysql_fetch_assoc($q)){
	$data_all[] = $data;
}

$json['items'] = $data_all;

echo json_encode($json);
?>
