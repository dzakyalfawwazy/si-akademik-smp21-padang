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
		mysqli_query($con,"DELETE from tbl_siswa where nis='$_GET[nis]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=1>";
	}
	if($_GET['tipe']=='deleteguru')
	{
		mysqli_query($con,"DELETE from tbl_guru where nip='$_GET[nip]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=2>";
	}
	if($_GET['tipe']=='deletemapel')
	{
		mysqli_query($con,"DELETE from tbl_mapel where kd_mapel='$_GET[kd_mapel]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=3>";
	}
	if($_GET['tipe']=='deletekelas')
	{
		$q1=mysqli_query($con,"DELETE from tbl_kelas where kd_kelas='$_GET[kd_kelas]'");
		$q1=mysqli_query($con,"DELETE from tbl_kelasmapel where kd_kelas='$_GET[kd_kelas]'");
		$q2=mysqli_query($con,"DELETE from tbl_mapel where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]' and nip='$_GET[nipguru]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=4>";
	}
	if($_GET['tipe']=='deletepel')
	{
		mysqli_query($con,"DELETE from tbl_pelajaran where kd_pel='$_GET[kd_pel]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=5>";
	}
	if($_GET['tipe']=='deletekelaspel')
	{
		mysqli_query($con,"DELETE from tbl_kelasmapel where id='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=6>";
	}
	if($_GET['tipe']=='deletekelassiswa')
	{
		mysqli_query($con,"DELETE from tbl_kelassiswa where id='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=7&semester=".$_GET['semester']."&tahunajaran=".$_GET['tahunajaran']."&kd_kelas=".$_GET['kd_kelas'].">";
	}
	if($_GET['tipe']=='deletealumni')
	{
		mysqli_query($con,"UPDATE tbl_siswa SET nisn='-' where nis='$_GET[nis]'");
		echo "<meta http-equiv=refresh content=0;url=index.php?p=14&siswa=".$_GET['nis'].">";
	}

	if($_GET['tipe']=='deletepelijazah')
	{
		mysqli_query($con,"DELETE from tbl_ijazah where id_ija='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url='index.php?p=16'>";
	}
	if($_GET['tipe']=='deletenija')
	{
		mysqli_query($con,"DELETE from tbl_nilaiijazah where id_nija='$_GET[id]'");
		echo "<meta http-equiv=refresh content=0;url='index.php?p=17'>";
	}
}

 ?>