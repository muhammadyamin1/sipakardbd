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
    $sql = "DELETE FROM tb_penyakit WHERE idPenyakit='$idPenyakit'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
}
