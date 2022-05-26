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

  @$kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'"));
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$_POST[kodekelas]','$_GET[semester]','$_GET[tahunajaran]','$_POST[mapel]','$_POST[nip]')");
    echo "<meta http-equiv=refresh content=1>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Silahkan Pilih</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form1" action="?p=3">
            <input type="hidden" name="p" value="2">
            <div class="form-group">
              <div class="form-row form-inline"><label>
                <input type="radio" class="form-check col-4" <?= $cm ?> name="tipe" value="MID">MID</label>
                <label>
                <input type="radio" class="form-check col-6" <?= $cs ?> name="tipe" value="Semester">Semester</label>
              </div>
              <label for="semester">Semester</label>
              <select type="text" class="form-control" id="semester" required name="semester">
                <?= $option1 ?>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tahunajaran">Tahun Ajaran</label>
              <select type="text" class="form-control" id="tahunajaran" onchange="submit()" required name="tahunajaran">
                <?= $option2 ?>
                <?php 
                for ($i=date('Y'); $i > 2010 ; $i--) { 
                  $thnk=$i+1;
                  $tha=$i."/".$thnk;
                  echo"<option value='$tha'>$tha</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Cari</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-9">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Nilai Akademik Mata Pelajaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
                <th>Jenis Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>Nama Guru</th>
                <th>Nilai</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if(@$_GET['tipe']=='Semester'){
               @$qukel=mysqli_query($con,"select * from tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
               tbl_rapor.nis='$_SESSION[nis]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $dakel['kd_mapel'] ?></td>
                  <td><?= $dakel['tipe'] ?></td>
                  <td><?= $dakel['namapel'] ?></td>
                  <td><?= $dakel['namaguru'] ?></td>
                  <td><?= $dakel['nilai'] ?></td>
                  <td><?= $dakel['keterangan'] ?></td>
                </tr>
              <?php } } else if(@$_GET['tipe']=='MID') { 
                
               @$qukel=mysqli_query($con,"SELECT * from 
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
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $dakel['kd_mapel'] ?></td>
                  <td><?= $dakel['jenis'] ?></td>
                  <td><?= $dakel['namapel'] ?></td>
                  <td><?= $dakel['namaguru'] ?></td>
                  <td><?= $dakel['nilai'] ?></td>
                  <td>-</td>
                </tr>
              <?php } } ?>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>