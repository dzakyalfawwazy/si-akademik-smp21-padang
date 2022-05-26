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

if (isset($_POST['simpan'])) {
  $qu1=mysqli_query($con,"INSERT INTO `tbl_rapor` VALUES (NULL,'$_GET[kd_kelas]','$_GET[mapel]','$_GET[siswa]','$_GET[jenisnilai]','$_POST[nilai]','$_POST[keterangan]')") or die(mysqli_error($con));
if($qu1){
  echo "<script>window.alert('Berhasil memasukan nilai ke rapor!');window.location.href='?p=8'</script>";
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
          <input type="hidden" name="p" value="8">

          <div class="form-group">
            <label class="col-md-12">Jenis Nilai</label>
            <select class="form-control" name="jenisnilai">
              <?= $jn ?>
              <option value="Pengetahuan">Pengetahuan</option>
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
        <h3 class="card-title text-green text-bold">Data Nilai Rapor</h3>
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
                  <td colspan="6" class="text-center"><button type="submit" <?= $dis1 ?> class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Nilai</button></td>
                </tr>
              </table>
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
</div>
</div>

<div class="col-md-12">
  <form method="post">
  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-md-7">
         <?php 
        @ $kd=$con->query("SELECT * FROM tbl_kd
          where kd_mapel='$_GET[mapel]' 
          and kd_kelas='$_GET[kd_kelas]' group by kd_mapel,kd");
          ?>

          <div class="card">
            <div class="card-header">
              <div class="text-bold">Nilai</div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>KD</th>
                    <th>Nilai Ulangan Harian</th>
                    <th>Nilai MID</th>
                    <th>Nilai Akhir Semester</th>
                    <th>Nilai KD</th>
                    <th>Rata-rata</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  while($row=$kd->fetch_array()){
                    $n_ulangan=$con->query("SELECT * from tbl_nilai,tbl_kd 
                      where tbl_nilai.nis='$_GET[siswa]'
                      and tbl_nilai.jenis='$_GET[jenisnilai]' 
                      and tbl_kd.tipe='Ulangan Harian' 
                      and tbl_nilai.id_kd=tbl_kd.id_kd
                      and tbl_kd.kd='$row[kd]'
                      ")->fetch_array();
                    $n_mid=$con->query("SELECT * from tbl_nilai,tbl_kd 
                      where tbl_nilai.nis='$_GET[siswa]'
                      and tbl_nilai.jenis='$_GET[jenisnilai]' 
                      and tbl_kd.tipe='MID' 
                      and tbl_nilai.id_kd=tbl_kd.id_kd
                      and tbl_kd.kd='$row[kd]'
                      ")->fetch_array();
                    $n_semester=$con->query("SELECT * from tbl_nilai,tbl_kd 
                      where tbl_nilai.nis='$_GET[siswa]'
                      and tbl_nilai.jenis='$_GET[jenisnilai]' 
                      and tbl_kd.tipe='Semester' 
                      and tbl_nilai.id_kd=tbl_kd.id_kd
                      and tbl_kd.kd='$row[kd]'
                      ")->fetch_array(); ?>
                      <tr>
                        <td><?= $row['kd']?></td>
                        <td><?= $n_ulangan['nilai']?></td>
                        <td><?= $n_mid['nilai']?></td>
                        <td><?= $n_semester['nilai']?></td>
                        <td><?php $jnilai=$n_ulangan['nilai']+$n_mid['nilai']+$n_semester['nilai'];
                        echo $jnilai;
                        $rata=$jnilai/3;
                        $jumlah[]=$rata;
                         ?></td>
                         <td><?= number_format($rata,2) ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="5">Jumlah</th>
                      <th><?php
                      $count=$kd->num_rows;
                       echo number_format(array_sum($jumlah)/$count,2);?>
                         <input type="hidden" name="nilai" value="<?php echo number_format(array_sum($jumlah)/$count,2);?>">
                       </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            </div>

            <div class="col-md-5">

                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan"></textarea>
                </div>
                <div class="form-group text-center">
                 <button type="submit" name="simpan" class="btn btn-success"><i class="fas fa-save"></i> Simpan Ke Rapor</button>
               </div>
             </div>
           </div>
         </div>
       </div>
     </form>
     </div>
