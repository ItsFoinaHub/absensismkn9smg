<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Sama seperti index.php) -->
        <div class="col-md-2 sidebar d-none d-md-block">
            <h5 class="px-3 mb-4 text-primary">RFID-SYS</h5>
            <nav class="nav flex-column">
                <a class="nav-link" href="index.php">Dashboard</a>
                <a class="nav-link active" href="siswa.php">Manajemen Siswa</a>
                <a class="nav-link" href="laporan.php">Laporan Absensi</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between mb-4">
                <h4>Data Siswa</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Siswa Baru
                </button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>UID Kartu</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                            while($d = mysqli_fetch_array($s)){
                                echo "<tr>
                                    <td><code>{$d['uid_kartu']}</code></td>
                                    <td>{$d['nama_siswa']}</td>
                                    <td>{$d['kelas']}</td>
                                    <td>
                                        <a href='hapus.php?uid={$d['uid_kartu']}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Hapus siswa ini?\")'>Hapus</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card"> <!-- Pakai class card agar tema gelap -->
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-white">Registrasi Siswa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="proses_tambah.php" method="POST">
        <div class="modal-body text-white">
            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" name="nama" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="mb-3">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control bg-dark text-white border-secondary" required>
            </div>
            <div class="mb-3">
                <label class="text-info">UID Kartu (Silahkan Tap Kartu ke Alat)</label>
                <input type="text" name="uid" id="uid_otomatis" class="form-control bg-dark text-primary border-primary" placeholder="Menunggu scan..." readonly>
            </div>
        </div>
        <div class="modal-footer border-secondary">
            <button type="submit" class="btn btn-primary w-100">Simpan Data Siswa</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        // Cek tabel tmp_kartu setiap 1 detik secara otomatis
        setInterval(function(){
            $.get("cek_kartu_baru.php", function(data){
                if(data !== "") {
                    $("#uid_otomatis").val(data);
                }
            });
        }, 1000);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>