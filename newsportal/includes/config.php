<?php
define('DB_SERVER','localhost');
define('DB_USER','u608883328_sekaone');
define('DB_PASS' ,'Sekaone_0423');
define('DB_NAME','u608883328_sekaone');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

$defaulturl  = "https://sekaone.com/";
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

