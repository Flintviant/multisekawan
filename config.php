<?php
  
  $servername = "localhost";
  $username = "u608883328_sekaone";
  $password = "Sekaone_0423";
  $databasename = "u608883328_sekaone";

  $defaulturl  = "https://sekaone.com/";
  
  // CREATE CONNECTION
  $conn = new mysqli($servername,
    $username, $password, $databasename);
  
  try {
      $pdo = new PDO("mysql:host=$servername;dbname=$databasename;charset=utf8mb4", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      die("Koneksi gagal: " . $e->getMessage());
  }
  
  // SQL QUERY
  $query = "SELECT * FROM tblposts";
  
  // FETCHING DATA FROM DATABASE
  $result = $conn->query($query);
  $blog = $result;
  
   $conn->close();
  
?>