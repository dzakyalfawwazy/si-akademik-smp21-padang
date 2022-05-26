<?php

  $now=date('Y');
if (isset($_POST['ubah'])) {
  $q1=mysqli_query($con,"UPDATE `tbl_siswa` SET `nama`='$_POST[nama]',`nik`='$_POST[nik]',`jenkel`='$_POST[jenkel]',`nisn`='$_POST[nisn]',`tmpt_lahir`='$_POST[tmptlahir]',`tgl_lahir`='$_POST[tgllahir]',`agama`='$_POST[agama]',`kebutuhan`='$_POST[kbthn]',`alamat`='$_POST[alamat]',`kodepos`='$_POST[kodepos]',`jnttingal`='$_POST[jnstinggal]',`alattransportasi`='$_POST[alattransportasi]',`notelp`='$_POST[telp]',`nohp`='$_POST[nohp]',`email`='$_POST[email]',`terimakps`='$_POST[terimakps]',`namaayah`='$_POST[namaayah]',`tgllhr_ayah`='$_POST[tglayah]',`pd_ayah`='$_POST[pdayah]',`pekerjaanayah`='$_POST[pekerjaanayah]',`phs_ayah`='$_POST[phsayah]',`namaibu`='$_POST[namaibu]',`tgllhr_ibu`='$_POST[tglibu]',`pd_ibu`='$_POST[pdibu]',`pekerjaanibu`='$_POST[pekerjaanibu]',`phs_ibu`='$_POST[phsibu]',`namawali`='$_POST[namawali]',`tgllhr_wali`='$_POST[tglwali]',`pekerjaanwali`='$_POST[pekerjaanwali]',`pd_wali`='$_POST[pdwali]',`phs_wali`='$_POST[phswali]' where `nis`='$_POST[nis]'");
   // echo "<meta http-equiv=refresh content=1>";
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
            <form method="post">
              <table class="table">
                <tr>
                  <td>NIS</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" readonly value="<?= $dsiswa['nis'] ?>"></td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?= $dsiswa['nik'] ?>"></td>
                </tr>
                <tr>
                  <td>Nama Siswa</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" value="<?= $dsiswa['nama'] ?>"></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>
                    <div class="form-inline">
                      <?php if($dsiswa['jenkel']=='Laki-laki') $jkl='Checked'; else $jkl=''; ?>
                      <?php if($dsiswa['jenkel']=='Perempuan') $jkp='Checked'; else $jkp=''; ?>
                      <input type="radio" class="form-check" id="laki-laki" <?= $jkl ?> value="Laki-laki" name="jenkel"><label for="laki-laki"> Laki-laki</label> &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" class="form-check" id="perempuan" <?= $jkp ?> value="Perempuan" name="jenkel"><label for="perempuan"> Perempuan</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>NISN</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan NISN"  value="<?= $dsiswa['nisn'] ?>"></td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="tmptlahir" name="tmptlahir" placeholder="Masukan Tempat Lahir" value="<?= $dsiswa['tmpt_lahir'] ?>"></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>:</td>
                  <td><input type="date" class="form-control" id="tgllahir" name="tgllahir" placeholder="" value="<?= date('Y-m-d',strtotime($dsiswa['tgl_lahir']))?>"></td>
                </tr>
                <tr>
                  <td>Agama</td>
                  <td>:</td>
                  <td>
                    <select class="form-control" id="agama" name="agama">
                      <option  value="<?= $dsiswa['agama'] ?>"><?= $dsiswa['agama'] ?></option>
                      <option value="Islam">Islam</option>
                      <option value="Protestan">Protestan</option>
                      <option value="Khatolik">Khatolik</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Hindu">Hindu</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Kebutuhan Khusus</td>
                  <td>:</td>
                  <td>
                    <?php if($dsiswa['kebutuhan']=='Ya')$kbthny='Checked';else $kbthny='' ?>
                    <?php if($dsiswa['kebutuhan']=='Tidak')$kbthnt='Checked';else $kbthnt='' ?>
                    <div class="form-inline">
                      <input type="radio" class="form-check" <?= $kbthny ?> id="kbthnya" name="kbthn" value="Ya" placeholder="">
                      <label for="kbthnya">Ya</label>
                      <input type="radio" class="form-check" <?= $kbthnt ?> id="kbthntidak" name="kbthn" value="Tidak" placeholder="">
                      <label for="kbthntidak">Tidak</label>
                    </div></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td> <textarea class="form-control" id="alamat" name="alamat"><?= $dsiswa['alamat'] ?></textarea></td>
                  </tr>
                  <tr>
                    <td>Kode Pos</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Masukan Kode Pos"  value="<?= $dsiswa['kodepos'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Jenis Tinggal</td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="jnstinggal" name="jnstinggal">
                        <option value="<?= $dsiswa['jnttingal'] ?>"><?= $dsiswa['jnttingal'] ?></option>
                        <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                        <option value="Bersama Wali">Bersama Wali</option>
                        <option value="Tinggal Sendiri">Tinggal Sendiri</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Alat Transportasi</td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="alattransportasi" name="alattransportasi">
                        <option value="<?= $dsiswa['alattransportasi'] ?>"><?= $dsiswa['alattransportasi'] ?></option>
                        <option value="Angkutan Umum">Angkutan Umum</option>
                        <option value="Jalan Kaki">Jalan Kaki</option>
                        <option value="Sepeda Motor">Sepeda Motor</option>
                        <option value="Mobil">Mobil</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td> <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukan Nomor Telepon" value="<?= $dsiswa['notelp'] ?>"></td>
                  </tr>
                  <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td> <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukan No. HP"  value="<?= $dsiswa['nohp'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" value="<?= $dsiswa['email'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Terima KPS</td>
                    <td>:</td>
                    <td>
                      <?php if($dsiswa['terimakps']=='Ya')$kpsy='Checked';else $kpsy='' ?>
                      <?php if($dsiswa['terimakps']=='Tidak')$kpst='Checked';else $kpst='' ?>
                      <div class="form-inline">
                        <input type="radio" class="form-check" id="terimakpsya" <?= $kpsy ?> name="terimakps" value="Ya" placeholder="">
                        <label for="terimakpsya">Ya</label>
                        <input type="radio" class="form-check" id="terimakpstidak" <?= $kpst ?> value="Tidak" name="terimakps" placeholder="">
                        <label for="terimakpstidak">Tidak</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    <td> <input type="text" class="form-control" id="namaayah" name="namaayah" placeholder="Masukan Nama Ayah" value="<?= $dsiswa['namaayah'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir Ayah</td>
                    <td>:</td>
                    <td>
                     <select class="form-control" id="tglayah" name="tglayah">
                      <option value="<?= $dsiswa['tgllhr_ayah'] ?>"><?= $dsiswa['tgllhr_ayah'] ?></option>
                      <?php
                      for ($a=$now; $a >= 1945 ; $a--) { 
                       echo "<option value='$a'>$a</option>";
                     }
                     ?>
                   </select>
                 </td>
               </tr>
               <tr>
                <td>Pendidikan Ayah</td>
                <td>:</td>
                <td>
                  <select class="form-control" id="pdayah" name="pdayah">
                    <option value="<?= $dsiswa['pd_ayah'] ?>"><?= $dsiswa['pd_ayah'] ?></option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                  </select></td>
                </tr>
                <tr>
                  <td>Pekerjaan Ayah</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="pekerjaanayah" name="pekerjaanayah" placeholder="Masukan Pekerjaan Ayah" value="<?= $dsiswa['phs_ayah'] ?>"></td>
                </tr>
                <tr>
                  <td>Penghasilan Ayah</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="phsayah" name="phsayah" placeholder="Masukan Penghasilan Ayah" value="<?= $dsiswa['phs_ayah'] ?>"></td>
                </tr>
                <tr>
                  <td>Nama Ibu</td>
                  <td>:</td>
                  <td><input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Masukan Nama Ibu" value="<?= $dsiswa['namaibu'] ?>"></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir Ibu</td>
                  <td>:</td>
                  <td>
                     <select class="form-control" id="tglibu" name="tglibu">
                      <option value="<?= $dsiswa['tgllhr_ibu'] ?>"><?= $dsiswa['tgllhr_ibu'] ?></option>
                      <?php
                      for ($a=$now; $a >= 1945 ; $a--) { 
                       echo "<option value='$a'>$a</option>";
                     }
                     ?>
                   </select></td>
                </tr>
                <tr>
                  <td>Pendidikan Ibu</td>
                  <td>:</td>
                  <td>
                    <select class="form-control" id="pdibu" name="pdibu">
                      <option value="<?= $dsiswa['phs_ibu'] ?>"><?= $dsiswa['phs_ibu'] ?></option>
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA">SMA</option>
                      <option value="S1">S1</option>
                      <option value="S2">S2</option>
                      <option value="S3">S3</option>
                      <option value="Tidak Ada">Tidak Ada</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Ibu</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="pekerjaanibu" name="pekerjaanibu" placeholder="" value="<?= $dsiswa['pekerjaanibu'] ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Penghasilan Ibu</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="phsibu" name="phsibu" placeholder="" value="<?= $dsiswa['phs_ibu'] ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Wali</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="namawali" name="namawali" placeholder="Masukan Nama Wali" value="<?= $dsiswa['namawali'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir Wali</td>
                    <td>:</td>
                    <td><input type="date" class="form-control" id="tglwali" name="tglwali" placeholder="" value="<?= date('Y-m-d',strtotime($dsiswa['tgllhr_wali'])) ?>"></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Wali</td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="pdwali" name="pdwali">
                        <option value="<?= $dsiswa['pd_wali'] ?>"><?= $dsiswa['pd_wali'] ?></option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Wali</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="pekerjaanwali" name="pekerjaanwali" placeholder="Masukan pekerjaanwali Wali" value="<?= $dsiswa['pekerjaanwali'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Penghasilan Wali</td>
                    <td>:</td>
                    <td><input type="text" class="form-control" id="phswali" name="phswali" placeholder="Masukan Penghasilan Wali" value="<?= $dsiswa['phs_wali'] ?>"></td>
                  </tr>
                  <tr>
                    <td colspan="3"><input type="submit" name="ubah" value="Update" class="btn btn-primary"></td>
                  </tr>
                </table>
              </form>
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

            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>