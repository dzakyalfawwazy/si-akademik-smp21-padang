  <?php
  $dkp=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelasmapel, tbl_mapel, tbl_kelas, tbl_pelajaran, tbl_guru where tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_kelas.kd_kelas=tbl_kelasmapel.kd_kelas and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_guru.nip=tbl_mapel.nip and tbl_kelasmapel.id='$_GET[id]'"));
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
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"UPDATE `tbl_kelasmapel` SET `kd_kelas`='$_POST[kd_kelas]', `kd_mapel`='$_POST[mapel]' WHERE id='$_GET[id]'");
     echo "<meta http-equiv=refresh content=0;url='?p=6'>";
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
            <input type="hidden" name="p" value="6">
            <div class="form-group">
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
          </form>
        </div>
      </div>
      <form method="post" name="form2">
        <div class="card card-primary">
          <div class="card-body">
            <div class="form-group">
              <label for="kd_kelas">Kelas</label>
              <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas">
                <option value="<?= $dkp['kd_kelas'] ?>" hidden><?= $dkp['kelas'] ?></option>
                <?php
                $query=mysqli_query($con,"select * from tbl_kelas where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]'");
                while($dataguru=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $dataguru['kd_kelas'] ?>"><?= $dataguru['kelas'] ?></option>
                <?php }  ?>
              </select>
            </div>
            <div class="form-group">
              <label for="mapel">Mata Pelajaran</label>
                <select class="form-control" <?= $dis ?> id="mapel" name="mapel">
                    <option value="<?= $dkp['kd_mapel'] ?>"><?= $dkp['namapel'] ?>(<?= $dkp['namaguru'] ?>)</option>
                  <?php
                  $querypel=mysqli_query($con,"select * from tbl_mapel, tbl_guru, tbl_pelajaran where tbl_pelajaran.tipeguru='Guru Mata Pelajaran' and tbl_mapel.nip=tbl_guru.nip and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel");
                  while($datapel=mysqli_fetch_array($querypel)){
                    ?>
                    <option value="<?= $datapel['kd_mapel'] ?>"><?= $datapel['namapel'] ?>(<?= $datapel['namaguru'] ?>)</option>
                  <?php }  ?>
                </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" name="kirim" <?= $dis ?> class="btn btn-primary toastsDefaultSuccess">Update</button>
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
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Kelas</th>
                <th>Nama Mata Pelajaran</th>
                <th>Nama Guru</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_kelasmapel, tbl_mapel, tbl_kelas, tbl_pelajaran, tbl_guru where tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_kelas.kd_kelas=tbl_kelasmapel.kd_kelas and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_guru.nip=tbl_mapel.nip and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelasmapel.id='$_GET[id]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['tahunajaran'] ?></td>
                <td><?= $dakel['semester'] ?></td>
                <td><?= $dakel['kelas'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                  <td>
                    <div class="btn-group">
                       <a href="deleteadmin.php?tipe=deletekelaspel&id=<?= $dakel['id'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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