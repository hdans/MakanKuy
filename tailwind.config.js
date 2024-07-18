/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "customer/*.{html,php,js}",
    "admin/*.{html,php,js}",
    "*.{php,html,js}"
  ],
  theme: {
    container:{
      padding: {
        DEFAULT: '15px',
      },
    },
    screens:{
      xxs:'400px',
      xsm:'550px',
      sm:'640px',
      md:'768px',
      lg:'960px',
      xl:'1200px',
    },
    fontFamily:{
      primary:'IBM Plex Sans Hebrew',
      secondary:'IBM Plex Sans Hebrew',
    },
    backgroundImage:{
      grid: 'url(assets/grid.png)',
    },
    extend: {
      colors:{
        primary:{
          DEFAULT: '#0e100f',
          hover: '#3a3636'
        },
        secondary: '#4d5053',
        accent: {
          DEFAULT: '#51e7a1',
          secondary: '#8be1b9',
          hover: '#52b989',
        },
        background: '#f9fbfa',
      },
    },
  },
  plugins: [],
}

