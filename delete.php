<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'kelulusan');
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM siswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: data.php");
    } else {
        echo "Gagal menghapus data.";
    }

    $stmt->close();
}

$koneksi->close();
?>
