<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: kategori.php');
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: kategori.php');
exit();
