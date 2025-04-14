<?php
require_once 'config.php'; // koneksi PDO

// Whitelist halaman yang diizinkan
$allowed_pages = ['home', 'about', 'services', 'artikel', 'contact'];
$page_name = 'home'; // default

foreach ($allowed_pages as $page) {
    if (isset($_GET[$page])) {
        $page_name = $page;
        break;
    }
}

// Query dengan prepared statement
$stmt = $pdo->prepare("SELECT meta_description, meta_keywords FROM meta_info WHERE page_name = :page_name");
$stmt->execute(['page_name' => $page_name]);
$meta = $stmt->fetch(PDO::FETCH_ASSOC);

// Set default kalau data tidak ditemukan
$meta_description = $meta['meta_description'] ?? 'Multisekawan Official Website';
$meta_keywords = $meta['meta_keywords'] ?? 'sekaone, multisekawan, default';
