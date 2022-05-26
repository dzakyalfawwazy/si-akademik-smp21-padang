  <?php session_start();
 include '../config/conect.php';
  // ?>
  <?php
   $kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]'"));
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>IJAZAH</title>
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
  <body>
    <div class="container">  

      <table class="text-center" width="100%">
        <tr>
          <td class="h5">
              &nbsp;
    <br/>
    <br/>
    <br/>
    <br/>
    &nbsp;
            <b>DAFTAR NILAI UJIAN<BR/>SEKOLAH MENENGAH PERTAMA
          </b>
           <BR/>
              &nbsp;
          </td>
        </tr>

      </table>
      <table width="100%">
        <tr>
          <td width="40%">Nama</td>
          <td width="30%">: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['nama'] ?></td>
          <td width="30%"></td>
        </tr>
        <tr>
          <td>Tempat dan Tanggal lahir</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['tmpt_lahir'].'/'.date('d-m-Y',strtotime($kdkl['tgl_lahir'])) ?></td>
          <td></td>
        </tr>
        <tr>
          <td>Asal Sekolah</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jl. Simpang, Bandar Buat, Kec. Lubuk Kilangan</td>
          <td></td>
        </tr>
        <tr>
          <td>Nomor Induk</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['nis'] ?></td>
          <td></td>
        </tr>
      </table>
      <br/>
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr class="text-center">
          <td rowspan="2" width="5%">No</td>
          <td rowspan="2" width="45%">Mata Pelajaran</td>
          <td colspan="2">Nilai</td>
        </tr>
        <tr class="text-center">
          <td>Praktik</td>
          <td>Tertulis</td>
        </tr>
        <tr>
          <td class="text-center"></td>
          <td>UJIAN AKHIR SEKOLAH BERSTANDAR NASIONAL</td>
          <td></td>
          <td></td>
        </tr>
        <?php $qm1=mysqli_query($con,"SELECT * from tbl_pelajaran, tbl_nilaiijazah, tbl_ijazah where tbl_pelajaran.kd_pel=tbl_ijazah.kd_pel and tbl_nilaiijazah.id_ija=tbl_ijazah.id_ija and tbl_nilaiijazah.nis='$kdkl[nis]' and tbl_ijazah.bagian='UJIAN SEKOLAH BERSTANDAR NASIONAL'");
        $no1=0;
        while($r1=mysqli_fetch_array($qm1)){ $no1++;?>
        <tr>
          <td class="text-center"><?= $no1; ?></td>
          <td><?= $r1['namapel'] ?></td>
          <td><?= $r1['nilai'];  $j11[]=$r1['nilai'] ?></td>
          <td><?= $r1['nilai2']; $j21[]=$r1['nilai2'] ?></td>
        </tr>
      <?php } ?>
        
        <tr><td colspan="2" class="text-center">Jumlah</td><td><?= @array_sum($j11); ?></td><td><?= @array_sum($j21); ?></td></tr>
        <tr>
          <td class="text-center"></td>
          <td>UJIAN SEKOLAH</td>
          <td></td>
          <td></td>
        </tr>
        <?php $qm2=mysqli_query($con,"SELECT * from tbl_pelajaran, tbl_nilaiijazah, tbl_ijazah where tbl_pelajaran.kd_pel=tbl_ijazah.kd_pel and tbl_nilaiijazah.id_ija=tbl_ijazah.id_ija and tbl_nilaiijazah.nis='$kdkl[nis]' and tbl_ijazah.bagian='UJIAN SEKOLAH'");
        $no2=0;
        while($r2=mysqli_fetch_array($qm2)){ $no2++;?>
        <tr>
          <td class="text-center"><?= $no2; ?></td>
          <td><?= $r2['namapel'] ?></td>
          <td><?= $r2['nilai'];$j21[]=$r2['nilai']  ?></td>
          <td><?= $r2['nilai2'];$j22[]=$r2['nilai2']  ?></td>
        </tr>
      <?php } ?>
        <tr><td colspan="2" class="text-center">Jumlah</td><td><?= @array_sum($j21); ?></td><td><?= @array_sum($j22); ?></td></tr>
        <tr>
          <td class="text-center"></td>
          <td>MUATAN LOKAL</td>
          <td></td>
          <td></td>
        </tr>

        <?php $qm3=mysqli_query($con,"SELECT * from tbl_pelajaran, tbl_nilaiijazah, tbl_ijazah where tbl_pelajaran.kd_pel=tbl_ijazah.kd_pel and tbl_nilaiijazah.id_ija=tbl_ijazah.id_ija and tbl_nilaiijazah.nis='$kdkl[nis]' and tbl_ijazah.bagian='MUATAN LOKAL'");
        $no3=0;
        while($r3=mysqli_fetch_array($qm3)){ $no3++;?>
        <tr>
          <td class="text-center"><?= $no3; ?></td>
          <td><?= $r3['namapel'] ?></td>
          <td><?= $r3['nilai']; $j31[]=$r3['nilai']  ?></td>
          <td><?= $r3['nilai2']; $j32[]=$r3['nilai2']  ?></td>
        </tr>
      <?php } ?>
          <tr><td colspan="2" class="text-center">Jumlah</td><td><?= @array_sum($j31); ?></td><td><?= @array_sum($j32); ?></td></tr>
      </table>
      <table width="100%" cellpadding="10">
        <tr>
          <td class="text-right" width="50%">&nbsp;</td>
          <td class="text-left">Padang, <?= date('d-m-Y') ; $q1=$con->query('SELECT * from tb_kepsek')->fetch_array();?>
            <br/>
            Kepala Sekolah
            <br/>
            <br/>
            <br/>
            <br/>
            <?= $q1['namakepsek']?><hr>
            NIP. <?= $q1['nipkepsek']?>
          </td>
        </tr>
      </table>
    </div>
  </body>
  </html>
  <script type="text/javascript">window.print()</script>
  
  