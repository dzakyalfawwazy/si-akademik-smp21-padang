
<div class="col-md-12">
  <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Guru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Pegawai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_guru");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nip'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                <td><?= $dakel['nik'] ?></td>
                <td><?= $dakel['jenispegawai'] ?></td>
                <td>
                    <div class="btn-group">
                      <?= "<a href='?p=10&nip=$dakel[nip]' class='btn btn-sm btn-info' title='Preview Data'><i class='fa fa-eye'></i></a>" ?>
                     
                    </div>
                  </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
  </div>
  