<?php
include "../configuration/config.php";
$id = urldecode($_GET['i']);
$full = (isset($_GET['notfull']))?false:true;

if(isset($_POST)&&!empty($_POST)){
	$e=explode(".",$_POST['all']);
	$ce=count($e);
	for($z=0;$z<$ce;$z++){
		$id_sub_office = $_POST["sub_".$e[$z]];
		$id_detail_transaction = $e[$z];
		mysql_query("UPDATE m_detail_transaction SET id_sub_office = '$id_sub_office' WHERE id_detail_transaction = '$id_detail_transaction' LIMIT 1") or die(mysql_error());
	}
	header("location: ".$_SERVER['REQUEST_URI']);
}

?><html>
<head>
	<title>Detail Transaksi</title>
</head>
<body>
	<form name="detail" method="post" action="">
	<table align="center" width="95%" border="1" cellspacing="2" cellpadding="2">
		<tr>
			<td>No</td>
			<td>Nama Barang</td>
			<td>Jumlah</td>
			<?php if($full){?><td>Cabang</td><?php }?>
		</tr>
		<?php
		$res_detail = mysql_query("SELECT 
									A.id_detail_transaction AS id_detail,
									A.code_product AS code_product,
									(SELECT CONCAT(name_product, ' - ', size_product) FROM m_product P WHERE P.code_product = A.code_product) AS nama_product,
									A.quantity_detail_transaction AS jumlah,
									A.id_sub_office AS cabang
									FROM m_detail_transaction A
									WHERE code_transaction = '$id'") or die(mysql_error());
		$i=0;
		$all_id_sub="";
		while($data_detail = mysql_fetch_array($res_detail)){
			$i++;
			$code_product = $data_detail['code_product'];
			$all_id_sub .= ($i>1)?".".$data_detail['id_detail']:$data_detail['id_detail'];
		?><tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data_detail['nama_product'];?></td>
			<td><?php echo $jumlah = $data_detail['jumlah'];?></td>
			<?php if($full){?><td>
				<select name="sub_<?php echo $data_detail['id_detail'];?>" id="sub_<?php echo $data_detail['id_detail'];?>">
					<option value="0"> -- </option>
					<?php
					$res_cabang = mysql_query("SELECT 
												id_sub_office AS id_cabang,
												(SELECT name_sub_office FROM m_sub_office O WHERE O.id_sub_office = S.id_sub_office) AS nama_cabang 
												FROM m_stock S 
												WHERE S.code_product = '$code_product' AND 
													S.stock >= '$jumlah'") or die(mysql_error());
					while($data_cabang = mysql_fetch_array($res_cabang)){
					?><option value="<?php echo $data_cabang['id_cabang'];?>"<?php echo($data_detail['cabang']==$data_cabang['id_cabang'])?' selected="selected"':"";?>><?php echo $data_cabang['nama_cabang'];?></option><?php
					}?>
				</select>
			</td><?php }?>
		</tr><?php
		}?>
		<?php if($full){?><tr>
			<td colspan="4" align="right" style="border: none;">
				<script type="text/javascript">
				function safe_close(state){
					window._close=state;
					window.close();
				}
				</script>
				<input type="submit" name="save_detail" id="save_detail" value="Save" />
				<input type="button" onclick="safe_close(true)" value="Finish" />
				<input type="button" onclick="safe_close(false)" value="Cancel" />
			</td>
		</tr><?php }?>
	</table>
	<?php if($full){?><input type="hidden" name="all" id="all" value="<?php echo $all_id_sub;?>" /><?php }?>
	</form>
</body>
</html>