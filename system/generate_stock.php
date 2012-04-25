<?php
include "../configuration/config.php";

$query = mysql_query("SELECT m_product.code_product,m_sub_office.id_sub_office FROM m_product,m_sub_office");
$i=0;
while($data = mysql_fetch_array($query)){
	if($i==0)$s=50;
	elseif($i==1)$s=40;
	elseif($i==2)$s=30;
	elseif($i==3)$s=20;
	elseif($i==4){$s=10;$i=-1;}
	$i++;
	mysql_query("INSERT INTO m_stock VALUES('','".$data['code_product']."','".$data['id_sub_office']."','$s',CURRENT_TIMESTAMP)");
}
?>
