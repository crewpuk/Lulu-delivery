<?php
include("../../configuration/config.php");
?>
<form action="" method="post">
	<button dojoType="dijit.form.Button">Per Hari</button>
	<button dojoType="dijit.form.Button">Per bulan</button>
	&emsp;&emsp;
	<div style="float: right; width: 50%" align="right">
	Filter:
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					name="first"
					
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" />
	S/D 
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					name="last"
					
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" /></div><br /><br />
	<table border="1" cellspacing="0" cellpadding="0" width="100%">  
		<tr>
			<td>ewruherf</td>
			<td>ewruherf</td>
		</tr>
	</table>
</form>
