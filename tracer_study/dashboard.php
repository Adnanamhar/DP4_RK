<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:login.php");
    exit();
}

include "koneksi.php";

// DATA
$q1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM alumni WHERE status='Terdeteksi'"))['t'];
$q2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM alumni WHERE status='Perlu Verifikasi'"))['t'];
$q3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM alumni WHERE status='Tidak Ditemukan'"))['t'];

$total = $q1 + $q2 + $q3;

$p1 = $total > 0 ? round($q1 / $total * 100) : 0;
$p2 = $total > 0 ? round($q2 / $total * 100) : 0;
$p3 = $total > 0 ? round($q3 / $total * 100) : 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="alumni/alumni.php">Data Alumni</a>
            <a href="pelacakan/pelacakan.php">Pelacakan</a>
            <a href="hasil/hasil_pelacakan.php">Hasil</a>
        </div>

        <!-- MAIN -->
        <div class="main">

            <!-- TOPBAR -->
            <div class="topbar">
                <h2>Dashboard</h2>

                <div class="user-box" onclick="toggleDropdown()">
                    <div class="avatar"></div>
                    <div>
                        <b><?= $_SESSION['username'] ?></b><br>
                        <small>Admin</small>
                    </div>

                    <!-- DROPDOWN -->
                    <div id="dropdown" class="dropdown-menu">
                        <a href="#">Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>

            <!-- HEADER -->
            <div class="top-header">
                Sistem Pelacakan Alumni
            </div>

            <!-- STATS -->
            <div class="stats">

                <div class="stat-box green">
                    <h2><?= $q1 ?></h2>
                    <small>Terdeteksi</small>
                </div>

                <div class="stat-box yellow">
                    <h2><?= $q2 ?></h2>
                    <small>Perlu Verifikasi</small>
                </div>

                <div class="stat-box red">
                    <h2><?= $q3 ?></h2>
                    <small>Tidak Ditemukan</small>
                </div>

            </div>

            <!-- PROGRESS -->
            <div class="card">
                <h3>Statistik Pelacakan</h3>

                Terdeteksi (<?= $p1 ?>%)
                <div class="progress">
                    <div class="progress-bar bg-green" style="width:<?= $p1 ?>%"></div>
                </div>

                Perlu Verifikasi (<?= $p2 ?>%)
                <div class="progress">
                    <div class="progress-bar bg-yellow" style="width:<?= $p2 ?>%"></div>
                </div>

                Tidak Ditemukan (<?= $p3 ?>%)
                <div class="progress">
                    <div class="progress-bar bg-red" style="width:<?= $p3 ?>%"></div>
                </div>
            </div>

            <!-- CHART -->
            <div class="card">
                <h3>Grafik Distribusi</h3>

                <div class="chart-container">
                    <canvas id="chart"></canvas>
                </div>
            </div>

            <!-- WELCOME -->
            <div class="card">
                Selamat datang, <b><?= $_SESSION['username'] ?></b> 👋
            </div>

        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        // CHART
        const ctx = document.getElementById('chart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Terdeteksi', 'Verifikasi', 'Tidak Ditemukan'],
                datasets: [{
                    data: [<?= $q1 ?>, <?= $q2 ?>, <?= $q3 ?>],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545']
                }]
            }
        });

        // DROPDOWN
        function toggleDropdown() {
            const menu = document.getElementById("dropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(e) {
            if (!e.target.closest('.user-box')) {
                document.getElementById("dropdown").style.display = "none";
            }
        }
    </script>

</body>

</html>