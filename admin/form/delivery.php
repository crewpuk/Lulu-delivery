<?php if(!isset($_POST['tambah']) and !isset($_GET['ubah'])) { ?>
<form name="form1" method="post" action="">
  <button dojoType="dijit.form.Button" type="submit" name="tambah" id="tambah">Tambah Deliveryman</button>
</form>
<?php } if(isset($_POST['tambah']) and !isset($_GET['ubah'])) { ?>
<form name="form2" method="post" action="">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Tambah Deliveryman</th>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Identitas</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="No. Identitas" name="identitas" id="identitas"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Deliveryman</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="Nama Deliveryman" name="nama" id="nama"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Alamat</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.SimpleTextarea" 
		placeHolder="Alamat"
        require="true"
        name="alamat" 
		id="alamat" 
		cols="30" 
		rows="5"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Telp / HP</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="No. Telp / HP" name="telepon" id="telepon"></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding: 5px;">
      <button dojoType="dijit.form.Button" type="submit" name="tambahkan" id="tambahkan">Save</button>
        <button dojotype="dijit.form.Button" type="reset" name="reset" id="reset1"> Reset </button></td>
    </tr>
  </table>
</form>
<br />
<?php } if(isset($_GET['ubah'])) { ?>
<form name="form3" method="post" action="">
<?php 
$id = isset($_GET['no'])?$_GET['no']:"";
$sqlUbah = "SELECT * FROM `m_delivery` Where `id_delivery` = '$id'";
$dataUbah = @mysql_fetch_array(mysql_query($sqlUbah)) or die('Query Salah - >'.mysql_error());
?>
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Ubah Deliveryman</th>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Identitas</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="No. Identitas" name="identitas_upd" id="identitas_upd" value="<?php echo $dataUbah['identity_delivery']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Deliveryman</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Deliveryman" name="nama_upd" id="nama_upd" value="<?php echo $dataUbah['name_delivery']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Alamat</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.SimpleTextarea" 
		placeHolder="Alamat"
        require="true"
        name="alamat_upd" 
		id="alamat_upd" 
		cols="30" 
		rows="5"
        value="<?php echo $dataUbah['address_delivery']; ?>"
        ></td>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Telp / HP</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="No. Telp / HP" name="telepon_upd" id="telepon_upd" value="<?php echo $dataUbah['phone_delivery']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Status</td>
      <td style="padding: 5px;"><select dojoType="dijit.form.Select" style="width: 110px;" name="status" id="status">
        <option value="1" <?php if($dataUbah['status_delivery'] == '1'){echo "selected";}?>>Aktif</option>
        <option value="0" <?php if($dataUbah['status_delivery'] == '0'){echo "selected";}?>>Tidak Aktif</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding: 5px;">
      <button dojoType="dijit.form.Button" type="submit" disabled="disabled" name="ubah" id="editDelivery">Update</button>
      <button dojotype="dijit.form.Button" type="reset"  disabled="disabled" name="reset" id="resetDelivery"> Reset </button>
      <input dojoType="dijit.form.CheckBox" id="enableEditDelivery"/> Ubah Data Ini ?
    </td>
    </tr>
  </table>
</form>
<br />
<?php } ?>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
      <?php
  $sql = "SELECT * FROM `m_delivery`";
  
  //echo $sql;
  $exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
  
  $num = mysql_num_rows($exeSQL);
  if($num == 0){
  echo "<font color='#FF0000'>Data Tidak Ditemukan</font>";
  }else{
  $i = 0;
	  ?>
      <tr>
        <th style="padding: 5px;">No</th>
        <th style="padding: 5px;">No. Identitas</th>
        <th style="padding: 5px;">Nama Deliveryman</th>
        <th style="padding: 5px;">Alamat</th>
        <th style="padding: 5px;">No. Telp / HP</th>
        <th style="padding: 5px;">Status</th>
        <th style="padding: 5px;" colspan="2">Tindakan</th>
      </tr>
      <?php
  
  while($data = mysql_fetch_array($exeSQL)){
  $i++;
  //echo $batas;
  //echo $offset;
  if($i%2==0){ $bg='#ececec'; }else{ $bg='#f5f5f5'; }
  ?>
      <tr bgcolor="<?php echo $bg; ?>" class="linkBorder">
        <td align="center" style="padding: 5px;"><?php echo $i; ?></td>
        <td align="center" style="padding: 5px;"><?php echo $data['identity_delivery']; ?></td>
        <td style="padding: 5px;"><?php echo $data['name_delivery']; ?></td>
        <td style="padding: 5px;"><?php echo nl2br($data['address_delivery']); ?></td>
        <td align="center" style="padding: 5px;"><?php echo $data['phone_delivery']; ?></td>
        <td align="center" style="padding: 5px;">
		<?php 
		$status = $data['status_delivery'];
		if($status == 0){ echo "<span style='color: #9e3f3f;'>Tidak Aktif</span>"; }
		elseif($status == 1){ echo "<span style='color: #3f679e;'>Aktif</span>"; }		
		?>
        </td>
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=delivery&ubah&no=<?php echo $data['id_delivery']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="ubah" title="Ubah"></a></td>
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=delivery&hapus&no=<?php echo $data['id_delivery']; ?>"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
      </tr>
      <?php } } ?>
</table>

<?php
//CRUD
	$identitas 			= $_POST['identitas'];
	$nama 				= $_POST['nama'];
	$alamat 			= $_POST['alamat'];
	$telepon			= $_POST['telepon'];
	
	$identitas_upd 		= $_POST['identitas_upd'];
	$nama_upd 			= $_POST['nama_upd'];
	$alamat_upd 		= $_POST['alamat_upd'];
	$telepon_upd		= $_POST['telepon_upd'];
	$status				= $_POST['status'];
	
	$id = $_GET['no'];

	//Proses Simpan	
	if(isset($_POST['tambahkan'])){
		$q = "INSERT INTO `m_delivery` Values('','$identitas','$nama','$alamat','$telepon','1')";	
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			alert('Data Berhasil Disimpan');
			location('index.php?page=dashboard&sub=delivery');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=delivery');
		}
	}

	//Proses Ubah	
	if(isset($_POST['ubah'])){
		$q = "UPDATE `m_delivery` SET `identity_delivery` = '$identitas_upd', `name_delivery` = '$nama_upd', `address_delivery` = '$alamat_upd', `phone_delivery` = '$telepon_upd', `status_delivery` = '$status'  Where `id_delivery` = '$id'";
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			location('index.php?page=dashboard&sub=delivery');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=delivery');
		}
	}

	//Proses Hapus	
	if(isset($_GET['hapus'])){
		$q = "DELETE FROM `m_delivery`  Where `id_delivery` = '$id'";
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			location('index.php?page=dashboard&sub=delivery');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=delivery');
		}
	}

?>