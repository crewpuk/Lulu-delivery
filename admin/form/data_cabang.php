<form name="form1" method="post" action="">
<button dojoType="dijit.form.Button" type="submit" name="tambah_cabang" id="tambah_cabang">Tambah Cabang</button>
</form>
<?php if(isset($_POST['tambah_cabang'])) { ?>
<form name="form2" method="post" action="">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Tambah Cabang</th>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Cabang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Cabang" name="nama_cabang" id="nama_cabang"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Email Cabang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="Email Cabang" name="email_cabang" id="email_cabang"></td>
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
$sqlUbah = "SELECT * FROM `m_sub_office` Where `id_sub_office` = '$id'";
$dataUbah = @mysql_fetch_array(mysql_query($sqlUbah)) or die('Query Salah - >'.mysql_error());
?>
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Ubah Cabang</th>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Cabang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="Nama Cabang" name="nama_cabang_upd" id="nama_cabang_upd" value="<?php echo $dataUbah['name_sub_office']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Email Cabang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Email Cabang" name="email_cabang_upd" id="email_cabang_upd" value="<?php echo $dataUbah['email_sub_office']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Status</td>
      <td style="padding: 5px;"><select name="status_c" id="status_c">
        <option value="1" <?php if($dataUbah['status'] == '1'){echo "selected";}?>>Aktif</option>
        <option value="0" <?php if($dataUbah['status'] == '0'){echo "selected";}?>>Tidak Aktif</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding: 5px;">
      <button dojoType="dijit.form.Button" type="submit" name="ubah" id="ubah">Save</button>
        <button dojotype="dijit.form.Button" type="reset" name="reset" id="reset2"> Reset </button></td>
    </tr>
  </table>
</form>
<br />
<?php } ?>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
      <?php
  $sql = "SELECT * FROM `m_sub_office`";
  
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
        <th style="padding: 5px;">Nama Cabang</th>
        <th style="padding: 5px;">Email Cabang</th>
        <th style="padding: 5px;">Status Cabang</th>
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
        <td style="padding: 5px;" align="center"><?php echo $i; ?></td>
        <td style="padding: 5px;" align="center"><?php echo $data['name_sub_office']; ?></td>
        <td style="padding: 5px;" align="center"><?php echo $data['email_sub_office']; ?></td>
        <td style="padding: 5px;" align="center">
		<?php 
		$status = $data['status'];
		if($status == 0){ echo "<span style='color: #9e3f3f;'>Tidak Aktif</span>"; }
		elseif($status == 1){ echo "<span style='color: #3f679e;'>Aktif</span>"; }		
		?>
        </td>
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=data_cabang&ubah&no=<?php echo $data['id_sub_office']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="ubah" title="Ubah"></a></td>
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=data_cabang&hapus&no=<?php echo $data['id_sub_office']; ?>"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
      </tr>
      <?php } } ?>
</table>
<?php
//CRUD
//Proses Simpan

	$nama = $_POST['nama_cabang'];
	$email = $_POST['email_cabang'];
	
	$nama_upd = $_POST['nama_cabang_upd'];
	$email_upd = $_POST['email_cabang_upd'];
	$status = $_POST['status_c'];
	
	$id = $_GET['no'];
	
	if(isset($_POST['tambahkan'])){
		$q = "INSERT INTO `m_sub_office` Values('','$nama','$email','1')";	
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			alert('Data Berhasil Disimpan');
			location('index.php?page=dashboard&sub=data_cabang');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=data_cabang');
		}
	}
	
	if(isset($_POST['ubah'])){
		$q = "UPDATE `m_sub_office` SET `name_sub_office` = '$nama_upd', `email_sub_office` = '$email_upd', `status` = '$status'  Where `id_sub_office` = '$id'";
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			location('index.php?page=dashboard&sub=data_cabang');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=data_cabang');
		}
	}
	
	if(isset($_GET['hapus'])){
		$q = "DELETE FROM `m_sub_office`  Where `id_sub_office` = '$id'";
		$exQ = @mysql_query($q) or die('Query Salah - >'.mysql_error());
		if($q){
			location('index.php?page=dashboard&sub=data_cabang');	
		}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=data_cabang');
		}
	}

?>