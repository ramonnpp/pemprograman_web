<?php
include 'koneksi.php';

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header('Location: kategori.php');
    exit();
}

$id = $_GET['id'];

// Proses update data ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];
    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
    $stmt->bind_param("si", $nama_kategori, $id);
    $stmt->execute();
    header('Location: kategori.php');
    exit();
}

// Ambil data kategori yang akan diedit
$stmt = $conn->prepare("SELECT name FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Kategori tidak ditemukan.";
    exit();
}
$category = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Kategori</h2>
                    </div>
                    <div class="card-body">
                        <form action="edit_kategori.php?id=<?php echo $id; ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="kategori.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>