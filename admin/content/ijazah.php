<?php

  $dis="";
  $dis1="";

  if (isset($_POST['kirim'])) {
  mysqli_query($con,"INSERT tbl_ijazah values(NULL,'$_POST[bagian]','$_POST[kd_pel]')");
   echo "<meta http-equiv=refresh content=0>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-5">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">List Mata Pelajaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="get" name="form3">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>NIS</th>
                  <th>Nama</th>
                </tr>
              </thead>
              <input type="hidden" name="p" value="16">
              <tbody>
                <?php $qukel=mysqli_query($con,"select * from tbl_pelajaran where tbl_pelajaran.tipepel='Pengetahuan dan Keterampilan'");
                while($dakel=mysqli_fetch_array($qukel)){
                  ?>
                  <tr>
                    <td><input type='radio' required class='form-check' onclick="submit()" name='kd_pel' value='<?= $dakel["kd_pel"] ?>'></td>
                    <td><?= $dakel['kd_pel'] ?></td>
                    <td><?= $dakel['namapel'] ?></td>
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
    <div class="col-md-7">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Input Data Mata Pelajaran Ijazah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        </div>

        <?php @$dsiswa=mysqli_fetch_array(mysqli_query($con,"select * from tbl_pelajaran where kd_pel='$_GET[kd_pel]'")) ?>
        <!-- /.card-body -->
        <form method="post" name="form1">
          <table class="table">
            <tr>
              <td>Kode Mapel</td>
              <td>:</td>
              <td width="70%"><input type="text" readonly name="kd_pel" class="form-control" value="<?= $dsiswa['kd_pel']?>"></td>
            </tr>
            <tr>
              <td>Mata Pelajaran</td>
              <td>:</td>
              <td width="70%"><input type="text" readonly name="namapel" class="form-control" value="<?= $dsiswa['namapel']?>"></td>
            </tr>
            <tr>
              <td>Bagian</td>
              <td>:</td>
              <td><select name="bagian" class="form-control" required >
                <option value="" hidden>Pilih</option>
                <option value="UJIAN SEKOLAH BERSTANDAR NASIONAL">UJIAN SEKOLAH BERSTANDAR NASIONAL</option>
                <option value="UJIAN SEKOLAH">UJIAN SEKOLAH</option>
                <option value="MUATAN LOKAL">MUATAN LOKAL</option>
                <option value="SKHU">SKHU</option>
              </select></td>
            </tr>
          </table>
          <div class="card-footer">
            <button type="submit" name="kirim" <?= $dis1 ?> class="btn btn-primary toastsDefaultSuccess">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-12">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Mata Pelajaran Ijazah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Bagian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_ijazah,tbl_pelajaran where tbl_ijazah.kd_pel=tbl_pelajaran.kd_pel");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $dakel['namapel'] ?></td>
                  <td><?= $dakel['bagian'] ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="deleteadmin.php?tipe=deletepelijazah&id=<?= $dakel['id_ija']?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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