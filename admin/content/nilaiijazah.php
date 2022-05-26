<?php

$dis="";
$dis1="";

if (isset($_POST['kirim'])) {
  mysqli_query($con,"INSERT INTO tbl_nilaiijazah values(NULL,'$_POST[nis]','$_POST[mapel]','$_POST[nilai]','$_POST[nilai2]')");
  echo "<meta http-equiv=refresh content=0;url=index.php?p=17&siswa=".$_POST['nis'].">";
}
?>
<!-- general form elements -->
<!-- form start -->
<div class="row">
  <div class="col-md-5">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">List Data Alumni</h3>
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
            <input type="hidden" name="p" value="17">
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_siswa where noijazah !='-'");
              while($dakel=mysqli_fetch_array($qukel)){
                ?>
                <tr>
                  <td><input type='radio' required class='form-check' onclick="submit()" name='siswa' value='<?= $dakel["nis"] ?>'></td>
                  <td><?= $dakel['nis'] ?></td>
                  <td><?= $dakel['nama'] ?></td>
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
        <h3 class="card-title">Input Data Nilai</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      </div>
      <?php @$dsiswa=mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nis='$_GET[siswa]'")) ?>
      <!-- /.card-body -->
      <form method="post" name="form1">
        <table class="table">
          <tr>
            <td>NIS</td>
            <td>:</td>
            <td width="70%"><input type="text" readonly name="nis" required class="form-control" value="<?= $dsiswa['nis']?>"></td>
          </tr>
          <tr>
            <td>Mata Pelajaran</td>
            <td>:</td>
            <td>
              <select name="mapel" class="form-control" required>
                <option value="" hidden>Pilih Satu</option>
                <?php $pel=mysqli_query($con,"SELECT * from tbl_ijazah, tbl_pelajaran where tbl_ijazah.kd_pel=tbl_pelajaran.kd_pel and tbl_ijazah.bagian <> 'SKHU'");
                while($rpel=mysqli_fetch_array($pel)){ ?>
                  <option value="<?= $rpel['id_ija'] ?>"><?= $rpel['namapel'] ?>(<?= $rpel['bagian'] ?>)</option>
                <?php }?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Nilai Praktik</td>
            <td>:</td>
            <td width="70%"><input type="text" name="nilai" required class="form-control"></td>
          </tr>
          <tr>
            <td>Nilai Tulis</td>
            <td>:</td>
            <td width="70%"><input type="text" name="nilai2" required class="form-control"></td>
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
        <h3 class="card-title">Data Nilai Ijazah</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table id="example3" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NISN</th>
              <th>Nama Siswa</th>
              <th>Mata Pelajaran</th>
              <th>Nilai Praktik</th>
              <th>Nilai Tulis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php @$qukel=mysqli_query($con,"SELECT * from tbl_siswa,tbl_ijazah, tbl_nilaiijazah,tbl_pelajaran where tbl_siswa.nisn !='-' and tbl_ijazah.id_ija=tbl_nilaiijazah.id_ija and tbl_siswa.nis=tbl_nilaiijazah.nis and tbl_ijazah.kd_pel=tbl_pelajaran.kd_pel  and tbl_ijazah.bagian !='SKHU'");
            $no=0;
            while($dakel=mysqli_fetch_array($qukel)){
              $no++;
              ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nisn'] ?></td>
                <td><?= $dakel['nama'] ?></td>
                <td><?= $dakel['namapel'] ?><?= $dakel['bagian'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
                <td><?= $dakel['nilai2'] ?></td>
                <td>
                  <div class="btn-group">
                    <a href="deleteadmin.php?tipe=deletenija&id=<?= $dakel['id_nija']?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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