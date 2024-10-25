const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                skin: {
                    primary: {
                        1: 'rgb(var(--color-primary-1) / <alpha-value>)',
                        2: 'rgb(var(--color-primary-2) / <alpha-value>)',
                        3: 'rgb(var(--color-primary-3) / <alpha-value>)',
                        4: 'rgb(var(--color-primary-4) / <alpha-value>)',
                        5: 'rgb(var(--color-primary-5) / <alpha-value>)',
                        6: 'rgb(var(--color-primary-6) / <alpha-value>)',
                        7: 'rgb(var(--color-primary-7) / <alpha-value>)',
                        8: 'rgb(var(--color-primary-8) / <alpha-value>)',
                        9: 'rgb(var(--color-primary-9) / <alpha-value>)',
                        10: 'rgb(var(--color-primary-10) / <alpha-value>)',
                        11: 'rgb(var(--color-primary-11) / <alpha-value>)',
                        12: 'rgb(var(--color-primary-12) / <alpha-value>)'
                    },

                    neutral: {
                        1: 'rgb(var(--color-neutral-1) / <alpha-value>)',
                        2: 'rgb(var(--color-neutral-2) / <alpha-value>)',
                        3: 'rgb(var(--color-neutral-3) / <alpha-value>)',
                        4: 'rgb(var(--color-neutral-4) / <alpha-value>)',
                        5: 'rgb(var(--color-neutral-5) / <alpha-value>)',
                        6: 'rgb(var(--color-neutral-6) / <alpha-value>)',
                        7: 'rgb(var(--color-neutral-7) / <alpha-value>)',
                        8: 'rgb(var(--color-neutral-8) / <alpha-value>)',
                        9: 'rgb(var(--color-neutral-9) / <alpha-value>)',
                        10: 'rgb(var(--color-neutral-10) / <alpha-value>)',
                        11: 'rgb(var(--color-neutral-11) / <alpha-value>)',
                        12: 'rgb(var(--color-neutral-12) / <alpha-value>)'
                    },

                    content: {
                        DEFAULT: 'rgb(var(--color-content) / <alpha-value>)',
                        1: 'rgb(var(--color-content-1) / <alpha-value>)'
                    },

                    info: {
                        DEFAULT: 'rgb(var(--color-info) / <alpha-value>)',
                        light: 'rgb(var(--color-info-light) / <alpha-value>)',
                        dark: 'rgb(var(--color-info-dark) / <alpha-value>)'
                    },
                    success: {
                        DEFAULT: 'rgb(var(--color-success) / <alpha-value>)',
                        light: 'rgb(var(--color-success-light) / <alpha-value>)',
                        dark: 'rgb(var(--color-success-dark) / <alpha-value>)'
                    },
                    warning: {
                        DEFAULT: 'rgb(var(--color-warning) / <alpha-value>)',
                        light: 'rgb(var(--color-warning-light) / <alpha-value>)',
                        dark: 'rgb(var(--color-warning-dark) / <alpha-value>)'
                    },
                    error: {
                        DEFAULT: 'rgb(var(--color-error) / <alpha-value>)',
                        light: 'rgb(var(--color-error-light) / <alpha-value>)',
                        dark: 'rgb(var(--color-error-dark) / <alpha-value>)'
                    }
                }
            }
        }
    },

    plugins: [
        require('@tailwindcss/forms')
    ],

    safelist: ['tooltip-arrow']
}
