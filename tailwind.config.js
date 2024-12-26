/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./css/**/*.{html,js}", "./pages/**/*.{html,php,js}", "./*.{html,php}", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        "primary-color": "#682E74",
        "secondary-color": "#F4ED4D",
        "third-color": "#FFEAFD",
        "hover-color": "#4F1B5A",
      },
      screens: {
        xxl: "1750px", // gunakan nama unik untuk menghindari konflik
      },
    },
  },
  plugins: [
    require("flowbite/plugin")({
      wysiwyg: true, // Enable WYSIWYG editor support
    }),
    require("flowbite-typography"),
  ],
};
