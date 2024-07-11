<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

// Pastikan request adalah GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idGejala'])) {
    $idGejala = $_GET['idGejala'];

    // Query untuk mengambil detail gejala berdasarkan ID Gejala
    $sql = "SELECT * FROM tb_gejala WHERE idGejala = '$idGejala'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data gejala dan kirim sebagai JSON response
        $gejala = $result->fetch_assoc();
        echo json_encode($gejala);
    } else {
        echo json_encode(['error' => 'Gejala tidak ditemukan.']);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
