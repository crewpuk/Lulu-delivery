<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.align2 {
	text-align: center;
	font-weight: bold;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="system/simpan.php">
  <table width="424" border="0">
    <tr>
      <td colspan="3" class="align2">Input Customer</td>
    </tr>
    <tr>
      <td width="109">Kode Customer</td>
      <td width="5">:</td>
      <td width="296"><input type="text" name="kode_cust" id="kode_cust" /></td>
    </tr>
    <tr>
      <td>Nama Customer</td>
      <td>:</td>
      <td><input type="text" name="nama_cust" id="nama_cust" /></td>
    </tr>
    <tr>
      <td valign="top">Alamat</td>
      <td valign="top">:</td>
      <td><textarea name="alamat_cust" id="alamat_cust" cols="30" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Kode Pos</td>
      <td>:</td>
      <td><input type="text" name="kodePos_cust" id="kodePos_cust" /></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td><input type="text" name="tlp_cust" id="tlp_cust" /></td>
    </tr>
    <tr>
      <td>HP</td>
      <td>:</td>
      <td><input type="text" name="hp_cust" id="hp_cust" /></td>
    </tr>
    <tr>
      <td>Website</td>
      <td>:</td>
      <td><input type="text" name="web_cust" id="web_cust" /></td>
    </tr>
    <tr>
      <td>Email Sales</td>
      <td>:</td>
      <td><input type="text" name="email_cust" id="email_cust" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td><select name="status_cust" id="status_cust">
        <option value="1" selected="selected">Visible</option>
        <option value="0">Invisible</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="simpan_customer" id="simpan_customer" value="Save" />
        <input type="reset" name="button2" id="button2" value="Reset" /></td>
    </tr>
  </table>
</form>
</body>
</html>