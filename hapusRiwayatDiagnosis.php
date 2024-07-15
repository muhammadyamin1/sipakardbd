<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role'])) {
    header("Location: index.php?pesan=belum-login");
    exit();
}

// Dihapus sesuai ID Diagnosis yang diterima dari permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDiagnosis'])) {

    $idDiagnosis = $_POST['idDiagnosis'];

    // Lakukan query untuk menghapus laporan berdasarkan ID Diagnosis
    $sql = "DELETE FROM tb_diagnosis WHERE idDiagnosis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $idDiagnosis);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil
        $response = array('status' => 'success');
    } else {
        // Jika terjadi kesalahan saat menghapus
        $response = array('status' => 'error', 'message' => 'Gagal menghapus laporan.');
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    // Jika bukan permintaan POST yang valid
    header('HTTP/1.1 400 Bad Request');
    exit();
}