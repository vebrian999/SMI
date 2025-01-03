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
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <header>
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
              <li><a href="#" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Home</a></li>
              <li><a href="./about-us" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">About Us</a></li>
              <li><a href="./contact-us" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Contact Us</a></li>
              <li><a href="./article" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Article</a></li>
              <li><a href="./our-product" class="block text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md">Our Product</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- JS for Flowbite Drawer -->
      <script>
        document.querySelector("[data-drawer-target]").addEventListener("click", function () {
          document.getElementById("sidebar-menu").classList.toggle("-translate-x-full");
        });
        document.querySelector("[data-drawer-hide]").addEventListener("click", function () {
          document.getElementById("sidebar-menu").classList.toggle("-translate-x-full");
        });
      </script>

      <script src="./js/app.js"></script>
      <!-- akhir navbar -->

      <div id="default-carousel" class="relative w-full  " data-carousel="slide" data-carousel-interval="7000">
        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden md:h-screen ">
          <!-- Item 1 -->
          <div class="hidden duration-1000 ease-in-out" data-carousel-item="active">
            <img src="./asset/jumbotron carausel (1).png" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." />
            <div class="absolute inset-0 flex items-center justify-between p-4 md:p-14 2xl:px-32 text-white bg-black bg-opacity-30">
              <!-- Teks di sebelah kiri -->
              <div class="w-full md:w-1/2">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight">Be Your <span class="text-secondary-color">Happy Self</span> Holistically.</h1>
                <div class="flex space-x-4">
                  <a href="https://www.youtube.com/watch?v=8F9r1tsgjM8&t=1511s" class="mt-6 px-6 py-2.5 font-normal text-white bg-primary-color rounded-full hover:underline hover:bg-[#4A1056] focus:outline-none">Find Out More</a>
                  <button class="mt-6 px-6 py-2.5 font-normal text-white bg-transparent rounded-full hover:underline focus:outline-none border border-white learn-more" data-target="#content">Explore More</button>

                </div>
                <p class="mt-7 text-base md:text-lg">To have <strong>a healthy brain</strong>, you have to have <strong>a healthy body</strong></p>
              </div>
              <!-- Gambar di sebelah kanan -->
              <div class="hidden md:flex w-1/2 justify-end">
                <iframe
                  width="560"
                  height="315"
                  src="https://www.youtube.com/embed/8F9r1tsgjM8?si=H_LP2Bw0iGU5_-Bf"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  referrerpolicy="strict-origin-when-cross-origin"
                  allowfullscreen
                  class="animate-float">
                </iframe>
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="./asset/jumbotron new.png" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." />
            <div class="absolute inset-0 flex items-center justify-between p-4 md:p-14 2xl:px-32 text-white bg-black bg-opacity-30">
              <!-- Teks di sebelah kiri -->
              <div class="w-full md:w-1/2">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight">Discover<span class="text-secondary-color"> Self-Love</span> Through Journaling.</h1>
                <div class="flex space-x-4">
                  <a href="https://shopee.co.id/Self-Love-Journaling-i.504044759.23616848833?xptdk=e620a1b1-3dd3-4f1f-b20f-110bec771380" class="mt-6 px-6 py-2.5 font-normal text-white bg-primary-color rounded-full hover:underline hover:bg-[#4A1056] focus:outline-none">Find Out More</a>
                  <button class="mt-6 px-6 py-2.5 font-normal text-white bg-transparent rounded-full hover:underline focus:outline-none border border-white learn-more" data-target="#content">Explore More</button>

                </div>
                <p class="mt-7 text-base md:text-lg"><strong>A Healthy Mind</strong> Begins with Self-Love Start Your Journey with <strong>Self-Love Journaling.</strong></p>
              </div>
              <!-- Gambar di sebelah kanan -->
              <div class="hidden md:flex w-1/2 justify-end">
                <img src="./asset/buku-self-love.png" alt="" class="animate-float" />
              </div>
            </div>
          </div>

          <!-- Item 3 -->
          <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="./asset/jumbotron carausel (2).png" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." />
            <div class="absolute inset-0 flex items-center justify-between p-4 md:p-14 2xl:px-32 text-white bg-black bg-opacity-30">
              <div class="w-full md:w-1/2">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight">Watch <span class="text-secondary-color">"Sari & Teratai Putih"</span> - Inspirational Animation</h1>
                <div class="flex space-x-4">
                  <a href="https://www.youtube.com/watch?v=DhDva3ghKGs" class="mt-6 px-6 py-2.5 font-normal text-white bg-primary-color rounded-full hover:underline hover:bg-[#4A1056] focus:outline-none">Find Out More</a>
                  <button class="mt-6 px-6 py-2.5 font-normal text-white bg-transparent rounded-full hover:underline focus:outline-none border border-white learn-more" data-target="#content">Explore More</button>

                </div>
                <p class="mt-7 text-base md:text-lg">Experience the harmony of an inspiring story in stunning animation. <strong>Click and watch now!</strong></p>
              </div>
              <div class="hidden md:flex w-1/2 justify-end">
                <iframe
                  class="animate-float"
                  width="560"
                  height="315"
                  src="https://www.youtube.com/embed/DhDva3ghKGs?si=WFN6JVhJ4kuwM0mJ"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  referrerpolicy="strict-origin-when-cross-origin"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <!-- Item 4 -->
          <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="./asset/jumbotron carausel (3).png" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." />
            <div class="absolute inset-0 flex items-center justify-between p-4 md:p-14 2xl:px-32 text-white bg-black bg-opacity-30">
              <!-- Teks di sebelah kiri -->
              <div class="w-full md:w-1/2">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight">Find Peace with <span class="text-secondary-color">Meditation</span></h1>
                <div class="flex space-x-4">
                  <a href="https://shopee.co.id/Meditasi-Harmoni-untuk-Move-On-Menavigasi-PHK-dengan-Pikiran-yang-Jernih-(E-Book)-i.504044759.26757094580" class="mt-6 px-6 py-2.5 font-normal text-white bg-primary-color rounded-full hover:underline hover:bg-[#4A1056] focus:outline-none">Find Out More</a>
                  <button class="mt-6 px-6 py-2.5 font-normal text-white bg-transparent rounded-full hover:underline focus:outline-none border border-white learn-more" data-target="#content">Explore More</button>

                </div>
                <p class="mt-7 text-base md:text-lg">Meditation for peace, focus and balance. <strong>Start Now.</strong></p>
              </div>
              <!-- Gambar di sebelah kanan -->
              <div class="hidden md:flex w-1/2 justify-end">
                <img src="./asset/meditasi-siluet.png" alt="" class="animate-float" />
              </div>
            </div>
          </div>
          <!-- Item 5 -->
          <!-- <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <img src="./asset/jumbotron carausel (4).png" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." />
            <div class="absolute inset-0 flex items-center justify-start p-4 md:p-14 text-white bg-black bg-opacity-30">
              <div>
                <h1 class="text-4xl font-bold">Be Your <span class="text-primary-color">Happy Self</span> Holistically.</h1>
                <p class="mt-4 text-lg">To have a <span class="underline">healthy brain,</span> you have to have a <span class="underline">healthy body</span></p>
                <div class="flex space-x-4">
                  <a href="" class="mt-6 px-6 py-2.5 font-normal text-white bg-primary-color rounded-full hover:underline hover:bg-[#4A1056] focus:outline-none">Find Out More</a>
                  <button class="mt-6 px-6 py-2.5 font-normal text-white bg-transparent rounded-full hover:underline focus:outline-none border border-white learn-more" data-target="#content">Explore More</button>

                </div>
              </div>
            </div>
          </div> -->
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-10 left-1/2 space-x-3 rtl:space-x-reverse">
          <button type="button" class="carousel-indicator" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
          <button type="button" class="carousel-indicator text-white bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
          <button type="button" class="carousel-indicator" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
          <button type="button" class="carousel-indicator" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
          <!-- <button type="button" class="carousel-indicator" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button> -->
        </div>
      </div>
    </header>

    <main class="mx-4 md:mx-40 2xl:mx-40 ">
      <div id="content" class="container mx-auto">
        <!-- reach map-->
        <section class="mb-28 mt-16 ">
          <div class="relative inline-block">
            <!-- Background utama dengan bg-primary-color -->
            <div class="bg-primary-color px-8 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative z-10">
              <h1 class="md:text-4xl text-xl font-semibold text-white md:px-16 px-4">Reach Map</h1>
            </div>

            <!-- Elemen untuk garis kuning di bawah -->
            <div class="absolute inset-x-0 -bottom-3 h-full w-full bg-secondary-color md:rounded-br-2xl rounded-br-2xl md:rounded-tl-2xl transform -translate-x-4"></div>
          </div>

          <article>
            <div class="">
              <!-- Kolom 1: Title and description -->
              <div class="mt-14">
                <img src="./asset/reach.jpeg" alt="" />
              </div>
              <div class="md:flex-row 2xl:flex md:space-y-10 2xl:space-y-0 md:space-x-4 mt-10">
                <div class="bg-primary-color text-white md:px-6 px-8 md:py-6 py-10 rounded-tl-2xl rounded-br-2xl flex flex-col justify-center">
                  <p class="md:text-xl text-base font-normal">
                    Our total reach from 2014 to 2023, with the assumption that every person we reach directly influences 5 others in their circle, amounts to an impressive <strong class="text-secondary-color">1,689,609</strong> people.
                    This widespread impact has been further amplified by our presence in key markets around the world. Among the countries with the highest number of clients, the top four are:
                  </p>
                  <hr class="my-5 border-none h-[1.5px] bg-secondary-color" />
                  <p class="font-light text-xs md:text-sm">Sumber: Clients, Website, dan Social Media Data per February 28, 2024</p>
                </div>
                <div class="flex-1 space-y-4 md:mt-0 mt-5">
                  <div class="flex space-x-4">
                  <div class="bg-primary-color md:w-[290px] md:h-[160px] w-full py-6 md:py-12 md:rounded-tl-3xl md:rounded-br-3xl rounded-tl-2xl rounded-br-2xl text-center">
                    <p class="md:text-4xl font-medium text-secondary-color counter" data-target="1002295">0</p>
                    <hr class="my-1 h-[1.5px]  border-none bg-secondary-color mx-16" />
                    <p class="text-secondary-color">Indonesian</p>
                  </div>
                    <div class="bg-primary-color md:w-[290px] w-full md:h-[160px] md:py-12  py-6  md:rounded-tl-3xl md:rounded-br-3xl rounded-tl-2xl rounded-br-2xl text-center">
                      <p class="md:text-4xl font-medium text-secondary-color counter" data-target="255567">0</p>
                      <hr class="my-1 h-[1.5px]  border-none bg-secondary-color mx-16" />
                      <p class="text-secondary-color hidden md:inline">United States</p>
                      <p class="text-secondary-color md:hidden">USA</p>
                    </div>
                  </div>
                  <div class="flex space-x-4">
                    <div class="bg-primary-color md:w-[290px] w-full md:h-[160px] md:py-12  py-6  md:rounded-tl-3xl md:rounded-br-3xl rounded-tl-2xl rounded-br-2xl text-center">
                      <p class="md:text-4xl font-medium text-secondary-color counter" data-target="72866">0</p>
                      <hr class="my-1 h-[1.5px]  border-none bg-secondary-color mx-16" />
                      <p class="text-secondary-color">India</p>
                    </div>
                    <div class="bg-primary-color md:w-[290px] w-full md:h-[160px] md:py-12  py-6  md:rounded-tl-3xl md:rounded-br-3xl rounded-tl-2xl rounded-br-2xl text-center">
                      <p class="md:text-4xl font-medium text-secondary-color counter" data-target="65678">0</p>
                      <hr class="my-1 h-[1.5px]  border-none bg-secondary-color mx-16" />
                      <p class="text-secondary-color">Russia</p>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const counters = document.querySelectorAll(".counter");

                  counters.forEach((counter) => {
                    const target = parseInt(counter.getAttribute("data-target"));
                    const duration = 4000; // durasi animasi dalam milidetik
                    const step = target / (duration / 16); // 16ms per frame (approx. 60fps)
                    let current = 0;

                    const updateCounter = () => {
                      current += step;
                      if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                      } else {
                        counter.textContent = target.toLocaleString();
                      }
                    };

                    // Mulai animasi ketika elemen visible
                    const observer = new IntersectionObserver((entries) => {
                      if (entries[0].isIntersecting) {
                        updateCounter();
                        observer.disconnect();
                      }
                    });

                    observer.observe(counter);
                  });
                });
              </script>
            </div>
          </article>
        </section>

        <section class="my-28 ">
          <article>
            <div class="relative flex justify-start md:justify-end">
              <!-- Container untuk mengatur elemen agar berada di pojok kanan -->
              <div class="relative">
                <!-- Background utama dengan bg-primary-color -->
                <div class="bg-primary-color px-8 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative z-10">
                  <h1 class="md:text-4xl text-base font-semibold text-white md:px-16 px-4">What Is Stress Manajement Indonesia?</h1>
                </div>
                <!-- Elemen untuk garis kuning di bawah -->
                <div class="absolute right-8 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <div class="md:flex pt-14 md:space-x-10">
              <!-- carausel image -->
              <div class="relative md:w-1/2">
                <!-- Background -->
                <div class="absolute md:left-5 left-3 md:-bottom-5 -bottom-3 w-full h-full bg-secondary-color md:rounded-tl-3xl md:rounded-br-3xl rounded-tl-2xl rounded-br-2xl -z-10"></div>

                <div class="overflow-hidden">
                  <!-- Carousel container -->
                  <div class="relative carousel-container">
                    <!-- Slides -->
                    <div class="flex transition-transform duration-500 ease-in-out carousel-slides">
                      <div class="relative min-w-full">
                        <img src="./asset/whats-SMI.png" alt="" class="rounded-tl-3xl rounded-br-3xl md:rounded-tl-2xl md:rounded-br-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/foto-meditasi.png" alt="" class="rounded-tl-3xl rounded-br-3xl md:rounded-tl-2xl md:rounded-br-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/prease-realease-10-oktober.png" alt="" class="rounded-tl-3xl rounded-br-3xl md:rounded-tl-2xl md:rounded-br-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/prease-realease-10-oktober2.png" alt="" class="rounded-tl-3xl rounded-br-3xl md:rounded-tl-2xl md:rounded-br-2xl w-full" />
                      </div>
                      <div class="relative min-w-full">
                        <img src="./asset/prease-realease-10-oktober3.png" alt="" class="rounded-tl-3xl rounded-br-3xl md:rounded-tl-2xl md:rounded-br-2xl w-full" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Controls -->
                <div class="absolute bottom-5 left-0 right-0 flex justify-center mt-4">
                  <div class="flex space-x-4">
                    <button class="w-3 h-3 rounded-full bg-secondary-color focus:outline-none carousel-dot" data-index="0"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="1"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="2"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="3"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-400 focus:outline-none carousel-dot" data-index="4"></button>
                  </div>
                </div>
              </div>

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

              <div class="bg-primary-color md:w-1/2 p-4 md:p-12 md:mt-0 mt-10 rounded-tl-3xl rounded-br-3xl h-1/2 text-white text-base md:text-xl font-normal">
                <p>
                  Stress Management Indonesia (SMI) is an organization focused on promoting <strong class="text-secondary-color">mental and physical well-being</strong> through holistic approaches. Founded in 2014, SMI's mission is to
                  create a healthier community by offering solutions for managing mental health, including stress relief strategies. Their approach emphasizes a combination of neuroscience, physical health, and humanistic solutions to
                  improve mental resilience and overall happiness. They provide evidence-based programs that are realistic and easy to practice in daily life, helping individuals navigate stress more effectively.
                </p>
              </div>
            </div>
          </article>
        </section>

        <section class="mt-28 ">
          <article>
            <div class="relative inline-block">
              <!-- Background utama dengan bg-primary-color -->
              <div class="bg-primary-color px-8 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative z-10">
                <h1 class="md:text-4xl text-base font-semibold text-white md:px-16 px-4">Testimonial</h1>
              </div>
              <!-- Elemen untuk garis kuning di bawah -->
              <div class="absolute inset-x-0 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform -translate-x-4"></div>
            </div>

            <link href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css" rel="stylesheet" />

            <script type="module">
              import KeenSlider from "https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/+esm";

              const keenSliderActive = document.getElementById("keen-slider-active");
              const keenSliderCount = document.getElementById("keen-slider-count");

              const keenSlider = new KeenSlider(
                "#keen-slider",
                {
                  loop: true,
                  defaultAnimation: {
                    duration: 750,
                  },
                  slides: {
                    origin: "center",
                    perView: 1,
                    spacing: 16,
                  },
                  breakpoints: {
                    "(min-width: 640px)": {
                      slides: {
                        origin: "center",
                        perView: 1.5,
                        spacing: 16,
                      },
                    },
                    "(min-width: 768px)": {
                      slides: {
                        origin: "center",
                        perView: 1.75,
                        spacing: 16,
                      },
                    },
                    "(min-width: 1024px)": {
                      slides: {
                        origin: "center",
                        perView: 3,
                        spacing: 16,
                      },
                    },
                  },
                  created(slider) {
                    slider.slides[slider.track.details.rel].classList.remove("opacity-40");

                    keenSliderActive.innerText = slider.track.details.rel + 1;
                    keenSliderCount.innerText = slider.slides.length;
                  },
                  slideChanged(slider) {
                    slider.slides.forEach((slide) => slide.classList.add("opacity-40"));

                    slider.slides[slider.track.details.rel].classList.remove("opacity-40");

                    keenSliderActive.innerText = slider.track.details.rel + 1;
                  },
                },
                []
              );

              const keenSliderPrevious = document.getElementById("keen-slider-previous");
              const keenSliderNext = document.getElementById("keen-slider-next");

              keenSliderPrevious.addEventListener("click", () => keenSlider.prev());
              keenSliderNext.addEventListener("click", () => keenSlider.next());
            </script>

            <section class="bg-white">
              <div class="mx-auto max-w-screen-2xl py-12 lg:py-16">
                <h2 class="text-center text-2xl tracking-tight font-light sm:text-2xl text-gray-700">Here are some experiences of clients who have experienced our professional services.</h2>

                <div class="mt-8">
                  <div id="keen-slider" class="keen-slider">
                    <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                      <blockquote class="rounded-tl-3xl rounded-br-3xl bg-primary-color p-6 shadow-sm sm:p-8">
                        <div class="">
                          <div>
                            <div class="flex justify-start gap-0.5 text-secondary-color">
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="text-lg font-medium text-white mt-4">Pengalaman Positif dalam Program Learning Interaktif</p>
                          </div>
                        </div>

                        <p class="mt-4 text-white font-light">
                          So happy saat ada learning program yang fun dan interaktif seperti saat YKAN kerjasama untuk Mental Health at work, ketika penyesuaian WFH dan beradaptasi dengan kondisi pandemi. Mudah-mudahan bisa bekerjasama
                          kembali
                        </p>
                        <footer class="mt-4 text-sm font-medium text-white sm:mt-6">&mdash; Tricia</footer>
                      </blockquote>
                    </div>

                    <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                      <blockquote class="rounded-tl-3xl rounded-br-3xl bg-primary-color p-6 shadow-sm sm:p-8">
                        <div class="">
                          <div>
                            <div class="flex justify-start gap-0.5 text-secondary-color">
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="text-lg font-medium text-white mt-4">Memorable Experience with Delightful Revelation Workshop with SMI</p>
                          </div>
                        </div>

                        <p class="mt-4 text-white font-light">
                          "Stress Management Indonesia supported us for Delightful Revelation Workshop that we enjoyed the session very much. Full package of mental and food healthy wellbeing program, including our favourite Qigong session.
                          Thank you SMI!"
                        </p>

                        <footer class="mt-4 text-sm font-medium text-white sm:mt-6">&mdash; Agnetha O</footer>
                      </blockquote>
                    </div>

                    <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                      <blockquote class="rounded-tl-3xl rounded-br-3xl bg-primary-color p-6 shadow-sm sm:p-8">
                        <div class="">
                          <div>
                            <div class="flex justify-start gap-0.5 text-secondary-color">
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="text-lg font-medium text-white mt-4">Rediscovering Myself and Embracing Positivity</p>
                          </div>
                        </div>

                        <p class="mt-4 text-white font-light">
                          "Academic Life Coaching program help me a lot to find and maintain balance in life. I learned to be more positive, to discover my own self once again and to practice self-acceptance more. I'm much happier and worry
                          less. Thanks SMI for the support!"
                        </p>
                        <footer class="mt-4 text-sm font-medium text-white sm:mt-6">&mdash; Tannimara</footer>
                      </blockquote>
                    </div>

                    <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                      <blockquote class="rounded-tl-3xl rounded-br-3xl bg-primary-color p-6 shadow-sm sm:p-8">
                        <div class="">
                          <div>
                            <div class="flex justify-start gap-0.5 text-secondary-color">
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            </div>

                            <p class="text-lg font-medium text-white mt-4">Webinar Seru tentang Love Language</p>
                          </div>
                        </div>

                        <p class="mt-4 text-white font-light">
                          "Seruu bangett webinarnya, topik yang diangkat juga menarik karena seperti yang kita tau memang saat ini love language sedang banyak dibicarakan diberbagai platform, jadi webinar ini juga cukup menambah info soal
                          love language, thank you buat coach dan kaka kaka panitia!!"
                        </p>
                        <footer class="mt-4 text-sm font-medium text-white sm:mt-6">&mdash;  Revani A</footer>
                      </blockquote>
                    </div>
                  </div>

                  <div class="mt-6 flex items-center justify-center gap-4">
                    <button aria-label="Previous slide" id="keen-slider-previous" class="text-primary-color transition-colors hover:text-hover-color">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                      </svg>
                    </button>

                    <p class="w-16 text-center text-sm text-primary-color">
                      <span id="keen-slider-active"></span>
                      /
                      <span id="keen-slider-count"></span>
                    </p>

                    <button aria-label="Next slide" id="keen-slider-next" class="text-primary-color transition-colors hover:text-hover-color">
                      <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </section>
          </article>
        </section>

        <!-- our collaborator -->
        <section class="my-10 ">
          <article>
            <div class="relative flex md:justify-end justify-start">
              <div class="relative">
                <div class="bg-primary-color px-8 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative z-10">
                  <h1 class="md:text-4xl text-base font-semibold text-white md:px-16 px-4">Our Collaboration</h1>
                </div>
                <div class="absolute right-8 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform translate-x-4"></div>
              </div>
            </div>

            <!-- marquee effect -->
            <div class="text-center mt-14 bg-primary-color md:mx-[450px] py-2.5 rounded-tl-2xl rounded-br-2xl md:rounded-tl-3xl md:rounded-br-3xl">
              <h1 class="font-semibold md:text-2xl text-base px-2 text-white ">Our Client</h1>
            </div>
            <div class="wrapper md:-mx-28" id="wrapper1">
              <div class="itemLeft item1"><img src="./asset/logo (1).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item2"><img src="./asset/logo (2).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item3"><img src="./asset/logo (3).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item4"><img src="./asset/logo (4).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item5"><img src="./asset/logo (5).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item6"><img src="./asset/logo (6).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item7"><img src="./asset/logo (7).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item8"><img src="./asset/logo (8).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item9"><img src="./asset/logo (9).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemLeft item10"><img src="./asset/logo (10).png" alt="" class="h-16 object-contain" /></div>
            </div>

            <!-- marquee effect -->
            <div class="text-center mt-14 bg-primary-color md:mx-[450px] py-2.5 rounded-tl-2xl rounded-br-2xl  md:rounded-tl-3xl md:rounded-br-3xl">
              <h1 class="font-semibold md:text-2xl text-base px-2 text-white ">Our Partner</h1>
            </div>
            <div class="wrapper md:-mx-28" id="wrapper2">
              <div class="itemRight item1"><img src="./asset/logo (11).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item2"><img src="./asset/logo (12).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item3"><img src="./asset/logo (13).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item4"><img src="./asset/logo (14).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item5"><img src="./asset/logo (15).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item6"><img src="./asset/logo (16).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item7"><img src="./asset/logo (17).png" alt="" class="h-16 object-contain" /></div>
              <div class="itemRight item8"><img src="./asset/logo (18).png" alt="" class="h-16 object-contain" /></div>
            </div>

            <div class="text-center mt-14 bg-primary-color md:mx-[250px] py-2.5 rounded-tl-2xl rounded-br-2xl  md:rounded-tl-3xl md:rounded-br-3xl">
              <h1 class="font-semibold md:text-2xl text-sm px-2 text-white ">Media Partner & Press Release 93 Medias</h1>
            </div>
            <div class="md:flex md:space-x-10 mt-10">
              <div>
                <img src="./asset/Media Partner.png" alt="media partner" />
              </div>
              <div class="md:mt-0 mt-10"> 
                <img src="./asset/Press-Release-93-Medias.png" alt="prease realease" />
              </div>
            </div>
          </article>
        </section>

        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const wrapper1 = document.getElementById("wrapper1");
            const wrapper2 = document.getElementById("wrapper2");

            function handleHover(wrapper, items) {
              let isHovered = false;

              wrapper.addEventListener("mouseover", (e) => {
                if (e.target.closest(".itemLeft") || e.target.closest(".itemRight")) {
                  isHovered = true;
                  // Pause all animations in this wrapper
                  items.forEach((item) => {
                    item.style.animationPlayState = "paused";
                  });
                  // Scale up the hovered item
                  if (e.target.closest(".itemLeft") || e.target.closest(".itemRight")) {
                    e.target.closest(".itemLeft, .itemRight").style.transform = "scale(1.1)";
                  }
                }
              });

              wrapper.addEventListener("mouseout", (e) => {
                if (e.target.closest(".itemLeft") || e.target.closest(".itemRight")) {
                  isHovered = false;
                  // Resume all animations in this wrapper
                  items.forEach((item) => {
                    item.style.animationPlayState = "running";
                    item.style.transform = "scale(1)";
                  });
                }
              });
            }

            // Initialize hover handlers for both wrappers
            handleHover(wrapper1, [...wrapper1.querySelectorAll(".itemLeft")]);
            handleHover(wrapper2, [...wrapper2.querySelectorAll(".itemRight")]);
          });
        </script>

        <section class="mt-24   ">
          <article>
            <div class="relative inline-block">
              <!-- Background utama dengan bg-primary-color -->
              <div class="bg-primary-color px-8 md:px-32 md:py-3 py-2.5 rounded-tl-2xl rounded-br-2xl relative z-10">
                <h1 class="md:text-4xl text-base font-semibold text-white md:px-16 px-4">Join Our App</h1>
              </div>
              <!-- Elemen untuk garis kuning di bawah -->
              <div class="absolute inset-x-0 -bottom-3 h-full w-full bg-secondary-color rounded-br-2xl rounded-tl-2xl transform -translate-x-4"></div>
            </div>
             

<section class="relative w-screen left-[50%] right-[50%] -mx-[51vw] bg-[url('./asset/bg-cta.png')] bg-cover bg-center bg-fixed mt-20">
  <div class="container mx-auto">
    <div class="flex flex-col md:flex-row max-w-7xl px-5 mx-auto">
      <div class="md:w-1/2 flex flex-col justify-center md:px-0 px-5 md:py-0 py-10 text-white">
        <h1 class="text-4xl md:text-6xl font-semibold">Happy Self</h1>
        <p class="text-lg py-5">
          There is no better time than now. <br />
          Take your first step towards a happier <strong>YOU</strong> today
        </p>
        <div>
          <p class="font-semibold pb-3">Get the App</p>
          <div class="flex space-x-4">
            <a href="#"><img src="./asset/appstore.png" alt="appstore" class="h-[56px] w-[167px]" /></a>
            <a href="https://play.google.com/store/apps/details?id=com.stressmanagementindonesia.happyself&pcampaignid=web_share">
              <img src="./asset/playstore (1).png" alt="playstore" class="h-[56px] w-[167px]" />
            </a>
          </div>
        </div>
      </div>

      <!-- Right-side image for desktop -->
      <div class="md:w-1/2 justify-end items-center hidden md:flex">
        <img src="./asset/happyselfbysmi-phone.png" alt="Map" class="w-full md:w-[592px]" />
      </div>

      <!-- Image for mobile -->
      <div class="md:hidden flex justify-end items-center mt-5">
        <img src="./asset/happyselfAPP.png" alt="Map" class="w-[525px] h-auto" />
      </div>
    </div>
  </div>
</section>




            <!-- <div class="md:flex">
              <div>
                <div class="py-8 pt-10">
                  <h1 class="text-[#5BC7D4] text-4xl md:text-6xl font-semibold pb-5">Happy Self</h1>
                  <p class="text-lg text-gray-700">There is no better time than now. Take your first step towards a happier <strong>YOU</strong> today</p>
                </div>
                <div class="">
                  <div class="flex space-x-4">
                    <a href=""> <img src="./asset/appstore.png" alt="appstore" class="h-[56px] w-[167px]" /></a>
                    <a href="https://play.google.com/store/apps/details?id=com.stressmanagementindonesia.happyself&pcampaignid=web_share">
                      <img src="./asset/playstore (1).png" alt="playstore" class="h-[56px] w-[167px]" />
                    </a>
                  </div>
                </div>
              </div>

              <div class="md:w-1/2 flex items-center justify-end md:mt-0 mt-10">
                <img src="./asset/happyselfAPP.png" alt="Map" class="w-[525px] md:h-[521px]" />
              </div>
            </div> -->
          </article>
        </section>
      </div>

      <aside></aside>

      <!-- awal footer -->
      <footer class="bg-[#1e1e1e] bg-opacity-80  -mx-4  bg-[url('./asset/background-footer.png')] bg-center bg-no-repeat bg-cover bg-fixed bg-blend-multiply md:-mx-40 2xl:-mx-40 flex justify-center" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-4 md:mx-32 max-w-screen-2xl w-full pb-8 pt-16 sm:pt-24 lg:pt-14">
          <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 mr-16">
              <a href="./home" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="./asset/logo.png" class="md:w-32 w-20" alt="SMI logo" />
              </a>
              <p class="text-sm leading-6 text-white">This growth plan will help you reach your resolutions and achieve the goals you have been striving towards.</p>
              <div class="flex space-x-3">
                <!-- Social Media Icons -->
                <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
                  <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.2175 1.26929H14.4665L9.55316 6.88495L15.3334 14.5266H10.8075L7.26271 9.89198L3.20665 14.5266H0.956308L6.21164 8.52002L0.666687 1.26929H5.30743L8.51162 5.50551L12.2175 1.26929ZM11.4282 13.1805H12.6744L4.63028 2.54471H3.29299L11.4282 13.1805Z" />
                  </svg>
                </a>
                <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
                  <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M8 0C3.58176 0 0 3.58176 0 8C0 11.7517 2.58304 14.8998 6.06752 15.7645V10.4448H4.41792V8H6.06752V6.94656C6.06752 4.22368 7.29984 2.9616 9.97312 2.9616C10.48 2.9616 11.3546 3.06112 11.7123 3.16032V5.37632C11.5235 5.35648 11.1955 5.34656 10.7882 5.34656C9.47648 5.34656 8.9696 5.84352 8.9696 7.13536V8H11.5827L11.1338 10.4448H8.9696V15.9414C12.9309 15.463 16.0003 12.0902 16.0003 8C16 3.58176 12.4182 0 8 0Z" />
                  </svg>
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
                  <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M8 1.44062C10.1375 1.44062 10.3906 1.45 11.2313 1.4875C12.0125 1.52187 12.4344 1.65313 12.7156 1.7625C13.0875 1.90625 13.3563 2.08125 13.6344 2.35938C13.9156 2.64062 14.0875 2.90625 14.2313 3.27813C14.3406 3.55938 14.4719 3.98438 14.5063 4.7625C14.5438 5.60625 14.5531 5.85938 14.5531 7.99375C14.5531 10.1313 14.5438 10.3844 14.5063 11.225C14.4719 12.0063 14.3406 12.4281 14.2313 12.7094C14.0875 13.0813 13.9125 13.35 13.6344 13.6281C13.3531 13.9094 13.0875 14.0813 12.7156 14.225C12.4344 14.3344 12.0094 14.4656 11.2313 14.5C10.3875 14.5375 10.1344 14.5469 8 14.5469C5.8625 14.5469 5.60938 14.5375 4.76875 14.5C3.9875 14.4656 3.56563 14.3344 3.28438 14.225C2.9125 14.0813 2.64375 13.9063 2.36563 13.6281C2.08438 13.3469 1.9125 13.0813 1.76875 12.7094C1.65938 12.4281 1.52813 12.0031 1.49375 11.225C1.45625 10.3813 1.44688 10.1281 1.44688 7.99375C1.44688 5.85625 1.45625 5.60313 1.49375 4.7625C1.52813 3.98125 1.65938 3.55938 1.76875 3.27813C1.9125 2.90625 2.0875 2.6375 2.36563 2.35938C2.64688 2.07812 2.9125 1.90625 3.28438 1.7625C3.56563 1.65313 3.99063 1.52187 4.76875 1.4875C5.60938 1.45 5.8625 1.44062 8 1.44062ZM8 0C5.82813 0 5.55625 0.009375 4.70313 0.046875C3.85313 0.084375 3.26875 0.221875 2.7625 0.41875C2.23438 0.625 1.7875 0.896875 1.34375 1.34375C0.896875 1.7875 0.625 2.23438 0.41875 2.75938C0.221875 3.26875 0.084375 3.85 0.046875 4.7C0.009375 5.55625 0 5.82812 0 8C0 10.1719 0.009375 10.4438 0.046875 11.2969C0.084375 12.1469 0.221875 12.7313 0.41875 13.2375C0.625 13.7656 0.896875 14.2125 1.34375 14.6562C1.7875 15.1 2.23438 15.375 2.75938 15.5781C3.26875 15.775 3.85 15.9125 4.7 15.95C5.55313 15.9875 5.825 15.9969 7.99688 15.9969C10.1688 15.9969 10.4406 15.9875 11.2938 15.95C12.1438 15.9125 12.7281 15.775 13.2344 15.5781C13.7594 15.375 14.2063 15.1 14.65 14.6562C15.0938 14.2125 15.3688 13.7656 15.5719 13.2406C15.7688 12.7313 15.9063 12.15 15.9438 11.3C15.9813 10.4469 15.9906 10.175 15.9906 8.00313C15.9906 5.83125 15.9813 5.55938 15.9438 4.70625C15.9063 3.85625 15.7688 3.27188 15.5719 2.76562C15.375 2.23438 15.1031 1.7875 14.6563 1.34375C14.2125 0.9 13.7656 0.625 13.2406 0.421875C12.7313 0.225 12.15 0.0875 11.3 0.05C10.4438 0.009375 10.1719 0 8 0Z" />
                    <path
                      d="M8 3.89062C5.73125 3.89062 3.89062 5.73125 3.89062 8C3.89062 10.2688 5.73125 12.1094 8 12.1094C10.2688 12.1094 12.1094 10.2688 12.1094 8C12.1094 5.73125 10.2688 3.89062 8 3.89062ZM8 10.6656C6.52813 10.6656 5.33437 9.47188 5.33437 8C5.33437 6.52813 6.52813 5.33437 8 5.33437C9.47188 5.33437 10.6656 6.52813 10.6656 8C10.6656 9.47188 9.47188 10.6656 8 10.6656Z" />
                    <path d="M13.2312 3.72808C13.2312 4.25933 12.8 4.68746 12.2719 4.68746C11.7406 4.68746 11.3125 4.25621 11.3125 3.72808C11.3125 3.19683 11.7438 2.76871 12.2719 2.76871C12.8 2.76871 13.2312 3.19996 13.2312 3.72808Z" />
                  </svg>
                </a>
                <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
                  <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M15.8406 4.80004C15.8406 4.80004 15.6844 3.69692 15.2031 3.21254C14.5938 2.57504 13.9125 2.57192 13.6 2.53442C11.3625 2.37192 8.00313 2.37192 8.00313 2.37192H7.99687C7.99687 2.37192 4.6375 2.37192 2.4 2.53442C2.0875 2.57192 1.40625 2.57504 0.796875 3.21254C0.315625 3.69692 0.1625 4.80004 0.1625 4.80004C0.1625 4.80004 0 6.09692 0 7.39067V8.60317C0 9.89692 0.159375 11.1938 0.159375 11.1938C0.159375 11.1938 0.315625 12.2969 0.79375 12.7813C1.40313 13.4188 2.20313 13.3969 2.55938 13.4657C3.84063 13.5875 8 13.625 8 13.625C8 13.625 11.3625 13.6188 13.6 13.4594C13.9125 13.4219 14.5938 13.4188 15.2031 12.7813C15.6844 12.2969 15.8406 11.1938 15.8406 11.1938C15.8406 11.1938 16 9.90004 16 8.60317V7.39067C16 6.09692 15.8406 4.80004 15.8406 4.80004ZM6.34688 10.075V5.57817L10.6687 7.83442L6.34688 10.075Z" />
                  </svg>
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path
                      d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                  </svg>
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-pri">
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
                      <a href="./home" class="text-sm leading-6 text-white hover:text-primary-color">Home</a>
                    </li>
                    <li>
                      <a href="./about-us" class="text-sm leading-6 text-white hover:text-primary-color">About Us</a>
                    </li>
                    <li>
                      <a href="./contact-us" class="text-sm leading-6 text-white hover:text-primary-color">Contact</a>
                    </li>
                    <li>
                      <a href="./our-product" class="text-sm leading-6 text-white hover:text-primary-color">Our Product</a>
                    </li>
                    <li>
                      <a href="./article" class="text-sm leading-6 text-white hover:text-primary-color">Article</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-white">Community</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-white hover:text-primary-color">Podcast</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-white hover:text-primary-color">Event</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-white hover:text-primary-color">Article</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-white hover:text-primary-color">Invite a friend</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-white">Socials</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="https://shopee.co.id/stressmanagement.indonesia?is_from_login=true" class="text-sm leading-6 text-white hover:text-primary-color">Shopee</a>
                    </li>
                    <li>
                      <a href="https://www.instagram.com/stressmanagementindonesia/?hl=en" class="text-sm leading-6 text-white hover:text-primary-color">Instagram</a>
                    </li>
                    <li>
                      <a href="https://x.com/smi_healthylife" class="text-sm leading-6 text-white hover:text-primary-color">Twitter</a>
                    </li>
                    <li>
                      <a href="https://www.facebook.com/stressmanagementindonesia/?locale=id_ID" class="text-sm leading-6 text-white hover:text-primary-color">Facebook</a>
                    </li>
                    <li>
                      <a href="https://bw.linkedin.com/company/stressmanagementindonesia" class="text-sm leading-6 text-white hover:text-primary-color">Linkedin</a>
                    </li>
                    <li>
                      <a href="https://www.tiktok.com/@stressmanagementid" class="text-sm leading-6 text-white hover:text-primary-color">Tiktok</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-white">Visitors</h3>
                <div class="mt-6">
                  <a href="http://s11.flagcounter.com/more/gVb4"><img src="https://s11.flagcounter.com/countxl/gVb4/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_3/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
                </div>
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
    </main>
  </body>
</html>
