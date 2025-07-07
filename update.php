<?php
include 'db.php';
$id = $_GET['id'];

$app = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM applications WHERE id = $id"));
$categories = mysqli_query($conn, "SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $posted_date = $_POST['posted_date'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $status = isset($_POST['status']) ? 1 : 0;

    $image = $app['image'];
    $image_dir = $app['image_dir'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_dir = 'uploads';
        $target = $image_dir . '/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $sql = "UPDATE applications SET category_id='$category_id', posted_date='$posted_date', author='$author', 
            title='$title', review='$review', image='$image', image_dir='$image_dir', status='$status' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Edit Application Review</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="<?= $app['title'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" value="<?= $app['author'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Posted Date</label>
            <input type="date" name="posted_date" value="<?= $app['posted_date'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $app['category_id'] ? 'selected' : '' ?>><?= $cat['title'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Review</label>
            <textarea name="review" class="form-control" required><?= $app['review'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <p>Current: <?= $app['image'] ?></p>
        </div>
        <div class="mb-3">
            <input type="checkbox" name="status" <?= $app['status'] ? 'checked' : '' ?>> Active
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>