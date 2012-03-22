<form id="form4" name="form4" method="post" action="">
  <button dojoType="dijit.form.Button" type="submit" name="tambah_user" id="tambah_user">Tambah</button>
</form>
<?php
if(isset($_POST['tambah_user']))
{
?>
<form id="form1" name="form1" method="post" action="system/proses_akun.php">
  <table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" class="Ustext">
    <tr>
      <th style="padding:5px;" colspan="2">Tambah User</th>
    </tr>
    <tr>
      <td style="padding:5px;">Nama Lengkap</td>
      <td style="padding:5px;"><input placeholder="Nama Lengkap" type="text" name="txtFull" id="txtFull" /></td>
    </tr>
    <tr>
      <td style="padding:5px;" width="33%">Nama Pengguna</td>
      <td style="padding:5px;" width="67%"><label for="txtUser"></label>
      <input placeHolder="Nama User" type="text" name="txtUser" id="txtUser" /></td>
    </tr>
    <tr>
      <td style="padding:5px;" class="Ustext">Kata Sandi</td>
      <td style="padding:5px;"><input placeHolder="Password" type="password" name="txtPass" id="txtPass" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding:5px;"><button dojoType="dijit.form.Button" name="save" type="submit" class="useTextAddNew" id="save">Tambah Akun</button></td>
    </tr>
    <?php } ?>
  </table>
</form>
<br />
<?php
if(isset($_GET['upd']))
{
?>
<form id="form2" name="form1" method="post" action="system/proses_akun.php">
  <table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" class="Ustext">
    <tr>
      <th style="padding:5px;" colspan="2">Ubah User</th>
    </tr>
     <?php
		$sql = mysql_query("SELECT id_account,username_account,fullname_account,password_account,status_account FROM user_account where id_account = '$_REQUEST[idakun]' ");
		$array = mysql_fetch_array($sql);
		$t = $array['id_account']
	  ?>
    <tr>
       <td style="padding:5px;">Nama Lengkap</td>
       <td style="padding:5px;"><input name="txtFullUpd" type="text" id="txtFullUpd" value="<?php echo $array['fullname_account']; ?>" /></td>
    </tr>
    <tr>
      <td style="padding:5px;" width="24%">Nama Pengguna</td>
      <td style="padding:5px;" width="76%"><input name="txtUserUpd" type="text" id="txtUserUpd" value="<?php echo $array['username_account']; ?>" />
      <input type="hidden" name="id" id="id" value="<?php echo $array['id_account']; ?>" /></td>
    </tr>
    <tr>
      <td style="padding:5px;">Kata Sandi</td>
      <td style="padding:5px;"><label for="txtPassUpd"></label>
      <input name="txtPassUpd" type="text" id="txtPassUpd" value="<?php echo $array['password_account']; ?>" /></td>
    </tr>
    <?php if($t['id_account']!='1'){?>
    <tr>
      <td style="padding:5px;">Status</td>
      <td style="padding:5px;"><label>
      <input type="radio" name="radYa" id="radio" value="1"<?php if($array[status_account]=='1'){echo " checked='checked'";}?> />
      Aktif</label>
      <label>
      <input type="radio" name="radYa" id="radio2" value="0"<?php if($array[status_account]=='0'){echo " checked='checked'";}?> />      
      Tidak Aktif
      </label></td>
    </tr>
    <?php }?>
    <tr>
      <td style="padding:5px;" colspan="2" align="center"><button dojoType="dijit.form.Button" name="ubah_akun" type="submit" class="useTextAddNew" id="ubah_akun">Ubah Akun</button></td>
    </tr>
	
  </table>
</form>
<?php }  ?>
<br />
<form id="form3" name="form3" method="post" action="">
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="Ustext">
  <tr>
    <th style="padding:5px;" width="143">No</th>
    <th style="padding:5px;" width="143">Nama Lengkap</th>
    <th style="padding:5px;" width="143">Nama Pengguna</th>
    <th style="padding:5px;" width="163"><span class="Ustext" style="padding:5px;">Kata Sandi</span></th>
    <th style="padding:5px;" width="77">Status Aktif</th>
    <th style="padding:5px;" colspan="2">Tindakan</th>
    </tr>
  <?php
  $sql = ("SELECT id_account,username_account,fullname_account,password_account,status_account FROM user_account ORDER BY id_account asc");
  $exeSQL = @mysql_query($sql) or die('Query Salah -> '.mysql_error());
  $i = 0;
  while($array = mysql_fetch_array($exeSQL)){
	  $x1 = $array['id_account'];
	  $rrq = $array['status_account'];
  $i++;	
  if($i%2==0){ $bg='#ececec'; }else{ $bg='#f5f5f5'; }  
  ?>
  <tr bgcolor="<?php echo $bg; ?>" class="linkBorder">
    <td style="padding:5px;" align="center"><?php echo $i; ?></td>
    <td style="padding:5px;" align="center"><?php echo $array['fullname_account'];?></td>
    <td style="padding:5px;" align="center"><?php echo $array['username_account'];?></td>
    <td style="padding:5px;" align="center"><?php echo $array['password_account'];?></td>
    <td style="padding:5px;" align="center"><?php if($rrq=='1'){echo"Aktif";}else{echo"Tidak Aktif";}?>&nbsp;
      <input type="hidden" name="idDel" id="idDel" value="<?php echo $array['id_account']; ?>" /></td>
    <td style="padding:5px;" width="90" align="center"><a href="index.php?page=dashboard&sub=akun&upd&idakun=<?php echo $array['id_account'];?>" class="Usetext2"><img src="<?php echo BASE; ?>images/16x16/edit.png" width="16" height="16" alt="ubah" title="Ubah"></a></td>
    <td style="padding:5px;" width="90" align="center"><a href="system/proses_akun.php?del&idDel=<?php echo $array['id_account'];?>" class="Usetext2"><img src="<?php echo BASE; ?>images/16x16/delete.png" width="16" height="16" alt="hapus" title="Hapus"></a></td>
  </tr>
  <? } ?>
</table>
</form>
<br />
<div align="center">
<?php
$q = "SELECT COUNT(*) FROM `user_account`";
$exeQ = @mysql_query($q) or die('Query Salah -> '.mysql_error());
$sum = @mysql_fetch_array($exeQ);

echo "Jumlah Akun : <strong>$sum[0]</strong>";
?>
</div>