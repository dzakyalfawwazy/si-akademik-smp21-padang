  <?php
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"UPDATE `tbl_pelajaran` SET namapel='$_POST[mapel]', kkm='$_POST[kkm]',tipepel='$_POST[tipemapel]',tipeguru='$_POST[tipeguru]' where kd_pel='$_POST[kodemapel]'");
    echo "<meta http-equiv=refresh content=0;url=index.php?p=5>";
  }
  $dpel=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_pelajaran where kd_pel='$_GET[kd_pel]'"));
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-3">
          <form method="post" name="form1">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Mata Pelajaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <div class="form-group">
            <label for="kodekelas">Kode Mata Pelajaran</label>
            <input type="text" class="form-control" id="kodekelas" readonly name="kodemapel" value="<?= $dpel['kd_pel'] ?>">
          </div>
          <div class="form-group">
            <label for="tipemapel">Tipe Pelajaran</label>
            <select class="form-control" id="tipemapel"  name="tipemapel" placeholder="Masukan Mata Pelajaran" >
              <option value="<?= $dpel['tipepel'] ?>"><?= $dpel['tipepel'] ?></option>
              <option value="Sikap">Sikap</option>
              <option value="Pengetahuan dan Keterampilan">Pengetahuan dan Keterampilan</option>
              <option value="Ekstrakulikuler">Ekstrakulikuler</option>
              <option value="Saran-saran">Saran-saran</option>
              <option value="Tinggi dan Berat Badan">Tinggi dan Berat Badan</option>
              <option value="Kondisi Kesehatan">Kondisi Kesehatan</option>
              <option value="Prestasi">Prestasi</option>
              <option value="Ketidak Hadiran">Ketidak Hadiran</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="mapel">Mata Pelajaran</label>
            <input type="text" class="form-control" id="mapel"  name="mapel" value="<?= $dpel['namapel'] ?>" placeholder="Masukan Mata Pelajaran" >
          </div>
          <div class="form-group">
            <label for="tipemapel">Jenis Guru</label>
            <select class="form-control" id="tipeguru"  name="tipeguru" placeholder="Masukan Mata Pelajaran" >
              <option value="<?= $dpel['tipeguru'] ?>"><?= $dpel['tipeguru'] ?></option>
              <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
              <option value="Guru Kelas">Guru Kelas</option>
            </select> 
          </div>

            <div class="form-group">
              <label for="kkm">KKM <small>(KTPS)</small></label>
              <input type="number" name="kkm" class="form-control" placeholder="Masukan KKM" value="<?= $dpel['kkm'] ?>">
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" name="kirim" class="btn btn-primary toastsDefaultSuccess">Simpan</button>
        </div>
      </div>
        </form>
      <!-- /.card -->
    </div>
    <div class="col-md-9">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Mata Pelajaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>KKM</th>
                <th>Tipe Pelajaran</th>
                <th>Jenis Guru</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_pelajaran where kd_pel='$_GET[kd_pel]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['kd_pel'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['kkm'] ?></td>
                <td><?= $dakel['tipepel'] ?></td>
                <td><?= $dakel['tipeguru'] ?></td>
                  <td>
                    <div class="btn-group">
                       <a href="deleteadmin.php?tipe=deletepel&kd_pel=<?= $dakel['kd_pel'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
            </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>