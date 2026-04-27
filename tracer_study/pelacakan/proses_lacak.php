<?php
session_start();
include "./tracer_study/koneksi.php";

if (!isset($_GET['id'])) {
    header("location:./tracer_study/pelacakan/pelacakan.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// 1. Ambil data alumni
$query = mysqli_query($conn, "SELECT * FROM alumni WHERE id='$id'");
$alumni = mysqli_fetch_assoc($query);

if (!$alumni) {
    header("location:pelacakan.php");
    exit;
}

// 2. Simulasi Data Otomatis (OSINT Simulation)
$nama = $alumni['nama'];
$user_clean = strtolower(str_replace(" ", "", $nama));

$email    = $user_clean . "@email.com";
$no_hp    = "0812" . rand(10000000, 99999999);
$linkedin = "https://linkedin.com/in/" . $user_clean;
$ig       = "@" . $user_clean;
$fb       = "facebook.com/" . $user_clean;
$tiktok   = "@" . $user_clean;

// 3. Simulasi Status Pekerjaan (Random)
$rand = rand(1, 100);
if ($rand <= 60) {
    $status = "Terdeteksi";
    $persentase = 100;
    $jenis = "Swasta"; // atau random lainnya
} elseif ($rand <= 85) {
    $status = "Perlu Verifikasi";
    $persentase = 60;
    $jenis = "Belum Diketahui";
} else {
    $status = "Tidak Ditemukan";
    $persentase = 0;
    $jenis = "-";
}

$persentase = 100;

// 4. Update langsung ke Tabel Alumni
// Kita tidak perlu tabel 'hasil_pelacakan' agar data 140.000 kamu tetap di satu tempat
$update_sql = "UPDATE alumni SET 
    email = '$email',
    no_hp = '$no_hp',
    linkedin = '$linkedin',
    ig = '$ig',
    fb = '$fb',
    tiktok = '$tiktok',
    tempat_kerja = '$tempat',
    posisi = '$posisi',
    jenis_instansi = '$jenis',
    status = '$status',
    persentase = '$persentase'
    WHERE id = '$id'";

if (mysqli_query($conn, $update_sql)) {
    // Kembali ke halaman pelacakan dengan pesan sukses
    header("location:pelacakan.php?pesan=berhasil_lacak");
} else {
    echo "Gagal update: " . mysqli_error($conn);
}
