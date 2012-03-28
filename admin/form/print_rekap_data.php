<title>Rekapitulasi Transaksi</title>
<link href="../../images/16x16/logo.png" rel="shortcut icon" />
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <?php
  include ('../../configuration/config.php');

	$first = $_GET['tglF'];
	$last = $_GET['tglL'];
	$btnHari = $_GET['btnHari'];

	$tgl_first = explode('-',$first);
	$tgl_last = explode('-',$last);
	$tF = $tgl_first[2].'-'.$tgl_first[1].'-'.$tgl_first[0];
	$tL = $tgl_last[2].'-'.$tgl_last[1].'-'.$tgl_last[0];
  
  if($first != null and $last != null){
	$note = "Berdasarkan Tanggal $tF s/d $tL";  
  }elseif($btnHari != null){
	$note = "Hari Ini";  
  }else{
	$note = "";
  }
  
  ?>
  <tr bgcolor="#f5f5f5">
    <th colspan="6">Rekapitulasi Transaksi <?php echo $note; ?></th>
  </tr>
  <tr bgcolor="#f5f5f5">
    <th width="10%">No.</th>
    <th width="16%">Kode Transaksi</th>
    <th width="27%">Nama Barang</th>
    <th width="23%">Kwantity</th>
    <th width="13%">Total</th>
  </tr>
  <?php
  	$sql= rawurldecode($_GET['sql']);
  	//echo $sql;	
	//echo $subsql;
	$exeSQL = @mysql_query($sql) or die('Query Salah - >'.mysql_error());
	$i = 0;
	while($data = @mysql_fetch_array($exeSQL)){
	$i++;
	?>
  <tr>
    <td align="center"><?php echo $i; ?></td>
    <td><?php echo $data['code_transaction']; ?></td>
    <td><?php echo $data['name_product']; ?></td>
    <td align="center"><?php echo $data['quantity_detail_transaction']; ?></td>
    <td align="center"><?php echo "Rp. ".number_format($data['totalHarga'],0,",","."); ?></td>
   
  </tr>
  <?php } ?>
</table>
