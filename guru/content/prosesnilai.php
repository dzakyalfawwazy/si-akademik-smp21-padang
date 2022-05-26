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
  
  if (isset($_POST['simpannilai'])) {
    $kd=$_POST['kd'];
    $id=$_POST['id'];
   for ($i=0; $i <count($kd) ; $i++) { 
    $qmasuk=$con->query("INSERT into tbl_nilai values(NULL,
      '$_POST[siswa]',
      '$_POST[jenisnilai]',
      '$id[$i]',
      '$kd[$i]'
    )");
 }
 if($qmasuk){
  echo "<script>window.alert('Nilai Sudah di Inputkan'); window.location.href='index.php?p=2&semester=".$_GET['semester']."&tahunajaran=".$_GET['tahunajaran']."&tipe=".$_GET['tipe']."&jenisnilai=".$_GET['jenisnilai']."&kd_kelas=".$_GET['kd_kelas']."&mapel=".$_GET['mapel']."'</script>";
 }
 }

 ?>
 <!-- general form elements -->
 <!-- form start -->
        <form method="post" name="form3">
 <div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Data Nilai Akademik Siswa</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <input type="hidden" name="p" value="7">
          <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
          <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
          <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
          <input type="hidden" name="jenisnilai" value="<?= $_GET['jenisnilai'] ?>">
          <input type="hidden" name="kd_kelas" value="<?= $_GET['kd_kelas'] ?>">
          <input type="hidden" name="mapel" value="<?= $_GET['mapel'] ?>">
          <div class="row">
            <div class="col-md-4">
             <table class="table">
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
              <tr>
                <td>Mata Pelajaran</td>
                <td>:</td>
                <td><?= @$qm['namapel'] ?></td>
              </tr>
              <tr>
                <td>Jenis Nilai</td>
                <td>:</td>
                <td><?= @$_GET['jenisnilai'] ?></td>
              </tr>
              <tr>
                <td>Tipe</td>
                <td>:</td>
                <td><?= @$_GET['tipe'] ?></td>
              </tr>
              <tr>
                <td colspan="6" class="text-center"><button type="submit" name='simpannilai' class="btn btn-primary"><i class="fas fa-save"></i> Simpan Nilai</button></td>
              </tr>
            </table>
          </div>
          <div class="col-md-8">
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Pilih</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                </tr>
              </thead>
              <tbody>
                <?php @$qukel=mysqli_query($con,"SELECT * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]' and tbl_siswa.nis='$_POST[siswa]'");
                $no=0;
                while($dakel=mysqli_fetch_array($qukel))

                {
                  $qkel=mysqli_query($con,"SELECT * FROM tbl_nilai where nis='$_POST[siswa]'");
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

                <td><input type='radio' required checked class='form-check' name='siswa' value='<?= $dakel["nis"] ?>'>
                </td>
                <td><?= $dakel['nis'] ?></td>
                <td><?= $dakel['nama'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">

      <table class="table table-bordered">

        <thead>
          <tr>
            <th>Nilai</th>
            <?php
            $query=$con->query("SELECT * From tbl_tema where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
            while($dakel=mysqli_fetch_array($query))
              { ?> 
                <th><?= $dakel['tema'] ?></th>
              <?php } ?>
              <td>Jumlah</td>
              <td>Rata-rata</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $query=$con->query("SELECT * From tbl_kd where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
            $kd=0;
            while($dakel=mysqli_fetch_array($query))
              { $kd++; ?> 
                <tr>
                  <th><?= $dakel['kd'] ?></th>
                  <?php
                  $query1=$con->query("SELECT * From tbl_tema where kd_kelas='$_GET[kd_kelas]' and tipe='$_GET[tipe]' and kd_mapel='$_GET[mapel]'");
                  $tema=0;
                  while($dakel1=mysqli_fetch_array($query1))
                  { $tema++;
                  $name=$kd.$tema;
                  if($_POST[$name]==0)${"c".$kd}[]=0; else ${"c".$kd}[]=1; ?>
                              <td>
                    <?php ${"jumlah".$kd}[]=$_POST[$name]; ?>
                                <input type="text" readonly name="<?php echo $_POST[$kd.$tema]; ?>" class="form-control" value="<?php echo $_POST[$kd.$tema]; ?>">
                              </td>
                            <?php  
                  } 
                  echo "<td>";
                  $jumlah=array_sum(${"jumlah".$kd});
                  echo $jumlah;
                  echo "</td>";
                  echo "<td>";
                  $c=array_sum(${"c".$kd});
                  echo $jumlah/$c;
                  $rata[]=$jumlah/$c;
                  echo"<input type='hidden' name='kd[]' value='".$jumlah/$c."'>";
                  echo"<input type='hidden' name='id[]' value='".$dakel['id_kd']."'>";
                  echo "</td>";
                  ?>
                </tr>
                <?php 
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</form>