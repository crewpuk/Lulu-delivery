//dashboard


dojo.ready(function(){
	
		
	var borderPane = new dijit.layout.BorderContainer({
		id: 'panelUtama',
		style: 'height:600px;width:100%'
	}, 'divBorder');

	borderPane.startup();

	//~ var tree = dijit.byId('idTree');
		//~ dojo.connect(tree, "onClick", function(evt){
			//~ var panel = dijit.byId('panelCenter');
			//~ if(evt.id == 'transaksi'){
				//~ panel.set('href', 'index2.php');
			//~ }else if(evt.id == 'account'){
				//~ panel.set('content', 'account');
			//~ }
		//~ });
		
	var storeFil = dojo.data.ItemFileReadStore({
				url: 'system/generate_produk.php'
	});

	dojo.connect(dijit.byId('filter_product'), 'onChange', function(value){
		var storeFilSel = storeFil;
		storeFil.fetch({
			query:{id: value},
			onItem: function(item){
				var valueSrc = storeFilSel.getValue(item, 'id');
				var setSrc = dojo.byId('idImage').src = 'images/product/'+valueSrc;
				dijit.byId('feldyZoom').set('href', 'images/product/'+valueSrc);
				//dojo.byId('feldyZoom').href = 'images/product/'+valueSrc;
				console.log('isi item -> '+  setSrc);
			}
		});
		console.log('masuk di onchange -> ', value );
		
	});
			//~ 
	//~ var storeCabang = dojo.data.ItemFileReadStore({
				//~ url: 'admin/system/generate_data_cabang.php'
			//~ });
			
	//dijit.byId('filPelanggan').store = storePel;		
	//dijit.byId('filter_cabang').store = storeCabang;		
	var radio = dijit.byId('rdKode');
	dojo.connect(radio, "onClick", function(){
			var txt = dijit.byId('kode_cust1');
			if(radio.checked == true ){
				txt.set('disabled', false);
			}else{
				txt.set('disabled', true);
			}
		});
		
	var radio_product = dijit.byId('pdKode');
	dojo.connect(radio_product, "onClick", function(){
			var kode_produk = dijit.byId('k');
			if(radio_product.checked == true){
				kode_produk.set('disabled', false);	
			}else{
				kode_produk.set('disabled', true);
			}
	});

	var chekbok_customer = dijit.byId('enableEditCustomer');
	dojo.connect(chekbok_customer, "onClick", function(){
			var resetEditCustomer = dijit.byId('resetEditCustomer');
			var simpan_customer1 = dijit.byId('simpan_customer1');
			if(chekbok_customer.checked == true){
				resetEditCustomer.set('disabled', false);	
				simpan_customer1.set('disabled', false);	
			}else{
				resetEditCustomer.set('disabled', true);
				simpan_customer1.set('disabled', true);
			}
	});

	var edit_product = dijit.byId('enableEditProduct');
	dojo.connect(edit_product, "onClick", function(){
			var editProduct = dijit.byId('editProduct');
			var resetEditProduct = dijit.byId('resetEditProduct');
			if(edit_product.checked == true){
				editProduct.set('disabled', false);	
				resetEditProduct.set('disabled', false);	
			}else{
				editProduct.set('disabled', true);
				resetEditProduct.set('disabled', true);
			}
	});

	var edit_cabang = dijit.byId('enableEditCabang');
	dojo.connect(edit_cabang, "onClick", function(){
			var editCabang = dijit.byId('editCabang');
			var resetCabang = dijit.byId('resetCabang');
			if(edit_cabang.checked == true){
				editCabang.set('disabled', false);	
				resetCabang.set('disabled', false);	
			}else{
				editCabang.set('disabled', true);
				resetCabang.set('disabled', true);
			}
	});

	var edit_delivery = dijit.byId('enableEditDelivery');
	dojo.connect(edit_delivery, "onClick", function(){
			var editDelivery = dijit.byId('editDelivery');
			var resetDelivery = dijit.byId('resetDelivery');
			if(edit_delivery.checked == true){
				editDelivery.set('disabled', false);	
				resetDelivery.set('disabled', false);	
			}else{
				editDelivery.set('disabled', true);
				resetDelivery.set('disabled', true);
			}
	});

	var edit_akun = dijit.byId('enableEditAkun');
	dojo.connect(edit_akun, "onClick", function(){
			var ubahAkun = dijit.byId('ubahAkun');
			var resetAkun = dijit.byId('resetAkun');
			if(edit_akun.checked == true){
				ubahAkun.set('disabled', false);	
				resetAkun.set('disabled', false);	
			}else{
				ubahAkun.set('disabled', true);
				resetAkun.set('disabled', true);
			}
	});
	dojo.connect(dijit.byId('contactUs'), "onClick", function(){
		var contentIsi = '<div align="center"><img src="images/Lulu@delivery_login.png" height="100px" width="100px" /></div>'+
						'<br /><div align="center" style="padding-bottom: 150px;">Jika Ingin daftar Hubungi kontak Dibawah Ini! </div>';
		var dialogDaftar = new dijit.Dialog({
			content: contentIsi,
			title: 'Daftar',
			draggable: false,
			style: 'width: 500px; height: 300px;'
		})
		dialogDaftar.show();
	});

	dojo.query(".imgBounce").instantiate(dojox.widget.FisheyeLite,{
				// all the images need a width and a height (well, not need,
				// but to scale you do)				
				properties: {
					height:1.75,
					width:1.75
				}
			});

		
});
