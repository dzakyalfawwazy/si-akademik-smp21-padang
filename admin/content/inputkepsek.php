<?php  if (isset($_POST['post'])) {
  $query=$con->query("UPDATE tb_kepsek set namakepsek='$_POST[namakepsek]', nipkepsek='$_POST[nip]' where id='1';") or die(mysqli_error($con));
  if($query){
    echo"<script>window.alert('Data Kepsek Berhasil Masukan')</script>";
  }
}
$qu=$con->query("Select * from tb_kepsek where id='1'");
$row=$qu->fetch_array();
?>
<div class="row">
  <div class="col-md-4 offset-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Nama Kepala Sekolah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="namakepsek">Nama Kepala Sekolah</label>
              <input type="text" class="form-control" id="namakepsek" required name="namakepsek" value="<?= $row['namakepsek'] ?>">
            </div>
            <div class="form-group">
              <label for="nip">NIP Kepala Sekolah</label>
              <input type="text" class="form-control" id="nip" required name="nip" value="<?= $row['nipkepsek']?>">
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn btn-success" value="Kirim" name="post">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>