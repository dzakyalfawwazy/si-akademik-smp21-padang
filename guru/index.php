<?php
session_start();
if(isset($_SESSION)){
  if(@$_SESSION['statusguru']=='OK'){}
    else { 
  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}
}
else 
{  echo "<script>window.alert('Silahkan Login Dulu');window.location.href='login.php';</script>";}

include 'template/header.php'; ?>
<?php include 'template/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Guru</li>
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
            <h3 class="card-title"></h3>

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
              if($_GET['p']=='1') include 'content/datamatapelajaran.php';
              else if($_GET['p']=='2') include 'content/nilaisiswa.php';
              else if($_GET['p']=='21') include 'content/edit/editnilaisiswa.php';
              else if($_GET['p']=='3' && $guru['jenispegawai']=='Guru Kelas') include 'content/nilailainsiswa.php';
              else if($_GET['p']=='4' && $guru['jenispegawai']=='Guru Kelas') include 'content/cetakrekapnilai.php';
              else if($_GET['p']=='41' && $guru['jenispegawai']=='Guru Kelas') include 'content/smsnilai.php';
              else if($_GET['p']=='0') include 'content/profil.php';
              else if($_GET['p']=='5') include 'content/tema.php';
              else if($_GET['p']=='6') include 'content/kd.php';
              else if($_GET['p']=='7') include 'content/prosesnilai.php';
              else if($_GET['p']=='8') include 'content/tampilnilai.php';
              else if($_GET['p']=='9') include 'content/lihatnilaisiswa.php';
              else if($_GET['p']=='10') include 'content/materi.php';
              else if($_GET['p']=='11') include 'content/tugas.php';
              else if($_GET['p']=='12') include 'content/tugassiswa.php';
              else if($_GET['p']=='13') include 'content/nilaitugas.php';
            }
            else { include 'content/main.php';}
          }
            else { include 'content/main.php';}
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