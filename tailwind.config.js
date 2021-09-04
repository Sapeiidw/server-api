const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
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
            screens: {
                light: { raw: "(prefers-color-scheme: light)" },
                dark: { raw: "(prefers-color-scheme: dark)" }
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
        function({ addBase, config }) {
            addBase({
              body: {
                color: config("theme.colors.black"),
                backgroundColor: config("theme.colors.white")
              },
              "@screen dark": {
                body: {
                  color: config("theme.colors.white"),
                  backgroundColor: config("theme.colors.black")
                }
              }
            });
          }
    ],
};
