<?php include "../configuration/config.php"; ?>
<body onload="print();">
<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:solid 1px;">
  <tr>
    <th colspan="5" class="align2">FORM PESANAN PELANGGAN</th>
  </tr>
  <?php
  	$kode_transaction 	= $_GET['kT'];
	$kode_customer 		= $_GET['kC'];
	$sql = "SELECT * FROM `m_customer` Where `code_customer` = '$kode_customer'";
	$x = mysql_query($sql) or die("Query Salah -> ".mysql_error());	
  	$ax = mysql_fetch_array($x);
  ?>
  <tr>
    <td colspan="5"><strong>SO No : </strong>
      <label id="lblSO"><?php echo $kode_transaction; ?></label></td>
  </tr>
  <tr>
    <td width="48%">&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="29%"></td>
  </tr>
  <tr>
    <td><strong>Data LULUKID : </strong></td>
    <td><strong>Data Pelanggan </strong></td>
    <td width="2%"><strong>:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <form action="" method="post">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </form>
  </tr>
  <tr>
    <td>LULUKids</td>
    <td valign="top">Nama</td>
    <td valign="top">:</td>
    <td><?php echo $ax['name_customer'];?>&nbsp;</td>
  </tr>
  <tr>
    <td>Jl. Pekapuran Raya No.xx</td>
    <td valign="top">Alamat</td>
    <td valign="top">:</td>
    <td><?php echo $ax['address_customer'];?></td>
  </tr>
  <tr>
    <td>16417</td>
    <td>Kode Pos</td>
    <td>:</td>
    <td><?php echo $ax['postal_code_customer'];?></td>
  </tr>
  <tr>
    <td>021-946424687</td>
    <td>Telepon</td>
    <td>:</td>
    <td><?php echo $ax['phone_customer'];?></td>
  </tr>
  <tr>
    <td>0875-65421687</td>
    <td>Telp. Rumah</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <tr>
    <td><a href="#">lulukid.net</a></td>
    <td>Email</td>
    <td>:</td>
    <td><?php echo $ax['email_customer'];?></td>
  </tr>
  <?php
  $sqlA = "SELECT * FROM `m_transaction` Where `code_customer` = '$kode_customer'";
  $xa = mysql_query($sqlA) or die("Query Salah -> ".mysql_error());	
  $axa = mysql_fetch_array($xa);
  ?>
  <tr>
    <td>lulu.kids@lulu-groups.com</td>
    <td>Model Pembayaran</td>
    <td>:</td>
    <td><?php echo $axa['cost_type_transaction']; ?></td>
  </tr>
  <tr>
    <td>Publikasi ke : <?php echo $axa['sub_office_transaction']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">
      <table width="72%" border="1" align="center" cellpadding="5" cellspacing="0">
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
			echo "<div align='center' style='color:#F00; font-weight:bold;'>Data Tidak Ditemukan atau Pelanggan ".$ax['name_customer']." Belum Memesan Hari Ini</div>";
		}else{
	?>
        <tr class="align">
          <th width="24%" height="25">Produk</th>
          <th width="21%">Qty</th>
          <th width="26%">Harga</th>
          <th width="26%">Keterangan</th>
        </tr>
        <?php 
	  	
		@mysql_query("INSERT INTO `m_order` Values('',CURRENT_TIMESTAMP())");
		$total = 0;
		while($arr = mysql_fetch_array($cek)){
	  ?>
        <tr>
          <td class="align1234"><?php echo $arr["name_product"];?></td>
          <td align="center" class="align1234"><?php echo $arr["quantity_detail_transaction"];?></td>
          <td class="align1234">Rp. <?php echo number_format($arr["totalHarga"], 0, ",", ".");?></td>
          <td class="align1234"><?php echo $arr["description_detail_transaction"];?></td>
        </tr>
        <?php 
	  	$total = $total + $arr["totalHarga"];
	  
	  }} 
	  $sumQty = mysql_fetch_array(mysql_query("SELECT 
	  sum(`quantity_detail_transaction`) 
	  FROM `m_detail_transaction` 
	  Where `code_transaction`='$kode_transaction'"));
	  $sumPrice = mysql_fetch_array(mysql_query("SELECT 
	  sum(`price_product`*`quantity_detail_transaction`) 
	  FROM `m_detail_transaction`,`m_product` 
	  Where `m_detail_transaction`.`code_product`=`m_product`.`code_product`
	  and `m_detail_transaction`.`code_transaction`='$kode_transaction'"));
	  ?>
        <tr bgcolor="#FFFF00">
          <td class="align1234"><strong>TOTAL</strong></td>
          <td align="center" class="align1234"><?php echo $sumQty[0]; ?></td>
          <td class="align1234">Rp. <?php echo number_format($sumPrice[0],0,',','.'); ?></td>
          <td class="align1234">&nbsp;</td>
        </tr>
    <?php
  	if($sumPrice[0] >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
    ?>
        <tr>
          <td class="align1234">Biaya Antar</td>
          <td class="align1234">&nbsp;</td>
          <td class="align1234">Rp. <?php echo number_format($sale,0,",",".");?></td>
          <td class="align1234">&nbsp;</td>
        </tr>
        <tr>
          <td class="align1234"><strong>GRAND TOTAL</strong></td>
          <td class="align1234" bgcolor="#FF0000">&nbsp;</td>
          <td class="align1234" bgcolor="#FF0000">Rp. 
		  <?php 
		  $grandTotal = ($sumPrice[0] + $sale); 
		  echo number_format($grandTotal, 0,",","."); 
		  ?></td>
          <td class="align1234" bgcolor="#FF0000">&nbsp;</td>
        </tr>
        
        
      </table></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="5"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td><strong>Pesanan Pelanggan :</strong><br />
          <br />
          <?php echo $ax['name_customer']; ?><br />
          <?php echo $ax['code_customer']; ?><br />
          <br />
          <br />
          <br />
          <br />
          Ttd<br />
          Nama : <?php echo $ax['name_customer']; ?><br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
        <td><strong>Pengirim Oleh :</strong><br />
          <br />
          Staf Pengirim<br />
          LULUkids<br />
          <br />
          <br />
          <br />
          <br />
          Ttd<br />
          Nama : <br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
        <td><strong>Diketahui Oleh :</strong><br />
          <br />
          Supervisor/kepala toko<br />
          LULUkids<br />
          <br />
          <br />
          <br />
          <br />
          Ttd<br />
          Nama : <br />
          Tgl &ensp; : <?php echo date('d-m-Y'); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
</body>