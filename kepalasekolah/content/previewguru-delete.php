  <?php
  // if (isset($_POST['kirim'])) {
  //   mysqli_query($con,"INSERT INTO `tbl_siswa`(`nis`, `nama`, `jenkel`, `nisn`, `tmpt_lahir`, `tgl_lahir`, `agama`, `kebutuhan`, `alamat`, `kodepos`, `jnttingal`, `alattransportasi`, `notelp`, `nohp`, `email`, `terimakps`, `namaayah`, `tgllhr_ayah`, `pd_ayah`, `phs_ayah`, `namaibu`, `tgllhr_ibu`, `pd_ibu`, `phs_ibu`, `namawali`, `tgllhr_wali`, `pd_wali`, `phs_wali`) VALUES ('$_POST[nis]','$_POST[nama]','$_POST[jenkel]','$_POST[nisn]','$_POST[tmptlahir]','$_POST[tgllahir]','$_POST[agama]','$_POST[kbthn]','$_POST[alamat]','$_POST[kodepos]','$_POST[jnstinggal]','$_POST[alattransportasi]','$_POST[telp]','$_POST[nohp]','$_POST[email]','$_POST[terimakps]','$_POST[namaayah]','$_POST[tglayah]','$_POST[pdayah]','$_POST[phsayah]','$_POST[namaibu]','$_POST[tglibu]','$_POST[pdibu]','$_POST[phsibu]','$_POST[namawali]','$_POST[tglwali]','$_POST[pdibu]','$_POST[phswali]')");
  //   echo "<meta http-equiv=refresh content=1>";
  // }
  $dataguru=mysqli_fetch_array(mysqli_query($con,"select * from tbl_guru where nip='$_GET[nip]'"));
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
                <h3 class="card-title">Data Guru</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
              <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?= $dataguru['nip']?></td>
              </tr>
              <tr>
                <td>Nama Guru</td>
                <td>:</td>
                <td><?= $dataguru['namaguru']?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $dataguru['jenkel']?></td>
              </tr>
              <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $dataguru['nik']?></td>
              </tr>
              <tr>
                <td>NU Pengajar dan Tenaga Kerja</td>
                <td>:</td>
                <td><?= $dataguru['nuptk']?></td>
              </tr>
              <tr>
                <td>Jenis Pegawai</td>
                <td>:</td>
                <td><?= $dataguru['jenispegawai']?></td>
              </tr>
              <tr>
                <td>Status Pegawai</td>
                <td>:</td>
                <td><?= $dataguru['statuspegawai']?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?= $dataguru['agama']?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $dataguru['alamat']?></td>
              </tr>
              <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><?= $dataguru['kodepos']?></td>
              </tr>
              <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $dataguru['notelp']?></td>
              </tr>
              <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><?= $dataguru['nohp']?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $dataguru['email']?></td>
              </tr>
              <tr>
                <td>SK CPNS</td>
                <td>:</td>
                <td><?= $dataguru['skcpns']?></td>
              </tr>
              <tr>
                <td>Tanggal PNS</td>
                <td>:</td>
                <td><?= $dataguru['tglpns']?></td>
              </tr>
              <tr>
                <td>SK Pengangkatan</td>
                <td>:</td>
                <td><?= $dataguru['skpengangkatan']?></td>
              </tr>
              <tr>
                <td>TMT</td>
                <td>:</td>
                <td><?= $dataguru['tmt']?></td>
              </tr>
              <tr>
                <td>Lembaga</td>
                <td>:</td>
                <td><?= $dataguru['lembaga']?></td>
              </tr>
              <tr>
                <td>Sumber Gaji</td>
                <td>:</td>
                <td><?= $dataguru['sumbergaji']?></td>
              </tr>
              <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?= $dataguru['namaibu']?></td>
              </tr>
              <tr>
                <td>Status Kawin</td>
                <td>:</td>
                <td><?= $dataguru['statuskawin']?></td>
              </tr>
              <tr>
                <td>NIP Suami/Istri</td>
                <td>:</td>
                <td><?= $dataguru['nipsi']?></td>
              </tr>
              <tr>
                <td>Nama Suami/Istri</td>
                <td>:</td>
                <td><?= $dataguru['namasi']?></td>
              </tr>
              <tr>
                <td>Pekerjaan Istri</td>
                <td>:</td>
                <td><?= $dataguru['pekerjaansi']?></td>
              </tr>
              <tr>
                <td>TMT PNS</td>
                <td>:</td>
                <td><?= $dataguru['tmtpns']?></td>
              </tr>
              <tr>
                <td>Lisensi Kelapa Sekolah</td>
                <td>:</td>
                <td><?= $dataguru['lisensi']?></td>
              </tr>
              <tr>
                <td>NPWP</td>
                <td>:</td>
                <td><?= $dataguru['npwp']?></td>
              </tr>
              <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td><?= $dataguru['pt']?></td>
              </tr>
              <tr>
                <td>Penugasan</td>
                <td>:</td>
                <td><?= $dataguru['penugasan']?></td>
              </tr>
            </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </form>
    </div>
  </div>
