import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                teko: ["Teko", "sans-serif"],
                calibri: ["Calibri", "Arial", "sans-serif"],
            },
            colors: {
                'custom-blue': '#152451',
                'custom-lblue': '#92AFD7',
                'custom-wblue': '#E1E7F5',
                'custom-ylo': '#f2cc8f',
                'custom-pink': '#FFE0E9',
                'custom-lgreen': '#ff4d6d',
                'custom-kcolor':'#07384D'
                
              },
        },
    },

    plugins: [forms],
};
