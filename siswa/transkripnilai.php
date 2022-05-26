  <?php
  include '../config/conect.php';
  ?>
  <?php
  if(isset($_GET['semester'])||isset($_GET['tahunajaran'])){
    $option1="<option value='$_GET[semester]'>".$_GET['semester']."</option>";
    $option2="<option value='$_GET[tahunajaran]'>".$_GET['tahunajaran']."</option>";
    $dis="";
  }
  else {
    $option1="<option value='' hidden>Silahkan Pilih</option>";
    $option2="<option value='' hidden>Silahkan Pilih</option>";
    $dis="disabled";
  }
  @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'"));
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$_POST[kodekelas]','$_GET[semester]','$_GET[tahunajaran]','$_POST[mapel]','$_POST[nip]')");
    echo "<meta http-equiv=refresh content=1>";
  }

  ?>
  <div class="card">
    <div class="card-header bg-info">
      <div class="card-title">
        Transkrip Nilai
      </div>
    </div>
    <div class="card-body">
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
          <?php @$qukel=mysqli_query($con,"select * from tbl_nilai, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_nilai.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_nilai.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
           tbl_nilai.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' group by tbl_mapel.kd_mapel");
          $no=0;
          while($dakel=mysqli_fetch_array($qukel)){
            $dakelb=mysqli_query($con,"select * from tbl_nilai, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_nilai.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_nilai.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
             tbl_nilai.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.kd_mapel='$dakel[kd_mapel]'");

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
  </div>