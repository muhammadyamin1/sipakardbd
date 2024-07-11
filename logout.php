<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hentikan sesi
session_destroy();

header("Location: index.php?pesan=sukses-logout");
exit();
