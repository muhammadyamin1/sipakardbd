<?php
include 'dbKoneksi.php';
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
}else{
  header("Location: index.php?pesan=belum-login");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idUser = $_POST['idUser'];

  // Query untuk menghapus pengguna berdasarkan ID
  $sql = "DELETE FROM tb_user WHERE idUser='$idUser'";

  if ($conn->query($sql) === TRUE) {
    echo 'success';
  } else {
    echo 'error: ' . $conn->error;
  }

  $conn->close();
}
?>