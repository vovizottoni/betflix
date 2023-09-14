const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");


/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './resources/views/**/*.blade.php'
    ],
    

    theme: {
        extend: {
            fontFamily: {
                'mont': ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'xs': '475px',
            },
            colors: {
                base: {
                  400: '#929292',
                  500: '#797979',
                  600: '#606060',
                  700: '#474747',
                  800: '#2E2E2E',
                  900: '#141414',
                },
                lightgreen: '#2CE080',

              },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar')({ nocompatible: true }),
        require("daisyui")
    ],

};

