<?php
include 'config.php';

function tampilKomentar($parent_id = NULL, $margin = 0) {
    global $conn;

    if ($parent_id === NULL) {
        $result = mysqli_query($conn, "SELECT * FROM komentar WHERE parent_id IS NULL ORDER BY id DESC");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM komentar WHERE parent_id = $parent_id ORDER BY id ASC");
    }

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<div class='comment-item' style='margin-left: {$margin}px;'>";

        // NAMA
        echo "<b>{$row['nama']}</b>";

        // ⭐ RATING (HANYA KOMENTAR UTAMA)
        if ($row['parent_id'] == NULL) {
            echo " <span class='comment-rating'>" . str_repeat("⭐", $row['rating']) . "</span>";
        }

        // PESAN
        echo "<p>{$row['pesan']}</p>";

        // FORM BALAS (TANPA RATING)
        echo "<form action='proses_komentar.php' method='POST'>
                <input type='hidden' name='parent_id' value='{$row['id']}'>
                <input type='text' name='nama' placeholder='Nama...' required>
                <textarea name='pesan' placeholder='Balas komentar...' required></textarea>
                <button type='submit'>Balas</button>
              </form>";

        // REKURSIF BALASAN
        tampilKomentar($row['id'], $margin + 30);

        echo "</div>";
    }
}

tampilKomentar();
?>