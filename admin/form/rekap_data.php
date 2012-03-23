<div style="width:20%; border:solid #000 1px; float:left;" align="left">
<form method="post" name="form2">
<input type="submit" name="btnEnterDays" id="btnEnterDays" value="Harian" /><br /><hr />
<?php
  if($_POST['btnEnterDays']){
	  $date = date('Y-m-d');
	  $queryAwal = mysql_query("SELECT * FROM m_transaction WHERE time_transaction LIKE '".$date."%'") or die ("salah");
        while($tzz=mysql_fetch_array($queryAwal)){
			$ax = $tzz["code_transaction"]; 
		$queRy = mysql_query("SELECT SUM(price_product) FROM m_product INNER JOIN m_detail_transaction ON m_product.code_product=m_detail_transaction.code_product WHERE m_detail_transaction.code_transaction = '".$ax."'") or die ("salah");
		while($array=mysql_fetch_array($queRy)){
			$sum += $array['SUM(price_product)'];
			
			//echo "<table width='100%' border='0' cellpadding='0' cellspacing='1'><tr><td>".$tzz['code_transaction']."</td><td>Rp. ".$array['SUM(price_product)']."</td><tr></table><br>".$sum."";
			
			echo"<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr><td>".$tzz['code_transaction']."</td><td>Rp. ".$array['SUM(price_product)']."</td></tr></table>";
			
			//echo "<a href='print.' target='_blank' >print</a>";
			 
			}
		}
		echo $sum;
  }
  ?>

</form>
</div>
<div style="width:20%; border:solid #000 1px; float:left;" align="left">
<form name="form3" method="post">
  <input type="submit" name="btnEnterWeek" id="btnEnterWeek" value="Bulanan" /><br /><hr />
  <?php
  if($_POST['btnEnterWeek']){
	  $dateMonth = date('m');
	  $queryAwal = mysql_query("SELECT * FROM m_transaction WHERE MONTH(time_transaction) ='".$dateMonth."'") or die ("salah");
        while($tzz=mysql_fetch_array($queryAwal)){
			$ax = $tzz["code_transaction"]; 
		$queRy = mysql_query("SELECT SUM(price_product) FROM m_product INNER JOIN m_detail_transaction ON m_product.code_product=m_detail_transaction.code_product WHERE m_detail_transaction.code_transaction = '".$ax."'") or die ("salah");
		while($array=mysql_fetch_array($queRy)){
			$sum += $array['SUM(price_product)'];
			//echo "Rp. ".$array['SUM(price_product)']."";
			echo "<table width='100%' border='0' cellpadding='0' cellspacing='1'><td>".$tzz['code_transaction']."</td><td>Rp. ".$array['SUM(price_product)']."</td><tr></table>";
			}
		}
		echo $sum;
  }
  ?>
</form>
</div>
<div style="width:25%; border:solid #000 1px; float:left;" align="left">
<form name="form3" method="post">
  <input type="submit" name="btnEnterYears" id="btnEnterYears" value="Tahunan" />
  <br /><hr />
  <?php
  if($_POST['btnEnterYears']){
	  $dateYear = date('Y');
	  $queryAwal = mysql_query("SELECT * FROM m_transaction WHERE YEAR(time_transaction) ='".$dateYear."'") or die ("salah");
        while($tzz=mysql_fetch_array($queryAwal)){
			$ax = $tzz["code_transaction"]; 
		$queRy = mysql_query("SELECT SUM(price_product) FROM m_product INNER JOIN m_detail_transaction ON m_product.code_product=m_detail_transaction.code_product WHERE m_detail_transaction.code_transaction = '".$ax."'") or die ("salah");
		while($array=mysql_fetch_array($queRy)){
			$sum += $array['SUM(price_product)'];
			//echo "Rp. ".$array['SUM(price_product)']."";
			echo "<table width='100%' border='0' cellpadding='0' cellspacing='1'><td>".$tzz['code_transaction']."</td><td>Rp. ".$array['SUM(price_product)']."</td><tr></table>";
			}
		}
		echo $sum;
  }
  ?>
</form>
</div>
<div style="width:30%; border:solid #000 1px; float:left;" align="left">
<form name="form3" method="post">
  <select name="cboDay" id="cboDay">
    <?php 
for ($i = 1; $i <= 31; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
  <select name="cboMonth" id="cboMonth">
    <?php 
for ($i = 1; $i <= 12; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
  <select name="cboYear" id="cboYear">
    <?php 
for ($i = 2012; $i <= 2015; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
  --
  <select name="cboDay1" id="cboDay1">
    <?php 
for ($i = 1; $i <= 31; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
  <select name="cboMonth2" id="cboMonth2">
    <?php 
for ($i = 1; $i <= 12; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
  <select name="cboYear2" id="cboYear2">
    <?php 
for ($i = 2012; $i <= 2015; $i++) {
?>
    <option><?php echo $i;?></option>
    <?php } ?>
  </select>
<input type="submit" name="btnWeek" id="btnWeek" value="Mingguan" />
  <br /><hr />
  <?php
  if($_POST['btnWeek']){
	  $dateYear = date('Y');
	  $thn = date('Y');
	  $bln = date('m');
	  $day = date('d');
	  //per tanggal
	  $queryAwal = mysql_query("SELECT * FROM m_transaction WHERE time_transaction >= '$cboYear-$cboMonth-$cboDay' AND time_transaction <= '$cboYear2-$cboMonth2-$cboDay2'")or die ("salah");
	  //$queryAwal = mysql_query("SELECT * FROM m_transaction WHERE YEAR(time_transaction) ='".$dateYear."'") or die ("salah");
        while($tzz=mysql_fetch_array($queryAwal)){
			$ax = $tzz["code_transaction"];
		
		$queRy = mysql_query("SELECT SUM(price_product) FROM m_product INNER JOIN m_detail_transaction ON m_product.code_product=m_detail_transaction.code_product WHERE m_detail_transaction.code_transaction = '".$ax."'") or die ("salah");
		while($array=mysql_fetch_array($queRy)){
			$sum += $array['SUM(price_product)'];
			//echo "Rp. ".$array['SUM(price_product)']."";
			echo "<table width='100%' border='0' cellpadding='0' cellspacing='1'><td>".$tzz['code_transaction']."</td><td>Rp. ".$array['SUM(price_product)']."</td><tr></table>";
			}
		}
		echo $sum;
  }
  ?>
</form>
</div>
<div style="clear:both"></div>
