<?php
include 'dbKoneksi.php';

session_start();

if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?pesan=belum-login");
    exit();
}

if (isset($_GET['idPenyakit'])) {
    $idPenyakit = $_GET['idPenyakit'];

    // Query untuk mendapatkan detail penyakit berdasarkan ID
    $sql = "SELECT * FROM tb_penyakit WHERE idPenyakit = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idPenyakit);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $penyakit = $result->fetch_assoc();
        echo json_encode($penyakit);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'ID Penyakit tidak diberikan']);
}
?>
