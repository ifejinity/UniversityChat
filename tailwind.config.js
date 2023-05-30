/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      gridTemplateColumns: {
        'header' : '1fr auto',
        'forgotpass' : 'repeat(5, auto)',
      },
      fontFamily:{
        'outfit': ['Outfit', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

