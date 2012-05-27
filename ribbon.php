<?php
$link = array('transaksi_customer','transaksi_u_customer','input_customer[admin]','keluar');
$title = array('Transaksi','Persetujuan Transaksi','Data Customer','Keluar');
$image = array('add.png','delivered.png','profil.png','cancel.png');

//Panggil fungsi ribbon dengan memasukan array link, title, dan image
ribbon($link,$title,$image);
?>