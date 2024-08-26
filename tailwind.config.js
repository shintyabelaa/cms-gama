/** @type {import('tailwindcss').Config} */
export default {
  prefix: "tw-",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
  theme: {
    extend: {
      backgroundImage: {
        'welcome': "url('/public/assets/frontend/images/WelcomeScreen.png')",
      },
      colors: {
        primary: "#9A583F",
        secondary: "#DFA36D",
        
    },
    },
  },
  plugins: [
    require('tailwind-scrollbar-hide')
  ],
}

