const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                inter: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '-1': '-1',
              },
            flexGrow: {
                '5' : '5'
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
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar')({ nocompatible: true }),
        require("daisyui")
    ],

};
