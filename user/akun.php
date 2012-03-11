
<link href="user/css.css" rel="stylesheet" type="text/css" />
<?php
if($_GET['page']=='addNew')
{
?>
<form id="form1" name="form1" method="post" action="proses.php?page=save">
  <table width="500" border="1" cellpadding="0" cellspacing="0" class="Ustext">
    <tr>
      <th colspan="2">Add User</th>
    </tr>
    <tr>
      <td width="33%"><div class="Ustext" id="">Username</div></td>
      <td width="67%"><label for="txtUser"></label>
      <input type="text" name="txtUser" id="txtUser" /></td>
    </tr>
    <tr>
      <td class="Ustext">Password</td>
      <td><input type="text" name="txtPass" id="txtPass" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="save" type="submit" class="useTextAddNew" id="save" value="Simpan" /></td>
    </tr>
    <?php } ?>
  </table>
</form>
<form id="form3" name="form3" method="post" action="">
<a href="?page=addNew" class="useTextAddNew">Add New !!!</a><br /><br />
<table width="575" border="1" cellpadding="0" cellspacing="0" class="Ustext">
  <tr>
    <th width="143">Username</th>
    <th width="163">Password</th>
    <th width="77">Status Aktif</th>
    <th colspan="2">Action</th>
    </tr>
  <?php
  $sql = mysql_query("SELECT id_account,username_account,password_account,status_account FROM user_account ORDER BY id_account asc");
  while($array = mysql_fetch_array($sql)){
	  $x1 = $array['id_account'];
	  $rrq = $array['status_account'];
	  
  ?>
  <tr>
    <td><?php echo $array['username_account'];?>&nbsp;</td>
    <td><?php echo $array['password_account'];?>&nbsp;</td>
    <td><?php if($rrq==1){
	  echo"aktif";}
	   if($rrq==0){echo"tidak aktif";}?>&nbsp;
      <input type="hidden" name="idDel" id="idDel" value="<?php echo $array['id_account']; ?>" /></td>
    <td width="90" align="center"><a href="user.php?page=upd&&idakun=<?php echo $array['id_account'];?>" class="Usetext2">Edit</a></td>
    <td width="90" align="center"><a href="proses.php?page=del&&idDel=<?php echo $array['id_account'];?>" class="Usetext2">Delete</a></td>
  </tr>
  <? } ?>
</table>
  </form>

<?php
if($_GET['page']=='upd')
{
?>
<form id="form2" name="form1" method="post" action="proses.php?page=upd">
  <table width="500" border="1" cellpadding="0" cellspacing="0" class="Ustext">
    <tr>
      <th colspan="2">Change User</th>
    </tr>
     <?php
		$sql = mysql_query("SELECT id_account,username_account,password_account,status_account FROM user_account where id_account = '$_REQUEST[idakun]' ");
		$array = mysql_fetch_array($sql);
		$t = $array['id_account']
	  ?>
    <tr>
      <td width="24%">Username</td>
      <td width="76%"><input name="txtUserUpd" type="text" id="txtUserUpd" value="<?php echo $array['username_account']; ?>" />
      <input type="hidden" name="id" id="id" value="<?php echo $array['id_account']; ?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txtPassUpd"></label>
      <input name="txtPassUpd" type="text" id="txtPassUpd" value="<?php echo $array['password_account']; ?>" /></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><input type="radio" name="radYa" id="radio" value="1"<?php if($array[status_account]=='1'){echo " checked='checked'";}?> />
      <label for="radNo"></label>
      Aktif
      <input type="radio" name="radYa" id="radio2" value="0"<?php if($array[status_account]=='0'){echo " checked='checked'";}?> />
      <label for="radYa"></label>      
      Tidak Aktif</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="button" type="submit" class="useTextAddNew" id="button" value="Submit" /></td>
    </tr>
	<?php }  ?>
  </table>
</form>

<?php
if($_GET['page']=='error404')
{
?>
<label style="font-size:32px;">404 ERROR</style></label><br />
<label>Sorry,your access is failed please back -&gt;<a href="?x=slp">Back</a> or visit your webmaster <br />
rian.nugraha@gmail.com<br /><br /><br />Thank You</label>

<?php } ?>
