<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login_admin.php');
    exit();
}

require_once '../functions/db.php';

// Fetch articles from the database
// Ganti 'introduction' dengan 'content' atau kolom yang benar di database
$query = "SELECT id, title, content, image, category, author, created_at FROM articles ORDER BY created_at DESC";
$result = $conn->query($query);

// Cek apakah query berhasil
if (!$result) {
    die("Error fetching articles: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stress Management Indoensia</title>
    <link href="../css/output.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <header>
      <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
              <button
                data-drawer-target="logo-sidebar"
                data-drawer-toggle="logo-sidebar"
                aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
              </button>
              <a href="#" class="flex ms-2 md:me-24">
                <img src="../asset/logo.png" class="h-16 me-3" alt="FlowBite Logo" />
              </a>
            </div>
            <div class="flex items-center">
              <div class="flex items-center ms-3">
                <div>
                  <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-12 h-12 rounded-full" src="https://i.pinimg.com/564x/a6/67/73/a667732975f0f1da1a0fd4625e30d776.jpg" alt="user photo" />
                  </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                  <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900" role="none">Neil Sims</p>
                    <p class="text-sm font-medium text-gray-900 truncate">neil.sims@flowbite.com</p>
                  </div>
                  <ul class="py-1" role="none">
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profil</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- akhir header -->

    <!-- awal main -->
    <main>
<div id="content" class="content">
    <div class="mt-20 p-4 sm:ml-64 md:mt-10">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">

            <?php if (isset($_SESSION['message'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
                </div>
                <?php unset($_SESSION['message']); // Clear the message after displaying ?>
            <?php endif; ?>

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg md:text-3xl font-bold text-primary-color">Article Management</h2>
                <a href="create_article.php" class="inline-flex items-center px-3 py-2 text-lg md:text-xl font-medium md:text-center text-end text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                    Create New Article
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow-xl">
                        <a href="edit_article.php?id=<?php echo $row['id']; ?>">
                            <img class="rounded-t-lg w-[380px] h-[290px]" src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                        </a>
                        <div class="p-5">
                            <div class="flex justify-between items-center">
                                <span class="bg-primary-color text-white px-2 py-1 rounded text-sm"><?php echo htmlspecialchars($row['category']); ?></span>
                                <p class="text-primary-color font-medium my-3">Written by <?php echo htmlspecialchars($row['author']); ?></p>
                            </div>
                            <p class="text-gray-400 font-normal my-3"><?php echo date('d F Y', strtotime($row['created_at'])); ?></p>
                            <a href="edit_article.php?id=<?php echo $row['id']; ?>">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo htmlspecialchars($row['title']); ?></h5>
                            </a>
                            <!-- Ganti 'introduction' dengan 'content' atau kolom yang sesuai -->
                            <p class="mb-5 font-normal text-gray-400"><?php 
        // Menghapus tag HTML, melindungi dari XSS, dan memotong teks menjadi 100 karakter
        echo htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) . (strlen(strip_tags($row['content'])) > 100 ? '...' : ''); 
    ?>...</p>
                            <div class="flex justify-between items-center">
                                <a
                                    href="edit_article.php?id=<?php echo $row['id']; ?>"
                                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-primary-color bg-transparent rounded-lg hover:bg-primary-color hover:text-white transition-colors duration-300 ease-in-out hover:scale-105">
                                    Edit
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                                <a
                                    href="delete_article.php?id=<?php echo $row['id']; ?>"
                                    class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-red-600 bg-transparent rounded-lg hover:bg-red-600 hover:text-white transition-colors duration-300 ease-in-out hover:scale-105"
                                    onclick="return confirm('Are you sure you want to delete this article?');">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>


      <!-- awal sidebar (aside) -->
      <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 mt-10 h-screen pt-20 transition-transform -translate-x-full bg-primary-color border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-primary-color">
          <ul class="space-y-2 font-medium">
            <!-- dashbord -->
            <li>
              <a href="dashboard_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path
                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
              </a>
            </li>

            <!-- ini adalah halaman article -->
            <li>
              <a href="#" class="flex items-center p-2 text-black rounded-lg bg-white">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                  <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Article</span>
              </a>
            </li>
          </ul>

            <ul class="space-y-2 mt-4 border-t border-gray-200 pt-4">
                <!-- Log out -->
                <li class="">
                    <a href="logout.php" class="flex items-center p-2 text-white hover:text-red-600 rounded-lg hover:bg-white ">
                        <svg class="w-6 h-6  " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
      </aside>
      <!-- akhir sidebar (aside) -->
    </main>
    <!-- akhir  main -->
  </body>
</html>
