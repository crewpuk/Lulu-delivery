<?php
@session_start();
//$level = array(1=>$_SESSION['level']=='admin',2=>$_SESSION['level']=='su_admin');
if(isset($_SESSION['user']) || isset($_SESSION['pass'])){
unset($_SESSION['user']);
unset($_SESSION['pass']);
//unset($level[1]);
}else{
unset($_SESSION['su_user']);
unset($_SESSION['su_pass']);
//unset($level[2]);
}
session_destroy();
@header("location:index.php?page=page_login");
?>