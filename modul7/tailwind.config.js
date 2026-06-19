/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        slytherin: {
          50:  '#f0fdf4',
          100: '#dcfce7',
          200: '#86efac',
          300: '#4ade80',
          400: '#22c55e',
          500: '#16a34a',
          600: '#15803d',
          700: '#1a4a2e',
          800: '#0f2d1a',
          900: '#0a1a0f',
        },
        gold: '#d4af37',
        parchment: '#f5f0e8',
        danger: {
          DEFAULT: '#7f1d1d',
          text: '#fca5a5',
        },
        warning: {
          DEFAULT: '#713f12',
          text: '#fcd34d',
        },
      },
      fontFamily: {
        display: ['"Cinzel Decorative"', 'serif'],
        heading: ['"IM Fell English"', 'serif'],
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}