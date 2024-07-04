<?php
require_once('dbKoneksi.php');

$username = htmlspecialchars($_POST['yourUsername']);
$password = htmlspecialchars($_POST['yourPassword']);

$hashed_password = hash('sha256', $password);

$sql = "SELECT * FROM tb_user WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Ambil data user dari hasil query
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $role = $row['role'];
    // Login berhasil
    session_start();
    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role;
    $_SESSION['login_success'] = true;
    header("Location: beranda.php");
    exit();
} else {
    // Login gagal
    header("Location: index.php?pesan=gagal-login&email=$username");
}
$stmt->close();
?>