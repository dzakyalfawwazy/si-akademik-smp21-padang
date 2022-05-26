  <?php

  $dis="";
  $dis1="";

  if (isset($_POST['kirim'])) {
  mysqli_query($con,"UPDATE tbl_siswa SET noijazah='$_POST[nisn]' where nis='$_POST[nis]'");
   echo "<meta http-equiv=refresh content=0>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-5">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">List Data Siswa</h3>
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
              <input type="hidden" name="p" value="14">
              <tbody>
                <?php $qukel=mysqli_query($con,"select * from tbl_siswa where noijazah ='-' or noijazah = ' ' or noijazah = NULL ");
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
          <h3 class="card-title">Input Data Alumni</h3>
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
              <td width="70%"><input type="text" readonly name="nis" class="form-control" value="<?= $dsiswa['nis']?>"></td>
            </tr>
            <tr>
              <td>Nama Siswa</td>
              <td>:</td>
              <td><input type="text" name="namaguru" readonly class="form-control" value="<?= $dsiswa['nama']?>"></td>
            </tr>
            <tr>
              <td>No Ijazah</td>
              <td>:</td>
              <td><input type="text" name="nisn" class="form-control" placeholder="Masukan noijazah"></td>
            </tr>
          </table>
          <div class="card-footer">
            <button type="submit" name="kirim" <?= $dis1 ?> class="btn btn-primary toastsDefaultSuccess">Simpan sebagai Alumni</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-12">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Alumni</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>No. Ijazah</th>
                <th>Nama Siswa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php @$qukel=mysqli_query($con,"select * from tbl_siswa where noijazah !='-' || noijazah  <> NULL ");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $dakel['nisn'] ?></td>
                  <td><?= $dakel['noijazah'] ?></td>
                  <td><?= $dakel['nama'] ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="deleteadmin.php?tipe=deletealumni&nis=<?= $dakel['nis']?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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