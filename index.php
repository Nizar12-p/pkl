<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Sekolah</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .chart-container {
      height: 800px;
      width: 80%;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row mb-3">
      <div class="col-md-3">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <h5 class="card-title">Jumlah Guru</h5>
            <p class="card-text" id="jumlah-guru">50</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-success">
          <div class="card-body">
            <h5 class="card-title">Jumlah Siswa</h5>
            <p class="card-text" id="jumlah-siswa">500</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-danger">
          <div class="card-body">
            <h5 class="card-title">Kelas dengan Pelanggaran Terbanyak</h5>
            <p class="card-text" id="kelas-terbanyak">Kelas 10A - 15 Pelanggaran</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-info">
          <div class="card-body">
            <h5 class="card-title">Jumlah Kelas</h5>
            <p class="card-text" id="jumlah-kelas">33</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Statistik Kelas dengan Pelanggaran Terbanyak
          </div>
          <div class="card-body chart-container">
            <canvas id="pelanggaranChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Jumlah Siswa per Kelas
          </div>
          <div class="card-body chart-container">
            <canvas id="siswaChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'getData.php',
        method: 'GET',
        success: function(data) {
          var parsedData = JSON.parse(data);
          var pelanggaranData = parsedData.pelanggaran;
          var siswaData = parsedData.siswa;

          // Data untuk grafik pelanggaran
          var kelasLabelsPelanggaran = pelanggaranData.map(function(item) {
            return item.kelas;
          });
          var jumlahPelanggaran = pelanggaranData.map(function(item) {
            return item.jumlah_pelanggaran;
          });

          // Data untuk grafik siswa
          var kelasLabelsSiswa = siswaData.map(function(item) {
            return item.kelas;
          });
          var jumlahSiswa = siswaData.map(function(item) {
            return item.jumlah_siswa;
          });

          var pelanggaranCtx = document.getElementById('pelanggaranChart').getContext('2d');
          var pelanggaranChart = new Chart(pelanggaranCtx, {
            type: 'bar',
            data: {
              labels: kelasLabelsPelanggaran,
              datasets: [{
                label: 'Jumlah Pelanggaran',
                data: jumlahPelanggaran,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              },
              responsive: true,
              maintainAspectRatio: false,
            }
          });

          var siswaCtx = document.getElementById('siswaChart').getContext('2d');
          var siswaChart = new Chart(siswaCtx, {
            type: 'bar',
            data: {
              labels: kelasLabelsSiswa,
              datasets: [{
                label: 'Jumlah Siswa',
                data: jumlahSiswa,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              },
              responsive: true,
              maintainAspectRatio: false,
            }
          });
        }
      });
    });
  </script>
</body>
</html>
