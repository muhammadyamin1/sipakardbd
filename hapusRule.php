<?php
include 'dbKoneksi.php';
session_start();

// Validasi role admin
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

// Validasi input idRule
if (!isset($_POST['idRule'])) {
    echo json_encode(['status' => 'error', 'message' => 'Parameter idRule tidak diterima']);
    exit();
}

$idRule = $_POST['idRule'];

// Query untuk menghapus rule berdasarkan idRule
$sql = "DELETE FROM tb_rule WHERE idRule = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idRule);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Rule berhasil dihapus']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus rule: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
