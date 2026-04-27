<?php
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM alumni WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../style.css">
    <title>Edit Alumni</title>
</head>

<body>

    <div class="header">
        <h2>Edit Data Alumni</h2>
    </div>

    <div class="container">
        <div class="card">

            <form method="POST" action="update_alumni.php">

                <input type="hidden" name="id" value="<?= $d['id']; ?>">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= $d['nama']; ?>">
                </div>

                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?= $d['nim']; ?>">
                </div>

                <div class="form-group">
                    <label>Tahun Masuk</label>
                    <input type="text" name="tahun_masuk" value="<?= $d['tahun_masuk']; ?>">
                </div>

                <div class="form-group">
                    <label>Tanggal Lulus</label>
                    <input type="date" name="tanggal_lulus" value="<?= $d['tanggal_lulus']; ?>">
                </div>

                <div class="form-group">
                    <label>Fakultas</label>
                    <input type="text" name="fakultas" value="<?= $d['fakultas']; ?>">
                </div>

                <div class="form-group">
                    <label>Program Studi</label>
                    <input type="text" name="jurusan" value="<?= $d['jurusan']; ?>">
                </div>

                <button class="button">Update</button>

            </form>

            <br>

            <a class="button" href="alumni.php">Kembali</a>

        </div>
    </div>

</body>

</html>