<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'beranda.php') echo 'collapsed'; ?>" href="beranda.php">
        <i class="bi bi-grid"></i>
        <span>Beranda</span>
      </a>
    </li>

    <?php if ($role == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'kelolaPengguna.php') echo 'collapsed'; ?>" href="kelolaPengguna.php">
        <i class="bi bi-people"></i>
        <span>Kelola Data Pengguna</span>
      </a>
    </li>
    <?php endif; ?>

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'diagnosis.php') echo 'collapsed'; ?>" href="diagnosis.php">
        <i class="bi bi-clipboard-plus"></i>
        <span>Diagnosis</span>
      </a>
    </li>

    <!-- Menu-menu ini hanya ditampilkan jika role adalah 'admin' -->
    <?php if ($role == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'gejala.php') echo 'collapsed'; ?>" href="gejala.php">
        <i class="bi bi-thermometer-half"></i>
        <span>Gejala</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'penyakit.php') echo 'collapsed'; ?>" href="penyakit.php">
        <i class="bi bi-file-medical"></i>
        <span>Penyakit</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'rule.php') echo 'collapsed'; ?>" href="rule.php">
        <i class="bi bi-file-check"></i>
        <span>Rule</span>
      </a>
    </li>
    <?php endif; ?>

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'laporan.php') echo 'collapsed'; ?>" href="laporan.php">
        <i class="bi bi-files-alt"></i>
        <span>Laporan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php if($current_page != 'infoApp.php') echo 'collapsed'; ?>" href="infoApp.php">
        <i class="bi bi-info-circle"></i>
        <span>Tentang Aplikasi</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar-->