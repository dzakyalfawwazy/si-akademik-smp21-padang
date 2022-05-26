<?php

$dis="";
$dis1="";

if (isset($_POST['kirim'])) {
  mysqli_query($con,"INSERT INTO tbl_nilaiijazah values(NULL,'$_POST[nis]','$_POST[mapel]','$_POST[nilai]','-')");
  echo "<meta http-equiv=refresh content=0;url=index.php?p=18&siswa=".$_POST['nis'].">";
}
?>
<!-- general form elements -->
<!-- form start -->
<div class="row">
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
              <th>Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php @$qukel=mysqli_query($con,"SELECT * from tbl_siswa,tbl_ijazah, tbl_nilaiijazah,tbl_pelajaran where tbl_siswa.nisn !='-' and tbl_ijazah.id_ija=tbl_nilaiijazah.id_ija and tbl_siswa.nis=tbl_nilaiijazah.nis and tbl_ijazah.kd_pel=tbl_pelajaran.kd_pel and tbl_ijazah.bagian='SKHU'");
            $no=0;
            while($dakel=mysqli_fetch_array($qukel)){
              $no++;
              ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nisn'] ?></td>
                <td><?= $dakel['nama'] ?></td>
                <td><?= $dakel['namapel'] ?></td>
                <td><?= $dakel['nilai'] ?></td>
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