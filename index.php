<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8"> 
		<title>Lulu Delivery App</title>
			<style type="text/css">
			@import "lib/dojo/dojo/resources/dojo.css";
			@import "lib/dojo/dijit/themes/claro/claro.css";
			@import "lib/dojo/dijit/themes/tundra/tundra.css";
			@import "lib/dojo/dijit/themes/soria/soria.css";
			@import "lib/dojo/dojox/grid/resources/Grid.css";
			@import "lib/dojo/dojox/grid/resources/claroGrid.css";
			@import "css/lulu.css";
			@import "css/panel.css";
			
			</style>

			<script type="text/javascript">
				var djConfig = { parseOnLoad: true };
			</script>
			
	<script type="text/javascript" src="lib/dojo/dojo/dojo.js"></script>
			<script type="text/javascript" src="js/main.js"></script>
			<script type="text/javascript" src="js/require.js"></script>
	<link href="images/32x32/logo.png" rel="shortcut icon" />
    </head>
	<body class="claro">
	<?php 
		$page = $_GET['page'];
		
		if($page == 'page_login'){
			include("login/login_page.php");
		} /*else if($page == 'dashboard'){
			include("dashboard2.php");
		} else if($page == 'input_customer'){
			include("user/input_customer.php");
		} else if($page == 'transaksi_customer'){
			include("user/transaksi_customer.php");
		}*/
		else{
		include("login/login_page.php");
		}
	?>
	
	</body>
</html>
