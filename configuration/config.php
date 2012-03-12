<?php
	mysql_connect("localhost","root","root") or die("koneksi gagal");
	mysql_select_db("db_lulu") or die ("database tidak Ditemukan");
	
	function alert($psn){
		echo "<script>alert('$psn');</script>";
	}
	function location($loc){
		echo "<script>location='$loc';</script>";
	}
	
	function ribbon($link,$title,$image)
	{
	$page = $_GET['page'];
    $sub = $_GET['sub'];
	$jumTD = count($title);
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='box-Ribbon'>";
	echo "<tr>";
	echo "<td>";
		echo "<table width='100%' height='120' cellpadding='0' cellspacing='0'>";
			echo "<tr>";
				for($i=0;$i<$jumTD;$i++)
				{
					echo "<td align='center' valign='middle' class='menu-Ribbon'>";
						echo "<a href='?page=dashboard&sub=$link[$i]' title='$title[$i]'><img src='images/64x64/$image[$i]' title='$title[$i]' alt='$image' /><br />$title[$i]</a>";
					echo "</td>";
				}
			echo "</tr>";					
		echo "</table>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";	
	}
?>
