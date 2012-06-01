<div id="mainTabContainer" dojoType="dijit.layout.TabContainer" style="widtb: 90%; height: 90%;">
	<div id="contentDelivered" dojoType="dijit.layout.ContentPane" title="Delivered">
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
					<td>Delivery</td>
					<td>Status</td>
					<td>Delete</td>
				</tr>
				<?php 
					$res = mysql_query("SELECT * FROM m_transaction") or die(mysql_error());
					$i = 1;
					while($arrRes = mysql_fetch_array($res)) { 				
					
				?>
				<tr align="center">
					<td width="60">
						<input dojoType="dijit.form.CheckBox" name="" disabled="disabled" id="<?php echo $arrRes['code_transaction']; ?>" value="" />
					</td>
					<td><?php echo $i;?></td>
					<td><?php echo $arrRes['code_transaction'];?></td>
					<td>Tanggal Transaction</td>
					<td>Detail Transaction</td>
					<td>Nama Customer</td>
					<td>Delivery</td>
					<td>Status</td>
					<td>Delete</td>
				</tr>
				<?php $i++; } ?>
			</table>
			<button dojoType="dijit.form.Button" id="kirimCoba">Kirim</button>
	</div>
	<div id="contentNotDelivered" dojoType="dijit.layout.ContentPane" title="Not Delivered" >
			<table>
				<tr>
					<td>
						Kode Transaksi
					</td>
					<td>
						Kode Customer

					</td>
				</tr>
			</table>
			<input dojoType="dijit.form.Textarea" type="hidden" id="handleCheckBox" />
	</div>

</div>
