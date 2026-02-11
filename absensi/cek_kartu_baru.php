<?php
include "koneksi.php";
$query = mysqli_query($conn, "SELECT uid_kartu FROM tmp_kartu ORDER BY waktu DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);
echo $data['uid_kartu'] ?? "";
?>