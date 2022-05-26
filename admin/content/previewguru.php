<?php
if (isset($_POST['ubah'])) {
  $cekpass=mysqli_num_rows(mysqli_query($con,"SELECT * FROM tbl_user where password=md5('$_POST[passwordlama]') and no='$_SESSION[nipguru]'"));
  if($cekpass=='1'){
    $qpas=mysqli_query($con,"update tbl_user set password=md5('$_POST[passwordbaru]') where no='$_GET[nip]' and level='guru'");
    echo "<script>window.alert('Password Sudah Diganti')</script>";
    echo "<meta http-equiv=refresh content=1>";
  }
  else{ echo "<script>window.alert('Password Salah')</script>";}
}
?>

<?php $guru=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_guru where nip='$_GET[nip]'")) ?>
<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
          src="../img/guru/<?= $guru['foto'] ?>">
        </div>

        <h3 class="profile-username text-center"><?= $guru['namaguru'] ?></h3>

        <p class="text-muted text-center"><?= $_GET['nip'] ?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Jenis Guru</b> <a class="float-right"><?= $guru['jenispegawai'] ?></a>
          </li>
          <li class="list-group-item">
            <b>No Hp</b> <a class="float-right"><?= $guru['nohp'] ?></a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- About Me Box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tentang</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
        <p class="text-muted"><?= $guru['alamat'] ?></p>
        <hr>
        <strong><i class="fas fa-book mr-1"></i> Kode Pos</strong>
        <p class="text-muted"><?= $guru['kodepos'] ?></p>
        <hr>
        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
        <p class="text-muted"><?= $guru['email'] ?></p>
        <hr>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profil</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <table class="table">
              <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?= $guru['nip']?></td>
              </tr>
              <tr>
                <td>Nama Guru</td>
                <td>:</td>
                <td><?= $guru['namaguru']?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $guru['jenkel']?></td>
              </tr>
              <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td><?= $guru['tmpt_lahir']?>/<?= date('d-m-Y',strtotime($guru['tgl_lahir']))?></td>
              </tr>
              <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $guru['nik']?></td>
              </tr>
              <tr>
                <td>NU Pengajar dan Tenaga Kerja</td>
                <td>:</td>
                <td><?= $guru['nuptk']?></td>
              </tr>
              <tr>
                <td>Jenis Pegawai</td>
                <td>:</td>
                <td><?= $guru['jenispegawai']?></td>
              </tr>
              <tr>
                <td>Status Pegawai</td>
                <td>:</td>
                <td><?= $guru['statuspegawai']?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $guru['agama']?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $guru['alamat']?></td>
              </tr>
              <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><?= $guru['kodepos']?></td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $guru['notelp']?></td>
              </tr>
              <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><?= $guru['nohp']?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $guru['email']?></td>
              </tr>
              <tr>
                <td>SK CPNS</td>
                <td>:</td>
                <td><?= $guru['skcpns']?></td>
              </tr>
              <tr>
                <td>Tanggal PNS</td>
                <td>:</td>
                <td><?= $guru['tglpns']?></td>
              </tr>
              <tr>
                <td>SK Pengangkatan</td>
                <td>:</td>
                <td><?= $guru['skpengangkatan']?></td>
              </tr>
              <tr>
                <td>TMT</td>
                <td>:</td>
                <td><?= $guru['tmt']?></td>
              </tr>
              <tr>
                <td>Lembaga</td>
                <td>:</td>
                <td><?= $guru['lembaga']?></td>
              </tr>
              <tr>
                <td>Sumber Gaji</td>
                <td>:</td>
                <td><?= $guru['sumbergaji']?></td>
              </tr>
              <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?= $guru['namaibu']?></td>
              </tr>
              <tr>
                <td>Status Kawin</td>
                <td>:</td>
                <td><?= $guru['statuskawin']?></td>
              </tr>
              <tr>
                <td>NIP Suami/Istri</td>
                <td>:</td>
                <td><?= $guru['nipsi']?></td>
              </tr>
              <tr>
                <td>Nama Suami/Istri</td>
                <td>:</td>
                <td><?= $guru['namasi']?></td>
              </tr>
              <tr>
                <td>Pekerjaan Istri</td>
                <td>:</td>
                <td><?= $guru['pekerjaansi']?></td>
              </tr>
              <tr>
                <td>TMT PNS</td>
                <td>:</td>
                <td><?= $guru['tmtpns']?></td>
              </tr>
              <tr>
                <td>Lisensi Kelapa Sekolah</td>
                <td>:</td>
                <td><?= $guru['lisensi']?></td>
              </tr>
              <tr>
                <td>NPWP</td>
                <td>:</td>
                <td><?= $guru['npwp']?></td>
              </tr>
              <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td><?= $guru['pt']?></td>
              </tr>
              <tr>
                <td>Penugasan</td>
                <td>:</td>
                <td><?= $guru['penugasan']?></td>
              </tr>
            </table>
            <!-- /.post -->

            <!-- Post -->
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            <form class="form-horizontal" name="form" method="post">
              <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Password Lama</label>
                <div class="col-sm-8">
                  <input type="Password" class="form-control" name="passwordlama" id="inputName" placeholder="Password Lama">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputName1" class="col-sm-4 col-form-label">Password Baru</label>
                <div class="col-sm-8">
                  <input type="Password" class="form-control" name="passwordbaru" id="inputName1" placeholder="Password Baru">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputName2" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                <div class="col-sm-8">
                  <input type="Password" class="form-control"name="konfirmasipassword"  id="inputName2" placeholder="Konfirmasi Password Baru">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" name="ubah" class="btn btn-danger">Ubah Password</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>