<?php
	mysql_connect("localhost","root","root") or die("koneksi gagal");
	mysql_select_db("db_lulu") or die ("database tidak Ditemukan");
	
	function alert($psn){
		echo "<script>alert('$psn');</script>";
	}
	function location($loc){
		echo "<script>location='$loc';</script>";
	}
?>
