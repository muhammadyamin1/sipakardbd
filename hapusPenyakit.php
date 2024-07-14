<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPenyakit = $_POST['idPenyakit'];

    // Query untuk menghapus penyakit berdasarkan ID Penyakit
    $sql = "DELETE FROM tb_penyakit WHERE idPenyakit=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idPenyakit);

    try {
        $stmt->execute();
        echo json_encode(['status' => 'success']);
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451 || $e->getSqlState() == '23000') {
            echo json_encode(['status' => 'error', 'message' => 'Penyakit ini masih terhubung dengan rule dan tidak bisa dihapus. Hapus penyakit pada rule untuk menghapus kategori penyakit ini.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    $stmt->close();
    $conn->close();
}