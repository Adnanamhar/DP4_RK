<?php
include "../koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$tahun_masuk = $_POST['tahun_masuk'];
$tanggal_lulus = $_POST['tanggal_lulus'];
$fakultas = $_POST['fakultas'];
$program_studi = $_POST['jurusan'];

mysqli_query($conn, "
UPDATE alumni SET
nama='$nama',
nim='$nim',
tahun_masuk='$tahun_masuk',
tanggal_lulus='$tanggal_lulus',
fakultas='$fakultas',
program_studi='$program_studi'
WHERE id='$id'
");

header("location:alumni.php");
?>