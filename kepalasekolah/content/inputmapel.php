  <!-- form start -->
  <div class="row">

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