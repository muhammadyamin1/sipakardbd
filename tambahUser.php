<?php
// sambungkan ke database
include 'dbKoneksi.php'; // Sesuaikan dengan file koneksi Anda

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
    // Redirect kembali ke halaman pengguna setelah penyimpanan berhasil
    header('Location: kelolaPengguna.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>