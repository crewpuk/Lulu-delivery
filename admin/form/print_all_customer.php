<title>Print Data Customer</title>
<link href="../../images/16x16/logo.png" rel="shortcut icon" />
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <?php
  include ('../../configuration/config.php');
  $first = isset($_GET['tglF'])?$_GET['tglF']:"";
  $last  = isset($_GET['tglL'])?$_GET['tglF']:"";
  $note  = '';
  
  $tgl_first = explode('-',$first);
  $tgl_last = explode('-',$last);
  $tF = $tgl_first[2].'-'.$tgl_first[1].'-'.$tgl_first[0];
  $tL = $tgl_last[2].'-'.$tgl_last[1].'-'.$tgl_last[0]; 
  if($first != null || $last != null){
	$note = "Berdasarkan Tanggal $tF s/d $tL";  
  }else{
	$note = "";  
  }
  //preg_match('//',$sql,$a);
  ?>
  <tr bgcolor="#f5f5f5">
    <th colspan="6">Print Data Customer <?php echo $note; ?></th>
  </tr>
  <tr bgcolor="#f5f5f5">
    <th width="10%">No. Pelanggan</th>
    <th width="16%">Nama</th>
    <th width="27%">Alamat</th>
    <th width="23%">No. Telepon Rumah</th>
    <th width="13%">No. HP</th>
    <th width="11%">Email</th>
  </tr>
  <?php
  	$sql= rawurldecode($_GET['sql']);
	$poslimit = strpos($sql,"LIMIT");
	$possql = strlen($sql);
	$subsql = substr($sql,0,($possql-($possql-$poslimit)));
	//echo $subsql;
	$exeSQL = @mysql_query($subsql) or die('Query Salah - >'.mysql_error());
	$i = 0;
	while($data = @mysql_fetch_array($exeSQL)){
	$i++;
	?>
  <tr>
    <td align="center"><?php echo $i; ?></td>
    <td><?php echo $data['name_customer']; ?></td>
    <td><?php echo $data['address_customer']; ?></td>
    <td align="center"><?php echo $data['home_phone_customer']; ?></td>
    <td align="center"><?php echo $data['phone_customer']; ?></td>
    <td><?php echo $data['email_customer']; ?></td>
  </tr>
  <?php } ?>
</table>
