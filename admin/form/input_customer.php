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
      <th style="padding: 5px;" colspan="3">Input Customer</th>
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
      <td style="padding: 5px;" width="109">Kode Customer</td>
      <td style="padding: 5px;" width="5">:</td>
      <td style="padding: 5px;" width="296">
		<input dojoType="dijit.form.ValidationTextBox" 
		require="true"
		readonly="readonly"
		name="kode_cust"
		value="<?php echo $code_cust; ?>"
		id="kode_cust" />
	  </td>
    </tr>
    <tr>
      <td style="padding: 5px;">Nama Customer</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Nama Customer" dojoType="dijit.form.ValidationTextBox" require="true" name="nama_cust" id="nama_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Tanda Pengenal(KTP/SIM/PASSPORT)</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="No. Tanda Pengenal" dojoType="dijit.form.ValidationTextBox" require="true" name="no_pengenal" id="no_pengenal" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;" valign="top">Alamat</td>
      <td style="padding: 5px;" valign="top">:</td>
      <td style="padding: 5px;">
		  <input dojoType="dijit.form.SimpleTextarea" 
		placeHolder="Alamat"
        require="true"
        name="alamat_cust" 
		id="alamat_cust" 
		cols="30" 
		rows="5">
      </td>
    </tr>
    <tr>
      <td style="padding: 5px;">Kota</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Kota" dojoType="dijit.form.ValidationTextBox" name="kota_cust" id="kota_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Provinsi</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Provinsi" dojoType="dijit.form.ValidationTextBox" name="provinsi_cust" id="provinsi_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Kode Pos</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Kode Pos" dojoType="dijit.form.ValidationTextBox" name="kodePos_cust" id="kodePos_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Hp</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="No. HP" dojoType="dijit.form.ValidationTextBox" name="tlp_cust" id="tlp_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">No. Telepon Rumah</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="No. Telepon Rumah" dojoType="dijit.form.ValidationTextBox" name="tlp_rmh_cust" id="tlp_rmh_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Email</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Email" dojoType="dijit.form.ValidationTextBox" name="email_cust" id="email_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Contact Online</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><input placeHolder="Contact Online" dojoType="dijit.form.ValidationTextBox" name="contact_cust" id="contact_cust" /></td>
    </tr>
    <tr>
      <td style="padding: 5px;">Status</td>
      <td style="padding: 5px;">:</td>
      <td style="padding: 5px;"><select name="status_cust" id="status_cust">
        <option value="1" selected="selected">Aktif</option>
        <option value="0">Tidak Aktif</option>
      </select></td>
    </tr>
    <tr>
      <td style="padding: 5px;">&nbsp;</td>
      <td style="padding: 5px;">&nbsp;</td>
      <td style="padding: 5px;">
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
		  <th style="padding: 5px;" colspan="3">Ubah Customer</th>
		</tr>
		<tr>
		  <td style="padding: 5px;" width="109">Kode Customer</td>
		  <td style="padding: 5px;" width="5">:</td>
		  <td style="padding: 5px;" width="296">
		  <input 
			name="kode_cust" 
			id="kode_cust1"  disabled="disabled" value="<?php echo $dataSQL['code_customer'];?>" dojoType="dijit.form.ValidationTextBox" 
			require="true" />
			 <label><input dojoType="dijit.form.CheckBox" name="rdKode" id="rdKode" value="ubah" />
			Ubah ?</label>
			<input name="kode2" dojoType="dijit.form.TextBox" type="hidden" id="kode2" value="<?php echo $dataSQL['code_customer']; ?>"> </td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Nama Customer</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="nama_cust" id="nama_cust1" value="<?php echo $dataSQL['name_customer'];?>" dojoType="dijit.form.ValidationTextBox" require="true" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">No. Tanda Pengenal(KTP/SIM/PASSPORT)</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="no_pengenal" id="no_pengenal1" value="<?php echo $dataSQL['pengenal_customer'];?>" dojoType="dijit.form.ValidationTextBox" require="true" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;" valign="top">Alamat</td>
		  <td style="padding: 5px;" valign="top">:</td>
		  <td style="padding: 5px;">
			  <input
			name="alamat_cust" 
			id="alamat_cust1" value="<?php echo $dataSQL['address_customer'];?>" dojoType="dijit.form.SimpleTextarea" 
			require="true" 
			cols="30" 
			rows="5">
		  </td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Kota</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="kota_cust" id="kota_cust1" value="<?php echo $dataSQL['kota_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Provinsi</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="provinsi_cust" id="provinsi_cust1" value="<?php echo $dataSQL['provinsi_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Kode Pos</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="kodePos_cust" id="kodePos_cust1" value="<?php echo $dataSQL['postal_code_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">No. Hp</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="tlp_cust" id="tlp_cust1" value="<?php echo $dataSQL['phone_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">No. Telepon Rumah</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="tlp_rmh_cust" id="tlp_rmh_cust1" value="<?php echo $dataSQL['home_phone_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Email</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="email_cust" id="email_cust1" value="<?php echo $dataSQL['email_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Contact Online</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><input name="contact_cust" id="contact_cust1" value="<?php echo $dataSQL['contact_customer'];?>" dojoType="dijit.form.ValidationTextBox" /></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">Status</td>
		  <td style="padding: 5px;">:</td>
		  <td style="padding: 5px;"><select name="status_cust" id="status_cust1">
			<option value="1" <?php if($dataSQL['status_customer'] == '1'){echo "selected";}?>>Aktif</option>
			<option value="0" <?php if($dataSQL['status_customer'] == '0'){echo "selected";}?>>Tidak Aktif</option>
		  </select></td>
		</tr>
		<tr>
		  <td style="padding: 5px;">&nbsp;</td>
		  <td style="padding: 5px;">&nbsp;</td>
		  <td style="padding: 5px;">
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
<form form name="form1" method="post" action="">
	<table width="100%" border="1" cellspacing="0" cellpadding="10">
		<tr>
			<td colspan="13">
				Cari Berdasarkan:
				<select name="cariPro" >
                	<option value="">--Pilih--</option>
					<option value="code_customer" <?php if($cari3 == 'code_customer'){echo "selected";}?>>Kode Customer</option>
					<option value="name_customer" <?php if($cari3 == 'name_customer'){echo "selected";}?>>Nama Customer</option>
				</select>
				<input dojoType="dijit.form.TextBox" name="txtkey" value="<?php echo $key3;?>" />
				<button type="submit" dojoType="dijit.form.Button" name="btnCariCust">Cari</button>
				<a href="index.php?page=dashboard&sub=input_customer" ><img src="<?php echo BASE; ?>images/32x32/book.png" title="Lihat Semua" width="24" height="24" alt="Lihat Semua" style="position: absolute;" /></a>
			</td>
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
		
		
			if($cari3 != null){
				if($cari3 == 'code_customer'){
					$sql = "SELECT * FROM `m_customer` where `code_customer` = '$key3' LIMIT $offset,$batas";
				}elseif($cari3 == 'name_customer'){
					$sql = "SELECT * FROM `m_customer` where `name_customer` LIKE '%$key3%' LIMIT $offset,$batas";
				}
			}else{
				$sql = "SELECT * FROM `m_customer` LIMIT $offset,$batas";
			}
			$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
			  $i=0;
			  $num = mysql_num_rows($exeSQL);
			  if($num == 0){
			  echo "<font color='#FF0000'>Data Tidak Ditemukan</font>";
			  }else{
		?>
		<tr>
        <th style="padding: 5px;">No</th>
        <th style="padding: 5px;">Kode</th>
        <th style="padding: 5px;">Nama</th>
        <th style="padding: 5px;">No. Pengenal</th>
        <th style="padding: 5px;">Alamat</th>
        <th style="padding: 5px;">No. HP</th>
        <th style="padding: 5px;">No. Telepon Rumah</th>
        <th style="padding: 5px;">Contact Online</th>
        <th style="padding: 5px;">Email</th>
        <th style="padding: 5px;">Status Aktif</th>
        <th style="padding: 5px;" colspan="3">Tindakan</th>
      </tr>
      <?php
		while($data = mysql_fetch_array($exeSQL)){
		$i++;
		//echo $batas;
		//echo $offset;
		if($i%2==0){ $bg='#ececec'; }else{ $bg='#f5f5f5'; }
      ?>
      <tr bgcolor="<?php echo $bg; ?>" class="linkBorder">
		<td align="center"><?php echo $i;?></td>
		<td  style="padding: 5px;" ><?php echo $data['code_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['name_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['pengenal_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['address_customer'].", ".$data['kota_customer'].", ".$data['provinsi_customer'].", ".$data['postal_code_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['phone_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['home_phone_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['contact_customer'];?></td>
		<td style="padding: 5px;"><?php echo $data['email_customer'];?></td>
		<td align="center" style="padding: 5px;">
		<?php 
		$status = $data['status_customer'];
		if($status == 0){ echo "<span style='color: #9e3f3f;'>Tidak Aktif</span>"; }
		elseif($status == 1){ echo "<span style='color: #3f679e;'>Aktif</span>"; }		
		?>
        
        </td>
		<td align="center" style="padding: 5px;"><a href="index.php?page=dashboard&sub=input_customer&vwUbah&no=<?php echo $data['code_customer']; ?>"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="vwUbah" title="Ubah"></a></td>
        <td align="center" style="padding: 5px;">
        	<?php if($data["status_customer"]==1){?>
        		<a href="index.php?page=dashboard&sub=input_customer&hapus&no=<?php echo $data['code_customer']; ?>" onclick="return confirm('Menghapus ini hanya akan membuatnya TIDAK AKTIF?')"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus?"></a>
        	<?php }else{?>
        		<a href="index.php?page=dashboard&sub=input_customer&aktifasi&no=<?php echo $data['code_customer']; ?>"><img src="<?php echo BASE; ?>images/16x16/yes.png" width="16" height="16" alt="hapus" title="Aktifkan?"></a>
        	<?php }?>
        </td>
        <td align="center" style="padding: 5px;">
			<a href="#" onclick="window.open('form/print_customer.php?id=<?php echo $data['code_customer']; ?>','Cetak','width=800,height=700,scrollbars=yes');"><img src="<?php echo BASE; ?>images/32x32/printer.png" width="16" height="16" alt="cetak" title="Cetak" /></a>
        </td>
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
                if($cari3 == 'code_customer'){
                $q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_customer` where `code_customer` = '$key3'"));    
                }elseif($cari3 == 'name_customer'){
				$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_customer` where `name_customer` LIKE '%$key3%'"));  
				}else{
    			$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `jumData` From `m_customer` "));
    			}
                $jumData = $q['jumData'];
    			//Menentukan Jumlah noPage Berdasarkan Jumlah Data
    			$jumHal = @ceil($jumData/$batas);
    			//Previous
                $showPage = 0;
                
                if($key3 != null){
                    if($jumData > $batas){
    				if($noPage > 1){
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=".($noPage-1)."&key=".$key3."&cariGet=".$cari3."'>&lt; &lt; Sebelumnya</a>";
    				}
    				//Nomor noPage dan Linknya
    				for($page = 1; $page <= $jumHal; $page++){
    					if((($page >= $noPage - 3) && ($page <= $noPage + 3) || ($page==1) || $page==$jumHal)) {
    						if(($showPage == 1 ) && ($page != 2)){ echo " ... "; }
    						if(($showPage != ($jumHal-1)) && ($page==$jumHal)) { echo " ... "; }
    						if($page==$noPage){ echo "<b> $page </b>"; }
    						else{ 
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=$page&key=".$key3."&cariGet=".$cari3."'> $page </a>"; 
    						$showPage=$page; }
    					}
    				}
    				//Next
    				if($noPage < $jumHal){
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=".($noPage+1)."&key=".$key3."&cariGet=".$cari3."'>Selanjutnya &gt; &gt;</a>";
    				}
    			}
                }else{
                
                /************** Jika tak ada pencarian ********************/
    			if($jumData > $batas){
    				if($noPage > 1){
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=".($noPage-1)."'>&lt; &lt; Sebelumnya</a>";
    				}
    				//Nomor noPage dan Linknya
    				for($page = 1; $page <= $jumHal; $page++){
    					if((($page >= $noPage - 3) && ($page <= $noPage + 3) || ($page==1) || $page==$jumHal)) {
    						if(($showPage == 1 ) && ($page != 2)){ echo " ... "; }
    						if(($showPage != ($jumHal-1)) && ($page==$jumHal)) { echo " ... "; }
    						if($page==$noPage){ echo "<b> $page </b>"; }
    						else{ 
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=$page'> $page </a>"; 
    						$showPage=$page; }
    					}
    				}
    				//Next
    				if($noPage < $jumHal){
    						echo "<a class='paging' href='?page=dashboard&sub=input_customer&halaman=".($noPage+1)."'>Selanjutnya &gt; &gt;</a>";
    				}
    			}
                }
    echo "<br />";    
	       
    if($cari3 == 'code_customer'){
    $sumCustomer = mysql_fetch_array(mysql_query("SELECT count(`code_customer`) FROM `m_customer` where `code_customer` = '$key3'"));
    }elseif($cari3 == 'name_customer'){
	$sumCustomer = mysql_fetch_array(mysql_query("SELECT count(`code_customer`) FROM `m_customer` where `name_customer` LIKE '%$key3%'"));
	}else{
	$sumCustomer = mysql_fetch_array(mysql_query("SELECT count(`code_customer`) FROM `m_customer`"));
	}
	
	echo "Jumlah Data Customer : <strong>$sumCustomer[0]</strong>";
    
    echo "</div>";

?>


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
	$sql = "DELETE FROM `m_customer` Where `code_customer` = '$id'";
	$ex = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
	if($ex){
	location('index.php?page=dashboard&sub=input_customer');	
	}else{
	alert('Terjadi Kesalahan Pada Server');
	location('index.php?page=dashboard&sub=input_customer');
	}
}elseif(isset($_GET['aktifasi'])){
	$id = $_GET['no'];
	$sql = "UPDATE `m_customer` SET `status_customer` = '1' Where `code_customer` = '$id'";
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
