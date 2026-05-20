<?php
$conn = mysqli_connect("localhost", "root", "", "tkr_web");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>