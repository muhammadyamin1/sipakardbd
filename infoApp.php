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

    <section class="section">
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
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tentang Aplikasi Sistem Pakar Berbasis Rule Based Reasoning</h5>

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