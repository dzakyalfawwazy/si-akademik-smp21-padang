  <?php
  if(isset($_GET['semester'])||isset($_GET['tahunajaran'])||isset($_GET['tipe'])){
    $option1="<option value='$_GET[semester]'>".$_GET['semester']."</option>";
    $option2="<option value='$_GET[tahunajaran]'>".$_GET['tahunajaran']."</option>";
    $dis="";
  }
  else {
    $option1="<option value='' hidden>Silahkan Pilih</option>";
    $option2="<option value='' hidden>Silahkan Pilih</option>";
    $dis="disabled"; $cm='';$cs='';
  }
  if(isset($_GET['tipe'])) $c="<option value='".$_GET['tipe']."'>".$_GET['tipe']."</option>"; else $c="";
  if(isset($_GET['jenisnilai'])) $jn="<option value='".$_GET['jenisnilai']."'>".$_GET['jenisnilai']."</option>"; else $jn="";
  if(isset($_GET['kd_kelas']) ||isset($_GET['mapel'])) {
    $qk=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where kd_kelas='$_GET[kd_kelas]'"));
    $qm=mysqli_fetch_array(mysqli_query($con,"select * from tbl_mapel,tbl_pelajaran where kd_mapel='$_GET[mapel]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
    $option4="<option value='$_GET[mapel]'>".$qm['namapel']."</option>";
  }

  else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";$option4="<option value='' hidden>Silahkan Pilih</option>";}
  


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
              <label class="col-md-12">Jenis Nilai</label>
              <select class="form-control" name="jenisnilai">
                <?= $jn ?>
                <option value="Pengetahuan">Pengetahuan</option>
                <option value="Keterampilan">Keterampilan</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-md-12">Kategori</label>
              <select class="form-control" name="tipe">
                <?= $c ?>
                <option value="Ulangan Harian">Ulangan Harian</option>
                <option value="MID">MID</option>
                <option value="Semester">Semester</option>
              </select>
            </div>
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
            <div class="form-group">
              <button type="submit" class="btn btn-success">Cari</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-4">
      <div class="card card-primary">

        <div class="card-body">
          <form method="get" name="form2">
            <input type="hidden" name="p" value="2">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
            <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
            <input type="hidden" name="jenisnilai" value="<?= $_GET['jenisnilai'] ?>">
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
    <div class="col-md-12">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Nilai Akademik Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="post" name="form3" action="?p=7&semester=<?= $_GET['semester'] ?>&tahunajaran=<?= $_GET['tahunajaran'] ?>&tipe=<?= $_GET['tipe'] ?>&jenisnilai=<?= $_GET['jenisnilai'] ?>&kd_kelas=<?= $_GET['kd_kelas'] ?>&mapel=<?= $_GET['mapel'] ?>">
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
            </table>
            <div class="row">
              <div class="col-md-6">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Pilih</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php @$qukel=mysqli_query($con,"SELECT * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]'");
                    $no=0;
                    while($dakel=mysqli_fetch_array($qukel))

                    {
                      $qkel=mysqli_query($con,"SELECT * FROM tbl_nilai where nis='$dakel[nis]'");
                      $cokel=mysqli_num_rows($qkel);
                      if($cokel!='0'){$read='disabled';
                      $cekkel=mysqli_fetch_array($qkel);
                      $f1=$cekkel['nilai'];
                      $f3=$cekkel['nilai'];
                    } 
                    else {$read='';
                    $f1='';$f2='';$f3='';;
                  }
                  $no++;
                  ?>
                  <tr>

                    <td><input type='radio' required class='form-check' name='siswa' value='<?= $dakel["nis"] ?>'>
                    </td>
                    <td><?= $dakel['nis'] ?></td>
                    <td><?= $dakel['nama'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <table class="table table-bordered table-striped">

                  <thead>
                    <tr>
                      <th>Nilai</th>
                      <?php
                      @$query=$con->query("SELECT * From tbl_tema where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
                      while($dakel=mysqli_fetch_array($query))
                        { ?> 
                          <th><?= $dakel['tema'] ?></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      @$query=$con->query("SELECT * From tbl_kd where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
                      $kd=0;
                      while($dakel=mysqli_fetch_array($query))
                      {
                        $kd++; ?> 
                        <tr>
                          <th><?= $dakel['kd'] ?></th>
                          <?php
                          $query1=$con->query("SELECT * From tbl_tema where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
                          $tema=0;
                          while($dakel1=mysqli_fetch_array($query1))
                            { $tema++; ?>
                              <td>
                                <input type="number" name="<?php echo $kd.$tema; ?>" class="form-control" value="0">
                              </td>
                            <?php   } 
                            ?>
                          </tr>
                          <?php 
                        } 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" <?= $dis1 ?> class="btn btn-primary" name="simpan">Proses Nilai <i class="fas fa-angle-right"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kategori</th>
                      <th>Jenis Nilai</th>
                      <th>KD</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php @$qukel=mysqli_query($con,"
                      SELECT * from tbl_nilai, tbl_kd, tbl_mapel, tbl_pelajaran, tbl_kelas, tbl_siswa 
                      where tbl_nilai.id_kd=tbl_kd.id_kd
                      and tbl_kd.kd_mapel=tbl_mapel.kd_mapel 
                      and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel 
                      and tbl_kelas.kd_kelas=tbl_kd.kd_kelas 
                      and tbl_siswa.nis=tbl_nilai.nis 
                      and tbl_kelas.tahunajaran='$_GET[tahunajaran]' 
                      and tbl_kd.tipe='$_GET[tipe]' 
                      and tbl_kelas.semester='$_GET[semester]' 
                      and tbl_kelas.kd_kelas='$_GET[kd_kelas]' 
                      and tbl_kd.kd_mapel='$_GET[mapel]'
                      ");
                    $no=0;
                    while($dakel=mysqli_fetch_array($qukel))

                    {
                      ?> 
                      <tr>
                        <td><?= $dakel['nis'] ?></td>
                        <td><?= $dakel['nama'] ?></td>
                        <td><?= $dakel['tipe'] ?></td>
                        <td><?= $dakel['jenis'] ?></td>
                        <td><?= $dakel['kd'] ?></td>
                        <td><?= $dakel['nilai'] ?></td>
                        <td>
                          <div class="btn-group">
                  <?php /*
                  <a href="?p=21&semester=<?= $dakel['semester'] ?>&tahunajaran=<?= $dakel['tahunajaran'] ?>&kd_kelas=<?=$dakel['kd_kelas']?>&mapel=<?= $_GET['mapel'] ?>&idnilai=<?= $f3 ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  */?>
                  <a href="deleteguru.php?aksi=deletenilai&id=<?= $dakel['id_nilai'] ?>&semester=<?= $_GET['semester'] ?>&tahunajaran=<?= $_GET['tahunajaran'] ?>&tipe=<?= $_GET['tipe'] ?>&jenisnilai=<?= $_GET['jenisnilai'] ?>&kd_kelas=<?= $_GET['kd_kelas'] ?>&mapel=<?= $_GET['mapel'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                </div>
              </td>
            <?php        } ?>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</form>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>