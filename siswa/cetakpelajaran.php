  <?php session_start();
  include '../config/conect.php';
  ?>
  <?php
  $kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]'"));
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title></title>
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
      <h4>RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK</h4>
      
          <table class="table">
            <tr>
              <td>Tahun Ajaran</td>
              <td>:</td>
              <td><?=@$_GET['tahunajaran'] ?></td>
              <td>Semester</td>
              <td>:</td>
              <td><?=@$_GET['semester'] ?></td>
              <td>Kelas</td>
              <td>:</td>
              <td><?=@$kdkl['kelas'] ?></td>
            </tr>
          </table>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>Nama Guru</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_kelasmapel, tbl_kelas, tbl_mapel, tbl_pelajaran, tbl_guru where tbl_kelasmapel.kd_kelas=tbl_kelas.kd_kelas and tbl_mapel.kd_mapel=tbl_kelasmapel.kd_mapel and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_guru.nip=tbl_mapel.nip and tbl_kelas.kd_kelas='$kdkl[kd_kelas]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tipepel='Pengetahuan dan Keterampilan'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['kd_mapel'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
    </div>
  </body>
  </html>
  
  
  <script type="text/javascript">window.print()</script>