/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      gridTemplateColumns: {
        'header' : '1fr auto',
      },
      fontFamily:{
        'outfit': ['Outfit', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

