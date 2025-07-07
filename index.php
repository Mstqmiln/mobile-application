<?php
include 'db.php';

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT a.*, c.title AS category_title 
          FROM applications a 
          JOIN categories c ON a.category_id = c.id 
          WHERE a.title LIKE '%$search%' OR a.review LIKE '%$search%'";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">App Reviews</a>
        <div>
            <a href="create.php" class="btn btn-outline-light me-2">Add Review</a>
            <a href="categories.php" class="btn btn-outline-light">Categories</a>
        </div>
    </div>
</nav>

<div class="container">
    <!-- Search -->
    <form class="mb-4" method="GET">
        <input type="text" name="search" class="form-control" placeholder="Search apps..." value="<?= htmlspecialchars($search) ?>">
    </form>

    <h3 class="mb-3">All Application Reviews</h3>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card mb-4">
            <div class="row g-0">
                <?php if (!empty($row['image'])) { ?>
                <div class="col-md-4">
                    <img src="<?= $row['image_dir'] . '/' . $row['image'] ?>" class="img-fluid rounded-start" alt="App image">
                </div>
                <?php } ?>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['title'] ?></h5>
                        <p class="card-text"><?= $row['review'] ?></p>
                        <p class="card-text">
                            <small class="text-muted">Author: <?= $row['author'] ?></small><br>
                            <small class="text-muted">Category: <?= $row['category_title'] ?></small><br>
                            <small class="text-muted">Posted: <?= date('d M Y', strtotime($row['posted_date'])) ?></small><br>
                            <small class="text-muted">Created: <?= date('d M Y, h:i A', strtotime($row['created'])) ?></small><br>
                            <small class="text-muted">Modified: <?= date('d M Y, h:i A', strtotime($row['modified'])) ?></small><br>
                            <strong>Status:</strong>
                            <?php if ($row['status'] == 1) {
                                echo "<span class='text-success'>Active</span>";
                            } else {
                                echo "<span class='text-danger'>Inactive</span>";
                            } ?>
                        </p>

                        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        <a href="export.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Export PDF</a>

                        <hr>
                        <h6>Comments:</h6>
                        <?php
                        $app_id = $row['id'];
                        $comments = mysqli_query($conn, "SELECT * FROM comments WHERE application_id = $app_id AND status = 1 ORDER BY created DESC");
                        while($c = mysqli_fetch_assoc($comments)) {
                            echo "<div class='mb-2'>
                                    <strong>{$c['name']} (Rating: {$c['rating']}/5)</strong>: {$c['comment']}<br>
                                    <small class='text-muted'>" . date('d M Y, h:i A', strtotime($c['created'])) . "</small>

                                    <a href='like_comment.php?id={$c['id']}' class='btn btn-sm btn-success mt-1 me-1'>👍 {$c['likes']}</a>
                                    <a href='dislike_comment.php?id={$c['id']}' class='btn btn-sm btn-danger mt-1'>👎 {$c['dislikes']}</a>
                                  </div>";
                        }
                        
                        ?>
                    

                        <form action="add_comment.php" method="POST" class="mt-3">
                            <input type="hidden" name="application_id" value="<?= $app_id ?>">
                            <div class="mb-2">
                                <input type="text" name="name" class="form-control" placeholder="Your name" required>
                            </div>
                            <div class="mb-2">
                                <textarea name="comment" class="form-control" placeholder="Your comment" required></textarea>
                            </div>
                            <div class="mb-2">
                                <input type="number" name="rating" class="form-control" placeholder="Rating (1-5)" min="1" max="5" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary">Add Comment</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
