<?php
error_reporting(0);
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
$datenow=date();
if (isset($_POST['simpan'])) {
  // echo "UPDATE `tbl_nilai` set nilai = '$_POST[nilai]' where id_nilai='$_POST[id_nilai]'";
  $qu1=mysqli_query($con,"UPDATE `tbl_nilaitugas` set nilai = '$_POST[nilai]' where id_nilai='$_POST[id_nilai]'") or die(mysqli_error($con));
  if($qu1){
    echo "<script>window.alert('Berhasil memasukan nilai ke rapor!');window.location.href='?p=12'</script>";
    echo "<meta http-equiv=refresh content=1>";
  } 
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
          <input type="hidden" name="p" value="13">

          <div class="form-group">
            <!-- <label class="col-md-12">Jenis Nilai</label> -->
            <select hidden class="form-control" name="jenisnilai">
              <?= $jn ?>
              <option value="Pengetahuan" selected>Pengetahuan</option>
              <option value="Keterampilan">Keterampilan</option>
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
            <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Cari Kelas</button>
          </div>
        </form>
      </div>
    </div>
    <div class="card card-primary">

      <div class="card-body">
        <form method="get" name="form2">
          <input type="hidden" name="p" value="8">
          <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
          <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
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
  <div class="col-md-9">

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title text-green text-bold">Data Tugas</h3>
      </div>
      <div class="card-body">
        <form method="get" name="form3">
          <input type="hidden" name="p" value="8">
          <input type="hidden" name="semester" value="<?= $_GET['semester'] ?>">
          <input type="hidden" name="tahunajaran" value="<?= $_GET['tahunajaran'] ?>">
          <input type="hidden" name="jenisnilai" value="<?= $_GET['jenisnilai'] ?>">
          <input type="hidden" name="kd_kelas" value="<?= $_GET['kd_kelas'] ?>">
          <input type="hidden" name="mapel" value="<?= $_GET['mapel'] ?>">
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <div class="form-group">
                     <?php
                      $queryq=mysqli_query($con,"select * from tbl_nilaitugas, tbl_tugas, tbl_materi,tbl_mapel,tbl_pelajaran where semester='$_GET[semester]' and tahunajaran='$_GET[tahunajaran]' and tbl_materi.kd_kelas='$_GET[kd_kelas]' and tbl_mapel.kd_pel=tbl_pelajaran.kd_pel and tbl_materi.kd_mapel=tbl_mapel.kd_mapel and tbl_nilaitugas.id_tugas=tbl_tugas.id_tugas and tbl_tugas.id_materi=tbl_materi.id_materi and tbl_nilaitugas.id_nilai='$_GET[id_nilai]'");
                      while($datamat=mysqli_fetch_array($queryq)){
                        ?>
                    <label for="tema">Materi</label>
                    <select class="form-control" id="materi" <?= $dis ?> name="materi">
                      <option disabled selected hidden></option>
                     
                        <option selected readonly value="<?= $datamat['id_materi'] ?>"><?= $datamat['judul'] ?></option>
                      
                    </select>
                    <label for="tema">Data Tugas</label>
                    <textarea class="form-control" <?= $dis ?> readonly id="tema" name="tugas" placeholder="Instruksi Tugas Siswa"><?= $datamat['tugas'] ?>
                    </textarea>
                    <?php }  ?>
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-success" <?= $dis ?> name="simpan" value="Lihat Tugas">
                  </div>
                </div>  
              </div>
            </div>
            <div class="col-md-7">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Pilih</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php @$qukel=mysqli_query($con,"SELECT * from tbl_kelassiswa, tbl_kelas, tbl_siswa where tbl_kelas.kd_kelas=tbl_kelassiswa.kd_kelas and tbl_kelassiswa.nis=tbl_siswa.nis and tbl_kelas.tahunajaran='$_GET[tahunajaran]' and tbl_kelas.semester='$_GET[semester]' and tbl_kelas.kd_kelas='$_GET[kd_kelas]' and tbl_siswa.nis='$_GET[siswa]' ");
                  $no=0;
                  while($dakel=mysqli_fetch_array($qukel))

                  {
                    $qkel=mysqli_query($con,"SELECT * FROM tbl_nilaitugas where nis='$dakel[nis]'");
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

                  <td><input type='radio' required <?php if(isset($_GET['siswa'])) {if($_GET['siswa']==$dakel['nis'])echo "checked";} else echo""; ?> class='form-check' name='siswa' value='<?= $dakel["nis"] ?>'>
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
    <div class="card-footer">

    </div>
    <!-- /.card -->
  </div>
</div>

  <form method="post">
    <div class="card">
      <div class="card-body">

        <div class="row">
           <?php 

           $kd=$con->query("SELECT * FROM tbl_nilaitugas,tbl_tugas
            where tbl_nilaitugas.id_tugas=tbl_tugas.id_tugas and tbl_nilaitugas.id_nilai='$_GET[id_nilai]' and tbl_nilaitugas.nis='$_GET[siswa]'");
           $datu=mysqli_fetch_array($kd);
            ?>
          <div class="col-md-7">

            <div class="card">
              <div class="card-header">
                <div class="text-bold">Tugas</div>
              </div>
              <div class="card-body">
                <?php 

                  echo $datu['tugas_siswa']; ?>
            </div>
          </div>
        </div>
<?php $cek=mysqli_num_rows(mysqli_query($con,"select id_tugas from tbl_nilai where nis = '$_GET[siswa]' and id_tugas is not null and nilai > 0"));
// echo $cek;
if ($cek > 0) {} else { ?>
        <div class="col-md-5">

          <div class="form-group">
            <label>Nilai</label>
            <input type="hidden" class="form-control" name="id_nilai" value="<?= $datu['id_nilai'] ?>">
            <input type="text" class="form-control" name="nilai">
          </div>
          <div class="form-group text-center">
           <button type="submit" name="simpan" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
         </div>
       </div>
       <?php } ?>
     </div>
   </div>
 </div>
</form>
</div>
</div>
