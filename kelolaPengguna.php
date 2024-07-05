<?php
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

// Mengambil data dari tb_user
include 'dbKoneksi.php';

$sql = "SELECT idUser, nama, email, role FROM tb_user";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kelola Data Pengguna</title>
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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="beranda.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Sistem Pakar DBD</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profil.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo ucwords($nama); ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                <?php echo ucwords($nama); ?>
              </h6>
              <span>
                <?php echo ucfirst($role); ?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profilSaya.php">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <?php include 'sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Kelola Data Pengguna</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="kelolaPengguna.php">Kelola Data Pengguna</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Pengguna Tersedia</h5>
              <button id="tambahUser" class="btn btn-primary btn-sm mb-4"><i class="bi bi-person-plus"></i> Tambah Pengguna</button>
              <table id="userTable" class="table datatable" style="width:100%">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                      <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                          <button class="btn btn-primary btn-sm">Edit</button>
                          <button class="btn btn-danger btn-sm hapusUser" data-id="<?php echo $row['idUser']; ?>">Hapus</button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="4">Tidak ada data.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
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

  <!-- Modal Tambah Pengguna -->
  <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tambahUserForm" method="POST" action="tambahUser.php">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div id="emailFeedback" class="invalid-feedback">
                Email sudah digunakan.
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text" id="togglePassword">
                  <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
              </div>
            </div>
            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus pengguna ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
        </div>
      </div>
    </div>
  </div>

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
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var userIdToDelete;

      // Tambahkan event listener untuk tombol hapus
      document.querySelectorAll('.hapusUser').forEach(function(button) {
        button.addEventListener('click', function() {
          userIdToDelete = this.getAttribute('data-id');
          var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
          deleteModal.show();
        });
      });

      // Tambahkan event listener untuk tombol konfirmasi hapus
      document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (userIdToDelete) {
          // Kirim permintaan hapus ke server
          fetch('hapusUser.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'idUser=' + userIdToDelete
            })
            .then(response => response.text())
            .then(data => {
              if (data === 'success') {
                // Reload halaman setelah berhasil menghapus pengguna
                location.reload();
              } else {
                alert('Gagal menghapus pengguna.');
              }
            });
        }
      });

      const emailInput = document.getElementById('email');
      const emailFeedback = document.getElementById('emailFeedback');
      const submitButton = document.querySelector('#tambahUserForm button[type="submit"]');

      emailInput.addEventListener('blur', function() {
        const email = emailInput.value;

        if (email) {
          fetch('cekEmail.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'email=' + encodeURIComponent(email)
            })
            .then(response => response.json())
            .then(data => {
              if (data.exists) {
                emailInput.classList.add('is-invalid');
                emailFeedback.style.display = 'block';
                submitButton.disabled = true;
              } else {
                emailInput.classList.remove('is-invalid');
                emailFeedback.style.display = 'none';
                submitButton.disabled = false;
              }
            });
        }
      });
    });
  </script>


</body>

</html>