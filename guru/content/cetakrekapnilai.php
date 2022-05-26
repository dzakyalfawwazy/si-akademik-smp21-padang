  <?php
  if(isset($_GET['semester'])||isset($_GET['tahunajaran'])||isset($_GET['tipe'])){
    $option1="<option value='$_GET[semester]'>".$_GET['semester']."</option>";
    $option2="<option value='$_GET[tahunajaran]'>".$_GET['tahunajaran']."</option>";
    $dis="";
       if(@$_GET['tipe']=='K13') $cm='checked'; else $cm='';
    if(@$_GET['tipe']=='KTSP') $cs='checked'; else $cs='';
  }
  else {
    $option1="<option value='' hidden>Silahkan Pilih</option>";
    $option2="<option value='' hidden>Silahkan Pilih</option>";
    $dis="disabled"; $cm='';$cs='';
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
   $qu1=mysqli_query($con,"INSERT INTO `tbl_nilai` (`id_nilai`, `kd_kelas`, `kd_mapel`, `nis`, `tipe`, `jenis`, `nilai`, `keterangan`) VALUES (NULL,'$_POST[kd_kelas]','$_POST[kd_mapel]','$_POST[siswa]','Pengetahuan','$_GET[tipe]',$_POST[nilai]','$_POST[keterangan]')");
   $qu2=mysqli_query($con,"INSERT INTO `tbl_nilai` ((`id_nilai`, `kd_kelas`, `kd_mapel`, `nis`, `tipe`, `jenis`, `nilai`, `keterangan`) VALUES (NULL,'$_POST[kd_kelas]','$_POST[kd_mapel]','$_POST[siswa]','Keterampilan','$_GET[tipe]','$_POST[nilai1]','$_POST[keterangan1]')");
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
          <input type="hidden" name="p" value="4">
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
              <div class="form-row">
                <label class="col-md-12">Pilih</label>
              <div class="form-inline col-md-6">
                <label>
                <input type="radio" onchange="submit()" checked class="form-check" <?= $cm ?> name="tipe" value="K13">K13</label>
              </div>
              <div class="form-inline col-md-6">
                <!-- <label>
                <input type="radio" class="form-check" onchange="submit()" <?= $cs ?> name="tipe" value="KTSP">KTSP</label> -->
              </div>
              </div>
            </div>
        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-5">
    <form method="get" name="form2">
      <input type="hidden" name="p" value="4">
      <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
      <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
      <input type="hidden" name="tipe" value="<?= $_GET['tipe'] ?>">
      <div class="card card-primary">
        <div class="card-body">
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
            <a href="cetakrekapnilai.php?tahunajaran=<?=$_GET['tahunajaran']?>&semester=<?=$_GET['semester']?>&tipe=<?=$_GET['tipe']?>" <?= $dis1 ?> class="btn btn-primary" target='_blank' name="simpan"><i class="fas fa-print"></i>Lihat Rekap</a><a href="?p=41&tahunajaran=<?=$_GET['tahunajaran']?>&semester=<?=$_GET['semester']?>&tipe=<?=$_GET['tipe']?>" <?= $dis1 ?> class="btn btn-primary" target='_blank' name="simpan"><i class="fas fa-print"></i>Lihat Rekap Nilai SMS</a>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </form>
  </div>
</div>