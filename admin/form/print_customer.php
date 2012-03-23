<html>
	<head><title>Print!</title></head>
	<style type="text/css">
	@media print{
		.print{display: none;}
	}
	</style>
	<body>
		
		<table border="0" cellspacing="0" cellpadding="3" width="70%" align="center" style="border: solid 3px #000000">
			<tr>
				<td colspan="4"><div style="background-color: #efefef; width: 100%; font-size: 32px;"  >Data Customer</div></td>
			</tr>
			<?php
				include("../../configuration/config.php");
				
				$id = $_GET['id'];
				$sql = "SELECT * FROM `m_customer` where `code_customer` = '$id'";
				$exeSql = mysql_query($sql) or die("error".mysql_error());
				$arr = mysql_fetch_array($exeSql);
			
			?>
			<tr>
				<td width="30%"></td>
				<td width="20%"></td>
				<td width="30%" align="right">No. Pelanggan</td>
				<td width="25%">: <?php echo $arr['code_customer'];?></td>
			</tr>
			<tr>
				<td>Nama Customer</td>
				<td colspan="3">: <?php echo $arr['name_customer'];?></td>
			</tr>
			<tr>
				<td>No. Pengenal</td>
				<td colspan="3">: <?php echo $arr['pengenal_customer'];?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td colspan="3">: <?php echo $arr['address_customer'];?></td>
			</tr>
			<tr>
				<td>Kota</td>
				<td colspan="3">: <?php echo $arr['kota_customer'];?></td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td colspan="3">: <?php echo $arr['provinsi_customer'];?></td>
			</tr>
			<tr>
				<td>Kode Pos</td>
				<td colspan="3">: <?php echo $arr['postal_code_customer'];?></td>
			</tr>
			<tr>
				<td>HP</td>
				<td colspan="3">: <?php echo $arr['phone_customer'];?></td>
			</tr>
			<tr>
				<td>Telepon Rumah</td>
				<td colspan="3">: <?php echo $arr['home_phone_customer'];?></td>
			</tr>
			<tr>
				<td>Contact Person</td>
				<td colspan="3">: <?php echo $arr['contact_customer'];?></td>
			</tr>
			<tr>
				<td>Email Customer</td>
				<td colspan="3">: <?php echo $arr['email_customer'];?></td>
			</tr>
			<tr class="print">
				<td colspan="4"><a href="#" onClick="print();">Print</a></td>
			</tr>
		</table>
	</body>
</html>
