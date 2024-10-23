/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./css/**/*.{html,js}", "./pages/**/*.{html,php,js}", "./*.{html,php}", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      colors: {
        "primary-color": "#682E74",
        "secondary-color": "#F4ED4D",
        "third-color": "#FFEAFD",
        "third-color": "#FFEAFD",
        "hover-color": "#4F1B5A",
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
