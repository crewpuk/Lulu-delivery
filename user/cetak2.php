<?php include "../configuration/config.php";

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

$html='<html>
<body onLoad="print();">
<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:solid 1px;">
  <tr>
    <th colspan="5" class="align2"><img src="../images/logo.png" width="150" height="100" alt="Lulu@Delivery"></th>
  </tr>
  <tr>
    <th colspan="5" class="align2">FORM PESANAN PELANGGAN</th>
  </tr>
  <tr>
    <td colspan="5"><strong>SO No : </strong>
      <label id="lblSO">'.$kode_transaction.'</label></td>
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
    <td>'.$data_lulu['company_name'].'</td>
    <td valign="top">Nama</td>
    <td valign="top">:</td>
    <td>'.$ax['name_customer'].'</td>
  </tr>
  <tr>
    <td rowspan="2">'.nl2br($data_lulu['company_address']).'</td>
    <td valign="top">Alamat</td>
    <td valign="top">:</td>
    <td>'.$ax['address_customer'].'</td>
  </tr>
  <tr>
    <td>Kode Pos</td>
    <td>:</td>
    <td>'.$ax['postal_code_customer'].'</td>
  </tr>
  <tr>
    <td rowspan="2">'.nl2br($data_lulu['company_phone']).'</td>
    <td>Telepon</td>
    <td>:</td>
    <td>'.$ax['phone_customer'].'</td>
  </tr>
  <tr>
    <td>Telp. Rumah</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <tr>
    <td><a href="#">'.$data_lulu['company_url'].'</a></td>
    <td>Email</td>
    <td>:</td>
    <td>'.$ax['email_customer'].'</td>
  </tr>
  <tr>
    <td>'.$data_lulu['company_email'].'</td>
    <td>Model Pembayaran</td>
    <td>:</td>
    <td>'.$axa['cost_type_transaction'].'</td>
  </tr>
  <tr>
    <td>Publikasi ke : '.$axa['name_sub_office'].'</td>
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
      <table width="72%" border="1" align="center" cellpadding="5" cellspacing="0">';
        
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
			$html.="<div align='center' style='color:#F00; font-weight:bold;'>Data Tidak Ditemukan atau Pelanggan ".$ax['name_customer']." Belum Memesan Hari Ini</div>";
		}else{
    $html.='
        <tr class="align">
          <th width="24%" height="25">Produk</th>
          <th width="21%">Qty</th>
          <th width="26%">Harga</th>
          <th width="26%">Keterangan</th>
        </tr>';
	  	
		@mysql_query("INSERT INTO `m_order` Values('',CURRENT_TIMESTAMP())");
		$total = 0;
		while($arr = mysql_fetch_array($cek)){
      $html.='
        <tr>
          <td class="align1234">'.$arr["name_product"].'-'.$arr['size_product'].'</td>
          <td align="center" class="align1234">'.$arr["quantity_detail_transaction"].'</td>
          <td class="align1234">Rp. '.number_format($arr["totalHarga"], 0, ",", ".").'</td>
          <td class="align1234">'.$arr["description_detail_transaction"].'</td>
        </tr>';
	  	$total = $total + $arr["totalHarga"];
	  }
    } 
	  $sumQty = mysql_fetch_array(mysql_query("SELECT 
	  sum(`quantity_detail_transaction`) 
	  FROM `m_detail_transaction` 
	  Where `code_transaction`='$kode_transaction'"));
	  $sumPrice = mysql_fetch_array(mysql_query("SELECT 
	  sum(`price_product`*`quantity_detail_transaction`) 
	  FROM `m_detail_transaction`,`m_product` 
	  Where `m_detail_transaction`.`code_product`=`m_product`.`code_product`
	  and `m_detail_transaction`.`code_transaction`='$kode_transaction'"));
    $html.='
        <tr bgcolor="#FFFF00">
          <td class="align1234"><strong>TOTAL</strong></td>
          <td align="center" class="align1234">'.$sumQty[0].'</td>
          <td class="align1234">Rp. '.number_format($sumPrice[0],0,',','.').'</td>
          <td class="align1234">&nbsp;</td>
        </tr>';
  	if($sumPrice[0] >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
    $grandTotal = ($sumPrice[0] + $sale);
    $html.='
        <tr>
          <td class="align1234">Biaya Antar</td>
          <td class="align1234">&nbsp;</td>
          <td class="align1234">Rp. '.number_format($sale,0,",",".").'</td>
          <td class="align1234">&nbsp;</td>
        </tr>
        <tr>
          <td class="align1234"><strong>GRAND TOTAL</strong></td>
          <td class="align1234" bgcolor="#FF0000">&nbsp;</td>
          <td class="align1234" bgcolor="#FF0000">Rp. '.number_format($grandTotal, 0,",",".").'</td>
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
          '.$ax['name_customer'].'<br />
          '.$ax['code_customer'].'<br />
          <br />
          <br />
          <br />
          <br />
          Ttd<br />
          Nama : '.$ax['name_customer'].'<br />
          Tgl &ensp; : '.date('d-m-Y').'</td>
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
          Tgl &ensp; : '.date('d-m-Y').'</td>
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
          Tgl &ensp; : '.date('d-m-Y').'</td>
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
</html>';

$mail = new eMail;
$mail->to = array($axa['email_sub_office']);
$mail->from = $data_lulu['company_email'];
$mail->body = $html;
$mail->subject = "Bukti Cetak Lulu@Delivery";
$mail->send();

echo($html);
?>