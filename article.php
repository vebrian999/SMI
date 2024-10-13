<?php
require_once './functions/db.php';  // Meng-include koneksi database

// Mendapatkan ID artikel dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    // Jika artikel tidak ditemukan
    if (!$article) {
        echo "Artikel tidak ditemukan!";
        exit;
    }

    // Mengambil artikel lain untuk sidebar
    $sidebarQuery = "SELECT id, title, image, created_at, author, content FROM articles WHERE id != ? LIMIT 3";
    $sidebarStmt = $conn->prepare($sidebarQuery);
    $sidebarStmt->bind_param("i", $id);
    $sidebarStmt->execute();
    $sidebarResult = $sidebarStmt->get_result();
    $sidebarArticles = $sidebarResult->fetch_all(MYSQLI_ASSOC);

    // Proses pengiriman komentar
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        // Query untuk menyimpan komentar
        $insertCommentQuery = "INSERT INTO comments (article_id, name, comment) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertCommentQuery);
        $insertStmt->bind_param("iss", $id, $name, $comment);
        if ($insertStmt->execute()) {
            // Jika berhasil, redirect ke halaman yang sama untuk menampilkan komentar terbaru
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            echo "Gagal menambahkan komentar!";
        }
    }

    // Mengambil komentar untuk artikel
    $commentsQuery = "SELECT * FROM comments WHERE article_id = ? ORDER BY created_at DESC";
    $commentsStmt = $conn->prepare($commentsQuery);
    $commentsStmt->bind_param("i", $id);
    $commentsStmt->execute();
    $commentsResult = $commentsStmt->get_result();
    $comments = $commentsResult->fetch_all(MYSQLI_ASSOC);
} else {
    echo "ID artikel tidak diberikan!";
    exit;
}

// Gambar profil default
$defaultProfileImage = "https://i.pinimg.com/564x/a6/67/73/a667732975f0f1da1a0fd4625e30d776.jpg"; // Ganti dengan path gambar profil default Anda
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stress Management Indoensia</title>
    <link href="./css/output.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>



<style>
  #content ul, #content ol {
      list-style: initial;
      margin-left: 20px;
      padding-left: 20px;
  }
</style>


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>


   <?php
   require_once './header.php';
   ?>

   
    <main class="md:flex space-x-5 md:mx-20 mx-4 md:py-8">
      <div id="content" class="container md:w-3/4">
        <section>
          <article>
            <div class="">
              <img class="rounded-xl w-full" src="./uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" />
            </div>
            <!-- Author Section -->
            <div class="text-white py-2 my-6 rounded-xl flex items-center space-x-4">
              <p class="bg-primary-color text-xl font-medium py-2 px-4 rounded-xl">
                Written by: <?php echo htmlspecialchars($article['author']); ?>
              </p>
            <div class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-primary-color">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
              <p class="text-primary-color text-lg">
                <?php 
                  // Menampilkan tanggal pembuatan artikel dengan format 'd-m-Y'
                  echo date('d-m-Y', strtotime($article['created_at'])); 
                ?>
              </p>
            </div>

            </div>

            <h1 class="text-4xl  font-semibold mb-3"><?php echo htmlspecialchars($article['title']); ?></h1>
            <div class="pt-2.5 text-base text-[#28254C] leading-7"><?php echo nl2br(($article['content'])); ?></div>
        </section>

        <section class="bg-white py-8 lg:py-16 antialiased">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Comments (<?= count($comments) ?>)</h2>
        </div>
        <form method="POST" class="mb-6">
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                <label for="name" class="sr-only">Your name</label>
                <input type="text" id="name" name="name" required class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none" placeholder="Your name" />
            </div>
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" name="comment" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg bg-[#682E74]">Post comment</button>
        </form>
        <?php foreach ($comments as $comment): ?>
         <article class="p-6 mb-3 text-base bg-white rounded-lg">
                <footer class="flex items-center mb-2">
                    <img src="<?= $defaultProfileImage ?>" alt="Profile Image" class="w-6 h-6 rounded-full mr-3">
                    <div class="flex space-x-3">
                        <p class="inline-flex items-center text-sm text-gray-900 font-semibold">
                            <?= htmlspecialchars($comment['name']) ?>
                        </p>
                        <p class="text-sm text-gray-600">
                            <time pubdate datetime="<?= $comment['created_at'] ?>" title="<?= $comment['created_at'] ?>">
                                <?= date("M. d, Y", strtotime($comment['created_at'])) ?>
                            </time>
                        </p>
                    </div>
                </footer>
                <p class="text-gray-500"><?= htmlspecialchars($comment['comment']) ?></p>
            </article>
                   <!-- Garis pembatas antara komentar -->
            <hr class="my-4 border-t border-gray-300">
        <?php endforeach; ?>
    </div>
</section>
      </div>



<aside class="w-full md:w-1/3 md:my-0 my-5 space-y-4 md:sticky md:top-32 self-start">
    <?php foreach ($sidebarArticles as $sidebarArticle): ?>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="flex items-start gap-6">
            <div class="flex-shrink-0 w-36 h-36">
                <img src="./uploads/<?php echo htmlspecialchars($sidebarArticle['image']); ?>" alt="<?php echo htmlspecialchars($sidebarArticle['title']); ?>" class="w-[144px] h-[144px] object-cover rounded-md" />
            </div>
            <div class="flex-1">
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-gray-500"><?php echo date('M d, Y', strtotime($sidebarArticle['created_at'])); ?></p>
                    <span class="border-l border-gray-400 h-4"></span>
                    <p class="text-sm text-gray-500">By <?php echo htmlspecialchars($sidebarArticle['author']); ?></p>
                </div>


                <h1 class="font-semibold text-sm text-gray-700 mb-2">
                    <?php 
                    echo htmlspecialchars(
                        implode(' ', array_slice(explode(' ', strip_tags($sidebarArticle['title'])), 0, 7)) 
                        . (str_word_count($sidebarArticle['title']) > 7 ? '...' : '')
                    ); 
                    ?>
                </h1>


                <!-- Mengubah dari summary ke content -->
              <div class="text-sm text-gray-600">
                  <?php 
                  // Menghapus tag HTML dari konten
                  $cleanContent = strip_tags($sidebarArticle['content']); 
                  // Memecah string menjadi array kata
                  $words = explode(' ', $cleanContent); 
                  // Mengambil 7 kata pertama
                  $shortenedContent = implode(' ', array_slice($words, 0, 5)); 
                  // Menambahkan ellipsis jika lebih dari 7 kata
                  echo nl2br(htmlspecialchars($shortenedContent . (count($words) > 5 ? '...' : ''))); 
                  ?>
              </div>


                <a href="article.php?id=<?php echo $sidebarArticle['id']; ?>" class="text-primary-color text-sm hover:underline">Read more</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</aside>

    </main>

    <!-- awal footer -->
      <?php require_once('footer.php'); ?>             
    <!-- akhir footer -->
  </body>
</html>
