<?php
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $idUserAktif = $_SESSION['idUser'];
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

include 'dbKoneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tentang Aplikasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/datatables/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="assets/vendor/datatables/css/buttons/buttons.bootstrap5.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/styleyamin.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <?php include 'header.php'; ?>

  <?php include 'sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tentang Aplikasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Tentang Aplikasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <?php
      if (isset($_SESSION['alert'])) {
        $alert_type = $_SESSION['alert']['type'];
        $alert_message = $_SESSION['alert']['message'];
        $alert_icon = $_SESSION['alert']['icon'];

        // Hapus session alert setelah menampilkannya
        unset($_SESSION['alert']);

        // Tampilkan alert Bootstrap
        echo '
        <div class="alert alert-' . $alert_type . ' alert-dismissible fade show floating-alert" role="alert">
          <i class="bi bi-' . $alert_icon . ' me-1"></i>
          ' . $alert_message . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <hr>
        </div>
        ';
      }
      ?>
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/dokter.jpg" alt="Profile" class="rounded-circle">
              <h2>dr. Ananda Rahmat Putra, M.Ked (PD), Sp.PD</h2>
              <h3>Dokter Spesialis Penyakit Dalam</h3>
              <div class="social-links mt-2">
                <a href="https://www.alodokter.com/cari-dokter/dr-ananda-rahmat-putra-mked-pd-sppd" target="_blank" class="twitter"></i> Alodokter</a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/me.jpg" alt="Profile" class="rounded-circle">
              <h2>M. Yamin</h2>
              <h3 class="text-center">Mahasiswa Tingkat Akhir STMIK Pelita Nusantara</h3>
              <div class="social-links mt-2">
                <a href="https://www.linkedin.com/in/muhammadyamin1" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i> LinkedIn</a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Tentang</h5>
                  <img src="assets/img/sistem-pakar.png" alt="Sistem Pakar" title="Cara Kerja Sistem Pakar" width="100%">
                  <p align="justify">Aplikasi Sistem Pakar deteksi dini penyakit Demam Berdarah Dengue ini dibangun dengan menggunakan metode Rule Based Reasoning, sebuah pendekatan yang mengandalkan aturan-aturan logis untuk menganalisis gejala dan mendiagnosis penyakit. Proyek ini diperkuat dengan penelitian yang mendalam serta kerjasama erat antara saya sebagai mahasiswa dengan dokter dan perawat di Rumah Sakit Umum Bandung.</p>
                  <p>
                    <a href="assets/pdf/Data Riset RSU. Bandung.pdf" target="_blank">Lihat Data Riset</a><br>
                    <a href="assets/pdf/Surat Balasan Riset RSU. Bandung.pdf" target="_blank">Lihat Surat Balasan Riset</a>
                  </p>
                  <p align="justify">Saya ingin mengucapkan terima kasih kepada para pakar ataupun ahli medis yang telah berperan aktif dalam pengembangan aplikasi ini, termasuk dr. Ananda Rahmat Putra, Sp.PD, seorang spesialis penyakit dalam dengan berbagai pengalaman di bidangnya, serta dr. Tjoet Arida dan tim perawat seperti ibu Wiwik, A.Md yang telah memberikan waktunya untuk memvalidasi dan menyempurnakan aplikasi ini.</p>
                  <p align="justify">Melalui aplikasi ini, saya berharap dapat memberikan kontribusi positif dalam pelayanan kesehatan masyarakat, terutama dalam mendukung upaya pencegahan dan pengobatan dini terhadap DBD. Dengan semangat kolaboratif antara akademisi, praktisi medis, dan pengembang teknologi, saya juga berharap aplikasi ini tidak hanya menjadi bagian dari pembelajaran akademik, tetapi juga sebuah alat yang bermanfaat dalam kehidupan nyata untuk meningkatkan kualitas layanan kesehatan di masyarakat.</p>

                  <h5 class="card-title">Spesifikasi Sistem Yang Disarankan</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Web Server</div>
                    <div class="col-lg-9 col-md-8">Apache HTTP Server 2.4.58</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Database</div>
                    <div class="col-lg-9 col-md-8">MariaDB 10.4.32</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Language</div>
                    <div class="col-lg-9 col-md-8">PHP 8.2.1.2</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">OS</div>
                    <div class="col-lg-9 col-md-8">Windows 10 Pro ×64</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Processor</div>
                    <div class="col-lg-9 col-md-8">Intel Core i3-10110U</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">RAM</div>
                    <div class="col-lg-9 col-md-8">4 GB</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Storage</div>
                    <div class="col-lg-9 col-md-8">SSD 256 GB</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Bundling</div>
                    <div class="col-lg-9 col-md-8">xampp-windows-x64-8.2.12-0-VS16</div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      Copyright &copy; 2024 <strong><span>M. Yamin - 8TIFB-01 - Teknik Informatika - STMIK Pelita
          Nusantara</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script src="assets/vendor/datatables/js/dataTables.js"></script>
  <script src="assets/vendor/datatables/js/dataTables.bootstrap5.js"></script>
  <script src="assets/vendor/datatables/js/plugins/natural.js"></script>
  <script src="assets/vendor/datatables/js/buttons/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables/js/buttons/buttons.bootstrap5.min.js"></script>
  <script src="assets/vendor/datatables/js/buttons/jszip.min.js"></script>
  <script src="assets/vendor/datatables/js/buttons/pdfmake.min.js"></script>
  <script src="assets/vendor/datatables/js/buttons/vfs_fonts.js"></script>
  <script src="assets/vendor/datatables/js/buttons/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatables/js/buttons/buttons.print.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/script.js"></script>

</body>

</html>