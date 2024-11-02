<?php
require_once './functions/db.php';

try {
    // Validasi dan sanitasi input menggunakan metode yang tidak deprecated
    $allowedCategories = ['all', 'latest', 'Love', 'Worklife', 'Parenting', 'Healthy', 'Financial', 'Humaniora'];
    
    // Menggunakan htmlspecialchars sebagai pengganti FILTER_SANITIZE_STRING
    $category = isset($_GET['category']) ? htmlspecialchars(strip_tags($_GET['category'])) : 'all';
    $category = in_array($category, $allowedCategories) ? $category : 'all';

    // Validasi halaman
    $current_page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1;
    $current_page = ($current_page < 1) ? 1 : $current_page;
    
    // Konfigurasi pagination
    $articlesPerPage = 6;
    $offset = ($current_page - 1) * $articlesPerPage;

    // Prepare statement untuk WHERE clause
    $whereClause = "";
    $params = [];
    if ($category !== 'all' && $category !== 'latest') {
        $whereClause = "WHERE a.category = ?";
        $params[] = $category;
    }

    // Query untuk menghitung total artikel
    $totalArticlesQuery = $conn->prepare("SELECT COUNT(*) as total FROM articles a $whereClause");
    if (!empty($params)) {
        $totalArticlesQuery->bind_param('s', $params[0]);
    }
    $totalArticlesQuery->execute();
    $totalArticlesResult = $totalArticlesQuery->get_result();
    $totalArticles = $totalArticlesResult->fetch_assoc()['total'];
    $totalPages = ceil($totalArticles / $articlesPerPage);

    // Query utama untuk artikel
    $orderClause = "ORDER BY a.created_at DESC";
    $mainQuery = "SELECT 
                    a.id, 
                    a.title, 
                    a.content, 
                    a.image, 
                    a.category, 
                    a.created_at, 
                    a.author, 
                    a.views,
                    COUNT(c.id) as total_comments
                FROM articles a
                LEFT JOIN comments c ON a.id = c.article_id
                $whereClause
                GROUP BY a.id
                $orderClause
                LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($mainQuery);
    if (!empty($params)) {
        $stmt->bind_param('sii', $params[0], $articlesPerPage, $offset);
    } else {
        $stmt->bind_param('ii', $articlesPerPage, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Query untuk artikel populer
    $popularQuery = "SELECT 
                        a.id, 
                        a.title, 
                        a.content, 
                        a.image, 
                        a.category, 
                        a.created_at, 
                        a.author, 
                        a.views,
                        COUNT(c.id) as total_comments
                    FROM articles a
                    LEFT JOIN comments c ON a.id = c.article_id
                    GROUP BY a.id
                    ORDER BY total_comments DESC, a.views DESC
                    LIMIT 3";
    $popularResult = $conn->query($popularQuery);

} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    $result = false;
    $popularResult = false;
    $totalPages = 0;
}

function titleToSlug($title) {
    $slug = strtolower($title);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stress Management Indoensia</title>
    <link href="./css/output.css?v=1.0.1" rel="stylesheet" />
    <link href="./css/style.css?v=1.0.1" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
    html {
        scroll-behavior: smooth;
    }
    </style>
      </head>
      <body>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
      <?php
      require_once './header.php';
      ?>
      <main class="mx-4 md:mx-28">
        <div id="content" class="container mx-auto">

<!-- CATEGORY LIST -->
<div class="md:-mx-8 md:mb-10">
    <div class="container">
        <!-- Mobile Dropdown for Categories -->
        <div class="md:hidden mb-4 ">
            <select onchange="location = this.value;" class="w-full py-2.5 px-4 mb-4 rounded-md border border-slate-200 text-base font-semibold bg-slate-100 text-primary-color">
                <option value="?category=all#article-section" <?php echo $category === 'all' ? 'selected' : ''; ?>>All Category</option>
                <option value="?category=latest#article-section" <?php echo $category === 'latest' ? 'selected' : ''; ?>>Latest</option>
                <option value="?category=Love#article-section" <?php echo $category === 'Love' ? 'selected' : ''; ?>>Love</option>
                <option value="?category=Worklife#article-section" <?php echo $category === 'Worklife' ? 'selected' : ''; ?>>Worklife</option>
                <option value="?category=Parenting#article-section" <?php echo $category === 'Parenting' ? 'selected' : ''; ?>>Parenting</option>
                <option value="?category=Healthy#article-section" <?php echo $category === 'Healthy' ? 'selected' : ''; ?>>Healthy</option>
                <option value="?category=Financial#article-section" <?php echo $category === 'Financial' ? 'selected' : ''; ?>>Financial</option>
                <option value="?category=Humaniora#article-section" <?php echo $category === 'Humaniora' ? 'selected' : ''; ?>>Humaniora</option>
            </select>
        </div>

        <!-- Desktop Category Buttons -->
        <div class="hidden md:flex flex-wrap items-center space-x-5">
            <!-- All Category -->
            <a href="?category=all#article-section"
                class="kategori-article-button <?php echo $category === 'all' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                All Category
            </a>
            <!-- Latest -->
            <a href="?category=latest#article-section"
                class="kategori-article-button <?php echo $category === 'latest' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Latest
            </a>
            <!-- Love -->
            <a href="?category=Love#article-section"
                class="kategori-article-button <?php echo $category === 'Love' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Love
            </a>
            <!-- Worklife -->
            <a href="?category=Worklife#article-section"
                class="kategori-article-button <?php echo $category === 'Worklife' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Worklife
            </a>
            <!-- Parenting -->
            <a href="?category=Parenting#article-section"
                class="kategori-article-button <?php echo $category === 'Parenting' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Parenting
            </a>
            <!-- Healthy -->
            <a href="?category=Healthy#article-section"
                class="kategori-article-button <?php echo $category === 'Healthy' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Healthy
            </a>
            <!-- Financial -->
            <a href="?category=Financial#article-section"
                class="kategori-article-button <?php echo $category === 'Financial' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Financial
            </a>
            <!-- Humaniora -->
            <a href="?category=Humaniora#article-section"
                class="kategori-article-button <?php echo $category === 'Humaniora' ? 'kategori-article-active bg-[#682E74] text-white' : 'bg-slate-100 text-primary-color'; ?>
                whitespace-nowrap md:text-lg text-base font-semibold border border-slate-200 py-2.5 px-6 rounded-tl-2xl rounded-br-2xl">
                Humaniora
            </a>
        </div>
    </div>
</div>


      <?php if ($current_page == 1): ?>
        <section class="md:mb-24 mb-14 md:-mx-8">
          <article>
            <div class="relative flex justify-start">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-base text-white md:px-16 px-4">Popular Article</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full w-full -z-10 bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>   
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-14">           
           <?php while ($popularRow = $popularResult->fetch_assoc()): ?>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl flex flex-col h-full">
                <a href="article/<?php echo titleToSlug($popularRow['title']); ?>">
                    <img class="rounded-t-lg w-[457px] h-[310px] object-cover" 
                         src="./uploads/<?php echo htmlspecialchars($popularRow['image']); ?>" 
                         alt="<?php echo htmlspecialchars($popularRow['title']); ?>" />
                </a>
                <div class="p-5 flex flex-col flex-grow">
                  <!-- Bagian atas card -->
                  <div class="flex justify-between items-center">
                    <span class="bg-primary-color text-white px-2 py-1 rounded text-sm"><?php echo $popularRow['category']; ?></span>
                    <p class="text-primary-color font-medium my-3">Written by <?php echo htmlspecialchars($popularRow['author']); ?></p>
                  </div>
                  
                  <!-- Metadata (tanggal, views, comments) -->
                  <div class="text-gray-400 font-normal my-3 flex items-center gap-4">
                    <span><?php echo date('d F Y', strtotime($popularRow['created_at'])); ?></span>
                    <span class="mx-1">|</span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                      </svg>
                      <span><?php echo $popularRow['views']; ?></span>
                    </span>
                    <span class="mx-1">|</span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12 2.25c-2.429 0-4.817.178-7.152.521C2.87 3.061 1.5 4.795 1.5 6.741v6.018c0 1.946 1.37 3.68 3.348 3.97.877.129 1.761.234 2.652.316V21a.75.75 0 0 0 1.28.53l4.184-4.183a.39.39 0 0 1 .266-.112c2.006-.05 3.982-.22 5.922-.506 1.978-.29 3.348-2.023 3.348-3.97V6.741c0-1.947-1.37-3.68-3.348-3.97A49.145 49.145 0 0 0 12 2.25ZM8.25 8.625a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Zm2.625 1.125a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                      </svg>
                      <span><?php echo $popularRow['total_comments']; ?></span>
                    </span>
                  </div>
                  
                  <!-- Konten card -->
                  <div class="flex-grow">
                    <a href="article/<?php echo titleToSlug($popularRow['title']); ?>">
                        <h5 class="mb-2 md:text-2xl font-semibold tracking-tight text-gray-900">
                            <?php echo htmlspecialchars($popularRow['title']); ?>
                        </h5>
                    </a>
                    <p class="mb-5 font-normal text-gray-400">
                      <?php 
                      echo htmlspecialchars(substr(strip_tags($popularRow['content']), 0, 100)) . 
                          (strlen(strip_tags($popularRow['content'])) > 100 ? '...' : ''); 
                      ?>
                    </p>
                  </div>

                  <!-- Button yang selalu berada di bawah -->
                  <div class="mt-auto">
                    <a href="article/<?php echo titleToSlug($popularRow['title']); ?>"
                        class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>

            </div>
          </article> 
        </section>
        <?php endif; ?>
        <!-- Tambahkan id ini pada section artikel -->
        <section id="article-section" class="md:my-24 my-16 md:-mx-8">
                  <article>
                    <div class="relative flex md:justify-end">
                      <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
                      <div class="relative">
                        <!-- Background utama dengan bg-primary-color -->
        <div class="bg-primary-color px-10 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
            <h1 class="md:text-4xl font-semibold text-center text-base text-white px-4">
                <?php 
                if($category === 'all') {
                    echo 'All Articles';
                } elseif($category === 'latest') {
                    echo 'Latest Articles';
                } else {
                    echo ucfirst($category) . ' Articles';
                }
                ?>
            </h1>
        </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full -z-10 w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>    
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-14">
                  <?php while ($row = $result->fetch_assoc()): ?>
                      <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl flex flex-col h-full">
                 <a href="article/<?php echo titleToSlug($row['title']); ?>">
                    <img class="rounded-t-lg w-[457px] h-[310px] object-cover" 
                         src="./uploads/<?php echo htmlspecialchars($row['image']); ?>" 
                         alt="<?php echo htmlspecialchars($row['title']); ?>" />
                </a>
                          <div class="p-5 flex flex-col flex-grow">
                              <div class="flex justify-between items-center">
                                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm"><?php echo $row['category']; ?></span>
                                  <p class="text-primary-color font-medium my-3">Written by <?php echo htmlspecialchars($row['author']); ?></p>
                              </div>
                              <div class="text-gray-400 font-normal my-3 flex items-center gap-4">
                                  <!-- Tanggal Pembuatan Artikel -->
                                  <span><?php echo date('d F Y', strtotime($row['created_at'])); ?></span>
                                  <span class="mx-1">|</span>
                                  <!-- Views dengan Ikon Mata -->
                                  <span class="flex items-center gap-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                          <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                          <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                      </svg>
                                      <span><?php echo $row['views']; ?></span>
                                  </span>

                                  <span class="mx-1">|</span>

                                  <!-- Komentar dengan Ikon Pesan -->
                                  <span class="flex items-center gap-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                          <path fill-rule="evenodd" d="M12 2.25c-2.429 0-4.817.178-7.152.521C2.87 3.061 1.5 4.795 1.5 6.741v6.018c0 1.946 1.37 3.68 3.348 3.97.877.129 1.761.234 2.652.316V21a.75.75 0 0 0 1.28.53l4.184-4.183a.39.39 0 0 1 .266-.112c2.006-.05 3.982-.22 5.922-.506 1.978-.29 3.348-2.023 3.348-3.97V6.741c0-1.947-1.37-3.68-3.348-3.97A49.145 49.145 0 0 0 12 2.25ZM8.25 8.625a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Zm2.625 1.125a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                                      </svg>
                                      <span><?php echo $row['total_comments']; ?></span>
                                  </span>
                              </div>
                              <div class="flex-grow">
                   <a href="article/<?php echo titleToSlug($row['title']); ?>">
                        <h5 class="mb-2 md:text-2xl font-semibold tracking-tight text-gray-900">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h5>
                    </a>
                              <p class="mb-5 font-normal text-gray-400">
                                  <?php 
                                  echo htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) . 
                                      (strlen(strip_tags($row['content'])) > 100 ? '...' : ''); 
                                  ?>
                              </p>
                             </div>                 
                             <div class="mt-auto">
                    <a href="article/<?php echo titleToSlug($row['title']); ?>"
                        class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                              </div>
                          </div>
                      </div>
                  <?php endwhile; ?>
              </div>
            <!-- Pagination -->
              <div class="flex items-center justify-center md:justify-end gap-x-2 md:gap-x-3 my-8 md:my-10 md:mb-32 lg:mt-12">
                  <?php if ($current_page > 1): ?>
                      <a href="?page=<?php echo ($current_page - 1); ?>&category=<?php echo urlencode($category); ?>" 
                        class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                          <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M10 18L1 9.5L5.5 5.25L10 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                      </a>
                  <?php endif; ?>

                  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                      <a href="?page=<?php echo $i; ?>&category=<?php echo urlencode($category); ?>" 
                        class="font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md <?php echo $i == $current_page ? 'bg-[#682E74] text-white' : 'bg-slate-100 text-gray-700'; ?>">
                          <?php echo $i; ?>
                      </a>
                  <?php endfor; ?>

                  <?php if ($current_page < $totalPages): ?>
                      <a href="?page=<?php echo ($current_page + 1); ?>&category=<?php echo urlencode($category); ?>" 
                        class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                          <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 18L10 9.5L1 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                      </a>
                  <?php endif; ?>
              </div>
          </article>
        </section>
      </div>

      <!-- awal footer -->
        <?php require_once('footer.php'); ?>
      <!-- akhir footer -->
    </main>
    <script>
    // Check if URL contains hash
    if(window.location.hash) {
        // Wait for page to load
        window.addEventListener('load', function() {
            // Get the element
            const element = document.querySelector(window.location.hash);
            if(element) {
                // Scroll to element with offset (adjust 100 to your needs)
                window.scrollTo({
                    top: element.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    }
</script>
  </body>
</html>
