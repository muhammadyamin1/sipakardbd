<?php
include 'dbKoneksi.php';
session_start();

// Periksa apakah sudah ada sesi dan data yang disimpan
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header("Location: index.php?pesan=belum-login");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idUser = $_POST['idUser'];

  // Query untuk menghapus pengguna berdasarkan ID
  $sql = "DELETE FROM tb_user WHERE idUser='$idUser'";

  if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
  }

  $conn->close();
}
