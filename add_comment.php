<?php
include 'db.php';

$application_id = $_POST['application_id'];
$name = $_POST['name'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];

$sql = "INSERT INTO comments (application_id, name, comment, rating) 
        VALUES ('$application_id', '$name', '$comment', '$rating')";

mysqli_query($conn, $sql);
header("Location: index.php");
?>
