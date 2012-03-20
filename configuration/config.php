<?php
@mysql_connect("localhost","root","") or die("Gagal Koneksi");
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
function get_data($url){
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
// $mail = new eMail;
// $mail->to = array($_POST['email']);
// $mail->from = "taruna@smktarunabhakti.net";
// $mail->body = '<html><body>Klik link <a href="http://e-learning.smktarunabhakti.net/verify/'.$pin.'" target="_blank">ini</a> untuk verifikasi email anda!<br><br>Atau kunjungi alamat ini : http://e-learning.smktarunabhakti.net/verify/'.$pin.'<br><br>Terimakasih atas kerjasamanya.</body></html>';
// $mail->subject = "Verifikasi Email (no-reply)";
// $mail->send();
?>