const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',

    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Conecta a classe 'font-serif' à sua variável --font-primary (Merriweather)
                serif: ['var(--font-primary)', ...defaultTheme.fontFamily.serif],
                // Conecta a classe 'font-sans' à sua variável --font-secondary (Lato)
                sans: ['var(--font-secondary)', ...defaultTheme.fontFamily.sans],
                // CRIA a classe 'font-reading' e a conecta à variável --font-reading (Montserrat)
                reading: ['var(--font-reading)', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Também é uma boa prática mapear suas cores aqui
                primary: 'var(--color-primary)',
                'primary-foreground': 'var(--color-primary-foreground)',
                secondary: 'var(--color-secondary)',
                'secondary-foreground': 'var(--color-secondary-foreground)',
                accent: 'var(--color-accent)',
                'accent-foreground': 'var(--color-accent-foreground)',
                zinc: {
                    50: 'var(--color-zinc-50)',
                    100: 'var(--color-zinc-100)',
                    200: 'var(--color-zinc-200)',
                    300: 'var(--color-zinc-300)',
                    400: 'var(--color-zinc-400)',
                    500: 'var(--color-zinc-500)',
                    600: 'var(--color-zinc-600)',
                    700: 'var(--color-zinc-700)',
                    800: 'var(--color-zinc-800)',
                    900: 'var(--color-zinc-900)',
                    950: 'var(--color-zinc-950)',
                }
            }
        },
    },

    plugins: [
        require('tailwindcss-animate'),
        require('@tailwindcss/typography'),
    ],
};
