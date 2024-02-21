/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      boxShadow: {
        'closeDialog': [
          '0 0 50px rgba(255,255,255,1)'
        ]
      },
      fontFamily: {
        TNRR: "Times_New_Roman_Regular",
        TNRB: "Times_New_Roman_Bold"
      },
    },
  },
  plugins: [],
}