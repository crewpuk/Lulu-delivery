<?php
if(!isset($_POST['tambah'])){?>
<form id="inCust1" name="inCust1" method="post" action="">
	<button dojotype="dijit.form.Button" type="submit" name="tambah" id="tambahCust">
		Tambah Customer
	</button>
</form>
<br />
<?php } if(isset($_POST['tambah'])) { ?>
<form id="inCust2" name="inCust2" method="post" action="">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="3" style="border:solid 1px;">
    <tr>
      <th colspan="3">Input Customer</th>
    </tr>
	<?php

		$sql = "SELECT * FROM `m_customer` ORDER BY code_customer DESC LIMIT 0 , 1";
		$exSql2 = mysql_query($sql);
		$arrExSql2 = mysql_fetch_array($exSql2);
		$num = mysql_num_rows($exSql2);
		$kodeCustArr = $arrExSql2['code_customer']; 
			if($num == null){
				$code_cust = 'CD00001';
			}else{
				$parsing = intval(str_replace('CD','',$kodeCustArr));
				$nol = '';
				for($i=strlen($parsing); $i<5; $i++){
					$nol .= '0';
					
				}
				$code_cust = 'CD'.$nol.($parsing + 1);
			}

	?>
    <tr>
      <td width="109">Kode Customer</td>
      <td width="5">:</td>
      <td width="296">
		<input dojoType="dijit.form.ValidationTextBox" 
		require="true"
		readonly="readonly"
		name="kode_cust"
		value="<?php echo $code_cust; ?>"
		id="kode_cust" />
	  </td>
    </tr>
    <tr>
      <td>Nama Customer</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" name="nama_cust" id="nama_cust" /></td>
    </tr>
    <tr>
      <td>No. Tanda Pengenal(KTP/SIM/PASSPORT)</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" name="no_pengenal" id="no_pengenal" /></td>
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
      <td>Kota</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="kota_cust" id="kota_cust" /></td>
    </tr>
    <tr>
      <td>Provinsi</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="provinsi_cust" id="provinsi_cust" /></td>
    </tr>
    <tr>
      <td>Kode Pos</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="kodePos_cust" id="kodePos_cust" /></td>
    </tr>
    <tr>
      <td>No. Hp</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="tlp_cust" id="tlp_cust" /></td>
    </tr>
    <tr>
      <td>No. Telepon Rumah</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="tlp_rmh_cust" id="tlp_rmh_cust" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="email_cust" id="email_cust" /></td>
    </tr>
    <tr>
      <td>Contact Online</td>
      <td>:</td>
      <td><input dojoType="dijit.form.ValidationTextBox" name="contact_cust" id="contact_cust" /></td>
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
<?php } ?>
<?php
		if(isset($_GET['vwUbah'])){
		$id = $_GET['no'];
		$sql = "SELECT * FROM `m_customer` Where `code_customer` = '$id'";
		$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
		$dataSQL = mysql_fetch_array($exeSQL);
	?>

		
		<form id="inCust3" name="inCust3" method="post" action="">
		<table width="50%" border="0" align="center" cellpadding="5" cellspacing="3" style="border:solid 1px;">
		<tr>
		  <th colspan="3">Ubah Customer</th>
		</tr>
		<tr>
		  <td width="109">Kode Customer</td>
		  <td width="5">:</td>
		  <td width="296">
		  <input 
			name="kode_cust" 
			id="kode_cust1"  disabled="disabled" value="<?php echo $dataSQL['code_customer'];?>" dojoType="dijit.form.ValidationTextBox" 
			require="true" />
			 <label><input dojoType="dijit.form.CheckBox" name="rdKode" id="rdKode" value="ubah" />
			Ubah ?</label>
			<input name="kode2" dojoType="dijit.form.TextBox" type="hidden" id="kode2" value="<?php echo $dataSQL['code_customer']; ?>"> </td>
		</tr>
		<tr>
		  <td>Nama Customer</td>
		  <td>:</td>
		  <td><input name="nama_cust" id="nama_cust1" value="<?php echo $dataSQL['name_customer'];?>" dojoType="dijit.form.ValidationTextBox" require="true" /></td>
		</tr>
		<tr>
		  <td>No. Tanda Pengenal(KTP/SIM/PASSPORT)</td>
		  <td>:</td>
		  <td><input name="no_pengenal" id="no_pengenal1" value="<?php echo $dataSQL['pengenal_customer'];?>" dojoType="dijit.form.ValidationTextBox" require="true" /></td>
		</tr>
		<tr>
		  <td valign="top">Alamat</td>
		  <td valign="top">:</td>
		  <td>
			  <input
			name="alamat_cust" 
			id="alamat_cust1" value="<?php echo $dataSQL['address_customer'];?>" dojoType="dijit.form.SimpleTextarea" 
			require="true" 
			cols="30" 
			rows="5">
		  </td>
		</tr>
		<tr>
		  <td>Kota</td>
		  <td>:</td>
		  <td><input name="kota_cust" id="kota_cust1" value="<?php echo $dataSQL['kota_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>Provinsi</td>
		  <td>:</td>
		  <td><input name="provinsi_cust" id="provinsi_cust1" value="<?php echo $dataSQL['provinsi_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>Kode Pos</td>
		  <td>:</td>
		  <td><input name="kodePos_cust" id="kodePos_cust1" value="<?php echo $dataSQL['postal_code_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>No. Hp</td>
		  <td>:</td>
		  <td><input name="tlp_cust" id="tlp_cust1" value="<?php echo $dataSQL['phone_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>No. Telepon Rumah</td>
		  <td>:</td>
		  <td><input name="tlp_rmh_cust" id="tlp_rmh_cust1" value="<?php echo $dataSQL['home_phone_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>Email</td>
		  <td>:</td>
		  <td><input name="email_cust" id="email_cust1" value="<?php echo $dataSQL['email_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>Contact Online</td>
		  <td>:</td>
		  <td><input name="contact_cust" id="contact_cust1" value="<?php echo $dataSQL['contact_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td>Status</td>
		  <td>:</td>
		  <td><select name="status_cust" id="status_cust1">
			<option value="1" <?php if($dataSQL['status_customer'] == '1'){echo "selected";}?>>Aktif</option>
			<option value="0" <?php if($dataSQL['status_customer'] == '0'){echo "selected";}?>>Tidak Aktif</option>
		  </select></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>
			<button dojotype="dijit.form.Button" type="submit" name="edit_customer" id="simpan_customer1">
			Save
			</button>
			<button dojotype="dijit.form.Button" type="reset" name="reset" id="reset1">
			Reset
			</button>
		</td>
		</tr>
	  </table>
	</form>
	<br />
	
<?php } ?>
<div class="e">
<?php
$e = $_GET['e'];
if($e==1){ echo "Data Kurang Lengkap"; }
if($e==2){ echo "Kode Sudah Ada"; }
?>
</div>

<form form name="form1" method="post" action="">
	<?php
		$keywordCust = $_POST['cariCust'];
		$txt = $_POST['txtCariCust'];
	?>
	<table width="100%" border="1" cellspacing="0" cellpadding="10">
		<tr>
			<td colspan="11	">
				Cari Berdasarkan:
				<select name="cariCust" >
					<option value="code_customer" <?php if($were == 'code_customer'){echo "selected";}?>>Kode Customer</option>
					<option value="name_customer" <?php if($were == 'name_customer'){echo "selected";}?>>Nama Customer</option>
				</select>
				<input dojoType="dijit.form.TextBox" name="txtCariCust" value="<?php echo $txt;?>" />
				<button type="submit" dojoType="dijit.form.Button" name="btnCariCust">Cari</button>
				<a href="index.php?page=dashboard&sub=input_customer" >Lihat Semua</a>
			</td>
		</tr>
		<?php
			
			if($keywordCust != null){
				if($keywordCust == 'code_customer'){
					$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' and `code_customer` = '$txt' LIMIT 0,15";
				}elseif($keywordCust == 'name_customer'){
					$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' and `name_customer` LIKE '%$txt%' LIMIT 0,15";
				}
			}else{
				$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' LIMIT 0,15";
			}
			$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
			  $i=0;
			  $num = mysql_num_rows($exeSQL);
			  if($num == 0){
			  echo "<font color='#FF0000'>Data Tidak Ditemukan</font>";
			  }else{
		?>
		<tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>No. Pengenal</th>
        <th>Alamat</th>
        <th>No. HP</th>
        <th>No. Telepon Rumah</th>
        <th>Contact Online</th>
        <th>Email</th>
        <th colspan="3">Tindakan</th>
      </tr>
      <?php
		while($data = mysql_fetch_array($exeSQL)){
		$i++;
      ?>
      <tr>
		<td align="center"><?php echo $i;?></td>
		<td><?php echo $data['code_customer'];?></td>
		<td><?php echo $data['name_customer'];?></td>
		<td><?php echo $data['pengenal_customer'];?></td>
		<td><?php echo $data['address_customer'].", ".$data['kota_customer'].", ".$data['provinsi_customer'].", ".$data['postal_code_customer'];?></td>
		<td><?php echo $data['phone_customer'];?></td>
		<td><?php echo $data['home_phone_customer'];?></td>
		<td><?php echo $data['contact_customer'];?></td>
		<td><?php echo $data['email_customer'];?></td>
		<td align="center"><a href="index.php?page=dashboard&sub=input_customer&vwUbah&no=<?php echo $data['code_customer']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="vwUbah" title="Ubah"></a></td>
        <td align="center"><a href="index.php?page=dashboard&sub=input_customer&hapus&no=<?php echo $data['code_customer']; ?>"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
        <td align="center">
			<a href="#" onclick="window.open('form/print_customer.php?id=<?php echo $data['code_customer']; ?>','Cetak','width=800,height=700,scrollbars=yes');"><img src="<?php echo BASE; ?>images/32x32/printer.png" width="16" height="16" alt="cetak" title="Cetak" /></a>
        </td>
      </tr>
		<?php } } ?>
	</table>
</form>

<?php
//CRUD
//cek code customer
$sqlDB = mysql_fetch_array(mysql_query("SELECT * FROM `m_customer`"));
$kodeDB = $sqlDB['code_customer'];

		
		$kode		= $_POST['kode_cust'];
		$nama 		= $_POST['nama_cust'];
		$pengenal 	= $_POST['no_pengenal'];
		$alamat		= $_POST['alamat_cust'];
		$kota		= $_POST['kota_cust'];
		$provinsi	= $_POST['provinsi_cust'];
		$kode_pos	= $_POST['kodePos_cust'];
		$hp 		= $_POST['tlp_cust'];
		$tlpRmh		= $_POST['tlp_rmh_cust'];
		$contact	= $_POST['contact_cust'];
		$email 		= $_POST['email_cust'];	
		$status 	= $_POST['status_cust'];
// Proses Simpan Customer
if(isset($_POST['simpan_customer'])){
		if($kode == null || $nama == null || $pengenal == null || $kota == null || $hp == null){
		location('index.php?page=dashboard&sub=input_customer&e=1');
	}elseif($kode==$kodeDB){
		location('index.php?page=dashboard&sub=input_customer&e=2');
	}else{
		$x = mysql_query("INSERT INTO `m_customer` values('$kode','$nama','$pengenal','$alamat','$kota','$provinsi','$kode_pos','$hp','$tlpRmh','$contact','$email','1')") or die("Salah Query Simpan".mysql_error());

		 if($x){
			alert('Data Berhasil Disimpan');
			location('index.php?page=dashboard&sub=input_customer');
		 }else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=input_customer');	 
		 }}
}elseif(isset($_GET['hapus'])){
	$id = $_GET['no'];
	$sql = "UPDATE `m_customer` SET `status_customer` = '0' Where `code_customer` = '$id'";
	$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
	if($ex){
	location('index.php?page=dashboard&sub=input_customer');	
	}else{
	alert('Terjadi Kesalahan Pada Server');
	location('index.php?page=dashboard&sub=input_customer');
	}
}elseif(isset($_POST['edit_customer'])){
	if($_POST['rdKode'] == 'ubah'){
		$kode = $_POST['kode_cust'];
		}else{
		$kode = $_POST['kode2'];
		}
		
	if($kode == $kodeDB){
		location('index.php?page=dashboard&sub=input_customer&e=2');
	}else{
		$sql = "UPDATE `m_customer` SET
		`code_customer` 	= '$kode',
		`name_customer` 	= '$nama',
		`pengenal_customer` = '$pengenal',
		`address_customer`	= '$alamat',
		`kota_customer` 	= '$kota',
		`provinsi_customer` = '$provinsi',
		`postal_code_customer` = '$kode_pos',
		`phone_customer` = '$hp',
		`home_phone_customer` = '$tlpRmh',
		`contact_customer` = '$contact',
		`email_customer` = '$email',
		`status_customer` = '$status'
		Where `code_customer` = '$id'
		";
		$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
			if($ex){
			location('index.php?page=dashboard&sub=input_customer');	
			}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=input_customer');
			}
	}
} 
?>
