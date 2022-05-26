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
  if(isset($_GET['kd_kelas']) ||isset($_GET['mapel'])) {
    $qk=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where kd_kelas='$_GET[kd_kelas]'"));
    $qm=mysqli_fetch_array(mysqli_query($con,"select * from tbl_mapel,tbl_pelajaran where kd_mapel='$_GET[mapel]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
    $option4="<option value='$_GET[mapel]'>".$qm['namapel']."</option>";
  }

  else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";$option4="<option value='' hidden>Silahkan Pilih</option>";}
  
  if (isset($_POST['simpan'])) {
   $qu1=mysqli_query($con,"INSERT INTO `tbl_nilai` (`id_nilai`, `kd_kelas`, `kd_mapel`, `nis`, `tipe`, `nilai`, `keterangan`) VALUES (NULL,'$_POST[kd_kelas]','$_POST[kd_mapel]','$_POST[siswa]','Pengetahuan','$_POST[nilai]','$_POST[keterangan]')");
   $qu2=mysqli_query($con,"INSERT INTO `tbl_nilai` (`id_nilai`, `kd_kelas`, `kd_mapel`, `nis`, `tipe`, `nilai`, `keterangan`) VALUES (NULL,'$_POST[kd_kelas]','$_POST[kd_mapel]','$_POST[siswa]','Keterampilan','$_POST[nilai1]','$_POST[keterangan1]')");
  //  echo "<meta http-equiv=refresh content=1>";
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
          <input type="hidden" name="p" value="2">
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
      <input type="hidden" name="p" value="2">
      <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
      <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
      <div class="card card-primary">
        <div class="card-body">
          <div class="form-group">
            <label for="kd_kelas">Kelas</label>
            <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas">
              <?= $option3 ?>
              <?php
              $query=mysqli_query($con,"select * from tbl_kelasmapel, tbl_kelas, tbl_mapel where tbl_kelasmapel.kd_kelas=tbl_kelas.kd_kelas and tbl_kelasmapel.kd_mapel=tbl_mapel.kd_mapel and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.nip='$_SESSION[nipguru]' group by tbl_kelas.kd_kelas ");

                // tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_mapel.nip='$_SESSION[nipguru]'
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
              $query=mysqli_query($con,"select * from tbl_mapel,tbl_pelajaran where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and nip='$_SESSION[nipguru]'");
              while($datapel=mysqli_fetch_array($query)){
                ?>
                <option value="<?= $datapel['kd_mapel'] ?>"><?= $datapel['namapel'] ?></option>
              <?php }  ?>
            </select>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Data Nilai Akademik Siswa</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" name="form3">
          <table class="table">
            <tr>
              <td>Tahun Ajaran</td>
              <td>:</td>
              <td><?= @$_GET['tahunajaran'] ?></td>

              <td>Semester</td>
              <td>:</td>
              <td><?= @$_GET['semester'] ?></td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td><?= @$qk['kelas'] ?></td>
              <td>Mata Pelajaran</td>
              <td>:</td>
              <td><?= @$qm['namapel'] ?></td>
            </tr>
            <tr>
              <td colspan="6" class="text-center"><button type="submit" <?= $dis1 ?> class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button></td>
            </tr>
          </table>

          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Pilih</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nilai Pengetahuan</th>
                <th>Keterangan Keterampilan</th>
                <th>Nilai Keterampilan</th>
                <th>Keterangan Keterampilan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel))

              {
                $qkel=mysqli_query($con,"SELECT * FROM tbl_nilai where nis='$dakel[nis]' and kd_mapel='$_GET[mapel]'");
                $cokel=mysqli_num_rows($qkel);
                if($cokel!='0'){$read='';
                $cekkel=mysqli_fetch_array($qkel);
                $f1=$cekkel['nilai'];
                $f2=$cekkel['keterangan'];
                $f3=$cekkel['id_nilai'];
              } 
              else {$read='disabled';
              $f1='';$f2='';$f3='';
            }
            $no++;
            ?>
            <tr>

              <td><input type='radio' required class='form-check' name='siswa' <?= $read ?> value='<?= $dakel["nis"] ?>'>
                <input type="hidden" name="kd_kelas" value="<?= $_GET['kd_kelas'] ?>">
                <input type="hidden" name="kd_mapel" value="<?= $_GET['mapel'] ?>">
              </td>
              <td><?= $dakel['nis'] ?></td>
              <td><?= $dakel['nama'] ?></td>
              <td><input type="number" class="form-control" name="nilai" value="<?= $f1 ?>" <?= $read ?>></td>
              <td><textarea class="form-control" name="keterangan" <?= $read ?>><?= $f2 ?></textarea></td>

              <td><input type="number" class="form-control" name="nilai1" value="<?= $f1 ?>" <?= $read ?>></td>
              <td><textarea class="form-control" name="keterangan1" <?= $read ?>><?= $f2 ?></textarea></td>
              <td>
                <div class="btn-group">
                 
                  <a href="?aksi=deletenilai&id_nilai=<?=$f3?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>