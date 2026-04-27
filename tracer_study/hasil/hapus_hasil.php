<?php
include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM hasil_pelacakan WHERE id='$id'");

header("location:hasil_pelacakan.php");
?>