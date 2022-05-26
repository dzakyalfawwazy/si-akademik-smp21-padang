
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Portal Guru</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/guru/<?= $guru['foto']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="?p=0" class="d-block"><?= $guru['namaguru']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?p=0" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Elearning Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=10" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Materi</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=11" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Tugas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=12" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Nilai Tugas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=1" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Mata Pelajaran</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=5" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Tema</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=6" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data KD</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=2" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Nilai Akademik</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=8" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Nilai Rapor</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=9" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Lihat Nilai Siswa</p>
                </a>
              </li>
            </ul>
            <?php if($guru['jenispegawai']=='Guru Kelas') { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=3" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Data Nilai Non-Akademik</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?p=4" class="nav-link">
                  <i class="fas fa-print nav-icon"></i>
                  <p>Rekap Nilai Akademik SMS dan Cetak</p>
                </a>
              </li>
            </ul>
          <?php } else {} ?>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>