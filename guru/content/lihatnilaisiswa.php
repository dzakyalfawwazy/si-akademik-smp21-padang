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
  if(isset($_GET['kd_kelas'])) {
    $qk=mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where kd_kelas='$_GET[kd_kelas]'"));
    $dis1='';
    $option3="<option value='$_GET[kd_kelas]'>".$qk['kelas']."</option>";
  }

  else {$dis1='disabled'; $option3="<option value='' hidden>Silahkan Pilih</option>";$option4="<option value='' hidden>Silahkan Pilih</option>";}
  
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
            <input type="hidden" name="p" value="9">
            <div class="form-group">
              <label class="col-md-12">Kategori</label>
              <select class="form-control" name="tipe">
                <?= $c ?>
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
      <div class="card card-primary">

        <div class="card-body">
          <form method="get" name="form2">
            <input type="hidden" name="p" value="9">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
            <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
            <div class="form-group">
              <label for="kd_kelas">Kelas</label>
              <select class="form-control" id="kd_kelas" <?= $dis ?> name="kd_kelas" onchange="submit()">
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
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Nilai Akademik Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="GET" name="form3">
            <input type="hidden" name="p" value="9">
            <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
            <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
            <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
            <input type="hidden" name="kd_kelas" value="<?= $_GET['kd_kelas'] ?>">
            <div class="row">
              <div class="col-md-12">
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

                    <td><input type='radio' <?php
                        if(isset($_GET['siswa'])){ if($_GET['siswa']==$dakel["nis"])$c="checked"; else $c=""; } else $c=""; echo $c;
                     ?> onchange="submit()" required class='form-check' name='siswa' value='<?= $dakel["nis"] ?>'>
                    </td>
                    <td><?= $dakel['nis'] ?></td>
                    <td><?= $dakel['nama'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>

    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Data Nilai Akademik Mata Pelajaran</h3>
      </div>
      <!-- /.card-header -->
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
            <td><?=@$qk['kelas'] ?></td>
          </tr>
        </table>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Mata Pelajaran</th>
              <th>Jenis Mata Pelajaran</th>
              <th>Nama Mata Pelajaran</th>
              <th>Nama Guru</th>
              <th>Nilai</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if(@$_GET['tipe']=='Semester'){
             @$qukel=mysqli_query($con,"select * from tbl_rapor, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran where tbl_rapor.kd_kelas=tbl_kelas.kd_kelas and tbl_guru.nip=tbl_mapel.nip and tbl_rapor.kd_mapel=tbl_mapel.kd_mapel and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and
               tbl_rapor.nis='$_GET[siswa]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.tahunajaran='$_GET[tahunajaran]'");
             $no=0;
             while($dakel=mysqli_fetch_array($qukel)){
              $no++;
              ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['kd_mapel'] ?></td>
                <td><?= $dakel['tipe'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
                <td><?= $dakel['keterangan'] ?></td>
              </tr>
            <?php } } else if(@$_GET['tipe']=='MID') { 
              
             @$qukel=mysqli_query($con,"SELECT * from 
              tbl_nilai, tbl_kd, tbl_kelas, tbl_mapel, tbl_guru, tbl_pelajaran 
              where tbl_kd.kd_kelas=tbl_kelas.kd_kelas 
              and tbl_kd.id_kd=tbl_nilai.id_kd 
              and tbl_guru.nip=tbl_mapel.nip 
              and tbl_kd.kd_mapel=tbl_mapel.kd_mapel 
              and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel 
              and tbl_nilai.nis='$_GET[siswa]' 
              and tbl_kelas.semester='$_GET[semester]' 
              and tbl_kelas.tahunajaran='$_GET[tahunajaran]' 
              and tbl_kd.tipe='$_GET[tipe]'
              and tbl_nilai.jenis='Pengetahuan' group by tbl_mapel.kd_mapel");
             $no=0;
             while($dakel=mysqli_fetch_array($qukel)){
              $no++;
              ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['kd_mapel'] ?></td>
                <td><?= $dakel['jenis'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
                <td>-</td>
              </tr>
            <?php } } ?>

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
</form>
</div>
</div>
</div>
</div>
