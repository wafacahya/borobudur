<?php

session_start(); // Memulai session

// Hapus semua session
session_unset();
session_destroy();


header("Location: login.php");
exit;

?>


