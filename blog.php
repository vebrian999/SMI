<?php
require_once './functions/db.php';  // Meng-include koneksi database

// Query untuk mengambil semua artikel
$query = "SELECT id, title, content, image, category, created_at, author FROM articles ORDER BY created_at DESC";
$result = $conn->query($query);
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
        <section class="mt-10 md:-mx-14">
          <article>
            <div class="w-1/2">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl px-4 font-semibold text-white">Latest Article</h1>
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
                        <!-- layout kureng -->
                        <p class="text-primary-color  font-medium my-3">Written by <?php echo htmlspecialchars($row['author']); ?></p>
                    </div>
                    <p class="text-gray-400 font-normal my-3"><?php echo date('d F Y', strtotime($row['created_at'])); ?></p>
                    <a href="article.php?id=<?php echo $row['id']; ?>">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo htmlspecialchars($row['title']); ?></h5>
                    </a>
                 <p class="mb-5 font-normal text-gray-400"><?php 
        // Menghapus tag HTML, melindungi dari XSS, dan memotong teks menjadi 100 karakter
        echo htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) . (strlen(strip_tags($row['content'])) > 100 ? '...' : ''); 
    ?>...</p>
                    <a
                        href="article.php?id=<?php echo $row['id']; ?>"
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



            <!-- pagenation -->
            <div class="flex items-center justify-center md:justify-end gap-x-2 md:gap-x-3 mt-8 md:my-10 lg:mt-12">
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 18L1 9.5L5.5 5.25L10 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
              <button type="button" class="bg-[#682E74] text-white font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">1</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">2</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">3</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">4</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 18L10 9.5L1 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
            </div>
          </article>
        </section>

        <!-- <section class="mt-20 md:-mx-14">
          <article>
            <div class="md:flex justify-end">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl font-semibold px-4 md:px-0 text-white text-right">All Articles</h1>
              </div>
            </div>
            <div class="my-10 md:flex md:space-y-7 space-y-7 md:space-x-7 justify-center">
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">BERITA ATAU PRESS RELEASE TENTANG STRESS MANAGEMENT INDONESIA DAN HAPPY SELF</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat.</p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105 ml-auto">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">INNER CHILD ART JOURNALING</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat. Aliquam quis tempor libero, non convallis dui. Vestibulum ante ipsum primis in
                    faucibus orci luctus et ultrices posuere cubilia curae;
                  </p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">MANFAAT SELF LOVE JOURNALING PADA DIRI INDIVIDU</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat.</p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <div class="my-10 md:flex md:space-y-7 space-y-7 md:space-x-7 justify-center">
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">BERITA ATAU PRESS RELEASE TENTANG STRESS MANAGEMENT INDONESIA DAN HAPPY SELF</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat.</p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">INNER CHILD ART JOURNALING</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat. Aliquam quis tempor libero, non convallis dui. Vestibulum ante ipsum primis in
                    faucibus orci luctus et ultrices posuere cubilia curae;
                  </p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
              <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                <a href="#">
                  <img class="rounded-t-lg" src="./asset/card-article.png" alt="" />
                </a>
                <div class="p-5">
                  <span class="bg-primary-color text-white px-2 py-1 rounded text-sm">NEWS</span>
                  <p class="text-gray-400 font-normal my-3">30 September 2024</p>
                  <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">MANFAAT SELF LOVE JOURNALING PADA DIRI INDIVIDU</h5>
                  </a>
                  <p class="mb-5 font-normal text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat.</p>
                  <a
                    href="#"
                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>

     
            <div class="flex items-center justify-center md:justify-end gap-x-2 md:gap-x-3 my-8 md:my-10 md:mb-24 lg:mt-12 md:mx-16">
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 18L1 9.5L5.5 5.25L10 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
              <button type="button" class="bg-[#682E74] text-white font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">1</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">2</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">3</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">4</button>
              <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
                <svg width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 18L10 9.5L1 1" stroke="#172432" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
            </div>
          </article>
        </section> -->
      </div>

      <!-- awal footer -->
        <?php require_once('footer.php'); ?>
      <!-- akhir footer -->
    </main>
  </body>
</html>
