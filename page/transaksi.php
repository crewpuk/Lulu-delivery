<?php include "configuration/config.php"; ?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <th colspan="7" class="align2">FORM PESANAN PELANGGAN</th>
  </tr>
  <?php
  	$code = $_POST['txt_search'];
	$were = $_POST['data_cust'];
	if($code != null or $were != null){
	$sql = "SELECT * FROM m_customer where ".$were." = '".$code."' ";
	$sql2 = "SELECT * FROM `m_customer`,`m_transaction` Where `m_customer`.`code_customer`=`m_transaction`.`code_customer`";
	$xx = mysql_query($sql2) or die("Query Salah -> ".mysql_error());
	$axx = mysql_fetch_array($xx);
	$kode_transaction = $axx['code_transaction'];
	//echo $sql."<br>";
  	$x = mysql_query($sql) or die("Query Salah -> ".mysql_error());	
  	$ax = mysql_fetch_array($x);
	} else{
			$were = "";
	}
  ?>
  <tr>
    <td colspan="6"><strong>SO No: </strong>
      <label id="lblSO"><?php echo $kode_transaction; ?></label></td>
    <td><a href="#" onclick="window.open('page/cetak.php?kT=<?php echo $kode_transaction; ?>&kC=<?php echo $ax['code_customer']; ?>','Pesanan','width=700,height=600,scrollbars=yes');"><img src="images/printer.png" width="32" height="32" alt="cetak" title="Cetak" /></a></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td width="17%">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Data LULUKID: </strong></td>
    <td><strong>Data Pelanggan</strong></td>
    <td width="1%">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">LULUKids</td>
    <form action="" method="post">
      <td><select name="data_cust" id="data_cust">
      <option value="">--Pilih Data--</option>
        <option value="code_customer" <?php if($were == 'code_customer'){echo "selected";}?>>No. Pelanggan</option>
        <option value="name_customer" <?php if($were == 'name_customer'){echo "selected";}?>>Nama</option>
        <option value="phone_customer"<?php if($were == 'phone_customer'){echo "selected";}?>>No. HP</option>
      </select></td>
      <td>:</td>
      <td colspan="2"><input name="txt_search" type="text" id="txt_search" value="<?php echo $code;?>" />
        <input type="submit" name="btn" id="btn" value="Submit" /></td>
    </form>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
    <td valign="top">Nama</td>
    <td valign="top">:</td>
    <td colspan="2"><?php echo $ax['name_customer'];?></td>
  </tr>
  <tr>
    <td colspan="3">Jl. Pekapuran Raya No.xx</td>
    <td valign="top">Alamat</td>
    <td valign="top">:</td>
    <td colspan="2"><?php echo $ax['address_customer'];?></td>
  </tr>
  <tr>
    <td colspan="3">16417</td>
    <td>Kode Pos</td>
    <td>:</td>
    <td colspan="2"><?php echo $ax['postal_code_customer'];?></td>
  </tr>
  <tr>
    <td colspan="3">021-946424687</td>
    <td>Telepon</td>
    <td>:</td>
    <td colspan="2"><?php echo $ax['phone_customer'];?></td>
  </tr>
  <tr>
    <td colspan="3">0875-65421687</td>
    <td>Telp. Rumah</td>
    <td>:</td>
    <td colspan="2">-</td>
  </tr>
  <tr>
    <td colspan="3"><a href="#">lulukid.net</a></td>
    <td>Email</td>
    <td>:</td>
    <td colspan="2"><?php echo $ax['email_customer'];?></td>
  </tr>
  <tr>
    <td colspan="3">lulu.kids@lulu-groups.com</td>
    <td>Model Pembayaran</td>
    <td>:</td>
    <td colspan="2"><select name="model" id="model">
      <option value="">--Pilih Model Pembayaran--</option>
      <option value="Transfer">Transfer</option>
      <option value="COD">COD</option>
      <option value="CashToko">Cash Toko</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="3">Publikasi Ke :
      <select name="select" id="select">
        <option value="">--Pilih Cabang--</option>
        <option value="Cabang 1">Cabang 1</option>
        <option value="Cabang 2">Cabang 2</option>
        <option value="Cabang 3">Cabang 3</option>
      </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="7" class="e">
    Error : 
	<?php
    $e = $_GET['e'];
	if($e==1){ echo "Data Kurang Lengkap"; }
	elseif($e==2){ echo "Produk Tidak Ada"; }
	elseif($e==3){ echo "Harus Angka"; }
	?>
    </td>
  </tr>
  <tr>
    <td colspan="7"><p>&nbsp;</p>
      <table width="72%" border="1" align="center" cellpadding="5" cellspacing="0">
        <tr class="tblHead">
          <th width="24%">No</th>
          <th width="24%" height="25">Produk</th>
          <th width="23%">Keterangan</th>
          <th width="24%">Qty</th>
          <th width="29%">Harga</th>
        </tr>
        <?php 
	  	$cek = mysql_query("SELECT m_detail_transaction.*,
							m_product.name_product,
							m_product.price_product AS harga,
							(m_detail_transaction.quantity_detail_transaction * m_product.price_product) AS totalHarga 
							FROM m_detail_transaction,m_product
							where m_detail_transaction.code_transaction = 
							'".$kode_transaction."' AND m_product.code_product = m_detail_transaction.code_product")  
							or die("query product salah");
							
		$length = mysql_num_rows($cek);
		if($length == null){
			echo "";
		}else{
		$total = 0;
		$i = 0;
		while($arr = mysql_fetch_array($cek)){
		$i++;
		if($i%2==0){ $bg = "#e9edef"; }else{ $bg = "#28c8fc"; }
	  ?>
        <tr bgcolor="<?php echo $bg; ?>">
          <td align="center" class="align1234"><?php echo $i; ?></td>
          <td class="align1234"><?php echo $arr["name_product"];?></td>
          <td class="align1234"><?php echo $arr["description_detail_transaction"];?></td>
          <td class="align1234"><?php echo $arr["quantity_detail_transaction"];?></td>
          <td class="align1234">Rp. <?php echo number_format($arr["totalHarga"], 0, ",", ".");?></td>
        </tr>
        <?php 
	  	$total = $total + $arr["totalHarga"];
	  
	  }} ?>
        <form action="system/created.php" method="post">
          <tr class="aldfg">
            <td>&nbsp;</td>
            <td><input type="text" name="produk" id="produk" />
              <input type="hidden" name="kode" id="kode" value="<?php echo $kode_transaction;?>" /></td>
            <td><input type="text" name="ket" id="ket" /></td>
            <td><input name="qty" type="text" id="qty" maxlength="3" /></td>
            <td bgcolor=""><input type="submit" style="visibility:hidden" name="save_product" id="save_product" value="Save" /></td>
          </tr>
        </form>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FFFF00"><strong>TOTAL</strong></td>
    <td colspan="3" bgcolor="#FFFF00">: <?php echo "Rp. ".number_format($total, 0,",","."); ?></td>
    <td width="27%" bgcolor="#FFFF00">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <?php
  	if($total >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
  ?>
  <tr>
    <td width="11%">&nbsp;</td>
    <td width="26%">Biaya antar</td>
    <td colspan="5">: <?php echo "Rp. ".number_format($sale,0,",",".");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FF0000"><strong>GRAND TOTAL</strong></td>
    <td colspan="4" bgcolor="#FF0000">: <?php echo  "Rp. ".number_format($total + $sale, 0,",","."); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td>Pesanan Pelanggan :<br />
          <?php echo $ax['name_customer']; ?><br />
          <?php echo $ax['code_customer']; ?><br />
          <br />
          <br />
          <br />
          Ttd<br />
          <br />
          Nama : <?php echo $ax['name_customer']; ?><br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
        <td>Pengirim Oleh :<br />
          Staf Pengirim<br />
          LULUkids<br />
          <br />
          <br />
          <br />
          Ttd<br />
          <br />
          Nama : <br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
        <td>Diketahui Oleh :<br />
          Supervisor/kepala toko<br />
          LULUkids<br />
          <br />
          <br />
          <br />
          Ttd<br />
          <br />
          Nama : <br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>
