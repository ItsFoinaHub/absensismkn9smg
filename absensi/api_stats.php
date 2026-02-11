<?php
include "koneksi.php";
$tgl = date("Y-m-d");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM siswa"))['jml'];
$hadir = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT uid_kartu) as jml FROM presensi WHERE DATE(waktu_masuk)='$tgl' AND keterangan IN ('Masuk', 'Terlambat')"))['jml'];
$terlambat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM presensi WHERE DATE(waktu_masuk)='$tgl' AND keterangan='Terlambat'"))['jml'];
$belum = $total - $hadir;

echo json_encode(['total' => $total, 'hadir' => $hadir, 'terlambat' => $terlambat, 'belum' => $belum]);
?>