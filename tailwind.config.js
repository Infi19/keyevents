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
                'primary': '#003E53',     // Navy Blue
                'secondary': '#A9D9E8',   // Sky Blue
                'accent': '#F8961E',      // Orange
                'light': '#FFFFFF',       // White
                'dark': '#264653',        // Charcoal/Dark Teal
                'light-gray': '#F4F4F4',  // Light Gray
                'blue-gray': '#D9EAF2',   // Soft Blue-Gray
                'text': '#1E1E1E',        // Black for text
                
                // Keep the old colors for backward compatibility (to avoid breaking existing code)
                'custom-blue': '#003E53',
                'custom-lblue': '#A9D9E8',
                'custom-wblue': '#A9D9E8',
                'custom-ylo': '#F8961E',
                'custom-pink': '#D9EAF2',
                'custom-lgreen': '#F8961E',
                'custom-kcolor': '#264653'
              },
        },
    },

    plugins: [forms],
};
