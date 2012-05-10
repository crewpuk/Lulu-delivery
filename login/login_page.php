	<div align="center">
		<div align="center"><img src="images/Lulu@delivery_login.png" style="width: 400px; height: 400px"/></div><br />
		<div id="testPane1" data-dojo-id="pane1" data-dojo-type="dijit.TitlePane" data-dojo-props='title:"Login ",
				style:"width: 50%;" '>
			
			<form action="system/proses_login.php" method="POST">
			<div style="padding: 5px;">Username : <input dojoType="dijit.form.ValidationTextBox" name="nama" required="true" style="width: 8em;" /></div>
			<div style="padding: 5px;">Password : <input dojoType="dijit.form.ValidationTextBox" name="kunci" type="password" required="true" style="width: 8em;"/></div>
			<hr>	
			<div>
				<button dojoType="dijit.form.Button" type="submit" name="login" >Login</button>
				<button dojoType="dijit.form.Button" type="reset">Cancel</button>
				<button dojoType="dijit.form.Button" id="contactUs">Daftar</button>
			</div>
			</form>
		</div>
	</div>

