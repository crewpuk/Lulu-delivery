<?php
if(!empty($_POST)&&isset($_POST['save'])){
	$mailconf_path = "C:/xampp/sendmail/sendmail.ini";

	if(filesize($mailconf_path)==0)echo("Error : sendmail config notfound!");

	$handle = fopen($mailconf_path,"r");
	$mailconf = fread($handle, filesize($mailconf_path));
	fclose($handle);

	$text_auth_username = "auth_username=";
	$text_auth_password = "auth_password=";
	$text_pop3_username = "pop3_username=";
	$text_pop3_password = "pop3_password=";

	$auth_username = fgetsf2eol($mailconf, $text_auth_username);
	$auth_password = fgetsf2eol($mailconf, $text_auth_password);
	$pop3_username = fgetsf2eol($mailconf, $text_pop3_username);
	$pop3_password = fgetsf2eol($mailconf, $text_pop3_password);

	$search=array($auth_username,$auth_password);
	$replace=array($_POST['email_username'],$_POST['email_password']);

	$new_mailconf = str_replace($search, $replace, $mailconf);

	$handle = fopen($mailconf_path,"w");
	fwrite($handle, $new_mailconf);
	fclose($handle);

	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_name']."' WHERE `name` = 'company_name'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_address']."' WHERE `name` = 'company_address'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_phone']."' WHERE `name` = 'company_phone'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_url']."' WHERE `name` = 'company_url'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_email']."' WHERE `name` = 'company_email';");
}


$q_data_perusahaan=mysql_query("SELECT * FROM m_data");
$data_lulu=array();
while($data = mysql_fetch_array($q_data_perusahaan)){
  $index=$data['name'];
  $data_lulu[$index]=$data['value'];
}

$mailconf_path = "C:/xampp/sendmail/sendmail.ini";

if(filesize($mailconf_path)==0)echo("Error : sendmail config notfound!");

$handle = fopen($mailconf_path,"r");
$mailconf = fread($handle, filesize($mailconf_path));
fclose($handle);

$text_auth_username = "auth_username=";
$text_auth_password = "auth_password=";
$text_pop3_username = "pop3_username=";
$text_pop3_password = "pop3_password=";

//$auth_username = substr($mailconf, ($pos_auth_username + strlen($text_auth_username)), ((strpos($mailconf, PHP_EOL, $pos_auth_username))-($pos_auth_username+strlen($text_auth_username))));

$auth_username = fgetsf2eol($mailconf, $text_auth_username);
$auth_password = fgetsf2eol($mailconf, $text_auth_password);
$pop3_username = fgetsf2eol($mailconf, $text_pop3_username);
$pop3_password = fgetsf2eol($mailconf, $text_pop3_password);

//echo("<pre>".get_data("http://127.0.0.1/Lulu-delivery/admin/index.php?page=dashboard&sub=product")."</pre>")
//print_r($_SERVER);
?><form name="data_lulu" method="post" action="" enctype="multipart/form-data">
<table align="center" width="50%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px;">
	<tr>
		<th style="padding:5px;" colspan="2">Data Perusahaan</th>
	</tr>
	<tr>
		<td style="padding:5px;" valign="top">Nama Perusahaan</td>
		<td style="padding:5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" name="company_name" id="company_name" value="<?php echo($data_lulu['company_name']);?>" /></td>
	</tr>
	<tr>
		<td style="padding:5px;" valign="top">Alamat Perusahaan</td>
		<td style="padding:5px;"><textarea dojoType="dijit.form.SimpleTextarea" require="true" name="company_address" id="company_address" cols="30" rows="2" /><?php echo($data_lulu['company_address']);?></textarea></td>
	</tr>
	<tr>
		<td style="padding:5px;" valign="top">Nomor Telepon</td>
		<td style="padding:5px;"><textarea dojoType="dijit.form.SimpleTextarea" require="true" name="company_phone" id="company_phone" cols="30" rows="2"><?php echo($data_lulu['company_phone']);?></textarea></td>
	</tr>
	<tr>
		<td style="padding:5px;" valign="top">Website Perusahaan</td>
		<td style="padding:5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" name="company_url" id="company_url" value="<?php echo($data_lulu['company_url']);?>" /></td>
	</tr>
	<tr>
		<td style="padding:5px;" valign="top">Email Perusahaan</td>
		<td style="padding:5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" name="company_email" id="company_email" value="<?php echo($data_lulu['company_email']);?>" />
			<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td style="padding:5px;">Username email</td>
					<td style="padding:5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" name="email_username" id="email_username" value="<?php echo $auth_username;?>" /></td>
				</tr>
				<tr>
					<td style="padding:5px;">Password email</td>
					<td style="padding:5px;"><input type="password" dojoType="dijit.form.ValidationTextBox" require="true" name="email_password" id="email_password" value="<?php echo $auth_password;?>" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding:5px;"><button dojoType="dijit.form.Button" type="submit" name="save">Save</button><button dojoType="dijit.form.Button" type="reset" name="reset">Reset</button></td>
	</tr>
</table>
</form>