  <?php session_start();
  include '../config/conect.php';
  ?>
  <?php
  if(isset($_GET['semester'])||isset($_GET['tahunajaran'])||isset($_GET['tipe'])){
    $option1="<option value='$_GET[semester]'>".$_GET['semester']."</option>";
    $option2="<option value='$_GET[tahunajaran]'>".$_GET['tahunajaran']."</option>";
    $dis="";
     if($_GET['tipe']=='MID') $cm='checked'; else $cm='';
    if($_GET['tipe']=='Semester') $cs='checked'; else $cs='';
  }
  else {
    $option1="<option value='' hidden>Silahkan Pilih</option>";
    $option2="<option value='' hidden>Silahkan Pilih</option>";
    $dis="disabled";$cm='';$cs='';
  }
  @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_guru, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_guru.nip=tbl_kelas.nip and tbl_siswa.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'"));
   $kepsek=mysqli_fetch_array(mysqli_query($con,"SELECT * from tb_kepsek where id=1"));
 

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Rapor Mid</title>
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
    <title>Rapor MID</title>
  </head>
  <body>
    <div class="container">
      <div class="text-center">

      <h4>PEMERINTAH KOTA PADANG</h4>
      <h4>SMP Negeri 21 Padang</h4>
      <h6><i>Jl. Simpang, Bandar Buat, Kec. Lubuk Kilangan, Kota Padang, Sumatera Barat &nbsp;&nbsp; Kode Pos:25157</i></h6>
      <hr>
    </div>
    <div class="text-center">
      <h5>RAPOR <?= $_GET['jenis'] ?> PENILAIAN TENGAH SEMESTER <?= $_GET['semester'] ?></h5>
      <h5>TAHUN AJARAN <?= $_GET['tahunajaran'] ?></h5>
      <h5>SMP NGERI 21 PADANG</h5>
    </div>
      <table class="" width="100%">
        <tr>
          <td width="17%">NAMA</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['nama'] ?></td>
          <td width="17%">Tahun Ajaran</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$_GET['tahunajaran'] ?></td>
        </tr>
        <tr>
          
          <td>NISN</td>
          <td>:</td>
          <td><?=@$kdkl['nisn'] ?></td>
          <td width="17%">Semester</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$_GET['semester'] ?></td>
        </tr>
        <tr>
          <td width="17%">Kelas</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['kelas'] ?></td>
        </tr>
      </table>
      <br>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Mata Pelajaran</th>
            <th colspan="2">Nilai Pengetahuan</th>
          </tr>
          <tr>
            <th>Nilai</th>
            <th>Predikat</th>
          </tr>
        </thead>
        <tbody>

          <?php @$qukel=mysqli_query($con,"SELECT * from 
            tbl_nilai, tbl_kd, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran 
            where tbl_kd.kd_kelas=tbl_kelas.kd_kelas 
            and tbl_kd.id_kd=tbl_nilai.id_kd 
            and tbl_guru.nip=tbl_mapel.nip 
            and tbl_kd.kd_mapel=tbl_mapel.kd_mapel 
            and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel 
            and tbl_nilai.nis='$_SESSION[nis]' 
            and tbl_kelas.semester='$_GET[semester]' 
            and tbl_kelas.tahunajaran='$_GET[tahunajaran]' 
            and tbl_kd.tipe='$_GET[tipe]'
            and tbl_nilai.jenis='Pengetahuan' group by tbl_mapel.kd_mapel");
         
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            if($_GET['jenis']=='K13'){
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <?php ?>
                <td><?= $dakel['nilai'] ?></td>
                <td>
                  <?php if($dakel['nilai'] < 50) $nilai='D';
                  elseif($dakel['nilai'] < 65) $nilai='C';
                  elseif($dakel['nilai'] < 80) $nilai='B';
                  elseif($dakel['nilai'] < 100) $nilai='A';
                  echo $nilai;
                  ?>
                  
                </td> 
            </tr>
              <?php }
               if($_GET['jenis']=='KTSP'){
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
       
                <td><?= $dakel['kkm'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
            </tr>
              <?php } ?>
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

    <tr>
      <td></td>
      <td></td>
      <td>Mengetahui:<br/>Orang Tua/Wali<br/><br/><br/><br/>(..................................)<br/></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  </body>
  </html>
  
  
  <script type="text/javascript">window.print()</script>