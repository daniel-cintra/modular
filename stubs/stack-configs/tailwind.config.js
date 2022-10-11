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
                        DEFAULT: 'rgb(var(--color-primary) / <alpha-value>)',
                        focus: 'rgb(var(--color-primary-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-primary-content) / <alpha-value>)'
                    },
                    secondary: {
                        DEFAULT: 'rgb(var(--color-secondary) / <alpha-value>)',
                        focus: 'rgb(var(--color-secondary-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-secondary-content) / <alpha-value>)'
                    },

                    accent: {
                        DEFAULT: 'rgb(var(--color-accent) / <alpha-value>)',
                        focus: 'rgb(var(--color-accent-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-accent-content) / <alpha-value>)'
                    },

                    neutral: {
                        DEFAULT: 'rgb(var(--color-neutral) / <alpha-value>)',
                        focus: 'rgb(var(--color-neutral-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-neutral-content) / <alpha-value>)'
                    },

                    base: {
                        DEFAULT: 'rgb(var(--color-base) / <alpha-value>)',
                        100: 'rgb(var(--color-base-100) / <alpha-value>)',
                        200: 'rgb(var(--color-base-200) / <alpha-value>)',
                        300: 'rgb(var(--color-base-300) / <alpha-value>)',
                        content:
                            'rgb(var(--color-base-content) / <alpha-value>)'
                    },

                    info: {
                        DEFAULT: 'rgb(var(--color-info) / <alpha-value>)',
                        focus: 'rgb(var(--color-info-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-info-content) / <alpha-value>)'
                    },
                    success: {
                        DEFAULT: 'rgb(var(--color-success) / <alpha-value>)',
                        focus: 'rgb(var(--color-success-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-success-content) / <alpha-value>)'
                    },
                    warning: {
                        DEFAULT: 'rgb(var(--color-warning) / <alpha-value>)',
                        focus: 'rgb(var(--color-warning-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-warning-content) / <alpha-value>)'
                    },
                    error: {
                        DEFAULT: 'rgb(var(--color-error) / <alpha-value>)',
                        focus: 'rgb(var(--color-error-focus) / <alpha-value>)',
                        content:
                            'rgb(var(--color-error-content) / <alpha-value>)'
                    }
                }
            }
        }
    },

    plugins: [require('@tailwindcss/forms')]
}
