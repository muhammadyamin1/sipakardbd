<?php
include 'dbKoneksi.php';
session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idGejala = $_POST['editGejalaId'];
    $nama = $_POST['editGejalaNama'];
    $deskripsi = $_POST['editGejalaDeskripsi'];

    if (empty($deskripsi)) {
        $deskripsi = '-';
    }

    // Query untuk mengupdate gejala berdasarkan ID
    $sql = "UPDATE tb_gejala SET nama='$nama', deskripsi='$deskripsi' WHERE idGejala='$idGejala'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
