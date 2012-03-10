<?php include("configuration/config.php");
	$kode_transaction = 'B001CS';
?>
<body>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="7" class="align2">FORM PESANAN PELANGGAN</td>
  </tr>
  <tr>
    <td colspan="7"><strong>SO No: </strong><label id="lblSO"><?php echo $kode_transaction; ?></label></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td width="13%">&nbsp;</td>
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
    <form action="index.php?page=dashboard2" method="post">
    <td><select name="data_cust" id="data_cust">
      <option value="code_customer" <?php if($were == 'code_customer'){echo "selected";}?>>No. Pelanggan</option>
      <option value="name_customer" <?php if($were == 'name_customer'){echo "selected";}?>>Nama</option>
      <option value="phone_customer"<?php if($were == 'phone_customer'){echo "selected";}?>>No. HP</option>
    </select></td>
    <td>:</td>
   
    <td colspan="2">
    	<input name="txt_search" type="text" id="txt_search" value="<?php echo $code;?>" />
    	<input type="submit" name="btn" id="btn" value="Submit" /></td>
     </form>
  </tr>
  <?php
  	$code = $_POST['txt_search'];
	$were = $_POST['data_cust'];
	if($code != null or $were != null and isset($_POST['btn'])){
	$sql = "SELECT * FROM m_customer where ".$were." = '".$code."' ";
	//echo $sql."<br>";
  	$x = mysql_query($sql) or die("query Salah -> ".mysql_error());	
  	$ax = mysql_fetch_array($x);
	} else{
			$were = "";
	}
  ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td valign="top">Nama</td>
    <td valign="top">:</td>
    <td colspan="2"><?php echo $ax['name_customer'];?>&nbsp;</td>
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
      <option value="Transfer" selected="selected">Transfer</option>
      <option value="COD">COD</option>
      <option value="CashToko">Cash Toko</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="3">Publikasi Ke :
      <select name="select" id="select">
        <option value="Cabang 1" selected="selected">Cabang 1</option>
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
    <td height="21" colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><p>&nbsp;</p>
      <table width="72%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr class="align">
        <td width="24%" height="25">Produk</td>
        <td width="21%">Keterangan</td>
        <td width="26%">Qty</td>
        <td width="26%">Harga</td>
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
		while($arr = mysql_fetch_array($cek)){
	  ?>
      <tr>
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
        <td><input type="text" name="produk" id="produk" />
          <input type="hidden" name="kode" id="kode" value="<?php echo $kode_transaction;?>" /></td>
        <td><input type="text" name="ket" id="ket" /></td>
        <td><input type="text" name="qty" id="qty" /></td>
        <td bgcolor="#000000"><input type="submit" style="visibility:hidden" name="save_product" id="save_product" value="Save" /></td>
        </tr>
      </form>
</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FFFF00"><strong>TOTAL</strong></td>
    <td colspan="3" bgcolor="#FFFF00">: <?php echo "Rp. ".number_format($total, 0,",","."); ?></td>
    <td width="10%" bgcolor="#FFFF00">&nbsp;</td>
    <td width="14%">&nbsp;</td>
  </tr>
  <?php
  	if($total >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
  ?>
  <tr>
    <td width="14%">&nbsp;</td>
    <td width="18%">Biaya antar</td>
    <td colspan="5">: <?php echo "Rp. ".number_format($sale,0,",",".");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FF0000"><strong>GRAND TOTAL</strong></td>
    <td colspan="4" bgcolor="#FF0000">: <?php echo  "Rp. ".number_format($total + $sale, 0,",","."); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
</body>
</html>
