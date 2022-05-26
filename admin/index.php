<?php
session_start();
if(isset($_SESSION)){
  if(@$_SESSION['statusadmin']=='OK'){}
    else { 
  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
}
else 
{  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}

 include 'template/header.php'; ?>

<?php include 'template/sidebar.php'; ?>
<?php 
          if(isset($_GET))
          {
            if (isset($_GET['p']))
            {
              if($_GET['p']=='1') {$title='Data Siswa';}
              else if($_GET['p']=='2') {$title='Data Guru';}
              else if($_GET['p']=='3') {$title='Data Mata Pelajaran yang diampu oleh Guru';}
              else if($_GET['p']=='4') {$title='Data Kelas dan Wali Kelas';}
              else if($_GET['p']=='41') {$title='Edit Data Kelas dan Wali Kelas';}
              else if($_GET['p']=='5') {$title='Data Jenis Pelajaran';}
              else if($_GET['p']=='51') {$title='Edit Data Jenis Pelajaran';}
              else if($_GET['p']=='6') {$title='Data Pelajaran pada Setiap Kelas';}
              else if($_GET['p']=='61') {$title='Edit Data Pelajaran pada Setiap Kelas';}
              else if($_GET['p']=='7') {$title='Data Siswa pada Kelas';}
              else if($_GET['p']=='8') {$title='Data User';}
              else if($_GET['p']=='9') {$title='Data Siswa';}
              else if($_GET['p']=='10') {$title='Data Guru';}
              else if($_GET['p']=='11') {$title='Edit Guru';}
              else if($_GET['p']=='12') {$title='Edit Siswa';}
              else if($_GET['p']=='13') {$title='Edit Mata Pelajaran yang diampu oleh Guru';}
              else if($_GET['p']=='14') {$title='Data Alumni';}
              else if($_GET['p']=='15') {$title='Kepala Sekolah';}
              else if($_GET['p']=='16') {$title='Mata Pelajaran Ijazah';}
              else if($_GET['p']=='17') {$title='Nilai Ijazah';}
              else if($_GET['p']=='18') {$title='Nilai SKHU';}
            }
            else {$title='Dashboard';}
          }
            else {$title='Dashboard';}
            ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.card -->

        <!-- /.row -->

<!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Menu</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <?php 
          if(isset($_GET))
          {
            if (isset($_GET['p']))
            {
              if($_GET['p']=='1') {include 'content/inputsiswa.php';}
              else if($_GET['p']=='2') {include 'content/inputguru.php';}
              else if($_GET['p']=='3') {include 'content/inputmapel.php';}
              else if($_GET['p']=='4') {include 'content/inputkelas.php';}
              else if($_GET['p']=='41') {include 'content/edit/editkelas.php';}
              else if($_GET['p']=='5') {include 'content/inputpel.php';}
              else if($_GET['p']=='51') {include 'content/edit/editpel.php';}
              else if($_GET['p']=='6') {include 'content/inputkelaspel.php';}
              else if($_GET['p']=='61') {include 'content/edit/editkelaspel.php';}
              else if($_GET['p']=='7') {include 'content/inputkelassiswa.php';}
              else if($_GET['p']=='8') {include 'content/user.php';}
              else if($_GET['p']=='9') {include 'content/previewsiswa.php';$title='Data Siswa';}
              else if($_GET['p']=='10') {include 'content/previewguru.php';$title='Data Guru';}
              else if($_GET['p']=='11') {include 'content/edit/editguru.php';}
              else if($_GET['p']=='12') {include 'content/edit/editsiswa.php';}
              else if($_GET['p']=='13') {include 'content/edit/editmapel.php';}
              else if($_GET['p']=='14') {include 'content/dataalumni.php';}
              else if($_GET['p']=='15') {include 'content/inputkepsek.php';}
              else if($_GET['p']=='16') {include 'content/ijazah.php';}
              else if($_GET['p']=='17') {include 'content/nilaiijazah.php';}
              else if($_GET['p']=='18') {include 'content/nilaiskhu.php';}
            }
            else { include 'content/main.php';$title='Menu';}
          }
            else { include 'content/main.php';$title='Menu';}
            ?>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php include 'template/footer.php'; ?>