  <?php session_start();
  include '../config/conect.php';
  ?>
  <?php

  @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_guru, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_guru.nip=tbl_kelas.nip and tbl_kelas.tahunajaran='$_GET[tahunajaran]'"));
  $kepsek=mysqli_fetch_array(mysqli_query($con,"SELECT * from tb_kepsek where id=1"));
 
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Rapor</title>
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
    <?php if ($_GET['jenis']=="K13"){ ?>
    <div class="container">
      <center>
      <h4>RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK</h4>
    </center>
      <table class="" width="100%">
        <tr>
          <td width="17%">Nama Siswa</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['nama'] ?></td>
          <td width="17%">Kelas</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['kelas'] ?></td> 
        </tr>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><?=@$kdkl['nisn'] ?></td>
          <td>Semester</td>
          <td>:</td>
          <td><?=@$_GET['semester'] ?></td>
        </tr>
        <tr>
          <td>Nama Sekolah</td>
          <td>:</td>
          <td>SMP Negeri 21 Padang</td>
          <td>Tahun Ajaran</td>
          <td>:</td>
          <td><?=@$_GET['tahunajaran'] ?></td>
        </tr>
        <tr>
          <td>Alamat Sekolah</td>
          <td>:</td>
          <td colspan="4">Jl. SMA 8 Padang</td>
        </tr>
      </table>
      <h6>A. Sikap</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th colspan="3">Deskripsi</th>
            
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Sikap'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <h6>B. Pengetahuan dan Keterampilan</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Mata Pelajaran</th>
            <th colspan="3">Pengetahuan</th>
            <th colspan="3">Keterampilan</th>
            
          </tr>
          <tr>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Keterangan</th>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"SELECT * from 
            tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran
            where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas
            and tbl_guru.nip=tbl_mapel.nip 
            and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel 
            and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel 
            and tbl_rapor.nis='$_SESSION[nis]' 
            and tbl_kelas.semester='$_GET[semester]' 
            and tbl_kelas.tahunajaran='$_GET[tahunajaran]' 
             group by tbl_mapel.kd_mapel");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $dakelb=mysqli_query($con,"SELECT * from
              tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran 
              where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas 
              and tbl_guru.nip=tbl_mapel.nip 
              and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel 
              and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel 
              and tbl_rapor.nis='$_SESSION[nis]' 
              and tbl_kelas.semester='$_GET[semester]' 
              and tbl_kelas.tahunajaran='$_GET[tahunajaran]' 
              and tbl_mapel.kd_mapel='$dakel[kd_mapel]'");
            
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <?php while($dak=mysqli_fetch_array($dakelb)){ ?>
                <td><?= $dak['nilai'] ?></td>
                <td>
                  <?php if($dak['nilai'] < 50) $nilai='D';
                  elseif($dak['nilai'] < 65) $nilai='C';
                  elseif($dak['nilai'] < 80) $nilai='B';
                  elseif($dak['nilai'] < 100) $nilai='A';
                  echo $nilai;
                  ?>
                  
                </td> 
                <td><?= $dak['keterangan'] ?></td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>C. Ekstrakulikuler</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kegiatan Ekstrakulikuler</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Ekstrakulikuler'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>D. Saran-saran</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Saran-saran</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Saran-saran'");
          while($dakel=mysqli_fetch_array($qukel)){
            ?>
            <tr>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>E. Tinggi dan Berat Badan</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Aspek Yang Dinilai</th>
            <th>Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Tinggi dan Berat Badan'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>F. Kondisi Kesehatan</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Aspek Fisik</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Kondisi Kesehatan'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>G. Prestasi</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Jenis Prestasi</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Prestasi'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>H. Ketidak Hadiran</h6>
      <table class="table table-bordered table-striped">
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Ketidak Hadiran'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            ?>
            <tr>
              <td><?= $dakel['namapel'] ?></td>
              <td>:</td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  <?php  }?>
    <?php if ($_GET['jenis']=="KTSP"){ ?>
    <div class="container">
      
      <center>
      <h4>RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK</h4>
    </center>
     <table class="" width="100%">
        <tr>
          <td width="17%">Nama Siswa</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['nama'] ?></td>
          <td width="17%">Kelas</td>
          <td width="3%">:</td>
          <td width="30%"><?=@$kdkl['kelas'] ?></td> 
        </tr>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><?=@$kdkl['nisn'] ?></td>
          <td>Semester</td>
          <td>:</td>
          <td><?=@$_GET['semester'] ?></td>
        </tr>
        <tr>
          <td>Nama Sekolah</td>
          <td>:</td>
          <td>SMP Negeri 21 Padang</td>
          <td>Tahun Ajaran</td>
          <td>:</td>
          <td><?=@$_GET['tahunajaran'] ?></td>
        </tr>
        <tr>
          <td>Alamat Sekolah</td>
          <td>:</td>
          <td colspan="4">Jl. Simpang, Bandar Buat, Kec. Lubuk Kilangan</td>
        </tr>
      </table>
     <div class="row">
      <div class="col-md-9">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Mata Pelajaran</th>
            <th colspan="4">Nilai</th>
            
          </tr>
          <tr>
            <th>KKM</th>
            <th>Nilai</th>
            <th>Huruf</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
           tbl_rapor.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' group by tbl_mapel.kd_mapel");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $dakelb=mysqli_query($con,"select * from tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
             tbl_rapor.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.kd_mapel='$dakel[kd_mapel]'");
            
            $no++;
            ?>
            <tr>
              <td rowspan="2"><?= $no ?></td>
              <td rowspan="2"><?= $dakel['namapel'] ?></td>
                
                <td><?= $dakel['kkm'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
                <td><?= ucwords(terbilang($dakel['nilai'])) ?></td>
              
                <td><?= $dakel['keterangan'] ?></td>
                 <?= "</tr><tr>"; ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-3">
      <h6>Ketidak Hadiran</h6>
      <table class="table table-bordered table-striped">
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Ketidak Hadiran'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            ?>
            <tr>
              <td><?= $dakel['namapel'] ?></td>
              <td>:</td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
      <h6>Ekstrakulikuler</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kegiatan Ekstrakulikuler</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Ekstrakulikuler'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h6>Prestasi</h6>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Jenis Prestasi</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilailain, tbl_pelajaran, tbl_siswa, tbl_kelas where tbl_nilailain.kd_pel=tbl_pelajaran.kd_pel and tbl_nilailain.kd_kelas=tbl_kelas.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_nilailain.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_pelajaran.tipepel='Prestasi'");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $no++;
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dakel['namapel'] ?></td>
              <td><?= $dakel['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
    </div>
  <?php  }?>
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
      <td>Orang Tua/Wali</td>
      <td></td>
      <td>Guru Kelas <?= $kdkl['kelas']?></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="5"><br/><br/><br/>&nbsp;</td>
    </tr>

    <tr>
      <td></td>
      <td>................<br/>&nbsp;</td>
      <td></td>
      <td><b><u><?= $kdkl['namaguru'] ?></u></b><?= "<br/>". $kdkl['nip']?></td>
      <td></td>
    </tr>

    <tr>
      <td></td>
      <td></td>
      <td>Mengetahui:<br/>Kepala Sekolah<br/><br/><br/><br/><b><u><?= $kepsek['namakepsek'] ?></u></b><br/><?= $kepsek['nipkepsek'] ?></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  </body>
  </html>
  <?php 
  function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
 
  ?>
  
  <script type="text/javascript">window.print()</script>