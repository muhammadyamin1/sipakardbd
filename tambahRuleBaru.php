<?php
include 'dbKoneksi.php';
session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

// Validasi dan ambil data dari form
$idRule = $_POST['idRule'];
$idPenyakit = $_POST['idPenyakit'];
$gejalaTerpilih = isset($_POST['gejalaTerpilih']) ? $_POST['gejalaTerpilih'] : '';

if (empty($gejalaTerpilih)) {
    echo json_encode(['status' => 'error', 'message' => 'Gejala tidak boleh kosong.']);
    exit();
}

// Tambahkan huruf 'R' di depan ID Rule jika belum ada
if (substr($idRule, 0, 1) !== 'R') {    
    $idRule = 'R' . $idRule;
}

// Validasi keberadaan rule dengan idRule yang sama
$sqlCheckDuplicateIdRule = "SELECT COUNT(*) as count FROM tb_rule WHERE idRule = ?";
$stmtCheckDuplicateIdRule = $conn->prepare($sqlCheckDuplicateIdRule);
$stmtCheckDuplicateIdRule->bind_param("s", $idRule);
$stmtCheckDuplicateIdRule->execute();
$resultCheckDuplicateIdRule = $stmtCheckDuplicateIdRule->get_result();
$rowCheckDuplicateIdRule = $resultCheckDuplicateIdRule->fetch_assoc();

if ($rowCheckDuplicateIdRule['count'] > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Rule dengan ID Rule yang sama sudah ada.']);
    exit();
}

// Validasi Rule Baru
$sqlCheck = "SELECT COUNT(*) as count FROM tb_rule WHERE gejalaTerpilih = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $gejalaTerpilih);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();
$rowCheck = $resultCheck->fetch_assoc();

if ($rowCheck['count'] > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Rule dengan gejala yang sama sudah ada.']);
    exit();
}

$sql = "INSERT INTO tb_rule (idRule, gejalaTerpilih, idPenyakit) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $idRule, $gejalaTerpilih, $idPenyakit);

if ($stmt->execute() === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: Terjadi kesalahan saat menambahkan rule.']);
}

$stmt->close();
$conn->close();
