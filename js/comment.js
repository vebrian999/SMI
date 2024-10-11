let comments = [];

// Fungsi untuk memuat komentar dari file JSON
async function loadComments() {
  try {
    const response = await fetch("comments.json");
    comments = await response.json();
    displayComments();
  } catch (error) {
    console.error("Error loading comments:", error);
  }
}

// Fungsi untuk menampilkan komentar
function displayComments() {
  const commentList = document.querySelector(".comment-list");
  commentList.innerHTML = "";
  comments.forEach((comment) => {
    const commentElement = createCommentElement(comment);
    commentList.appendChild(commentElement);
  });
  updateCommentCount();
}

// Fungsi untuk membuat elemen komentar
function createCommentElement(comment) {
  const article = document.createElement("article");
  article.className = "p-6 text-base bg-white rounded-lg";
  article.innerHTML = `
    <footer class="flex justify-between items-center mb-2">
      <div class="flex items-center">
        <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
          <img class="mr-2 w-6 h-6 rounded-full" src="${comment.authorImage}" alt="${comment.author}" />
          ${comment.author}
        </p>
        <p class="text-sm text-gray-600"><time pubdate datetime="${comment.date}">${formatDate(comment.date)}</time></p>
      </div>
    </footer>
    <p class="text-gray-500">${comment.content}</p>
  `;
  return article;
}

// Fungsi untuk menangani pengiriman komentar baru
async function handleCommentSubmit(e) {
  e.preventDefault();
  const commentForm = e.target;
  const commentInput = commentForm.querySelector("#comment");
  const newComment = {
    id: Date.now(),
    author: "Current User",
    authorImage: "https://flowbite.com/docs/images/people/profile-picture-5.jpg",
    date: new Date().toISOString().split("T")[0],
    content: commentInput.value,
    replies: [],
  };

  comments.unshift(newComment);
  await saveComments();
  displayComments();
  commentInput.value = "";
}

// Fungsi untuk menyimpan komentar ke file JSON (simulasi)
async function saveComments() {
  // Dalam implementasi nyata, ini akan mengirim data ke server
  console.log("Saving comments:", comments);
  // Simulasi penundaan jaringan
  await new Promise((resolve) => setTimeout(resolve, 500));
}

// Fungsi untuk memformat tanggal
function formatDate(dateString) {
  const options = { year: "numeric", month: "short", day: "numeric" };
  return new Date(dateString).toLocaleDateString(undefined, options);
}

// Fungsi untuk memperbarui jumlah komentar
function updateCommentCount() {
  const commentCount = comments.length;
  document.getElementById("comment-count").textContent = commentCount;
}

// Event listener saat DOM sudah siap
document.addEventListener("DOMContentLoaded", () => {
  loadComments();
  const commentForm = document.querySelector("form");
  commentForm.addEventListener("submit", handleCommentSubmit);
});
