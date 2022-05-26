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