
<?php 

include "./excel_library/excel_reader2.php";

// upload file xls
$target = basename($_FILES['file']['name']) ;
move_uploaded_file($_FILES['file']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['file']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nama     = $data->val($i, 1);
	$nis   = $data->val($i, 2);
	$nisn   = $data->val($i, 3);
	$alamat  = $data->val($i, 4);
	$tanggal_lahir  = $data->val($i, 5);
	$status_kelulusan  = $data->val($i, 6);

	if($nama != "" && $alamat != ""){
        // input data ke database (table data_pegawai)
        $query = "INSERT INTO siswa (nama, nis, nisn, tgl_lahir, status_kelulusan) 
                  VALUES ('$nama', '$nis', '$nisn', '$tanggal_lahir', '$status_kelulusan')";
        
        if (!mysqli_query($koneksi, $query)) {
            echo "<script>alert('Error: " . mysqli_error($koneksi);
        }
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['file']['name']);

// alihkan halaman ke index.php
header("location: data.php");
?>