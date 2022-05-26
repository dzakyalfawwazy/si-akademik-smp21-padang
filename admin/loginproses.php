<?php
session_start();
include '../config/conect.php';
$user=$_POST['nip'];
$pass=$_POST['password'];
$cek=mysqli_num_rows(mysqli_query($con,"select * from tbl_user where password=md5('$pass') and no='$user' and level='admin'"));
if($cek=='1')
{
	$_SESSION['statusadmin']='OK';
	echo "<script>window.location.href='index.php';</script>";
}
elseif($cek==NULL)
{ 
	echo "<script>window.location.href='login.php';</script>";
}

?>