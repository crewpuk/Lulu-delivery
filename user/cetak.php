<html>
<head>
<title>Nota Pemesanan Lulu-delivery</title>
<style>
.header{font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;}
.tableset{border:1px solid #333333;font-size:10px;}
.style1 {font-size: 24px;font-weight: bold;}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
</style>
</head>
<body onLoad="print();">
<?php
include "../configuration/config.php";

$q_data_perusahaan=mysql_query("SELECT * FROM m_data");
$data_lulu=array();
while($data = mysql_fetch_array($q_data_perusahaan)){
  $index=$data['name'];
  $data_lulu[$index]=$data['value'];
}



$kode_transaction   = urldecode($_GET['kT']);
$kode_customer    = urldecode($_GET['kC']);
$sql = "SELECT * FROM `m_customer` Where `code_customer` = '$kode_customer'";
$x = mysql_query($sql) or die("Query Salah -> ".mysql_error());
$ax = mysql_fetch_array($x);



$sqlA = "SELECT `m_transaction`.*,`m_sub_office`.`name_sub_office`,`m_sub_office`.`email_sub_office` FROM `m_transaction`,`m_sub_office` Where `m_transaction`.`code_customer` = '$kode_customer' AND `m_sub_office`.`id_sub_office` = `m_transaction`.`sub_office_transaction`";
$xa = mysql_query($sqlA) or die("Query Salah -> ".mysql_error()); 
$axa = mysql_fetch_array($xa);
?>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="0" style="border:1px solid #333333;">
  <tr>
    <td width="102" valign="top"><span class="style5"><img src="../images/64x64/logo.png" width="64" height="43" alt="Lulu-delivery"></span></td>
    <td width="209" height="54" valign="top"><span class="style5"><?php echo($data_lulu['company_name']);?><br />
	<?php echo(nl2br($data_lulu['company_address']));?> <br />
	<?php echo(nl2br($data_lulu['company_phone']));?><br />
	<a href="#"><?php echo($data_lulu['company_url']);?></a></span></td>
	<td align="right" valign="top" class="style5">No Resi : <label id="lblSO"><?php echo $kode_transaction; ?></label><br>
    Tgl Transaksi :<?php echo date('d - m - Y'); ?> </td>
  </tr>
  <tr>
    <td height="32" colspan="3" align="center" valign="middle" bgcolor="#CCCCCC"><span class="style1">Nota Pesanan</span></td>
  </tr>
  <tr>
    <td valign="top">Pemesan Oleh  <br>
      Alamat  <br>
      No Telp <br>
    Pembayaran	</td>
    <td valign="top">: <?php echo $ax['name_customer'];?><br>
      : <?php echo $ax['address_customer'];?><br>
      : <?php echo $ax['phone_customer'];?><br>
      : <?php echo $axa['cost_type_transaction']; ?></td>
    <td valign="top"><br>
    <br>
    <br></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><hr noshade="noshade"/></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="header">
      <?php
    $cek = mysql_query("SELECT m_detail_transaction.*,
							m_product.name_product,
							m_product.size_product,
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
      
      <tr>
        <th width="25%" bgcolor="#CCCCCC" class="tableset">Produk</th>
        <th width="14%" bgcolor="#CCCCCC" class="tableset">Qty</th>
        <th width="34%" bgcolor="#CCCCCC" class="tableset">Keterangan</th>
        <th width="27%" bgcolor="#CCCCCC" class="tableset">Harga</th>
      </tr>
      <?php
		@mysql_query("INSERT INTO `m_order` Values('',CURRENT_TIMESTAMP())");
		$total = 0;
		while($arr = mysql_fetch_array($cek)){
	  ?>
      <tr>
        <td class="tableset"><?php echo $arr["name_product"].'-'.$arr['size_product'];?></td>
        <td class="tableset" align="center"><?php echo $arr["quantity_detail_transaction"];?></td>
        <td class="tableset"><?php echo $arr["description_detail_transaction"];?></td>
        <td class="tableset">Rp. <?php echo number_format($arr["totalHarga"], 0, ",", ".");?></td>
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
	  if($sumPrice[0] >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td bgcolor="#CCCCCC" class="tableset">Biaya Antar</td>
        <td bgcolor="#CCCCCC" class="tableset">Rp. <?php echo number_format($sale,0,",",".");?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td bgcolor="#CCCCCC" class="tableset">Total</td>
        <td bgcolor="#CCCCCC" class="tableset">Rp. <?php echo number_format($sumPrice[0],0,',','.'); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><hr noshade="noshade"/></td>
  </tr>
  <tr>
    <td height="74" colspan="2" valign="top">
		Penerima<br>
        <br>
        [ditulis manual]<br>
   	<br>	</td>
    <td width="269" align="right" valign="top" class="header">
	Depok , <?php echo date('d - m - Y'); ?><br>
    <br>
    [print nama karyawan]</td>
  </tr>
</table>
</body>
</html>
