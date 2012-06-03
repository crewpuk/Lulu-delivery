<?php 
	// print_r($_SESSION);
	include ("../system/created.php");
	include ("../system/simpan.php");
	include ("../system/delete_detail_transaction.php");

	$code = $_SESSION['code_customer'];
	$were = 'code_customer';
	/*if(isset($_POST['txt_search'])){
		$code = $_POST['txt_search'];
	}else{
		$code = $_GET['txt_search'];
	}
	
	if(isset($_POST['data_cust'])){
		$were = $_POST['data_cust'];
	}else{
		$were = $_GET['data_cust'];
	}*/

	$sale = 5000;
?>

<div dojoType="dijit.layout.BorderContainer" style="width:100%;height:400px;margin:0px;padding:0px;">
	<div dojoType="dijit.layout.ContentPane" region="top">
		<div style="width:49%;float:left;">
			<?php
			$q_data = mysql_query("SELECT * FROM m_data");
			$data_lulu = array();
			while($d = mysql_fetch_array($q_data)){
				$index = $d['name'];
				$data_lulu[$index] = $d['value'];
			}
			?>
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<td colspan="3"><h3 style="margin-top:0;"><?php echo $data_lulu['company_name']; ?></h3></td>
				</tr>
				<tr>
					<td valign="top" style="max-width:220px;">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><?php echo nl2br($data_lulu['company_address']); ?></td>
							</tr>
							<tr>
								<td><?php echo nl2br($data_lulu['company_phone']); ?></td>
							</tr>
						</table>
					</td>
					<td width="20"></td>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><a href="#" ><?php echo $data_lulu['company_url']; ?></td>
							</tr>
							<tr>
								<td><?php echo $data_lulu['company_email']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div style="width:49%;float:right;">
			<?php
				echo "1-> ".$were."  2-> ".$code;
				if($code != null and $were != null){
					$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' AND ".$were." = '".$code."' ";
				} else {
					$sql = "SELECT * FROM `m_customer` where `status_customer` = '1' AND name_customer = '".$getCust."' ";
				}
				// echo $sql."<br>";
				$x = mysql_query($sql) or die("query Salah -> ".mysql_error());
				$num = mysql_num_rows($x);
				$ax = mysql_fetch_array($x);
			?>
			<!--code customer which sent to cetak-->
			<input type="hidden" name="id_customer" id="id_customer" value="<?php echo $ax['code_customer'];?>">
			  <table cellspacing="0" cellpadding="2" border="0" width="100%">
					<tr>
						<td valign="top">
							<table>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?php echo $ax['name_customer'];?></td>
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
							</table>
						</td>
						<td width="20"></td>
						<td valign="top">
							<table>
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
							</table>
						</td>
					</tr>				
				</table>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div dojoType="dijit.layout.ContentPane" region="center" style="overflow:auto;">

	<?php if($num == null and $kode_transaction == null){
		echo "";

	}else{	?>
		  	SO No : <?php
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
					$genSo = $date."/LLD/".$id;
				}elseif($kode_transaction != null){
					$genSo = $kode_transaction;
				}
				echo $genSo;
				?>
			 <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
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
							echo '<tr align="center"><td colspan="5"><h3 style="margin-top:2px;color:#550d0d;">Belum Ada Barang Yang Dibeli.</h3></td></tr>';
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
						<img src="../images/32x32/cancel.png" width="25px" /></a></td>
				  </tr>
							
				  <?php 
						$total = $total + $arr["totalHarga"];
					  
						}} ?>						
			  </table>
			  <br />
				<script type="text/javascript">
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
				function print_preview(){
					var var_kc = document.getElementById("id_customer").value;
					var var_kt = document.getElementById("id_genso").value;
					var var_pembayaran = document.getElementById("model_pembayaran").value;
					// var var_delivery = document.getElementById("delivery_man").value;
					window.open("cetak.php?kT="+var_kt+"&kC="+var_kc+"&email=0&pembayaran="+var_pembayaran,"dsds","width=800,height=700,scrollbars=yes");
				}

				function pdf(){
					var var_kc = document.getElementById("id_customer").value;
					var var_kt = document.getElementById("id_genso").value;
					var var_pembayaran = document.getElementById("model_pembayaran").value;
					// var var_delivery = document.getElementById("delivery_man").value;
					window.location="../pdf/pdf.php?kT="+var_kt+"&kC="+var_kc+"&email=0&pembayaran="+var_pembayaran,"dsds","width=800,height=700,scrollbars=yes";
				}
				</script>

			<form action="index.php?page=dashboard&sub=transaksi_customer" id="form_transaction" method="POST">
			  <table width="90%" border="0" cellpadding="1" cellspacing="1">
			  	<tr>
			  		<td width="52%" align="right">Total</td>
			  		<td width="1">:</td>
			  		<td><strong><?php echo "Rp. ".number_format($total, 0,",","."); ?></strong></td>
			  	</tr>
			  	<tr>
			  		<td align="right">Biaya Antar</td>
			  		<td>:</td>
			  		<td><strong><?php echo "Rp. ".number_format($sale,0,",","."); ?></strong></td>
			  	</tr>
			  	<tr>
			  		<td align="right">GRAND TOTAL</td>
			  		<td>:</td>
			  		<td><strong><?php echo "Rp. ".number_format($total + $sale, 0,",","."); ?></strong></td>
			  	</tr>
			  	<tr>
			  		<td align="right">Model Pembayaran</td>
			  		<td>:</td>
			  		<td><select dojoType="dijit.form.Select" style="width: 100px;" name="model_pembayaran" id="model_pembayaran">
																	<option value="Transfer" selected="selected">Transfer</option>
																	<option value="COD">COD</option>
																	<option value="CashToko">Cash Toko</option>
																</select></td>
			  	</tr>
			  	<tr>
			  		<td align="right">
			  			&emsp;<a href="javascript:print_preview();"><img src="../images/32x32/searchdoc.png" style="vertical-align: middle;">Print Preview</a>
			  		</td>
			  		<td> </td>
			  		<td>
			  			<button dojoType="dijit.form.Button" type="button" name="simpan_transaction" onclick="save_transaction()">&emsp;&emsp;Save&emsp;&emsp;</button>

			  		</td>
			  		<td> </td>
			  		<td> 
			  			&emsp;<a href="javascript:pdf();">Download PDF</a>
			  		</td>
			  	</tr>
			  </table>
			<input type="hidden" name="code_transaction" value="<?php echo $genSo;?>" />
			<input type="hidden" id="id_customer" name="code_customer" value="<?php echo $kode_cust;?>" />
			<input type="hidden" name="simpan_transaction" value="1" />
			<input type="hidden" name="send_email" id="send_email" value="0" />
			</form>

	<?php } ?>

	</div>
	<?php if($num == null and $kode_transaction == null){
		echo "";

	}else{	?>
	<div dojoType="dijit.layout.ContentPane" region="right" splitter="false" style="width:400px;margin:0px;padding:1px;">
		<form action="index.php?page=dashboard&sub=transaksi_customer" method="POST">
			<input dojoType="dijit.form.TextBox" type="hidden" value="<?php echo $genSo;?>" id="id_genso" />
			<div style="width:400px;margin:5px;">
				<span dojoType="dojo.data.ItemFileReadStore" url='../system/generate_produk_customer.php' jsid="storeFilterSelect"></span>
				<input id="filter_product" placeHolder="Pilih Produk"
					style="width:388px;"
					dojoType="dijit.form.FilteringSelect"
					required="false"
					invalidMessage="Data Tidak Ditemukan, Harap Pilih Melalui Dropdown !"
					pageSize="5"
					store="storeFilterSelect"
					searchAttr="nama"
					name="produk"  />
				<input type="hidden" name="kode" id="kode" value="<?php echo $genSo;?>" />
				<input type="hidden" name="kodeCust" id="kodeCust" value="<?php echo $kode_cust;?>" />
				<input type="hidden" name="txt_search" value="<?php echo $code;?>" />
				<input type="hidden" name="data_cust" value="<?php echo $were;?>" />
			</div>
			
			<div style="width:50%; height: 200px;float:left; margin-left: 6px;"><a dojoType="dojox.image.Lightbox" id="imageLightBox" href="../images/no_image.jpg"><img id="idImage" src="../images/no_image.jpg" width="95%"></a></div>
			<div style="width:45%;float:right;">Jumlah Beli : <br />
				<input name="qty" id="qty" maxlength="3"
					style="width:55px;"
					placeHolder="Jumlah"
					invalidMessage="Isian harus berupa Angka !"
					constraints="{min:0,max:999}"
					dojoType="dijit.form.NumberTextBox"
					required="false" />
				<br />
				<br />
				<button dojoType="dijit.form.Button" type="submit" name="save_product" id="save_product" style="width: 40px;"><img src="../images/32x32/add.png" width="23px"> Beli !</button>
				<br />
				<br />
				<?php
					$data = '';
					$filenames = glob('../images/product/*.jpg');
					foreach ($filenames as $filename) {
					    $data .= $filename.'+';
					    //echo $data;
					}
					//echo $data;
				?>
				<input type="hidden" dojoType="dijit.form.SimpleTextarea" id="globalCheckProduct" value="<?php echo $data;?>"/> 

			</div>
		</form>
	</div>
	<?php } ?>
</div>
