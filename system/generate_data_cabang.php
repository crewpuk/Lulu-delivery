<?php
$json = array("identifier"=>"id_sub_office");
$data_all = array();
include "../configuration/config.php";

$sql = mysql_query("SELECT * FROM m_sub_office");


while($data = mysql_fetch_assoc($sql)){
	$data_all[] = $data;
}

$json['items'] = $data_all;
echo json_encode($json);
?>
