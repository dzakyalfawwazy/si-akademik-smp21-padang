<?php
if (isset($_POST['ubah'])) {
  $cekpass=mysqli_num_rows(mysqli_query($con,"SELECT * FROM tbl_user where password=md5('$_POST[passwordlama]') and no='$_SESSION[nis]'"));
  if($cekpass=='1'){
    $qpas=mysqli_query($con,"update tbl_user set password=md5('$_POST[passwordbaru]') where no='$_SESSION[nis]' and level='siswa'");
    echo "<script>window.alert('Password Sudah Diganti')</script>";
    echo "<meta http-equiv=refresh content=1>";
  }
    else{ echo "<script>window.alert('Password Salah')</script>";}
}
 ?>

<?php $dsiswa=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_siswa where nis='$_GET[nis]'")) ?>
<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
          src="../admin/dist/img/user4-128x128.jpg"
          alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"><?= $dsiswa['nama'] ?></h3>

        <p class="text-muted text-center"><?= $_GET['nis'] ?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>NISN</b> <a class="float-right"><?= $dsiswa['nisn'] ?></a>
          </li>
          <li class="list-group-item">
            <b>No Hp</b> <a class="float-right"><?= $dsiswa['nohp'] ?></a>
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
        <p class="text-muted"><?= $dsiswa['alamat'] ?></p>
        <hr>
        <strong><i class="fas fa-book mr-1"></i> Kode Pos</strong>
        <p class="text-muted"><?= $dsiswa['kodepos'] ?></p>
        <hr>
        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
        <p class="text-muted"><?= $dsiswa['email'] ?></p>
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
                <td>NIS</td>
                <td>:</td>
                <td><?= $dsiswa['nis']?></td>
              </tr>
              <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td><?= $dsiswa['nama']?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $dsiswa['jenkel']?></td>
              </tr>
              <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td><?= $dsiswa['tmpt_lahir']."/".$dsiswa['tgl_lahir']?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $dsiswa['agama']?></td>
              </tr>
              <tr>
                <td>Kebutuhan Khusus</td>
                <td>:</td>
                <td><?= $dsiswa['kebutuhan']?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $dsiswa['alamat']?></td>
              </tr>
              <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><?= $dsiswa['kodepos']?></td>
              </tr>
              <tr>
                <td>Jenis Tinggal</td>
                <td>:</td>
                <td><?= $dsiswa['jnttingal']?></td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $dsiswa['notelp']?></td>
              </tr>
              <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><?= $dsiswa['nohp']?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $dsiswa['email']?></td>
              </tr>
              <tr>
                <td>Terima KPS</td>
                <td>:</td>
                <td><?= $dsiswa['terimakps']?></td>
              </tr>
              <tr>
                <td>Nama Ayah</td>
                <td>:</td>
                <td><?= $dsiswa['namaayah']?></td>
              </tr>
              <tr>
                <td>Tanggal Lahir Ayah</td>
                <td>:</td>
                <td><?= $dsiswa['tgllhr_ayah']?></td>
              </tr>
              <tr>
                <td>Pendidikan Ayah</td>
                <td>:</td>
                <td><?= $dsiswa['pd_ayah']?></td>
              </tr>
              <tr>
                <td>Penghasilan Ayah</td>
                <td>:</td>
                <td><?= $dsiswa['phs_ayah']?></td>
              </tr>
              <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?= $dsiswa['namaibu']?></td>
              </tr>
              <tr>
                <td>Tanggal Lahir Ibu</td>
                <td>:</td>
                <td><?= $dsiswa['tgllhr_ibu']?></td>
              </tr>
              <tr>
                <td>Pendidikan Ibu</td>
                <td>:</td>
                <td><?= $dsiswa['pd_ibu']?></td>
              </tr>
              <tr>
                <td>Penghasilan Ibu</td>
                <td>:</td>
                <td><?= $dsiswa['phs_ibu']?></td>
              </tr>
              <tr>
                <td>Nama Wali</td>
                <td>:</td>
                <td><?= $dsiswa['namawali']?></td>
              </tr>
              <tr>
                <td>Tanggal Lahir Wali</td>
                <td>:</td>
                <td><?= $dsiswa['tgllhr_wali']?></td>
              </tr>
              <tr>
                <td>Pendidikan Wali</td>
                <td>:</td>
                <td><?= $dsiswa['pd_wali']?></td>
              </tr>
              <tr>
                <td>Penghasilan Wali</td>
                <td>:</td>
                <td><?= $dsiswa['phs_wali']?></td>
              </tr>
            </table>
            <!-- /.post -->

            <!-- Post -->
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <div class="timeline timeline-inverse">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-danger">
                  10 Feb. 2014
                </span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-envelope bg-primary"></i>

                <div class="timeline-item">
                  <span class="time"><i class="far fa-clock"></i> 12:05</span>

                  <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                  <div class="timeline-body">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                  </div>
                  <div class="timeline-footer">
                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user bg-info"></i>

                <div class="timeline-item">
                  <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                  <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                  </h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-comments bg-warning"></i>

                <div class="timeline-item">
                  <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                  <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                  <div class="timeline-body">
                    Take me to your leader!
                    Switzerland is small and neutral!
                    We are more like Germany, ambitious and misunderstood!
                  </div>
                  <div class="timeline-footer">
                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-success">
                  3 Jan. 2014
                </span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-camera bg-purple"></i>

                <div class="timeline-item">
                  <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                  <div class="timeline-body">
                    <img src="http://placehold.it/150x100" alt="...">
                    <img src="http://placehold.it/150x100" alt="...">
                    <img src="http://placehold.it/150x100" alt="...">
                    <img src="http://placehold.it/150x100" alt="...">
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <div>
                <i class="far fa-clock bg-gray"></i>
              </div>
            </div>
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