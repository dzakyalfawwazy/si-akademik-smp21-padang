 <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Data User</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
        <?php @$qukel=mysqli_query($con,"SELECT * FROM tbl_user");
        $no=0;
        while($dakel=mysqli_fetch_array($qukel)){
          $no++;
          ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $dakel['no'] ?></td>
            <td><?= $dakel['level'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>