<?php
include 'db.php';
$id = $_GET['id'];
$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $status = $_POST['status'];
    $created = $_POST['created'];
    $modified = $_POST['modified'];

    $sql = "UPDATE categories SET title='$title', status='$status', created='$created', modified='$modified' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: categories.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Edit Category</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="<?= $category['title'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" <?= $category['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $category['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Created Date</label>
            <input type="date" name="created" value="<?= $category['created'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Modified Date</label>
            <input type="date" name="modified" value="<?= $category['modified'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
