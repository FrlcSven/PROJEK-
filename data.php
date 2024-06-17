<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Didik Lulus</title>
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
        .btn-edit {
    padding: 5px 10px;
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    margin-right: 5px;
    transition: background-color 0.3s ease;
}

.btn-edit:hover {
    background-color: #218838;
}

.btn-delete {
    padding: 5px 10px;
    background-color: #dc3545;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-delete:hover {
    background-color: #c82333;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.search-form {
    gap: 10px;
    text-align: center;
    margin-bottom: 20px;
    display: flex;
    justify-content: start;
    align-items: start;
}

.search-form input[type="text"] {
    padding: 10px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.search-form button {
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #0056b3;
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
            <h2>Daftar Peserta Didik Lulus</h2>
        </div>
        <div class="container">
        <h2>Impor Data CSV ke Database</h2>
        <form action="import_csv.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih file CSV:</label>
                <input type="file" class="form-control-file" id="file" name="file"  required>
            </div>
            <button type="submit" class="btn btn-primary">Impor</button>
        </form>
    </div>
        <div class="container mt-4">
            <form method="GET" action="data.php" class="search-form">
                <input type="text" name="search_nis" placeholder="Cari NIS">
                <button type="submit"> Cari</button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Kelulusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                
                    $koneksi = mysqli_connect('localhost', 'root', '', 'kelulusan');
                    if (!$koneksi) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }

                    $query = "SELECT * FROM siswa";
                    if (isset($_GET['search_nis'])) {
                        $search_nis = $_GET['search_nis'];
                        $query .= " WHERE nis LIKE '%$search_nis%'";
                    }
                    $result = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['nis'] . "</td>";
                            echo "<td>" . $row['nisn'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>" . $row['tgl_lahir'] . "</td>";
                            echo "<td>" . $row['status_kelulusan'] . "</td>";
                            echo "<td>
                                    <a href='edit.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Tidak ada data</td></tr>";
                    }

                    mysqli_close($koneksi);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
