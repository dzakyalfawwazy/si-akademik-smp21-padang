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
  $kdkl=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_siswa.nis=tbl_kelassiswa.nis and tbl_siswa.nis='$_SESSION[nis]'"));
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$_POST[kodekelas]','$_GET[semester]','$_GET[tahunajaran]','$_POST[mapel]','$_POST[nip]')");
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
        <div class="card-footer">
          <a href="cetakpelajaran.php?tahunajaran=<?=$_GET['tahunajaran']?>&semester=<?= $_GET['semester'] ?>" class='btn btn-success' <?= $dis ?>><i class="fas fa-print"></i>Cetak</a>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>