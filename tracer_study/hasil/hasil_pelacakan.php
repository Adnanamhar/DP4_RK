<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit();
}

include "../koneksi.php";

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
$limit = 50;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($halaman - 1) * $limit;

$query_base = "FROM alumni 
WHERE status='Terdeteksi' 
AND (nama LIKE '%$search%' OR nim LIKE '%$search%' OR tempat_kerja LIKE '%$search%')";

$data = mysqli_query($conn, "SELECT * $query_base ORDER BY id DESC LIMIT $offset, $limit");

$total_query = mysqli_query($conn, "SELECT COUNT(*) as total $query_base");
$total_data = mysqli_fetch_assoc($total_query)['total'];
$total_halaman = ceil($total_data / $limit);

function tampilLink($url)
{
    if (!$url || $url == "-") return "-";
    $link = (strpos($url, 'http') === false) ? "https://" . $url : $url;
    return "<a href='$link' target='_blank'>🔗</a>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil Pelacakan</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../alumni/alumni.php">Data Alumni</a>
            <a href="../pelacakan/pelacakan.php">Pelacakan</a>
            <a href="../hasil/hasil_pelacakan.php" class="active">Hasil</a>
        </div>

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">
                <h2>Hasil Pelacakan Alumni</h2>
            </div>

            <div class="card">

                <!-- SEARCH -->
                <div style="display:flex; justify-content: space-between; margin-bottom:15px;">

                    <form method="GET" class="search">
                        <input type="text" name="search" placeholder="Cari..." value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-primary">Cari</button>
                    </form>

                    <p>Ditemukan: <b><?= number_format($total_data, 0, ',', '.') ?></b></p>

                </div>

                <!-- TABLE -->
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>LinkedIn</th>
                        <th>IG</th>
                        <th>Email</th>
                        <th>HP</th>
                        <th>Tempat Kerja</th>
                        <th>Posisi</th>
                        <th>Status</th>
                    </tr>

                    <?php while ($d = mysqli_fetch_assoc($data)): ?>
                        <tr>

                            <td><b><?= htmlspecialchars($d['nama']) ?></b></td>

                            <td><?= tampilLink($d['linkedin']) ?></td>
                            <td><?= tampilLink($d['ig']) ?></td>

                            <td><?= htmlspecialchars($d['email']) ?></td>
                            <td><?= htmlspecialchars($d['no_hp']) ?></td>

                            <td><?= htmlspecialchars($d['tempat_kerja']) ?></td>
                            <td><?= htmlspecialchars($d['posisi']) ?></td>

                            <td><span class="badge success">Terdeteksi</span></td>

                        </tr>
                    <?php endwhile; ?>

                    <?php if (mysqli_num_rows($data) == 0): ?>
                        <tr>
                            <td colspan="8">Belum ada data hasil pelacakan.</td>
                        </tr>
                    <?php endif; ?>

                </table>

                <div class="pagination">

                    <!-- PREV -->
                    <?php if ($halaman > 1): ?>
                        <a href="?halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>">← Prev</a>
                    <?php else: ?>
                        <span class="disabled">← Prev</span>
                    <?php endif; ?>

                    <!-- PAGE INFO -->
                    <span class="active"><?= $halaman ?> / <?= $total_halaman ?></span>

                    <!-- NEXT -->
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