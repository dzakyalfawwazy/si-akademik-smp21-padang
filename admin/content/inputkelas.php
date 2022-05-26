  <?php
  if (isset($_POST['kirim'])) {
    $qg=mysqli_query($con,"select * from tbl_pelajaran where tipeguru='Guru Kelas'");
    while($mp=mysqli_fetch_array($qg)){

      $data=mysqli_fetch_array(mysqli_query($con,"select max(kd_mapel) as maxcode from tbl_mapel"));
      $kdmapel=$data['maxcode'];
      $nourut=(int)substr($kdmapel, 3,3);
      $nourut++;
      $char="MG-";
      $kdmapel=$char.sprintf("%03s",$nourut);
      $qmp=mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$kdmapel','$_POST[semester]','$_POST[tahunajaran]','$mp[kd_pel]','$_POST[nip]')");
      $qkm=mysqli_query($con,"INSERT INTO `tbl_kelasmapel`(`id`, `kd_kelas`, `kd_mapel`) VALUES (NULL,'$_POST[kodekelas]','$kdmapel')");
    }

    mysqli_query($con,"INSERT INTO `tbl_kelas`(`kd_kelas`, `kelas`, `semester`, `tahunajaran`, `nip`) VALUES ('$_POST[kodekelas]','$_POST[namakelas]','$_POST[semester]','$_POST[tahunajaran]','$_POST[nip]')");
    echo "<meta http-equiv=refresh content=1>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <form role="form" method="post">
    <div class="row">
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Kelas</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="kodekelas">Kode Kelas</label>
              <?php
              $data=mysqli_fetch_array(mysqli_query($con,"select max(kd_kelas) as maxcode from tbl_kelas"));
              $kdkel=$data['maxcode'];
              $nourut=(int)substr($kdkel, 3,3);
              $nourut++;
              $char="K-";
              $kdkel=$char.sprintf("%03s",$nourut);
              ?>
              <input type="text" class="form-control" id="kodekelas" readonly name="kodekelas" value="<?= $kdkel ?>">
            </div>
            <div class="form-group">
              <label for="namakelas">Nama Kelas</label>
              <input type="text" class="form-control" id="namakelas" name="namakelas" placeholder="Masukan Nama Kelas">
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <select type="text" class="form-control" id="semester" required name="semester">
                <option value="" hidden>Silahkan Pilih</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tahunajaran">Tahun Ajaran</label>
              <select type="text" class="form-control" id="tahunajaran" required name="tahunajaran">
                <option value="" hidden>Silahkan Pilih</option>
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
              <label for="nip">Nama Guru</label>
              <select class="form-control" id="nip" name="nip">
                <option value="">Silahkan Pilih</option>
                <?php
                $query=mysqli_query($con,"select * from tbl_guru where jenispegawai='Guru Kelas'");
                while($dataguru=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $dataguru['nip'] ?>"><?= $dataguru['namaguru']."(".$dataguru['nip'].")" ?></option>
                <?php }  ?>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" name="kirim" class="btn btn-primary toastsDefaultSuccess">Simpan</button>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-8">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Data Kelas</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kelas</th>
                  <th>Kelas</th>
                  <th>Semester</th>
                  <th>Tahun Ajaran</th>
                  <th>Nama Guru</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $qukel=mysqli_query($con,"select * from tbl_kelas, tbl_guru where tbl_kelas.nip=tbl_guru.nip");
                $no=0;
                while($dakel=mysqli_fetch_array($qukel)){
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $dakel['kd_kelas'] ?></td>
                    <td><?= $dakel['kelas'] ?></td>
                    <td><?= $dakel['semester'] ?></td>
                    <td><?= $dakel['tahunajaran'] ?></td>
                    <td><?= $dakel['namaguru'] ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="?p=41&kd_kelas=<?= $dakel['kd_kelas'] ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                      <a href="deleteadmin.php?tipe=deletekelas&kd_kelas=<?= $dakel['kd_kelas'] ?>&nipguru=<?=$dakel['nip'] ?>&tahunajaran=<?= $dakel['tahunajaran'] ?>&semester=<?= $dakel['semester']?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
  </form>