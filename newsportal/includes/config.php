<!-- <?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','newsportal');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

$defaulturl  = "http://sekaone.test/";
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?> -->

<?php
define('DB_SERVER','localhost');
define('DB_USER','u752324154_sekaone');
define('DB_PASS' ,'1234Harusdigunakan!');
define('DB_NAME','u752324154_sekaone');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

$defaulturl  = "http://sekaone.test/";
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

