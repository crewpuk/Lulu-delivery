<form id="form1" name="form1" method="post" action="system/simpan.php">
  <table align="center" width="424" border="0" celspacing="3" celpadding="3">
    <tr>
      <td colspan="3" class="align2" align="center">Input Customer</td>
    </tr>
    <tr>
      <td width="109">Kode Customer</td>
      <td width="5">:</td>
      <td width="296">
		<input dojoType="dijit.form.ValidationTextBox" 
		required="true" 
		class="myTextField"
		name="kode_cust" 
		id="kode_cust" />
	  </td>
    </tr>
    <tr>
      <td>Nama Customer</td>
      <td>:</td>
      <td>
		  <input dojoType="dijit.form.ValidationTextBox" 
			class="myTextField" required="true" 
			name="nama_cust" 
			id="nama_cust" />
	  </td>
    </tr>
    <tr>
      <td valign="top">Alamat</td>
      <td valign="top">:</td>
      <td>
		  <input dojoType="dijit.form.SimpleTextarea" 
			name="alamat_cust" 
			id="alamat_cust" 
			cols="18" 
			rows="5">
      </td>
    </tr>
    <tr>
      <td>Kode Pos</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" 
			class="myTextField" 
			name="kodePos_cust" 
			id="kodePos_cust" /></td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" class="myTextField"  name="tlp_cust" id="tlp_cust" /></td>
    </tr>
    <tr>
      <td>Telepon Rumah</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" class="myTextField"  name="tlp_rmh_cust" id="tlp_rmh_cust" /></td>
    </tr>
    <tr>
      <td>Website</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" class="myTextField"   name="web_cust" id="web_cust" /></td>
    </tr>
    <tr>
      <td>Email Sales</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" class="myTextField"  regExp="[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" name="email_cust" id="email_cust" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td><select dojoType="dijit.form.ComboBox" class="myTextField"  name="status_cust" id="status_cust">
        <option value="1" selected="selected">Aktif</option>
        <option value="0">Non Aktif</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><button  dojoType="dijit.form.Button" type="submit" name="simpan_customer" id="simpan_customer">Simpan</button>
        <button  dojoType="dijit.form.Button" type="reset" name="button2" id="button2">Reset</button></td>
    </tr>
  </table>
</form>
