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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $idUser = $_POST['idUser'];
    $sql = "SELECT * FROM tb_user WHERE idUser = '$idUser'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

$vidUser = isset($_SESSION['editUserFormValues']['nama']) ? $_SESSION['editUserFormValues']['idUser'] : '';
$vnama = isset($_SESSION['editUserFormValues']['nama']) ? $_SESSION['editUserFormValues']['nama'] : '';
$vemail = isset($_SESSION['editUserFormValues']['email']) ? $_SESSION['editUserFormValues']['email'] : '';
$vrole = isset($_SESSION['editUserFormValues']['role']) ? $_SESSION['editUserFormValues']['role'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Data Pengguna</title>
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
            <h1>Edit Data Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="kelolaPengguna.php">Kelola Data Pengguna</a></li>
                    <li class="breadcrumb-item active">Edit Data Pengguna</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="editUser.php" method="post">
                        <?php if (isset($_SESSION['editUserFormValues'])) : ?>
                            <?php if ($idUserAktif == '14') : ?>
                                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($vidUser); ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($vnama); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($vemail); ?>" required>
                                </div>
                                <?php if (htmlspecialchars($vidUser) != '14') : ?>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="admin" <?php if (htmlspecialchars($vrole) == 'admin') echo 'selected'; ?>>Admin</option>
                                                <option value="user" <?php if (htmlspecialchars($vrole) == 'user') echo 'selected'; ?>>User</option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>
                            <?php elseif (htmlspecialchars($vidUser) == $idUserAktif) : ?>
                                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($vidUser); ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($vnama); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($vemail); ?>" required>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($vidUser); ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($vnama); ?>" required>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if ($idUserAktif == '14') : ?>
                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                                </div>
                                <?php if ($row['idUser'] != '14') : ?>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                <option value="user" <?php if ($row['role'] == 'user') echo 'selected'; ?>>User</option>
                                            </select>
                                        </div>
                                    <?php }  ?>
                                <?php endif; ?>
                            <?php elseif ($row['idUser'] == $idUserAktif) : ?>
                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="idUser" value="<?php echo $row['idUser']; ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="new-password">
                        </div>
                        <div class="d-flex">
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                                <a href="kelolaPengguna.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-save"></i> Simpan Perubahan</button>
                        </div>
                    </form>

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
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script>
        // Mengosongkan kolom password saat halaman dimuat
        window.addEventListener('load', function() {
            document.getElementById('password').value = '';
            document.getElementById('confirm_password').value = '';
        });
    </script>

</body>

</html>