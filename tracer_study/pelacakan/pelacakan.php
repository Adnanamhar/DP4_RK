<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:login.php");
    exit();
}

include "../koneksi.php";

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
$limit = 50;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($halaman - 1) * $limit;

$query_base = "FROM alumni WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
$data = mysqli_query($conn, "SELECT * $query_base LIMIT $offset, $limit");

$total_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t $query_base"))['t'];
$total_halaman = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pelacakan Alumni</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../alumni/alumni.php">Data Alumni</a>
            <a href="pelacakan.php" class="active">Pelacakan</a>
            <a href="../hasil/hasil_pelacakan.php">Hasil</a>
        </div>

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">
                <h2>Pelacakan Alumni</h2>
            </div>

            <div class="card">

                <!-- SEARCH + TOTAL -->
                <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:15px;">

                    <form method="GET" class="search">
                        <input type="text" name="search" placeholder="Cari Nama / NIM..." value="<?= $search ?>">
                        <button class="btn btn-primary">Cari</button>
                    </form>

                    <p>Total: <b><?= number_format($total_data, 0, ',', '.') ?></b></p>

                </div>

                <!-- TABLE -->
                <table>
                    <tr>
                        <th>Alumni</th>
                        <th>Prodi</th>
                        <th>Tracking</th>
                        <th>Aksi</th>
                    </tr>

                    <?php while ($d = mysqli_fetch_assoc($data)):
                        $keyword = urlencode($d['nama'] . " UMM");
                    ?>
                        <tr>

                            <td>
                                <b><?= htmlspecialchars($d['nama']) ?></b><br>
                                <small><?= $d['nim'] ?></small>
                            </td>

                            <td><?= $d['program_studi'] ?></td>

                            <td>
                                <a href="https://www.linkedin.com/search/results/all/?keywords=<?= $keyword ?>" target="_blank">LinkedIn</a> |
                                <a href="https://www.google.com/search?q=<?= $keyword ?>" target="_blank">Google</a>
                            </td>

                            <td>
                                <a href="proses_lacak.php?id=<?= $d['id'] ?>" class="btn btn-primary">Mulai Lacak</a>
                            </td>

                        </tr>
                    <?php endwhile; ?>

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