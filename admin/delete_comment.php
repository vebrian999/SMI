<?php
session_start();
require_once '../functions/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete comment
    $query = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Comment deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting comment.";
    }
}

header("Location: comments_admin.php");
exit();
