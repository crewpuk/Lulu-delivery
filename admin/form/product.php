<?php 
error_reporting(E_ALL);
if(!isset($_POST['tambah'])) { ?>
<form name="form1" method="post" action="">
  <button dojotype="dijit.form.Button" type="submit" name="tambah" id="tambah">
		Tambah Produk
  </button>
</form>
<br />
<?php }

/**
* Import Excel
*/
?>
<script type="text/javascript">
function update_info_product(val){
  if(val!="product"){document.getElementById('info_update_product').innerHTML = "stock cabang";}
  else{document.getElementById('info_update_product').innerHTML = "data";}
}
</script>
<form name="form1" method="post" enctype="multipart/form-data" action="">
  Pilih File : <input type="file" name="excel_file" id="excel_file" /><br />
  Update <span id="info_update_product">data</span> : <select name="id_sub_office" onchange="update_info_product(this.value)">
  <option value='product'>Product</option>
  <?php
  $sub_office_q = mysql_query("SELECT * FROM m_sub_office");
  while($data_sub_office = mysql_fetch_array($sub_office_q)){
    echo "<option value='".$data_sub_office['id_sub_office']."'>".$data_sub_office['name_sub_office']."</option>\n";
  }
  ?>
  </select><br />
  <button dojoType="dijit.form.Button" type="submit" name="tambah_excel" id="tambah_excel">Update Produk</button>
</form>
<br />

<?php if(isset($_POST['tambah_excel'])&&!empty($_FILES['excel_file'])){

require("system/import_product.php");


/**
* End of Import Excel
*/

} if(isset($_POST['tambah'])) { ?>
<form name="form2" method="post" action="">
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="3" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Tambah Produk</th>
    </tr>
    <tr>
      <td style="padding: 5px;" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding: 5px;">Kode Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Kode Produk" name="kode" id="kode"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Grup Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="Grup Produk" name="grup" id="grup"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Produk" name="nama" id="nama"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Ukuran Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Ukuran Produk" name="ukuran" id="ukuran"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Stok</td>
      <td style="padding: 5px;">
      <?php
      $q_soffice = @mysql_query("SELECT * FROM m_sub_office");
        while($a_soffice = @mysql_fetch_array($q_soffice)){
            echo($a_soffice['name_sub_office'].' : <input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Stok '.$a_soffice['name_sub_office'].'" name="stok['.$a_soffice['id_sub_office'].']" id="stok['.$a_soffice['id_sub_office'].']"><br />');
        }
	  ?>
      
      </td>
    </tr>
    <tr>
      <td style="padding: 5px;">Jumlah Satuan</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Jumlah Satuan" name="sum_pcs" id="sum_pcs"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Harga Barang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Harga Barang" name="harga" id="harga"></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding: 5px;">
      <button dojoType="dijit.form.Button" type="submit" name="tambahkan" id="tambahkan">Save</button>
      <button dojotype="dijit.form.Button" type="reset" name="reset" id="reset1">
	  Reset
	  </button>
      </td>
    </tr>
  </table>
</form>
<br />
<?php

} if(isset($_GET['ubah'])) { ?>
<form name="form3" method="post" action="">
<?php
$id = $_GET['no'];
$sql = "SELECT * FROM `m_product` WHERE `code_product` = '$id'";
$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
$dataSQL = mysql_fetch_array($exeSQL);
?>
  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="0" style="border:solid 1px;">
    <tr>
      <th style="padding: 5px;" colspan="2">Ubah Produk</th>
    </tr>
    <tr>
      <td style="padding: 5px;" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding: 5px;">Kode Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" name="kode" type="text" disabled="disabled" id="k" value="<?php echo $dataSQL['code_product']; ?>" size="29" require="true" placeHolder="Kode Produk">
      <label><input dojoType="dijit.form.CheckBox" name="ubah1" id="pdKode" value="ubah" />
			Ubah ?</label>
      <input name="kode2" type="hidden" id="kode2" value="<?php echo $dataSQL['code_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Grup Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" placeHolder="Grup Produk" name="grup" id="grup" value="<?php echo $dataSQL['group_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Nama Produk" name="nama" id="nama" value="<?php echo $dataSQL['name_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Ukuran Produk</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Ukuran Produk" name="ukuran" id="ukuran" value="<?php echo $dataSQL['size_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Stok</td>
      <td style="padding: 5px;">
      <?php
      $q_soffice = @mysql_query("SELECT * FROM m_sub_office");
        while($a_soffice = @mysql_fetch_array($q_soffice)){
            $q_stock = @mysql_query("SELECT * FROM m_stock WHERE code_product = '".$dataSQL['code_product']."' AND id_sub_office = '".$a_soffice['id_sub_office']."'");
            while($a_stock = @mysql_fetch_array($q_stock)){
                echo($a_soffice['name_sub_office'].' : <input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Stok" name="stok['.$a_soffice['id_sub_office'].']" id="stok['.$a_soffice['id_sub_office'].']" value="'.$a_stock['stock'].'"><br />');
            }
        }
	  ?>
      
      
      </td>
    </tr>
    <tr>
      <td style="padding: 5px;">Jumlah Satuan</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.ValidationTextBox" require="true" placeHolder="Jumlah Satuan" name="sum_pcs" id="sum_pcs" value="<?php echo $dataSQL['sum-pcs_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Harga Barang</td>
      <td style="padding: 5px;"><input dojoType="dijit.form.NumberTextBox" require="true" placeHolder="Harga Barang" name="harga" id="harga" value="<?php echo $dataSQL['price_product']; ?>"></td>
    </tr>
    <tr>
      <td style="padding:5px;">Status</td>
      <td style="padding:5px;"><label>
      <input type="radio" name="radYa" id="radio" value="1"<?php if($dataSQL['status_product']=='1'){echo " checked='checked'";}?> />
      Aktif</label>
      <label>
      <input type="radio" name="radYa" id="radio2" value="0"<?php if($dataSQL['status_product']=='0'){echo " checked='checked'";}?> />      
      Tidak Aktif
      </label></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding: 5px;">
      <button dojoType="dijit.form.Button" type="submit" name="ubah" id="ubah">Save</button>
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
$e = (isset($_GET['e']))?$_GET['e']:"";
if($e==1){ echo "Data Kurang Lengkap"; }
if($e==2){ echo "Kode Sudah Ada"; }
?>
</div>
<?php
/************ Fixed Paging ****************/
$cari1 = (isset($_POST['cariPro']))?$_POST['cariPro']:"";
$cari2 = (isset($_GET['cariGet']))?$_GET['cariGet']:"";
$cari3 = "";
	
$key1 = (isset($_POST['txtkey']))?$_POST['txtkey']:"";
$key2 = (isset($_GET['key']))?$_GET['key']:"";
$key3 = "";
    
if($key1){$key3=$key1;}elseif($key2){$key3=$key2;}
if($cari1){$cari3=$cari1;}elseif($cari2){$cari3=$cari2;}
?>
<form name="form1" method="post" action="">
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
      <tr>
        <td colspan="12">Cari Berdasarkan 
          <select name="cariPro" id="cariPro">
          <option value="">--Pilih--</option>
          <option value="grup" <?php if($cari3 == 'grup'){echo "selected";}?>>Grup Produk</option>
          <option value="nama" <?php if($cari3 == 'nama'){echo "selected";}?>>Nama Produk</option>
          </select>
          <input type="text" name="txtkey" id="txtkey" value="<?php echo $key3; ?>">
          <button dojoType="dijit.form.Button" type="submit" name="cmdcari" id="cmdcari">Cari</button>
        <a href="index.php?page=dashboard&sub=product"><img src="<?php echo BASE; ?>images/32x32/book.png" title="Lihat Semua" width="24" height="24" alt="Lihat Semua" style="position: absolute;" /></a></td>
      </tr>
      <?php
	$batas = 10;
	$halaman = isset($_GET['halaman'])?$_GET['halaman']:"";
    
    /********************* Menentukan Offset ******************************/
    if($halaman){
	$noPage = $halaman;
	}else{ $noPage = 1; $halaman = 1; }
	$offset = ($noPage - 1) * $batas;   
    
    /************************** Penomoran Banyak Halaman ************************/
	$i = 0;
    if($halaman == 1){
	$i = 0;
	}else if($halaman > 1){ $i = ($offset + $i); }
  
  if($cari3 == 'grup'){
  $sql = "SELECT * FROM `m_product` WHERE `group_product` LIKE '%$key3%' LIMIT $offset,$batas";	  
  }elseif($cari3 == 'nama'){
  $sql = "SELECT * FROM `m_product` WHERE `name_product` LIKE '%$key3%' LIMIT $offset,$batas";	  
  }else{
  $sql = "SELECT * FROM `m_product` LIMIT $offset,$batas";
  }
  //echo $sql;
  $exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
  
  $num = mysql_num_rows($exeSQL);
  if($num == 0){
  echo "<font color='#FF0000'>Data Tidak Ditemukan</font>";
  }else{
	  ?>
      <tr>
        <th style="padding: 5px;">No</th>
        <th style="padding: 5px;">Kode Produk</th>
        <th style="padding: 5px;">Grup Produk</th>
        <th style="padding: 5px;">Nama Produk</th>
        <th style="padding: 5px;">Ukuran Produk</th>
        <?php
        $q_soffice = @mysql_query("SELECT * FROM m_sub_office ORDER BY id_sub_office");
        while($a_soffice = @mysql_fetch_array($q_soffice)){
          echo('<th align="center" style="padding: 5px;">Stok '.$a_soffice['name_sub_office'].'</th>');
        }
        ?>
        <th style="padding: 5px;">Jumlah Satuan</th>
        <th style="padding: 5px;">Harga Barang</th>
        <th style="padding:5px;" width="77">Status Aktif</th>
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
        <td style="padding: 5px;" align="center"><?php echo $data['code_product']; ?></td>
        <td style="padding: 5px;"><?php echo $data['group_product']; ?></td>
        <td style="padding: 5px;"><?php echo $data['name_product']; ?></td>
        <td style="padding: 5px;" align="center"><?php echo $data['size_product']; ?></td>
        <?php
        $q_soffice = @mysql_query("SELECT * FROM m_sub_office ORDER BY id_sub_office");
        while($a_soffice = @mysql_fetch_array($q_soffice)){
            $q_stock = @mysql_query("SELECT * FROM m_stock WHERE code_product = '".$data['code_product']."' AND id_sub_office = '".$a_soffice['id_sub_office']."'");
            $a_stock = @mysql_fetch_array($q_stock);
            echo('<td align="center" style="padding: 5px;">'.$a_stock['stock'].'</td>');
        }
        ?>
        <td style="padding: 5px;"><?php echo($data['sum-pcs_product']);?></td>
        <td style="padding: 5px;">Rp. <?php echo number_format($data['price_product'],0,',','.'); ?></td>
        <td style="padding:5px;" align="center"><?php if($data['status_product']=='1'){echo"<span style='color: #3f679e;'>Aktif</span>";}else{echo"<span style='color: #9e3f3f;'>Tidak Aktif</span>";}?>&nbsp;
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=product&ubah&no=<?php echo $data['code_product']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="ubah" title="Ubah"></a></td>
        <td style="padding: 5px;" align="center"><a href="index.php?page=dashboard&sub=product&hapus&no=<?php echo $data['code_product']; ?>"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
      </tr>
      <?php } } ?>
    </table>
</form>
<?php
//Paging
  $batas = 10;
	
	/************ Fixed Paging ****************/
	$cari1 = (isset($_POST['cariPro']))?$_POST['cariPro']:"";
	$cari2 = (isset($_GET['cariGet']))?$_GET['cariGet']:"";
    $cari3 = "";
	
	$key1 = (isset($_POST['txtkey']))?$_POST['txtkey']:"";
    $key2 = (isset($_GET['key']))?$_GET['key']:"";
    $key3 = "";
    
    if($key1){$key3=$key1;}elseif($key2){$key3=$key2;}
	if($cari1){$cari3=$cari1;}elseif($cari2){$cari3=$cari2;}
	
    echo "<br />";
    echo "<div align='center'>";
                if($cari3 == 'grup'){
                $q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_product` WHERE (`group_product`) LIKE '%$key3%'"));    
                }elseif($cari3 == 'nama'){
				$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_product` WHERE (`name_product`) LIKE '%$key3%'"));  
				}else{
    			$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_product`"));
    			}
                $jumData = $q['jumData'];
    			//Menentukan Jumlah noPage Berdasarkan Jumlah Data
    			$jumHal = @ceil($jumData/$batas);
    			//Previous
                $showPage = 0;
                
                if($key3 != null){
                    if($jumData > $batas){
    				if($noPage > 1){
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=".($noPage-1)."&key=".$key3."&cariGet=".$cari3."'>&lt; &lt; Sebelumnya</a>";
    				}
    				//Nomor noPage dan Linknya
    				for($page = 1; $page <= $jumHal; $page++){
    					if((($page >= $noPage - 3) && ($page <= $noPage + 3) || ($page==1) || $page==$jumHal)) {
    						if(($showPage == 1 ) && ($page != 2)){ echo " ... "; }
    						if(($showPage != ($jumHal-1)) && ($page==$jumHal)) { echo " ... "; }
    						if($page==$noPage){ echo "<b> $page </b>"; }
    						else{ 
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=$page&key=".$key3."&cariGet=".$cari3."'> $page </a>"; 
    						$showPage=$page; }
    					}
    				}
    				//Next
    				if($noPage < $jumHal){
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=".($noPage+1)."&key=".$key3."&cariGet=".$cari3."'>Selanjutnya &gt; &gt;</a>";
    				}
    			}
                }else{
                
                /************** Jika tak ada pencarian ********************/
    			if($jumData > $batas){
    				if($noPage > 1){
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=".($noPage-1)."'>&lt; &lt; Sebelumnya</a>";
    				}
    				//Nomor noPage dan Linknya
    				for($page = 1; $page <= $jumHal; $page++){
    					if((($page >= $noPage - 3) && ($page <= $noPage + 3) || ($page==1) || $page==$jumHal)) {
    						if(($showPage == 1 ) && ($page != 2)){ echo " ... "; }
    						if(($showPage != ($jumHal-1)) && ($page==$jumHal)) { echo " ... "; }
    						if($page==$noPage){ echo "<b> $page </b>"; }
    						else{ 
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=$page'> $page </a>"; 
    						$showPage=$page; }
    					}
    				}
    				//Next
    				if($noPage < $jumHal){
    						echo "<a class='paging' href='?page=dashboard&sub=product&halaman=".($noPage+1)."'>Selanjutnya &gt; &gt;</a>";
    				}
    			}
                }
    echo "<br />";    
    $sumAll=0;
    if($cari3 == 'grup'){
    $q_dataProduct = mysql_query("SELECT code_product FROM m_product WHERE `status_product` = '1' AND (`group_product`) LIKE '%$key3%'");
    while($dataProduct = mysql_fetch_array($q_dataProduct)){
      $sumStok = mysql_fetch_array(mysql_query("SELECT sum(`stock`) FROM `m_stock` WHERE (`code_product`) = '".$dataProduct['code_product']."'"));        
      $sumAll += $sumStok[0];
    }
    $sumBarang = mysql_fetch_array(mysql_query("SELECT count(`code_product`) FROM `m_product` WHERE `status_product` = '1' AND (`group_product`) LIKE '%$key3%'"));  
	}elseif($cari3 == 'nama'){
    $q_dataProduct = mysql_query("SELECT code_product FROM m_product WHERE `status_product` = '1' AND (`name_product`) LIKE '%$key3%'");
    while($dataProduct = mysql_fetch_array($q_dataProduct)){
      $sumStok = mysql_fetch_array(mysql_query("SELECT sum(`stock`) FROM `m_stock` Where (`code_product`) = '".$dataProduct['code_product']."'"));        
      $sumAll += $sumStok[0];
    }
	  $sumBarang = mysql_fetch_array(mysql_query("SELECT count(`code_product`) FROM `m_product` WHERE `status_product` = '1' AND (`name_product`) LIKE '%$key3%'"));	
	}else{
	  $sumBarang = mysql_fetch_array(mysql_query("SELECT count(`code_product`) FROM `m_product` WHERE `status_product` = '1'"));
    $sumStok = mysql_fetch_array(mysql_query("SELECT SUM(stock) FROM m_stock RIGHT JOIN m_product ON m_stock.code_product = m_product.code_product AND m_product.status_product = '1'"));
    $sumAll = $sumStok[0];
	}
		
	  echo "Jumlah Jenis Barang : <strong>$sumBarang[0]</strong>";
     
    echo "<br />";
    
    echo "Stok Keseluruhan Product Aktif : <strong>$sumAll</strong>";
    
    echo "</div>";

?>










<?php
if(isset($_POST['ubah1'])){
$kode = (isset($_POST['kode']))?$_POST['kode']:"";
}else{
$kode = (isset($_POST['kode2']))?$_POST['kode2']:"";
}
$grup = (isset($_POST['grup']))?$_POST['grup']:"";
$nama = (isset($_POST['nama']))?$_POST['nama']:"";
$ukur = (isset($_POST['ukuran']))?$_POST['ukuran']:"";
$stok = (isset($_POST['stok']))?$_POST['stok']:array(); // Using Array for SubOffice
$hrga = (isset($_POST['harga']))?$_POST['harga']:"";
$radYa = (isset($_POST['radYa']))?$_POST['radYa']:"";
$sum_pcs = (isset($_POST['sum_pcs']))?$_POST['sum_pcs']:"";
$sqlDB = mysql_fetch_array(mysql_query("SELECT * FROM `m_product`"));
$kodeDB = $sqlDB['code_product'];
$sqlSO = mysql_query("SELECT * FROM m_sub_office"); // Resource for SubOffice
$id = (isset($_GET['no']))?$_GET['no']:"";
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
    "'$sum_pcs'",
    "'$hrga'",
    "'1'",
		);
		$sql = "INSERT INTO `m_product` Values(".implode(',',$value).")";
    while($aSO = mysql_fetch_array($sqlSO)){ // Looping SubOffice
      mysql_query("INSERT INTO m_stock VALUES('','".$kode."','".$aSO['id_sub_office']."','".$stok[$aSO['id_sub_office']]."',CURRENT_TIMESTAMP)");
    } // Insert for stok SubOffice
    //echo($sql);
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
	if(isset($_POST['kode'])&&$_POST['kode']==$kodeDB){
		location('index.php?page=dashboard&sub=product&e=2');
	}else{
		$sql = "UPDATE `m_product` SET
		`code_product` = '$kode',
		`group_product` = '$grup',
		`name_product` = '$nama',
		`size_product` = '$ukur',
    `price_product` = '$hrga',
    `sum-pcs_product` = '$sum_pcs',
    `status_product` = '$radYa'
		Where `code_product` = '$id'
		";
    // echo($sql);
    $ex = @mysql_query($sql) or die('Query Salah -> '.mysql_error());
    while($aSO = mysql_fetch_array($sqlSO)){ // Looping SubOffice
      mysql_query("UPDATE m_stock SET stock = '".$stok[$aSO['id_sub_office']]."' WHERE code_product = '".$kode."' AND id_sub_office = '".$aSO['id_sub_office']."'");
    } // Insert for stok SubOffice
			if($ex){
			location('index.php?page=dashboard&sub=product');	
			}else{
			alert('Terjadi Kesalahan Pada Server');
			location('index.php?page=dashboard&sub=product');
			}
	}
}
?>
