<?php
require_once 'Database.php'; // Memanggil file Database.php

$db = new Database(); // Membuat instance dari kelas Database
$conn = $db->conn; // Mengambil koneksi


// Mengambil input nama langsung dari form tanpa pengecekan
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';

// Hanya jalankan query jika ada input pada $nama
if ($nama !== '') {
    // Menggunakan multi_query untuk memungkinkan SQL Injection
    $sql = "INSERT INTO users (nama) VALUES ('$nama');"; // Kerentanan SQL Injection

    // Eksekusi query dengan multi_query untuk memungkinkan beberapa statement SQL
    if ($conn->multi_query($sql)) {
        do {
            /* Menyimpan hasil jika ada */
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Insert Nama</title>
</head>
<body>
    <form method="post" action="">
        Nama: <input type="text" name="nama" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
