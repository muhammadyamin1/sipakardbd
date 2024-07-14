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

// Ambil data gejala
$sqlGejala = "SELECT idGejala, nama, deskripsi FROM tb_gejala ORDER BY CAST(SUBSTRING(idGejala, 2) AS UNSIGNED);";
$resultGejala = $conn->query($sqlGejala);

$gejalaList = [];
if ($resultGejala->num_rows > 0) {
    while ($row = $resultGejala->fetch_assoc()) {
        $gejalaList[] = $row;
    }
} else {
    echo "0 results";
}

// Ambil data rule
$sqlRule = "SELECT idRule, gejalaTerpilih, idPenyakit FROM tb_rule";
$resultRule = $conn->query($sqlRule);

$ruleList = [];
if ($resultRule->num_rows > 0) {
    while ($row = $resultRule->fetch_assoc()) {
        $ruleList[] = $row;
    }
} else {
    echo "0 results";
}

// Ambil data penyakit
$sqlPenyakit = "SELECT idPenyakit, nama, deskripsi FROM tb_penyakit";
$resultPenyakit = $conn->query($sqlPenyakit);

$penyakitList = [];
if ($resultPenyakit->num_rows > 0) {
    while ($row = $resultPenyakit->fetch_assoc()) {
        $penyakitList[$row['idPenyakit']] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Diagnosis</title>
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
    <style>
        /* Ukuran kertas A4 */
        @media (min-width: 992px) {
            .card {
                width: 21cm;
                height: auto;
                padding: 20px;
                margin-left: 25px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }

        /* Responsif di mobile */
        @media (max-width: 991px) {
            .card {
                width: auto;
                height: auto;
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <?php include 'sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Diagnosis</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Diagnosis</li>
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
                            <h5 class="card-title">Form Diagnosis Penyakit Demam Berdarah Dengue</h5>
                            <form id="diagnosisForm">
                                <div class="mb-3">
                                    <label for="namaPasien" class="form-label">Nama Pasien</label>
                                    <input type="text" class="form-control" id="namaPasien" name="namaPasien" maxlength="100" required>
                                    <div class="invalid-feedback">
                                        Nama Pasien harus diisi dan maksimal 100 karakter.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="umurPasien" class="form-label">Umur Pasien</label>
                                    <input type="number" class="form-control" id="umurPasien" name="umurPasien" max="150" required>
                                    <div class="invalid-feedback">
                                        Umur Pasien harus diisi dan maksimal 150 tahun.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Gejala</div>
                                    <div>
                                        <?php foreach ($gejalaList as $gejala) : ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $gejala['idGejala']; ?>" id="gejala<?= $gejala['idGejala']; ?>">
                                                <label class="form-check-label" for="gejala<?= $gejala['idGejala']; ?>">
                                                    <?= $gejala['idGejala']; ?> - <?= $gejala['nama']; ?>
                                                </label>
                                                <button type="button" class="btn btn-info btn-sm" onclick="showGejalaInfo('<?= addslashes($gejala['deskripsi']); ?>')">Info</button>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="invalid-feedback">
                                            Pilih minimal satu gejala.
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-2" onclick="validateAndSubmit()">Lakukan Diagnosis</button>
                            </form>
                            <div id="hasilDiagnosis" class="mt-5"></div>
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

    <!-- Modal Deskripsi Gejala -->
    <div class="modal fade" id="gejalaModal" tabindex="-1" aria-labelledby="gejalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gejalaModalLabel">Deskripsi Gejala</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Deskripsi gejala akan dimasukkan di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <script>
        const gejalaDescriptions = <?php echo json_encode($gejalaList); ?>;
        const ruleList = <?php echo json_encode($ruleList); ?>;
        const penyakitList = <?php echo json_encode($penyakitList); ?>;

        function showGejalaInfo(deskripsi) {
            document.getElementById('modalBody').innerText = deskripsi;
            const gejalaModal = new bootstrap.Modal(document.getElementById('gejalaModal'));
            gejalaModal.show();
        }

        function validateAndSubmit() {
            var namaPasienInput = document.getElementById('namaPasien');
            var umurPasienInput = document.getElementById('umurPasien');

            // Tambahkan event listener untuk input nama pasien
            namaPasienInput.addEventListener('input', function() {
                if (namaPasienInput.value.trim() === '' || namaPasienInput.value.length > 100) {
                    namaPasienInput.classList.add('is-invalid');
                    namaPasienInput.classList.remove('is-valid');
                } else {
                    namaPasienInput.classList.remove('is-invalid');
                    namaPasienInput.classList.add('is-valid');
                }
            });

            // Tambahkan event listener untuk input umur pasien
            umurPasienInput.addEventListener('input', function() {
                if (umurPasienInput.value.trim() === '' || umurPasienInput.value > 150) {
                    umurPasienInput.classList.add('is-invalid');
                    umurPasienInput.classList.remove('is-valid');
                } else {
                    umurPasienInput.classList.remove('is-invalid');
                    umurPasienInput.classList.add('is-valid');
                }
            });

            // Validasi awal saat tombol submit ditekan
            if (namaPasienInput.value.trim() === '' || namaPasienInput.value.length > 100) {
                namaPasienInput.classList.add('is-invalid');
                namaPasienInput.classList.remove('is-valid');
                namaPasienInput.focus();
                return;
            } else {
                namaPasienInput.classList.remove('is-invalid');
                namaPasienInput.classList.add('is-valid');
            }

            if (umurPasienInput.value.trim() === '' || umurPasienInput.value > 150) {
                umurPasienInput.classList.add('is-invalid');
                umurPasienInput.classList.remove('is-valid');
                umurPasienInput.focus();
                return;
            } else {
                umurPasienInput.classList.remove('is-invalid');
                umurPasienInput.classList.add('is-valid');
            }

            // Lakukan diagnosa jika semua validasi berhasil
            if (namaPasienInput.checkValidity() && umurPasienInput.checkValidity()) {
                deteksiPenyakit();
            }
        }

        function deteksiPenyakit() {
            const namaPasien = document.getElementById('namaPasien').value;
            const umurPasien = document.getElementById('umurPasien').value;
            const checkboxes = document.querySelectorAll('.form-check-input');
            let gejalaTerpilih = [];

            // Periksa apakah ada gejala yang dipilih
            let isValid = false;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    gejalaTerpilih.push(checkbox.value);
                    isValid = true;
                }
            });

            // Jika tidak ada gejala yang dipilih, tampilkan alert dan hentikan eksekusi fungsi
            if (!isValid) {
                alert('Pilih setidaknya satu gejala sebelum melakukan diagnosis.');
                return;
            }

            let hasil = '<h3>Hasil Diagnosis:</h3>';
            let foundPenyakit = false;
            let penyakitDitemukan = '';

            ruleList.forEach(rule => {
                const gejalaRule = rule.gejalaTerpilih.split(',');
                if (gejalaTerpilih.length === gejalaRule.length && gejalaRule.every(gr => gejalaTerpilih.includes(gr))) {
                    const penyakit = penyakitList[rule.idPenyakit];
                    hasil += `<div class="alert alert-info" role="alert"><h4 class="alert-heading">${penyakit.nama}</h4>`;
                    hasil += `<p>Deskripsi: ${penyakit.deskripsi}</p><hr class="mb-0"></div>`;
                    if (penyakit.deskripsi === '-') {
                        penyakitDitemukan = penyakit.nama; // Hanya nama penyakit jika deskripsi '-' 
                    } else {
                        penyakitDitemukan = `${penyakit.nama} - ${penyakit.deskripsi}`; // Gabungan nama dan deskripsi
                    }
                    foundPenyakit = true;
                }
            });

            if (!foundPenyakit) {
                hasil += '<p>Sistem tidak dapat menemukan pola gejala yang sesuai dengan kondisi yang ada.</p>';
            }

            document.getElementById('hasilDiagnosis').innerHTML = hasil;

            // Simpan diagnosis ke database
            if (foundPenyakit) {
                let gejalaTerpilihNama = [];
                gejalaDescriptions.forEach(gejala => {
                    if (gejalaTerpilih.includes(gejala.idGejala)) {
                        gejalaTerpilihNama.push(gejala.nama);
                    }
                });
                simpanDiagnosis(namaPasien, umurPasien, gejalaTerpilihNama.join(','), penyakitDitemukan);
            }

            function simpanDiagnosis(namaPasien, umurPasien, gejalaTerpilihNama, penyakit) {
                fetch('simpanDiagnosis.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `namaPasien=${encodeURIComponent(namaPasien)}&umurPasien=${encodeURIComponent(umurPasien)}&gejalaTerpilih=${encodeURIComponent(gejalaTerpilihNama)}&penyakit=${encodeURIComponent(penyakit)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log('Diagnosis berhasil disimpan.');
                            // Reset form atau elemen-elemen input
                            document.getElementById('diagnosisForm').reset();
                            document.getElementById('namaPasien').classList.remove('is-valid', 'is-invalid');
                            document.getElementById('umurPasien').classList.remove('is-valid', 'is-invalid');
                        } else {
                            console.error('Gagal menyimpan diagnosis: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan: ' + error.message);
                    });
            }
        }
    </script>

</body>

</html>