<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "kelulusan";

$koneksi = mysqli_connect('localhost', 'root', '', 'kelulusan');

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nisn = $_POST['nisn'] ?? '';
$nama = $_POST['nama'] ?? '';
// die(var_dump($_POST));
if (isset($nisn) && isset($nama)) {
    $nisn = mysqli_real_escape_string($koneksi, $nisn);
    $nama = mysqli_real_escape_string($koneksi, $nama);

    $query = "SELECT status_kelulusan FROM siswa WHERE nisn = '$nisn' AND nama = '$nama'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status_kelulusan = $row['status_kelulusan'];
        $message = $status_kelulusan === 'lulus' ? "<p class='success'>SELAMAT! Anda dinyatakan LULUS.</p>" : "<p class='failure'>MAAF! Anda dinyatakan TIDAK LULUS.</p>";
        $result = mysqli_query($koneksi, $query);
    } else {
        $message = "<p>Siswa dengan NISN $nisn, dan Nama $nama, tidak ditemukan.</p>";
    }
} else {
    $message = "<p>Harap masukkan semua data yang diperlukan.</p>";
}

mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan</title>
    <link rel="stylesheet" href="notifikasi.css">
</head>
<body>
    <div class="result-container">
    <img src="logo.png" alt="Logo" style="width: 100px;">
        <h1>Pengumuman kelulusan</h1>
        <?php echo $message; ?>
        <p>JANGAN PUTUS ASA DAN TETAP SEMANGAT!</p>
        
        <a href="index.php" class="back-button">Kembali ke Pencarian</a>
    </div>
</body>
</html>
