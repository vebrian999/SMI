<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stress Management Indoensia</title>
    <link href="./css/output.css?v=1.0.1" rel="stylesheet" />
    <link href="./css/style.css?v=1.0.1" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
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
        <div class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-fixed bg-blend-multiply  bg-[#1e1e1e] bg-opacity-80 bg-[url('./asset/background-footer.png')]"></div>

        <!-- Content jika bermasalah tambahkan z-10-->
        <div class="relative z-10">
          <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 ease-in-out flex justify-center">
          <div class="max-w-screen-2xl w-full mx-5 md:mx-32 flex flex-wrap items-center justify-between py-4">
              <a href="./home" class="flex items-center space-x-3 rtl:space-x-reverse">
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

                <div class="relative text-left ml-3 text-sm md:block hidden">
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
                    <a href="./home" class="block py-2 px-3 text-white bg-primary-color rounded md:bg-transparent md:hover:text-primary-color md:p-0 relative group" aria-current="page"
                      >Home
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./about-us" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >About Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./contact-us" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Contact Us
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./article" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
                      >Article
                      <span class="absolute left-0 right-0 bottom-0 h-0.5 bg-primary-color transition-all duration-300 transform scale-x-0 group-hover:scale-x-100"></span>
                    </a>
                  </li>
                  <li>
                    <a href="./our-product" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-color md:p-0 relative group"
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
                  <!-- Container for search results -->
                  <div id="search-results-mobile" class="mt-2 bg-white rounded-lg shadow-md overflow-hidden hidden"></div>
                </div>

                <script>
                  document.addEventListener("DOMContentLoaded", function () {
                    const searchInput = document.getElementById("search-sidebar");
                    const searchResults = document.getElementById("search-results-mobile");

                    searchInput.addEventListener("input", function () {
                      const query = this.value.trim();

                      if (query.length > 0) {
                        // Make an AJAX request to the server
                        fetch(`search.php?q=${encodeURIComponent(query)}`)
                          .then((response) => response.text())
                          .then((data) => {
                            searchResults.innerHTML = data;
                            searchResults.classList.remove("hidden");
                          })
                          .catch((error) => {
                            console.error("Error:", error);
                          });
                      } else {
                        searchResults.innerHTML = "";
                        searchResults.classList.add("hidden");
                      }
                    });
                  });
                </script>

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
                  <li><a href="./home" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Home</a></li>
                  <li><a href="./about-us" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">About Us</a></li>
                  <li><a href="./contact-us" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Contact Us</a></li>
                  <li><a href="./article" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Blog</a></li>
                  <li><a href="./our-product" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Our Product</a></li>
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
          <div class="md:mx-20 mx-10 py-24 text-white relative">
            <div class="my-28">
              <h1 class="md:text-7xl text-3xl text-center ">About Us</h1>
              <hr class="my-3 md:w-1/2 mx-auto " />
              <p class="md:text-lg text-sm text-center">
                Our Commitment to Raising Mental Awareness and Wellbeing We <br />
                focus on providing information, support and resources to help <br />individuals understand and care for their mental health.
              </p>
            </div>
            <!-- Navigation Dots and Arrows -->
          </div>
        </div>
      </section>
      <!-- End Of Jumbotron -->
    </header>

    <main class="mx-4 md:mx-40 2xl:mx-40">
      <div id="content" class="container mx-auto">
        <!-- our vision & mission -->
        <section class="md:my-24 my-14 ">
          <article>
            <div class="relative flex justify-start">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-base text-white md:px-16 px-4">Our Vision & Mission</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full w-full -z-10 bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <!-- Content Section -->
            <div class="flex flex-col-reverse md:flex-row md:space-x-16 md:mt-12">
              <!-- Left Content -->
              <div class="md:mt-0 mt-8">
                <h1 class="font-medium text-lg md:text-3xl text-[#172432]">The following is our company's vision and mission</h1>

                <!-- Vision Section -->
                <div class="my-8">
                  <div class="flex items-center space-x-3">
                    <div class="bg-primary-color px-2.5 py-3.5 rounded-lg">
                      <svg class="md:w-16 md:h-14 w-9 h-7" viewBox="0 0 59 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M2.14238 23.3812C1.95272 22.8147 1.95253 22.2013 2.14187 21.6347C5.95368 10.2266 16.763 2 29.5024 2C42.2358 2 53.0411 10.2189 56.8576 21.6188C57.0473 22.1853 57.0475 22.7987 56.8581 23.3653C53.0463 34.7734 42.237 43 29.4976 43C16.7642 43 5.95893 34.7811 2.14238 23.3812Z"
                          stroke="white"
                          stroke-width="3"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path
                          d="M37.7368 22.5C37.7368 27.0287 34.0491 30.7 29.5002 30.7C24.9512 30.7 21.2636 27.0287 21.2636 22.5C21.2636 17.9713 24.9512 14.3 29.5002 14.3C34.0491 14.3 37.7368 17.9713 37.7368 22.5Z"
                          stroke="white"
                          stroke-width="3"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>
                    </div>
                    <h5 class="font-medium text-lg md:text-xl text-[#172432]">Our Vision</h5>
                  </div>
                  <p class="my-5 mb-10 md:text-lg text-base text-[#172432]">We not me! No one is to walk this journey alone.</p>
                </div>

                <!-- Mission Section -->
                <div>
                  <div class="flex items-center space-x-3">
                    <div class="bg-primary-color px-3.5 py-3 rounded-lg">
                      <svg class="md:w-14 md:h-14 w-7 h-7" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M29.9256 32.0741L42.8144 19.1853" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M59.9995 10.5925H51.4069V2L42.8144 10.5925V19.1851H51.4069L59.9995 10.5925Z" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M29.9257 44.9629C37.044 44.9629 42.8145 39.1924 42.8145 32.0741C42.8145 24.9558 37.044 19.1853 29.9257 19.1853C22.8074 19.1853 17.0369 24.9558 17.0369 32.0741C17.0369 39.1924 22.8074 44.9629 29.9257 44.9629Z"
                          stroke="white"
                          stroke-width="3"
                          stroke-miterlimit="10"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path
                          d="M53.5552 17.0374C56.3478 21.3336 57.8514 26.4891 57.8514 32.0743C57.8514 47.5408 45.3923 60 29.9257 60C14.4592 60 2 47.5408 2 32.0743C2 16.6077 14.4592 4.14856 29.9257 4.14856C35.5109 4.14856 40.6664 5.65225 44.9627 8.44482"
                          stroke="white"
                          stroke-width="3"
                          stroke-miterlimit="10"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>
                    </div>
                    <h5 class="md:text-xl text-lg font-medium text-[#172432]">Our Mission</h5>
                  </div>
                  <p class="mt-5 text-base md:text-lg text-[#172432]">
                    Our mission is to create a healthy-life movement by building a mentally and physically healthy community and providing the right information and the most suitable solution for managing mental health.
                  </p>
                </div>
              </div>
              <div class="flex gap-x-5 md:gap-x-10 md:mt-0 mt-9">
                <!-- Container untuk gambar pertama -->
                <div class="relative">
                  <!-- Background kuning untuk gambar pertama -->
                  <div class="absolute bg-secondary-color w-full h-[245px] md:h-[190px] 2xl:h-[360px] md:rounded-tl-3xl rounded-tl-3xl md:rounded-br-3xl rounded-br-3xl -z-10 top-5 right-3"></div>

                  <!-- Gambar pertama -->
                  <img src="./asset/section visi misi (2).png" alt="" class="w-[800px] rounded-tl-3xl rounded-br-3xl" />
                </div>

                <!-- Container untuk gambar kedua -->
                <div class="relative mt-16">
                  <!-- Background kuning untuk gambar kedua -->
                  <div class="absolute bg-secondary-color w-full h-full md:h-[190px] 2xl:h-[370px] rounded-tl-3xl rounded-br-3xl -z-10 top-3 right-3"></div>
                  <!-- Gambar kedua -->
                  <img src="./asset/section visi misi (1).png" alt="" class="w-[800px] rounded-tl-3xl rounded-br-3xl" />
                </div>
              </div>
            </div>
          </article>
        </section>

        <!-- How We Started -->
        <section class="md:my-24 my-16 ">
          <article>
            <div class="relative flex md:justify-end">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-base text-white md:px-16 px-4">How We Started</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full -z-10 w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <div class="flex flex-col md:flex-row md:space-x-10 pt-7 md:pt-14">
              <!-- carausel image -->
              <div class="relative md:w-1/2 md:mt-0 mt-7">
                <!-- Background -->
                <div class="absolute md:left-5 md:-bottom-5 left-3 -bottom-3 w-full h-full bg-secondary-color md:rounded-tr-3xl md:rounded-bl-2xl rounded-tr-2xl rounded-bl-2xl -z-10"></div>

                <div class="overflow-hidden">
                  <!-- Carousel container -->
                  <div class="relative carousel-container1">
                    <!-- Slides -->
                    <div class="flex transition-transform duration-500 ease-in-out carousel-slides1">
                      <div class="relative min-w-full">
                        <img src="./asset/membaca(depanlaptop)-selff-love.png" alt="" class="rounded-tr-3xl rounded-bl-3xl md:rounded-tr-2xl md:rounded-bl-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/reggy-main-gitar.png" alt="" class="rounded-tr-3xl rounded-bl-3xl md:rounded-tr-2xl md:rounded-bl-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/foto-pemandangan.png" alt="" class="rounded-tr-3xl rounded-bl-3xl md:rounded-tr-2xl md:rounded-bl-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/foto-meditasi.png" alt="" class="rounded-tr-3xl rounded-bl-3xl md:rounded-tr-2xl md:rounded-bl-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/coach priss-removebg-preview.png" alt="" class="rounded-tr-3xl rounded-bl-3xl md:rounded-tr-2xl md:rounded-bl-2xl w-full" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Controls -->
                <div class="absolute bottom-5 left-0 right-0 flex justify-center mt-4">
                  <div class="flex space-x-4">
                    <button class="w-3 h-3 rounded-full bg-secondary-color focus:outline-none carousel-dot1" data-index="0"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot1" data-index="1"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot1" data-index="2"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot1" data-index="3"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot1" data-index="4"></button>
                  </div>
                </div>
              </div>

              <!-- text -->
              <div class="bg-primary-color md:w-1/2 p-5 md:p-12 mt-14 md:mt-0 rounded-tl-2xl rounded-br-2xl md:rounded-tl-3xl md:rounded-br-3xl h-1/2 text-white md:text-lg text-base font-normal">
                <p>
                  Priscilla was inspired to create Stress Management Indonesia on October 7th, 2014, to create a healthy-life movement by building a mentally and physically healthy community focusing on providing the right information and
                  the most suitable solution for managing mental health in a holistic way.
                </p>

                <p class="mt-7">
                  Since its inception, the organization has been actively engaging with the community through workshops, seminars, and support groups, aiming to empower individuals with effective stress management techniques. By fostering
                  an environment of open dialogue and mutual support, Stress Management Indonesia has become an essential resource for those seeking to improve their mental well-being, helping them face life’s challenges with resilience and
                  confidence.
                </p>
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const slidesContainer = document.querySelector(".carousel-slides1");
                  const dots = document.querySelectorAll(".carousel-dot1");
                  let currentSlide = 0;
                  let autoplayInterval;

                  // Function to update slides
                  function updateSlide(index) {
                    currentSlide = index;
                    slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

                    // Update dots
                    dots.forEach((dot, i) => {
                      if (i === currentSlide) {
                        dot.classList.remove("bg-gray-400");
                        dot.classList.add("bg-secondary-color");
                      } else {
                        dot.classList.remove("bg-secondary-color");
                        dot.classList.add("bg-gray-400");
                      }
                    });
                  }

                  // Add click events to dots
                  dots.forEach((dot, index) => {
                    dot.addEventListener("click", () => {
                      clearInterval(autoplayInterval);
                      updateSlide(index);
                      startAutoplay();
                    });
                  });

                  // Autoplay function
                  function startAutoplay() {
                    autoplayInterval = setInterval(() => {
                      currentSlide = (currentSlide + 1) % dots.length;
                      updateSlide(currentSlide);
                    }, 5000); // Change slide every 5 seconds
                  }

                  // Start autoplay initially
                  startAutoplay();

                  // Pause autoplay when hovering over carousel
                  const carouselContainer = document.querySelector(".carousel-container1");
                  carouselContainer.addEventListener("mouseenter", () => clearInterval(autoplayInterval));
                  carouselContainer.addEventListener("mouseleave", startAutoplay);
                });
              </script>
            </div>
          </article>
        </section>

        <!-- benefit -->
        <section class="my-24 ">
          <article>
            <div class="relative flex justify-start">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-base text-white md:px-16">What are the benefits of SMI?</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -z-10 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <div class="md:flex md:space-x-5 space-y-20 md:space-y-0 justify-between mt-16 mb-40">
              <!-- Card 1 -->
              <div class="relative max-w-md">
                <img class="rounded-tl-3xl rounded-br-3xl w-[446px] h-[352px] object-cover" src="./asset/card-img1.png" alt="" />
                <!-- Menambahkan positioning untuk teks "Health" -->
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-50 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Health</p>
                </div>

                <!-- Elemen background kuning -->
                <div class="absolute xl:block hidden   w-80  top-80 md:top-64 md:left-12 transform ">
                  <img src="./asset/bg-yellocard-section-about-us.png" alt="">
                </div>

                <!-- Konten utama dengan background abu-abu di atas background kuning -->
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100  max-w-md mx-7 md:py-10 rounded-tl-3xl rounded-br-3xl shadow-xl">
                  <p class="mb-3 font-normal text-gray-500 text-center">Stress Management Indonesia believes that a...</p>
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
              <div id="defaultModal1" tabindex="-1" aria-hidden="true" class="fixed -top-20 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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

              <div class="relative max-w-md">
                <!-- Perbesar ukuran gambar dengan width-full -->
                <img class="rounded-tl-3xl rounded-br-3xl w-[446px] h-[352px] object-cover" src="./asset/card-img2.png" alt="" />
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-60 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Happiness</p>
                </div>

                <div class="absolute xl:block hidden   w-80  top-80 md:top-64 md:left-12 transform ">
                  <img src="./asset/bg-yellocard-section-about-us.png" alt="">
                </div>

                <!-- Bagian teks dan tombol diposisikan secara absolut di atas gambar -->
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100 z-5 max-w-md mx-7 md:py-10 rounded-tl-3xl rounded-br-3xl shadow-xl">
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
              <div id="defaultModal2" tabindex="-1" aria-hidden="true" class="fixed -top-20 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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

              <div class="relative max-w-md">
                <!-- Perbesar ukuran gambar dengan width-full -->
                <img class="rounded-tl-3xl rounded-br-3xl w-[446px] h-[352px] object-cover" src="./asset/card-img3.png" alt="" />
                <div class="absolute top-2 right-2 bg-primary-color bg-opacity-60 px-5 py-2 rounded-lg shadow-md">
                  <p class="text-white font-semibold">Realistic</p>
                </div>

                <div class="absolute xl:block hidden   w-80  top-80 md:top-64 md:left-12 transform ">
                  <img src="./asset/bg-yellocard-section-about-us.png" alt="">
                </div>
                <!-- Bagian teks dan tombol diposisikan secara absolut di atas gambar -->
                <div class="absolute inset-x-0 top-80 md:top-72 transform -translate-y-1/4 flex flex-col justify-center items-center p-2 md:p-5 bg-gray-100 z-5 max-w-md mx-7 md:py-10 rounded-tl-3xl rounded-br-3xl shadow-xl">
                  <p class="mb-3 font-normal text-gray-500 text-center">Increased levels of happiness are marked by clarity....</p>
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
              <div id="defaultModal3" tabindex="-1" aria-hidden="true" class="fixed -top-20 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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

        <!-- why us section -->
        <section class="my-24 ">
          <article>
            <div class="relative flex justify-end">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-xl text-white md:px-16 px-4">Why Us?</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full w-full -z-10 bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <div class="flex mt-14 flex-col-reverse md:flex-row space-y-6 md:space-y-0 md:space-x-14">
              <!-- Kolom Teks -->
              <div class="w-full md:w-1/2 order-1 md:order-1">
                <div class="flex justify-end">
                  <p class="py-4 text-gray-900 max-w-full">At Stress Management Indonesia, we believe in empowering individuals through proven methods that enhance both mental and physical well-being.</p>
                </div>

                <div class="space-y-10">
                  <!-- Bagian 1: SVG dengan teks di sebelah kanan -->
                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded-xl">
                      <svg class="md:w-14 md:h-14 w-7 h-7" viewBox="0 0 59 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.9127 0V33.0873H59C57.1783 47.6958 44.7165 59 29.6146 59C13.2589 59 0 45.7412 0 29.3855C0 14.2834 11.3042 1.82166 25.9127 0Z" fill="white" />
                        <path d="M33.3163 0V25.6836H58.9999C57.3297 12.2878 46.7121 1.67044 33.3163 0Z" fill="white" />
                      </svg>
                    </div>
                    <!-- Teks di sebelah kanan SVG -->
                    <div>
                      <h1 class="md:text-xl font-normal md:font-medium text-lg">Based on data and facts</h1>
                    </div>
                  </div>

                  <!-- Bagian 2: Deskripsi teks -->
                  <p class="text-gray-950">All our methods are proven effective through expert research, ensuring you receive reliable and impactful support for your well-being and stress management.</p>

                  <!-- Bagian 3: SVG dengan teks kedua -->
                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded-xl">
                      <svg class="md:w-14 w-7 h-7 md:h-14" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 50V47.0625M14.75 50V38.25M26.5 50V26.5M38.25 50V14.75M50 50V3" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </div>
                    <!-- Teks di sebelah kanan SVG -->
                    <div>
                      <h1 class="md:text-xl font-normal md:font-medium text-lg">Realistic</h1>
                    </div>
                  </div>
                  <p class="text-gray-950">The programs we provide are grounded in current data and facts, maximizing effectiveness and ensuring impactful outcomes for all participants.</p>

                  <!-- Bagian 4: SVG dengan teks ketiga -->
                  <div class="flex items-center space-x-4">
                    <!-- Kotak dengan background warna primary -->
                    <div class="bg-primary-color p-4 rounded-xl">
                      <svg class="md:w-14 w-7 md:h-14 h-7" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                      <h1 class="md:text-xl font-normal md:font-medium text-lg">Easy to practice</h1>
                    </div>
                  </div>
                  <p class="text-gray-950">All the self-improvement methods that we provide can be easily integrated into your daily routine, allowing for consistent growth and development.</p>
                </div>
              </div>

              <!-- Kolom Carousel Gambar -->
              <div class="w-full md:w-1/2 order-2 md:order-2 md:mt-0 relative">
                <!-- Background -->
                <div class="absolute md:-left-5 -left-3 md:-bottom-5  -bottom-3 w-full h-full   -z-10">
                  <img src="./asset/bg-yellow-image.png" alt="">
                </div>

                <div class="overflow-hidden">
                  <!-- Carousel container -->
                  <div class="relative carousel-container">
                    <!-- Slides -->
                    <div class="flex transition-transform duration-500 ease-in-out carousel-slides">
                      <div class="relative min-w-full">
                        <img src="./asset/wawancara.png" alt="why us 1" class="rounded-tl-3xl rounded-br-3xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/menulis-self-love-junaling.png" alt="why us 2" class="rounded-tl-3xl rounded-br-3xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/meditasi.png" alt="why us 3" class="rounded-tl-3xl rounded-br-3xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/baca-buku-self-love-jurnaling.png" alt="why us 3" class="rounded-tl-3xl rounded-br-3xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/diskusi-bersama.png" alt="why us 3" class="rounded-tl-3xl rounded-br-3xl w-full" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Controls/Dots -->
                <div class="absolute bottom-5 left-0 right-0 flex justify-center mt-4 xl:bottom-28 2xl:bottom-5">
                  <div class="flex space-x-4">
                    <button class="w-3 h-3 rounded-full bg-secondary-color focus:outline-none carousel-dot" data-index="0"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="1"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="2"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="2"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="2"></button>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const slidesContainer = document.querySelector(".carousel-slides");
              const dots = document.querySelectorAll(".carousel-dot");
              let currentSlide = 0;
              let autoplayInterval;

              // Function to update slides
              function updateSlide(index) {
                currentSlide = index;
                slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Update dots
                dots.forEach((dot, i) => {
                  if (i === currentSlide) {
                    dot.classList.remove("bg-gray-400");
                    dot.classList.add("bg-secondary-color");
                  } else {
                    dot.classList.remove("bg-secondary-color");
                    dot.classList.add("bg-gray-400");
                  }
                });
              }

              // Add click events to dots
              dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                  clearInterval(autoplayInterval);
                  updateSlide(index);
                  startAutoplay();
                });
              });

              // Autoplay function
              function startAutoplay() {
                autoplayInterval = setInterval(() => {
                  currentSlide = (currentSlide + 1) % dots.length;
                  updateSlide(currentSlide);
                }, 5000); // Change slide every 5 seconds
              }

              // Start autoplay initially
              startAutoplay();

              // Pause autoplay when hovering over carousel
              const carouselContainer = document.querySelector(".carousel-container");
              carouselContainer.addEventListener("mouseenter", () => clearInterval(autoplayInterval));
              carouselContainer.addEventListener("mouseleave", startAutoplay);
            });
          </script>
        </section>

        <!-- our team section -->
        <section class="my-24 ">
          <article>
            <div class="relative flex justify-start">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-xl text-white md:px-16 px-4">Our Team</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -z-10 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <div class="flex py-5 mt-7">
              <p class="md:w-2/3 md:text-lg">  best support for your mental health journey. Get to know our team members who are ready to help!</p>
            </div>

            <div>
              <section class="bg-white">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-10 lg:px-6">
                  <!-- Carousel container -->
                  <div class="overflow-hidden relative">
                    <!-- Slides container with transition -->
                    <div class="team-carousel-slides flex transition-transform duration-500 ease-in-out">
                      <!-- First slide -->
<div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 min-w-full">
  <!-- Team member 1 -->
  <div class="relative text-center text-gray-500 overflow-hidden">
    <!-- Background and Image -->
    <div class="relative">
      <div class="absolute inset-0 h-[200px] top-14 bg-primary-color rounded-tl-[64px] rounded-br-[64px]"></div>
      <img class="relative mx-auto mb-4 w-1/2 object-cover " src="./asset/coach priss.png" alt="Coach" />
    </div>
    <!-- Text content outside the background -->
    <div class="mt-4">
      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
        <a href="#">Coach Priss</a>
      </h3>
      <p>Founder SMI</p>
    </div>
  </div>

  <!-- Team member 2 -->
  <div class="relative text-center text-gray-500 overflow-hidden">
    <!-- Background and Image -->
    <div class="relative">
      <div class="absolute inset-0 h-[200px] top-14 bg-primary-color rounded-tl-[64px] rounded-br-[64px]"></div>
      <img class="relative mx-auto mb-4 w-1/2 object-cover" src="./asset/andreas.png" alt="Andreas" />
    </div>
    <!-- Text content outside the background -->
    <div class="mt-4">
      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
        <a href="#">Andreas</a>
      </h3>
      <p>Co-Founder SMI</p>
    </div>
  </div>

  <!-- Team member 3 -->
  <div class="relative text-center text-gray-500 overflow-hidden">
    <!-- Background and Image -->
    <div class="relative">
      <div class="absolute inset-0 h-[200px] top-14 bg-primary-color rounded-tl-[64px] rounded-br-[64px]"></div>
      <img class="relative mx-auto mb-4 w-1/2 object-cover" src="./asset/andreas.png" alt="Andreas" />
    </div>
    <!-- Text content outside the background -->
    <div class="mt-4">
      <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
        <a href="#">Andreas</a>
      </h3>
      <p>Co-Founder SMI</p>
    </div>
  </div>
</div>






                      <!-- Second slide -->
                      <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 min-w-full">
                        <!-- Add team members for second slide -->
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                      </div>

                      <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 min-w-full">
                        <!-- Add team members for second slide -->
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                        <div class="text-center text-gray-500">
                          <img class="mx-auto mb-4 w-64 h-64 rounded-full" src="./asset/blank-profile-picture.png" alt="Leslie Avatar" />
                          <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="#">John Doe</a>
                          </h3>
                          <p>Graphic Designer</p>
                          <!-- Social links here -->
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Carousel controls -->
                  <div class="flex justify-center mt-8">
                    <div class="flex space-x-4" id="teamCarouselControls">
                      <button class="w-3 h-3 rounded-full bg-secondary-color focus:outline-none team-carousel-dot" data-slide="0"></button>
                      <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none team-carousel-dot" data-slide="1"></button>
                      <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none team-carousel-dot" data-slide="2"></button>
                      <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none team-carousel-dot" data-slide="3"></button>
                      <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none team-carousel-dot" data-slide="4"></button>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </article>
        </section>

        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const slidesContainer = document.querySelector(".team-carousel-slides");
            const slides = document.querySelectorAll(".team-carousel-slides > div");
            const dotsContainer = document.getElementById("teamCarouselControls");
            let currentSlide = 0;

            // Buat dots berdasarkan jumlah slide yang ada
            function createDots() {
              dotsContainer.innerHTML = ""; // Bersihkan dots yang ada
              slides.forEach((_, index) => {
                const dot = document.createElement("button");
                dot.className = `w-3 h-3 rounded-full focus:outline-none team-carousel-dot ${index === 0 ? "bg-secondary-color" : "bg-gray-400"}`;
                dot.setAttribute("data-slide", index);
                dotsContainer.appendChild(dot);
              });
            }

            // Function to update slide position
            function updateSlide(index) {
              // Update slide position
              slidesContainer.style.transform = `translateX(-${index * 100}%)`;

              // Update dots
              const dots = document.querySelectorAll(".team-carousel-dot");
              dots.forEach((dot, i) => {
                if (i === index) {
                  dot.classList.remove("bg-gray-400");
                  dot.classList.add("bg-secondary-color");
                } else {
                  dot.classList.remove("bg-secondary-color");
                  dot.classList.add("bg-gray-400");
                }
              });

              // Update current slide
              currentSlide = index;
            }

            // Buat dots
            createDots();

            // Add click event to dots
            const dots = document.querySelectorAll(".team-carousel-dot");
            dots.forEach((dot, index) => {
              dot.addEventListener("click", () => {
                updateSlide(index);
              });
            });
          });
        </script>

        <section class="my-24 ">
          <article>
            <div class="relative flex justify-end">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-10 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative">
                  <h1 class="md:text-4xl font-semibold text-center text-xl text-white md:px-16 px-4">Quotes</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full -z-10 w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>
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
                  <div tabindex="1" class="relative w-full rounded-tl-3xl rounded-br-3xl overflow-hidden mb-6 bg-primary-color" :class="{'focus:outline-none' : !state.usedKeyboard}">
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
                      <div class="bg-secondary-color h-2 w-0" :class="{'progress': !state.moving}" :style="`animation-duration:${attributes.timer}ms;`"></div>
                    </div>
                  </div>
                  <div aria-live="polite" aria-atomic="true" class="sr-only" x-text="'Slide ' + (state.currentSlide + 1) + ' of ' + slides.length"></div>
                  <div>
                    <template x-for="(slide, index) in Array.from({ length: slides.length })" :key="index">
                      <button
                        class="text-white inline-flex items-center md:mx-1 mx-0.5 justify-center bg-gray-600 hover:bg-secondary-color w-4 h-4 p-0 mb-2 rounded-full"
                        style="text-indent: -9999px"
                        :class="{'bg-secondary-color' : state.currentSlide == index,'focus:outline-none' : !state.usedKeyboard, }"
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
                    content: "Your mental health is a priority. Your happiness is an essential. Your self-care is a necessity.",
                    author: "arjuna",
                  },
                  {
                    content: "You are not your illness. You have a story to tell. You have a name, a history, a personality. Staying yourself is part of the battle.",
                    author: "Julian Seifter",
                  },
                  {
                    content: "Mental health…is not a destination, but a process. It's about how you drive, not where you're going.",
                    author: "Noam Shpancer",
                  },
                  {
                    content: "It's okay to have bad days, it doesn’t mean you’re weak. It means you’re human.",
                    author: "Smilling",
                  },
                  {
                    content: "The strongest people are those who win battles we know nothing about.",
                    author: "Bejo",
                  },
                  {
                    content: "You don’t have to control your thoughts; you just have to stop letting them control you.",
                    author: "Dan Millman",
                  },
                  {
                    content: "It’s not the load that breaks you down, it’s the way you carry it.",
                    author: "Lou Holtz",
                  },
                  {
                    content: "Don’t let your struggles define you. You are more than what you’re going through.",
                    author: "Dadang",
                  },
                  {
                    content: "Bersikaplah baik pada pikiranmu. Kamu sedang melakukan yang terbaik dengan apa yang kamu miliki.",
                    author: "Fufu",
                  },
                  {
                    content: "Nilai dirimu tidak berkurang hanya karena seseorang tidak bisa melihat betapa berharganya kamu.",
                    author: "Fafa",
                  },
                  {
                    content: "Pemulihan bukanlah sesuatu yang sekali selesai. Itu adalah perjalanan seumur hidup yang berlangsung satu hari, satu langkah dalam satu waktu.",
                    author: "Indah",
                  },
                  {
                    content: "Beri dirimu perhatian dan perawatan yang sama seperti yang kamu berikan kepada orang lain, dan lihatlah dirimu berkembang.",
                    author: "Martin",
                  },
                  {
                    content: "Tidak apa-apa untuk meminta bantuan. Meminta bantuan bukan berarti kamu lemah.",
                    author: "rehan",
                  },
                  {
                    content: "Kesehatan mentalmu pantas untuk diperjuangkan. Ketenangan pikiranmu berharga.",
                    author: "febrian",
                  },
                  {
                    content: "Tarik napas dalam-dalam, ini hanya hari yang buruk, bukan hidup yang buruk.",
                    author: "Anto",
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
