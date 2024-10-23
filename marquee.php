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
    <div class="logos ">
      <div class="logos-slide flex flex-col">
        <img src="./asset/logo (1).png" />
        <img src="./asset/logo (2).png" />
        <img src="./asset/logo (3).png" />
        <img src="./asset/logo (4).png" />
        <img src="./asset/logo (5).png" />
        <img src="./asset/logo (6).png" />
        <img src="./asset/logo (7).png" />
        <img src="./asset/logo (8).png" />
        <img src="./asset/logo (9).png" />
        <img src="./asset/logo (10).png" />
      </div>
    </div>

    <script>
      // Clone slides
      var copy = document.querySelector(".logos-slide").cloneNode(true);
      document.querySelector(".logos").appendChild(copy);

      // Add hover events to all images
      const images = document.querySelectorAll(".logos-slide img");
      images.forEach((img) => {
        img.addEventListener("mouseenter", () => {
          document.querySelectorAll(".logos-slide").forEach((slide) => {
            slide.style.animationPlayState = "paused";
          });
        });

        img.addEventListener("mouseleave", () => {
          document.querySelectorAll(".logos-slide").forEach((slide) => {
            slide.style.animationPlayState = "running";
          });
        });
      });
    </script>
  </body>
</html>
