<?php
session_start();
include "../koneksi.php";

function generateSearchLinks($nama, $prodi)
{
    $keyword = urlencode($nama . " " . $prodi . " UMM");

    return [
        "linkedin" => "https://www.linkedin.com/search/results/all/?keywords=$keyword",
        "instagram" => "https://www.instagram.com/explore/tags/$keyword/",
        "facebook" => "https://www.facebook.com/search/top?q=$keyword",
        "tiktok" => "https://www.tiktok.com/search?q=$keyword",
        "google" => "https://www.google.com/search?q=$keyword",
        "scholar" => "https://scholar.google.com/scholar?q=$keyword"
    ];
}

$search = $_GET['search'] ?? "";

// PAGINATION
$limit = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($halaman - 1) * $limit;

// QUERY DATA
$data = mysqli_query($conn, "SELECT * FROM alumni 
WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' 
LIMIT $offset, $limit");

// TOTAL DATA
$total_data = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT COUNT(*) as total FROM alumni 
WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'
"))['total'];

$total_halaman = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../style.css">
    <title>Data Alumni</title>
</head>

<body>

    <div class="wrapper">

        <div class="sidebar">
            <h2>Menu</h2>
            <a href="../dashboard.php">Dashboard</a>
            <a href="./alumni.php" class="active">Data Alumni</a>
            <a href="../pelacakan/pelacakan.php">Pelacakan</a>
            <a href="../hasil/hasil_pelacakan.php">Hasil</a>
        </div>

        <div class="main">

            <div class="top-header">
                Data Alumni
            </div>

            <div class="card">

                <form class="search">
                    <input type="text" name="search" placeholder="Cari..." value="<?= $search ?>">
                    <button class="btn btn-primary">Cari</button>
                </form>

                <a href="tambah_alumni.php" class="btn btn-primary">+ Tambah</a>

                <table>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Tracking</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                    <?php while ($d = mysqli_fetch_assoc($data)):
                        $links = generateSearchLinks($d['nama'], $d['program_studi']);
                    ?>
                        <tr>
                            <td><b><?= $d['nama'] ?></b><br><small><?= $d['email'] ?></small></td>
                            <td><?= $d['nim'] ?></td>
                            <td><?= $d['program_studi'] ?></td>
                            <td>
                                <a href="<?= $links['linkedin'] ?>" target="_blank">LinkedIn</a> |
                                <a href="<?= $links['instagram'] ?>" target="_blank">IG</a> |
                                <a href="<?= $links['facebook'] ?>" target="_blank">FB</a> |
                                <a href="<?= $links['tiktok'] ?>" target="_blank">TikTok</a> |
                                <a href="<?= $links['google'] ?>" target="_blank">Google</a>
                            </td>
                            <td>
                                <?php if ($d['status'] == 'Terdeteksi'): ?>
                                    <span class="badge success">Active</span>
                                <?php else: ?>
                                    <span class="badge danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_alumni.php?id=<?= $d['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus_alumni.php?id=<?= $d['id'] ?>" class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                </table>

                <div class="pagination">

                    <?php if ($halaman > 1): ?>
                        <a href="?halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>">← Prev</a>
                    <?php else: ?>
                        <span class="disabled">← Prev</span>
                    <?php endif; ?>

                    <span class="active"><?= $halaman ?> / <?= $total_halaman ?></span>

                    <?php if ($halaman < $total_halaman): ?>
                        <a href="?halaman=<?= $halaman + 1 ?>&search=<?= urlencode($search) ?>">Next →</a>
                    <?php else: ?>
                        <span class="disabled">Next →</span>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>