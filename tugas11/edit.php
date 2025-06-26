<?php
include 'koneksi.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = (int)$_POST['category_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, category_id=?, status=? WHERE task_id=?");
    $stmt->bind_param("ssisi", $title, $description, $category_id, $status, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE task_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$task_result = $stmt->get_result();
$task = $task_result->fetch_assoc();

$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Edit Tugas</h2>
            </div>
            <div class="card-body">
                <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <?php while ($cat = $categories->fetch_assoc()): ?>
                                <option value="<?php echo $cat['category_id']; ?>" <?php if ($cat['category_id'] == $task['category_id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending" <?php if ($task['status'] == 'pending') echo 'selected'; ?>>Menunggu</option>
                            <option value="onprogress" <?php if ($task['status'] == 'onprogress') echo 'selected'; ?>>Sedang Dikerjakan</option>
                            <option value="completed" <?php if ($task['status'] == 'completed') echo 'selected'; ?>>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
?>