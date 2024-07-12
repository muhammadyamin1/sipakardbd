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
    $idPenyakit = $_POST['idPenyakit'];
    $nama = $_POST['nama'];
    $deskripsi = trim($_POST['deskripsi']); // Hapus spasi di awal dan akhir

    if (empty($deskripsi)) {
        $deskripsi = '-';
    }

    // Tambahkan huruf 'P' di depan ID Penyakit jika belum ada
    if (substr($idPenyakit, 0, 1) !== 'P') {
        $idPenyakit = 'P' . $idPenyakit;
    }

    // Query untuk menambah data penyakit
    $sql = "INSERT INTO tb_penyakit (idPenyakit, nama, deskripsi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $idPenyakit, $nama, $deskripsi);

    // Eksekusi query
    if ($stmt->execute() === TRUE) {
        // Data penyakit berhasil ditambahkan
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Data penyakit berhasil ditambahkan.',
            'icon' => 'check-circle'
        ];
    } else {
        // Error saat menambahkan penyakit
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Error: Terjadi kesalahan saat menambahkan penyakit.',
            'icon' => 'exclamation-octagon'
        ];
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman sebelumnya
    header("Location: penyakit.php");
    exit();
} catch (mysqli_sql_exception $e) {
    // Tangkap kesalahan SQL
    $errorCode = $e->getCode();
    $errorMessage = $e->getMessage();

    if ($errorCode == 1062) { // Kode error untuk Duplicate entry
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Penyakit dengan ID yang sama sudah ada.',
            'icon' => 'exclamation-octagon'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Error: Terjadi kesalahan saat menambahkan penyakit (' . $errorMessage . ')',
            'icon' => 'exclamation-octagon'
        ];
    }

    // Redirect kembali ke halaman sebelumnya
    header("Location: penyakit.php");
    exit();
}