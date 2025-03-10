<?php
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $idUserAktif = $_SESSION['idUser'];
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
  if (isset($_SESSION['editUserFormValues'])) {
    unset($_SESSION['editUserFormValues']);
  }
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

include 'dbKoneksi.php';

// Total diagnosis keseluruhan
$sqlTotalDiagnosis = "SELECT COUNT(*) as total FROM tb_diagnosis";
$resultTotalDiagnosis = $conn->query($sqlTotalDiagnosis);
$totalDiagnosis = $resultTotalDiagnosis->fetch_assoc()['total'];

// Diagnosis hari ini
$sqlDiagnosisHariIni = "SELECT COUNT(*) as total FROM tb_diagnosis WHERE DATE(tanggal) = CURDATE()";
$resultDiagnosisHariIni = $conn->query($sqlDiagnosisHariIni);
$diagnosisHariIni = $resultDiagnosisHariIni->fetch_assoc()['total'];

// Total rules
$sqlTotalRules = "SELECT COUNT(*) as total FROM tb_rule";
$resultTotalRules = $conn->query($sqlTotalRules);
$totalRules = $resultTotalRules->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Beranda</title>
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
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
      <h1>Beranda</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Beranda</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <?php
      if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
        echo '
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          Selamat Datang ' . ucwords($nama) . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <hr>
        </div>
        ';
        $_SESSION['login_success'] = false;
      }
      ?>
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Selamat Datang di Sistem Pakar Deteksi Dini Penyakit DBD</h5>
              <p>Penyakit Demam Berdarah Dengue (DBD) adalah salah satu masalah kesehatan utama di Indonesia. Deteksi dini penyakit ini sangat penting untuk mengurangi tingkat keparahan dan mencegah penyebaran lebih lanjut. Kami hadir dengan Sistem Pakar Deteksi Dini Penyakit DBD yang dirancang untuk membantu Anda dalam mengenali gejala awal DBD secara cepat dan akurat.</p>
            </div>
          </div>

        </div>

        <div class="col-lg-4">

          <div class="card">
            <!-- Slides with controls -->
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="assets/img/nyamuk-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="assets/img/nyamuk-2.jfif" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="assets/img/nyamuk-3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>

            </div><!-- End Slides with controls -->
          </div>

        </div>

        <div class="col-lg-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Total Diagnosis <span>| Keseluruhan</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-clipboard-check"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $totalDiagnosis; ?></h6>
                  <span class="text-success small pt-1 fw-bold">Pasien</span>

                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Diagnosis <span>| Hari Ini</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-clipboard-plus"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $diagnosisHariIni; ?></h6>
                  <span class="text-success small pt-1 fw-bold">Pasien</span>

                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-4">
          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Rule <span>| Mesin Inferensi</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cpu"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $totalRules; ?></h6>
                  <span class="text-success small pt-1 fw-bold">Rule</span>

                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      Copyright &copy; 2024 <strong><span>M. Yamin - 8TIFB-01 - Teknik Informatika - STMIK Pelita Nusantara</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/script.js"></script>

</body>

</html>