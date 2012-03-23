<?php
	include ('../../configuration/config.php');
	$sql= rawurldecode($_GET['sql']);
	$poslimit = strpos($sql,"LIMIT");
	$possql = strlen($sql);
	$subsql = substr($sql,0,($possql-($possql-$poslimit)));
	echo $subsql;
?>
