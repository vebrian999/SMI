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
                      >Article
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
      <footer class="md:-mx-28 -mx-4 bg-primary-color bg-opacity-60 bg-[url('./asset/background-footer.png')] bg-center bg-no-repeat bg-cover bg-fixed bg-blend-multiply" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-4 md:mx-16 max-w-full pb-8 pt-16 sm:pt-24 lg:pt-14">
          <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 mr-16">
              <a href="./index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="./asset/logo.png" class="md:w-32 w-20" alt="SMI logo" />
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
    </main>
  </body>
</html>
