<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Kita pakai tabel 'users' sesuai yang kita buat di phpMyAdmin tadi
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:dashboard.php");
} else {
    header("location:login.php?pesan=gagal");
}
?>