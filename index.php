<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lulu[@]Delivery</title>
<style type="text/css">
.align {
	text-align: center;
	font-weight: bold;
	font-size: 24px;
	font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>
<?php include("configuration/config.php");?>
<body>
<table width="100%" border="0">
  <tr>
    <td colspan="4" class="align">FORM PESANAN PELANGGAN</td>
  </tr>
  <tr>
    <td colspan="4"><strong>SO No: </strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="64%"><strong>Data LULUKID: </strong></td>
    <td width="11%"><strong>Data Pelanggan</strong></td>
    <td width="1%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
  </tr>
  <?php
  	$code = $_POST['txt_search'];
  	$x = mysql_query("SELECT * FROM m_customer where code_customer = '".$code."' ") or die("query Salah".mysql_error());	
  	$ax = mysql_fetch_array($x);
  ?>
  <tr>
    <td>LuluKids</td>
    <td>No. Pelanggan</td>
    <td>:</td>
    <form action="index.php" method="post">
    <td>
    	<input type="text" name="txt_search" id="txt_search" value="<?php echo $code; ?>" />
    	<input type="submit" name="cari" id="cari" value="Cari" />
    </td>
    </form>
  </tr>
  <tr>
    <td><?php echo $ax['address_customer']?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $ax['address_customer']?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $ax['address_customer']?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>