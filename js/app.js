window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

// Smooth scrolling for Learn More buttons
document.addEventListener("DOMContentLoaded", function () {
  const learnMoreButtons = document.querySelectorAll(".learn-more");

  learnMoreButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const targetId = button.getAttribute("data-target");
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        // Scroll to the target element
        targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });
});
