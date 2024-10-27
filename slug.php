<?php
require_once 'functions/db.php';

// Update semua artikel yang belum memiliki slug
$query = "SELECT id, title FROM articles WHERE slug IS NULL OR slug = ''";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $slug = createSlug($row['title']);
    
    // Pastikan slug unik dengan menambahkan nomor jika perlu
    $baseSlug = $slug;
    $counter = 1;
    while (true) {
        $checkQuery = "SELECT id FROM articles WHERE slug = ? AND id != ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("si", $slug, $row['id']);
        $stmt->execute();
        if ($stmt->get_result()->num_rows === 0) break;
        $slug = $baseSlug . '-' . $counter++;
    }
    
    // Update artikel dengan slug baru
    $updateQuery = "UPDATE articles SET slug = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $slug, $row['id']);
    $stmt->execute();
}
?>