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
              const query = document.getElementById('search-desktop').value;

              if (query.length > 0) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `search.php?q=${encodeURIComponent(query)}`, true);
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    const resultsContainer = document.getElementById('search-results-desktop');
                    resultsContainer.innerHTML = xhr.responseText;
                    resultsContainer.classList.remove('hidden'); // Tampilkan hasil
                  }
                };
                xhr.send();
              } else {
                // Kosongkan dan sembunyikan hasil jika input kosong
                document.getElementById('search-results-desktop').innerHTML = '';
                document.getElementById('search-results-desktop').classList.add('hidden');
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
                  <li><a href="./blog.php" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Article</a></li>
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
              <h1 class="md:text-7xl text-3xl text-center">Article</h1>
              <hr class="my-3 md:w-1/2 mx-auto" />
              <p class="md:text-lg text-sm text-center">Explore the latest articles and insights on mental health. Find </p>
              <p class="md:text-lg text-sm text-center">practical tips, coping strategies, and support to help you maintain</p>
              <p class="md:text-lg text-sm text-center">optimal mental health.</p>
            </div>
            <!-- Navigation Dots and Arrows -->
          </div>
        </div>
      </section>
      <!-- End Of Jumbotron -->
    </header>