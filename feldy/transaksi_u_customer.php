<script type="text/javascript">
dojo.ready(function(){
	var storeUndel = dojo.data.ItemFileReadStore({
					url: 'system/generate_undelivered.php'
		});
	var storeUndelSel = storeUndel;
	function panggil_ee(){
		var store = storeUndel;
		storeUndel.fetch({
			query:{code: "*"},
			onItem: function(item){
				var valueSrc = store.getValue(item, 'code');
				console.log('isi item -> '+  valueSrc);
			}
		});
	}

	var eee = function(){
		panggil_ee();
		setTimeout("eee", 3000);
	}
	setTimeout("eee", 3000);
});
</script>
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
					for ($i=0; $i < 10 ; $i++) { 					
				?>
				<tr align="center">
					<td width="60">
						<input dojoType="dijit.form.CheckBox" name="" id="<?php echo $i;?>" value="" />
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
				<?php } ?>
			</table>
			<button dojoType="dijit.form.Button">Kirim</button>
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
	</div>
</div>
