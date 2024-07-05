<?php
include 'dbKoneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idUser = $_POST['idUser'];

  // Query untuk menghapus pengguna berdasarkan ID
  $sql = "DELETE FROM tb_user WHERE idUser='$idUser'";

  if ($conn->query($sql) === TRUE) {
    echo 'success';
  } else {
    echo 'error: ' . $conn->error;
  }

  $conn->close();
}
?>