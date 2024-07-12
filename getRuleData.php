<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

$sql = "SELECT idRule, gejalaTerpilih, idPenyakit FROM tb_rule";
$result = $conn->query($sql);

$rules = [];
while ($row = $result->fetch_assoc()) {
    $rules[] = $row;
}

$response = [
    "data" => $rules
];

echo json_encode($response);

$conn->close();
