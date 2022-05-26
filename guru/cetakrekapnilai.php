  <?php session_start();
  include '../config/conect.php';
  if(isset($_SESSION)){
    if(@$_SESSION['statusguru']=='OK'){}
      else { 
        echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
      }
      else 
        {  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}

      ?>
      <?php

      @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from  tbl_kelas, tbl_guru where  tbl_guru.nip=tbl_kelas.nip and tbl_guru.nip='$_SESSION[nipguru]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'"));
      $kepsek=mysqli_fetch_array(mysqli_query($con,"SELECT * from tb_kepsek where id=1"));
      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <title>Cetak Rekap Nilai - Kelas <?=@$kdkl['kelas'] ?></title>
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
        <style type="text/css" media="print">
          @page {size: landscape;}
        </style>
      </head>
      <body>
        <div class="container-fluid">
          <h4>Rekap Nilai <?=$_GET['tipe']?> Siswa</h4>
          <table class="" width="100%">
            <tr>
              <td width="17%">Nama Guru</td>
              <td width="3%">:</td>
              <td width="30%"><?=@$kdkl['namaguru'] ?></td>
              <td width="17%">Kelas</td>
              <td width="3%">:</td>
              <td width="30%"><?=@$kdkl['kelas'] ?></td>
            </tr>
            <tr>

              <td>Tahun Ajaran</td>
              <td>:</td>
              <td><?=@$kdkl['tahunajaran'] ?></td>
              <td>Semester</td>
              <td>:</td>
              <td><?=@$_GET['semester'] ?></td>
            </tr>
          </table>
          <table border="1" width="100%" cellpadding="10">
            <thead>
              <tr class="text-center">
                <td rowspan="4">No</td>
                <td rowspan="4">NIS</td>
                <td rowspan="4">Nama Siswa</td>
              </tr>
              <tr class="text-center">
                <?php
                $query="select * from tbl_kelasmapel,tbl_mapel,tbl_pelajaran where  tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_mapel.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.semester='$_GET[semester]' and  tipepel='Pengetahuan dan Keterampilan'";
                $qmapel=mysqli_query($con,$query);
                while($rmapel=mysqli_fetch_array($qmapel)){ ?>
                  <td colspan="2"><?= $rmapel['namapel'] ?></td>
                <?php } ?>
                <td rowspan="2" colspan="3">Keterangan</td>
              </tr>
              <tr class="text-center">
                <?php if($_GET['tipe']=='KTSP') {?>
                  <tr class="text-center">
                    <?php $qmapel=mysqli_query($con,$query);
                    while($rmapel=mysqli_fetch_array($qmapel)){ ?>
                      <td>N</td>
                      <td>KKM</td>
                    <?php } } else if($_GET['tipe']=='K13') {?>
                      <tr class="text-center">
                        <?php $qmapel=mysqli_query($con,$query);
                        while($rmapel=mysqli_fetch_array($qmapel)){ ?>
                          <td>N</td>
                          <td>P</td>
                        <?php } } ?>
                        <td>Jumlah</td>
                        <td>Rata-rata</td>
                        <td>Ranking</td>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                      $qu=mysqli_query($con,"select * from tbl_siswa, tbl_kelassiswa, tbl_kelas where tbl_kelassiswa.kd_kelas=tbl_kelas.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.kd_kelas='$kdkl[kd_kelas]'");
                      $no=0;
                      while($dake=mysqli_fetch_array($qu)){

                        $no++;
                        ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $dake['nis'] ?></td>
                          <td><?= $dake['nama'] ?></td>
                          <?php 
                          $qmapel=mysqli_query($con,$query);
                          $count=mysqli_num_rows($qmapel);
                          while($rmapel=mysqli_fetch_array($qmapel)){ 
                            $q1=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_mapel,tbl_rapor,tbl_pelajaran where tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_rapor.nis='$dake[nis]' and tbl_rapor.kd_mapel='$rmapel[kd_mapel]' and tbl_rapor.tipe='Pengetahuan'"));
                            $j=1;
                            if($q1==NULL) {?>
                              <td>-</td>
                              <td>-</td>
                              <?php  } else { 

                                if($_GET['tipe']=='K13') {?>
                                  <td class="text-center"><?= $q1['nilai'] ?></td>
                                  <td class="text-center"><?php if($q1['nilai'] < 50) $nilai='E';
                                  elseif($q1['nilai'] < 60) $nilai='D';
                                  elseif($q1['nilai'] < 70) $nilai='C';
                                  elseif($q1['nilai'] < 80) $nilai='B';
                                  elseif($q1['nilai'] < 100) $nilai='A';
                                  echo $nilai;
                                  
                                  ?></td>
                                <?php } else  if($_GET['tipe']=='KTSP') {  ?>
                                  <td class="text-center"><?= $q1['nilai'] ?></td>
                                  <td class="text-center"><?= $q1['kkm'] ?></td>
                                <?php }   } 
                              } ?> 
                              <?php $qrank=mysqli_query($con, "SELECT tbl_rapor.nis, sum(tbl_rapor.nilai) as ton from tbl_mapel,tbl_rapor,tbl_pelajaran where tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_rapor.tipe='Pengetahuan' and tbl_mapel.semester='$_GET[semester]' and tbl_mapel.tahunajaran='$_GET[tahunajaran]' group by nis order by ton desc");
                              $rank=0;
                              while($rorank=mysqli_fetch_array($qrank)){
                                $rank++;
                                if($rorank['nis']==$dake['nis']){ ?>
                                 <td><?= $rorank['ton'] ?></td>
                                 <td><?php @(int)$rata=$rorank['ton']/$count;
                                 echo @number_format($rata,2);
                                 ?></td> 
                                  <td><?=  $rank ?></td>                  
                                 <?php
                               }
                             } ?>
                           </tr>
                         <?php }?>
                       </tbody>
                     </table>
                   </div>
                   <br/>
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
                      <td>Guru Kelas <?= $kdkl['kelas']?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="5"><br/><br/><br/>&nbsp;</td>
                    </tr>

                    <tr>
                      <td></td>
                      <td><b><u><?= $kepsek['namakepsek'] ?></u></b><br/><?= $kepsek['nipkepsek'] ?></td>
                      <td></td>
                      <td><b><u><?= $kdkl['namaguru'] ?></u></b><?= "<br/>". $kdkl['nip']?></td>
                      <td></td>
                    </tr>
                  </table>
                </body>
                </html>
                <script type="text/javascript">window.print()</script>
