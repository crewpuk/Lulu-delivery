//dashboard
dojo.ready(function(){
	
	
var borderPane = new dijit.layout.BorderContainer({
	id: 'panelUtama',
	style: 'height:600px;width:100%'
}, 'divBorder');
borderPane.startup();

var tree = dijit.byId('idTree');
	dojo.connect(tree, "onClick", function(evt){
		var panel = dijit.byId('panelCenter');
		if(evt.id == 'transaksi'){
			panel.set('href', 'index2.php');
		}else if(evt.id == 'account'){
			panel.set('content', 'account');
		}
	});

});
//~ 
//~ var dialogSukses = new dijit.Dialog({
		//~ id: 'dialogSukses',
		//~ content: 'Data Berhasil di Simpan \n Terima Kasih ^^ !',
		//~ style: 'height: 20px; width: 50px;'
	//~ });
