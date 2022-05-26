  <?php
  if (isset($_POST['kirim'])) {
    $qg=mysqli_query($con,"select * from tbl_pelajaran where tipeguru='Guru Kelas'");
    while($mp=mysqli_fetch_array($qg)){

      $data=mysqli_fetch_array(mysqli_query($con,"select max(kd_mapel) as maxcode from tbl_mapel"));
      $kdmapel=$data['maxcode'];
      $nourut=(int)substr($kdmapel, 3,3);
      $nourut++;
      $char="MG-";
      $kdmapel=$char.sprintf("%03s",$nourut);
      $qmp=mysqli_query($con,"INSERT INTO `tbl_mapel`(`kd_mapel`, `semester`, `tahunajaran`, `kd_pel`, `nip`) VALUES ('$kdmapel','$_POST[semester]','$_POST[tahunajaran]','$mp[kd_pel]','$_POST[nip]')");
      $qkm=mysqli_query($con,"INSERT INTO `tbl_kelasmapel`(`id`, `kd_kelas`, `kd_mapel`) VALUES (NULL,'$_POST[kodekelas]','$kdmapel')");
    }

    mysqli_query($con,"INSERT INTO `tbl_kelas`(`kd_kelas`, `kelas`, `semester`, `tahunajaran`, `nip`) VALUES ('$_POST[kodekelas]','$_POST[namakelas]','$_POST[semester]','$_POST[tahunajaran]','$_POST[nip]')");
    echo "<meta http-equiv=refresh content=1>";
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <form role="form" method="post">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Data Kelas</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kelas</th>
                  <th>Kelas</th>
                  <th>Semester</th>
                  <th>Tahun Ajaran</th>
                  <th>Nama Guru</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $qukel=mysqli_query($con,"select * from tbl_kelas, tbl_guru where tbl_kelas.nip=tbl_guru.nip");
                $no=0;
                while($dakel=mysqli_fetch_array($qukel)){
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $dakel['kd_kelas'] ?></td>
                    <td><?= $dakel['kelas'] ?></td>
                    <td><?= $dakel['semester'] ?></td>
                    <td><?= $dakel['tahunajaran'] ?></td>
                    <td><?= $dakel['namaguru'] ?></td>
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
  </form>