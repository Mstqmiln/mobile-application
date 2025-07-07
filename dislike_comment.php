<?php
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn, "UPDATE comments SET dislikes = dislikes + 1 WHERE id = $id");

header("Location: index.php");
?>
