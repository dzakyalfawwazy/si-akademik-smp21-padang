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
  if (isset($_POST['kirim'])) {
    mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$_POST[kodekelas]','$_GET[semester]','$_GET[tahunajaran]','$_POST[mapel]','$_POST[nip]')");
    echo "<meta http-equiv=refresh content=1>";
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
          <form method="get" name="form1" action="?p=3">
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
      <form method="post" name="form2">
        <div class="card card-primary">
          <div class="card-body">

            <div class="form-group">
              <label for="kodekelas">Kode Mata Pelajaran Guru</label>
              <?php
              $data=mysqli_fetch_array(mysqli_query($con,"select max(kd_mapel) as maxcode from tbl_mapel"));
              $kdmapel=$data['maxcode'];
              $nourut=(int)substr($kdmapel, 3,3);
              $nourut++;
              $char="MG-";
              $kdmapel=$char.sprintf("%03s",$nourut);
              ?>
              <input type="text" class="form-control" <?= $dis ?> id="kodekelas" readonly name="kodekelas" value="<?= $kdmapel ?>">
            </div>
            <div class="form-group">
              <label for="mapel">Mata Pelajaran</label>
              <div class="form-inline">
                <select class="form-control" <?= $dis ?> id="mapel" name="mapel">
                  <option value="" hidden>Silahkan Pilih</option>
                  <?php
                  $querypel=mysqli_query($con,"select * from tbl_pelajaran where tipepel='Pengetahuan dan Keterampilan'");
                  while($datapel=mysqli_fetch_array($querypel)){
                    ?>
                    <option value="<?= $datapel['kd_pel'] ?>"><?= $datapel['namapel'] ?></option>
                  <?php }  ?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <a href="?p=5" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Pelajaran</a>
              </div>
            </div>
            <div class="form-group">
              <label for="nip">Nama Guru</label>
              <select class="form-control" id="nip" <?= $dis ?> name="nip">
                <option value="" hidden>Silahkan Pilih</option>
                <?php
                $query=mysqli_query($con,"select * from tbl_guru");
                while($dataguru=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?= $dataguru['nip'] ?>"><?= $dataguru['namaguru']."(".$dataguru['nip'].")" ?></option>
                <?php }  ?>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" name="kirim" <?= $dis ?> class="btn btn-primary toastsDefaultSuccess">Simpan</button>
          </div>
        </div>
      </form>
      <!-- /.card -->
    </div>
    <div class="col-md-8">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Mata Pelajaran yang diampu oleh Guru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Nama Guru</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_mapel, tbl_guru, tbl_pelajaran where tbl_mapel.nip=tbl_guru.nip and tbl_pelajaran.kd_pel=tbl_mapel.kd_pel and tbl_pelajaran.tipepel='Pengetahuan dan Keterampilan'");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['kd_mapel'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['semester'] ?></td>
                <td><?= $dakel['tahunajaran'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                  <td>
                    <div class="btn-group">
                     <a href="deleteadmin.php?tipe=deletemapel&kd_mapel=<?= $dakel['kd_mapel'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      <?php if($dakel['jenispegawai']=='Guru Kelas'){} else{ ?>
                      <a href="?p=13&kd_mapel=<?= $dakel['kd_mapel'] ?>&semester=<?= $dakel['semester'] ?>&tahunajaran=<?= $dakel['tahunajaran'] ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                   <?php }?>
                    </div>
                  </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>