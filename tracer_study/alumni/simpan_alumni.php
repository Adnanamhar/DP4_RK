<?php
include "../koneksi.php";

// 1. Tangkap semua data dari form (Pastikan nama di $_POST sama dengan name di HTML)
$nama           = $_POST['nama'];
$nim            = $_POST['nim'];
$tahun_masuk    = $_POST['tahun_masuk'];
$tanggal_lulus  = $_POST['tanggal_lulus'];
$fakultas       = $_POST['fakultas'];
$jurusan        = $_POST['jurusan'];
$email          = $_POST['email'];
$no_hp          = $_POST['no_hp'];
$linkedin       = $_POST['linkedin'];
$ig             = $_POST['ig'];
$fb             = $_POST['fb'];
$tiktok         = $_POST['tiktok'];
$tempat_kerja   = $_POST['tempat_kerja'];
$alamat_kerja   = $_POST['alamat_kerja'];
$posisi         = $_POST['posisi'];
$jenis_instansi = $_POST['jenis_instansi'];
$sosmed_kantor  = $_POST['sosmed_kantor'];

// 2. Query INSERT (Harus Sinkron antara kolom dan variabel)
$query = "INSERT INTO alumni (
    nama, nim, tahun_masuk, tanggal_lulus, fakultas, program_studi, 
    email, no_hp, linkedin, ig, fb, tiktok, 
    tempat_kerja, alamat_kerja, posisi, jenis_instansi, sosmed_kantor
) VALUES (
    '$nama', '$nim', '$tahun_masuk', '$tanggal_lulus', '$fakultas', '$jurusan', 
    '$email', '$no_hp', '$linkedin', '$ig', '$fb', '$tiktok', 
    '$tempat_kerja', '$alamat_kerja', '$posisi', '$jenis_instansi', '$sosmed_kantor'
)";

// 3. Eksekusi
if (mysqli_query($conn, $query)) {
    header("location:alumni.php");
} else {
    // Ini buat ngecek kalau ada error SQL lagi
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}