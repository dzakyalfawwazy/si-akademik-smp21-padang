  <?php session_start();
  include '../config/conect.php';
  ?>
  <?php

  @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]'"));
  $transkrip="select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]'";
   $kepsek=mysqli_fetch_array(mysqli_query($con,"SELECT * from tb_kepsek where id=1"));

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Cetak Transkrip</title>
    <link rel="stylesheet" href="../admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <style type="text/css" media="print">
      @page {size: landscape;}
    </style>
  <body>
    <div class="container-fluid">
      <h4 class="text-center">Transkrip Nilai Siswa</h4>
      <br/>
      <table class="" width="100%">
        <tr>
          <td width="17%">Nama Siswa</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['nama'] ?></td>
          <td width="17%">Nama Sekolah</td>
          <td width="3%">:</td>
          <td width="30%">SD 56 ANAK AIR</td>
        </tr>
        <tr>

          <td>NISN</td>
          <td>:</td>
          <td><?=@$kdkl['nisn'] ?></td>
          <td>Alamat SD</td>
          <td>:</td>
          <td>Jl. SMA 8 Kayu Kalek</td>
          
        </tr>
      </table>
      <br>
      <table width="100%" border="1" cellpadding="10">
        <thead>
          <tr class="text-center">
            <th rowspan="4">No</th>
            <th rowspan="4">Nama Mata Pelajaran</th>
            <?php 
            $qtr=mysqli_query($con,$transkrip);
            while($row=mysqli_fetch_array($qtr)){ 
              ?>
              <th colspan="2"><?= $row['kelas'] ?></th>
              <?php
            } ?>
            
          </tr>
          <tr class="text-center">
            <?php 
          $qtr=mysqli_query($con,$transkrip);
            while($row=mysqli_fetch_array($qtr)){ 
              ?>
              <th colspan="2">Tk/Klas</th>
            <?php } ?>
          </tr>
          <tr class="text-center">
            <?php 
          $qtr=mysqli_query($con,$transkrip);
            while($row=mysqli_fetch_array($qtr)){ 
              ?>
              <th colspan="2">S.<?= $row['semester'] ?></th>
            <?php } ?>
          </tr>
          <tr class="text-center">

            <?php 
            $qtr=mysqli_query($con,$transkrip);
            $cr=mysqli_num_rows($qtr); for ($i=0; $i < $cr ; $i++) { 
              if($_GET['tipe']=="k13"){
              ?>

              <th>Nilai</th>
              <th>Predikat</th>
            <?php } else { ?>
              <th>KKM</th>
              <th>Nilai</th>
            <?php } } ?>
          </tr>
        </thead>
        <tbody>
          <?php $qukel=mysqli_query($con,"select * from tbl_pelajaran, tbl_mapel where tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and tbl_pelajaran.tipepel='Pengetahuan dan Keterampilan' group by tbl_pelajaran.kd_pel");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $q1=mysqli_query($con,$transkrip);
            $no++;

            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <?php  while($r1=mysqli_fetch_array($q1)){
                $r2=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_rapor,tbl_mapel,tbl_pelajaran where tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and tbl_pelajaran.kd_pel='$dakel[kd_pel]' and tbl_mapel.semester='$r1[semester]' and tbl_mapel.tahunajaran='$r1[tahunajaran]'"));
                if($r2==NULL){?>

                 <td>-</td>
                 <td>-</td>
               <?php } else { 
               if($_GET['tipe']=="k13"){ ?> 

                <td><?= $r2['nilai'] ?></td>
                 <td><?php if($r2['nilai'] < 50) $nilai='D';
                  elseif($r2['nilai'] < 65) $nilai='C';
                  elseif($r2['nilai'] < 80) $nilai='B';
                  elseif($r2['nilai'] < 100) $nilai='A';
                  echo $nilai;
                 
                  ?></td>
                <?php } else { ?>
                <td><?= $r2['kkm'] ?></td>
                <td><?= $r2['nilai'] ?></td>
               <?php }  }  } ?>
             </tr>
           <?php } ?>
         </tbody>
       </table>
     </div>

  <table width="100%" border="0" class="text-center">
    <tr>
      <td width="10%"></td>
      <td width="30%"></td>
      <td></td>
      <td width="30%">Padang, <?= date('d/m/Y') ?></td>
      <td width="10%"></td>
    </tr>
    <tr>
      <td></td>
      <td>Mengetahui,</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>Kepala Sekolah</td>
      <td></td>
      <td>Orang Tua/Wali</td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5"><br/><br/><br/>&nbsp;</td>
    </tr>

    <tr>
      <td></td>
      <td><b><u><?= $kepsek['namakepsek'] ?></u></b><br/><?= $kepsek['nipkepsek'] ?></td>
      <td></td>
      <td><b><u>(..................................)</u></b><br/>&nbsp;</td>
      <td></td>
    </tr>
    </table>
   </body>
   </html>
<script type="text/javascript">window.print()</script>