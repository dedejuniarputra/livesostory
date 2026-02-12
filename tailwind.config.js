import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Cormorant Garamond', 'serif'],
            },
            colors: {
                dark: {
                    50: '#f7f7f7',
                    100: '#e3e3e3',
                    200: '#c8c8c8',
                    300: '#a4a4a4',
                    400: '#818181',
                    500: '#666666',
                    600: '#515151',
                    700: '#434343',
                    800: '#383838',
                    900: '#1a1a1a',
                    950: '#0d0d0d',
                },
                gold: {
                    50: '#fdf9e7',
                    100: '#faf0c4',
                    200: '#f6e48c',
                    300: '#f0d24a',
                    400: '#e8c01e',
                    500: '#d4a810',
                    600: '#b7840b',
                    700: '#92600d',
                    800: '#794d12',
                    900: '#674015',
                },
            },
            letterSpacing: {
                'ultra-wide': '0.25em',
            },
        },
    },

    plugins: [forms],
};
