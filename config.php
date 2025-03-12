<?php
  
  $servername = "localhost";
  $username = "u608883328_sekaone";
  $password = "Sekaone_0423";
  $databasename = "u608883328_sekaone";

  $defaulturl  = "http://sekaone.test/";
  
  // CREATE CONNECTION
  $conn = new mysqli($servername,
    $username, $password, $databasename);
  
  // GET CONNECTION ERRORS
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  // SQL QUERY
  $query = "SELECT * FROM tblposts";
  
  // FETCHING DATA FROM DATABASE
  $result = $conn->query($query);
  $blog = $result;
  
   $conn->close();
  
?>