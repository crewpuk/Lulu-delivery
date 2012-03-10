<?php include "../configuration/config.php"; ?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <th colspan="7" class="align2">FORM PESANAN PELANGGAN</th>
  </tr>
  <?php
  	$kode_transaction 	= $_GET['kT'];
	$kode_customer 		= $_GET['kC'];
	$sql = "SELECT * FROM `m_customer` Where `code_customer` = '$kode_customer'";
	$x = mysql_query($sql) or die("Query Salah -> ".mysql_error());	
  	$ax = mysql_fetch_array($x);
  ?>
  <tr>
    <td colspan="7"><strong>SO No: </strong>
      <label id="lblSO"><?php echo $kode_transaction; ?></label></td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </form>
  </tr>
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Publikasi Ke :      </td>
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
      <table width="72%" border="1" align="center" cellpadding="5" cellspacing="0">
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
        </form>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#FFFF00"><strong>TOTAL</strong></td>
    <td colspan="3" bgcolor="#FFFF00">: <?php echo "Rp. ".number_format($total, 0,",","."); ?></td>
    <td width="20%" bgcolor="#FFFF00">&nbsp;</td>
    <td width="17%">&nbsp;</td>
  </tr>
  <?php
  	if($total >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
  ?>
  <tr>
    <td width="11%">&nbsp;</td>
    <td width="20%">Biaya antar</td>
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
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>
