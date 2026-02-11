<?php
include "koneksi.php";
$uid = $_POST['uid'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

if($uid != ""){
    $query = mysqli_query($conn, "INSERT INTO siswa (uid_kartu, nama_siswa, kelas) VALUES ('$uid', '$nama', '$kelas')");
    if($query){
        mysqli_query($conn, "DELETE FROM tmp_kartu"); // Bersihkan tabel temp
        header("location:siswa.php");
    }
}
?>