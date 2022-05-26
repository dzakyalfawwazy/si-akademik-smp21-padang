  <?php
  // if (isset($_POST['kirim'])) {
  //   mysqli_query($con,"INSERT INTO `tbl_siswa`(`nis`, `nama`, `jenkel`, `nisn`, `tmpt_lahir`, `tgl_lahir`, `agama`, `kebutuhan`, `alamat`, `kodepos`, `jnttingal`, `alattransportasi`, `notelp`, `nohp`, `email`, `terimakps`, `namaayah`, `tgllhr_ayah`, `pd_ayah`, `phs_ayah`, `namaibu`, `tgllhr_ibu`, `pd_ibu`, `phs_ibu`, `namawali`, `tgllhr_wali`, `pd_wali`, `phs_wali`) VALUES ('$_POST[nis]','$_POST[nama]','$_POST[jenkel]','$_POST[nisn]','$_POST[tmptlahir]','$_POST[tgllahir]','$_POST[agama]','$_POST[kbthn]','$_POST[alamat]','$_POST[kodepos]','$_POST[jnstinggal]','$_POST[alattransportasi]','$_POST[telp]','$_POST[nohp]','$_POST[email]','$_POST[terimakps]','$_POST[namaayah]','$_POST[tglayah]','$_POST[pdayah]','$_POST[phsayah]','$_POST[namaibu]','$_POST[tglibu]','$_POST[pdibu]','$_POST[phsibu]','$_POST[namawali]','$_POST[tglwali]','$_POST[pdibu]','$_POST[phswali]')");
  //   echo "<meta http-equiv=refresh content=1>";
  // }
  $datasiswa=mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nis='$_GET[nis]'"));
  ?>
  <!-- general form elements -->
  <!-- form start -->
  <div class="row">
    <div class="col-md-12">
      <form role="form" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Data Siswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                  <label for="nis">Nomor Induk Siswa</label>
                  <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" readonly value="<?= $datasiswa['nis'] ?>">
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" readonly value="<?= $datasiswa['nama'] ?>">
                </div>
                <div class="form-group">
                  <label for="jenkel">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" readonly value="<?= $datasiswa['jenkel'] ?>">
                </div>
                <div class="form-group">
                  <label for="nisn">NISN</label>
                  <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan NISN"  readonly value="<?= $datasiswa['nisn'] ?>">
                </div>
                <div class="form-group">
                  <label for="tmptlahir">Tempat Lahir</label>
                  <input type="text" class="form-control" id="tmptlahir" name="tmptlahir" placeholder="Masukan Tempat Lahir" readonly value="<?= $datasiswa['tmpt_lahir'] ?>">
                </div>
                <div class="form-group">
                  <label for="tgllahir">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tgllahir" name="tgllahir" placeholder="" readonly value="<?= $datasiswa['tgl_lahir'] ?>">
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <input type="text" class="form-control" id="agama" name="agama" placeholder="" readonly value="<?= $datasiswa['agama'] ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="kodepos">Kode Pos</label>
                  <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Masukan Kode Pos"  readonly value="<?= $datasiswa['kodepos'] ?>">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" readonly value="<?= $datasiswa['alamat'] ?>">
                </div>
                <div class="form-group">
                  <label for="kbthn">Kebutuhan Khusus</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" readonly value="<?= $datasiswa['kebutuhan'] ?>">
                </div>
                <div class="form-group">
                  <label for="jnstinggal">Jenis Tinggal</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" readonly value="<?= $datasiswa['jnttingal'] ?>">
                </div>
                <div class="form-group">
                  <label for="alattransportasi">Alat Transportasi</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" readonly value="<?= $datasiswa['alattransportasi'] ?>">
                </div>
                <div class="form-group">
                  <label for="telp">No. Telpon</label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukan Nomor Telepon" readonly value="<?= $datasiswa['notelp'] ?>">
                </div>
                <div class="form-group">
                  <label for="nohp">No. HP</label>
                  <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukan No. HP"  readonly value="<?= $datasiswa['nohp'] ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" readonly value="<?= $datasiswa['email'] ?>">
                </div>
                <div class="form-group">
                  <label for="terimakps">Terima KPS</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" readonly value="<?= $datasiswa['terimakps'] ?>">
                </div>
                <div class="form-group">
                  <label for="namaayah">Nama Ayah</label>
                  <input type="text" class="form-control" id="namaayah" name="namaayah" placeholder="Masukan Nama Ayah" readonly value="<?= $datasiswa['namaayah'] ?>">
                </div>
                <div class="form-group">
                  <label for="tglayah">Tanggal Lahir Ayah</label>
                  <input type="date" class="form-control" id="tglayah" name="tglayah" placeholder="" readonly value="<?= $datasiswa['tgllhr_ayah'] ?>">
                </div>
                <div class="form-group">
                  <label for="pdayah">Pendidikan Ayah</label>
                  <input type="date" class="form-control" id="tglayah" name="tglayah" placeholder="" readonly value="<?= $datasiswa['pd_ayah'] ?>">
                </div>
                <div class="form-group">
                  <label for="phsayah">Penghasilan Ayah</label>
                  <input type="text" class="form-control" id="phsayah" name="phsayah" placeholder="Masukan Penghasilan Ayah" readonly value="<?= $datasiswa['phs_ayah'] ?>">
                </div>
                <div class="form-group">
                  <label for="namaibu">Nama Ibu</label>
                  <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Masukan Nama Ibu" readonly value="<?= $datasiswa['namaibu'] ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="tglayah">Tanggal Lahir Ibu</label>
                  <input type="date" class="form-control" id="tglibu" name="tglibu" placeholder="" readonly value="<?= $datasiswa['tgllhr_ibu'] ?>">
                </div>
                <div class="form-group">
                  <label for="pdibu">Pendidikan Ibu</label>
                  <input type="text" class="form-control" id="tglibu" name="tglibu" placeholder="" readonly value="<?= $datasiswa['pd_ibu'] ?>">
                </div>
                <div class="form-group">
                  <label for="phsibu">Penghasilan Ibu</label>
                  <input type="text" class="form-control" id="phsibu" name="phsibu" placeholder="Masukan Penghasilan Ayah" readonly value="<?= $datasiswa['phs_ibu'] ?>">
                </div>

                <div class="form-group">
                  <label for="namawali">Nama Wali</label>
                  <input type="text" class="form-control" id="namawali" name="namawali" placeholder="Masukan Nama Wali" readonly value="<?= $datasiswa['namawali'] ?>">
                </div>
                <div class="form-group">
                  <label for="tglwali">Tanggal Lahir Wali</label>
                  <input type="date" class="form-control" id="tglwali" name="tglwali" placeholder="" readonly value="<?= $datasiswa['tgllhr_wali'] ?>">
                </div>
                <div class="form-group">
                  <label for="pdwali">Pendidikan Wali</label>
                  <input type="text" class="form-control" id="tglwali" name="tglwali" placeholder="" readonly value="<?= $datasiswa['pd_wali'] ?>">
                </div>
                <div class="form-group">
                  <label for="phswali">Penghasilan Wali</label>
                  <input type="text" class="form-control" id="phswali" name="phswali" placeholder="Masukan Penghasilan Wali" readonly value="<?= $datasiswa['phs_wali'] ?>">
                </div>
              </div>
              </div>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </form>
    </div>
  </div>
