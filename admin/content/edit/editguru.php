  <?php
  if (isset($_POST['update'])) {
   $q1=mysqli_query($con,"UPDATE `tbl_guru` SET `namaguru`='$_POST[namaguru]',`jenkel`='$_POST[jenkel]',`tmpt_lahir`='$_POST[tmpt_lahir]',`tgl_lahir`='$_POST[tgl_lahir]',`nik`='$_POST[nik]',`nuptk`='$_POST[nuptk]',`jenispegawai`='$_POST[jenispegawai]',`statuspegawai`='$_POST[statuspegawai]',`agama`='$_POST[agama]',`alamat`='$_POST[alamat]',`kodepos`='$_POST[kodepos]',`notelp`='$_POST[notelp]',`nohp`='$_POST[nohp]',`email`='$_POST[email]',`skcpns`='$_POST[skcpns]',`tglpns`='$_POST[tglpns]',`skpengangkatan`='$_POST[skpengangkatan]',`tmt`='$_POST[tmt]',`lembaga`='$_POST[lembaga]',`sumbergaji`='$_POST[sumbergaji]',`namaibu`='$_POST[namaibu]',`statuskawin`='$_POST[statuskawin]',`nipsi`='$_POST[nipsi]',`namasi`='$_POST[namasi]',`pekerjaansi`='$_POST[pekerjaansi]',`tmtpns`='$_POST[tmtpns]',`lisensi`='$_POST[lisensi]',`npwp`='$_POST[npwp]',`pt`='$_POST[pt]',`penugasan`='$_POST[penugasan]' WHERE `nip`='$_POST[nip]'");
   
   echo "<meta http-equiv=refresh content=1>";
 }
 ?>

 <?php $guru=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_guru where nip='$_GET[nip]'")) ?>
<form method="post">
 <div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
          src="../img/guru/<?= $guru['foto'] ?>"
          alt="User profile picture">
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
                  <td width="70%"><input type="text" readonly name="nip" class="form-control" value="<?= $guru['nip']?>"></td>
                </tr>
                <tr>
                  <td>Nama Guru</td>
                  <td>:</td>
                  <td><input type="text" name="namaguru" class="form-control" value="<?= $guru['namaguru']?>"></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>
                    <?php
                    if($guru['jenkel']=='Laki-laki')$checkl='Checked'; else $checkl='';
                    if($guru['jenkel']=='Perempuan')$checkp='Checked'; else $checkp='';
                    ?>
                    <div class="form-inline">
                      <input type="radio" class="form-check" <?= $checkl ?> id="jenkelya" name="jenkel" value="Laki-laki" placeholder="">
                      <label for="jenkelya">Laki-laki</label>
                      <input type="radio" class="form-check" <?= $checkp ?> id="jenkeltidak" name="jenkel" value="jenkel" placeholder="">
                      <label for="jenkeltidak">Perempuan</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td>:</td>
                  <td><input type="text" name="tmpt_lahir" class="form-control" value="<?= $guru['tmpt_lahir']?>"></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>:</td>
                  <td><input type="date" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d',strtotime($guru['tgl_lahir']))?>"></td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td>:</td>
                  <td><input type="text" name="nik" class="form-control" value="<?= $guru['nik']?>"></td>
                </tr>
                <tr>
                  <td>NU Pengajar dan Tenaga Kerja</td>
                  <td>:</td>
                  <td><input type="text" name="nuptk" class="form-control" value="<?= $guru['nuptk']?>"></td>
                </tr>
                <tr>
                  <td>Jenis Pegawai</td>
                  <td>:</td>
                  <td>
                    <select type="text" class="form-control" id="jenispegawai" name="jenispegawai">
                      <option value="<?= $guru['jenispegawai']?>"><?= $guru['jenispegawai']?></option>
                      <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
                      <option value="Guru Kelas">Guru Kelas</option>
                      <option value="Tenaga Administrasi Sekolah">Tenaga Administrasi Sekolah</option>
                      <option value="Tenaga Perpustakaan">Tenaga Perpustakaan</option>
                      <option value="Kepala Sekolah">Kepala Sekolah</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Status Pegawai</td>
                  <td>:</td>
                  <td>
                    <select type="text" class="form-control" id="statuspegawai" name="statuspegawai">
                      <option value="<?= $guru['statuspegawai']?>"><?= $guru['statuspegawai']?></option>
                      <option value="PNS">PNS</option>
                      <option value="Honor daerah Tk.II Kab/Kota">Honor daerah Tk.II Kab/Kota</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Agama</td>
                  <td>:</td>
                  <td>
                    <select class="form-control" id="agama" name="agama">
                      <option value="<?= $guru['agama']?>"><?= $guru['agama']?></option>
                      <option value="Islam">Islam</option>
                      <option value="Protestan">Protestan</option>
                      <option value="Khatolik">Khatolik</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Hindu">Hindu</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><textarea name="alamat" class="form-control"><?= $guru['alamat']?></textarea></td>
                </tr>
                <tr>
                  <td>Kode Pos</td>
                  <td>:</td>
                  <td><input type="text" name="kodepos" class="form-control" value="<?= $guru['kodepos']?>"></td>
                </tr>
                <tr>
                  <td>No. Telepon</td>
                  <td>:</td>
                  <td><input type="text" name="notelp" class="form-control" value="<?= $guru['notelp']?>"></td>
                </tr>
                <tr>
                  <td>No. HP</td>
                  <td>:</td>
                  <td><input type="text" name="nohp" class="form-control" value="<?= $guru['nohp']?>"></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td><input type="email" name="email" class="form-control" value="<?= $guru['email']?>"></td>
                </tr>
                <tr>
                  <td>SK CPNS</td>
                  <td>:</td>
                  <td><input type="text" name="skcpns" class="form-control" value="<?= $guru['skcpns']?>"></td>
                </tr>
                <tr>
                  <td>Tanggal PNS</td>
                  <td>:</td>
                  <td><input type="date" name="tglpns" class="form-control" value="<?= date('Y-m-d',strtotime($guru['tglpns']))?>"></td>
                </tr>
                <tr>
                  <td>SK Pengangkatan</td>
                  <td>:</td>
                  <td><input type="text" name="skpengangkatan" class="form-control" value="<?= $guru['skpengangkatan']?>"></td>
                </tr>
                <tr>
                  <td>TMT</td>
                  <td>:</td>
                  <td><input type="date" name="tmt" class="form-control" value="<?= date('Y-m-d',strtotime($guru['tmt']))?>"></td>
                </tr>
                <tr>
                  <td>Lembaga</td>
                  <td>:</td>
                  <td>
                    <select class="form-control" id="lembaga" name="lembaga" placeholder="Masukan Lembaga Pengangkatan">
                      <option value="<?= $guru['lembaga']?>"><?= $guru['lembaga']?></option>
                      <option value="Pemerintahan Kabupaten/Kota">Pemerintahan Kabupaten/Kota</option>
                      <option value="Kepala Sekolah">Kepala Sekolah</option>
                      <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                      <option value="Pemerintah Provinsi">Pemerintah Provinsi</option>
                      <option value="Lainnya">Lainnya</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td>Sumber Gaji</td>
                    <td>:</td>
                    <td>
                      <select type="text" class="form-control" id="sumbergaji" name="sumbergaji">
                        <option value="<?= $guru['sumbergaji']?>"><?= $guru['sumbergaji']?></option>
                        <option value="APBD Kabupaten/Kota">APBD Kabupaten/Kota</option>
                        <option value="APBD Provinsi">APBD Provinsi</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td><input type="text" name="namaibu" class="form-control" value="<?= $guru['namaibu']?>"></td>
                  </tr>
                  <tr>
                    <td>Status Kawin</td>
                    <td>:</td>
                    <td>
                      <div class="form-inline">
                        <?php if($guru['statuskawin']=='Sudah')$stats='Checked';else $stats='';?>
                        <?php if($guru['statuskawin']=='Belum')$statb='Checked';else $statb='';?>
                        <input type="radio" class="form-check" id="stasuskawinya" <?= $stats ?> name="statuskawin" value="Sudah">
                        <label for="stasuskawinya">Sudah</label>
                        <input type="radio" class="form-check" id="stasuskawintidak" <?= $statb ?> name="statuskawin" value="Belum">
                        <label for="stasuskawintidak">Belum</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>NIP Suami/Istri</td>
                    <td>:</td>
                    <td><input type="text" name="nipsi" class="form-control" value="<?= $guru['nipsi']?>"></td>
                  </tr>
                  <tr>
                    <td>Nama Suami/Istri</td>
                    <td>:</td>
                    <td><input type="text" name="namasi" class="form-control" value="<?= $guru['namasi']?>"></td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Istri</td>
                    <td>:</td>
                    <td><input type="text" name="pekerjaansi" class="form-control" value="<?= $guru['pekerjaansi']?>"></td>
                  </tr>
                  <tr>
                    <td>TMT PNS</td>
                    <td>:</td>
                    <td><input type="date" name="tmtpns" class="form-control" value="<?= date('Y-m-d',strtotime($guru['tmtpns']))?>"></td>
                  </tr>
                  <tr>
                    <td>Lisensi Kelapa Sekolah</td>
                    <td>:</td>
                    <td>

                      <?php if($guru['lisensi']=='Sudah')$lis='Checked';else $lis='';?>
                      <?php if($guru['lisensi']=='Belum')$lib='Checked';else $lib='';?>
                      <div class="form-inline">
                        <input type="radio" class="form-check" id="lisensiya" <?= $lis ?> name="lisensi" value="Sudah">
                        <label for="lisensiya">Sudah</label>
                        <input type="radio" class="form-check"  <?= $lib ?> id="lisensitidak" name="lisensi" value="Belum">
                        <label for="lisensitidak">Belum</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>NPWP</td>
                    <td>:</td>
                    <td><input type="text" name="npwp" class="form-control" value="<?= $guru['npwp']?>"></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="pt" name="pt" placeholder="">
                        <option value="<?= $guru['pt']?>"><?= $guru['pt']?></option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">D1</option>
                        <option value="S1">D2</option>
                        <option value="S1">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Penugasan</td>
                    <td>:</td>
                    <td><input type="text" name="penugasan" class="form-control" value="<?= $guru['penugasan']?>"></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-center"><input type="submit" name="update" class="btn btn-primary" value="Update"></td>
                  </tr>
                </table>
              <!-- /.post -->

              <!-- Post -->
              <!-- /.post -->
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
</form>