<?php
session_start();
// Proteksi Login: Jika tidak ada session user, lempar ke login.php
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    exit();
}
$data_excel = $_SESSION['excel'] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../style.css">
    <title>Tambah Alumni</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="header">Sistem Pelacakan Alumni</div>
    <div class="container">
        <div class="card">
            <div class="title">Tambah Data Alumni</div>
            <form method="POST" action="simpan_alumni.php">
                <div class="grid-container">
                    <div class="left-col">
                        <div class="form-group"><label>Nama</label><input type="text" name="nama" required value="<?= $data_excel['nama'] ?? '' ?>"></div>
                        <div class="form-group"><label>NIM</label><input type="text" name="nim" required value="<?= $data_excel['nim'] ?? '' ?>"></div>
                        <div class="form-group"><label>Tahun Masuk</label><input type="number" name="tahun_masuk" required value="<?= $data_excel['tahun_masuk'] ?? '' ?>"></div>
                        <div class="form-group"><label>Tanggal Lulus</label><input type="date" name="tanggal_lulus" required value="<?= isset($data_excel['tanggal_lulus']) ? date('Y-m-d', strtotime($data_excel['tanggal_lulus'])) : '' ?>"></div>
                        <div class="form-group"><label>Fakultas</label><input type="text" name="fakultas" required value="<?= $data_excel['fakultas'] ?? '' ?>"></div>
                        <div class="form-group"><label>Program Studi</label><input type="text" name="jurusan" required value="<?= $data_excel['jurusan'] ?? '' ?>"></div>
                        <div class="form-group"><label>Email</label><input type="email" name="email"></div>
                        <div class="form-group"><label>No HP</label><input type="text" name="no_hp"></div>
                    </div>
                    <div class="right-col">
                        <div class="form-group"><label>LinkedIn</label><input type="text" name="linkedin"></div>
                        <div class="form-group"><label>Instagram</label><input type="text" name="ig"></div>
                        <div class="form-group"><label>Facebook</label><input type="text" name="fb"></div>
                        <div class="form-group"><label>Tiktok</label><input type="text" name="tiktok"></div>
                        <div class="form-group"><label>Tempat Bekerja</label><input type="text" name="tempat_kerja"></div>
                        <div class="form-group"><label>Posisi</label><input type="text" name="posisi"></div>
                        <div class="form-group"><label>Jenis Instansi</label>
                            <select name="jenis_instansi">
                                <option value="Swasta">Swasta</option>
                                <option value="PNS">PNS</option>
                                <option value="Wirausaha">Wirausaha</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Sosmed Tempat Bekerja</label><input type="text" name="sosmed_kantor"></div>
                    </div>
                </div>
                <div class="form-group"><label>Alamat Bekerja</label><textarea name="alamat_kerja"></textarea></div>
                <button class="button" type="submit">Simpan Data</button>
            </form>
            <br><a class="button" href="alumni.php">Kembali</a>
        </div>
    </div>
</body>

</html>