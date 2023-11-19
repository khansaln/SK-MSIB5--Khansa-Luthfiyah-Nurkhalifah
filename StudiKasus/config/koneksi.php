<?php
$serverName = 'localhost';
$userName = 'root';
$password = '';
// sesuaikan database nya yg ada d phpmyadmin ya
$dbName = 'db_apotek-ternew';
// Create connection
$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
} else {
    // echo 'koneksi berhasil';
}
