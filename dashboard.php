<?php
@session_start();
if(empty($_SESSION['username']) || empty($_SESSION['password']) || $_SESSION['level'] != 'su_admin')
{
echo"<script>
location='?page=page_login';
</script>";
}
else
{
?>

<div id="divBorder">
		<div dojoType="dijit.layout.AccordionContainer" region="leading" minsize="20" style="margin-right: 10px; width: 200px; height: 200px;">
			<div dojoType="dijit.layout.AccordionPane" selected="true" title="Silahkan Pilih Menu !">
				<div dojoType="dojo.data.ItemFileReadStore" url="tree.json" jsid="storeMenu"/></div>
				<div dojoType="dijit.Tree" id="idTree" store="storeMenu" labelAttr="name" ></div>
			</div>
		</div>
	<div dojoType="dijit.layout.ContentPane" region="top" splitter="true"></div>
	<div dojoType="dijit.layout.ContentPane" id="panelCenter" region="center" splitter="true"></div>
	<div dojoType="dijit.layout.ContentPane" region="bottom" splitter="true"></div>
</div>
<?php } ?>
