<?php
require_once('../configuration/fpdf/fpdf.php');
require_once('../configuration/config.php');

$q_data_perusahaan=mysql_query("SELECT * FROM m_data");
$data_lulu=array();
while($data = mysql_fetch_array($q_data_perusahaan)){
  $index = $data['name'];
  $data_lulu[$index] = $data['value'];
}
$datalulu = array(
	$data_lulu['company_name'],
	$data_lulu['company_address'],
	$data_lulu['company_phone'],
	$data_lulu['company_url']
	);

$kode_transaction = urldecode($_GET['kT']);
$kode_customer = urldecode($_GET['kC']);
$sql = "SELECT * FROM `m_customer` Where `code_customer` = '$kode_customer'";
$x = mysql_query($sql) or die("Query Salah -> ".mysql_error());
$ax = mysql_fetch_array($x);

$codePrint    =(isset($ax['code_customer']))?   $ax['code_customer']    :"";
$nmPrint      =(isset($ax['name_customer']))?   $ax['name_customer']    :"";
$alamatPrint  =(isset($ax['address_customer']))?$ax['address_customer'] :"";
$tlpPrint     =(isset($ax['phone_customer']))?  $ax['phone_customer']   :"";

$sqlA = "SELECT * FROM `m_transaction` Where `m_transaction`.`code_transaction` = '$kode_transaction'";
$xa = mysql_query($sqlA) or die("Query Salah -> ".mysql_error()); 
$axa = mysql_fetch_array($xa);

session_start();
$id = $_SESSION['id'];
$q_user = mysql_query("SELECT fullname_account FROM user_account WHERE id_account = '$id' LIMIT 1");
$data_user = mysql_fetch_array($q_user);
$employee_fullname = $data_user['fullname_account'];

if(isset($_GET['delivery'])){
  $id_delivery = $_GET['delivery'];
}
$q_delivery = mysql_query("SELECT `m_transaction`.`id_delivery`,`m_delivery`.`id_delivery`,`m_delivery`.`name_delivery` FROM `m_delivery`,`m_transaction` WHERE `m_transaction`.`id_delivery` = `m_delivery`.`id_delivery`");
$data_delivery = mysql_fetch_array($q_delivery);
$delivery_man = $data_delivery['name_delivery'];


$pembayaran=(isset($_GET['pembayaran']))?$_GET['pembayaran']:$axa['cost_type_transaction'];
$printL = array(
	'Nama Pemesan',
	'No. Pelanggan',
	'Alamat Pengiriman',
	'No. Telepon',
	'Pembayaran'
	);
$printV = array(
	$nmPrint,
	$codePrint,
	$alamatPrint,
	$tlpPrint,
	$pembayaran
	);

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B','12');

//Image(str file, float x, float y, float w, float h, str type, mixed link)
$pdf->Image('logo.jpg',8,10);

//Cell(float w , float h , str txt , mixed border , int ln , str align , boolean fill , mixed link)

foreach($datalulu as $key => $value){
$pdf->SetX(38);
$pdf->Cell(0,5,$value,0,1,'L');
}
$pdf->SetY(9);
$pdf->Cell(0,10,'SO. No. : '.$kode_transaction,0,0,'R');
$pdf->SetY(13);
$pdf->Cell(0,10,'Tgl Transaksi : '.date('d - m - Y'),0,0,'R');

$pdf->setY(35);
$pdf->SetFont('Arial','B','16');
$pdf->SetFillColor(202,203,209);
$pdf->Cell(0,15,'Pemesanan',0,0,'C',true);
$pdf->Ln(17);
$pdf->SetFont('Arial','B','12');
foreach($printL as $keyprint => $valueprint){
$pdf->Cell(40,5,$valueprint,0,0,'L');
$pdf->Cell(5,5,' : ',0,0,'L');
$pdf->Cell(0,5,$printV[$keyprint],0,1,'L');
}
$pdf->Ln(2);
$pdf->Cell(0,0,'',1,0,'L');
$pdf->Ln(5);

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
$pdf->Cell(0,5,"Data Tidak Ditemukan atau Pelanggan ".$ax['name_customer']." Belum Memesan Hari Ini",1,0,'C',true);		
}else{

$pdf->SetFillColor(202,203,209);
	$pdf->Cell(120,7,"Produk",1,0,'C',true);
	$pdf->Cell(20,7,"Qty",1,0,'C',true);
	$pdf->Cell(50,7,"Harga",1,0,'C',true);
$pdf->Ln(7);
	// @mysql_query("INSERT INTO `m_order` Values('',CURRENT_TIMESTAMP())");
	$total = 0;
	while($arr = mysql_fetch_array($cek)){
		$pdf->SetFont('Arial','B','8');
		$pdf->Cell(120,7,$arr['name_product'].'-'.$arr['size_product'],1,0,'L',false);
		$pdf->Cell(20,7,$arr['quantity_detail_transaction'],1,0,'C',false);
		$pdf->Cell(50,7,'Rp. '.number_format($arr['totalHarga'], 0, ",", "."),1,0,'L',false);
		$pdf->Ln(7);
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

$sale = BIAYA_ANTAR;
$grandTotal = ($sumPrice[0] + $sale); 

$tamtotal 	= 'Rp. '.number_format($sumPrice[0],0,',','.');
$antar 		= 'Rp. '.number_format($sale,0,",",".");
$grand 		= 'Rp. '.number_format($grandTotal, 0,",",".");
$pdf->Ln(2);

$pdf->Cell(128,5,"TOTAL",0,0,'L');
$pdf->Cell(12,5,$sumQty[0],0,0,'L');
$pdf->Cell(0,5,$tamtotal,0,1,'L');

$pdf->Cell(140,5,"Biaya Antar",0,0,'L');
$pdf->Cell(0,5,$antar,0,1,'L');

$pdf->Cell(128,5,"GRAND TOTAL",0,0,'L');
$pdf->Cell(12,5,$sumQty[0],0,0,'L');
$pdf->Cell(0,5,$grand,0,1,'L');

$pdf->Ln(2);
$pdf->Cell(0,0,'',1,0,'L');
$pdf->Ln(5);

$pdf->Cell(80,5,"Penerima",0,0,'L');
$pdf->Cell(80,5,"Pengirim",0,0,'L');
$pdf->Cell(0,5,"Depok ".date('d - m - Y'),0,1,'L');
$pdf->Ln(10);

$pdf->Cell(80,5,"",0,0,'L');
$pdf->Cell(80,5,$delivery_man,0,0,'L');
$pdf->Cell(0,5,$employee_fullname,0,1,'L');

/*$to = mysql_fetch_array(mysql_query("SELECT value FROM m_data WHERE name = 'main_office_email'"));
$to = explode(";", str_replace(" ", "", $to['value']));

if(isset($_GET['email'])&&$_GET['email']=='1'){
  $mail = new eMail;
  $mail->to = $to;
  $mail->from = $data_lulu['company_email'];
  $mail->body = $html;
  $mail->subject = "Bukti Cetak Lulu@Delivery";
  $mail->send();
}*/

$pdf->Output();
?>