<?php
include "koneksi.php";

$query = mysqli_query($conn, "SELECT presensi.waktu_masuk, siswa.nama_siswa, presensi.keterangan 
                             FROM presensi 
                             JOIN siswa ON presensi.uid_kartu = siswa.uid_kartu 
                             ORDER BY presensi.id DESC LIMIT 5");

if(mysqli_num_rows($query) == 0) {
    echo "<tr><td colspan='3' class='text-center text-muted'>Belum ada aktivitas hari ini</td></tr>";
}

while($row = mysqli_fetch_array($query)) {
    $warna = "";
    if($row['keterangan'] == 'Masuk') $warna = "bg-masuk";
    elseif($row['keterangan'] == 'Terlambat') $warna = "bg-terlambat";
    else $warna = "bg-primary";

    echo "<tr>
            <td>" . date('H:i', strtotime($row['waktu_masuk'])) . "</td>
            <td>{$row['nama_siswa']}</td>
            <td><span class='badge $warna'>{$row['keterangan']}</span></td>
          </tr>";
}
?>