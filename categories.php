<?php
include 'db.php';

// Fetch all categories
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY status DESC, title ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">App Reviews</a>
        <div>
            <a href="index.php" class="btn btn-outline-light me-2">Back to Home</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Application Categories</h3>
        <div>
            <a href="create_category.php" class="btn btn-primary">Add Category</a>
        </div>
    </div>

    <?php
    $hasActive = false;
    $hasInactive = false;

    // First loop to check if we have active or inactive
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] == 'active') {
            $active[] = $row;
            $hasActive = true;
        } else {
            $inactive[] = $row;
            $hasInactive = true;
        }
    }
    ?>

    <?php if ($hasActive): ?>
        <h5 class="mt-4">✅ Active Categories</h5>
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($active as $row) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= date('d M Y', strtotime($row['created'])) ?></td>
                        <td><?= date('d M Y', strtotime($row['modified'])) ?></td>
                        <td>
                            <a href="edit_category.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_category.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($hasInactive): ?>
        <h5 class="mt-4">🚫 Inactive Categories</h5>
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($inactive as $row) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= date('d M Y', strtotime($row['created'])) ?></td>
                        <td><?= date('d M Y', strtotime($row['modified'])) ?></td>
                        <td>
                            <a href="edit_category.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_category.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
