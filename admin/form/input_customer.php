<?php
if(!isset($_POST['tambah'])){?>
<form id="inCust1" name="inCust1" method="post" action="">
	<button dojotype="dijit.form.Button" type="submit" name="tambah" id="tambahCust">
		Tambah Customer
	</button>
</form>
<br />
<?php } if(isset($_POST['tambah'])) { ?>
<form id="inCust2" name="inCust2" method="post" action="system/simpan.php">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="3" style="border:solid 1px;">
    <tr>
      <th colspan="3">Input Customer</th>
    </tr>
    <tr>
      <td width="109">Kode Customer</td>
      <td width="5">:</td>
      <td width="296">
		<input dojoType="dijit.form.ValidationTextBox" 
		require="true" 
		name="kode_cust" 
		id="kode_cust" />
	  </td>
    </tr>
    <tr>
      <td>Nama Customer</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" name="nama_cust" id="nama_cust" /></td>
    </tr>
    <tr>
      <td valign="top">Alamat</td>
      <td valign="top">:</td>
      <td>
		  <input dojoType="dijit.form.SimpleTextarea" 
		require="true"
        name="alamat_cust" 
		id="alamat_cust" 
		cols="30" 
		rows="5">
      </td>
    </tr>
    <tr>
      <td>Kode Pos</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="kodePos_cust" id="kodePos_cust" /></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="tlp_cust" id="tlp_cust" /></td>
    </tr>
    <tr>
      <td>Telepon Rumah</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="tlp_rmh_cust" id="tlp_rmh_cust" /></td>
    </tr>
    <tr>
      <td>Website</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="web_cust" id="web_cust" /></td>
    </tr>
    <tr>
      <td>Email Sales</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="email_cust" id="email_cust" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td><select name="status_cust" id="status_cust">
        <option value="1" selected="selected">Aktif</option>
        <option value="0">Tidak Aktif</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
		<button dojotype="dijit.form.Button" type="submit" name="simpan_customer" id="simpan_customer">
		Save
		</button>
		<button dojotype="dijit.form.Button" type="reset" name="reset" id="reset">
		Reset
		</button>
	</td>
    </tr>
  </table>
</form>
<br />
<?php } if(isset($_GET['ubah'])){} ?>
<form form name="form1" method="post" action="">
	<table width="100%" border="1" cellspacing="0" cellpadding="10">
		<tr>
			<td>
				Cari Berdasarkan:
				<select name="cariCust" >
					<option value="code_customer">Kode Customer</option>
					<option value="name_customer">Nama Customer</option>
				</select>
				<button type="submit" dojoType="dijit.form.Button" name="btnCariCust">Cari</button>
				<a href="#" >Lihat Semua</a>
			</td>
		</tr>
		<?php
			$keywordCust = $_POST['cariCust'];
			if($keywordCust != null){
				if($keywordCust == 'code_customer'){
					$sql = "SELECT * FROM `m_customer` where `code_customer` = ";
				}
			}
		?>
	</table>
</form>
