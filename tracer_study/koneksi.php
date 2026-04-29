<?php
// Ambil data otomatis dari tab Variables di Railway
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    // Ini akan membantu memunculkan error jika koneksi gagal
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
