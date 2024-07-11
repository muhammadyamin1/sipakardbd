<?php
include 'dbKoneksi.php';
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (!isset($_SESSION['nama']) || !isset($_SESSION['role'])) {
  header("Location: index.php?pesan=belum-login");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  // Query untuk memeriksa apakah email sudah ada
  $sql = "SELECT * FROM tb_user WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo json_encode(['exists' => true]);
  } else {
    echo json_encode(['exists' => false]);
  }

  $conn->close();
}
