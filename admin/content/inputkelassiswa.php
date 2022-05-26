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
  if(isset($_GET['kd_kelas'])) {
    $qk=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where kd_kelas='$_GET[kd_kelas]'"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
  }

   else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";}
  
  if (isset($_POST['kirim'])) {
    $siswa=$_POST['siswa'];
    $jsiswa=count($siswa);
    for ($j=0; $j < $jsiswa ; $j++) {
    mysqli_query($con,"INSERT INTO `tbl_kelassiswa`(`id`, `kd_kelas`, `nis`) VALUES (NULL,'$_GET[kd_kelas]','$siswa[$j]')");
    }
    echo "<meta http-equiv=refresh content=1>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Silahkan Pilih</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form1">
            <input type="hidden" name="p" value="7">
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
      <!-- /.card -->
    </div>
    <div class="col-md-5">
      <form method="get" name="form2">
            <input type="hidden" name="p" value="7">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
        <div class="card card-primary">
          <div class="card-body">
            <div class="form-group">
              <label for="kd_kelas">Kelas</label>
              <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas" onchange="submit()">
                <?= $option3 ?>
                <?php
                $query=mysqli_query($con,"select * from tbl_kelas where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]'");
                while($dataguru=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $dataguru['kd_kelas'] ?>"><?= $dataguru['kelas'] ?></option>
                <?php }  ?>
              </select>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </form>
    </div>
    <div class="col-md-5">
      <form method="post" name="form3">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th></th>
                <th>NIS</th>
                <th>Nama</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_siswa where (noijazah = '-' or NULL) and nis not in (select nis from tbl_kelassiswa,tbl_kelas where tbl_kelas.tahunajaran ='$_GET[tahunajaran]' and tbl_kelas.semester = '$_GET[semester]' and tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas ) ");
              while($dakel=mysqli_fetch_array($qukel)){
                ?>
                <tr>
                <td><?= "<input type='checkbox' class='form-check' name='siswa[]' value='$dakel[nis]'>" ?></td>
                <td><?= $dakel['nis'] ?></td>
                <td><?= $dakel['nama'] ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
          <div class="card-footer">
            <button type="submit" name="kirim" <?= $dis1 ?> class="btn btn-primary toastsDefaultSuccess">Simpan</button>
          </div>
        <!-- /.card-body -->
      </div>
    </form>
      <!-- /.card -->
    </div>
    <div class="col-md-7">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Siswa Pada Kelas</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table>
            <tr>
              <td>Tahun Ajaran</td>
              <td>:</td>
              <td><?= @$_GET['tahunajaran'] ?></td>
            </tr>
            <tr>
              <td>Semester</td>
              <td>:</td>
              <td><?= @$_GET['semester'] ?></td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td><?= @$qk['kelas'] ?></td>
            </tr>
          </table>
         
          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nis'] ?></td>
                <td><?= $dakel['nama'] ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="deleteadmin.php?tipe=deletekelassiswa&id=<?= $dakel['id'] ?>&semester=<?= $dakel['semester'] ?>&tahunajaran=<?= $dakel['tahunajaran'] ?>&kd_kelas=<?= $dakel['kd_kelas'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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