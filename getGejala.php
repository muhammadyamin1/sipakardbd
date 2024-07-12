<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

$sql = "SELECT idGejala, nama FROM tb_gejala ORDER BY CAST(SUBSTRING(idGejala, 2) AS UNSIGNED);";
$result = $conn->query($sql);

$gejala = [];
while ($row = $result->fetch_assoc()) {
    $gejala[] = $row;
}

echo json_encode($gejala);

$conn->close();
