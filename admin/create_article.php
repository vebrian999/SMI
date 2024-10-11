<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login_admin.php');
    exit();
}

require_once '../functions/db.php';

$message = '';

// Check if the article has been created
if (isset($_SESSION['article_created']) && $_SESSION['article_created']) {
    unset($_SESSION['article_created']); // Clear the session variable
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil input dari form
    $title = $_POST['title'];
    $content = $_POST['content'];  // Ubah 'introduction' menjadi 'content'
    $category = $_POST['category'];
    $author = $_POST['author']; // Ambil author dari input form, bukan session

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array(strtolower($filetype), $allowed)) {
            $newname = uniqid() . '.' . $filetype;
            if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $newname)) {
                $image = $newname;
            } else {
                $message = "Failed to upload image.";
            }
        } else {
            $message = "Invalid file type. Allowed types: " . implode(', ', $allowed);
        }
    }

    if (empty($message)) {
        // Query untuk memasukkan artikel
        $query = "INSERT INTO articles (title, content, category, author, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $title, $content, $category, $author, $image);

        if ($stmt->execute()) {
            // Set session variable to indicate article was created
            $_SESSION['article_created'] = true;
            // Redirect ke halaman admin
            header("Location: article_admin.php");
            exit();
        } else {
            $message = "Error creating article: " . $conn->error;
        }
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

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="../css/style.css" />
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />

    <script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/classic/ckeditor.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
   <script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>

   <style>
    .ck-editor__editable_inline {
    padding: 0 30px !important;

}

   </style>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>


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
      <div >
        <div class="p-4 sm:ml-64 md:mt-10">
          <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4">
              <div class="flex items-center justify-center mb-4 rounded bg-gray-50">
                <div class="container mx-auto px-4 py-8">
                  <h1 class="text-3xl text-primary-color font-bold mb-6">Create New Article</h1>

                  <?php if (!empty($message)): ?>
                  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $message; ?></span>
                  </div>
                  <?php endif; ?>

  <form id="articleForm" action="create_article.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="image"> Image </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" type="file" name="image" accept="image/*" required />
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Title </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" required />
    </div>

    <!-- Input Author -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="author"> Author </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="author" type="text" name="author" required />
    </div>

        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category"> Category </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" type="text" name="category" required />
    </div>


    <!-- Ubah label Introduction menjadi Content -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="content"> Content </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" name="content" rows="10" ></textarea>
    </div>




    <div class="flex items-center justify-between">
        <!-- Tombol Create Article -->
        <button class="bg-[#682E74] hover:bg-[#4F1B5A] text-white font-bold py-2 px-2 md:px-4 rounded focus:outline-none focus:shadow-outline" id="submitButton" type="submit">Create Article</button>

        <!-- Tombol Cancel -->
        <a href="article_admin.php" class="bg-gray-500 hover:bg-red-800 text-white font-bold py-2 px-2 md:px-4 rounded focus:outline-none focus:shadow-outline">
            Cancel
        </a>
    </div>
</form>

  <script>
  const {
  ClassicEditor,
  Essentials,
  Bold,
  Italic,
  Font,
  Paragraph,
  Heading,
  Link,
  List,
  ListProperties
  } = CKEDITOR;
  ClassicEditor
  .create(document.querySelector('#content'), {
  plugins: [
  Essentials,
  Bold,
  Italic,
  Font,
  Paragraph,
  Heading,
  Link,
  List,
  ListProperties
  ],
  toolbar: [
  'undo', 'redo', '|',
  'heading', '|',
  'bold', 'italic', '|',
  'link',
  'NumberedList', 'BulletedList', '|',
  'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
  ],
   heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
  fontSize: {
  options: [9, 11, 13, 'default', 16, 24, 36]
  },
  fontFamily: {
  options: [
  'default',
  'Arial, Helvetica, sans-serif',
  'Courier New, Courier, monospace',
  'Georgia, serif',
  'Lucida Sans Unicode, Lucida Grande, sans-serif',
  'Tahoma, Geneva, sans-serif',
  'Times New Roman, Times, serif',
  'Trebuchet MS, Helvetica, sans-serif',
  'Verdana, Geneva, sans-serif'
  ]
  }
  })
  .then(editor => {
  console.log('Editor was initialized successfully', editor);
  })
  .catch(error => {
  console.error('There was an error initializing the editor:', error);
  });
        // Add event listener to the submit button
        document.getElementById('submitButton').addEventListener('click', function(e) {
            const introductionContent = editor.getData();
            
            // Check if the introduction is empty
            if (!introductionContent.trim()) {
                alert('Please fill out the Introduction field.');
                return;
            }

            // Update the hidden textarea with CKEditor content
            const introductionTextarea = document.querySelector('#content');
            introductionTextarea.value = introductionContent;

            // Submit the form
            document.getElementById('articleForm').submit();
        });
    </script>
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
</script>


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
              <a href="./dashboard_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black ">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path
                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
              </a>
            </li>

            <!-- ini adalah halaman article -->
            <li>
              <a href="article_admin.php" class="flex items-center p-2 text-black rounded-lg bg-white  ">
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
                    <a href="logout.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-red-600">
                        <svg class="w-6 h-6 text-white hover:text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
