import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                  10: '#F3F1F9',
                  20: '#DED8EF',
                  30: '#C9BEE5',
                  40: '#B4A4DB',
                  50: '#25185A',
                  60: '#1F144D',
                  70: '#191040',
                  80: '#140C33',
                  90: '#0F0826',
                },
                secondary: '#FAD605',
            }
        },
    },
    plugins: [],
};
