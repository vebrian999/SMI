<?php
require_once './functions/db.php';  // Koneksi ke database

// Konfigurasi pagination
$articlesPerPage = 6; 
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $articlesPerPage;

// Query untuk menghitung total artikel
$totalArticlesQuery = "SELECT COUNT(*) as total FROM articles";
$totalArticlesResult = $conn->query($totalArticlesQuery);
$totalArticles = $totalArticlesResult->fetch_assoc()['total'];

// Query untuk mengambil artikel dan jumlah komentar dengan pagination
$query = "SELECT a.id, a.title, a.content, a.image, a.category, a.created_at, a.author, a.views, 
           (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id) AS total_comments
    FROM articles a
    ORDER BY a.created_at DESC
    LIMIT $articlesPerPage OFFSET $offset";
$result = $conn->query($query);

// Menghitung total halaman
$totalPages = ceil($totalArticles / $articlesPerPage);

// Query untuk mengambil 3 artikel dengan komentar dan views terbanyak (Popular Article)
$popularQuery = "SELECT a.id, a.title, a.content, a.image, a.category, a.created_at, a.author, a.views,
           (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id) AS total_comments
    FROM articles a
    ORDER BY total_comments DESC, a.views DESC
    LIMIT 3";
$popularResult = $conn->query($popularQuery);
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

   <?php
   require_once './header.php';
   ?>



    <main class="mx-4 md:mx-28">
      <div id="content" class="container mx-auto">

      <?php if ($current_page == 1): ?>
      <section class="mt-10 md:-mx-14">
        <article>
          <div class="w-1/2">
            <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
              <h1 class="md:text-4xl text-xl px-4 font-semibold text-white">Popular Article</h1>
            </div>
          </div>    

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
            <?php while ($popularRow = $popularResult->fetch_assoc()): ?>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="article.php?id=<?php echo $popularRow['id']; ?>">
                  <img class="rounded-t-lg w-[457px] h-[310px]" src="./uploads/<?php echo $popularRow['image']; ?>" alt="<?php echo $popularRow['title']; ?>" />
                </a>
                <div class="p-5">
                  <div class="flex justify-between items-center">
                    <span class="bg-primary-color text-white px-2 py-1 rounded text-sm"><?php echo $popularRow['category']; ?></span>
                    <p class="text-primary-color font-medium my-3">Written by <?php echo htmlspecialchars($popularRow['author']); ?></p>
                  </div>
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
                  <a href="article.php?id=<?php echo $popularRow['id']; ?>">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo htmlspecialchars($popularRow['title']); ?></h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">
                    <?php 
                    echo htmlspecialchars(substr(strip_tags($popularRow['content']), 0, 100)) . 
                        (strlen(strip_tags($popularRow['content'])) > 100 ? '...' : ''); 
                    ?>
                  </p>
                  <a href="article.php?id=<?php echo $popularRow['id']; ?>"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
          <?php endwhile; ?>
            </div>
          </article> 
        </section>
        <?php endif; ?>


        <section class="mt-20 md:-mx-14 ">
          <article>
            <div class="w-1/2">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl px-4 font-semibold text-white">All Article</h1>
              </div>
            </div>     
            
            
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
                  <?php while ($row = $result->fetch_assoc()): ?>
                      <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                          <a href="article.php?id=<?php echo $row['id']; ?>">
                              <img class="rounded-t-lg w-[457px] h-[310px]" src="./uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" />
                          </a>
                          <div class="p-5">
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
                              <a href="article.php?id=<?php echo $row['id']; ?>">
                                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo htmlspecialchars($row['title']); ?></h5>
                              </a>
                              <p class="mb-5 font-normal text-gray-400">
                                  <?php 
                                  echo htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) . 
                                      (strlen(strip_tags($row['content'])) > 100 ? '...' : ''); 
                                  ?>
                              </p>
                              <a href="article.php?id=<?php echo $row['id']; ?>"
                                class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                                  Read more
                                  <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                  </svg>
                              </a>
                          </div>
                      </div>
                  <?php endwhile; ?>
              </div>


            <!-- Pagination -->
            <div class="flex items-center justify-center md:justify-end gap-x-2 md:gap-x-3 mt-8 md:my-10 md:mb-32 lg:mt-12">
                <!-- Tombol Sebelumnya -->
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?php echo $current_page - 1; ?>" 
                      class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] 
                      w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                        <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18L1 9.5L5.5 5.25L10 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php endif; ?>

                <!-- Tautan Halaman -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" 
                      class="font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] 
                      inline-flex justify-center items-center border rounded-md 
                      <?php echo $i == $current_page ? 'bg-[#682E74] text-white' : 'bg-slate-100 text-gray-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <!-- Tombol Berikutnya -->
                <?php if ($current_page < $totalPages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>" 
                      class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] 
                      w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
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
  </body>
</html>
