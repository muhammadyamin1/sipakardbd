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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Rule</title>
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
            <h1>Rule</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Rule</li>
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
                            <h5 class="card-title">Rule Yang Bertindak Sebagai Mesin Inferensi</h5>
                            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahRuleModal"><i class="bi bi-plus-circle"></i> Tambah Rule</button>
                            <div class="table-responsive">
                                <table id="tabelRule" class=" table display" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="dt-left">ID Rule</th>
                                            <th>Gejala Terpilih</th>
                                            <th>ID Penyakit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan diisi oleh DataTables -->
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

    <!-- Modal Tambah Rule -->
    <div class="modal fade" id="tambahRuleModal" tabindex="-1" aria-labelledby="tambahRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRuleModalLabel">Tambah Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahRuleForm" method="post" action="tambahRuleBaru.php">
                        <div class="mb-3">
                        <label for="idRule" class="form-label">ID Rule</label>
                            <div class="input-group">
                                <span class="input-group-text" id="idRulePrefix">R</span>
                                <input type="number" class="form-control" id="idRule" name="idRule" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gejala Terpilih</label>
                            <!-- Gejala checkbox akan diisi dari database -->
                            <div id="gejalaCheckboxContainer"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penyakit</label>
                            <!-- Penyakit radio button akan diisi dari database -->
                            <div id="penyakitRadioContainer"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Rule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Rule -->
    <div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRuleModalLabel">Edit Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRuleForm" method="post" action="editRule.php">
                        <div class="mb-3">
                            <label for="editRuleId" class="form-label">ID Rule</label>
                            <input type="text" class="form-control" id="editRuleId" name="idRule" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gejala Terpilih</label>
                            <div id="editGejalaCheckboxContainer"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penyakit</label>
                            <div id="editPenyakitRadioContainer"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteRuleModal" tabindex="-1" aria-labelledby="confirmDeleteRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteRuleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus rule ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteRuleBtn">Hapus</button>
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
        $(document).ready(function() {
            var table = $('#tabelRule').DataTable({
                "ajax": "getRuleData.php",
                "columns": [{
                        "data": "idRule"
                    },
                    {
                        "data": "gejalaTerpilih"
                    },
                    {
                        "data": "idPenyakit"
                    },
                    {
                        "data": null,
                        "defaultContent": `
                            <button class="btn btn-sm btn-primary editRule" data-bs-toggle="modal" data-bs-target="#editRuleModal">Edit</button>
                            <button class="btn btn-sm btn-danger hapusRule" data-bs-toggle="modal" data-bs-target="#confirmDeleteRuleModal">Hapus</button>
                        `
                    }
                ],
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: ':not(:eq(3))'
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':not(:eq(3))'
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':not(:eq(3))'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(:eq(3))'
                                }
                            }
                        ]
                    }
                },
                columnDefs: [{
                        "className": "dt-left",
                        "targets": 0
                    },
                    {
                        "type": "natural",
                        "targets": 0
                    }
                ]
            });

            // Load Gejala dan Penyakit
            function loadGejalaPenyakit() {
                // Load gejala
                $.get('getGejala.php', function(data) {
                    var gejalaCheckboxContainer = $('#gejalaCheckboxContainer');
                    gejalaCheckboxContainer.empty();
                    data.forEach(function(gejala) {
                        gejalaCheckboxContainer.append(`
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${gejala.idGejala}" id="gejala${gejala.idGejala}">
                                <label class="form-check-label" for="gejala${gejala.idGejala}">
                                    ${gejala.idGejala} - ${gejala.nama}
                                </label>
                            </div>
                        `);
                    });
                }, 'json');

                // Load penyakit
                $.get('getPenyakit.php', function(data) {
                    var penyakitRadioContainer = $('#penyakitRadioContainer');
                    penyakitRadioContainer.empty();
                    data.forEach(function(penyakit) {
                        penyakitRadioContainer.append(`
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="idPenyakit" value="${penyakit.idPenyakit}" id="penyakit${penyakit.idPenyakit}">
                                <label class="form-check-label" for="penyakit${penyakit.idPenyakit}">
                                    ${penyakit.nama}
                                </label>
                            </div>
                        `);
                    });
                }, 'json');
            }

            // Load gejala dan penyakit saat modal tambah dibuka
            $('#tambahRuleModal').on('shown.bs.modal', function() {
                loadGejalaPenyakit();
            });

            // Validasi sebelum submit form tambah rule
            $('#tambahRuleForm').on('submit', function(event) {
                event.preventDefault();

                var gejalaTerpilih = [];
                $('#gejalaCheckboxContainer input:checked').each(function() {
                    gejalaTerpilih.push($(this).val());
                });

                var idPenyakit = $('#penyakitRadioContainer input:checked').val();

                // Kirim data ke PHP untuk validasi dan penambahan
                $.ajax({
                    url: 'tambahRuleBaru.php',
                    type: 'POST',
                    data: {
                        idRule: $('#idRule').val(),
                        gejalaTerpilih: gejalaTerpilih.join(','),
                        idPenyakit: idPenyakit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'error') {
                            alert(response.message);
                        } else {
                            alert('Rule berhasil ditambahkan.');
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan rule.');
                    }
                });
            });

            // Hapus Rule
            var ruleIdToDelete;

            $('#tabelRule tbody').on('click', '.hapusRule', function() {
                var data = table.row($(this).parents('tr')).data();
                ruleIdToDelete = data.idRule;
            });

            // Event listener untuk tombol konfirmasi hapus
            $('#confirmDeleteRuleBtn').on('click', function() {
                if (ruleIdToDelete) {
                    // Kirim permintaan hapus ke server
                    $.post('hapusRule.php', {
                        idRule: ruleIdToDelete
                    }, function() {
                        $('#confirmDeleteRuleModal').modal('hide');
                        table.ajax.reload();
                    });
                }
            });
        });
    </script>

</body>

</html>