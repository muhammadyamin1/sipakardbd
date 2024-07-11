<?php
include 'dbKoneksi.php';
session_start();

// Periksa apakah sudah ada sesi dan data yang disimpan
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

try {
    // Ambil data dari form
    $idGejala = $_POST['idGejala'];
    $nama = $_POST['nama'];
    $deskripsi = trim($_POST['deskripsi']); // Hapus spasi di awal dan akhir

    if (empty($deskripsi)) {
        $deskripsi = '-';
    }

    // Tambahkan huruf 'G' di depan ID Gejala jika belum ada
    if (substr($idGejala, 0, 1) !== 'G') {
        $idGejala = 'G' . $idGejala;
    }

    // Query untuk menambah data gejala
    $sql = "INSERT INTO tb_gejala (idGejala, nama, deskripsi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $idGejala, $nama, $deskripsi);

    // Eksekusi query
    if ($stmt->execute() === TRUE) {
        // Data gejala berhasil ditambahkan
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Data gejala berhasil ditambahkan.',
            'icon' => 'check-circle'
        ];
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman sebelumnya
    header("Location: gejala.php");
    exit();
} catch (mysqli_sql_exception $e) {
    // Tangkap kesalahan SQL
    $errorCode = $e->getCode();
    $errorMessage = $e->getMessage();

    if ($errorCode == 1062) { // Kode error untuk Duplicate entry
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Gejala dengan ID yang sama sudah ada.',
            'icon' => 'exclamation-octagon'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Error: Terjadi kesalahan saat menambahkan gejala (' . $errorMessage . ')',
            'icon' => 'exclamation-octagon'
        ];
    }

    // Redirect kembali ke halaman sebelumnya
    header("Location: gejala.php");
    exit();
}