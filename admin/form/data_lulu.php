<?php
if(!empty($_POST)&&isset($_POST['save'])){
	$mailconf_path = "C:/xampp/sendmail/sendmail.ini";

	if(filesize($mailconf_path)==0)echo("Error : sendmail config notfound!");

	$new_mailconf = "; configuration for fake sendmail

; if this file doesn't exist, sendmail.exe will look for the settings in
; the registry, under HKLM\Software\Sendmail

[sendmail]

; you must change mail.mydomain.com to your smtp server,
; or to IIS's \"pickup\" directory.  (generally C:\Inetpub\mailroot\Pickup)
; emails delivered via IIS's pickup directory cause sendmail to
; run quicker, but you won't get error messages back to the calling
; application.

smtp_server=smtp.mail.yahoo.co.id 

; smtp port (normally 25)

smtp_port=25

; the default domain for this server will be read from the registry
; this will be appended to email addresses when one isn't provided
; if you want to override the value in the registry, uncomment and modify

;default_domain=local

; log smtp errors to error.log (defaults to same directory as sendmail.exe)
; uncomment to enable logging

error_logfile=error.log

; create debug log as debug.log (defaults to same directory as sendmail.exe)
; uncomment to enable debugging

debug_logfile=debug.log

; if your smtp server requires authentication, modify the following two lines

auth_username=".$_POST['email_username']."
auth_password=".$_POST['email_password']."

; if your smtp server uses pop3 before smtp authentication, modify the 
; following three lines

pop3_server=pop.mail.yahoo.co.id 
pop3_username=".$_POST['email_username']."
pop3_password=".$_POST['email_password']."

; to force the sender to always be the following email address, uncomment and
; populate with a valid email address.  this will only affect the \"MAIL FROM\"
; command, it won't modify the \"From: \" header of the message content

;force_sender=me@localhost

; sendmail will use your hostname and your default_domain in the ehlo/helo
; smtp greeting.  you can manually set the ehlo/helo name if required

;hostname=localhost
";

	$handle = fopen($mailconf_path,"w");
	fwrite($handle, $new_mailconf);
	fclose($handle);

	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_name']."' WHERE `name` = 'company_name'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_address']."' WHERE `name` = 'company_address'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_phone']."' WHERE `name` = 'company_phone'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_url']."' WHERE `name` = 'company_url'");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['company_email']."' WHERE `name` = 'company_email';");
	mysql_query("UPDATE m_data SET `value` = '".$_POST['main_office_email']."' WHERE `name` = 'main_office_email';");
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
		<td style="padding:5px;" valign="top">Email Pusat</td>
		<td style="padding:5px;">Pisahkan dengan titik koma (;) jika terdapat banyak email<br><input dojoType="dijit.form.SimpleTextarea" require="true" name="main_office_email" id="main_office_email" cols="30" rows="2" value="<?php echo($data_lulu['main_office_email']);?>" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding:5px;"><button dojoType="dijit.form.Button" type="submit" name="save">Save</button><button dojoType="dijit.form.Button" type="reset" name="reset">Reset</button></td>
	</tr>
</table>
</form>