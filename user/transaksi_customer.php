<?php include("configuration/config.php");

	include ("system/created.php");

	$code = $_POST['txt_search'];
	$were = $_POST['data_cust'];
?>
<div align="center">
	<h1>Udah bisa manteman, dah masuk m_detail_transaction, tapi pas balik lg data'a blm muncul</h1>
	<br />
	<br />
	<br />
	<div class="paneTransaksi"> 
		<div class="contentTransaksi" >
			<div id="dataPerusahaan" 
				data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Data LuluKID" '
				>
					<div class="alignTable">
						LuluKids <br />
						Jl. Pekapuran Raya No.xx <br />
						16417 <br />
						021-946424687 <br />
						0875-65421687 <br />
						<a href="#" >lulukid.net</a> <br />
						lulu.kids@lulu-groups.com <br /><br /><br /><br /><br />
					</div>
			</div>
		</div>
		<div class="contentTransaksi" >
			<div  id="dataPelanggan"
					
				data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Data Pelanggan" '>
				 <?php
					
					if($code != null and $were != null){
					$sql = "SELECT * FROM `m_customer` where ".$were." = '".$code."' ";
					
					} else {
						$sql = "SELECT * FROM `m_customer` where name_customer = '".$getCust."' ";
					}
					//echo $sql."<br>";
					$x = mysql_query($sql) or die("query Salah -> ".mysql_error());
					$num = mysql_num_rows($x);
					$ax = mysql_fetch_array($x);
					
				?>
				<form action="index.php?page=transaksi_customer" method="POST" >
					<table cellspacing="3" cellpadding="3">
						<tr>
							<td>
								<select class="myTextField" name="data_cust" id="data_cust">
								  <option value="code_customer" <?php if($were == 'code_customer'){echo "selected";}?>>No. Pelanggan</option>
								  <option value="name_customer" <?php if($were == 'name_customer'){echo "selected";}?>>Nama</option>
								  <option value="phone_customer"<?php if($were == 'phone_customer'){echo "selected";}?>>No. HP</option>
								</select>
							</td>
							<td>:</td>
							<td>
								<input name="txt_search" class="myTextField" dojoType="dijit.form.TextBox" id="txt_search" value="<?php echo $code;?>" />
								<button dojoType="dijit.form.Button" type="submit" name="cari" >Cari</button>
							</td>
						</tr>
						<tr>
							<td colspan="3"><hr /></td>
						</tr>
						<?php
							if($num == null and $kode_transaction == null){
								echo "<tr>
										<td colspan='3'><font color='red' >Data Tidak Ditemukan</font></td>
									  </tr>";
							} else {
						?>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?php echo $ax['name_customer'];?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><?php echo $ax['address_customer'];?></td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td>:</td>
							<td><?php echo $ax['postal_code_customer'];?></td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td>:</td>
							<td><?php echo $ax['phone_customer'];?></td>
						</tr>
						<tr>
							<td>Telepon Rumah</td>
							<td>:</td>
							<td><?php echo $ax['home_phone_customer'];?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $ax['email_customer'];?></td>
						</tr>
						<?php } ?>					
					</table>
				</form>
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>
	<div class="contentInputTransaksi">
		<div	data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Transaksi"'
				style="height: 300px;"
				>
			
			SO No: <?php
				$sqlTrans = "SELECT * FROM m_transaction order by `id_code_customer` DESC LIMIT 0,1 ";
				$exeSql = mysql_query($sqlTrans);
				$arr = mysql_fetch_array($exeSql);

				$id = $arr['id_code_customer'];
				$nama = $ax['name_customer'];
				$date = date('d/m/y');
				$kode_cust = $ax['code_customer'];
				if($code != null){
				$genSo = $nama."-".$id."-".$date;
				}elseif($kode_transaction != null){
				$genSo = $kode_transaction;
				}
				echo $genSo;
				?>
				<div style="width: 600px; height: 200px" id="gridDivTransCust">
				</div>
				<form action="index.php?page=transaksi_customer" method="POST">
						
					<table width="72%" border="1" align="center" cellpadding="0" cellspacing="0">
						<?php
						if($genSo == null){
							$genSo = "";
						}
						$cek = mysql_query("SELECT m_detail_transaction.*,
											m_product.name_product,
											m_product.price_product AS harga,
											(m_detail_transaction.quantity_detail_transaction * m_product.price_product) AS totalHarga 
											FROM m_detail_transaction,m_product
											where m_detail_transaction.code_transaction = 
											'".$genSo."' AND m_product.code_product = m_detail_transaction.code_product")  
											or die("query product salah");					
						$length = mysql_num_rows($cek);
						if($length == null){
							echo "";
						}else{
						$total = 0;
						while($arr = mysql_fetch_array($cek)){
					  ?>
						<tr>
							<td class="align1234"><?php echo $arr["name_product"];?>
							<input dojoType="dijit.form.TextBox" type="hidden" value="<?php echo $genSo;?>" id="id_genso" /></td>
							<td class="align1234"><?php echo $arr["description_detail_transaction"];?></td>
							<td class="align1234"><?php echo $arr["quantity_detail_transaction"];?></td>
							<td class="align1234">Rp. <?php echo number_format($arr["totalHarga"], 0, ",", ".");?></td>
						</tr>
							
						<?php 
						$total = $total + $arr["totalHarga"];
					  
						}} ?>
						
							<tr>
							<td>
								<input class="myTextField" id="filter_product" placeHolder="Kode Produk" dojoType="dijit.form.FilteringSelect" store="null"  searchAttr="nama" name="produk"  />
								<input type="hidden" name="kode" id="kode" value="<?php echo $genSo;?>" />
								<input type="hidden" name="kodeCust" id="kodeCust" value="<?php echo $kode_cust;?>" />
								<input type="hidden" name="txt_search" value="<?php echo $code;?>" />
								<input type="hidden" name="data_cust" value="<?php echo $were;?>" />
								</td>
							<td>
								<input class="myTextField" placeHolder="Keterangan" dojoType="dijit.form.TextBox" name="ket" id="ket" /></td>
							<td>
								<input class="myTextField"
									placeHolder="Quantity"
									dojoType="dijit.form.NumberTextBox"
									required="true" name="qty" id="qty" /></td>
							<td bgcolor="#000000"><button dojoType="dijit.form.Button" type="submit" name="save_product" id="save_product" >save</button></td>
							</tr>
						
					</table></form>
			<div>TOTAL &emsp;&emsp; : <strong><?php echo "Rp. ".number_format($total, 0,",","."); ?></strong></div>
			<?php
				if($total >= 200000 ){ $sale = 0;}else{ $sale = 3000;}
			?>
			<div>Biaya antar  : <strong><?php echo "Rp. ".number_format($sale,0,",",".");?></strong></div>
			<div>GRAND TOTAL  : <strong><?php echo  "Rp. ".number_format($total + $sale, 0,",","."); ?></strong></div>
		</div>
	</div>
	
</div>
<form action="user/system/simpan.php" method="POST">
<div style="margin-left: 900px;">Publikasi Ke &emsp;&emsp;&emsp;: <select name="publikasi">
														<option value="cabang1">Cabang 1</option>
														<option value="cabang2">Cabang 2</option>
														<option value="cabang3">Cabang 3</option>
													</select>
													<input type="hidden" name="code_transaction" value="<?php echo $genSo;?>" />
													<input type="hidden" name="code_customer" value="<?php echo $kode_cust;?>" />
													</div>
<div style="margin-left: 900px;">Model Pembayaran : <select name="model_pembayaran">
														<option value="Transfer" selected="selected">Transfer</option>
														<option value="COD">COD</option>
														<option value="CashToko">Cash Toko</option>
													</select></div>
<div style="margin-left: 900px;"><button dojoType="dijit.form.Button" type="submit" name="simpan_transaction"> Save </button></div>
</form>
