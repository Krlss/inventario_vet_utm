const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  mode: 'jit',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    screens: {
      'xs': '475px',
      ...defaultTheme.screens,
    },
  },
  plugins: [
  ],
}
