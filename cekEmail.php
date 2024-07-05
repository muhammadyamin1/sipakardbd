<?php
include 'dbKoneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  // Query untuk memeriksa apakah email sudah ada
  $sql = "SELECT * FROM tb_user WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo json_encode(['exists' => true]);
  } else {
    echo json_encode(['exists' => false]);
  }

  $conn->close();
}
?>