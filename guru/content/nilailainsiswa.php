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
    $qm=mysqli_fetch_array(mysqli_query($con,"select * from tbl_pelajaran where kd_pel='$_GET[mapel]'"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
    $option4="<option value='$_GET[mapel]'>"."(".$qm['tipepel'].")".$qm['namapel']."</option>";
  }

  else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";$option4="<option value='' hidden>Silahkan Pilih</option>";}
  
  if (isset($_POST['simpan'])) {
   $qu1=mysqli_query($con,"INSERT INTO `tbl_nilailain` (`id_nilai`, `kd_kelas`, `kd_pel`, `nis`, `keterangan`) VALUES (NULL,'$_POST[kd_kelas]','$_POST[kd_mapel]','$_POST[siswa]','$_POST[keterangan]')");
  //  echo "<meta http-equiv=refresh content=1>";
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
        <form method="get" name="form1">
          <input type="hidden" name="p" value="3">
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
    <form method="get" name="form2">
      <input type="hidden" name="p" value="3">
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
            <label for="mapel">Penilaian</label>
            <select class="form-control" id="mapel" <?= $dis ?> name="mapel" onchange="submit()">
              <?= $option4 ?>
              <?php
              $query=mysqli_query($con,"select * from tbl_pelajaran where tipepel!='Pengetahuan dan Keterampilan'");
              while($datapel=mysqli_fetch_array($query)){
                ?>
                <option value="<?= $datapel['kd_pel'] ?>"><?= "(".$datapel['tipepel'].")".$datapel['namapel'] ?></option>
              <?php }  ?>
            </select>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </form>
  </div>
  <div class="col-md-9">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Data Nilai Non-Akademik Siswa</h3>
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
              <td>Penilaian</td>
              <td>:</td>
              <td><?= @$qm['namapel'] ?></td>
            </tr>
            <tr>
              <td colspan="6" class="text-center"><button type="submit" <?= $dis1 ?> class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button></td>
            </tr>
          </table>
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Pilih (satu)</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php @$qukel=mysqli_query($con,"select * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]'");
                      $no=0;
                      while($dakel=mysqli_fetch_array($qukel))

                      {
                        $qkel=mysqli_query($con,"SELECT * FROM tbl_nilailain where nis='$dakel[nis]' and kd_pel='$_GET[mapel]'");
                        $cokel=mysqli_num_rows($qkel);
                        if($cokel!='0'){$read='disabled';
                        $cekkel=mysqli_fetch_array($qkel);
                        $f2=$cekkel['keterangan'];
                        $f3=$cekkel['id_nilai'];
                        $f4=$cekkel['kd_pel'];
                      } 
                      else {$read='';
                      $f1='';$f2='';$f3='';$f4='';
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
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="semester">Keterangan</label>
                <textarea class="form-control" name="keterangan"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php @$qukel1=mysqli_query($con,"select * from tbl_nilailain, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_nilailain.kd_kelas and tbl_nilailain.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]' and tbl_nilailain.kd_pel='$_GET[mapel]'");
                  $no=0;
                  while($dakel1=mysqli_fetch_array($qukel1))

                  {
                    $qkel=mysqli_query($con,"SELECT * FROM tbl_nilailain where nis='$dakel1[nis]' and kd_pel='$_GET[mapel]'");
                    $cokel=mysqli_num_rows($qkel);
                    if($cokel!='0'){$read1='disabled';
                    $cekkel1=mysqli_fetch_array($qkel);
                    $f21=$cekkel['keterangan'];
                    $f31=$cekkel['id_nilai'];
                    $f41=$cekkel['kd_pel'];
                  } 
                  else {$read1='';
                  $f11='';$f21='';$f31='';$f41='';
                }
                $no++;
                ?>
                <tr>
                  <td><?= $dakel1['nis'] ?></td>
                  <td><?= $dakel1['nama'] ?></td>
                  <td><?= $f21 ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="deleteguru.php?aksi=deletenilainon&idnilai=<?= $f31 ?>&semester=<?= $dakel1['semester'] ?>&tahunajaran=<?= $dakel1['tahunajaran'] ?>&kd_kelas=<?=$dakel1['kd_kelas']?>&mapel=<?=$f41?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>