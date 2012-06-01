<?php
include "../configuration/config.php";
$json2 = array("identifier" => "code");
$json = array();
$res = mysql_query("SELECT DISTINCT(code_transaction) code FROM m_detail_transaction WHERE id_sub_office = '0'");
while($data = mysql_fetch_array($res)){
	$json[] = array("code"=>$data['code']);
}
$json2['items'] = $json;
echo json_encode($json2);
?>