<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

$sql = "SELECT idPenyakit, nama FROM tb_penyakit";
$result = $conn->query($sql);

$penyakit = [];
while ($row = $result->fetch_assoc()) {
    $penyakit[] = $row;
}

echo json_encode($penyakit);

$conn->close();
