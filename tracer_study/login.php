<!DOCTYPE html>
<html>

<head>
    <title>Login Sistem Alumni</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="login-wrapper">
        <div class="login-box">
            <div class="card">
                <div style='color:blue; text-align:center; margin-bottom:10px;'>Login Admin.</div>


                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal") {
                        echo "<div class='error'>Login gagal! Username atau password salah.</div>";
                    } else if ($_GET['pesan'] == "logout") {
                        echo "<div style='color:green; text-align:center; margin-bottom:10px;'>Berhasil Logout.</div>";
                    } else if ($_GET['pesan'] == "belum_login") {
                        echo "<div class='error'>Anda harus login dulu!</div>";
                    }
                }
                ?>

                <form method="POST" action="login_proses.php">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" class="button">LOGIN</button>
                </form>
            </div>

</body>

</html>