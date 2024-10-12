<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login_admin.php');
    exit();
}

require_once '../functions/db.php';

// Fetch comments from the database
$query = "SELECT comments.id, comments.article_id, comments.name, comments.comment, comments.created_at, articles.title 
          FROM comments 
          LEFT JOIN articles ON comments.article_id = articles.id 
          ORDER BY comments.created_at DESC";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Error fetching comments: " . $conn->error);
}

// Check if the edit form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment_id'])) {
    $commentId = $_POST['edit_comment_id'];
    $commentText = $_POST['comment'];

    // Update comment
    $updateQuery = "UPDATE comments SET comment = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("si", $commentText, $commentId);
    if ($updateStmt->execute()) {
        $_SESSION['message'] = "Comment updated successfully!";
        header("Location: comments_admin.php");
        exit();
    } else {
        echo "Error updating comment.";
    }
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
    <script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- awal main -->
    <main>
        <script>
    function openEditModal(id, comment) {
        document.getElementById('edit_comment_id').value = id;
        document.getElementById('comment').value = comment;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.modal-open').classList.remove('scale-75', 'opacity-0');
        }, 0);
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.querySelector('.modal-open').classList.add('scale-75', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function searchComments() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('commentsTable');
        const rows = table.getElementsByTagName('tr');
        let resultsFound = false; // Flag to track if results are found

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell && cell.innerText.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }

            // Show or hide the row based on the search result
            rows[i].style.display = found ? '' : 'none';
            if (found) {
                resultsFound = true; // Set flag to true if a match is found
            }
        }

        // Display message if no results are found
        const noResultsMessage = document.getElementById('noResultsMessage');
        noResultsMessage.style.display = resultsFound ? 'none' : 'block';
    }
</script>


        <div id="content" class="content">
            <div class="p-4 sm:ml-64 md:mt-10">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg md:text-3xl font-bold text-primary-color">Manage Comments</h2>
            </div>

                    <div class="grid grid-cols-1 gap-4 mb-4">

                        <div class="flex items-center justify-center gap-2 h-auto rounded">
    <div class="container mx-auto">

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>


                                     <!-- Search Input -->
        <div class="">
            <input type="text" id="searchInput" onkeyup="searchComments()" placeholder="Search comments or title article..." class="border rounded p-2 w-full  mb-4" />
        </div>
   
            <div class="overflow-auto">
                
            
        <table id="commentsTable" class="min-w-full border-collapse border border-gray-200 ">
            <thead>
                <tr class="bg-primary-color text-white">
                    <th class="border border-gray-200 px-4 py-2">ID</th>
                    <th class="border border-gray-200 px-4 py-2">Article Title</th>
                    <th class="border border-gray-200 px-4 py-2">Name</th>
                    <th class="border border-gray-200 px-4 py-2">Comment</th>
                    <th class="border border-gray-200 px-4 py-2">Created At</th>
                    <th class="border border-gray-200 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($comment = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border border-gray-200 px-4 py-2"><?php echo htmlspecialchars($comment['id']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo htmlspecialchars($comment['title']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo htmlspecialchars($comment['name']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo htmlspecialchars($comment['comment']); ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo date('d F Y H:i', strtotime($comment['created_at'])); ?></td>
                        <td class="border border-gray-200 px-4 py-2 ">
                            <button onclick="openEditModal(<?php echo $comment['id']; ?>, '<?php echo addslashes($comment['comment']); ?>')" class="text-blue-500 hover:underline">Edit</button>
                            <a href="delete_comment.php?id=<?php echo $comment['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        </div>

        <!-- Pesan Tidak Ada Hasil -->
        <div id="noResultsMessage" class="mt-4 text-red-500" style="display: none;">
            Tidak ada hasil yang ditemukan.
        </div>
        <!-- Edit Comment Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 transition-opacity duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full md:max-w-md transform transition-transform duration-300 ease-in-out scale-75 opacity-0 modal-open">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Edit Comment</h3>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-red-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form method="post">
            <input type="hidden" name="edit_comment_id" id="edit_comment_id" value="">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comment:</label>
            <textarea id="comment" name="comment" rows="4" class="border border-gray-300 rounded-md p-2 w-full" required></textarea>
            <button type="submit" class="mt-4 bg-[#682E74]  text-white px-4 py-2 rounded hover:bg-[#4F1B5A] transition-colors duration-200">Update Comment</button>
        </form>
        <!-- <div class="flex justify-end mt-2">
            <button onclick="closeEditModal()" class="text-red-500 hover:underline transition-colors duration-200">Cancel</button>
        </div> -->
    </div>
</div>

    </div>
                        </div>
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
              <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path
                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
              </a>
            </li>

            <!-- ini adalah halaman article -->
            <li>
              <a href="article_admin.php" class=" flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                  <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Article</span>
              </a>
            </li>

          <li>
              <a href="message_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <svg  class="flex-shrink-0 w-5 h-5"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Message</span>
              </a>
            </li>

                    
          <li>
              <a href="comments_admin.php" class="flex items-center p-2 text-black rounded-lg bg-white">
              <svg class="flex-shrink-0 w-5 h-5"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z" clip-rule="evenodd" />
              </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Comments Users</span>
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