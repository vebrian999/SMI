<?php
require_once './functions/db.php';  // Menghubungkan ke database

function titleToSlug($title) {
    $slug = strtolower($title);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Periksa apakah ada query pencarian
$q = isset($_GET['q']) ? $_GET['q'] : '';

if (!empty($q)) {
    // Jalankan pencarian hanya jika ada kata kunci
    $query = "SELECT id, title, content, created_at, author 
              FROM articles 
              WHERE title LIKE ? OR content LIKE ?
              ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $likeQuery = '%' . $q . '%';
    $stmt->bind_param('ss', $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="max-h-96 overflow-y-auto p-4 border rounded-lg bg-white shadow-md">'; // Wrapper untuk hasil pencarian dengan scroll

    if ($result->num_rows > 0) {
        // Tampilkan hasil pencarian
        while ($row = $result->fetch_assoc()) {
            echo '<div class="p-4 border-b">';
            echo '<a href="article/' . titleToSlug($row['title']) . '" class="text-primary-color text-base font-bold">'
                 . htmlspecialchars($row['title']) . '</a>';

            echo '<p class="text-xs text-gray-500">' 
                 . date('d F Y', strtotime($row['created_at'])) . ' - ' 
                 . htmlspecialchars($row['author']) . '</p>';
            echo '<p class="text-gray-600 text-sm">'
                 . (substr(strip_tags($row['content']), 0, 50)) . '...</p>';
            echo '</div>';
        }
    } else {
        // Jika tidak ada hasil ditemukan
        echo '<p class="p-4 text-gray-500">Tidak ada hasil yang ditemukan untuk "<strong>' 
             . htmlspecialchars($q) . '</strong>".</p>';
    }
    
    echo '</div>'; // Tutup wrapper hasil pencarian
}
?>