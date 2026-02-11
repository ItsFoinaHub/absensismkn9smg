<?php
include "koneksi.php";
$query = mysqli_query($conn, "SELECT * FROM log_tap ORDER BY id DESC LIMIT 15");
while($row = mysqli_fetch_array($query)) {
    echo "<div class='mb-2 p-2 border-bottom border-secondary'>
            <div class='d-flex justify-content-between small text-muted'>
                <span>{$row['uid_kartu']}</span>
                <span>".date('H:i:s', strtotime($row['waktu']))."</span>
            </div>
            <div class='text-white'>{$row['nama_siswa']}</div>
          </div>";
}
?>