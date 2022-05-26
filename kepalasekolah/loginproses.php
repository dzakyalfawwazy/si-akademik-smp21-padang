<?php
session_start();
include '../config/conect.php';
$user=$_POST['nip'];
$pass=$_POST['password'];
$cek=mysqli_num_rows(mysqli_query($con,"select * from tbl_user where password=md5('$pass') and no='$user' and level='kepsek'"));
if($cek=='1')
{
	$_SESSION['statuskepsek']='OK';
	$_SESSION['nama']='Kepala Sekolah';
	echo "<script>window.location.href='index.php';</script>";
}
elseif($cek==NULL)
{ 
	echo "<script>window.location.href='login.php';</script>";
}

?>