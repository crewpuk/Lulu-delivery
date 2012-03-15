<script type="text/javascript">
function ganti(){
	var kode = document.getElementById('k');
	var ubah1 = document.getElementById('u1');
	
	if(ubah1.checked==true){
		kode.disabled=false;	
	}
}
</script>
<?php if(!isset($_POST['tambah'])) { ?>
<form name="form1" method="post" action="">
  <input type="submit" name="tambah" id="tambah" value="Tambah Produk">
</form>
<br />
<?php } if(isset($_POST['tambah'])) { ?>
<form name="form2" method="post" action="">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th colspan="2">Tambah Produk</th>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Kode Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Kode Produk" name="kode" id="kode"></td>
    </tr>
    <tr>
      <td>Grup Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" placeHolder="Grup Produk" name="grup" id="grup"></td>
    </tr>
    <tr>
      <td>Nama Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Produk" name="nama" id="nama"></td>
    </tr>
    <tr>
      <td>Ukuran Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Ukuran Produk" name="ukuran" id="ukuran"></td>
    </tr>
    <tr>
      <td>Stok</td>
      <td><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Stok" name="stok" id="stok"></td>
    </tr>
    <tr>
      <td>Harga Barang</td>
      <td><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Harga Barang" name="harga" id="harga"></td>
    </tr>
    <tr>
      <td colspan="2">
      <button dojoType="dijit.form.Button" type="submit" name="tambahkan" id="tambahkan">Tambah</button>
      </td>
    </tr>
  </table>
</form>
<br />
<?php } if(isset($_GET['ubah'])) { ?>
<form name="form3" method="post" action="">
<?php
$id = $_GET['no'];
$sql = "SELECT * FROM `m_product` Where `code_product` = '$id'";
$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
$dataSQL = mysql_fetch_array($exeSQL);
?>
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th colspan="2">Ubah Produk</th>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Kode Produk</td>
      <td><input name="kode" type="text" disabled="disabled" id="k" value="<?php echo $dataSQL['code_product']; ?>" size="29" require="true" placeHolder="Kode Produk">
      <label><input type="radio" name="ubah1" id="u1" value="ubah" onClick="javascript:ganti();">
      Ubah ?</label>
      <input name="kode2" type="hidden" id="kode2" value="<?php echo $dataSQL['code_product']; ?>"></td>
    </tr>
    <tr>
      <td>Grup Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" placeHolder="Grup Produk" name="grup" id="grup" value="<?php echo $dataSQL['group_product']; ?>"></td>
    </tr>
    <tr>
      <td>Nama Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Produk" name="nama" id="nama" value="<?php echo $dataSQL['name_product']; ?>"></td>
    </tr>
    <tr>
      <td>Ukuran Produk</td>
      <td><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Ukuran Produk" name="ukuran" id="ukuran" value="<?php echo $dataSQL['size_product']; ?>"></td>
    </tr>
    <tr>
      <td>Stok</td>
      <td><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Stok" name="stok" id="stok" value="<?php echo $dataSQL['stock_product']; ?>"></td>
    </tr>
    <tr>
      <td>Harga Barang</td>
      <td><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Harga Barang" name="harga" id="harga" value="<?php echo $dataSQL['price_product']; ?>"></td>
    </tr>
    <tr>
      <td colspan="2"><button dojoType="dijit.form.Button" type="submit" name="ubah" id="ubah">Ubah</button></td>
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
<form name="form1" method="post" action="">
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
      <tr>
        <td colspan="9">Cari Nama Produk
          <input type="text" placeHolder="Nama Produk" name="txtkey" id="txtkey">
          <input type="submit" name="cmdcari" id="cmdcari" value="Cari">
          <a href="index.php?page=dashboard&sub=product">Lihat Semua</a></td>
      </tr>
      <?php
      $keyword = $_POST['txtkey'];
  if($keyword != null){
  $sql = "SELECT * FROM `m_product` Where `name_product` LIKE '%$keyword%' LIMIT 0,15";	  
  }else{
  $sql = "SELECT * FROM `m_product` LIMIT 0,15";
  }
  $exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
  $i=0;
  $num = mysql_num_rows($exeSQL);
  if($num == 0){
  echo "<font color='#FF0000'>Data Belum Ditemukan</font>";
  }else{
	  ?>
      <tr>
        <th>No</th>
        <th>Kode Produk</th>
        <th>Grup Produk</th>
        <th>Nama Produk</th>
        <th>Ukuran Produk</th>
        <th>Stok</th>
        <th>Harga Barang</th>
        <th colspan="2">Tindakan</th>
      </tr>
      <?php
  while($data = mysql_fetch_array($exeSQL)){
  $i++;
  ?>
      <tr>
        <td align="center"><?php echo $i; ?></td>
        <td><?php echo $data['code_product']; ?></td>
        <td><?php echo $data['group_product']; ?></td>
        <td><?php echo $data['name_product']; ?></td>
        <td align="center"><?php echo $data['size_product']; ?></td>
        <td align="center"><?php echo $data['stock_product']; ?></td>
        <td>Rp. <?php echo number_format($data['price_product'],0,',','.'); ?></td>
        <td align="center"><a href="index.php?page=dashboard&sub=product&ubah&no=<?php echo $data['code_product']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="ubah" title="Ubah"></a></td>
        <td align="center"><a href="index.php?page=dashboard&sub=product&hapus&no=<?php echo $data['code_product']; ?>"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
      </tr>
      <?php } } ?>
    </table>
</form>
<?php
if(isset($_POST['ubah1'])){
$kode = $_POST['kode'];
}else{
$kode = $_POST['kode2'];
}
$grup = $_POST['grup'];
$nama = $_POST['nama'];
$ukur = $_POST['ukuran'];
$stok = $_POST['stok'];
$hrga = $_POST['harga'];
$sqlDB = mysql_fetch_array(mysql_query("SELECT * FROM `m_product`"));
$kodeDB = $sqlDB['code_product'];
$id = $_GET['no'];
//Proses Tambah Produk
if(isset($_POST['tambahkan'])){
	$kode = $_POST['kode'];
	if($kode == null || $nama == null || $ukur == null || $stok == null || $hrga == null){
		location('index.php?page=dashboard&sub=product&e=1');
	}elseif($kode==$kodeDB){
		location('index.php?page=dashboard&sub=product&e=2');
	}else{
		$value = array(
		"'$kode'",
		"'$grup'",
		"'$nama'",
		"'$ukur'",
		"'$stok'",
		"'$hrga'",
		"'1'",
		);
		$sql = "INSERT INTO `m_product` Values(".implode(',',$value).")";
		$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
		 if($ex){
			alert('Data Berhasil Disimpan');
			location('index.php?page=dashboard&sub=product');
		 }else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=product');	 
		 }
	}
}
//Proses Hapus
if(isset($_GET['hapus'])){
$sql = "UPDATE `m_product` SET `status_product` = '0' Where `code_product` = '$id'";
$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
	if($ex){
	location('index.php?page=dashboard&sub=product');	
	}else{
	alert('Terjadi Kesalahan Pada Server');
	location('index.php?page=dashboard&sub=product');
	}
}
//Proses Ubah
if(isset($_POST['ubah'])){
	if($_POST['kode']==$kodeDB){
		location('index.php?page=dashboard&sub=product&e=2');
	}else{
		$sql = "UPDATE `m_product` SET
		`code_product` = '$kode',
		`group_product` = '$grup',
		`name_product` = '$nama',
		`size_product` = '$ukur',
		`stock_product` = '$stok',
		`price_product` = '$hrga'
		Where `code_product` = '$id'
		";
		$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
			if($ex){
			location('index.php?page=dashboard&sub=product');	
			}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=product');
			}
	}
}
?>