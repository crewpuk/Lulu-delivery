
<?php 
	include ("system/created.php");
	include ("system/simpan.php");
	include ("system/delete_detail_transaction.php");

	if(isset($_POST['txt_search'])){
		$code = $_POST['txt_search'];
	}else{
		$code = $_GET['txt_search'];
	}
	
	if(isset($_POST['data_cust'])){
		$were = $_POST['data_cust'];
	}else{
		$were = $_GET['data_cust'];
	}
?>

<div dojoType="dijit.layout.BorderContainer" splitter="true" style="width: 100%; height:400px; ">
<div dojoType="dijit.layout.ContentPane" overflow="true" region="center" style="width: 70%; ">
<div align="center"><br />
	<div class="paneTransaksi"> 
		<div class="contentTransaksi" >
			<div id="dataPerusahaan" 
				data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Data Lulu@delivery" '
				>
					<?php
					$q_data = mysql_query("SELECT * FROM m_data");
					$data_lulu = array();
					while($d = mysql_fetch_array($q_data)){
						$index = $d['name'];
						$data_lulu[$index] = $d['value'];
					}
					?>
					<div class="alignTable">
						<?php echo $data_lulu['company_name']; ?> <br />
						<?php echo nl2br($data_lulu['company_address']); ?> <br />
						<?php echo nl2br($data_lulu['company_phone']); ?> <br />
						<a href="#" ><?php echo $data_lulu['company_url']; ?></a> <br />
						<?php echo $data_lulu['company_email']; ?> <br /><br /><br /><br /><br />
					</div>
			</div>
		</div>
		<div class="contentTransaksi" >
			<div  id="dataPelanggan"
					
				data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Data Pelanggan" '>
				 <?php
					
					if($code != null and $were != null){
						$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' AND ".$were." = '".$code."' ";
					} else {
						$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' AND name_customer = '".$getCust."' ";
					}
					//echo $sql."<br>";
					$x = mysql_query($sql) or die("query Salah -> ".mysql_error());
					$num = mysql_num_rows($x);
					$ax = mysql_fetch_array($x);
					
				?>
				<form action="index.php?page=dashboard&sub=transaksi_customer" method="POST" >
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
										<td colspan='3'><font color='red' >Data Belum Ditemukan</font></td>
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
	<?php if($num == null and $kode_transaction == null){
		echo "";

	}else{	?>
	<div class="contentInputTransaksi">
		<div	data-dojo-type="dijit.TitlePane" 
				data-dojo-props='title:"Transaksi"'
				overFlow="true"
				style="height: 300px; width:90%;"
				>
			
			SO No: <?php
				$sqlTrans = "SELECT * FROM `m_transaction` order by `id_code_customer` DESC LIMIT 0,1 ";
				$exeSql = mysql_query($sqlTrans);
				$arr = mysql_fetch_array($exeSql);

				$nomor = $arr['id_code_customer'];
				if($nomor == null){
				$id = 1;	
				}else{
				$id = $nomor+1;	
				}
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
		  <form action="index.php?page=dashboard&sub=transaksi_customer" method="POST">
					<input dojoType="dijit.form.TextBox" type="hidden" value="<?php echo $genSo;?>" id="id_genso" />
			  <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
				  
				<tr>
					<th width="48%" align="center" class="headerTab">Nama Barang</th>
				   
				    <th width="3%" align="center" class="headerTab">Qty</th>
				    <th width="13%" align="center" class="headerTab">Harga Satuan</th>
					<th width="20%" align="center" class="headerTab">Total</th>
					<th width="5%" align="center" class="headerTab">Action</th>
			    </tr>
                <?php
						if($genSo == null){
							$genSo = "";
						}
						$cek = mysql_query("SELECT m_detail_transaction.*,
											m_product.name_product,
											m_product.size_product,
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
				  <tr align="center">
					  <td ><?php echo $arr["name_product"].'-'.$arr['size_product'];?></td>
					 
					  <td align="center"><?php echo $arr["quantity_detail_transaction"];?></td>
					  <td >Rp. <?php echo number_format($arr["harga"], 0, ",",".");?></td>
					  <td >Rp. <?php echo number_format($arr["totalHarga"], 0, ",", ".");?></td>
					  <td  >
						  <a href="index.php?page=dashboard&sub=transaksi_customer&txt_search=<?php echo $code;?>&data_cust=<?php echo $were;?>&halaman=delete&id=<?php echo $arr[0]; ?>">
						<img src="images/32x32/cancel.png" width="25px" /></a></td>
				  </tr>
							
				  <?php 
						$total = $total + $arr["totalHarga"];
					  
						}} ?>
						
					  <tr>
						<td>
							 <span dojoType="dojo.data.ItemFileReadStore" url='system/generate_produk.php' jsid="storeFilterSelect"></span>
							<input class="myTextField" id="filter_product" placeHolder="Nama Produk"
								style="width: 30em;"
								dojoType="dijit.form.FilteringSelect"
								store="storeFilterSelect"
								searchAttr="nama"
								name="produk"  />
							<input type="hidden" name="kode" id="kode" value="<?php echo $genSo;?>" />
							<input type="hidden" name="kodeCust" id="kodeCust" value="<?php echo $kode_cust;?>" />
							<input type="hidden" name="txt_search" value="<?php echo $code;?>" />
							<input type="hidden" name="data_cust" value="<?php echo $were;?>" />
					    </td>
						
						<td colspan="2">
						  <input name="qty" class="myTextField" id="qty" maxlength="3"
									placeHolder="Quantity"
									dojoType="dijit.form.NumberTextBox"
									required="true" /></td>
						<td>
							<span dojoType="dojo.data.ItemFileReadStore" url='system/generate_data_cabang.php' jsid="storeCabangFil"></span>
							<input class="myTextField" id="filter_cabang_cmb" placeHolder="Pilih Cabang"
								style="width: 10em;"
								dojoType="dijit.form.FilteringSelect"
								store="storeCabangFil"
								searchAttr="name_sub_office"
								name="cabangfilter"  />
						</td>
						<td bgcolor="#CEE2F4" colspan="2" align="center"><button dojoType="dijit.form.Button" type="submit" name="save_product" id="save_product" >Save</button></td>
					  </tr>
						
			  </table></form>
			<div>TOTAL &emsp;&emsp; : <strong><?php echo "Rp. ".number_format($total, 0,",","."); ?></strong></div>
			<?php
				if($total >= 200000 ){ $sale = 0;}else{ $sale = 5000;}
			?>
			<div>Biaya antar  : <strong><?php echo "Rp. ".number_format($sale,0,",",".");?></strong></div>
			<div>GRAND TOTAL  : <strong><?php echo  "Rp. ".number_format($total + $sale, 0,",","."); ?></strong></div>
		</div>
	</div>
</div><br />


<script type="text/javascript">
// Fungsi untuk simpan transaksi dan pengontrol kirim email atau tidak
function save_transaction(){
	if(confirm("Anda yakin?")){
		if(confirm("Kirim email?")){
			document.getElementById("send_email").value = "1";
		}
		else{
			document.getElementById("send_email").value = "0";
		}
		document.forms["form_transaction"].submit();
	}
	else return false;
}
</script>


<form action="index.php?page=dashboard&sub=transaksi_customer" id="form_transaction" method="POST">
<div style="margin-left: 470px;">Publikasi Ke &emsp;&emsp;&emsp;: <select name="publikasi">
														<?php
														$sub_office_q = mysql_query("SELECT * FROM m_sub_office");
														while($data_sub_office = mysql_fetch_array($sub_office_q)){
															echo "<option value='".$data_sub_office['id_sub_office']."'>".$data_sub_office['name_sub_office']."</option>\n";
														}
														?>
													</select>
													<input type="hidden" name="code_transaction" value="<?php echo $genSo;?>" />
													<input type="hidden" name="code_customer" value="<?php echo $kode_cust;?>" />
													<input type="hidden" name="simpan_transaction" value="1" />
													<input type="hidden" name="send_email" id="send_email" value="0" />
													</div><br />
<div style="margin-left: 470px;">Model Pembayaran : <select name="model_pembayaran">
														<option value="Transfer" selected="selected">Transfer</option>
														<option value="COD">COD</option>
														<option value="CashToko">Cash Toko</option>
													</select></div><br />
<div style="margin-left: 550px;"><button dojoType="dijit.form.Button" type="button" name="simpan_transaction" onclick="save_transaction()"> Save </button></div>
</form>
</div>
<?php } ?>
</div>
