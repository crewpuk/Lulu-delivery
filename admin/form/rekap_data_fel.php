<?php
include("../../configuration/config.php");
	$first 	= $_POST['btnFirst'];
	$last 	= $_POST['btnLast'];
	
if(isset($_POST['btnFilter'])){
	//echo $first."/".$last;
	$addSql = "AND DATE(m_detail_transaction.created_date) BETWEEN '$first' AND '$last' ";
}elseif(isset($_POST['btnHari'])){
	$hari = date('Y-m-d');
	//echo $hari;
	$addSql = "AND DATE(m_detail_transaction.created_date) = '$hari'";
	$first = "";
	$last = "";
	$btnHari = true;
	
}
?>
<form action="" method="post">
	<button dojoType="dijit.form.Button" type="submit" name="btnHari">Per Hari</button>
	&emsp;&emsp;
	<div style="float: right; width: 50%" align="right">
	Filter:
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					placeHolder="Tanggal"
					name="btnFirst"
					value="<?php echo $first;?>"
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" />
	S/D 
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					placeHolder="Tanggal"
					name="btnLast"
					value="<?php echo $last;?>"
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" />
					<button dojoType="dijit.form.Button" name="btnFilter" type="submit" >Filter</button></div>
					<br /><br />
	<table border="1" cellspacing="0" cellpadding="0" width="100%">  
		<tr>
			<th>No.</th>
			<th>No. Pelanggan</th>
			<th>Nama Pelanggan</th>
			<th>Alamat Pengiriman</th>
			<th>No. Telepon</th>
			<th>Nama Barang</th>
			<th>Total</th>		
		</tr>
		<?php
		$sql = "SELECT m_detail_transaction.*,m_customer.*,m_transaction.*,
					m_product.name_product,
					m_product.size_product,
					m_product.price_product AS harga,
					(m_detail_transaction.quantity_detail_transaction * m_product.price_product) AS totalHarga 
					FROM m_detail_transaction,m_product,m_customer,m_transaction
					where m_product.code_product = m_detail_transaction.code_product 
					AND m_detail_transaction.code_transaction = m_transaction.code_transaction
					AND m_transaction.code_customer = m_customer.code_customer
					$addSql order by
					m_detail_transaction.code_transaction ASC";
		$cek = mysql_query($sql) or die("salah".mysql_error().$sql);
		//echo $sql;
			$i=0;
			while($arrSql=mysql_fetch_array($cek)){
			$i++;
			if($i%2==0){ $bg='#ececec'; }else{ $bg='#f5f5f5'; }
		?>
		<tr  bgcolor="<?php echo $bg; ?>" class="linkBorder">
			<td style="padding: 5px;" align="center"><?php echo $i;?></td>
			<td style="padding: 5px;" align="center"><?php echo $arrSql['code_transaction'];?></td>
			<td style="padding: 5px;"><?php echo $arrSql['name_customer'];?></td>
			<td style="padding: 5px;"><?php echo nl2br($arrSql['address_customer']);?></td>
			<td style="padding: 5px;"><?php echo $arrSql['phone_customer'];?></td>
			<td style="padding: 5px;" align="center"><?php echo $arrSql['name_product'].' '.$arrSql['size_product'];?></td>
			<td style="padding: 5px;" align="center"><?php echo "Rp. ".number_format($arrSql['totalHarga'],0,",",".");?></td>
		</tr>
		<?php } ?>
	</table>
	<div align="center"><a href="#" onClick="window.open('form/print_rekap_data.php?sql=<?php echo rawurlencode($sql);?>&tglF=<?php echo $first; ?>&tglL=<?php echo $last; ?>&btnHari=<?php echo $btnHari; ?>','Print','width=700px, height=800px, scrollbars=yes');"><img title="Print" src="<?php echo BASE; ?>images/64x64/printer.png" width="64" height="64" alt="print" /></a></div>
</form>
