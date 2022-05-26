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
  <?php $query1= mysqli_query($con,"select * from tbl_materi join tbl_mapel on tbl_materi.kd_mapel=tbl_mapel.kd_mapel join tbl_pelajaran on tbl_mapel.kd_pel=tbl_pelajaran.kd_pel where tbl_materi.id_materi='$_GET[id_materi]'");
$data=mysqli_fetch_array($query1);
 ?>
  <div class="row">
    <div class="col-md-3">
      <!-- /.card -->
      <div class="card card-primary">
        <div class="card-body">
          <form method="get" name="form2">
            <input type="hidden" name="p" value="7">
            <input type="hidden" name="semester" value="<?= $data['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $data['tahunajaran'] ?>">

            <div class="form-group">
              <label for="kd_kelas">Informasi</label>
            <input type="text" class="form-control" disabled name="semester" value="<?= $data['semester'] ?>">
            <input type="text" class="form-control" disabled name="tahunajaran" value="<?= $data['tahunajaran'] ?>">
            <input type="text" class="form-control" disabled name="mapel" value="<?= $data['namapel'] ?>">
              
            </div>
            <div class="card">
            <div class="card-body">
              <div class="card-title"><label>Berkas Materi</label></div>
              <div class="card-text">
              <a href="../materi/<?= $data['file_materi'] ?>" download="<?= $data['file_materi'] ?>" target="_blank">Unduh File</a>
            </div>
            </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">

          <?php
          // echo "select * from tbl_materi where kd_kelas='$_GET[kd_kelas]' and kd_mapel='$_GET[mapel]'";
           $mat=mysqli_fetch_array(mysqli_query($con,"select * from tbl_materi where id_materi='$_GET[id_materi]'")); ?>
        <form method="post">
          <div class="form-group">
              <label for="tema">Judul Materi</label>
              <input type="text" class="form-control" id="judul" required disabled value="<?= $mat['judul'] ?>" name="judul" <?= $dis ?>>
            </div>
            <div class="form-group">
              <label for="tema">Isi Materi</label>
              <br/>
             <?= $mat['materi'] ?>
            </div>
          </form>
      </div>  
      </div>
    </div>
  </div>