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
      $namafile = $_FILES['berkas']['name'];
      $tmp = $_FILES['berkas']['tmp_name'];
   // echo "INSERT INTO tbl_materi values(NULL,'$_GET[kd_kelas]','$_GET[mapel]','$_POST[judul]','$_POST[materi]','$namafile')";
    $query=$con->query("INSERT INTO tbl_materi values(NULL,'$_GET[kd_kelas]','$_GET[mapel]','$_POST[judul]','$_POST[materi]','$namafile')");
    if($query){
       move_uploaded_file($tmp, '../materi/'.$namafile);
      echo "<script>alert('Data Materi Berhasil Diinputkan!')</script>";
      echo "<meta http-equiv=refresh content=1>";
    }
    }
  

  ?>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Silahkan Pilih</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form1">
            <input type="hidden" name="p" value="10">
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
            <input type="hidden" name="p" value="10">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">

            <div class="form-group">
              <label for="kd_kelas">Kelas</label>
              <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas">
                <?= $option3 ?>
                <?php
                $query=mysqli_query($con,"select * from tbl_kelasmapel, tbl_kelas, tbl_mapel where tbl_kelasmapel.kd_kelas=tbl_kelas.kd_kelas and tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.nip='$_SESSION[nipguru]' group by tbl_kelas.kd_kelas ");
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
                $query=mysqli_query($con,"select * from tbl_mapel,tbl_pelajaran where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and nip='$_SESSION[nipguru]' and tbl_pelajaran.tipepel='Pengetahuan dan Keterampilan'");
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
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label for="tema">Judul Materi</label>
              <input type="text" class="form-control" id="judul" required name="judul" <?= $dis ?>>
            </div>
            <div class="form-group">
              <label for="tema">Materi</label>
              <textarea class="form-control" <?= $dis ?> id="tema" name="materi" placeholder="Masukan Materi Siswa"></textarea>
            </div>
            <div class="form-group">
              <label for="file">File Materi</label>
              <input type="file" class="form-control" accept=".pdf,.docx,.xlsx,.png,.jpeg,.jpg" name="berkas" required <?= $dis ?> id="file" placeholder="Masukan File Materi">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success" <?= $dis ?> name="simpan" value="Simpan Materi">
            </div>
          </form>
      </div>  
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="text-green text-bold">Data Materi</div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped" id="example3">
            <thead>
              <tr>
                <th>No.</th><th>Kelas</th><th>Mata Pelajaran</th><th>Materi</th><th>Aksi</th>
              </tr>
            </thead>
            <?php $qtema=$con->query("SELECT * from tbl_kelas, tbl_mapel, tbl_pelajaran, tbl_materi where tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_materi.kd_kelas='$_GET[kd_kelas]' and tbl_kelas.kd_kelas=tbl_materi.kd_kelas and tbl_materi.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel");
            $no=0;
            while($row=$qtema->fetch_array(MYSQLI_ASSOC)) { $no++;?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['namapel'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td> <a class="btn btn-xs btn-danger" onclick="return confirm('Yakin menghapus?')" href="deleteguru.php?aksi=deletetema&id=<?=$row['id_materi']?>"><i class="fas fa-trash"></i></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>