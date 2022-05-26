  <?php
  $now=date('Y');
  if (isset($_POST['kirim'])) {
    $namafile = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
   $q1=mysqli_query($con,"INSERT INTO `tbl_siswa`(`nis`, `nik`, `nama`, `jenkel`, `nisn`, `noijazah`, `tmpt_lahir`, `tgl_lahir`, `agama`, `kebutuhan`, `alamat`, `kodepos`, `jnttingal`, `alattransportasi`, `notelp`, `nohp`, `email`, `terimakps`, `namaayah`, `tgllhr_ayah`, `pd_ayah`, `pekerjaanayah`, `phs_ayah`, `namaibu`, `tgllhr_ibu`, `pd_ibu`, `pekerjaanibu`, `phs_ibu`, `namawali`, `tgllhr_wali`, `pd_wali`, `pekerjaanwali`, `phs_wali`, `foto`) VALUES ('$_POST[nis]','$_POST[nik]','$_POST[nama]','$_POST[jenkel]','$_POST[nisn]','-','$_POST[tmptlahir]','$_POST[tgllahir]','$_POST[agama]','$_POST[kbthn]','$_POST[alamat]','$_POST[kodepos]','$_POST[jnstinggal]','$_POST[alattransportasi]','$_POST[telp]','$_POST[nohp]','$_POST[email]','$_POST[terimakps]','$_POST[namaayah]','$_POST[tglayah]','$_POST[pdayah]','$_POST[pekerjaanayah]','$_POST[phsayah]','$_POST[namaibu]','$_POST[tglibu]','$_POST[pdibu]','$_POST[pekerjaanibu]','$_POST[phsibu]','$_POST[namawali]','$_POST[tglwali]','$_POST[pdwali]','$_POST[pekerjaanwali]','$_POST[phswali]','$namafile')") or die(mysqli_error($con));
    $q2=mysqli_query($con,"INSERT INTO `tbl_user`(`no`, `password`, `level`) VALUES ('$_POST[nis]',md5('123'),'siswa')");
    echo "<meta http-equiv=refresh content=1>";
    if($q1)
    {
      move_uploaded_file($tmp, '../img/siswa/'.$namafile);
      echo "<script>alert('Data Berhasil Ditambah!')</script>";
      echo "<meta http-equiv=refresh content=1>";
    }
  }
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-12">
  <form role="form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Data Siswa</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="nis">Nomor Induk Siswa</label>
              <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS">
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
            </div>
            <div class="form-group">
              <label for="jenkel">Jenis Kelamin</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="laki-laki" value="Laki-laki" name="jenkel"><label for="laki-laki"> Laki-laki</label> &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check" id="perempuan" value="Perempuan" name="jenkel"><label for="perempuan"> Perempuan</label>
              </div>
            </div>
            <div class="form-group">
              <label for="nisn">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan NISN">
            </div>
            <div class="form-group">
              <label for="tmptlahir">Tempat Lahir</label>
              <input type="text" class="form-control" id="tmptlahir" name="tmptlahir" placeholder="Masukan Tempat Lahir">
            </div>
            <div class="form-group">
              <label for="tgllahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgllahir" name="tgllahir" placeholder="">
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
              <label for="kodepos">Kode Pos</label>
              <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Masukan Kode Pos">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea type="text" class="form-control" id="alamat" name="alamat"> Masukan Alamat</textarea>
            </div>
            <div class="form-group">
              <label for="kbthn">Kebutuhan Khusus</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="kbthnya" name="kbthn" value="Ya" placeholder="">
                <label for="kbthnya">Ya</label>
                <input type="radio" class="form-check" id="kbthntidak" name="kbthn" value="Tidak" placeholder="">
                <label for="kbthntidak">Tidak</label>
              </div>
            </div>
            <div class="form-group">
              <label for="jnstinggal">Jenis Tinggal</label>
              <select class="form-control" id="jnstinggal" name="jnstinggal">
                <option value="">Silahkan Pilih</option>
                <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                <option value="Bersama Wali">Bersama Wali</option>
                <option value="Tinggal Sendiri">Tinggal Sendiri</option>
              </select>
            </div>
            <div class="form-group">
              <label for="alattransportasi">Alat Transportasi</label>
              <select class="form-control" id="alattransportasi" name="alattransportasi">
                <option hidden value="">Silahkan Pilih</option>
                <option value="Angkutan Umum">Angkutan Umum</option>
                <option value="Jalan Kaki">Jalan Kaki</option>
                <option value="Sepeda Motor">Sepeda Motor</option>
                <option value="Mobil">Mobil</option>
              </select>
            </div>
            <div class="form-group">
              <label for="telp">No. Telpon</label>
              <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukan Nomor Telepon">
            </div>
            <div class="form-group">
              <label for="nohp">No. HP</label>
              <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukan No. HP">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
              <label for="terimakps">Terima KPS</label>
              <div class="form-inline">
                <input type="radio" class="form-check" id="terimakpsya" name="terimakps" value="Ya" placeholder="">
                <label for="terimakpsya">Ya</label>
                <input type="radio" class="form-check" id="terimakpstidak" value="Tidak" name="terimakps" placeholder="">
                <label for="terimakpstidak">Tidak</label>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" name="kirim" class="btn btn-primary toastsDefaultSuccess">Simpan</button>
          </div>
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Data Ayah</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="namaayah">Nama Ayah</label>
              <input type="text" class="form-control" id="namaayah" name="namaayah" placeholder="Masukan Nama Ayah">
            </div>
            <div class="form-group">
              <label for="tglayah">Tahun Lahir Ayah</label>
              <select class="form-control" id="tglayah" name="tglayah">
                <option value="" hidden>Pilih Tahun</option>
                <?php
                for ($a=$now; $a >= 1945 ; $a--) { 
                 echo "<option value='$a'>$a</option>";
                }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pdayah">Pendidikan Ayah</label>
              <select class="form-control" id="pdayah" name="pdayah">
                <option value="" hidden>Silakan Pilih</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="Tidak Ada">Tidak Ada</option>
              </select>
            </div>
            <div class="form-group">
              <label for="phsayah">Penghasilan Ayah</label>
              <input type="text" class="form-control" id="phsayah" name="phsayah" placeholder="Masukan Penghasilan Ayah">
            </div>
            <div class="form-group">
              <label for="pekerjaanayah">Pekerjaan Ayah</label>
              <input type="text" class="form-control" id="pekerjaanayah" name="pekerjaanayah" placeholder="Masukan Pekerjaan Ayah">
            </div>
          </div>
        </div>
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Data Ibu</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="namaibu">Nama Ibu</label>
              <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Masukan Nama Ibu">
            </div>
            <div class="form-group">
              <label for="tglibu">Tanggal Lahir Ibu</label>
              <select class="form-control" id="tglibu" name="tglibu">
                <option value="" hidden>Pilih Tahun</option>
                <?php
                for ($a=$now; $a >= 1945 ; $a--) { 
                 echo "<option value='$a'>$a</option>";
                }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pdibu">Pendidikan Ibu</label>
              <select class="form-control" id="pdibu" name="pdibu">
                <option value="" hidden>Silakan Pilih</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="Tidak Ada">Tidak Ada</option>
              </select>
            </div>
            <div class="form-group">
              <label for="phsibu">Penghasilan Ibu</label>
              <input type="text" class="form-control" id="phsibu" name="phsibu" placeholder="Masukan Penghasilan Ayah">
            </div>

            <div class="form-group">
              <label for="pekerjaanayah">Pekerjaan Ibu</label>
              <input type="text" class="form-control" id="pekerjaanibu" name="pekerjaanibu" placeholder="Masukan Pekerjaan Ibu">
            </div>
          </div>
        </div>
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Data Wali</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="namawali">Nama Wali</label>
              <input type="text" class="form-control" id="namawali" name="namawali" placeholder="Masukan Nama Wali">
            </div>
            <div class="form-group">
              <label for="tglwali">Tanggal Lahir Wali</label>
             <select class="form-control" id="tglwali" name="tglwali">
                <option value="" hidden>Pilih Tahun</option>
                <?php
                for ($a=$now; $a >= 1945 ; $a--) { 
                 echo "<option value='$a'>$a</option>";
                }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pdwali">Pendidikan Wali</label>
              <select class="form-control" id="pdwali" name="pdwali">
                <option value="" hidden>Silakan Pilih</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="Tidak Ada">Tidak Ada</option>
              </select>
            </div>
            <div class="form-group">
              <label for="phswali">Penghasilan Wali</label>
              <input type="text" class="form-control" id="phswali" name="phswali" placeholder="Masukan Penghasilan Wali">
            </div>

            <div class="form-group">
              <label for="pekerjaanayah">Pekerjaan Wali</label>
              <input type="text" class="form-control" id="pekerjaanwali" name="pekerjaanwali" placeholder="Masukan Pekerjaan Wali">
            </div>
            <div class="form-group">
              <label for="foto">Foto</label>
              <input type="file" class="form-control" accept=".jpg,.jpeg,.png" required id="foto" name="foto" placeholder="Foto">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="col-md-12">
  <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Data Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $qukel=mysqli_query($con,"select * from tbl_siswa where noijazah ='-' or noijazah =NULL");
              $no=0;
              while($dakel=mysqli_fetch_array($qukel)){
                $no++;
                ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $dakel['nis'] ?></td>
                <td><?= $dakel['nama'] ?></td>
                <td><?= $dakel['namaayah'] ?></td>
                <td><?= $dakel['namaibu'] ?></td>
                  <td>
                    <div class="btn-group">
                      <?= "<a href='?p=9&nis=$dakel[nis]' class='btn btn-sm btn-info' title='Preview Data'><i class='fa fa-eye'></i></a>" ?>
                      <a href="?p=12&nis=<?= $dakel['nis'] ?>" title="Edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                      <a href="deleteadmin.php?tipe=deletesiswa&nis=<?= $dakel['nis'] ?>" onclick="return confirm('Anda Yakin Hapus?')" title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
</div>