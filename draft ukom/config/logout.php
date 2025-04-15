<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: ../pages/login.php"); // Redirect ke halaman login
exit();
?>
