<?php
include("../../configuration/config.php");
?>
<form action="" method="post">
	<button dojoType="dijit.form.Button">Per Hari</button>
	<button dojoType="dijit.form.Button">Per bulan</button>
	&emsp;&emsp;
	<div style="float: right; width: 50%" align="right">
	Filter:
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					name="first"
					placeHolder="Tanggal"
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" />
	S/D 
	<input dojoType="dijit.form.DateTextBox" 
					constraints={datePattern:'yy-MM-dd'} 
					lang="en"
					style="width: 8em;"
					name="last"
					placeHolder="Tanggal"
					promptMessage="yy-MM-dd" 
					invalidMessage="Invalid date. Please use mm/dd/yy format."
					class="myTextField" /><button dojoType="dijit.form.Button" >Filter</button></div>
					<br /><br />
	<table border="1" cellspacing="0" cellpadding="0" width="100%">  
		<tr>
			<th>No.</th>
			<th>Kode Transaksi</th>
			<th>Nama Barang</th>
			<th>Kwantity</th>
			<th>Total</th>		
		</tr>
		<?php $cek = mysql_query("SELECT m_detail_transaction.*,
					m_product.name_product,
					m_product.size_product,
					m_product.price_product AS harga,
					(m_detail_transaction.quantity_detail_transaction * m_product.price_product) AS totalHarga 
					FROM m_detail_transaction,m_product
					where m_product.code_product = m_detail_transaction.code_product order by
					m_detail_transaction.code_transaction ASC") or die("salah");  
			$i=0;
			while($arrSql=mysql_fetch_array($cek)){
			$i++;
			if($i%2==0){ $bg='#ececec'; }else{ $bg='#f5f5f5'; }
		?>
		<tr  bgcolor="<?php echo $bg; ?>" class="linkBorder">
			<td style="padding: 5px;"><?php echo $i;?></td>
			<td style="padding: 5px;"><?php echo $arrSql['code_transaction'];?></td>
			<td style="padding: 5px;"><?php echo $arrSql['name_product'];?></td>
			<td style="padding: 5px;"><?php echo $arrSql['quantity_detail_transaction'];?></td>
			<td style="padding: 5px;"><?php echo $arrSql['totalHarga'];?></td>
		</tr>
		<?php } ?>
	</table>
</form>
