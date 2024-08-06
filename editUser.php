<?php
include 'dbKoneksi.php';
session_start();

// Periksa apakah sudah ada sesi dan data yang disimpan
if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
  $idUserAktif = $_SESSION['idUser'];
} else {
  header("Location: index.php?pesan=belum-login");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idUser = $_POST['idUser'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Ambil role dan email lama dari database
  $sql = "SELECT role, email FROM tb_user WHERE idUser='$idUser'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $currentRole = $row['role'];
  $currentEmail = $row['email'];

  // Validasi tambahan untuk mencegah admin mengubah data Super User
  if ($idUser == '14' && $_SESSION['idUser'] != '14') {
    $_SESSION['error'] = "Anda tidak diizinkan mengubah data Super Admin.";
    $_SESSION['editUserFormValues'] = [
      'idUser' => $idUser,
      'nama' => $nama,
      'email' => $email,
      'role' => $role
    ];
    header("Location: editUserForm.php");
    exit();
  }

  // Tentukan role baru berdasarkan idUser dan sesi
  if ($idUser == '14') {
    $role = 'admin'; // pastikan idUser 14 tetap admin
  } else if ($_SESSION['idUser'] == '14' && isset($_POST['role'])) {
    $role = $_POST['role']; // admin dengan idUser 14 bisa mengubah role
  } else {
    $role = $currentRole; // selain itu, role tetap tidak berubah
  }

  // Tentukan email baru berdasarkan idUser dan sesi
  if ($idUser == $idUserAktif || $_SESSION['idUser'] == '14' && isset($_POST['email'])) {
    $email = $_POST['email'];
  } else {
    $email = $currentEmail;
  }

  // Cek apakah email sudah digunakan oleh pengguna lain
  $sql = "SELECT * FROM tb_user WHERE email='$email' AND idUser != '$idUser'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION['error'] = "Email sudah digunakan.";
  } else {
    // Jika password diisi, periksa apakah konfirmasi password cocok
    if (!empty($password) && $password === $confirm_password) {
      $hashed_password = hash('sha256', $password);
      $sql = "UPDATE tb_user SET nama='$nama', email='$email', role='$role', password='$hashed_password' WHERE idUser='$idUser'";
    } else if (empty($password)) {
      $sql = "UPDATE tb_user SET nama='$nama', email='$email', role='$role' WHERE idUser='$idUser'";
    } else {
      $_SESSION['error'] = "Password dan konfirmasi password tidak cocok.";
      $_SESSION['editUserFormValues'] = [
        'idUser' => $idUser,
        'nama' => $nama,
        'email' => $email,
        'role' => $role
      ];
      header("Location: editUserForm.php");
      exit();
    }

    if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = "Data berhasil di Edit.";
    } else {
      $_SESSION['error'] = "Tidak dapat mengedit data: " . $conn->error;
    }
  }

  $conn->close();
  $_SESSION['editUserFormValues'] = [
    'idUser' => $idUser,
    'nama' => $nama,
    'email' => $email,
    'role' => $role
  ];
  header("Location: editUserForm.php");
  exit();
}
