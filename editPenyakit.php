<?php
include 'dbKoneksi.php';
session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

try {
    $idPenyakit = $_POST['idPenyakit'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    if (empty($deskripsi)) {
        $deskripsi = '-';
    }

    // Query untuk mengupdate data penyakit
    $sql = "UPDATE tb_penyakit SET nama = ?, deskripsi = ? WHERE idPenyakit = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $deskripsi, $idPenyakit);

    // Eksekusi query
    if ($stmt->execute() === TRUE) {
        // Data penyakit berhasil diupdate
        $response = ['status' => 'success', 'message' => 'Data penyakit berhasil diperbarui.'];
    } else {
        // Error saat mengupdate penyakit
        $response = ['status' => 'error', 'message' => 'Error: Terjadi kesalahan saat memperbarui penyakit.'];
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();

    // Kirim response
    echo json_encode($response);
} catch (mysqli_sql_exception $e) {
    // Tangkap kesalahan SQL
    $errorMessage = $e->getMessage();
    $response = ['status' => 'error', 'message' => 'Error: Terjadi kesalahan saat memperbarui penyakit (' . $errorMessage . ')'];
    echo json_encode($response);
}
