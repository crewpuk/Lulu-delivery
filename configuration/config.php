<?php

	@mysql_connect("localhost","root","admin") or die("Gagal Koneksi");
	@mysql_select_db("db_lulu") or die ("Database Tidak Ditemukan");

	
	define ("BASE",'http://localhost/Lulu-delivery/');
	
	function alert($psn){
		echo "<script>alert('$psn');</script>";
	}
	function location($loc){
		echo "<script>location='$loc';</script>";
	}
	
	function ribbon($link,$title,$image)
	{
	$page = (isset($_GET['page']))?$_GET['page']:"";
    $sub = (isset($_GET['sub']))?$_GET['sub']:"";
	$jumTD = count($title);
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='box-Ribbon'>";
	echo "<tr>";
	echo "<td>";
		echo "<table width='100%' height='120' cellpadding='0' cellspacing='0'>";
			echo "<tr>";
				for($i=0;$i<$jumTD;$i++)
				{
					echo "<td align='center' valign='middle' class='menu-Ribbon'>";
						//Link page pada gambar ribbon
						if($sub=='keluar'){
						echo "
						<a href='".BASE."logout.php' title='$title[$i]'>
						<img src='".BASE."images/64x64/$image[$i]' title='$title[$i]' alt='$image' /><br />$title[$i]</a>";
						}elseif($sub!='keluar'){
						echo "
						<a href='?page=dashboard&sub=$link[$i]' title='$title[$i]'>
						<img src='".BASE."images/64x64/$image[$i]' title='$title[$i]' alt='$image' /><br />$title[$i]</a>";
						}
					echo "</td>";
				}
			echo "</tr>";					
		echo "</table>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";	
	}
?>
