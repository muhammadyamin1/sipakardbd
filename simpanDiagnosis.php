<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role'])) {
    header("Location: index.php?pesan=belum-login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPasien = $_POST['namaPasien'];
    $umurPasien = $_POST['umurPasien'];
    $gejalaTerpilih = $_POST['gejalaTerpilih'];
    $penyakit = $_POST['penyakit'];
    $tanggal = date('Y-m-d'); // Mendapatkan tanggal saat ini

    // Query untuk menyimpan diagnosis
    $sql = "INSERT INTO tb_diagnosis (namaPasien, umur, gejalaTerpilih, penyakit, tanggal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisss", $namaPasien, $umurPasien, $gejalaTerpilih, $penyakit, $tanggal);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $stmt->close();
    $conn->close();
}