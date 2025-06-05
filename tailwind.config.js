/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      extend: {
        colors: {
          teal: { 600: '#0d9488' },
          slate: { 700: '#334155' },
        },
      },
  
    },
  },
  plugins: [],
}
