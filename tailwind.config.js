/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                void: '#14100D',
                ivory: '#F1E9DC',
                amber: {
                    DEFAULT: '#B8863B',
                    light: '#D9B579',
                },
                bordeaux: '#5B1A24',
                smoke: '#96897B',
                line: 'rgba(241,233,220,0.14)',
            },
            fontFamily: {
                display: ['"Fraunces"', 'serif'],
                body: ['"Manrope"', 'sans-serif'],
            },
            letterSpacing: {
                widest2: '0.28em',
            },
            transitionTimingFunction: {
                silk: 'cubic-bezier(0.22, 1, 0.36, 1)',
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
