<?php

@mysql_connect("localhost","root","admin") or die("Gagal Koneksi");
@mysql_select_db("db_lulu") or die ("Database Tidak Ditemukan");

define ("BASE",'http://'.$_SERVER['HTTP_HOST'].'/Lulu-delivery/');

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
	echo "<table width='100%' height='85' cellpadding='0' cellspacing='0'>";
		echo "<tr>";
			for($i=0;$i<$jumTD;$i++)
			{
				$width = (100/$jumTD).'%';
				if($sub=='keluar'){
				echo "<td align='center' valign='middle' class='menu-Ribbon' onclick=window.location='".BASE."logout.php' width='$width'>";	
				}else{
					$class = "";
					if($sub==rawurlencode($link[$i])){
						$class = "-active";
					}
					echo "<td align='center' valign='middle' class='menu-Ribbon$class' onclick=window.location='?page=dashboard&sub=".rawurlencode($link[$i])."' width='$width'>";
				
				}//Link page pada gambar ribbon
					/*if($sub=='keluar'){
					echo "
					<span data-dojo-type='dojox.widget.FisheyeLite' data-dojo-props='properties:{left:100}'>
					<a href='".BASE."logout.php' title='$title[$i]'>
					<img src='".BASE."images/64x64/$image[$i]' title='$title[$i]' alt='$image' /><br />$title[$i]</a>";
					}elseif($sub!='keluar'){*/
					echo "<img src='".BASE."images/64x64/$image[$i]' title='$title[$i]' class='imgBounce' alt='$image' style='max-width:52px;' /><br />$title[$i]</a>";
					//}
				echo "</td>";
			}
		echo "</tr>";					
	echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";	
}
function fgetsf2eol($text, $from_text){
	$pos = strpos($text,$from_text);
	return substr($text,($pos+strlen($from_text)),((strpos($text,PHP_EOL,$pos))-($pos+strlen($from_text))));
}
class eMail{
	var $to = array();
	var $from;
	var $replyTo;
	var $subject;
	var $body;
	var $contentType = "text/html";
	var $charset = "iso-8859-1";
	function send(){
		$x = 0;
		$to = "";
		foreach($this->to as $name => $email){
			if($x>0){$to.=",";}
			$to.=$email;
			$x++;
		}
		mail($to,$this->subject,$this->body,$this->getHeader());
	}
	function getHeader(){
		$x = 0;
		$to = "";
		foreach($this->to as $name => $email){
			if($x>0){$to.=",";}
			if(!preg_match("([^0-9]+)",$name)){
				$to.=$email;
			}
			else{
				$to.=$name." <".$email.">";
			}
			$x++;
		}
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: '.$this->contentType.'; charset='.$this->charset . "\r\n";
		
		// Additional headers
		$headers .= 'To: '.$to . "\r\n";
		$headers .= 'From: '.$this->from . "\r\n";
		
		return $headers;
	}
}
?>
