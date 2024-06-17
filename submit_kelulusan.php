<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'kelulusan');

if ($koneksi) {
    echo "<br> koneksi aman <br>";
} else {
    echo "<script>alert('Error: tidak bisa koneksi ke database');</script>";
    exit();
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $status_kelulusan = $_POST['status_kelulusan'];

    // Menyiapkan dan mengeksekusi statement
    $stmt = $koneksi->prepare("INSERT INTO siswa (id, nama, nis, nisn, alamat, tgl_lahir, status_kelulusan) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $id, $nama, $nis, $nisn, $alamat, $tgl_lahir, $status_kelulusan);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kelulusan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="logo.png" alt="Logo" style="width: 100px;">
            <h4>SISTEM KELULUSAN</h4> 
            <p>SMKN 7 MAKASSAR</p>
        </div>
        <a href="data.php">Data Peserta Didik</a>
        <a href="submit_kelulusan.php">input data</a>
        <a href="logout.php">Logout</a>
        <a href="index.php">Cek Kelulusan</a>
    </div>

    <div class="content">
        <div class="navbar">
            <h2>Data Kelulusan Peserta Didik</h2>
        </div>
        <div class="container mt-4">
            <h4>Input Data Siswa</h4>
            <form action="submit_kelulusan.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="nis">NIS:</label>
                    <input type="text" class="form-control" id="nis" name="nis" required>
                </div>
                <div class="form-group">
                    <label for="nisn">NISN:</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                </div>
                <div class="form-group">
                    <label for="status_kelulusan">Status Kelulusan:</label>
                    <select class="form-control" id="status_kelulusan" name="status_kelulusan" required>
                        <option value="">Pilih Status</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Tidak Lulus">Tidak Lulus</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>