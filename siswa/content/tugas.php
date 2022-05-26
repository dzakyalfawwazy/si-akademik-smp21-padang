  <?php
  if(isset($_GET['semester'])||isset($_GET['tahunajaran'])||isset($_GET['tipe'])){
    $option1="<option value='$_GET[semester]'>".$_GET['semester']."</option>";
    $option2="<option value='$_GET[tahunajaran]'>".$_GET['tahunajaran']."</option>";
    $dis="";
  }
  else {
    $option1="<option value='' hidden>Silahkan Pilih</option>";
    $option2="<option value='' hidden>Silahkan Pilih</option>";
    $dis="disabled"; 
  }
  if(isset($_GET['tipe'])) $c="<option value='".$_GET['tipe']."'>".$_GET['tipe']."</option>"; else $c="";
  if(isset($_GET['kd_kelas']) ||isset($_GET['mapel'])) {
    $qk=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where kd_kelas='$_GET[kd_kelas]'"));
    $qm=mysqli_fetch_array(mysqli_query($con,"select * from tbl_mapel,tbl_pelajaran where kd_mapel='$_GET[mapel]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
    $option4="<option value='$_GET[mapel]'>".$qm['namapel']."</option>";
  }

  else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";$option4="<option value='' hidden>Silahkan Pilih</option>";}
  
  if (isset($_POST['simpan'])) {
    $query=$con->query("INSERT INTO tbl_materi values(NULL,'$_GET[kd_kelas]','$_GET[mapel]','$_POST[judul]','$_POST[materi]')");
    if($query){
      echo "<script>alert('Data Tugas Berhasil Diinputkan!')</script>";
      echo "<meta http-equiv=refresh content=1>";
    }
  }

  ?>
  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Silahkan Pilih</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form1">
            <input type="hidden" name="p" value="9">
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
      <div class="card card-primary">
        <div class="card-body">
          <form method="get" name="form2">
            <input type="hidden" name="p" value="9">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">

            <div class="form-group">
              <label for="kd_kelas">Kelas</label>
              <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas">
                <?= $option3 ?>
                <?php
                $query=mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas where tbl_kelassiswa.kd_kelas=tbl_kelas.kd_kelas and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelassiswa.nis='$_SESSION[nis]'");

                while($dataguru=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $dataguru['kd_kelas'] ?>"><?= $dataguru['kelas'] ?></option>
                <?php }  ?>
              </select>
            </div>
            <div class="form-group">
              <label for="mapel">Mata Pelajaran</label>
              <select class="form-control" id="mapel" <?= $dis ?> name="mapel" onchange="submit()">
                <?= $option4 ?>
                <?php
                $query=mysqli_query($con,"select * from tbl_kelasmapel,tbl_mapel,tbl_pelajaran where tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_kelasmapel.kd_kelas in (select tbl_kelas.kd_kelas from tbl_kelassiswa, tbl_kelas where tbl_kelassiswa.kd_kelas=tbl_kelas.kd_kelas and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelassiswa.nis='$_SESSION[nis]')");
                while($datapel=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $datapel['kd_mapel'] ?>"><?= $datapel['namapel'] ?></option>
                <?php }  ?>
              </select>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
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
                <th>Judul</th>
                <th>Tanggal Kirim</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
              <?php
             @  $qukel=mysqli_query($con,"select * from tbl_tugas join tbl_materi on tbl_tugas.id_materi=tbl_materi.id_materi join tbl_mapel on tbl_materi.kd_mapel=tbl_mapel.kd_mapel join tbl_pelajaran on tbl_mapel.kd_pel=tbl_pelajaran.kd_pel where tbl_materi.kd_kelas='$_GET[kd_kelas]' and tbl_materi.kd_mapel='$_GET[mapel]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['judul'] ?></td>
                <?php
                $tu=mysqli_query($con,"select * from tbl_nilaitugas,tbl_tugas where tbl_nilaitugas.id_tugas=tbl_tugas.id_tugas and tbl_tugas.id_tugas='$dakel[id_tugas]'");
                $dtu=mysqli_fetch_array($tu);
                if($dtu["id_tugas"]!=$dakel["id_tugas"]) {
                ?>
                <td colspan="2"><a class="btn btn-sm btn-success" href="index.php?p=10&id_tugas=<?= $dakel['id_tugas'] ?>">Lihat lebih lanjut</a> </td>

              <?php } else {?>
                <td><?= $dtu['waktu_kirim'] ?></td>
                <td><?= $dtu['nilai'] ?></td>

              <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
      </div>  
      </div>
    </div>
  </div>