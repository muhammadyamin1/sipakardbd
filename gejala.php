<?php
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
  $idUserAktif = $_SESSION['idUser'];
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

// Mengambil data dari tb_user
include 'dbKoneksi.php';

$sql = "SELECT idGejala, nama, deskripsi FROM tb_gejala";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gejala</title>
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
      <h1>Gejala</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Gejala</li>
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
              <h5 class="card-title">Gejala Demam Berdarah Dengue</h5>
              <button id="tambahGejala" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#tambahGejalaModal"><i class="bi bi-person-plus"></i> Tambah Gejala</button>
              <div class="table-responsive">
                <table id="tabelGejala" class="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Gejala</th>
                      <th>Nama</th>
                      <th>Deskripsi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                      <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                          <?php $no = 1; ?>
                          <td><?php echo $no;
                              $no++; ?></td>
                          <td><?php echo $row['idGejala']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['deskripsi']; ?></td>
                          <td>
                            <a href="editUserForm.php?id=<?php echo $row['idUser']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            <?php if ($row['idUser'] == $idUserAktif || $row['idUser'] == '14') : ?>
                              <button class="btn btn-danger btn-sm disabled-button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tidak dapat menghapus pengguna atau diri sendiri"><i class="bi bi-trash"></i> Hapus</button>
                            <?php else : ?>
                              <button class="btn btn-danger btn-sm hapusUser" data-id="<?php echo $row['idUser']; ?>"><i class="bi bi-trash"></i> Hapus</button>
                            <?php endif; ?>
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

  <!-- Modal Tambah Gejala -->
  <div class="modal fade" id="tambahGejalaModal" tabindex="-1" aria-labelledby="tambahGejalaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGejalaModalLabel">Tambah Gejala</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tambahGejalaForm" method="post" action="tambahGejala.php">
            <div class="mb-3">
              <label for="idGejala" class="form-label">ID Gejala</label>
              <div class="input-group">
                <span class="input-group-text" id="idGejalaPrefix">G</span>
                <input type="number" class="form-control" id="idGejala" name="idGejala" placeholder="Masukkan angka ID Gejala" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" maxlength="255" required>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tidak wajib (opsional)"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Gejala</button>
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
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script src="assets/vendor/datatables/js/dataTables.js"></script>
  <script src="assets/vendor/datatables/js/dataTables.bootstrap5.js"></script>
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
  <script>
    // Tabel Gejala
    $('#tabelGejala').DataTable({
      layout: {
        topStart: {
          buttons: [
            'copy', 'excel', 'pdf', 'print'
          ]
        }
      }
    });

    // Tombol Tambah Gejala
    document.getElementById('tambahGejala').addEventListener('click', function() {
      var tambahUserModal = new bootstrap.Modal(document.getElementById('tambahUserModal'), {
        keyboard: false
      });
      tambahUserModal.show();
    });

    // Reset form saat modal ditutup
    $('#tambahGejalaModal').on('hidden.bs.modal', function() {
      $('#tambahGejalaForm')[0].reset();
    });

    document.addEventListener('DOMContentLoaded', function() {
      var userIdToDelete;

      document.querySelectorAll('.hapusUser').forEach(function(button) {
        button.addEventListener('click', function() {
          userIdToDelete = this.getAttribute('data-id');
          var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
          deleteModal.show();
        });
      });

      // Event listener untuk tombol konfirmasi hapus
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
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                alert('Pengguna berhasil dihapus.');
                // Reload halaman setelah berhasil menghapus pengguna
                location.reload();
              } else {
                alert('Gagal menghapus pengguna: ' + data.message);
              }
            })
            .catch(error => {
              alert('Terjadi kesalahan: ' + error.message);
            });
        }
      });
    });
  </script>


</body>

</html>