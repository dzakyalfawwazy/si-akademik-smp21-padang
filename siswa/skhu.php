  <?php session_start();
   include '../config/conect.php';
   ?>
  <?php
   $kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where  tbl_siswa.nis='$_SESSION[nis]'"));
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>SKHU</title>
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

      <table class="table text-center">
        <tr>
          <td class="h5">
              &nbsp;
    <br/>
    <br/>
    <br/>
    <br/>
    &nbsp;
            DEPARTEMEN PENDIDIKAN NASIONAL<BR/>REPUBLIK INDONESIA
            <BR/>
          </td>
        </tr>
        <tr>
          <td class="h5">
            <B>SURAT KETERANGAN <BR>HASIL UJIAN AKHIR SEKOLAH BERSTANDAR NASIONAL</B>
          </td>
        </tr>
        <tr>
          <td>
            <div class="h5" style="color: red">SEKOLAH MENENGAH PERTAMA</div>
            <p>TAHUN PELAJARAN :<?PHP ?></p>
          </td>
        </tr>
      </table>
      <table class="table">
        
        <tr>
          <td colspan="3">Yang bertanda tangan di bawah ini, Kepala Sekolah Menengah Pertama</td>
        </tr>
        <tr>
          <td>Negeri 21, Kota Padang</td>
          <td></td>
          <td class="text-right">menerangkan bahwa:</td>
        </tr>
        <tr>
          <td width="40%">nama</td>
          <td width="30%">: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['nama'] ?></td>
          <td width="30%"></td>
        </tr>
        <tr>
          <td>tempat dan tanggal lahir</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['tmpt_lahir'].", ".date('d/m/Y',strtotime($kdkl['tgl_lahir'])) ?></td>
          <td></td>
        </tr>
        <tr>
          <td>nomor peserta</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $kdkl['nisn']?></td>
          <td></td>
        </tr>
        <tr>
          <td>SMP</td>
          <td>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SMP Negeri 21 Padang</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="3" class="h5 text-center"><BR>LULUS/TIDAK LULUS</td>
        </tr>
        <tr>
          <td colspan="3">Ujian Akhir Sekolah Berstandar Nasional berstandar Peraturan Menteri Pendidikan Nasional Nomor 39 Tahun 2007 dengan hasil sebagai berikut:</td>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr class="text-center">
          <td rowspan="2" width="5%">No</td>
          <td rowspan="2" width="45%">Mata Pelajaran</td>
          <td colspan="2">Nilai</td>
        </tr>
        <tr class="text-center">
          <td>Angka</td>
          <td>Huruf</td>
        </tr>
        <?php $qm1=mysqli_query($con,"SELECT * from tbl_pelajaran, tbl_nilaiijazah, tbl_ijazah where tbl_pelajaran.kd_pel=tbl_ijazah.kd_pel and tbl_nilaiijazah.id_ija=tbl_ijazah.id_ija and tbl_nilaiijazah.nis='$kdkl[nis]' and tbl_ijazah.bagian='SKHU'");
        $no1=0;
        while($r1=mysqli_fetch_array($qm1)){ $no1++;?>
        <tr>
          <td class="text-center"><?= $no1; ?></td>
          <td><?= $r1['namapel'] ?></td>
          <td><?= $r1['nilai'];  $j11[]=$r1['nilai'] ?></td>
          <td><?= ucwords(terbilang($r1['nilai'])) ?></td>
        </tr>
      <?php } $result=array_sum($j11); ?>
        <tr>
          <td class="text-center" colspan="2">Jumlah</td>
          <td><?= $result; ?></td>
          <td><?= ucwords(terbilang($result)) ?></td>
        </tr>
      </table>
      <table width="100%" cellpadding="10">
        <tr>
          <td class="text-right" width="50%"><img src="" alt="Pas Photo" style="width: 3cm;height: 4cm"></td>
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
  <script type="text/javascript">
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
  </script>
  <script type="text/javascript">window.print()</script>
  
  