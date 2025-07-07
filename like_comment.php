<?php
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn, "UPDATE comments SET likes = likes + 1 WHERE id = $id");

header("Location: index.php");
?>
