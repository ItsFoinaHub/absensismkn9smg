<?php
include "koneksi.php";

if(isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $tgl_sekarang = date("Y-m-d");
    $jam_sekarang = date("H:i");

    // Aturan Jam
    $batas_masuk = "07:15";
    $awal_pulang = "14:00";

    // 1. Cari Nama Siswa
    $q_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE uid_kartu = '$uid'");
    $d_siswa = mysqli_fetch_assoc($q_siswa);
    $nama = ($d_siswa) ? $d_siswa['nama_siswa'] : "Kartu Baru";

    // 2. CATAT RAW LOG (Semua Tap Masuk Sini)
    mysqli_query($conn, "INSERT INTO log_tap (uid_kartu, nama_siswa, keterangan) VALUES ('$uid', '$nama', 'Melakukan Tap Kartu')");

    // 3. LOGIKA ABSENSI (Hanya Jika Terdaftar)
    if($d_siswa) {
        $cek_absen = mysqli_query($conn, "SELECT * FROM presensi WHERE uid_kartu = '$uid' AND DATE(waktu_masuk) = '$tgl_sekarang'");
        
        if(mysqli_num_rows($cek_absen) == 0) {
            // Absen Masuk atau Terlambat
            $status = ($jam_sekarang <= $batas_masuk) ? "Masuk" : "Terlambat";
            mysqli_query($conn, "INSERT INTO presensi (uid_kartu, keterangan) VALUES ('$uid', '$status')");
            echo "Berhasil $status";
        } else {
            // Cek Absen Pulang
            $cek_pulang = mysqli_query($conn, "SELECT * FROM presensi WHERE uid_kartu = '$uid' AND keterangan = 'Pulang' AND DATE(waktu_masuk) = '$tgl_sekarang'");
            if(mysqli_num_rows($cek_pulang) == 0 && $jam_sekarang >= $awal_pulang) {
                mysqli_query($conn, "INSERT INTO presensi (uid_kartu, keterangan) VALUES ('$uid', 'Pulang')");
                echo "Berhasil Pulang";
            } else {
                echo "Sudah Absen/Belum Waktunya";
            }
        }
    } else {
        // Jika Kartu Tidak Dikenal, masuk ke tabel registrasi
        mysqli_query($conn, "DELETE FROM tmp_kartu");
        mysqli_query($conn, "INSERT INTO tmp_kartu (uid_kartu) VALUES ('$uid')");
        echo "Kartu Baru Terdeteksi";
    }
}
?>