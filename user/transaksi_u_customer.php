<?php
if(isset($_POST)){

	if(isset($_POST['kirim_delivery'])&&$_POST['kirim_delivery']=="Kirim"){
		$e=explode(".", $_POST['transaction_all']);
		$ce=count($e);
		for($x=0;$x<$ce;$x++){
			// if checked
			if(isset($_POST['c_'.$e[$x]])&&$_POST['c_'.$e[$x]]=='1'){
				$id_delivery = $_POST['s_'.$e[$x]];
				$id_transaction = $e[$x];
				mysql_query("UPDATE m_transaction SET id_delivery = '$id_delivery' WHERE id_transaction = '$id_transaction' LIMIT 1");

				$res_transaction = mysql_query("SELECT code_transaction, code_customer FROM m_transaction WHERE id_transaction = '$id_transaction'");
				$data_transaction = mysql_fetch_array($res_transaction);

				$code_transaction = urlencode($data_transaction['code_transaction']);
				$code_customer = urlencode($data_transaction['code_customer']);

				$url = BASE."user/cetak.php?kT=$code_transaction&kC=$code_customer&email=1&delivery=$id_delivery&notprint";
				$title = "cetak_detail_$id_transaction";
				$option = "width=800,height=700,scrollbars=yes";

				echo("<script type='text/javascript'>window.open('$url','$title','$option');</script>");
			}
		}
	}

}
if(isset($_GET['abort'])){
	$id_abort = $_GET['abort'];
	mysql_query("UPDATE m_transaction SET id_delivery = '2' WHERE id_transaction = '$id_abort'");
}
if(isset($_GET['unabort'])){
	$id_unabort = $_GET['unabort'];
	mysql_query("UPDATE m_transaction SET id_delivery = '1' WHERE id_transaction = '$id_unabort'");
}
?>
<div id="mainTabContainer" dojoType="dijit.layout.TabContainer" style="width: 90%; height: 90%;">
	<script type="text/javascript">
	// show detail_window
	function show_detail(i,notfull){
		window._close = false;
		var nf = (notfull==true)?'&notfull':'';
		var win_detail = window.open(<?php echo "\"".BASE."user/u_detail.php?i=\"+i+nf";?>,"detail","width=800,height=500,scrollbars=yes");
		// reload when detail_window closed
		win_detail.onbeforeunload = function(){
			console.log(win_detail._close);
			if(win_detail._close==true){
				window.location.reload(true);
			}
		}
	}
	</script>
	<div id="contentNotDelivered" dojoType="dijit.layout.ContentPane" title="Belum Terkirim">
			<form method="post" action="">
			<table border="1" width="100%"> 
				<tr align="center">
					<td width="60">
						Select All <br />
						<input dojoType="dijit.form.CheckBox" id="masterCheck"/>
					</td>
					<td>No.</td>
					<td>No. Transaction</td>
					<td>Tanggal Transaction</td>
					<td>Detail Transaction</td>
					<td>Nama Customer</td>
					<td>Delivery Man</td>
					<td>Status</td>
					<td> </td>
				</tr>
				<?php
				// status_transaksi if id_delivery
				// 1  : Belum Terkirim
				// 2  : Dibatalkan
				// >2 : Terkirim
					$res = mysql_query("SELECT 
										A.id_transaction AS id_transaction,
										A.code_transaction, 
										DATE(A.time_transaction) AS tgl_transaksi,
										(SELECT B.name_customer FROM m_customer B WHERE B.code_customer = A.code_customer) AS nama_customer,
										IF(A.id_delivery=1, 'Belum Terkirim', IF(A.id_delivery=2, 'Dibatalkan', 'Terkirim')) AS status_transaksi
										FROM m_transaction A 
										WHERE A.id_delivery = 1 
										ORDER BY A.time_transaction DESC
										") or die(mysql_error());
					$num = mysql_num_rows($res);
					if($num==0){
				?>
				<tr align="center">
					<td colspan="9" align="center">Tidak Ada Data yang Belum Terkirim</td>
				</tr>
				<?php
					}
					else{
					$i = 1;
					$all_transaction = "";
					while($arrRes = mysql_fetch_array($res)) {
					$all_transaction .= ($i>1)?".".$arrRes['id_transaction']:$arrRes['id_transaction']; 				
					$e = explode("-", $arrRes['tgl_transaksi']);
					$tgl = $e[2].'-'.$e[1].'-'.$e[0];

					$res_sub_office = mysql_query("SELECT id_sub_office FROM m_detail_transaction WHERE code_transaction = '".$arrRes['code_transaction']."'");
					$sub_office_in = array();
					while($data_sub_office = mysql_fetch_array($res_sub_office)){
						$sub_office_in[] = $data_sub_office['id_sub_office'];
					}
					$sub_office_state = (in_array("0", $sub_office_in))?false:true;
				?>
				<tr align="center">
					<td width="60">
						<input dojoType="dijit.form.CheckBox" name="c_<?php echo $arrRes['id_transaction'];?>"<?php echo ($sub_office_state===true)?"":' disabled="disabled"';?> id="c_<?php echo $arrRes['id_transaction'];?>" value="1" />
					</td>
					<td><?php echo $i;?></td>
					<td><?php echo $arrRes['code_transaction'];?></td>
					<td><?php echo $tgl?></td>
					<td><a href="javascript:;" onclick="show_detail('<?php echo urlencode($arrRes['code_transaction']);?>',false);">Detail</a></td>
					<td><?php echo $arrRes['nama_customer'];?></td>
					<td>
						<select name="s_<?php echo $arrRes['id_transaction'];?>" id="s_<?php echo $arrRes['id_transaction'];?>">
							<?php
							$res_delivery_man = mysql_query("SELECT id_delivery,name_delivery FROM m_delivery WHERE id_delivery > 2 ORDER BY name_delivery ASC");
							while($data_delivery_man = mysql_fetch_array($res_delivery_man)){
							?><option value="<?php echo $data_delivery_man['id_delivery'];?>"><?php echo $data_delivery_man['name_delivery'];?></option><?php
							}?>
						</select>
					</td>
					<td><?php echo $arrRes['status_transaksi'];?></td>
					<td><a href="<?php echo BASE.'index.php?page=dashboard&sub=transaksi_u_customer&abort='.$arrRes['id_transaction'];?>">Batalkan</a></td>
				</tr>
				<?php $i++; }} ?>
			</table>
			<input type="hidden" name="transaction_all" id="transaction_all" value="<?php echo $all_transaction;?>" />
			<button dojoType="dijit.form.Button" type="submit" name="kirim_delivery" value="Kirim" id="kirimCoba" >Kirim</button>
			</form>
	</div>
	<div id="contentDelivered" dojoType="dijit.layout.ContentPane" title="Terkirim" >
			<!--<table>
				<tr>
					<td>
						Kode Transaksi
					</td>
					<td>
						Kode Customer

					</td>
				</tr>
			</table>
			<input dojoType="dijit.form.Textarea" type="hidden" id="handleCheckBox" />-->

			<table border="1" width="100%"> 
				<tr align="center">
					<td>No.</td>
					<td>No. Transaction</td>
					<td>Tanggal Transaction</td>
					<td>Detail Transaction</td>
					<td>Nama Customer</td>
					<td>Delivery Man</td>
					<td>Status</td>
					<td> </td>
				</tr>
				<?php
				// status_transaksi if id_delivery
				// 1  : Belum Terkirim
				// 2  : Dibatalkan
				// >2 : Terkirim
					$res = mysql_query("SELECT 
										A.id_transaction AS id_transaction,
										A.code_transaction, 
										DATE(A.time_transaction) AS tgl_transaksi,
										(SELECT B.name_customer FROM m_customer B WHERE B.code_customer = A.code_customer) AS nama_customer,
										IF(A.id_delivery=1, 'Belum Terkirim', IF(A.id_delivery=2, 'Dibatalkan', 'Terkirim')) AS status_transaksi
										FROM m_transaction A 
										WHERE A.id_delivery > 2 
										ORDER BY A.time_transaction DESC
										") or die(mysql_error());
					$num = mysql_num_rows($res);
					if($num==0){
				?>
				<tr align="center">
					<td colspan="9" align="center">Tidak Ada Data yang Terkirim</td>
				</tr>
				<?php
					}
					else{
					$i = 1;
					$all_transaction = "";
					while($arrRes = mysql_fetch_array($res)) {
					$all_transaction .= ($i>1)?".".$arrRes['id_transaction']:$arrRes['id_transaction']; 				
					$e = explode("-", $arrRes['tgl_transaksi']);
					$tgl = $e[2].'-'.$e[1].'-'.$e[0];

					$res_sub_office = mysql_query("SELECT id_sub_office FROM m_detail_transaction WHERE code_transaction = '".$arrRes['code_transaction']."'");
					$sub_office_in = array();
					while($data_sub_office = mysql_fetch_array($res_sub_office)){
						$sub_office_in[] = $data_sub_office['id_sub_office'];
					}
					$sub_office_state = (in_array("0", $sub_office_in))?false:true;
				?>
				<tr align="center">
					<td><?php echo $i;?></td>
					<td><?php echo $arrRes['code_transaction'];?></td>
					<td><?php echo $tgl?></td>
					<td><a href="javascript:;" onclick="show_detail('<?php echo urlencode($arrRes['code_transaction']);?>',true);">Detail</a></td>
					<td><?php echo $arrRes['nama_customer'];?></td>
					<td>
						<select name="s_<?php echo $arrRes['id_transaction'];?>" id="s_<?php echo $arrRes['id_transaction'];?>">
							<?php
							$res_delivery_man = mysql_query("SELECT id_delivery,name_delivery FROM m_delivery WHERE id_delivery > 2 ORDER BY name_delivery ASC");
							while($data_delivery_man = mysql_fetch_array($res_delivery_man)){
							?><option value="<?php echo $data_delivery_man['id_delivery'];?>"><?php echo $data_delivery_man['name_delivery'];?></option><?php
							}?>
						</select>
					</td>
					<td><?php echo $arrRes['status_transaksi'];?></td>
					<td><a href="<?php echo BASE.'index.php?page=dashboard&sub=transaksi_u_customer&abort='.$arrRes['id_transaction'];?>">Batalkan</a></td>
				</tr>
				<?php $i++; }} ?>
			</table>
	</div>
	<div id="contentAborted" dojoType="dijit.layout.ContentPane" title="Dibatalkan" >
			<!--<table>
				<tr>
					<td>
						Kode Transaksi
					</td>
					<td>
						Kode Customer

					</td>
				</tr>
			</table>
			<input dojoType="dijit.form.Textarea" type="hidden" id="handleCheckBox" />-->

			<table border="1" width="100%"> 
				<tr align="center">
					<td>No.</td>
					<td>No. Transaction</td>
					<td>Tanggal Transaction</td>
					<td>Detail Transaction</td>
					<td>Nama Customer</td>
					<td>Delivery Man</td>
					<td>Status</td>
					<td> </td>
				</tr>
				<?php
				// status_transaksi if id_delivery
				// 1  : Belum Terkirim
				// 2  : Dibatalkan
				// >2 : Terkirim
					$res = mysql_query("SELECT 
										A.id_transaction AS id_transaction,
										A.code_transaction, 
										DATE(A.time_transaction) AS tgl_transaksi,
										(SELECT B.name_customer FROM m_customer B WHERE B.code_customer = A.code_customer) AS nama_customer,
										IF(A.id_delivery=1, 'Belum Terkirim', IF(A.id_delivery=2, 'Dibatalkan', 'Terkirim')) AS status_transaksi
										FROM m_transaction A 
										WHERE A.id_delivery = 2 
										ORDER BY A.time_transaction DESC
										") or die(mysql_error());
					$num = mysql_num_rows($res);
					if($num==0){
				?>
				<tr align="center">
					<td colspan="9" align="center">Tidak Ada Data yang Dibatalkan</td>
				</tr>
				<?php
					}
					else{
					$i = 1;
					$all_transaction = "";
					while($arrRes = mysql_fetch_array($res)) {
					$all_transaction .= ($i>1)?".".$arrRes['id_transaction']:$arrRes['id_transaction']; 				
					$e = explode("-", $arrRes['tgl_transaksi']);
					$tgl = $e[2].'-'.$e[1].'-'.$e[0];

					$res_sub_office = mysql_query("SELECT id_sub_office FROM m_detail_transaction WHERE code_transaction = '".$arrRes['code_transaction']."'");
					$sub_office_in = array();
					while($data_sub_office = mysql_fetch_array($res_sub_office)){
						$sub_office_in[] = $data_sub_office['id_sub_office'];
					}
					$sub_office_state = (in_array("0", $sub_office_in))?false:true;
				?>
				<tr align="center">
					<td><?php echo $i;?></td>
					<td><?php echo $arrRes['code_transaction'];?></td>
					<td><?php echo $tgl?></td>
					<td><a href="javascript:;" onclick="show_detail('<?php echo urlencode($arrRes['code_transaction']);?>',true);">Detail</a></td>
					<td><?php echo $arrRes['nama_customer'];?></td>
					<td>
						<select name="s_<?php echo $arrRes['id_transaction'];?>" id="s_<?php echo $arrRes['id_transaction'];?>">
							<?php
							$res_delivery_man = mysql_query("SELECT id_delivery,name_delivery FROM m_delivery WHERE id_delivery > 2 ORDER BY name_delivery ASC");
							while($data_delivery_man = mysql_fetch_array($res_delivery_man)){
							?><option value="<?php echo $data_delivery_man['id_delivery'];?>"><?php echo $data_delivery_man['name_delivery'];?></option><?php
							}?>
						</select>
					</td>
					<td><?php echo $arrRes['status_transaksi'];?></td>
					<td><a href="<?php echo BASE.'index.php?page=dashboard&sub=transaksi_u_customer&unabort='.$arrRes['id_transaction'];?>">Belum Terkirim</a></td>
				</tr>
				<?php $i++; }} ?>
			</table>
	</div>
</div>
