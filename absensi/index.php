<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RFID Dashboard</title>
    <!-- BOOTSTRAP GRID SAJA (Agar tidak bentrok) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <!-- FILE CSS ANDA -->
    <link rel="stylesheet" href="style.css?v=1.1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- KIRI: SIDEBAR -->
    <div class="sidebar">
        <h4>RFID<span style="color:#bf94ff">SYS</span></h4>
        <a href="index.php" class="nav-link active">Dashboard</a>
        <a href="siswa.php" class="nav-link">Manajemen Siswa</a>
        <a href="laporan.php" class="nav-link">Laporan Absensi</a>
    </div>

    <!-- KANAN: ISI KONTEN -->
    <div class="main-content">
        <h2 style="margin-bottom: 30px;">Dashboard Monitor</h2>

        <!-- BARIS KARTU ANGKA -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-title">Total Siswa</div>
                    <div class="card-value" id="stat-total">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-title text-success">Hadir</div>
                    <div class="card-value" id="stat-hadir">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-title text-danger">Terlambat</div>
                    <div class="card-value" id="stat-terlambat">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-title">Belum Absen</div>
                    <div class="card-value" id="stat-belum">0</div>
                </div>
            </div>
        </div>

        <!-- BARIS TABEL & LOG -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h5 style="margin-bottom:20px">Kehadiran Hari Ini</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Nama Siswa</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="live-feed">
                            <!-- Data otomatis masuk -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 style="margin-bottom:20px">Raw Activity Log</h5>
                    <div id="raw-log" style="max-height: 400px; overflow-y: auto;">
                        <!-- Data otomatis masuk -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateStats() {
            $.getJSON('api_stats.php', function(data) {
                $('#stat-total').text(data.total);
                $('#stat-hadir').text(data.hadir);
                $('#stat-terlambat').text(data.terlambat);
                $('#stat-belum').text(data.belum);
            });
            $('#live-feed').load('fetch_live_feed.php');
            $('#raw-log').load('fetch_raw_log.php');
        }
        setInterval(updateStats, 2000);
        updateStats();
    </script>
</body>
</html>