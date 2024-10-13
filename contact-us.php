<?php
session_start();
require_once './functions/db.php';

// Initialize variables to store form data
$firstName = $lastName = $phone = $email = $subject = $message = "";

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $firstName = sanitize_input($_POST['firstName'] ?? '');
    $lastName = sanitize_input($_POST['lastName'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = sanitize_input($_POST['subject'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');

    // Validate data
    if (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['toast'] = ['type' => 'error', 'message' => 'Please fill all required fields.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['toast'] = ['type' => 'error', 'message' => 'Invalid email format.'];
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO contact_submissions (first_name, last_name, phone, email, subject, message) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $firstName, $lastName, $phone, $email, $subject, $message);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Your message has been sent successfully!'];
            // Clear form data after successful submission
            $firstName = $lastName = $phone = $email = $subject = $message = "";
        } else {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Oops! Something went wrong. Please try again later.'];
        }
        
        $stmt->close();
    }
    
    // Redirect to the same page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
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
                  <!-- Container for search results -->
                  <div id="search-results-mobile" class="mt-2 bg-white rounded-lg shadow-md overflow-hidden hidden"></div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const searchInput = document.getElementById('search-sidebar');
                  const searchResults = document.getElementById('search-results-mobile');

                  searchInput.addEventListener('input', function() {
                    const query = this.value.trim();
                    
                    if (query.length > 0) {
                      // Make an AJAX request to the server
                      fetch(`search.php?q=${encodeURIComponent(query)}`)
                        .then(response => response.text())
                        .then(data => {
                          searchResults.innerHTML = data;
                          searchResults.classList.remove('hidden');
                        })
                        .catch(error => {
                          console.error('Error:', error);
                        });
                    } else {
                      searchResults.innerHTML = '';
                      searchResults.classList.add('hidden');
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
              <h1 class="md:text-7xl text-3xl text-center">Contact Us</h1>
              <hr class="my-3 md:w-1/2 mx-auto" />
              <p class="md:text-lg text-sm text-center">If you have questions about our services, need help, or want to give feedback,</p>
              <p class="md:text-lg text-sm text-center">we are here to listen. Our team is dedicated to providing the best support</p>
              <p class="md:text-lg text-sm text-center">possible. Feel free to reach out, and we will respond as quickly as possible.</p>
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
            <div class="md:w-1/2">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl md:px-0 text-xl font-semibold text-white px-4">Contact Information</h1>
              </div>
            </div>
            <div class="md:my-10 my-4 md:w-1/2">
              <p class="font-normal">Contact us about anything related to our company or services. We'll do our best to get back to you as soon as possible.</p>
            </div>
            <div>
              <!-- source https://tailblocks.cc/ -->
              <section class="text-gray-600 body-font relative">
                <div class="container flex flex-col md:flex-row max-w-full">
                  <div class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 md:flex items-end justify-start relative">
                    <iframe
                      width="100%"
                      height="100%"
                      class="absolute inset-0"
                      frameborder="0"
                      title="map"
                      marginheight="0"
                      marginwidth="0"
                      scrolling="no"
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.387214867883!2d106.81817857453106!3d-6.212554760851089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f41cb80e8eb9%3A0xa66cfbfd9591b95b!2sPt%20Stress%20Management%20Indonesia!5e0!3m2!1sen!2sid!4v1728459413643!5m2!1sen!2sid"
                      style="filter: grayscale(1) contrast(1.2) opacity(0.4)"></iframe>
                    <div class="bg-white relative md:flex flex-wrap py-6 rounded shadow-md">
                      <div class="lg:w-1/2 px-6">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                        <p class="mt-1">Millennium Centennial Center, Level 38, Jl. Jend. Sudirman No.Kav. 25, South Jakarta 12920</p>
                      </div>
                      <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                        <a class="text-primary-color md:px-0 leading-relaxed break-all w-full block sm:w-auto"> stressmanagementindonesia@email.com </a>
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                        <p class="leading-relaxed">+62 811 1218 113</p>
                      </div>
                    </div>
                  </div>

                  <!-- batas form -->
                  <div class="bg-white max-w-full flex flex-col md:mt-0">
                    <h2 class="text-gray-900 md:text-lg text-2xl md:my-0 my-6 md:mb-1 font-medium title-font">Feedback</h2>
                    <p class="leading-relaxed text-base text-black mb-5">Please fill out the form below if you have any questions or inquiries.</p>

                    <?php if (!empty($error)) : ?>
                        <p class="text-red-500 mb-4"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <div class="relative mb-4">
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="grid sm:grid-cols-2 gap-8">
                          <div class="relative flex items-center">
                      <input type="text" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>" class="rounded-lg px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" required />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                              <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                              <path
                                d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                data-original="#000000"></path>
                            </svg>
                          </div>

                          <div class="relative flex items-center">
                              <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>" class="rounded-lg px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" required />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                              <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                              <path
                                d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                data-original="#000000"></path>
                            </svg>
                          </div>

                          <div class="relative flex items-center">
                        <input type="tel" name="phone" placeholder="Phone No." value="<?php echo $phone; ?>" class="px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" />
                            <svg fill="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 64 64">
                              <path
                                d="m52.148 42.678-6.479-4.527a5 5 0 0 0-6.963 1.238l-1.504 2.156c-2.52-1.69-5.333-4.05-8.014-6.732-2.68-2.68-5.04-5.493-6.73-8.013l2.154-1.504a4.96 4.96 0 0 0 2.064-3.225 4.98 4.98 0 0 0-.826-3.739l-4.525-6.478C20.378 10.5 18.85 9.69 17.24 9.69a4.69 4.69 0 0 0-1.628.291 8.97 8.97 0 0 0-1.685.828l-.895.63a6.782 6.782 0 0 0-.63.563c-1.092 1.09-1.866 2.472-2.303 4.104-1.865 6.99 2.754 17.561 11.495 26.301 7.34 7.34 16.157 11.9 23.011 11.9 1.175 0 2.281-.136 3.29-.406 1.633-.436 3.014-1.21 4.105-2.302.199-.199.388-.407.591-.67l.63-.899a9.007 9.007 0 0 0 .798-1.64c.763-2.06-.007-4.41-1.871-5.713z"
                                data-original="#000000"></path>
                            </svg>
                          </div>

                          <div class="relative flex items-center">
                           <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" class="rounded-lg px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" required />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                              <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                  <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                </clipPath>
                              </defs>
                              <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                <path
                                  fill="none"
                                  stroke-miterlimit="10"
                                  stroke-width="40"
                                  d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                  data-original="#000000"></path>
                                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                              </g>
                            </svg>
                          </div>

                          <div class="relative flex items-center sm:col-span-2">
                          <input name="subject" placeholder="Subject" value="<?php echo $subject; ?>" class="rounded-lg px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" required />
                                    <!-- ... (SVG icon) ... -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                              <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                  <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                </clipPath>
                              </defs>
                              <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                <path
                                  fill="none"
                                  stroke-miterlimit="10"
                                  stroke-width="40"
                                  d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                  data-original="#000000"></path>
                                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                              </g>
                            </svg>
                          </div>

                          <div class="relative flex items-center sm:col-span-2">
                          <textarea name="message" placeholder="Write Message" class="px-2 py-3 bg-white w-full text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 outline-none" required><?php echo $message; ?></textarea>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                              <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                  <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                </clipPath>
                              </defs>
                              <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                <path
                                  fill="none"
                                  stroke-miterlimit="10"
                                  stroke-width="40"
                                  d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                  data-original="#000000"></path>
                                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                              </g>
                            </svg>
                          </div>
                        </div>

                        <button
                                type="submit"
                                class="mt-5 flex items-center justify-center text-sm lg:ml-auto max-lg:w-full rounded-lg px-4 py-3 tracking-wide text-white bg-[#682E74] transition-transform duration-300 ease-in-out hover:bg-[#8b3c95] hover:scale-105">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="#fff" class="mr-2" viewBox="0 0 548.244 548.244">
                            <path
                              fill-rule="evenodd"
                              d="M392.19 156.054 211.268 281.667 22.032 218.58C8.823 214.168-.076 201.775 0 187.852c.077-13.923 9.078-26.24 22.338-30.498L506.15 1.549c11.5-3.697 24.123-.663 32.666 7.88 8.542 8.543 11.577 21.165 7.879 32.666L390.89 525.906c-4.258 13.26-16.575 22.261-30.498 22.338-13.923.076-26.316-8.823-30.728-22.032l-63.393-190.153z"
                              clip-rule="evenodd"
                              data-original="#000000" />
                          </svg>
                          Send Message
                        </button>
                      </form>


 <script>
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 p-4 rounded-md text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    <?php
    if (isset($_SESSION['toast'])) {
        echo "showToast('" . addslashes($_SESSION['toast']['message']) . "', '" . $_SESSION['toast']['type'] . "');";
        unset($_SESSION['toast']);
    }
    ?>
    </script>
                    </div>

                    <p class="text-xs font-light text-gray-500 mt-3 md:my-0 my-4">We value your privacy and will only use the information provided to help you.</p>
                  </div>
                  <!-- batas form -->
                </div>
              </section>
            </div>
          </article>
        </section>

        <section class="md:mt-20 md:-mx-14">
          <article>
            <div class="flex md:justify-end">
              <div class="bg-primary-color md:py-5 inline-block md:px-20 py-2.5 md:-mx-20">
                <h1 class="md:text-4xl text-xl px-4 md:px-0 font-semibold text-white">Frequently Asked Question</h1>
              </div>
            </div>

            <div class="relative isolate overflow-hidden bg-custom">
              <div class="md:py-24 max-w-full mx-auto flex flex-col md:flex-row md:space-x-20">
                <div class="flex flex-col text-left basis-1/2 w-full">
                  <ul class="md:basis-1/2">
                    <li class="group">
                      <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">What is Stress Management Indonesia?</span>
                        <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                          <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                          </svg>
                        </div>
                      </button>
                      <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                        <div class="pb-5 leading-relaxed">
                          <div class="space-y-2 leading-relaxed font-light text-base">
                            Stress Management Indonesia provides programs and resources designed to help individuals manage and reduce stress effectively. These programs include workshops, training, and consultations focusing on mental
                            health, workplace well-being, and personal stress management techniques.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="group">
                      <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">Who can benefit from stress management programs?</span>
                        <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                          <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                          </svg>
                        </div>
                      </button>
                      <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                        <div class="pb-5 leading-relaxed">
                          <div class="space font-light text-base-y-2 leading-relaxed">
                            Anyone experiencing stress can benefit from these programs. This includes individuals in high-pressure jobs, students, or those dealing with personal challenges. Companies can also use these services to support
                            employees and improve workplace productivity.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="group">
                      <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">What types of stress management techniques are taught? </span>
                        <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                          <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                          </svg>
                        </div>
                      </button>
                      <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                        <div class="pb-5 leading-relaxed">
                          <div class="space font-light text-base-y-2 leading-relaxed">
                            Techniques typically include mindfulness exercises, relaxation strategies (like deep breathing and progressive muscle relaxation), cognitive behavioral approaches, time management skills, and ways to maintain
                            work-life balance.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="group">
                      <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">What is the SMI Online Consultation Program?</span>
                        <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                          <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                          </svg>
                        </div>
                      </button>
                      <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                        <div class="pb-5 leading-relaxed">
                          <div class="space font-light text-base-y-2 leading-relaxed">
                            The SMI Online Consultation Program offers personalized, one-on-one sessions with professional counselors to help individuals manage stress, anxiety, and related mental health issues. These consultations are
                            conducted entirely online, allowing you to receive support from the comfort of your home.
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="group">
                      <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                        <span class="flex-1 text-base-content">Does SMI sell any products to help manage stress? </span>
                        <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                          <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                            <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                          </svg>
                        </div>
                      </button>
                      <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                        <div class="pb-5 leading-relaxed">
                          <div class="space font-light text-base-y-2 leading-relaxed">
                            Yes, Stress Management Indonesia sells a book called Self Love Journaling. This book is designed to help you overcome negative thoughts and increase your self-confidence through the practice of writing a daily
                            journal. In 10 minutes a day, you can reflect on yourself and change the way you view anxiety, build self-care habits, and live a happier and more positive life for 3 months.
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <ul class="md:basis-1/2">
                  <li class="group">
                    <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                      <span class="flex-1 text-base-content">Are there any workshops or events for stress management?</span>
                      <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                        <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                          <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                          <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                        </svg>
                      </div>
                    </button>
                    <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                      <div class="pb-5 leading-relaxed">
                        <div class="space font-light text-base-y-2 leading-relaxed">Yes, we regularly hold workshops and events that focus on topics such as mindfulness, work-life balance, and emotional resilience.</div>
                      </div>
                    </div>
                  </li>
                  <li class="group">
                    <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                      <span class="flex-1 text-base-content">How can I contact Stress Management Indonesia for more information?</span>
                      <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                        <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                          <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                          <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                        </svg>
                      </div>
                    </button>
                    <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                      <div class="pb-5 leading-relaxed">
                        <div class="space font-light text-base-y-2 leading-relaxed">You can contact us through the "Contact" page on our website, where you can fill out a form or find our customer support email and phone number.</div>
                      </div>
                    </div>
                  </li>
                  <li class="group">
                    <button class="relative flex gap-2 items-center w-full py-5 text-base font-medium text-left border-t md:text-lg border-base-content/10" aria-expanded="false">
                      <span class="flex-1 text-base-content">Can I follow Stress Management Indonesia on social media?</span>
                      <div class="bg-primary-color px-2.5 py-2.5 rounded-md">
                        <svg class="flex-shrink-0 w-4 h-4 text-white ml-auto fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                          <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out false"></rect>
                          <rect y="7" width="16" height="2" rx="1" class="block group-hover:opacity-0 origin-center rotate-90 transition duration-200 ease-out false"></rect>
                        </svg>
                      </div>
                    </button>
                    <div class="transition-all duration-300 ease-in-out group-hover:max-h-60 max-h-0 overflow-hidden" style="transition: max-height 0.3s ease-in-out">
                      <div class="pb-5 leading-relaxed">
                        <div class="space font-light text-base-y-2 leading-relaxed">Yes, you can follow us on platforms like Instagram, Facebook, and LinkedIn to stay updated on our latest news, events, and mental health tips.</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
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
