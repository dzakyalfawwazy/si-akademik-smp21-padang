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
    $date=date('Y-m-d H:s');
      $namafile = $_FILES['tugas']['name'];
      $tmp = $_FILES['tugas']['tmp_name'];
      // echo "INSERT INTO tbl_nilailain values(NULL,'$_SESSION[nis]','$_POST[id_tugas]','$namafile','0','$date')";
    $query=$con->query("INSERT INTO tbl_nilaitugas values(NULL,'$_SESSION[nis]','$_POST[id_tugas]','$namafile','0','$date')");
    if($query){
      move_uploaded_file($tmp, '../tugas/'.$namafile);
      echo "<script>alert('Tugas Berhasil Diinputkan!')</script>";
      echo "<meta http-equiv=refresh content=1;url='index.php?p=9'>";
    }
  }
$data=mysqli_fetch_array(mysqli_query($con,"select * from tbl_tugas,tbl_materi,tbl_mapel where tbl_tugas.id_materi=tbl_materi.id_materi and id_tugas='$_GET[id_tugas]'"));
  ?>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tugas dari</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form1">
            <input type="hidden" name="p" value="9">
<div class="form-group">
              <label for="kd_kelas">Informasi</label>
            <input type="text" class="form-control" disabled name="semester" value="<?= $data['semester'] ?>">
            <input type="text" class="form-control" disabled name="tahunajaran" value="<?= $data['tahunajaran'] ?>">
              
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="tema">Materi</label>
               <input type="text" class="form-control" disabled name="semester" value="<?= $data['judul'] ?>">
               <input type="hidden" class="form-control" name="id_tugas" value="<?= $_GET['id_tugas'] ?>">
              <label for="tema">File Tugas</label>
              <input type="file" class="form-control" required id="tema" name="tugas" placeholder="Masukan Tugas Siswa">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success" onclick="return confirm('Tugas yang telah disubmit, tidak bisa di ulangi. Anda Yakin?')" name="simpan" value="Simpan Tugas">
            </div>
          </form>
      </div>  
      </div>
    </div>
  </div>