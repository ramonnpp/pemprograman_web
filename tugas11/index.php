<?php
include 'koneksi.php';

if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

if (isset($_GET['selesai'])) {
    $id_to_update = $_GET['selesai'];
    $stmt = $conn->prepare("UPDATE tasks SET status = 'completed' WHERE task_id = ?");
    $stmt->bind_param("i", $id_to_update);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

$sql = "SELECT t.task_id, t.title, t.description, c.name AS category_name, t.status
        FROM tasks t
        LEFT JOIN categories c ON t.category_id = c.category_id
        ORDER BY t.task_id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Daftar Tugas</h1>
            <div>
                <a href="tambah.php" class="btn btn-primary">Tambah Tugas</a>
                <a href="kategori.php" class="btn btn-secondary text-white">Kelola Kategori</a>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table  table-bordered">
                <thead class="table-Light">
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['category_name'] ?? 'N/A'); ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'pending') echo 'Menunggu';
                                    if ($row['status'] == 'onprogress') echo 'Sedang Dikerjakan';
                                    if ($row['status'] == 'completed') echo 'Selesai';
                                    ?>
                                </td>
                                <td class="d-flex gap-1">
                                    <?php if ($row['status'] != 'completed'): ?>
                                        <a href="edit.php?id=<?php echo $row['task_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="?delete=<?php echo $row['task_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tugas ini?');">Hapus</a>
                                        <a href="?selesai=<?php echo $row['task_id']; ?>" class="btn btn-success btn-sm">Selesai</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-warning btn-sm disabled" aria-disabled="true">Edit</a>
                                        <a href="?delete=<?php echo $row['task_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tugas ini?');">Hapus</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info" role="alert">
                                    Tidak ada tugas
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
?>