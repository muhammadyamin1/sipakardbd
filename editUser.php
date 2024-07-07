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
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $role = $_POST['role'];

  // Cek apakah email sudah digunakan oleh pengguna lain
  $sql = "SELECT * FROM tb_user WHERE email='$email' AND idUser != '$idUser'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION['error'] = "Email sudah digunakan.";
  } else {
    // Query untuk memperbarui data pengguna
    $sql = "UPDATE tb_user SET nama='$nama', email='$email', role='$role' WHERE idUser='$idUser'";
    if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = "Data berhasil di Edit.";
    } else {
      $_SESSION['error'] = "Tidak dapat mengedit data: " . $conn->error;
    }
  }

  $conn->close();
  header("Location: editUserForm.php?id=$idUser");
  exit();
}
?>