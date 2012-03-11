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
			dijit.byId('filter_product').store = storeFil;


			
		var ebel = dijit.byId('id_genso').get('value');
		console.log("isi "+ ebel);
		var storeTable = dojo.store.JsonRest({
					target: 'system/generate_table.php?genso='+ebel
		});
		//dijit.byId('tableTrans').store = storeTable;
	var layout = [{
			field: 'name_product',
			name: 'Produk',
			width: 'auto'
		}, {
			field: 'quantity_detail_transaction',
			name: 'Quantity',
			width: 'auto'
		}, {
			field: 'harga',
			name: 'Harga',
			width: 'auto'
		},{
			field: 'description_detail_transaction',
			name: 'Keterangan',
			width: 'auto'
		}];
 
	var grid = new dojox.grid.EnhancedGrid({
			query : { },
			id: 'tblTransaksi',
			store: gridStore = dojo.data.ObjectStore({
				   objectStore: storeTable
			}),
			columnReordering: 'true',
			loadingMessage: 'Loading data ...',
			selectionMode: 'single',
			structure: layout,
			plugins: {
				pagination: {
					pageSizes: ["25", "50", "100"],
                    description: true,
                    sizeSwitch: true,
                    pageStepper:  true,
                    gotoButton: true,
                    maxPageStep: 7,
                    position: "bottom"
		        }

			}
		}, document.createElement('div'));
		dojo.byId("gridDivTransCust").appendChild(grid.domNode);
		grid.startup();
		
});
