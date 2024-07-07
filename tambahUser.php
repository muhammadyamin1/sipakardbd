<?php
include 'dbKoneksi.php';
session_start();
// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $nama = $_SESSION['nama'];
  $role = $_SESSION['role'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Hash password menggunakan SHA-256
  $hashed_password = hash('sha256', $password);

  // query untuk menyimpan data pengguna
  $sql = "INSERT INTO tb_user (nama, email, password, role) VALUES ('$nama', '$email', '$hashed_password', '$role')";

  if ($conn->query($sql) === TRUE) {
    // Pesan sukses disimpan ke dalam session
    $_SESSION['alert'] = array(
      'type' => 'success',
      'message' => 'Pengguna berhasil ditambahkan.'
    );
    // Redirect kembali ke halaman pengguna setelah penyimpanan berhasil
    header('Location: kelolaPengguna.php');
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>