<?php
// db.php

$host = 'localhost'; // atau 127.0.0.1
$user = 'root';      // username database Anda
$pass = '';          // password database Anda
$db_name = 'todo_app'; // nama database Anda

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>