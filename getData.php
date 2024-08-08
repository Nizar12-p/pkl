<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tata_tertib";

// Buat koneksi
$conn = new mysqli($localhost, $root,$"", $tata_tertib);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil data jumlah pelanggaran per kelas
$sql_pelanggaran = "SELECT kelas, jumlah_pelanggaran FROM pelanggaran";
$result_pelanggaran = $conn->query($sql_pelanggaran);

$pelanggaran_data = array();
while($row = $result_pelanggaran->fetch_assoc()) {
  $pelanggaran_data[] = $row;
}

// Ambil data jumlah siswa per kelas
$sql_siswa = "SELECT kelas, jumlah_siswa FROM siswa";
$result_siswa = $conn->query($sql_siswa);

$siswa_data = array();
while($row = $result_siswa->fetch_assoc()) {
  $siswa_data[] = $row;
}

$conn->close();

echo json_encode(array('pelanggaran' => $pelanggaran_data, 'siswa' => $siswa_data));
?>
