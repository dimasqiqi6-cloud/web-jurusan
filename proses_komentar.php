<?php
include 'config.php';

$nama = $_POST['nama'];
$pesan = $_POST['pesan'];
$parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : NULL;

// CEK RATING (HANYA UNTUK KOMENTAR UTAMA)
if ($parent_id === NULL) {
    if (empty($_POST['rating'])) {
        echo "Harus kasih rating dulu!";
        exit;
    }
    $rating = $_POST['rating'];
} else {
    // BALASAN TIDAK PAKAI RATING
    $rating = 0;
}

// QUERY INSERT
if ($parent_id === NULL) {
    $query = "INSERT INTO komentar (nama, pesan, rating, parent_id)
              VALUES ('$nama', '$pesan', '$rating', NULL)";
} else {
    $query = "INSERT INTO komentar (nama, pesan, rating, parent_id)
              VALUES ('$nama', '$pesan', '$rating', '$parent_id')";
}

// EKSEKUSI
if (!mysqli_query($conn, $query)) {
    die("Error: " . mysqli_error($conn));
}

header("Location: index.php");
exit;
?>