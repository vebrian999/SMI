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
} else {
    echo "ID artikel tidak diberikan!";
    exit;
}
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

    <header>
      <!-- Jumbotron -->
      <section id="home" class="relative h-1/2 mb-14">
        <!-- Background image -->
        <div class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-fixed blur-sm" style="background-image: url(./asset/jumbotron\ carausel.png)"></div>

        <!-- Filter overlay -->
        <div class="absolute inset-0 bg-[#172432] opacity-40"></div>

        <!-- Content -->
        <div class="relative z-10">
          <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 ease-in-out">
            <div class="max-w-screen-2xl mx-5 md:mx-16 flex flex-wrap items-center justify-between py-4">
              <a href="./index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="./asset/logo.png" class="md:w-32 w-20" alt="Flowbite Logo" />
              </a>
              <div class="flex md:order-2">
                <div class="relative hidden md:block">
                  <div class="flex justify-center items-center">
                    <div class="relative">
                      <input
                        type="text"
                        class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none transition-all duration-300 ease-in-out w-12 focus:w-64"
                        placeholder="Search..."
                        onfocus="this.classList.remove('w-12'); this.classList.add('w-64');"
                        onblur="if(this.value === '') { this.classList.remove('w-64'); this.classList.add('w-12'); }" />
                      <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>

                <div class="relative text-left mx-3 text-sm md:block hidden">
                  <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex justify-between w-full shadow-sm py-2 text-sm font-normal text-white" type="button">
                    <span class="flex items-center">
                      <img src="https://flagicons.lipis.dev/flags/4x3/gb-eng.svg" alt="UK Flag" class="w-4 h-4 mr-2" />
                      UK
                    </span>
                    <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <div id="dropdown" class="hidden z-10 w-[90px] rounded-md shadow-lg mt-1 bg-white" role="menu" aria-orientation="vertical" aria-labelledby="dropdownDefaultButton">
                    <ul class="py-1" role="none">
                      <li role="menuitem" class="flex items-center p-2 hover:bg-blue-100 cursor-pointer" onclick="selectOption('UK', 'United Kingdom')">
                        <img src="https://flagicons.lipis.dev/flags/4x3/gb-eng.svg" alt="UK Flag" class="w-4 h-4 mr-2" />
                        <span>UK</span>
                      </li>
                      <li role="menuitem" class="flex items-center p-2 hover:bg-blue-100 cursor-pointer" onclick="selectOption('ID', 'Indonesia')">
                        <img src="https://flagicons.lipis.dev/flags/4x3/id.svg" alt="ID Flag" class="w-4 h-4 mr-2" />
                        <span>IDN</span>
                      </li>
                    </ul>
                  </div>
                </div>

                <!-- Mobile menu button (hamburger) -->
                <div class="md:hidden flex items-center">
                  <button type="button" data-drawer-target="sidebar-menu" data-drawer-show="sidebar-menu" aria-controls="sidebar-menu" class="text-white hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                <div class="relative mt-3 md:hidden">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                  </div>
                  <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#682E74] focus:border-[#682E74]" placeholder="Search..." />
                </div>
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-normal border rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                  <li>
                    <a href="./index.html" class="block py-2 px-3 text-white bg-primary-color rounded md:bg-transparent md:hover:text-primary-color md:p-0 relative group" aria-current="page"
                      >Home
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./about-us.html" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >About Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./contact-us.html" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Contact Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./blog.php" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Blog
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./our-product.html" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Our Product
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Sidebar Menu (for mobile) -->
            <div id="sidebar-menu" class="fixed inset-y-0 left-0 z-40 w-64 transition-transform transform -translate-x-full bg-white md:hidden">
              <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                  <a href="#" class="text-gray-800 text-xl font-bold">Menu</a>
                  <button type="button" data-drawer-hide="sidebar-menu" class="text-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-300">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>

                <!-- Search bar -->
                <div class="mb-4">
                  <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                      <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                      </svg>
                      <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-sidebar" class="block w-full bg-gray-100 p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-primary-color focus:border-primary-color" placeholder="Search..." />
                  </div>
                </div>

                <!-- Language selector -->
                <div class="mb-4">
                  <button
                    id="dropdownDefaultButtonMobile"
                    data-dropdown-toggle="dropdownMobile"
                    class="inline-flex justify-between w-full shadow-sm py-2 px-4 text-sm font-normal text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100"
                    type="button">
                    <span class="flex items-center">
                      <img src="https://flagicons.lipis.dev/flags/4x3/gb-eng.svg" alt="UK Flag" class="w-4 h-4 mr-2" />
                      UK
                    </span>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <div id="dropdownMobile" class="hidden z-10 w-full rounded-md shadow-lg mt-1 bg-white" role="menu" aria-orientation="vertical" aria-labelledby="dropdownDefaultButtonMobile">
                    <ul class="py-1" role="none">
                      <li role="menuitem" class="flex items-center p-2 hover:bg-gray-100 cursor-pointer" onclick="selectOption('UK', 'United Kingdom')">
                        <img src="https://flagicons.lipis.dev/flags/4x3/gb-eng.svg" alt="UK Flag" class="w-4 h-4 mr-2" />
                        <span>UK</span>
                      </li>
                      <li role="menuitem" class="flex items-center p-2 hover:bg-gray-100 cursor-pointer" onclick="selectOption('ID', 'Indonesia')">
                        <img src="https://flagicons.lipis.dev/flags/4x3/id.svg" alt="ID Flag" class="w-4 h-4 mr-2" />
                        <span>IDN</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <ul class="space-y-2">
                  <li><a href="./index.html" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Home</a></li>
                  <li><a href="./about-us.html" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">About Us</a></li>
                  <li><a href="./contact-us.html" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Contact Us</a></li>
                  <li><a href="./blog.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Blog</a></li>
                  <li><a href="./our-product.html" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">our Product</a></li>
                </ul>
              </div>
            </div>
          </nav>

          <!-- JS for Flowbite Drawer -->
          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const sidebarMenu = document.getElementById("sidebar-menu");

              // Event listener untuk membuka sidebar
              document.querySelector("[data-drawer-target]").addEventListener("click", function () {
                sidebarMenu.classList.toggle("-translate-x-full");

                // Tunggu hingga backdrop muncul, kemudian atur z-index
                setTimeout(function () {
                  const backdrop = document.querySelector("[drawer-backdrop]");
                  if (backdrop) {
                    backdrop.style.zIndex = "0"; // Ubah z-index backdrop menjadi 0 agar tidak menutupi sidebar
                    backdrop.style.pointerEvents = "none"; // Pastikan backdrop tidak bisa di-klik
                  }
                }, 100);
              });

              // Event listener untuk menutup sidebar
              document.querySelector("[data-drawer-hide]").addEventListener("click", function () {
                sidebarMenu.classList.toggle("-translate-x-full");

                // Kembalikan z-index dan pointer-events dari backdrop
                setTimeout(function () {
                  const backdrop = document.querySelector("[drawer-backdrop]");
                  if (backdrop) {
                    backdrop.style.zIndex = "30"; // Kembalikan z-index backdrop
                    backdrop.style.pointerEvents = "auto"; // Kembalikan fungsi klik pada backdrop
                  }
                }, 100);
              });
            });
          </script>

          <script src="./js/app.js"></script>

          <!-- End of Header -->
          <!-- Hero -->
          <div class="mx-20 py-24 text-white relative">
            <div class="my-28">
              <h1 class="md:text-7xl text-3xl text-center">Blog</h1>
              <hr class="my-3 md:w-1/2 mx-auto" />
              <p class="md:text-lg text-sm text-center">Odio cras proin proin sit quis fringilla aliquet. Consectetur</p>
              <p class="md:text-lg text-sm text-center">elementum viverra egestas egestas nulla ullamcorper varius quam.</p>
            </div>
            <!-- Navigation Dots and Arrows -->
          </div>
        </div>
      </section>
      <!-- End Of Jumbotron -->
    </header>

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
            <p class="pb-6"><?php echo nl2br(($article['content'])); ?></p>





        </section>
      </div>
<aside class="w-full md:w-1/3 md:my-0 my-5 space-y-4 md:sticky md:top-32 self-start">
    <?php foreach ($sidebarArticles as $sidebarArticle): ?>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="flex items-start gap-6">
            <div class="flex-shrink-0 w-36 h-36">
                <img src="./uploads/<?php echo htmlspecialchars($sidebarArticle['image']); ?>" alt="<?php echo htmlspecialchars($sidebarArticle['title']); ?>" class="w-full h-full object-cover rounded-md" />
            </div>
            <div class="flex-1">
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-gray-500"><?php echo date('M d, Y', strtotime($sidebarArticle['created_at'])); ?></p>
                    <span class="border-l border-gray-400 h-4"></span>
                    <p class="text-sm text-gray-500">By <?php echo htmlspecialchars($sidebarArticle['author']); ?></p>
                </div>
                <h1 class="font-semibold text-base text-gray-700 mb-2"><?php echo htmlspecialchars($sidebarArticle['title']); ?></h1>
                <!-- Mengubah dari summary ke content -->
<p class="text-sm text-gray-600">
    <?php 
    // Memecah string menjadi array kata
    $words = explode(' ', $sidebarArticle['content']); 
    // Mengambil 10 kata pertama
    $shortenedcontent = implode(' ', array_slice($words, 0, 7)); 
    // Menambahkan ellipsis jika lebih dari 10 kata
    echo nl2br(htmlspecialchars($shortenedcontent . (count($words) > 10 ? '...' : ''))); 
    ?>
</p>

                <a href="article.php?id=<?php echo $sidebarArticle['id']; ?>" class="text-primary-color hover:underline">Read more</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</aside>

    </main>

    <!-- awal footer -->
    <footer class="bg-primary-color bg-opacity-60 bg-[url('./asset/background-footer.png')] bg-center bg-no-repeat bg-cover bg-fixed bg-blend-multiply" aria-labelledby="footer-heading">
      <h2 id="footer-heading" class="sr-only">Footer</h2>
      <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-14">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
          <div class="space-y-8 mr-16">
            <a href="./index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
              <img src="./asset/logo.png" class="w-32" alt="SMI logo" />
            </a>
            <p class="text-sm leading-6 text-white">This growth plan will help you reach your resolutions and achieve the goals you have been striving towards.</p>
            <div class="flex space-x-3">
              <!-- Social Media Icons -->
              <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12.2175 1.26929H14.4665L9.55316 6.88495L15.3334 14.5266H10.8075L7.26271 9.89198L3.20665 14.5266H0.956308L6.21164 8.52002L0.666687 1.26929H5.30743L8.51162 5.50551L12.2175 1.26929ZM11.4282 13.1805H12.6744L4.63028 2.54471H3.29299L11.4282 13.1805Z" />
                </svg>
              </a>
              <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8 0C3.58176 0 0 3.58176 0 8C0 11.7517 2.58304 14.8998 6.06752 15.7645V10.4448H4.41792V8H6.06752V6.94656C6.06752 4.22368 7.29984 2.9616 9.97312 2.9616C10.48 2.9616 11.3546 3.06112 11.7123 3.16032V5.37632C11.5235 5.35648 11.1955 5.34656 10.7882 5.34656C9.47648 5.34656 8.9696 5.84352 8.9696 7.13536V8H11.5827L11.1338 10.4448H8.9696V15.9414C12.9309 15.463 16.0003 12.0902 16.0003 8C16 3.58176 12.4182 0 8 0Z" />
                </svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8 1.44062C10.1375 1.44062 10.3906 1.45 11.2313 1.4875C12.0125 1.52187 12.4344 1.65313 12.7156 1.7625C13.0875 1.90625 13.3563 2.08125 13.6344 2.35938C13.9156 2.64062 14.0875 2.90625 14.2313 3.27813C14.3406 3.55938 14.4719 3.98438 14.5063 4.7625C14.5438 5.60625 14.5531 5.85938 14.5531 7.99375C14.5531 10.1313 14.5438 10.3844 14.5063 11.225C14.4719 12.0063 14.3406 12.4281 14.2313 12.7094C14.0875 13.0813 13.9125 13.35 13.6344 13.6281C13.3531 13.9094 13.0875 14.0813 12.7156 14.225C12.4344 14.3344 12.0094 14.4656 11.2313 14.5C10.3875 14.5375 10.1344 14.5469 8 14.5469C5.8625 14.5469 5.60938 14.5375 4.76875 14.5C3.9875 14.4656 3.56563 14.3344 3.28438 14.225C2.9125 14.0813 2.64375 13.9063 2.36563 13.6281C2.08438 13.3469 1.9125 13.0813 1.76875 12.7094C1.65938 12.4281 1.52813 12.0031 1.49375 11.225C1.45625 10.3813 1.44688 10.1281 1.44688 7.99375C1.44688 5.85625 1.45625 5.60313 1.49375 4.7625C1.52813 3.98125 1.65938 3.55938 1.76875 3.27813C1.9125 2.90625 2.0875 2.6375 2.36563 2.35938C2.64688 2.07812 2.9125 1.90625 3.28438 1.7625C3.56563 1.65313 3.99063 1.52187 4.76875 1.4875C5.60938 1.45 5.8625 1.44062 8 1.44062ZM8 0C5.82813 0 5.55625 0.009375 4.70313 0.046875C3.85313 0.084375 3.26875 0.221875 2.7625 0.41875C2.23438 0.625 1.7875 0.896875 1.34375 1.34375C0.896875 1.7875 0.625 2.23438 0.41875 2.75938C0.221875 3.26875 0.084375 3.85 0.046875 4.7C0.009375 5.55625 0 5.82812 0 8C0 10.1719 0.009375 10.4438 0.046875 11.2969C0.084375 12.1469 0.221875 12.7313 0.41875 13.2375C0.625 13.7656 0.896875 14.2125 1.34375 14.6562C1.7875 15.1 2.23438 15.375 2.75938 15.5781C3.26875 15.775 3.85 15.9125 4.7 15.95C5.55313 15.9875 5.825 15.9969 7.99688 15.9969C10.1688 15.9969 10.4406 15.9875 11.2938 15.95C12.1438 15.9125 12.7281 15.775 13.2344 15.5781C13.7594 15.375 14.2063 15.1 14.65 14.6562C15.0938 14.2125 15.3688 13.7656 15.5719 13.2406C15.7688 12.7313 15.9063 12.15 15.9438 11.3C15.9813 10.4469 15.9906 10.175 15.9906 8.00313C15.9906 5.83125 15.9813 5.55938 15.9438 4.70625C15.9063 3.85625 15.7688 3.27188 15.5719 2.76562C15.375 2.23438 15.1031 1.7875 14.6563 1.34375C14.2125 0.9 13.7656 0.625 13.2406 0.421875C12.7313 0.225 12.15 0.0875 11.3 0.05C10.4438 0.009375 10.1719 0 8 0Z" />
                  <path
                    d="M8 3.89062C5.73125 3.89062 3.89062 5.73125 3.89062 8C3.89062 10.2688 5.73125 12.1094 8 12.1094C10.2688 12.1094 12.1094 10.2688 12.1094 8C12.1094 5.73125 10.2688 3.89062 8 3.89062ZM8 10.6656C6.52813 10.6656 5.33437 9.47188 5.33437 8C5.33437 6.52813 6.52813 5.33437 8 5.33437C9.47188 5.33437 10.6656 6.52813 10.6656 8C10.6656 9.47188 9.47188 10.6656 8 10.6656Z" />
                  <path d="M13.2312 3.72808C13.2312 4.25933 12.8 4.68746 12.2719 4.68746C11.7406 4.68746 11.3125 4.25621 11.3125 3.72808C11.3125 3.19683 11.7438 2.76871 12.2719 2.76871C12.8 2.76871 13.2312 3.19996 13.2312 3.72808Z" />
                </svg>
              </a>
              <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M15.8406 4.80004C15.8406 4.80004 15.6844 3.69692 15.2031 3.21254C14.5938 2.57504 13.9125 2.57192 13.6 2.53442C11.3625 2.37192 8.00313 2.37192 8.00313 2.37192H7.99687C7.99687 2.37192 4.6375 2.37192 2.4 2.53442C2.0875 2.57192 1.40625 2.57504 0.796875 3.21254C0.315625 3.69692 0.1625 4.80004 0.1625 4.80004C0.1625 4.80004 0 6.09692 0 7.39067V8.60317C0 9.89692 0.159375 11.1938 0.159375 11.1938C0.159375 11.1938 0.315625 12.2969 0.79375 12.7813C1.40313 13.4188 2.20313 13.3969 2.55938 13.4657C3.84063 13.5875 8 13.625 8 13.625C8 13.625 11.3625 13.6188 13.6 13.4594C13.9125 13.4219 14.5938 13.4188 15.2031 12.7813C15.6844 12.2969 15.8406 11.1938 15.8406 11.1938C15.8406 11.1938 16 9.90004 16 8.60317V7.39067C16 6.09692 15.8406 4.80004 15.8406 4.80004ZM6.34688 10.075V5.57817L10.6687 7.83442L6.34688 10.075Z" />
                </svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                  <path
                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                </svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                  <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                </svg>
              </a>
            </div>
          </div>
          <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-semibold leading-6 text-white">Navigasi Link</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li>
                    <a href="./index.html" class="text-sm leading-6 text-white hover:text-gray-900">Home</a>
                  </li>
                  <li>
                    <a href="./about-us.html" class="text-sm leading-6 text-white hover:text-gray-900">About Us</a>
                  </li>
                  <li>
                    <a href="./contact-us.html" class="text-sm leading-6 text-white hover:text-gray-900">Contact</a>
                  </li>
                  <li>
                    <a href="./our-product.html" class="text-sm leading-6 text-white hover:text-gray-900">Our Product</a>
                  </li>
                  <li>
                    <a href="./blog.php" class="text-sm leading-6 text-white hover:text-gray-900">Blog</a>
                  </li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-white">Community</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Podcast</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Event</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Blog</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Invite a friend</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-semibold leading-6 text-white">Socials</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Shopee</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Instagram</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Twitter</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Facebook</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Linkedin</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Tiktok</a>
                  </li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-white">Legal</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Terms</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Privacy</a>
                  </li>
                  <li>
                    <a href="#" class="text-sm leading-6 text-white hover:text-gray-900">Support</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <hr class="w-full my-5" />
        <div class="text-sm flex justify-between items-center text-white">
          <p class="text-left">©2024 Stress Management Indonesia. All rights reserved</p>
          <div class="flex space-x-8">
            <a href="#" class="hover:underline">Privacy & Policy</a>
            <a href="#" class="hover:underline">Terms & Condition</a>
          </div>
        </div>
      </div>
    </footer>
    <!-- akhir footer -->
  </body>
</html>
