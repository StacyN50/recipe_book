<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    exit("unauthorized");
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'];
$rating = $_POST['rating'];

/*
========================================
UPSERT RATING
========================================
*/
$sql = "INSERT INTO ratings (user_id, recipe_id, rating)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE rating = VALUES(rating)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $recipe_id, $rating);

if ($stmt->execute()) {
    echo "rated";
} else {
    echo "error";
}
?>