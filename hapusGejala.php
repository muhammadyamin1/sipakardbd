<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idGejala = $_POST['idGejala'];

    // Query untuk menghapus gejala berdasarkan ID Gejala
    $sql = "DELETE FROM tb_gejala WHERE idGejala='$idGejala'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
}
