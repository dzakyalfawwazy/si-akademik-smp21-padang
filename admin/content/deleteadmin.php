<?php
session_start();
if(isset($_SESSION)){
  if(@$_SESSION['statusadmin']=='OK'){}
    else { 
  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
}
else 
{  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
 include '../config/conect.php'; 

if(isset($_GET['tipe']))
{
	if($_GET['tipe']=='deletesiswa')
	{
		mysqli_query($con,"DELETE from tbl_siswa where nis='$_GET[nis]'")
	}
	if($_GET['tipe']=='deletemapel')
	{
		mysqli_query($con,"DELETE from tbl_ijazah where id_ija='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url='index.php?p=16'>";
	}
}

 ?>