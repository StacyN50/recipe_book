<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    exit("unauthorized");
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? 0;

/*
========================================
SECURE DELETE (ONLY OWNER CAN DELETE)
========================================
*/
$sql = "DELETE FROM recipes WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    echo "deleted";
} else {
    echo "error";
}
?>