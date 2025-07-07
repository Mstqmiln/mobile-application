<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $posted_date = $_POST['posted_date'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $status = isset($_POST['status']) ? 1 : 0;

    $image = $_FILES['image']['name'];
    $image_dir = 'uploads';
    $target = $image_dir . '/' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO applications (category_id, posted_date, author, title, review, image, image_dir, status) 
            VALUES ('$category_id', '$posted_date', '$author', '$title', '$review', '$image', '$image_dir', '$status')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}

$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Application</title>
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
    <h3>Add New Application Review</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Posted Date</label>
            <input type="date" name="posted_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Review</label>
            <textarea name="review" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <input type="checkbox" name="status" checked> Active
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>