
  <div class="row">

<div class="col-md-12">
  <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_siswa where noijazah ='-' or noijazah =NULL");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nis'] ?></td>
                <td><?= $dakel['nama'] ?></td>
                <td><?= $dakel['namaayah'] ?></td>
                <td><?= $dakel['namaibu'] ?></td>
                  <td>
                    <div class="btn-group">
                      <?= "<a href='?p=9&nis=$dakel[nis]' class='btn btn-sm btn-info' title='Preview Data'><i class='fa fa-eye'></i></a>" ?>
                     
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
</div>