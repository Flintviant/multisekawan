<?php
// Menyambung ke database (sesuaikan dengan pengaturan database Anda)
$servername = "localhost";
$username = "u608883328_sekaone";
$password = "Sekaone_0423";
$dbname = "u608883328_sekaone"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data untuk meta description dan keywords dari database
$sql = "SELECT meta_description, meta_keywords FROM meta_info WHERE page_name = ?";
$stmt = $conn->prepare($sql);

// Tentukan halaman yang sedang diakses (misalnya home, about, etc.)
$page_name = '';
if(isset($_GET["home"])) {
    $page_name = 'home';
} else if(isset($_GET["about"])) {
    $page_name = 'about';
} else if(isset($_GET["services"])) {
    $page_name = 'services';
} else if(isset($_GET["artikel"])) {
    $page_name = 'artikel';
} else if(isset($_GET["contact"])) {
    $page_name = 'contact';
} else {
    $page_name = 'home'; // Default halaman jika tidak ada parameter
}

$stmt->bind_param("s", $page_name);
$stmt->execute();
$stmt->bind_result($meta_description, $meta_keywords);
$stmt->fetch();
$stmt->close();
$conn->close();
?>