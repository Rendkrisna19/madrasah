import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php', // <-- TAMBAHKAN INI biar Livewire terbaca
    ],

    theme: {
        extend: {
            fontFamily: {
                // Menjadikan Space Grotesk sebagai font default sans
                sans: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Menambahkan palet warna hijau khusus untuk madrasah
                madrasah: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e', // Warna utama
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                }
            }
        },
    },

    plugins: [forms],
};