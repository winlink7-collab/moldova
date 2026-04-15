/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/views/**/*.php",
    "./*.php",
    "./public/js/**/*.js"
  ],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary": "#f2d00d",
        "background-light": "#f8f8f5",
        "background-dark": "#12110a",
        "accent-dark": "#221f10",
        "gold-muted": "#bab59c",
        "surface": "#1c1a0e",
        "card": "#1a1810",
        "border-gold": "#393728"
      },
      fontFamily: {
        "display": ["Heebo", "sans-serif"]
      },
      borderRadius: {
        "DEFAULT": "0.25rem",
        "lg": "0.5rem",
        "xl": "0.75rem",
        "full": "9999px"
      }
    }
  },
  plugins: []
}
