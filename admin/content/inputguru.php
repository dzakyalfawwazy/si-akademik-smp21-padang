  <?php
  if (isset($_POST['kirim'])) {
    $namafile = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
  // echo ;
  $q1=mysqli_query($con,"INSERT INTO `tbl_guru`(`nip`, `namaguru`, `jenkel`, `tmpt_lahir`, `tgl_lahir`, `nik`, `nuptk`, `jenispegawai`, `statuspegawai`, `agama`, `alamat`, `kodepos`, `notelp`, `nohp`, `email`, `skcpns`, `tglpns`, `skpengangkatan`, `tmt`, `lembaga`, `sumbergaji`, `namaibu`, `statuskawin`, `nipsi`, `namasi`, `pekerjaansi`, `tmtpns`, `lisensi`, `npwp`, `pt`, `penugasan`) VALUES ('$_POST[nip]', '$_POST[namaguru]', '$_POST[jenkel]', '$_POST[tmpt_lahir]', '$_POST[tgl_lahir]', '$_POST[nik]', '$_POST[nuptk]', '$_POST[jenispegawai]', '$_POST[statuspegawai]', '$_POST[agama]', '$_POST[alamat]', '$_POST[kodepos]', '$_POST[notelp]', '$_POST[nohp]', '$_POST[email]', '$_POST[skcpns]', '$_POST[tglpns]', '$_POST[skpengangkatan]', '$_POST[tmt]', '$_POST[lembaga]', '$_POST[sumbergaji]', '$_POST[namaibu]', '$_POST[statuskawin]', '$_POST[nipsi]', '$_POST[namasi]', '$_POST[pekerjaansi]', '$_POST[tmtpns]', '$_POST[lisensi]', '$_POST[npwp]', '$_POST[pt]', '$_POST[penugasan]' '$namafile')");
// echo "INSERT INTO `tbl_user`(`no`, `password`, `level`) VALUES ('$_POST[nip]',md5('123'),'guru')";
  $q2=mysqli_query($con,"INSERT INTO `tbl_user`(`no`, `password`, `level`) VALUES ('$_POST[nip]',md5('123'),'guru')");
   // echo "<meta http-equiv=refresh content=1>";
    if($q1)
    {
      move_uploaded_file($tmp, '../img/guru/'.$namafile);
      echo "<script>alert('Data Berhasil Ditambah!')</script>";
      echo "<meta http-equiv=refresh content=1>";
    }
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <form role="form" method="post" enctype="multipart/form-data">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Data Guru</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nip">Nomor Induk Pegawai</label>
              <input type="text" title="Masukan NIP dengan angka tanpa spasi" required class="form-control" id="nip" name="nip" placeholder="NIP">
            </div>
            <div class="form-group">
              <label for="namaguru">Nama Guru</label>
              <input type="text" required class="form-control" id="namaguru" name="namaguru" placeholder="Masukan Nama Guru" required>
            </div><!-- 
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
            </div> -->
            <div class="form-group">
              <label for="jenkel">Jenis Kelamin</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="jenkelya" name="jenkel" value="Laki-laki" placeholder="">
                <label for="jenkelya">Laki-laki</label>
                <input type="radio" class="form-check" id="jenkeltidak" name="jenkel" value="jenkel" placeholder="">
                <label for="jenkeltidak">Perempuan</label>
              </div>
            </div>
            <div class="form-group">
              <label for="tmpt_lahir">Tempat Lahir</label>
              <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" placeholder="Masukan Tempat Lahir">
            </div>
            <div class="form-group">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
            </div>
            <div class="form-group">
              <label for="nuptk">NU Pendidik dan Tenaga  Kerja</label>
              <input type="text" class="form-control" id="nuptk" name="nuptk" placeholder="Masukan NU Pendidik dan Tenaga kerja">
            </div>
            <div class="form-group">
              <label for="jenispegawai">Jenis Pegawai</label>
              <select type="text" class="form-control" id="jenispegawai" required name="jenispegawai">
                <option value="" hidden>Silahkan Pilih</option>
                <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
                <option value="Guru Kelas">Guru Kelas</option>
                <option value="Tenaga Administrasi Sekolah">Tenaga Administrasi Sekolah</option>
                <option value="Tenaga Perpustakaan">Tenaga Perpustakaan</option>
                <option value="Kepala Sekolah">Kepala Sekolah</option>
              </select>
            </div>
            <div class="form-group">
              <label for="statuspegawai">Status Pegawai</label>
              <select type="text" class="form-control" id="statuspegawai" name="statuspegawai">
                <option hidden value="">Silahkan Pilih</option>
                <option value="PNS">PNS</option>
                <option value="Honor daerah Tk.II Kab/Kota">Honor daerah Tk.II Kab/Kota</option>
              </select>
            </div>
            <div class="form-group">
              <label for="agama">Agama</label>
              <select class="form-control" id="agama" name="agama">
                <option hidden value="">Silahkan Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Khatolik">Khatolik</option>
                <option value="Buddha">Buddha</option>
                <option value="Hindu">Hindu</option>
              </select>
            </div>
            <div class="form-group">
              <label for="agama">Alamat</label>
              <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat"></textarea>
            </div>
            <div class="form-group">
              <label for="kodepos">Kode Pos</label>
              <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Masukan Kode Pos">
            </div>

            <div class="form-group">
              <label for="notelp">No. Telpon</label>
              <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Masukan No. Telpon">
            </div>
            <div class="form-group">
              <label for="nohp">No. HP</label>
              <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukan No. HP">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
              <label for="skcpns">SKCPNS</label>
              <input type="text" class="form-control" id="skcpns" name="skcpns" placeholder="Masukan SKCPNS">
            </div>
          </div>
          <!-- /.card-body -->
          <!-- /.card -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="tglpns">Tanggal PNS</label>
              <input type="date" class="form-control" id="tglpns" name="tglpns" placeholder="Masukan Tanggal CPNS">
            </div>
            <div class="form-group">
              <label for="skpengangkatan">SK. Pengangkatan</label>
              <input type="text" class="form-control" id="skpengangkatan" name="skpengangkatan" placeholder="Masukan SK Pengangkatan">
            </div>
            <div class="form-group">
              <label for="tmt">TMT CPNS</label>
              <input type="date" class="form-control" id="tmt" name="tmt" placeholder="">
            </div>
            <div class="form-group">
              <label for="lembaga">Lembaga Pengangkatan</label>
              <select class="form-control" id="lembaga" name="lembaga" placeholder="Masukan Lembaga Pengangkatan">
                <option value="" hidden>Silahkan Pilih</option>
                <option value="Pemerintahan Kabupaten/Kota">Pemerintahan Kabupaten/Kota</option>
                <option value="Kepala Sekolah">Kepala Sekolah</option>
                <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                <option value="Pemerintah Provinsi">Pemerintah Provinsi</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sumbergaji">Sumber Gaji</label>
              <select type="text" class="form-control" id="sumbergaji" name="sumbergaji">
                <option value="" hidden>Silahkan Pilih</option>
                <option value="APBD Kabupaten/Kota">APBD Kabupaten/Kota</option>
                <option value="APBD Provinsi">APBD Provinsi</option>
              </select>
            </div>
            <div class="form-group">
              <label for="namaibu">Nama Ibu</label>
              <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Masukan Nama Ibu">
            </div>
            <div class="form-group">
              <label for="statuskawin">Status Kawin</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="stasuskawinya" name="statuskawin" value="Sudah">
                <label for="stasuskawinya">Sudah</label>
                <input type="radio" class="form-check" id="stasuskawintidak" name="statuskawin" value="Belum">
                <label for="stasuskawintidak">Belum</label>
              </div>
            </div>
            <div class="form-group">
              <label for="nipsi">NIP Suami/Istri</label>
              <input type="text" class="form-control" id="nipsi" name="nipsi" placeholder="Masukan NIP Suami/Istri">
            </div>
            <div class="form-group">
              <label for="namasi">Nama Suami/Istri</label>
              <input type="text" class="form-control" id="namasi" name="namasi" placeholder="Masukan Nama Suami/Istri">
            </div>
            <div class="form-group">
              <label for="pekerjaansi">Pekerjaan Suami/Istri</label>
              <input type="text" class="form-control" id="pekerjaansi" name="pekerjaansi" placeholder="Masukan Pekerjaan Suami/Istri">
            </div>
            <div class="form-group">
              <label for="tmtpns">TMT PNS Suami/Istri</label>
              <input type="date" class="form-control" id="tmtpns" name="tmtpns" placeholder="Masukan TMT PNS Suami/Istri">
            </div>
            <div class="form-group">
              <label for="lisensi">Lisensi Kepala sekolah</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="lisensiya" name="lisensi" value="Sudah">
                <label for="lisensiya">Sudah</label>
                <input type="radio" class="form-check" id="lisensitidak" name="lisensi" value="Belum">
                <label for="lisensitidak">Belum</label>
              </div>
            </div>
            <div class="form-group">
              <label for="npwp">NPWP</label>
              <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukan NPWP">
            </div>
            <div class="form-group">
              <label for="pt">Pendidikan Terakhir</label>
              <select class="form-control" id="pt" name="pt" placeholder="">
                <option value="" hidden>Silahkan Pilih</option>
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
            </div>
            <div class="form-group">
              <label for="penugasan">Penugasan</label>
              <input type="text" class="form-control" id="penugasan" name="penugasan" placeholder="Masukan Penugasan">
            </div>
            <div class="form-group">
              <label for="foto">Foto</label>
              <input type="file" class="form-control" id="foto" name="foto" placeholder="Masukan Penugasan">
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-center">
        <button type="submit" name="kirim" class="btn btn-primary toastsDefaultSuccess">Simpan</button>
      </div>
    </div>
  </form>

<div class="col-md-12">
  <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Guru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Pegawai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_guru");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nip'] ?></td>
                <td><?= $dakel['namaguru'] ?></td>
                <td><?= $dakel['nik'] ?></td>
                <td><?= $dakel['jenispegawai'] ?></td>
                <td>
                    <div class="btn-group">
                      <?= "<a href='?p=10&nip=$dakel[nip]' class='btn btn-sm btn-info' title='Preview Data'><i class='fa fa-eye'></i></a>" ?>
                      <a href="?p=11&nip=<?= $dakel['nip'] ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                       <a href="deleteadmin.php?tipe=deleteguru&nip=<?= $dakel['nip'] ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
  