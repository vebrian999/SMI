<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login_admin.php');
    exit();
}

require_once '../functions/db.php';

// Check if an id is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $query = "DELETE FROM articles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // bind as integer

    if ($stmt->execute()) {
        // Redirect to article_admin.php with a success message
        $_SESSION['message'] = "Article deleted successfully!";
    } else {
        // Redirect to article_admin.php with an error message
        $_SESSION['message'] = "Error deleting article: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid article ID.";
}

// Redirect to the articles admin page
header("Location: article_admin.php");
exit();
