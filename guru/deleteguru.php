<?php
session_start();
if(isset($_SESSION)){
  if(@$_SESSION['statusguru']=='OK'){}
    else { 
  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
}
else 
{  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}

 include '../config/conect.php'; 

if(isset($_GET['aksi']))
{
	if($_GET['aksi']=='deletenilai')
	{
		mysqli_query($con,"DELETE from tbl_nilai where id_nilai='$_GET[id]'");
		echo "<script>window.location.href='index.php?p=2&semester=".$_GET['semester']."&tahunajaran=".$_GET['tahunajaran']."&tipe=".$_GET['tipe']."&jenisnilai=".$_GET['jenisnilai']."&kd_kelas=".$_GET['kd_kelas']."&mapel=".$_GET['mapel']."'</script>";
		
	}
	elseif($_GET['aksi']=='deletenilainon')
	{
		mysqli_query($con,"DELETE from tbl_nilailain where id_nilai='$_GET[idnilai]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=3&semester=".$_GET['semester']."&tahunajaran=".$_GET['tahunajaran']."&kd_kelas=".$_GET['kd_kelas']."&mapel=".$_GET['mapel'].">";
	}
	elseif($_GET['aksi']=='deletetema')
	{
		mysqli_query($con,"DELETE from tbl_tema where id_tema='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=5>";
	}
	elseif($_GET['aksi']=='deletekd')
	{
		mysqli_query($con,"DELETE from tbl_kd where id_kd='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=6>";
	}

}

 ?>