  <?php
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"INSERT INTO `tbl_pelajaran`  VALUES ('$_POST[kodemapel]','$_POST[mapel]','$_POST[kkm]','$_POST[tipemapel]','$_POST[tipeguru]')");
    echo "<meta http-equiv=refresh content=1>";
  }
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
            <?php
            $data=mysqli_fetch_array(mysqli_query($con,"select max(kd_pel) as maxcode from tbl_pelajaran"));
            $kdmapel=$data['maxcode'];
            $nourut=(int)substr($kdmapel, 3,3);
            $nourut++;
            $char="MP-";
            $kdmapel=$char.sprintf("%03s",$nourut);
            ?>
            <input type="text" class="form-control" id="kodekelas" readonly name="kodemapel" value="<?= $kdmapel ?>">
          </div>
          <div class="form-group">
            <label for="tipemapel">Tipe Pelajaran</label>
            <select class="form-control" id="tipemapel"  name="tipemapel" placeholder="Masukan Mata Pelajaran" >
              <option value="" hidden>Silahkan Pilih</option>
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
            <input type="text" class="form-control" id="mapel"  name="mapel" placeholder="Masukan Mata Pelajaran" >
          </div>
          <div class="form-group">
            <label for="tipemapel">Jenis Guru</label>
            <select class="form-control" id="tipeguru"  name="tipeguru" placeholder="Masukan Mata Pelajaran" >
              <option value="" hidden>Silahkan Pilih</option>
              <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
              <option value="Guru Kelas">Guru Kelas</option>
            </select> 
          </div>

            <div class="form-group">
              <label for="kkm">KKM <small>(KTPS)</small></label>
              <input type="number" name="kkm" class="form-control" placeholder="Masukan KKM">
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
              <?php $qukel=mysqli_query($con,"select * from tbl_pelajaran");
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
                      <a href="?p=51&kd_pel=<?= $dakel['kd_pel'] ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
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