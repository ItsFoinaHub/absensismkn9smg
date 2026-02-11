<?php
include "koneksi.php";
$query = mysqli_query($conn, "SELECT presensi.waktu_masuk, siswa.nama_siswa, siswa.kelas, presensi.keterangan 
                             FROM presensi 
                             JOIN siswa ON presensi.uid_kartu = siswa.uid_kartu 
                             ORDER BY presensi.id DESC LIMIT 10");

while($row = mysqli_fetch_array($query)) {
    // Menentukan warna badge berdasarkan status
    if($row['keterangan'] == 'Masuk') {
        $badge = 'bg-success'; // Hijau
    } elseif($row['keterangan'] == 'Terlambat') {
        $badge = 'bg-warning text-dark'; // Kuning
    } else {
        $badge = 'bg-primary'; // Biru
    }

    echo "<tr>
            <td>" . date('H:i:s', strtotime($row['waktu_masuk'])) . "</td>
            <td>{$row['nama_siswa']}</td>
            <td>{$row['kelas']}</td>
            <td><span class='badge $badge'>{$row['keterangan']}</span></td>
          </tr>";
}
?>