<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stress Management Indoensia</title>
    <link href="css/output.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" /> -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      @keyframes modal-pop {
        0% {
          opacity: 0;
          transform: scale(0.9);
        }
        100% {
          opacity: 1;
          transform: scale(1);
        }
      }
      .modal-animation {
        animation: modal-pop 0.5s ease-out;
      }
    </style>
  </head>
  <body>
    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <header>
      <!-- Jumbotron -->
      <section id="home" class="relative h-1/2 mb-14">
        <!-- Background image -->
        <div class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-fixed blur-sm" style="background-image: url(./asset/jumbotron\ carausel.png)"></div>

        <!-- Filter overlay -->
        <div class="absolute inset-0 bg-[#172432] opacity-40"></div>

        <!-- Content jika bermasalah tambahkan z-10-->
        <div class="relative z-10">
          <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 ease-in-out">
            <div class="max-w-screen-2xl mx-5 md:mx-16 flex flex-wrap items-center justify-between py-4">
              <a href="./index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="./asset/logo.png" class="md:w-32 w-20" alt="Flowbite Logo" />
              </a>
              <div class="flex md:order-2">
                <!-- Search Bar Desktop -->
                <div class="relative hidden md:block">
                  <div class="flex justify-center items-center">
                    <div class="relative">
                      <input
                        type="text"
                        id="search-desktop"
                        class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none transition-all duration-300 ease-in-out w-12 focus:w-64"
                        placeholder="Search..."
                        onfocus="this.classList.remove('w-12'); this.classList.add('w-64');"
                        onblur="if (this.value === '') { this.classList.remove('w-64'); this.classList.add('w-12'); }"
                        oninput="searchArticlesDesktop()" />

                      <button type="button" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  <!-- Container untuk hasil pencarian -->
                  <div id="search-results-desktop" class="absolute w-64 mt-2 bg-white shadow-lg rounded-lg z-10 hidden"></div>
                </div>

                <script>
                  function searchArticlesDesktop() {
                    const query = document.getElementById("search-desktop").value;

                    if (query.length > 0) {
                      const xhr = new XMLHttpRequest();
                      xhr.open("GET", `search.php?q=${encodeURIComponent(query)}`, true);
                      xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                          const resultsContainer = document.getElementById("search-results-desktop");
                          resultsContainer.innerHTML = xhr.responseText;
                          resultsContainer.classList.remove("hidden"); // Tampilkan hasil
                        }
                      };
                      xhr.send();
                    } else {
                      // Kosongkan dan sembunyikan hasil jika input kosong
                      document.getElementById("search-results-desktop").innerHTML = "";
                      document.getElementById("search-results-desktop").classList.add("hidden");
                    }
                  }
                </script>

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
                    <a href="./index.php" class="block py-2 px-3 text-white bg-primary-color rounded md:bg-transparent md:hover:text-primary-color md:p-0 relative group" aria-current="page"
                      >Home
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./about-us.php" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >About Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./contact-us.php" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Contact Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./blog.php" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Article
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./our-product.php" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
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
                  <li><a href="./index.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Home</a></li>
                  <li><a href="./about-us.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">About Us</a></li>
                  <li><a href="./contact-us.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Contact Us</a></li>
                  <li><a href="./blog.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Blog</a></li>
                  <li><a href="./our-product.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">our Product</a></li>
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
              <h1 class="md:text-7xl text-3xl text-center">About Us</h1>
              <hr class="my-3 md:w-1/2 mx-auto" />
              <p class="md:text-lg text-sm text-center">Our Commitment to Raising Mental Awareness and Wellbeing We</p>
              <p class="md:text-lg text-sm text-center">focus on providing information, support and resources to help</p>
              <p class="md:text-lg text-sm text-center">individuals understand and care for their mental health.</p>
            </div>
            <!-- Navigation Dots and Arrows -->
          </div>
        </div>
      </section>
      <!-- End Of Jumbotron -->
    </header>

    <main class="mx-4 md:mx-28">
      <div id="content" class="container mx-auto">
        <section class="mt-10 md:-mx-14">
          <article>
            <div class="w-1/2">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-3xl text-xl font-semibold text-white md:px-0 px-4">Our Mission</h1>
              </div>
            </div>

            <div class="bg-primary-color bg-opacity-75 pb-10 bg-center bg-no-repeat bg-cover bg-fixed bg-blend-multiply" style="background-image: url(./asset/gambar-mision.png)">
              <div class="container mx-auto my-5 px-4 md:my-10">
                <p class="md:pt-20 pt-10 pb-10 text-center text-white font-normal text-base md:text-xl max-w-4xl mx-auto">
                  Our mission is to create a healthy-life movement by building a mentally and physically healthy community and providing the right information and the most suitable solution for managing mental health.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10">
                  <div class="flex flex-col items-center">
                    <div class="bg-third-color rounded-lg flex justify-center items-center w-full aspect-square">
                      <svg class="text-center" width="69" height="66" viewBox="0 0 69 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M3.12797 21.0016H65.872V24.0012H3.12797V21.0016ZM53.3141 26.9986H59.5931V54.0016H53.3141V26.9986ZM43.9069 26.9986H50.1859V54.0016H43.9069V26.9986ZM28.221 26.9986H40.779V54.0016H28.221V26.9986ZM18.8141 26.9986H25.0931V54.0016H18.8141V26.9986ZM9.40692 26.9986H15.6859V54.0016H9.40692V26.9986ZM63.1579 57.0012L65.251 63.0004H3.74901L5.84209 57.0012H63.1579ZM34.5 3.22717L61.525 17.9998H7.475L34.5 3.22717ZM67.4359 26.9986C68.2869 26.9986 69 26.3295 69 25.4988V19.4996C69 18.9443 68.6781 18.4778 68.1951 18.2206L68.2181 18.1978L35.2819 0.198013L35.2589 0.220724C35.0289 0.091 34.776 0 34.5 0C34.224 0 33.9711 0.091 33.7411 0.220724L33.7181 0.198013L0.781921 18.1978L0.804944 18.2206C0.321944 18.4778 0 18.9443 0 19.4996V25.4988C0 26.3295 0.713124 26.9986 1.56412 26.9986H6.27895V54.0016H4.71511C4.00211 54.0016 3.45008 54.4386 3.24308 55.0303L3.22006 55.028L0.0690674 64.0268L0.0920898 64.0291C0.0460898 64.1816 0 64.3341 0 64.5002C0 65.3309 0.713124 66 1.56412 66H67.4359C68.2869 66 69 65.3309 69 64.5002C69 64.3341 68.9539 64.1816 68.9079 64.0291L68.9309 64.0268L65.7799 55.028L65.7569 55.0303C65.5499 54.4386 64.9979 54.0016 64.2849 54.0016H62.721V26.9986H67.4359Z"
                          fill="#53585F" />
                      </svg>
                    </div>
                    <div class="text-center pt-5 text-white">
                      <h2 class="pb-2 text-lg md:text-xl font-bold">mission one</h2>
                      <p class="text-sm md:text-base font-light">Lorem ipsum dolor sit amet incididunt do ut labore et sit eiusmod tempor magna.</p>
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div class="bg-third-color rounded-lg flex justify-center items-center w-full aspect-square">
                      <svg width="68" height="66" viewBox="0 0 68 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M38.2387 56.0203L49.0507 21.0016H63.4894L38.2387 56.0203ZM34 59.2862L22.1681 21.0016H45.8319L34 59.2862ZM4.51064 21.0016H18.9493L29.7613 56.0203L4.51064 21.0016ZM20.7174 2.99957H26.8826L19.1532 17.9998H5.25854L20.7174 2.99957ZM37.6947 2.99957L45.4241 17.9998H22.5759L30.3053 2.99957H37.6947ZM47.2826 2.99957L62.7415 17.9998H48.8468L41.1174 2.99957H47.2826ZM68 19.4996C68 19.165 67.8639 18.8669 67.6599 18.6165L67.6826 18.6029L67.5919 18.5073C67.5465 18.4686 67.524 18.4322 67.4787 18.3935L49.1415 0.600845L49.1188 0.614458C48.8468 0.25032 48.416 0 47.9174 0H20.0826C19.584 0 19.1532 0.25032 18.8812 0.614458L18.8585 0.600845L0.521289 18.3935C0.475956 18.4322 0.453455 18.4686 0.408122 18.5073L0.317367 18.6029L0.340055 18.6165C0.136055 18.8669 0 19.165 0 19.4996C0 19.8569 0.136077 20.1732 0.362744 20.4304L0.340055 20.4418L32.7986 65.4447L32.8213 65.4287C33.0933 65.7701 33.524 66 34 66C34.476 66 34.9067 65.7701 35.1787 65.4287L35.2014 65.4447L67.6599 20.4418L67.6373 20.4304C67.8413 20.1732 68 19.8569 68 19.4996Z"
                          fill="#53585F" />
                      </svg>
                    </div>
                    <div class="text-center pt-5 text-white">
                      <h2 class="pb-2 text-lg md:text-xl font-bold">mission two</h2>
                      <p class="text-sm md:text-base font-light">Lorem ipsum dolor sit amet incididunt do ut labore et sit eiusmod tempor magna.</p>
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div class="bg-third-color rounded-lg flex justify-center items-center w-full aspect-square">
                      <svg width="68" height="66" viewBox="0 0 68 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M64.9174 36.7029C64.8947 36.7097 64.8947 36.7165 64.872 36.7165L61.6986 37.4857C60.6106 37.7475 59.772 38.5667 59.4773 39.6182C58.888 41.7757 57.9812 43.8536 56.8252 45.7903C56.2585 46.7348 56.2812 47.9023 56.8479 48.84L58.5479 51.5938L53.1532 56.8328C53.1532 56.8282 53.1305 56.8237 53.1305 56.8192L50.2972 55.1737C49.7985 54.8893 49.2546 54.7458 48.7106 54.7458C48.1893 54.7458 47.6455 54.8801 47.1695 55.1487C45.1748 56.2684 43.044 57.1264 40.8227 57.7022C39.7347 57.9821 38.8961 58.8128 38.6241 59.8711L37.8305 62.9663C37.8305 62.9776 37.8308 62.9868 37.8081 63.0027H30.1919L29.3759 59.8711C29.1039 58.8128 28.2653 57.9821 27.1773 57.7022C24.956 57.1264 22.8252 56.2684 20.8305 55.1487C20.3545 54.8801 19.8107 54.7458 19.2894 54.7458C18.7454 54.7458 18.1788 54.8893 17.7028 55.1737L14.8695 56.8192C14.8695 56.8237 14.8468 56.8282 14.8468 56.8328L9.4521 51.5938L11.1521 48.84C11.7188 47.9023 11.7415 46.7348 11.1748 45.7903C10.0188 43.8513 9.11202 41.7757 8.52269 39.6182C8.22802 38.5667 7.36673 37.7475 6.3014 37.4857L3.12801 36.7165C3.10534 36.7165 3.1053 36.7097 3.08263 36.7029V29.2926L6.3014 28.5165C7.36673 28.2525 8.22802 27.4355 8.52269 26.3818C9.11202 24.2266 10.0188 22.1487 11.1748 20.212C11.7415 19.2652 11.7188 18.0976 11.1521 17.1622L9.4521 14.4381C9.4521 14.429 9.4521 14.4199 9.4521 14.4062L14.8468 9.16717L17.7028 10.8263C18.1788 11.113 18.7454 11.2542 19.2894 11.2542C19.8107 11.2542 20.3545 11.1199 20.8305 10.8536C22.8252 9.73158 24.956 8.87357 27.1773 8.30233C28.2653 8.01785 29.1039 7.18716 29.3759 6.12888L30.1919 2.99957H37.8081C37.8308 3.01323 37.8305 3.02233 37.8305 3.03371L38.6241 6.12888C38.8961 7.18716 39.7347 8.01785 40.8227 8.30233C43.044 8.87357 45.1748 9.73158 47.1695 10.8536C47.6455 11.1199 48.1893 11.2542 48.7106 11.2542C49.2546 11.2542 49.7985 11.113 50.2972 10.8263L53.1532 9.16717L58.5479 14.4062C58.5479 14.4199 58.5479 14.429 58.5479 14.4381L56.8479 17.16C56.2812 18.0977 56.2585 19.2652 56.8252 20.212C57.9812 22.1487 58.888 24.2243 59.4773 26.3818C59.772 27.4355 60.6106 28.2525 61.6986 28.5165L64.9174 29.2926V36.7029ZM65.7333 26.4023L62.4695 25.6057C61.7895 23.1615 60.792 20.8446 59.5 18.7053L61.2454 15.8878C61.7894 14.8841 62.1294 13.637 61.2454 12.779L54.8305 6.55449C54.4452 6.16987 53.9466 6.01282 53.4479 6.01282C52.8132 6.01282 52.1787 6.2427 51.6347 6.55449L48.7106 8.25229C46.512 7.02105 44.132 6.05605 41.616 5.40288L40.8 2.20075C40.4373 1.12199 39.78 0 38.5333 0H29.4667C28.22 0 27.472 1.12199 27.2 2.20075L26.384 5.40288C23.868 6.05605 21.488 7.02105 19.2894 8.25229L16.3653 6.55449C15.8213 6.2427 15.1868 6.01282 14.5521 6.01282C14.0534 6.01282 13.5548 6.16987 13.1695 6.55449L6.75462 12.779C5.87062 13.637 6.21062 14.8841 6.75462 15.8878L8.5 18.7053C7.208 20.8446 6.21053 23.1615 5.53053 25.6057L2.26667 26.4023C1.156 26.6754 0 27.3832 0 28.603V37.3993C0 38.6169 1.156 39.2586 2.26667 39.6L5.53053 40.3943C6.21053 42.8408 7.208 45.1554 8.5 47.297L6.75462 50.1122C6.16529 51.0681 5.87062 52.363 6.75462 53.2256L13.1695 59.4455C13.5548 59.8256 14.0307 59.9713 14.5067 59.9713C15.1414 59.9713 15.7986 59.7368 16.3653 59.4455L19.2894 57.7477C21.488 58.9789 23.868 59.9462 26.384 60.5971L27.2 63.7992C27.472 64.878 28.22 66 29.4667 66H38.5333C39.78 66 40.4373 64.878 40.8 63.7992L41.616 60.5971C44.132 59.9462 46.512 58.9789 48.7106 57.7477L51.6347 59.4455C52.2014 59.7368 52.8586 59.9713 53.4933 59.9713C53.9693 59.9713 54.4452 59.8256 54.8305 59.4455L61.2454 53.2256C62.1294 52.363 61.8347 51.0681 61.2454 50.1122L59.5 47.297C60.792 45.1554 61.7895 42.8408 62.4695 40.3943L65.7333 39.6C66.844 39.2586 68 38.6169 68 37.3993V28.603C68 27.3832 66.844 26.6754 65.7333 26.4023ZM49.4585 33C49.4585 40.7789 43.3615 47.1718 35.5415 47.9274V38.7875C38.2161 38.1207 40.188 35.7925 40.188 33C40.188 32.4811 40.0973 31.985 39.9613 31.5025L48.1894 27.0623C49.0054 28.8852 49.4585 30.8926 49.4585 33ZM30.9174 33C30.9174 31.3432 32.3 30.0004 34 30.0004C35.7 30.0004 37.0826 31.3432 37.0826 33C37.0826 34.6568 35.7 35.9996 34 35.9996C32.3 35.9996 30.9174 34.6568 30.9174 33ZM32.4585 47.9274C24.6385 47.1718 18.5415 40.7789 18.5415 33C18.5415 30.8926 18.9946 28.8852 19.8106 27.0623L28.0387 31.5025C27.9027 31.985 27.812 32.4811 27.812 33C27.812 35.7925 29.7839 38.1207 32.4585 38.7875V47.9274ZM34 17.9998C39.2587 17.9998 43.8826 20.5556 46.6933 24.445L38.4653 28.8761C37.3319 27.7268 35.768 26.9986 34 26.9986C32.232 26.9986 30.6681 27.7268 29.5347 28.8761L21.3067 24.445C24.1174 20.5556 28.7413 17.9998 34 17.9998ZM34 15.0002C23.7547 15.0002 15.4585 23.0613 15.4585 33C15.4585 42.9432 23.7547 50.9998 34 50.9998C44.2453 50.9998 52.5415 42.9432 52.5415 33C52.5415 23.0613 44.2453 15.0002 34 15.0002Z"
                          fill="#53585F" />
                      </svg>
                    </div>
                    <div class="text-center pt-5 text-white">
                      <h2 class="pb-2 text-lg md:text-xl font-bold">mission three</h2>
                      <p class="text-sm md:text-base font-light">Lorem ipsum dolor sit amet incididunt do ut labore et sit eiusmod tempor magna.</p>
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div class="bg-third-color rounded-lg flex justify-center items-center w-full aspect-square">
                      <svg width="70" height="55" viewBox="0 0 70 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M14.8244 51.9452C15.5558 47.6437 19.4244 45.925 23.3758 44.5432L23.5023 44.5019C26.3198 43.7709 31.3361 40.8398 31.3361 34.5514C31.3361 29.2164 29.1212 26.6132 27.9252 25.2129C27.6883 24.9311 27.4007 24.569 27.4651 24.6492C27.3685 24.4429 26.8994 23.2444 27.5779 20.46C27.8976 19.1538 27.357 18.4387 27.357 18.4387C26.5014 16.5641 24.9099 13.0693 26.1036 10.2483C27.709 6.34559 29.1304 5.57565 31.7041 4.44815C31.8536 4.38169 32.0008 4.30605 32.1388 4.21897C32.6241 3.90959 34.6849 3.05481 37.0148 3.05481C38.1786 3.05481 39.1606 3.27249 39.9357 3.70333C40.8695 4.21437 41.7643 5.19292 43.1144 8.32792C45.6329 13.9265 44.039 17.0546 43.234 18.1408C42.7004 18.8604 42.5187 19.7702 42.7257 20.6296C43.349 23.194 42.9464 24.2756 42.8406 24.4933C42.8153 24.5231 42.4382 24.9884 42.245 25.2129C41.0536 26.6132 38.8342 29.2164 38.8342 34.5514C38.8342 40.8398 43.855 43.7709 46.6725 44.5019L46.799 44.5432C50.7504 45.925 54.619 47.6437 55.3504 51.9452H14.8244ZM47.5948 41.5754C47.5948 41.5754 41.9713 40.2692 41.9713 34.5514C41.9713 29.5258 44.2805 27.7567 45.1729 26.5352C45.1729 26.5352 47.0059 24.9723 45.7754 19.9284C47.8224 17.1623 48.4872 12.6592 45.9825 7.10187C44.5887 3.85458 43.3582 2.07627 41.4791 1.04044C40.1037 0.279606 38.5374 0 37.0148 0C34.1812 0 31.4948 0.978572 30.4207 1.66378C27.2835 3.0342 25.1744 4.29914 23.1941 9.11394C21.4783 13.1587 23.5207 17.5496 24.5258 19.7542C23.2999 24.8004 24.9996 26.5352 24.9996 26.5352C25.8943 27.7567 28.2012 29.5258 28.2012 34.5514C28.2012 40.2692 22.58 41.5754 22.58 41.5754C19.0127 42.8267 11.5629 45.2215 11.5629 53.4715C11.5629 53.4715 11.563 55 13.1316 55H57.0432C58.6118 55 58.6119 53.4715 58.6119 53.4715C58.6119 45.2215 51.1621 42.8267 47.5948 41.5754ZM62.9312 38.209C62.9312 38.209 59.4168 37.4321 59.4168 32.984C59.4168 29.0767 60.6243 27.7017 61.335 26.7506C61.335 26.7506 62.6966 25.3986 61.7168 21.4775C62.5218 19.7588 64.1571 16.3442 62.784 13.2C61.1993 9.45773 60.1483 8.47226 57.6413 7.40435C56.7811 6.87268 54.6305 6.11186 52.3627 6.11186C51.2932 6.11186 50.2007 6.29752 49.2002 6.73981C49.6004 7.72752 49.9385 8.70835 50.18 9.67314C50.2191 9.65023 50.2605 9.6227 50.3019 9.59978C50.8355 9.31103 51.5324 9.16667 52.3627 9.16667C53.9865 9.16667 55.5667 9.73959 55.953 9.97793C56.091 10.065 56.2382 10.1429 56.3854 10.2048C57.9287 10.8602 58.506 11.1077 59.8837 14.3642C60.714 16.264 59.5318 18.7871 58.8947 20.1438C58.6026 20.7671 58.5037 21.5348 58.6693 22.1994C59.0971 23.9159 58.8993 24.7133 58.828 24.9127C58.8212 24.9242 58.8118 24.9356 58.8026 24.9494L58.6969 25.0892C57.8505 26.2006 56.2796 28.2792 56.2796 32.984C56.2796 38.2433 59.9089 40.5694 62.0134 41.1354C64.0167 41.8321 65.866 42.9275 66.3352 45.831L59.5548 45.8333C60.1551 46.7317 60.6496 47.7561 61.0268 48.8881L68.0188 48.8858C69.5874 48.8858 69.5874 47.3596 69.5874 47.3596C69.5874 41.2477 65.7855 39.1829 62.9312 38.209ZM8.16137 41.1354C10.2659 40.5694 13.8952 38.2433 13.8952 32.984C13.8952 28.2792 12.3197 26.2006 11.4779 25.0892L11.3722 24.9494C11.363 24.9356 11.3538 24.9242 11.3423 24.9127C11.2756 24.7133 11.0754 23.9159 11.5055 22.1994C11.6711 21.5348 11.5722 20.7671 11.2801 20.1438C10.643 18.7871 9.46079 16.264 10.2911 14.3642C11.6688 11.1077 12.2438 10.8602 13.7894 10.2048C13.9412 10.1429 14.0838 10.065 14.2218 9.97793C14.6082 9.73959 16.1883 9.16667 17.8121 9.16667C18.5918 9.16667 19.2404 9.30645 19.7602 9.56083C19.8982 9.03374 20.0615 8.50665 20.28 7.97957C20.4732 7.51207 20.6779 7.11104 20.8757 6.69624C19.9005 6.28374 18.8471 6.11186 17.8121 6.11186C15.5443 6.11186 13.3937 6.87268 12.5335 7.40435C10.0265 8.47226 8.97322 9.45773 7.39082 13.2C6.01772 16.3442 7.653 19.7588 8.458 21.4775C7.4736 25.3986 8.83983 26.7506 8.83983 26.7506C9.55053 27.7017 10.7626 29.0767 10.7626 32.984C10.7626 37.4321 7.24356 38.209 7.24356 38.209C4.39156 39.1829 0.587402 41.2477 0.587402 47.3596C0.587402 47.3596 0.587418 48.8858 2.15602 48.8858L9.14797 48.8881C9.52517 47.7561 10.0174 46.7317 10.62 45.8333L3.83961 45.831C4.30881 42.9275 6.15807 41.8321 8.16137 41.1354Z"
                          fill="#53585F" />
                      </svg>
                    </div>
                    <div class="text-center pt-5 text-white">
                      <h2 class="pb-2 text-lg md:text-xl font-bold">mission four</h2>
                      <p class="text-sm md:text-base font-light">Lorem ipsum dolor sit amet incididunt do ut labore et sit eiusmod tempor magna.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-20 md:-mx-14">
          <article>
            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-20">
              <!-- Kolom Gambar -->
              <div class="w-full md:w-1/2 order-2 md:order-1 md:mt-0 mt-7">
                <img src="./asset/laptop.png" alt="section2" class="w-full h-auto" />
              </div>

              <!-- Kolom Teks -->
              <div class="w-full md:w-1/2 order-1 md:order-2">
                <div class="flex justify-start md:justify-end">
                  <!-- Flex container untuk memindahkan elemen ke kanan -->
                  <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                    <!-- Menggunakan inline-block -->
                    <h1 class="md:text-3xl text-xl font-semibold px-4 md:px-0 text-white">Why Us?</h1>
                  </div>
                </div>

                <div class="flex justify-end">
                  <p class="py-4 text-gray-900 max-w-full md:text-right">At Stress Management Indonesia, we believe in empowering individuals through proven methods that enhance both mental and physical well-being.</p>
                </div>

                <div class="space-y-6">
                  <!-- Bagian 1: SVG dengan teks di sebelah kanan -->
                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded">
                      <svg width="59" height="59" viewBox="0 0 59 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.9127 0V33.0873H59C57.1783 47.6958 44.7165 59 29.6146 59C13.2589 59 0 45.7412 0 29.3855C0 14.2834 11.3042 1.82166 25.9127 0Z" fill="white" />
                        <path d="M33.3163 0V25.6836H58.9999C57.3297 12.2878 46.7121 1.67044 33.3163 0Z" fill="white" />
                      </svg>
                    </div>
                    <!-- Teks di sebelah kanan SVG -->
                    <div>
                      <h1 class="md:text-xl font-semibold md:font-bold text-lg">Based on data and facts</h1>
                    </div>
                  </div>

                  <!-- Bagian 2: Deskripsi teks -->
                  <p class="text-gray-950">All our methods are proven effective through expert research, ensuring you receive reliable and impactful support for your well-being and stress management.</p>

                  <!-- Bagian 3: Elemen tambahan lainnya (contoh angka) -->

                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded">
                      <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 50V47.0625M14.75 50V38.25M26.5 50V26.5M38.25 50V14.75M50 50V3" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </div>
                    <!-- Teks di sebelah kanan SVG -->
                    <div>
                      <h1 class="md:text-xl font-semibold md:font-bold text-lg">Realistic</h1>
                    </div>
                  </div>
                  <p class="text-gray-950">The programs we provide are grounded in current data and facts, maximizing effectiveness and ensuring impactful outcomes for all participants.</p>
                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded">
                      <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.9001 30.3L25.1001 35.5L38.1001 22.5" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M16 6.47833C19.8243 4.26612 24.2644 3 29 3C43.3593 3 55 14.6406 55 29C55 43.3593 43.3593 55 29 55C14.6406 55 3 43.3593 3 29C3 24.2644 4.26612 19.8243 6.47833 16"
                          stroke="white"
                          stroke-width="6"
                          stroke-linecap="round" />
                      </svg>
                    </div>
                    <!-- Teks di sebelah kanan SVG -->
                    <div>
                      <h1 class="md:text-xl font-semibold md:font-bold text-lg">Easy to practice</h1>
                    </div>
                  </div>
                  <p class="text-gray-950">All the self-improvement methods that we provide can be easily integrated into your daily routine, allowing for consistent growth and development.</p>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-20 md:-mx-14">
          <article class="">
            <div class="md:w-1/3 md:mb-10 mb-7">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-3xl text-xl px-4 md:px-0 font-semibold text-white benefit">What are the benefits of SMI?</h1>
              </div>
            </div>

            <div class="md:flex md:space-x-5 space-y-20 md:space-y-0 justify-center">
              <!-- Card 1 -->
              <div class="relative max-w-md bg-gray-100 border border-gray-200 rounded-lg shadow">
                <img class="rounded-t-lg w-[446px] h-[352px] object-cover" src="./asset/card-img1.png" alt="" />
                <!-- Menambahkan positioning untuk teks "Health" -->
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-50 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Health</p>
                </div>
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100 z-5 max-w-md mx-7 md:mx-16 md:py-10 rounded-lg shadow-xl">
                  <p class="mb-3 font-normal text-gray-500 text-center">Stress Management Indonesia believes that a combination...</p>
                  <div class="flex justify-center">
                    <button
                      data-modal-target="defaultModal2"
                      data-modal-toggle="defaultModal2"
                      class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary-color rounded-lg transition duration-300 ease-in-out hover:bg-primary-color hover:text-white transform hover:scale-105">
                      Read more
                      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Modal 1 -->
              <div id="defaultModal1" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                  <div class="relative bg-white rounded-lg shadow modal-animation">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">Health</h3>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        With an increase in physical and mental condition, a person's resilience to stress naturally improves, leading to greater happiness and well-being. As physical health boosts energy and mental clarity, stress becomes
                        easier to manage, fostering emotional stability and a more balanced, fulfilling life.
                      </p>
                    </div>
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                      <button data-modal-hide="defaultModal1" type="button" class="text-white bg-[#682E74] hover:bg-[#4F1B5A] focus:ring-4 focus:outline-none focus:ring-purple-300-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="relative max-w-md bg-gray-100 border border-gray-200 rounded-lg shadow mt-10">
                <!-- Perbesar ukuran gambar dengan width-full -->
                <img class="rounded-t-lg w-[446px] h-[352px] object-cover" src="./asset/card-img2.png" alt="" />
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-60 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Happiness</p>
                </div>
                <!-- Bagian teks dan tombol diposisikan secara absolut di atas gambar -->
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100 z-5 max-w-md mx-7 md:mx-16 md:py-10 rounded-lg shadow-xl">
                  <p class="mb-3 font-normal text-gray-500 text-center">With an increase in physical and mental condition, it...</p>
                  <!-- Wrapper flex untuk tombol -->
                  <div class="flex justify-center">
                    <button
                      data-modal-target="defaultModal1"
                      data-modal-toggle="defaultModal1"
                      href="#"
                      class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary-color rounded-lg transition duration-300 ease-in-out hover:bg-primary-color hover:text-white transform hover:scale-105">
                      Read more
                      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Modal 2 -->
              <div id="defaultModal2" tabindex="-1" aria-hidden="true" class="fixed md:top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                  <div class="relative bg-white rounded-lg shadow modal-animation">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">Happiness</h3>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        Stress Management Indonesia believes that combining physical and mental health is the key to effectively managing stress and improving quality of life. By nurturing both body and mind, individuals can better cope
                        with challenges, build resilience, and maintain a balanced, fulfilling lifestyle. This holistic approach reduces stress while enhancing overall well-being, promoting a harmonious state where one can thrive mentally
                        and physically.
                      </p>
                    </div>
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                      <button data-modal-hide="defaultModal2" type="button" class="text-white bg-[#682E74] hover:bg-[#4F1B5A] focus:ring-4 focus:outline-none focus:ring-purple-300-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="relative max-w-md bg-gray-100 border border-gray-200 rounded-lg shadow mt-10">
                <!-- Perbesar ukuran gambar dengan width-full -->
                <img class="rounded-t-lg w-[446px] h-[352px] object-cover" src="./asset/card-img3.png" alt="" />
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-60 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Realistic</p>
                </div>
                <!-- Bagian teks dan tombol diposisikan secara absolut di atas gambar -->
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100 z-5 max-w-md mx-7 md:mx-16 md:py-10 rounded-lg shadow-xl">
                  <p class="mb-3 font-normal text-gray-500 text-center">Increased levels of happiness are marked by clarity of mind so....</p>
                  <!-- Wrapper flex untuk tombol -->
                  <div class="flex justify-center">
                    <button
                      data-modal-target="defaultModal3"
                      data-modal-toggle="defaultModal3"
                      class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary-color rounded-lg transition duration-300 ease-in-out hover:bg-primary-color hover:text-white transform hover:scale-105">
                      Read more
                      <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Modal 3 -->
              <div id="defaultModal3" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                  <div class="relative bg-white rounded-lg shadow modal-animation">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">Realistic</h3>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        Increased levels of happiness are marked by clarity of mind, allowing individuals to set realistic expectations based on facts and available data. With this mindset, progress becomes steady and sustainable. Instead
                        of being overwhelmed by challenges, individuals are better equipped to face them with calm and confidence, making thoughtful decisions that lead to long-term growth and personal fulfillment. This steady approach
                        ensures that each step forward is meaningful, paving the way for lasting success.
                      </p>
                    </div>
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                      <button data-modal-hide="defaultModal3" type="button" class="text-white bg-[#682E74] hover:bg-[#4F1B5A] focus:ring-4 focus:outline-none focus:ring-purple-300-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Close
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-36 md:-mx-14">
          <article>
            <div class="flex md:justify-end">
              <div class="bg-primary-color w-1/2 md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl font-semibold px-4 md:px-0 text-white md:text-right">Our Team</h1>
              </div>
            </div>
            <div class="flex md:justify-end py-5">
              <p class="md:w-1/2 md:text-right">Our team of professionals is ready to provide the best support for your mental health journey. Get to know our team members who are ready to help!</p>
            </div>

            <div>
              <section class="bg-white">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-10 lg:px-6">
                  <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                    <div class="text-center text-gray-500">
                      <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                        <a href="#">John Doe</a>
                      </h3>
                      <p>Graphic Designer</p>
                      <ul class="flex justify-center mt-4 space-x-4">
                        <li>
                          <a href="#" class="text-[#39569c] hover:text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#00acee] hover:text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#ea4c89] hover:text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="text-center text-gray-500">
                      <img class="mx-auto mb-4 w-full rounded-full" src="./asset/coach priss-removebg-preview.png" alt="Michael Avatar" />
                      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                        <a href="#">Coach Pris</a>
                      </h3>
                      <p>Founder SMI</p>
                      <ul class="flex justify-center mt-4 space-x-4">
                        <li>
                          <a href="#" class="text-[#39569c]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#00acee]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#ea4c89]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="text-center text-gray-500">
                      <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Neil Avatar" />
                      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                        <a href="#">Jane doe</a>
                      </h3>
                      <p>Copywriter</p>
                      <ul class="flex justify-center mt-4 space-x-4">
                        <li>
                          <a href="#" class="text-[#39569c]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#00acee]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="text-[#ea4c89]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                clip-rule="evenodd" />
                            </svg>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
              <div class="flex justify-center mb-4">
                <div class="flex space-x-4">
                  <button class="w-3 h-3 rounded-full bg-primary-color focus:outline-none"></button>
                  <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none"></button>
                  <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none"></button>
                  <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none"></button>
                  <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none"></button>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-20 md:-mx-14">
          <article>
            <div class="md:flex justify-between">
              <!-- Kolom 1: Title and description -->
              <div class="md:w-1/2">
                <!-- Menggunakan w-1/3 agar proporsional -->
                <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                  <h1 class="md:text-4xl text-xl font-semibold text-white px-4 md:px-0">How We Started</h1>
                </div>
                <div class="md:py-8 md:pt-10 pt-4">
                  <p class="text-lg text-gray-700">
                    Priscilla was inspired to create Stress Management Indonesia on October 7th, 2014, to create a healthy-life movement by building a mentally and physically healthy community focusing on providing the right information and
                    the most suitable solution for managing mental health in holistic way.
                  </p>
                  <p class="text-lg text-gray-700 pt-5">
                    Since its inception, the organization has been actively engaging with the community through workshops, seminars, and support groups, aiming to empower individuals with effective stress management techniques. By fostering
                    an environment of open dialogue and mutual support, Stress Management Indonesia has become an essential resource for those seeking to improve their mental well-being, helping them face life’s challenges with resilience
                    and confidence.
                  </p>
                </div>
              </div>

              <!-- Kolom 2: Image -->
              <div class="md:w-1/2 flex items-center justify-center md:justify-end mt-4 md:mt-0">
                <!-- Memastikan gambar di posisikan di kanan -->
                <div class="bg-primary-color w-[370px] h-[570px] md:w-[500px] md:h-[570px] rounded-xl relative md:flex md:items-start md:justify-end">
                  <img src="./asset/coach priss.jpg" alt="Map" class="w-[270px] h-[570px] md:w-[500px] md:h-[570px] object-cover rounded-xl absolute right-10 top-10" />
                </div>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-36 md:-mx-14">
          <article>
            <div class="flex justify-end">
              <div class="bg-primary-color md:py-5 md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl px-4 md:px-0 font-semibold text-white text-right">Quotes</h1>
              </div>
            </div>
            <!-- <div class="flex justify-end py-5 px-16">
              <p class="w-1/2 text-right">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor dictum quam, sit amet pharetra arcu blandit a. Donec et eros erat. Aliquam quis tempor libero, non convallis dui. Vestibulum ante
              </p>
            </div> -->

            <div>
              <div class="py-20 flex items-center justify-center">
                <section
                  :aria-labelledby="title.toLowerCase().replace(' ', '-')"
                  class="flex flex-col items-center justify-center w-full max-w-lg"
                  @keydown.arrow-right="state.usedKeyboard = true;updateCurrent(nextSlide)"
                  @keydown.arrow-left="state.usedKeyboard = true;updateCurrent(previousSlide)"
                  @keydown.window.tab="state.usedKeyboard = true"
                  x-data="testimonialSlideshow(slides)"
                  x-title="Quotes Slideshow"
                  x-init="setup()">
                  <div :id="title.toLowerCase().replace(' ', '-')" class="sr-only" x-text="title"></div>
                  <div tabindex="1" class="relative w-full overflow-hidden mb-6 bg-primary-color" :class="{'focus:outline-none' : !state.usedKeyboard}">
                    <template x-for="(slide, index) in slides" :key="slide.id">
                      <div :aria-hidden="(state.order[state.currentSlide] != slide.id).toString()">
                        <div
                          x-show="state.order[state.currentSlide] == slide.id"
                          class="w-full text-center p-16"
                          :x-ref="slide.id"
                          :x-transition:enter="transitions('enter')"
                          :x-transition:enter-start="transitions('enter-start')"
                          :x-transition:enter-end="transitions('enter-end')"
                          :x-transition:leave="transitions('leave')"
                          :x-transition:leave-start="transitions('leave-start')"
                          :x-transition:leave-end="transitions('leave-end')">
                          <blockquote>
                            <p class="text-2xl font-extrabold italic mb-4 text-white leading-tight" x-html="slide.content"></p>
                            <footer class="text-white">—<cite x-html="slide.author"></cite></footer>
                          </blockquote>
                        </div>
                      </div>
                    </template>
                    <div x-cloak class="w-full bg-gray-200">
                      <div class="bg-indigo-500 h-2 w-0" :class="{'progress': !state.moving}" :style="`animation-duration:${attributes.timer}ms;`"></div>
                    </div>
                  </div>
                  <div aria-live="polite" aria-atomic="true" class="sr-only" x-text="'Slide ' + (state.currentSlide + 1) + ' of ' + slides.length"></div>
                  <div>
                    <template x-for="(slide, index) in Array.from({ length: slides.length })" :key="index">
                      <button
                        class="text-white inline-flex items-center justify-center bg-gray-600 hover:bg-indigo-500 w-4 h-4 p-0 mb-2 rounded-full"
                        style="text-indent: -9999px"
                        :class="{'bg-indigo-500' : state.currentSlide == index,'focus:outline-none' : !state.usedKeyboard, }"
                        @click="stopAutoplay();updateCurrent(index)"
                        x-text="index + 1"></button>
                    </template>
                  </div>
                </section>
              </div>

              <!-- Dev tools -->
              <div id="alpine-devtools" x-data="devtools()" x-show="alpines.length" x-init="start()"></div>

              <script>
                // Alpine 2.3.5
                window.testimonialSlideshow = function (slides) {
                  return {
                    title: "Programmer Quotes",
                    state: {
                      moving: false,
                      currentSlide: 0,
                      looping: false,
                      order: [],
                      nextSlideDirection: "",
                      userInteracted: false,
                      usedKeyboard: false,
                    },
                    autoplayTimer: null,
                    attributes: {
                      direction: "right-left",
                      duration: 1000,
                      timer: 7000,
                    },
                    slides: [],
                    setup() {
                      this.slides = slides.map((slide, index) => {
                        slide.id = index + Date.now();
                        return slide;
                      });

                      // Cache the original order so that we can reorder on transition (to skip inbetween slides)
                      this.state.order = this.slides.map((slide) => slide.id);
                      const newSlideOrder = this.slides.filter((slide) => this.current.id != slide.id);
                      newSlideOrder.unshift(this.current);
                      this.slides = newSlideOrder;

                      // Start the autoslide
                      this.attributes.timer && this.autoPlay();
                    },
                    get current() {
                      return this.slides.find((slide) => slide.id == this.state.order[this.state.currentSlide]);
                    },
                    get previousSlide() {
                      return this.state.currentSlide - 1 > -1 ? this.state.currentSlide - 1 : this.state.currentSlide;
                    },
                    get nextSlide() {
                      return this.state.currentSlide + 1 < this.slides.length ? this.state.currentSlide + 1 : this.state.currentSlide;
                    },
                    updateCurrent(nextSlide) {
                      if (nextSlide == this.state.currentSlide) return;
                      if (this.state.moving) return;
                      this.state.moving = true;

                      const next = this.slides.find((slide) => slide.id == this.state.order[nextSlide]);

                      // Reorder the slides for a smoother transition
                      const newSlideOrder = this.slides.filter((slide) => {
                        return ![this.current.id, this.state.order[nextSlide]].includes(slide.id);
                      });

                      const activeSlides = [this.current, next];
                      this.state.nextSlideDirection = nextSlide > this.state.currentSlide ? "right-to-left" : "left-to-right";

                      newSlideOrder.unshift(...(this.state.nextSlideDirection == "right-to-left" ? activeSlides : activeSlides.reverse()));
                      this.slides = newSlideOrder;
                      this.state.currentSlide = nextSlide;
                      setTimeout(() => {
                        this.state.moving = false;
                        // TODO: possibly a better check to determine whether autoplay should resume
                        this.attributes.timer && !this.autoplayTimer && this.autoPlay();
                      }, this.attributes.duration);
                    },
                    transitions(state, $dispatch) {
                      const rightToLeft = this.state.nextSlideDirection === "right-to-left";
                      switch (state) {
                        case "enter":
                          return `transition-all duration-${this.attributes.duration}`;
                        case "enter-start":
                          return rightToLeft ? "transform translate-x-full" : "transform -translate-x-full";
                        case "enter-end":
                          return "transform translate-x-0";
                        case "leave":
                          return `absolute top-0 transition-all duration-${this.attributes.duration}`;
                        case "leave-start":
                          return "transform translate-x-0";
                        case "leave-end":
                          return rightToLeft ? "transform -translate-x-full" : "transform translate-x-full";
                      }
                    },
                    autoPlay() {
                      this.loop = () => {
                        const next = this.state.currentSlide === this.slides.length - 1 ? 0 : this.state.currentSlide + 1;
                        this.updateCurrent(this.state.looping ? next : this.currentSlide);
                        this.autoplayTimer = setTimeout(() => {
                          requestAnimationFrame(this.loop);
                        }, this.attributes.timer + this.attributes.duration);
                      };
                      this.autoplayTimer = setTimeout(() => {
                        this.state.looping = true;
                        requestAnimationFrame(this.loop);
                      }, this.attributes.timer);
                    },
                    stopAutoplay() {
                      clearTimeout(this.autoplayTimer);
                      this.autoplayTimer = null;
                    },
                  };
                };

                window.slides = [
                  {
                    content: "Any fool can write code that a computer can understand. Good programmers write code that humans can understand.",
                    author: "Martin Fowler",
                  },
                  {
                    content: "First, solve the problem. Then, write the code.",
                    author: "John Johnson",
                  },
                  {
                    content: "Experience is the name everyone gives to their mistakes.",
                    author: "Oscar Wilde",
                  },
                  {
                    content: "In order to be irreplaceable, one must always be different.",
                    author: "Coco Chanel",
                  },
                  {
                    content: "Knowledge is power.",
                    author: "Francis Bacon",
                  },
                  {
                    content: "Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday’s code.",
                    author: "Dan Salomon",
                  },
                  {
                    content: "Perfection is achieved not when there is nothing more to add, but rather when there is nothing more to take away.",
                    author: "Antoine de Saint-Exupery",
                  },
                  {
                    content: "Ruby is rubbish! PHP is phpantastic!",
                    author: "Nikita Popov",
                  },
                  {
                    content: "Code is like humor. When you have to explain it, it’s bad.",
                    author: "Cory House",
                  },
                  {
                    content: "Fix the cause, not the symptom.",
                    author: "Steve Maguire",
                  },
                  {
                    content: "Optimism is an occupational hazard of programming: feedback is the treatment.",
                    author: "Kent Beck",
                  },
                  {
                    content: "When to use iterative development? You should use iterative development only on projects that you want to succeed.",
                    author: "Martin Fowler",
                  },
                  {
                    content: "Simplicity is the soul of efficiency.",
                    author: "Austin Freeman",
                  },
                  {
                    content: "Before software can be reusable it first has to be usable.",
                    author: "Ralph Johnson",
                  },
                  {
                    content: "Make it work, make it right, make it fast.",
                    author: "Kent Beck",
                  },
                ];
              </script>
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
