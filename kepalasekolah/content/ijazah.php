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