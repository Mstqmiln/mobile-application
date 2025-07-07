<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $status = $_POST['status'];
    $created = $_POST['created'];
    $modified = $_POST['modified'];

    $sql = "INSERT INTO categories (title, status, created, modified) VALUES ('$title', '$status', '$created', '$modified')";
    mysqli_query($conn, $sql);
    header("Location: categories.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Add New Category</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Created Date</label>
            <input type="date" name="created" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Modified Date</label>
            <input type="date" name="modified" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>